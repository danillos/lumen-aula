<?php namespace Framework;

class App
{
    public function run()
    {
        require APP_PATH . '/App/Configs/routes.php';

        $routes = new \Framework\Router($routes, $_SERVER);

        if ($routes->exists()) {

            $route_data = $routes->getRoute();

            $controller_name = $this->getController($route_data);
            $action_name = $this->getAction($route_data);

            $controller = new $controller_name();
            $response = $controller->$action_name();

            View::render($response);

        } else {
            echo '404';
        }
    }

    private function getController($data)
    {
        $controller = explode('@', $data);
        return '\\App\\Controllers\\' . $controller[0];
    }

    private function getAction($data)
    {
        $action = explode('@', $data);
        return $action[1];
    }
}
