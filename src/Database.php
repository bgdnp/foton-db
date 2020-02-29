<?php

namespace Bgdnp\FotonDB;

use PDO;

class Database
{
    protected $pdo;

    public function __construct(...$args)
    {
        if (is_string($args[0])) {
            $this->pdo = new PDO(...$args);
        }

        if (is_array($args[0])) {
            $config = $this->sanitizeConfig($args[0]);

            $dsn = "{$config['driver']}:host={$config['host']};port={$config['port']};dbname={$config['dbname']};charset{$config['charset']}";

            $this->pdo = new PDO($dsn, $config['username'], $config['password'], $config['options']);
        }

        if ($args[0] instanceof PDO) {
            $this->pdo = $args[0];
        }
    }

    private function sanitizeConfig($config)
    {
        $config['host'] = $config['host'] ?? 'localhost';
        $config['port'] = $config['port'] ?? 3306;
        $config['driver'] = $config['driver'] ?? 'mysql';
        $config['charset'] = $config['charset'] ?? 'utf8mb4';
        $config['options'] = $config['options'] ?? null;

        return $config;
    }
}
