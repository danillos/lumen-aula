<?php namespace App\Controllers;

use \Framework\View;
use \App\Models\Todos;

class PagesController
{
    public function index()
    {
        $todos_model = new Todos();

        $params = array(
            'page_title' => 'Todo App',
            'todos' => $todos_model->getAll()
        );

        return View::make('pages/index', $params, 'layouts/default');
    }

    public function create()
    {
        $todos_model = new Todos();
        $todos_model->title = $_POST['title'];
        $todos_model->save();
        sleep(4);
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
