<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require 'vendor/autoload.php';

$tomorrow =  \Carbon\Carbon::now()->addDay();
echo $tomorrow;

new \Lumen\Projeto\Application();
new \Lumen\Projeto\Models\User();

new \Danillo\Projeto\Application();
new \Danillo\Projeto\Models\User();

?>

<img src="<?= \forxer\Gravatar\Gravatar::image('danillos@gmail.com'); ?>">
