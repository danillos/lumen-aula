<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);


interface Authentication
{
    public function authenticate();
}

class FacebookAuthentication implements Authentication
{
    public function authenticate()
    {
        echo 'via facebook';
        // logica de autenticar com facebook
    }
}

class GoogleAuthentication implements Authentication
{
    public function authenticate()
    {
        echo 'via google';
        // logica de autenticar com google
    }
}



class AuthenticationFactory
{
    public static function create($provider)
    {
        $class_name = ucfirst($provider) . 'Authentication';

        if (class_exists($class_name)) {
            return new $class_name();
        }

        throw new Exception("Classe não existe", 1);
    }
}


// http://seusite/login?provider=facebook

$authentication = AuthenticationFactory::create($_GET['provider']);
$authentication->authenticate();
