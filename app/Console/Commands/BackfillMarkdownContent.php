<?php

namespace App\Console\Commands;

use App\Models\Article;
use App\Models\Chapter;
use Illuminate\Console\Command;
use League\HTMLToMarkdown\HtmlConverter;

class BackfillMarkdownContent extends Command
{
    protected $signature = 'content:backfill-markdown';
    protected $description = 'Converts existing HTML content to Markdown for articles and chapters.';

    public function handle(): int
    {
        $converter = new HtmlConverter(['strip_tags' => true]);

        $this->info('Backfilling articles...');

        Article::query()->whereNull('content_markdown')->cursor()->each(function (Article $article) use ($converter) {
            $markdown = $converter->convert($article->content_html);
            $article->content_markdown = $markdown;
            $article->saveQuietly();
            $this->output->write('.');
        });
        $this->newLine();
        $this->info('Articles done.');

        $this->info('Backfilling chapters...');

        Chapter::query()->whereNull('content_markdown')->cursor()->each(function (Chapter $chapter) use ($converter) {
            $markdown = $converter->convert($chapter->content_html);
            $chapter->content_markdown = $markdown;
            $chapter->saveQuietly();
            $this->output->write('.');
        });
        $this->newLine();
        $this->info('Chapters done.');

        $this->info('All content has been backfilled successfully!');
        return self::SUCCESS;
    }
}
