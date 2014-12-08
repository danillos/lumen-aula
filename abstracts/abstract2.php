<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);


abstract class Controller
{
    public function render($html)
    {
        echo $html;
    }
}

interface UserRegistration
{
    public function userRegisterSucccess();
}

class UserModel
{
    public function register($user_data, UserRegistration $listener)
    {
        echo 'inseriu no banco';

        $listener->userRegisterSucccess();

        return true;
    }
}

class UsersController extends Controller implements UserRegistration
{
    public function __construct(UserModel $user_model)
    {
        $this->user_model = $user_model;
    }

    public function registerUser(array $user_data)
    {
        $this->user_model->register($user_data, $this);
    }

    public function userRegisterSucccess()
    {
        $this->render('usuario registrado com sucesso');
    }
}

class BlogController extends Controller
{
    public function index($user_data)
    {
        $this->render('dados do blog');
    }
}


$user_data = array(
    'nome' => 'Danillo'
);

$user_model = new UserModel();

$users_controller = new UsersController($user_model);

$users_controller->registerUser($user_data);
