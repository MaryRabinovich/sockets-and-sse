<?php

use RedBeanPHP\R;

if (PHP_SAPI !== 'cli') {
    die ('<h1>Низя так</h1>');
}

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../bootstrap/database.php';

$hostName = $argv[1];

echo PHP_EOL;

$alreadyAdded = R::find('host', 'name = ?', [$hostName]);
if (count($alreadyAdded)) {
    echo "Хост с именем $hostName был добавлен ранее", PHP_EOL;
} else {
    $host = R::dispense('host');
    $host->name = $hostName;
    $id = R::store($host);
    echo "Добавлен хост $hostName (ID = $id)", PHP_EOL;
}

echo PHP_EOL, 'Все хосты:', PHP_EOL;
foreach (R::find('host') as $host) {
    echo "$host->id: $host->name", PHP_EOL;
}

echo PHP_EOL;
