<?php

namespace App\Database;

use RedBeanPHP\R;

class HostTable
{
    public static function getLastResults(): array
    {
        $hosts = R::findAll('host');
        
        // ПОХОЖЕ, СТАТИЧЕСКИЙ ЭР ЗАПОМИНАЕТ СОСТОЯНИЕ И НЕ ОБНОВЛЯЕТСЯ. КАК ЕМУ СДЕЛАТЬ РЕФРЕШ?
        // $results = R::findAll('result', 'order by id desc limit ?', [2 * count($hosts)]);
        // (для экономии времени пока что добавим класс PDOHelpers 
        // и инициализируем его в том же bootstrap/database.php, что и RedBeanPHP)

        $doubleCount = count($hosts) * 2;
        $sql = "SELECT host_id, result FROM result ORDER BY id DESC limit $doubleCount";
        $results = PDOHelpers::queryFetchAllAssoc($sql);

        foreach ($results as $result) {
            $hosts[$result['host_id']]['result'] = $result['result'];
        }

        return $hosts;
    }
}
