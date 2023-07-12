<?php

namespace App\Sockets;

use Socket;

class Connection
{
    protected Socket $socket;

    public function __construct(protected string $host)
    {
        $this->socket = socket_create(AF_INET, SOCK_RAW, getprotobyname('icmp'));
        socket_set_option($this->socket, SOL_SOCKET, SO_RCVTIMEO, array('sec' => 1, 'usec' => 0));
        socket_connect($this->socket, $this->host, 0);
        echo $this->host, ' socket is connected', PHP_EOL;
    }

    public function check(): ?float
    {
        $package = "\x08\x00\x19\x2f\x00\x00\x00\x00\x70\x69\x6e\x67";
        socket_send($this->socket, $package, strlen($package), 0);
        $startTime = microtime(true);
        if (socket_read($this->socket, 255)) {
            return microtime(true) - $startTime;
        }
        return null;
    }

    public function __destruct()
    {
        socket_close($this->socket);
        echo $this->host, ' socket is closed', PHP_EOL;
    }
}
