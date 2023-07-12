<?php

namespace App\Database;

use PDO;
use PDOStatement;

class PDOHelpers
{
    public static ?PDO $pdo;

    public static function setConnection($dsn, $user, $password)
    {
        self::$pdo = new PDO($dsn, $user, $password);
    }

    public static function query(string $sql): PDOStatement
    {
        return self::$pdo->query($sql);
    }

    public static function queryFetchAllAssoc(string $sql): array
    {
        $stmt = self::query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
