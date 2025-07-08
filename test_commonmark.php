<?php
require 'vendor/autoload.php';

use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\Extension\Footnote\FootnoteExtension;
use League\CommonMark\Extension\Table\TableExtension;
use League\CommonMark\CommonMarkConverter;

echo "--- Начинаем тест CommonMark ---\n";
echo "Текущая версия PHP: " . PHP_VERSION . "\n";
echo "Расширение 'intl' загружено: " . (extension_loaded('intl') ? 'Да' : 'Нет') . "\n";
echo "Расширение 'mbstring' загружено: " . (extension_loaded('mbstring') ? 'Да' : 'Нет') . "\n";
echo "Расширение 'dom' загружено: " . (extension_loaded('dom') ? 'Да' : 'Нет') . "\n";
try {
    if (class_exists('\Composer\InstalledVersions')) {
        echo "Composer\InstalledVersions класс найден.\n";
        echo "Версия CommonMark: " . \Composer\InstalledVersions::getVersion('league/commonmark') . "\n";
    } else {
        echo "Composer\InstalledVersions класс не найден.\n";
    }
} catch (Exception $e) {
    echo "Версия CommonMark: Не удалось определить версию (" . $e->getMessage() . ")\n";
}

// Try file first, fallback to inline Markdown
$markdown = @file_get_contents('simple_test.md');
if ($markdown === false) {
    echo "Предупреждение: Не удалось прочитать simple_test.md, используется встроенный Markdown\n";
    $markdown = <<<EOD
# Test Chapter
This is a **bold** text with a footnote[^test].

| Col1 | Col2 |
|------|------|
| Val1 | Val2 |

[^test]: This is a test footnote.
EOD;
}

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
    ];

    $environment = new Environment($config);
    echo "Создано окружение CommonMark.\n";

    $environment->addExtension(new CommonMarkCoreExtension());
    echo "Добавлено CommonMarkCoreExtension.\n";

    $environment->addExtension(new TableExtension());
    echo "Добавлено TableExtension.\n";

    $environment->addExtension(new FootnoteExtension());
    echo "Добавлено FootnoteExtension.\n";

    // Updated to iterate over getExtensions() directly
    echo "Loaded extensions: " . implode(', ', array_map(fn($ext) => get_class($ext), iterator_to_array($environment->getExtensions()))) . "\n";

    $converter = new CommonMarkConverter($config, $environment);
    echo "Создан конвертер CommonMark.\n";

    echo "\n--- Результат конвертации в HTML ---\n";
    echo $converter->convert($markdown)->getContent() . "\n";

} catch (Exception $e) {
    echo "Ошибка: " . $e->getMessage() . "\n";
}

echo "\n--- Тест CommonMark завершен ---\n";
