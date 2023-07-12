<?php

namespace App\SSE;

class SSEHelpers
{
    protected static $streamHeaders = [
        'Cache-Control: no-store',
        'Content-Type: text/event-stream'
    ];

    public static function addHeaders(): void
    {
        foreach (self::$streamHeaders as $header) {
            header($header);
        }
    }

    public static function sendBlock(int $interval): void
    {
        ob_flush();
        flush();
        sleep($interval);
    }

    public static function closeConnection(string $endline): void
    {
        echo "data: $endline\n\n";
        ob_flush();
        flush();
    }
}
