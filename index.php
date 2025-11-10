<?php
$root = str_replace('\\', '/', __DIR__);
$publicDir = $root . '/public';
$uri = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);
$scriptName = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
$basePath = rtrim($scriptName, '/');

if ($basePath && strpos($uri, $basePath) === 0) {
    $uri = substr($uri, strlen($basePath));
}

$uri = ltrim($uri, '/');

if (strpos($uri, 'index.php/') === 0) {
    $uri = substr($uri, strlen('index.php/'));
} elseif ($uri === 'index.php') {
    $uri = '';
}

if ($uri !== '') {
    $_GET['url'] = $uri;
}

require $publicDir . '/index.php';
