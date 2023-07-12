<?php

use App\Sockets\ConnectionsManager;
use App\Sockets\ResultsRegistrators\DatabaseRegistrator;
use RedBeanPHP\R;

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../bootstrap/database.php';

/** Создаём менеджера сокетов и регистрируем в нём все хосты из таблицы хостов */
$manager = new ConnectionsManager(new DatabaseRegistrator());
foreach (R::find('host') as $host) {
    $manager->add($host->name);
}

/** Ходим по кругу среди сокетов, проверяем их и записываем результаты в таблицу результатов */
$config = require __DIR__ . '/../config/check_hosts.php';

$counter = 0;
while ($config['counter'] === 0 || $counter < $config['counter']) {
    $counter++;
    echo PHP_EOL, "---  NEXT STEP  ---", PHP_EOL;
    $manager->check();
    sleep($config['interval']);
}

echo PHP_EOL;
