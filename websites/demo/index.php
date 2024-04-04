<?php

$books = [
    [
        'name' => "Do Androids Dream of Electric Sheep",
        'year' => 1968,
        'author' => 'Philip K. Dick',
        'purchaseUrl' => 'http://example.com'
    ],
    [
        'name' => "The Langoliers",
        'year' => 1990,
        'author' => 'Andy Weir',
        'purchaseUrl' => 'http://example.com'
    ],
];

function filter($items, $fn)
{
    $result = [];

    foreach ($items as $item)
        if ($fn($item))
            $result[] = $item;

    return $result;
}

require 'index.view.php';