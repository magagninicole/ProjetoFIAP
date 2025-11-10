<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../app/Helpers/url.php';
require_once __DIR__ . '/../app/Helpers/auth.php';
require_once __DIR__ . '/../app/Helpers/loadEnv.php';

loadEnv(__DIR__ . '/../.env');

use App\Config\Config;
use App\Core\App;

$scriptName = str_replace('\\', '/', $_SERVER['SCRIPT_NAME']);
$baseUrl = rtrim(str_replace('/index.php', '', $scriptName), '/');
define('BASE_URL', $baseUrl ? $baseUrl . '/' : '/');

Config::init();
$app = new App();