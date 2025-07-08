<?php
require 'vendor/autoload.php';

use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\Table\TableExtension;
use League\CommonMark\CommonMarkConverter;

$markdown = <<<EOD
| Col1 | Col2 |
|------|------|
| Val1 | Val2 |
EOD;

$config = [
    'table' => [
        'wrap' => [
            'enabled' => false,
            'tag' => 'div',
            'attributes' => [],
        ],
    ],
];

$environment = new Environment($config);
$environment->addExtension(new TableExtension());
$converter = new CommonMarkConverter($config, $environment);

echo "Loaded extensions: " . implode(', ', array_map(fn($ext) => get_class($ext), iterator_to_array($environment->getExtensions()))) . "\n";
echo $converter->convert($markdown)->getContent();
