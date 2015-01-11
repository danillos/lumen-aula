<? namespace Framework;

class View
{
    private $view_name;
    private $params;
    private $layout;

    public function __construct($view_name, $params = array(), $layout = null)
    {
        $this->view_name = $view_name;
        $this->params = $params;
        $this->layout = $layout;
    }

    public static function make($view_name, $params = array(), $layout = null)
    {
        return new View($view_name, $params, $layout);
    }

    public function __toString()
    {
        return $this->build();
    }

    public static function render($response)
    {
        if ( is_array($response) ) {
            header('Content-Type: application/json');
            $response = json_encode($response);
        }

        echo $response;
    }

    private function build()
    {
        extract($this->params);

        ob_start();
        include(APP_PATH . '/App/Views/' . $this->view_name . '.php');
        $html = ob_get_contents();
        ob_end_clean();

        // if ( !isset($shared_params) ) {
        //     $shared_params = array();
        // }

        // $shared = compact('shared_params');

        if ( !is_null($this->layout) ) {
            $this->params['content'] = $html;
            // $this->params = array_merge($this->params, $shared);
            $html = View::make($this->layout, $this->params);
            $html = $html->build();
        }

        return $html;
    }
}
