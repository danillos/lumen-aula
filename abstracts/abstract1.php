<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

interface Combustivel {
    public function pegaEnergia();
}

class Gasolina implements Combustivel
{
    public $litro = 2;

    public function __construct($quantidade)
    {
        $this->quantidade = $quantidade;
    }
    public function pegaEnergia()
    {
        return $this->quantidade * $this->litro;
    }
}

abstract class Automovel
{
    abstract public function ligar(Chave $chave);

    public function encherTanque(Combustivel $combustivel) {
        $this->energia += $combustivel->pegaEnergia();
    }
}

class Carro extends Automovel
{
    public function ligar(Chave $chave)
    {
        $chave->girar();
    }
}

class Mobilete extends Automovel
{
    public function ligar(Chave $chave)
    {
        $chave->girar();
        $this->pedalar();
    }

    private function pedalar()
    {

    }
}


$carro = new Carro();

$carro->encherTanque();
