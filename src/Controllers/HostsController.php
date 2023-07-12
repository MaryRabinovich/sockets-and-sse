<?php

namespace App\Controllers;

use App\Database\HostTable;
use App\SSE\SSEHelpers;
// use RedBeanPHP\R;

class HostsController
{
    protected static array $config = [];

    protected static function setConfig()
    {
        if (! count(self::$config)) {
            self::$config = require_once __DIR__ . '/../../config/hosts_status_api.php';
        }
    }

    public static function index($params)
    {
        self::setConfig();

        SSEHelpers::addHeaders();
        
        $counter = 0;
        while (self::$config['iterations'] === 0 || $counter < self::$config['iterations']) {
            $counter++;

            $json = json_encode(HostTable::getLastResults());
            echo "data: $json \n\n";

            SSEHelpers::sendBlock(self::$config['interval']);
        }

        SSEHelpers::closeConnection(self::$config['endline']);
    }

    // public static function show($params)
    // {
        // echo 'show', '<br>';
        // var_dump($params);
    // }
}
