<?php namespace App\Models;

class Todos extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'todos';
    protected $fillable = array('title', 'priority');
    public $timestamps = false;
}
