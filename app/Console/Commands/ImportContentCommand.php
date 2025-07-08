<?php

namespace App\Console\Commands;

use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Symfony\Component\Console\Command\Command as CommandAlias;

// Модели
use App\Models\Author;
use App\Models\Book;
use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Chapter;

// League/CommonMark
use League\CommonMark\CommonMarkConverter;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\Extension\Footnote\FootnoteExtension;
use League\CommonMark\Extension\Table\TableExtension;
use League\CommonMark\Environment\Environment;
use League\CommonMark\MarkdownConverter;

class ImportContentCommand extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'app:import-content
                            {type : The type of content to import (book or article)}
                            {title : The title of the book or article}
                            {filePath : The path to the Markdown file}
                            {--author_names= : Comma-separated names of authors (e.g., "Имя1,Имя2")}
                            {--hidden : Mark the content as hidden (only for registered users)}
                            {--year= : Publication year for books}
                            {--lang=ru : Language of the content (default: ru)}
                            {--publisher= : Publisher for books}
                            {--description= : Description/annotation for books (for books only)}
                            {--cover= : Path to the cover image for books}
                            {--published_at= : Publication date for articles (YYYY-MM-DD, for articles only)}
                            {--category= : Category name for articles}
                            {--tags= : Comma-separated tag names for articles}
                            {--debug : Enable debug mode to see conversion details}';

    /**
     * The console command description.
     */
    protected $description = 'Imports a new book or article from a Markdown file.';

    /**
     * Markdown converter instance.
     */
    protected MarkdownConverter $markdownConverter;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Создает и настраивает конвертер Markdown
     */
    protected function createMarkdownConverter(): MarkdownConverter
    {
        // Создаем окружение с базовой конфигурацией
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
        // Инициализируем конвертер
        $this->markdownConverter = $this->createMarkdownConverter();

        $type = $this->argument('type');
        $title = $this->argument('title');
        $filePath = $this->argument('filePath');
        $authorNamesOption = $this->option('author_names');
        $isHidden = (bool) $this->option('hidden');
        $categoryName = $this->option('category');
        $tagNamesOption = $this->option('tags');
        $debug = (bool) $this->option('debug');

        // Подготовка имен авторов и тегов
        $authorNames = $authorNamesOption ? array_map('trim', explode(',', $authorNamesOption)) : [];
        $tagNames = $tagNamesOption ? array_map('trim', explode(',', $tagNamesOption)) : [];

        // Отладочная информация
        if ($debug) {
            $this->info("=== ОТЛАДОЧНАЯ ИНФОРМАЦИЯ ===");

            // Попытка получить версию league/commonmark
            try {
                if (class_exists('\Composer\InstalledVersions')) {
                    $version = \Composer\InstalledVersions::getVersion('league/commonmark');
                    $this->info("Версия League/CommonMark: " . $version);
                } else {
                    $this->info("Невозможно определить версию League/CommonMark");
                }
            } catch (Exception $e) {
                $this->warn("Ошибка получения версии: " . $e->getMessage());
            }

            // Проверяем загруженные расширения
            $this->info("Проверка расширений:");
            $this->info("- CommonMarkCoreExtension: " . (class_exists('League\\CommonMark\\Extension\\CommonMark\\CommonMarkCoreExtension') ? 'OK' : 'НЕТ'));
            $this->info("- TableExtension: " . (class_exists('League\\CommonMark\\Extension\\Table\\TableExtension') ? 'OK' : 'НЕТ'));
            $this->info("- FootnoteExtension: " . (class_exists('League\\CommonMark\\Extension\\Footnote\\FootnoteExtension') ? 'OK' : 'НЕТ'));
            $this->info("==============================");
        }

        // Проверка существования файла
        if (!File::exists($filePath)) {
            $this->error("Файл не найден по пути: $filePath");
            return CommandAlias::FAILURE;
        }

        // Тестовая конвертация для диагностики
        if ($debug) {
            $this->testMarkdownConversion($filePath);
        }

        try {
            switch ($type) {
                case 'book':
                    return $this->importBook(
                        $title,
                        $filePath,
                        $authorNames,
                        $isHidden,
                        $this->option('year'),
                        $this->option('lang'),
                        $this->option('publisher'),
                        $this->option('description'),
                        $this->option('cover')
                    );
                case 'article':
                    return $this->importArticle(
                        $title,
                        $filePath,
                        $authorNames,
                        $isHidden,
                        $this->option('published_at'),
                        $categoryName,
                        $tagNames
                    );
                default:
                    $this->error('Неверный тип контента. Должен быть "book" или "article".');
                    return CommandAlias::FAILURE;
            }
        } catch (Exception $e) {
            $this->error("Произошла ошибка: " . $e->getMessage());
            $this->line("Стек вызовов:");
            $this->line($e->getTraceAsString());
            return CommandAlias::FAILURE;
        }
    }

    /**
     * Imports a book from Markdown content.
     */
    protected function importBook(
        string $title,
        string $filePath,
        array $authorNames,
        bool $isHidden,
        ?string $publicationYear,
        ?string $language,
        ?string $publisher,
        ?string $descriptionOption,
        ?string $coverImage
    ): int {
        $trimmedTitle = trim($title);
        $bookDescriptionHtml = null;

        try {
            if ($descriptionOption) {
                $bookDescriptionHtml = $this->markdownConverter->convert($descriptionOption)->getContent();
            }
        } catch (Exception $e) {
            $this->warn("Ошибка конвертации описания книги: " . $e->getMessage());
            if ($this->option('debug')) {
                $this->line("Стек вызовов: " . $e->getTraceAsString());
            }
        }

        /** @var \App\Models\Book $book */
        $book = Book::where('title', $trimmedTitle)->first();

        $shouldProcessChapters = false;

        if ($book) {
            $this->warn("Книга '{$trimmedTitle}' уже существует. Обновляю её данные.");
            $book->update([
                'description' => $bookDescriptionHtml,
                'publication_year' => $publicationYear,
                'publisher' => $publisher,
                'language' => $language,
                'cover_image' => $coverImage,
                'is_hidden' => $isHidden,
            ]);

            if ($this->confirm("Хотите обновить главы для книги '{$trimmedTitle}'? (Это удалит существующие главы!)")) {
                $book->chapters()->delete();
                $this->info("Существующие главы для '{$trimmedTitle}' удалены.");
                $shouldProcessChapters = true;
            }
        } else {
            $this->info("Создаю новую книгу: '{$trimmedTitle}'");
            $book = Book::create([
                'title' => $trimmedTitle,
                'slug' => Str::slug($trimmedTitle),
                'description' => $bookDescriptionHtml,
                'publication_year' => $publicationYear,
                'publisher' => $publisher,
                'language' => $language,
                'cover_image' => $coverImage,
                'is_hidden' => $isHidden,
            ]);
            $shouldProcessChapters = true;
        }

        $this->syncAuthors($book, $authorNames);

        if ($shouldProcessChapters) {
            $this->importChaptersForBook($book, $filePath, $isHidden);
        } else {
            $this->info("Импорт глав для книги '{$trimmedTitle}' пропущен.");
        }

        $this->info("Книга '{$trimmedTitle}' и её главы успешно импортированы/обновлены.");
        return CommandAlias::SUCCESS;
    }

    /**
     * Imports chapters for a given book from a Markdown file.
     */
    protected function importChaptersForBook(Book $book, string $filePath, bool $isHidden): void
    {
        $content = File::get($filePath);
        $chaptersText = explode('===CHAPTER===', $content);

        if (count($chaptersText) == 1 && !empty(trim($chaptersText[0]))) {
            if ($this->confirm("Разделитель '===CHAPTER===' не найден в файле для книги '{$book->title}'. Обработать весь файл как одну главу?")) {
                $this->createChapter($book, $chaptersText[0], 1, $isHidden);
            } else {
                $this->error("Импорт глав для книги '{$book->title}' отменен из-за отсутствия разделителей.");
            }
        } else {
            if (empty(trim($chaptersText[0]))) {
                array_shift($chaptersText);
            }

            foreach ($chaptersText as $index => $chapterContent) {
                $this->createChapter($book, $chapterContent, $index + 1, $isHidden);
            }
        }
    }

    /**
     * Helper to create or update a single chapter.
     */
    protected function createChapter(Book $book, string $chapterContent, int $order, bool $isHidden): void
    {
        $lines = explode("\n", trim($chapterContent));
        $chapterTitle = trim(array_shift($lines));
        $chapterBodyMarkdown = implode("\n", $lines);

        $chapterBodyHtml = null;
        try {
            $chapterBodyHtml = $this->markdownConverter->convert($chapterBodyMarkdown)->getContent();
        } catch (Exception $e) {
            $this->error("Ошибка конвертации главы '{$chapterTitle}': " . $e->getMessage());
            if ($this->option('debug')) {
                $this->line("Стек вызовов: " . $e->getTraceAsString());
            }
            return;
        }

        /** @var \App\Models\Chapter $chapter */
        $chapter = $book->chapters()->where('order', $order)->first();
        if (!$chapter) {
            $chapter = $book->chapters()->where('title', $chapterTitle)->first();
        }

        if ($chapter) {
            $this->warn("Глава '{$chapterTitle}' (порядковый номер: {$order}) для книги '{$book->title}' уже существует. Обновляю её содержимое.");
            $chapter->update([
                'content' => $chapterBodyHtml,
                'is_hidden' => $isHidden,
            ]);
        } else {
            $this->info("Создаю новую главу: '{$chapterTitle}' (порядковый номер: {$order}) для книги '{$book->title}'");
            $book->chapters()->create([
                'title' => $chapterTitle,
                'slug' => Str::slug($chapterTitle),
                'content' => $chapterBodyHtml,
                'order' => $order,
                'is_hidden' => $isHidden,
            ]);
        }
    }

    /**
     * Imports an article from Markdown content.
     */
    protected function importArticle(
        string $title,
        string $filePath,
        array $authorNames,
        bool $isHidden,
        ?string $publishedAt,
        ?string $categoryName,
        array $tagNames
    ): int {
        $trimmedTitle = trim($title);
        $articleContentMarkdown = File::get($filePath);

        // Добавляем отладочную информацию
        if ($this->option('debug')) {
            $this->info("=== ОТЛАДКА ИМПОРТА СТАТЬИ ===");
            $this->line("Исходный Markdown (первые 1000 символов):");
            $this->line(substr($articleContentMarkdown, 0, 1000));
            if (strlen($articleContentMarkdown) > 1000) {
                $this->line("... (обрезано)");
            }
            $this->line("\n" . str_repeat('=', 50) . "\n");
        }

        $articleContentHtml = null;
        try {
            $articleContentHtml = $this->markdownConverter->convert($articleContentMarkdown)->getContent();

            // Отладочная информация для HTML
            if ($this->option('debug')) {
                $this->line("Результат конвертации в HTML (первые 1000 символов):");
                $this->line(substr($articleContentHtml, 0, 1000));
                if (strlen($articleContentHtml) > 1000) {
                    $this->line("... (обрезано)");
                }
                $this->line("\n" . str_repeat('=', 50) . "\n");

                // Проверяем, есть ли в HTML таблицы и сноски
                $tableCount = substr_count($articleContentHtml, '<table');
                $footnoteCount = substr_count($articleContentHtml, 'footnote');
                $this->info("Найдено таблиц: " . $tableCount);
                $this->info("Найдено элементов сносок: " . $footnoteCount);
            }

        } catch (Exception $e) {
            $this->error("Ошибка конвертации статьи '{$trimmedTitle}': " . $e->getMessage());
            if ($this->option('debug')) {
                $this->line("Стек вызовов: " . $e->getTraceAsString());
            }
            return CommandAlias::FAILURE;
        }

        $categoryId = null;
        if ($categoryName) {
            /** @var \App\Models\Category $category */
            $category = Category::firstOrCreate(
                ['name' => trim($categoryName)],
                ['slug' => Str::slug(trim($categoryName))]
            );
            $categoryId = $category->id;
        }

        /** @var \App\Models\Article $article */
        $article = Article::where('title', $trimmedTitle)->first();

        if ($article) {
            $this->warn("Статья '{$trimmedTitle}' уже существует. Обновляю её содержимое.");
            $article->update([
                'content' => $articleContentHtml,
                'published_at' => $publishedAt ?? $article->published_at,
                'is_hidden' => $isHidden,
                'category_id' => $categoryId,
            ]);

            // Проверяем, что сохранилось в базе данных
            if ($this->option('debug')) {
                $savedContent = $article->fresh()->content;
                $this->line("Содержимое, сохраненное в БД (первые 500 символов):");
                $this->line(substr($savedContent, 0, 500));

                if ($savedContent === $articleContentHtml) {
                    $this->info("✓ Содержимое в БД соответствует конвертированному HTML");
                } else {
                    $this->warn("✗ Содержимое в БД отличается от конвертированного HTML");
                }
            }

        } else {
            $this->info("Создаю новую статью: '{$trimmedTitle}'");
            $article = Article::create([
                'title' => $trimmedTitle,
                'slug' => Str::slug($trimmedTitle),
                'content' => $articleContentHtml,
                'published_at' => $publishedAt ?? now(),
                'is_hidden' => $isHidden,
                'category_id' => $categoryId,
            ]);
        }

        $this->syncAuthors($article, $authorNames);
        $this->syncTags($article, $tagNames);

        $this->info("Статья '{$trimmedTitle}' успешно импортирована/обновлена.");
        return CommandAlias::SUCCESS;
    }

    /**
     * Syncs authors for a given content item (Book or Article).
     */
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

    /**
     * Helper method to test Markdown conversion and output HTML.
     */
    protected function testMarkdownConversion(string $filePath): void
    {
        $this->info("\n--- Запускаю тестовую конвертацию Markdown ---");
        if (!File::exists($filePath)) {
            $this->error("Тестовый файл Markdown не найден по пути: $filePath");
            return;
        }

        $markdownContent = File::get($filePath);
        $this->line("Исходный Markdown (первые 1000 символов):");
        $this->line(substr($markdownContent, 0, 1000));
        if (strlen($markdownContent) > 1000) {
            $this->line("... (обрезано)");
        }

        try {
            $htmlOutput = $this->markdownConverter->convert($markdownContent)->getContent();
            $this->line("\nРезультат конвертации в HTML (первые 1000 символов):");
            $this->line(substr($htmlOutput, 0, 1000));
            if (strlen($htmlOutput) > 1000) {
                $this->line("... (обрезано)");
            }

            // Дополнительная диагностика
            $this->line("\n--- Диагностика ---");
            $this->info("Размер исходного Markdown: " . strlen($markdownContent) . " символов");
            $this->info("Размер результирующего HTML: " . strlen($htmlOutput) . " символов");
            $this->info("Найдено таблиц: " . substr_count($htmlOutput, '<table'));
            $this->info("Найдено элементов сносок: " . substr_count($htmlOutput, 'footnote'));
            $this->info("Найдено заголовков: " . (substr_count($htmlOutput, '<h1') + substr_count($htmlOutput, '<h2') + substr_count($htmlOutput, '<h3')));

        } catch (Exception $e) {
            $this->error("\nОШИБКА КОНВЕРТАЦИИ В ТЕСТОВОМ РЕЖИМЕ: " . $e->getMessage());
            $this->line("Стек вызовов: " . $e->getTraceAsString());
        }
        $this->info("--- Тестовая конвертация завершена ---\n");
    }
}
