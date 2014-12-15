<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);


class Str
{
    public static function uppercase($string)
    {
        return static::x(strtoupper($string));
    }

    public static function x($string)
    {
        return $string . 'xxx';
    }
}



echo Str::uppercase('a');



class Usuario
{
    public static $idade = 10;

    public function imprimirIdade()
    {
        echo static::$idade;
    }

    public function idade($idade)
    {
        static::$idade = $idade;
    }
}

$usuario = new Usuario();

$usuario->idade(1);

$usuario->imprimirIdade();

$usuario2 = new Usuario();

$usuario->idade(2);

$usuario2->imprimirIdade();

$usuario->imprimirIdade();



class Produto
{
    const TAXA = 10;

    const MOVEL = 1;
    const ELETRONICO = 2;
}

echo Produto::TAXA;


$sql = 'SELECT * FROM produtos WHERE tipo = ' . Produto::MOVEL;
