<?php

namespace App\Console\Commands;

use App\Models\Author;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use League\CommonMark\Exception\CommonMarkException;
use League\CommonMark\MarkdownConverter;

class UpdateAuthorBio extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'author:update-bio
                            {slug : The slug of the author to update}
                            {filePath : The path to the Markdown file containing the biography}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Updates the biography for a specific author from a Markdown file.';

    /**
     * Execute the console command.
     *
     * @param MarkdownConverter $converter
     * @return int
     * @throws CommonMarkException
     */
    public function handle(MarkdownConverter $converter): int
    {
        $slug = $this->argument('slug');
        $filePath = $this->argument('filePath');

        $author = Author::query()->where('slug', $slug)->first();

        if (!$author) {
            $this->error("Автор с таким слагом '$slug' не найден.");
            return self::FAILURE;
        }

        if (!File::exists($filePath)) {
            $this->error("Файл с биографией не найден по пути: $filePath");
            return self::FAILURE;
        }

        try {
            $markdownContent = File::get($filePath);
            $htmlContent = $converter->convert($markdownContent)->getContent();

            $author->update(['bio' => $htmlContent]);

        } catch (CommonMarkException $e) {
            $this->error("Ошибка при конвертации Markdown: " . $e->getMessage());
            return self::FAILURE;
        }

        $this->info("Биография для автора '$author->name' успешно обновлена.");
        return self::SUCCESS;
    }
}
