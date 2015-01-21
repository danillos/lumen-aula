<?php namespace Framework;

class App
{
    public function run()
    {
        require APP_PATH . '/App/Configs/routes.php';
        require APP_PATH . '/App/Configs/database.php';

        $router = new Router($routes, $_SERVER);

        if ( !$router->exists() ) {

             return View::render('404');

        }

        $route_data = $router->getRoute();

        $response = $this->dispatchControllerAction($route_data);
        View::render($response);
    }

    private function dispatchControllerAction($route_data)
    {
        $controller_name = $this->getControllerName($route_data);
        $action_name = $this->getActionName($route_data);

        $controller = new $controller_name();

        return $controller->$action_name();
    }

    private function getControllerName($data)
    {
        $controller = explode('@', $data);
        return '\\App\\Controllers\\' . $controller[0];
    }

    private function getActionName($data)
    {
        $action = explode('@', $data);
        return $action[1];
    }
}
