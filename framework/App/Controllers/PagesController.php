<?php namespace App\Controllers;

use \Framework\View;
use \App\Models\Todos;

class PagesController
{
    public function index()
    {
        $todos = Todos::all();

        $params = array(
            'page_title' => 'Todo App',
            'todos' => $todos
        );

        return View::make('pages/index', $params, 'layouts/default');
    }

    public function create()
    {
        Todos::create($_POST['todos']);
        header('Location: ' . APP_URL);
    }

    public function about()
    {
        $params = array(
            'page_title' => 'Todo App - About'
        );

        return View::make('pages/about', $params, 'layouts/default');
    }

    public function contacts()
    {
        echo 'contato';
    }
}
