<?php

namespace App\Sockets\ResultsRegistrators;

interface ResultsRegistratorInterface
{
    public function register(string $host, ?string $result = null): void;
}
