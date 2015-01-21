<?
error_reporting(E_ALL);
ini_set('display_errors', 1);

define('APP_PATH', __DIR__);
define('APP_URL', $_SERVER['SCRIPT_NAME']);

require APP_PATH . '/vendor/autoload.php';

$app = new \Framework\App();

$app->run();
