<?php

namespace App\Sockets;

use App\Sockets\ResultsRegistrators\ResultsRegistratorInterface;

class ConnectionsManager
{
    protected array $connections = [];

    public function __construct(protected ResultsRegistratorInterface $r) {}

    public function add(string $host): void
    {
        $this->connections[$host] = new Connection($host);
    }

    public function check(): void
    {
        foreach ($this->connections as $host => $connection) {
            $result = $connection->check();
            $this->r->register($host, $result);
        }
    }
}
