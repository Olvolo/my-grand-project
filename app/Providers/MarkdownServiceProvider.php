<?php

namespace App\Providers;

use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;
use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\Extension\Footnote\FootnoteExtension;
use League\CommonMark\Extension\Table\TableExtension;
use League\CommonMark\MarkdownConverter;

class MarkdownServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Связываем конкретный класс MarkdownConverter.
        // Убираем неиспользуемый параметр $app
        $this->app->singleton(MarkdownConverter::class, function () {
            $config = [
                'html_input' => 'strip',
                'allow_unsafe_links' => false,
                'footnote' => [
                    'backref_class' => 'footnote-backref',
                    'backref_symbol' => '↩',
                ],
            ];

            $environment = new Environment($config);
            $environment->addExtension(new CommonMarkCoreExtension());
            $environment->addExtension(new TableExtension());
            $environment->addExtension(new FootnoteExtension());

            return new MarkdownConverter($environment);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array<int, string>
     */
    public function provides(): array
    {
        // Указываем, что наш провайдер предоставляет этот конкретный класс.
        return [MarkdownConverter::class];
    }
}
