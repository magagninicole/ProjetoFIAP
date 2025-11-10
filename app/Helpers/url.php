<?php

//Redirecionamento de url
if (!function_exists('url')) {
    function url(string $path = ''): string {
        $path = ltrim($path, '/');
        $base = defined('BASE_URL') ? rtrim(BASE_URL, '/') : '';
        return $base . '/index.php/' . $path;
    }
}

//Inclusão de assets 
if (!function_exists('asset')) {
    function asset(string $path = ''): string {
        $path = ltrim($path, '/');
        $scriptName = str_replace('\\', '/', $_SERVER['SCRIPT_NAME']); 
        $publicDir = rtrim(str_replace('index.php', '', $scriptName), '/'); 
        return $publicDir . '/public/assets/' . $path;
    }
}
