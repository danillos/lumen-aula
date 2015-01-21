<? namespace Framework;

class Router
{
    private $routes;
    private $server;

    public function __construct($routes, $server)
    {
        $this->routes = $routes;
        $this->server = $server;
    }

    public function exists()
    {
        return !is_null( $this->getRoute() );
    }

    public function getRoute()
    {
        $path = $this->getPath();
        $request_method = $this->getRequestMethod();

        if ( isset($this->routes[$request_method][$path]) ) {
            return $this->routes[$request_method][$path];
        }

        if ( isset($this->routes['GET']['/404']) ) {
           return $this->routes['GET']['/404'];
        }

        return null;
    }

    private function getPath()
    {
        if ( !isset($this->server['PATH_INFO']) ) {
            return '/';
        }

        return $this->server['PATH_INFO'];
    }

    private function getRequestMethod()
    {
        return strtoupper($this->server['REQUEST_METHOD']);
    }
}
