<?php

namespace App\Sockets\ResultsRegistrators;

class SimpleRegistrator implements ResultsRegistratorInterface
{
    public function register(string $host, ?string $result = null): void
    {
        echo $host, ' ', $result, PHP_EOL;
    }
}
