<?php

namespace App\Sockets\ResultsRegistrators;

use RedBeanPHP\R;

class DatabaseRegistrator implements ResultsRegistratorInterface
{
    public function register(string $hostName, ?string $result = null): void
    {
        $hostBean = R::findOne('host', 'name = ?', [$hostName]);
        echo $hostBean->id, ' ', $hostName, ' ', $result, PHP_EOL;

        $resultBean = R::dispense('result');
        $resultBean->result = $result;
        $resultBean->created_at = new \DateTime('now');
        $hostBean->ownProductList[] = $resultBean;
        R::store($hostBean);
        // $resultBean->host_id

    }
}
