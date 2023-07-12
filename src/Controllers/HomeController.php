<?php

namespace App\Controllers;

class HomeController
{
    public static function index(array $params)
    {
        $frontend = file_get_contents(__DIR__ . '/../../templates/index.html');

        $config = require_once __DIR__ . '/../../config/hosts_status_api.php';

        $frontend = sprintf($frontend, $config['endline']);

        echo $frontend;
    }
}
