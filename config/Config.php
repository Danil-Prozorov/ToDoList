<?php

namespace Config;

class Config
{
    public function getConfig(): array
    {
        return [
            'general' => [
                'HOST' => $_ENV['HOST'],
            ],
            'database' => [
                'DB_HOST' => $_ENV['DATABASE_HOST'],
                'DB_TYPE' => $_ENV['DATABASE_TYPE'],
                'DB_NAME' => $_ENV['DATABASE_NAME'],
                'DB_USER' => $_ENV['DATABASE_USER'],
                'DB_PASS' => $_ENV['DATABASE_PASS'],
                'DB_PORT' => $_ENV['DATABASE_PORT'],
                'charset' => 'utf8_general_ci',
            ],

            'redis' => [

            ]
        ];
    }
}
