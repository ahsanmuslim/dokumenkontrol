<?php

use Dotenv\Dotenv;
use Teckindo\DokumenKontrol\App\Router;

require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__ . '/../routes/web.php';

date_default_timezone_set('Asia/Jakarta');

if (!session_id()){
    session_start();
}

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$url = $_ENV['APP_URL'];
define('BASEURL',"$url");
define('APP_NAME', 'Document Control');

Router::run();
