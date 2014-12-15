<?php

function my_autoloader($class)
{

    $file_name = str_replace('\\', '/', $class);
    $file_name = str_replace('Lumen/', '', $file_name);

    $file_name =  $file_name . '.php';

    if (file_exists($file_name)) {
        require $file_name;
    }

}

spl_autoload_register('my_autoloader');
