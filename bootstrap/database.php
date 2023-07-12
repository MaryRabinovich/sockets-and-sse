<?php

use App\Database\PDOHelpers;
use RedBeanPHP\R;

require_once __DIR__ . '/../vendor/autoload.php';

$config = require_once __DIR__ . '/../config/database.php';
$dsn = "mysql:host={$config['host']};dbname={$config['dbname']}";

R::setup($dsn, $config['user'], $config['password']);

PDOHelpers::setConnection($dsn, $config['user'], $config['password']);