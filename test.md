<?php
require 'vendor/autoload.php';

use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\Extension\Footnote\FootnoteExtension;
use League\CommonMark\Extension\Table\TableExtension;
use League\CommonMark\Extension\Autolink\AutolinkExtension;
use League\CommonMark\Extension\Strikethrough\StrikethroughExtension;
use League\CommonMark\CommonMarkConverter;

echo "--- Начинаем тест CommonMark ---\n";
echo "Текущая версия PHP: " . PHP_VERSION . "\n";
echo "Расширение 'intl' загружено: " . (extension_loaded('intl') ? 'Да' : 'Нет') . "\n";
echo "Расширение 'mbstring' загружено: " . (extension_loaded('mbstring') ? 'Да' : 'Нет') . "\n";
echo "Расширение 'dom' загружено: " . (extension_loaded('dom') ? 'Да' : 'Нет') . "\n";
try {
    echo "Версия CommonMark: " . \Composer\InstalledVersions::getVersion('league/commonmark') . "\n";
} catch (Exception $e) {
    echo "Версия CommonMark: Не удалось определить версию (" . $e->getMessage() . ")\n";
}


# Заголовок

Это текст со сноской[^тест].

| Колонка 1 | Колонка 2 |
|-----------|-----------|
| Значение 1 | Значение 2 |

[^тест]: Это тестовая сноска.
EOD;

echo "\n--- Исходный Markdown ---\n";
echo $markdown . "\n";

try {
    $config = [
        'html_input' => 'allow',
        'allow_unsafe_links' => false,
        'renderer' => [
            'block_separator' => "\n",
            'inner_separator' => "\n",
            'soft_break' => "\n",
        ],
        'footnote' => [
            'backref_class' => 'footnote-backref',
            'container_add_hr' => true,
            'container_class' => 'footnotes',
            'ref_class' => 'footnote-ref',
            'ref_id_prefix' => 'fnref:',
            'footnote_class' => 'footnote',
            'footnote_id_prefix' => 'fn:',
        ],
        'table' => [
            'wrap' => [
                'enabled' => false,
                'tag' => 'div',
                'attributes' => [],
            ],
        ],
        'commonmark' => [
            'enable_strong' => true,
            'enable_em' => true,
            'use_asterisk' => true,
            'use_underscore' => true,
            'enable_breaks' => true,
        ],
    ];

    $environment = new Environment($config);
    echo "Создано окружение CommonMark.\n";

    $environment->addExtension(new CommonMarkCoreExtension());
    echo "Добавлено CommonMarkCoreExtension.\n";

    $environment->addExtension(new FootnoteExtension());
    echo "Добавлено FootnoteExtension.\n";

    $environment->addExtension(new TableExtension());
    echo "Добавлено TableExtension.\n";

    $environment->addExtension(new AutolinkExtension());
    echo "Добавлено AutolinkExtension.\n";

    $environment->addExtension(new StrikethroughExtension());
    echo "Добавлено StrikethroughExtension.\n";

    $converter = new CommonMarkConverter($config, $environment);
    echo "Создан конвертер CommonMark.\n";

    echo "\n--- Результат конвертации в HTML ---\n";
    echo $converter->convert($markdown)->getContent() . "\n";

} catch (Exception $e) {
    echo "Ошибка: " . $e->getMessage() . "\n";
}

echo "\n--- Тест CommonMark завершен ---\n";
