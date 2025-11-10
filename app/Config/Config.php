<?php
namespace App\Config;


class Config
{
    public static function get($key, $default = null)
    {
        return $_ENV[$key] ?? getenv($key) ?? $default;
    }

    public static array $DB = [
        'host' => '',
        'name' => '',
        'user' => '',
        'pass' => '',
    ];

    public static function init(): void
    {
        self::$DB = [
            'host' => self::get('DB_HOST', 'localhost'),
            'name' => self::get('DB_NAME', 'secretaria_fiap'),
            'user' => self::get('DB_USER', 'root'),
            'pass' => self::get('DB_PASS', ''),
        ];
    }
}
