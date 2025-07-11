<?php

namespace App\Console\Commands;

use App\Models\Article;
use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Models\Tag;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use League\CommonMark\Exception\CommonMarkException;
use League\CommonMark\MarkdownConverter;
use Spatie\YamlFrontMatter\YamlFrontMatter;

class ImportContentCommand extends Command
{
    /**
     * Сигнатура команды стала проще, теперь нужен только путь к файлу.
     */
    protected $signature = 'app:import-content {filePath : The path to the Markdown file}';

    /**
     * Описание команды.
     */
    protected $description = 'Imports or updates content from a Markdown file with YAML Front Matter.';

    /**
     * Основной метод, который выполняет команду.
     * Мы используем dependency injection, чтобы Laravel сам предоставил нам настроенный MarkdownConverter.
     * @throws CommonMarkException
     */
    public function handle(MarkdownConverter $converter): int
    {
        $filePath = $this->argument('filePath');

        if (!File::exists($filePath)) {
            $this->error("Файл не найден по пути: $filePath");
            return self::FAILURE;
        }

        try {
            // Парсим файл, чтобы отделить метаданные (Front Matter) от основного текста
            $document = YamlFrontMatter::parse(File::get($filePath));

            // Определяем, импортируем мы книгу или статью, по наличию поля 'publisher'
            $type = $document->matter('publisher') ? 'book' : 'article';

            if ($type === 'book') {
                $this->importBook($document, $converter);
            } else {
                $this->importArticle($document, $converter);
            }

        } catch (Exception $e) {
            $this->error("Произошла критическая ошибка: " . $e->getMessage());
            $this->error("Файл: " . $e->getFile() . ", строка: " . $e->getLine());
            return self::FAILURE;
        }

        return self::SUCCESS;
    }

    /**
     * Импортирует или обновляет статью.
     * @throws CommonMarkException
     */
    protected function importArticle(object $document, MarkdownConverter $converter): void
    {
        $markdownContent = $document->body();
        $htmlContent = $converter->convert($markdownContent)->getContent();

        $articleData = [
            'slug' => Str::slug($document->matter('title')),
            'content_markdown' => $markdownContent,
            'content_html' => $htmlContent,
            'published_at' => $document->matter('published_at', now()),
            'is_hidden' => $document->matter('is_hidden', false),
        ];

        // Находим или создаём статью
        /** @var Article $article */
        $article = Article::query()->updateOrCreate(
            ['title' => $document->matter('title')],
            $articleData
        );

        // Синхронизируем связи
        $this->syncCategory($article, $document->matter('category'));
        $this->syncAuthors($article, $document->matter('authors', []));
        $this->syncTags($article, $document->matter('tags', []));

        $this->info("Статья '$article->title' успешно импортирована/обновлена.");
    }

    /**
     * Импортирует или обновляет книгу и её главы.
     * @throws CommonMarkException
     */
    protected function importBook(object $document, MarkdownConverter $converter): void
    {
        $bookData = [
            'slug' => Str::slug($document->matter('title')),
            'description' => $converter->convert($document->matter('description', ''))->getContent(),
            'publication_year' => $document->matter('year'),
            'publisher' => $document->matter('publisher'),
            'language' => $document->matter('language', 'ru'),
            'is_hidden' => $document->matter('is_hidden', false),
        ];

        // Находим или создаём книгу
        /** @var Book $book */
        $book = Book::query()->updateOrCreate(
            ['title' => $document->matter('title')],
            $bookData
        );

        $this->syncAuthors($book, $document->matter('authors', []));
        $this->info("Книга '$book->title' успешно импортирована/обновлена.");

        // Импортируем главы
        $this->importChaptersForBook($book, $document->body(), $converter);
    }

    /**
     * Обрабатывает и создаёт главы для книги.
     * @throws CommonMarkException
     */
    protected function importChaptersForBook(Book $book, string $chaptersContent, MarkdownConverter $converter): void
    {
        // Удаляем старые главы перед импортом новых, чтобы избежать дубликатов
        $book->chapters()->delete();
        $this->warn("Все существующие главы для книги '$book->title' были удалены перед импортом.");

        // Разделяем текст на главы по специальному разделителю
        $chaptersText = explode('===CHAPTER===', $chaptersContent);

        foreach ($chaptersText as $index => $chapterContent) {
            $trimmedContent = trim($chapterContent);
            if (empty($trimmedContent)) {
                continue;
            }

            $lines = explode("\n", $trimmedContent);
            $chapterTitle = trim(array_shift($lines));
            $chapterBodyMarkdown = implode("\n", $lines);
            $chapterBodyHtml = $converter->convert($chapterBodyMarkdown)->getContent();

            $book->chapters()->create([
                'title' => $chapterTitle,
                'slug' => Str::slug($chapterTitle),
                'content_markdown' => $chapterBodyMarkdown,
                'content_html' => $chapterBodyHtml,
                'order' => $index + 1,
                'is_hidden' => $book->is_hidden, // Главы наследуют статус видимости от книги
            ]);
            $this->info(" -> Добавлена глава #".($index + 1).": $chapterTitle");
        }
    }

    /**
     * Синхронизирует авторов для контента (книги или статьи).
     */
    protected function syncAuthors(Article|Book $contentItem, array $authorNames): void
    {
        $authorIds = [];
        foreach ($authorNames as $authorName) {
            $author = Author::query()->firstOrCreate(
                ['name' => $authorName],
                ['slug' => Str::slug($authorName)]
            );
            $authorIds[] = $author->id;
        }
        $contentItem->authors()->sync($authorIds);
    }

    /**
     * Синхронизирует теги для статьи.
     */
    protected function syncTags(Article $article, array $tagNames): void
    {
        $tagIds = [];
        foreach ($tagNames as $tagName) {
            $tag = Tag::query()->firstOrCreate(
                ['name' => $tagName],
                ['slug' => Str::slug($tagName)]
            );
            $tagIds[] = $tag->id;
        }
        $article->tags()->sync($tagIds);
    }

    /**
     * Синхронизирует категорию для статьи.
     */
    protected function syncCategory(Article $article, ?string $categoryName): void
    {
        if (is_null($categoryName)) {
            $article->category()->dissociate();
            $article->save();
            return;
        }

        $category = Category::query()->firstOrCreate(
            ['name' => trim($categoryName)],
            ['slug' => Str::slug(trim($categoryName))]
        );

        $article->category()->associate($category);
        $article->save();
    }
}
