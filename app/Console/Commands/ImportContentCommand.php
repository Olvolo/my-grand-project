<?php

namespace App\Console\Commands;

use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Spatie\YamlFrontMatter\YamlFrontMatter; // <-- 1. Добавляем use
use Symfony\Component\Console\Command\Command as CommandAlias;

// ... (остальные use для моделей)
use App\Models\Author;
use App\Models\Book;
use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Chapter;

// ... (остальные use для CommonMark)
use League\CommonMark\MarkdownConverter;
// ... (здесь можно убрать лишние use, если они не нужны напрямую)
use League\CommonMark\CommonMarkConverter;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\Extension\Footnote\FootnoteExtension;
use League\CommonMark\Extension\Table\TableExtension;
use League\CommonMark\Environment\Environment;


class ImportContentCommand extends Command
{
    /**
     * 2. Упрощаем сигнатуру. Теперь нужен только путь к файлу!
     */
    protected $signature = 'app:import-content
                            {filePath : The path to the Markdown file}
                            {--debug : Enable debug mode to see conversion details}';

    protected $description = 'Imports or updates content from a Markdown file with YAML Front Matter.';

    protected MarkdownConverter $markdownConverter;

    public function __construct()
    {
        parent::__construct();
    }

    // Метод createMarkdownConverter остается без изменений...
    protected function createMarkdownConverter(): MarkdownConverter
    {
        // ... (весь ваш код для создания конвертера)
        $config = [
            'html_input' => 'strip',
            'allow_unsafe_links' => false,
            'max_nesting_level' => 100,
            // Конфигурация для сносок
            'footnote' => [
                'backref_class' => 'footnote-backref',
                'backref_symbol' => '↩',
                'container_add_hr' => true,
                'container_class' => 'footnotes',
                'ref_class' => 'footnote-ref',
                'ref_id_prefix' => 'fnref:',
                'footnote_class' => 'footnote',
                'footnote_id_prefix' => 'fn:',
            ],
            // Конфигурация для таблиц
            'table' => [
                'wrap' => [
                    'enabled' => false,
                    'tag' => 'div',
                    'attributes' => [],
                ],
                'alignment_attributes' => [
                    'left' => ['align' => 'left'],
                    'center' => ['align' => 'center'],
                    'right' => ['align' => 'right'],
                ],
            ],
        ];

        // Создаем окружение
        $environment = new Environment($config);

        // Добавляем расширения
        $environment->addExtension(new CommonMarkCoreExtension());
        $environment->addExtension(new TableExtension());
        $environment->addExtension(new FootnoteExtension());

        // Используем MarkdownConverter вместо CommonMarkConverter
        return new MarkdownConverter($environment);
    }


    /**
     * Executes the console command.
     */
    public function handle(): int
    {
        $this->markdownConverter = $this->createMarkdownConverter();
        $filePath = $this->argument('filePath');

        if (!File::exists($filePath)) {
            $this->error("Файл не найден по пути: $filePath");
            return CommandAlias::FAILURE;
        }

        try {
            // 3. Парсим файл с помощью YamlFrontMatter
            $document = YamlFrontMatter::parse(File::get($filePath));

            // Определяем тип контента по наличию ключей в метаданных
            // Например, если есть 'chapters' или 'publisher', считаем это книгой.
            $type = $document->matter('publisher') || $document->matter('year') ? 'book' : 'article';

            if ($type === 'book') {
                return $this->importBook($document);
            }

            return $this->importArticle($document);

        } catch (Exception $e) {
            $this->error("Произошла ошибка: " . $e->getMessage());
            $this->error("Файл: " . $e->getFile() . " на строке: " . $e->getLine());
            return CommandAlias::FAILURE;
        }
    }

    /**
     * 4. Обновляем метод importArticle. Теперь он принимает объект Document.
     */
    protected function importArticle(\Spatie\YamlFrontMatter\Document $document): int
    {
        // Получаем все метаданные из документа
        $title = $document->matter('title');
        $authorNames = $document->matter('authors', []);
        $isHidden = $document->matter('is_hidden', false);
        $publishedAt = $document->matter('published_at');
        $categoryName = $document->matter('category');
        $tagNames = $document->matter('tags', []);

        // Тело статьи
        $articleContentMarkdown = $document->body();
        $articleContentHtml = $this->markdownConverter->convert($articleContentMarkdown)->getContent();

        $categoryId = null;
        if ($categoryName) {
            $category = Category::firstOrCreate(
                ['name' => trim($categoryName)],
                ['slug' => Str::slug(trim($categoryName))]
            );
            $categoryId = $category->id;
        }

        $article = Article::updateOrCreate(
            ['title' => $title], // Условие для поиска
            [                   // Данные для обновления или создания
                'slug' => Str::slug($title),
                'content' => $articleContentHtml,
                'published_at' => $publishedAt ?? now(),
                'is_hidden' => $isHidden,
                'category_id' => $categoryId,
            ]
        );

        $this->syncAuthors($article, $authorNames);
        $this->syncTags($article, $tagNames);

        $this->info("Статья '{$title}' успешно импортирована/обновлена.");
        return CommandAlias::SUCCESS;
    }

    /**
     * Вам нужно будет аналогично обновить метод importBook
     * Я пока оставлю его пустым, чтобы вы сфокусировались на статьях
     * Мы можем сделать его вместе следующим шагом.
     */
    protected function importBook(\Spatie\YamlFrontMatter\Document $document): int
    {
        $this->warn('Импорт книг пока не реализован с Front Matter. Сделайте это по аналогии со статьями.');
        // Здесь будет ваша логика для импорта книг
        return CommandAlias::SUCCESS;
    }

    // Методы syncAuthors, syncTags, createMarkdownConverter остаются без изменений...
    protected function syncAuthors($contentItem, array $authorNames): void
    {
        if (empty($authorNames)) {
            $contentItem->authors()->sync([]);
            $this->warn("Авторы для '{$contentItem->title}' отвязаны (пустой список).");
            return;
        }

        $authorIds = [];
        foreach ($authorNames as $authorName) {
            /** @var \App\Models\Author $author */
            $author = Author::firstOrCreate(
                ['name' => $authorName],
                ['slug' => Str::slug($authorName)]
            );
            $authorIds[] = $author->id;
        }
        $contentItem->authors()->sync($authorIds);
        $this->info("Авторы синхронизированы для '{$contentItem->title}'.");
    }

    /**
     * Syncs tags for a given article.
     */
    protected function syncTags(Article $article, array $tagNames): void
    {
        if (empty($tagNames)) {
            $article->tags()->sync([]);
            $this->warn("Теги для статьи '{$article->title}' отвязаны (пустой список).");
            return;
        }

        $tagIds = [];
        foreach ($tagNames as $tagName) {
            /** @var \App\Models\Tag $tag */
            $tag = Tag::firstOrCreate(
                ['name' => $tagName],
                ['slug' => Str::slug($tagName)]
            );
            $tagIds[] = $tag->id;
        }
        $article->tags()->sync($tagIds);
        $this->info("Теги синхронизированы для статьи '{$article->title}'.");
    }
}
