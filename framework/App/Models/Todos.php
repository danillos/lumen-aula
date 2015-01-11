<?php namespace App\Models;

class Todos
{
    public function getAll()
    {
        return array(
            array('title' => 'Arrumar a cama'),
            array('title' => 'Escovar os dentes'),
            array('title' => 'Fazer café da manhã'),
        );
    }

    public function save()
    {
        echo 'salvar';
    }
}
