<?

define('APP_PATH', __DIR__);
define('APP_URL', $_SERVER['SCRIPT_NAME']);

require APP_PATH . '/vendor/autoload.php';

$app = new \Framework\App();

$app->run();
