<?php
class Core
{
    protected $controllerPath = '../src/controllers/';
    protected $controller     = 'Pages';
    protected $method         = 'index';
    protected $params         = [];
    protected $url            = null;

    public function __construct()
    {
        $this->parseURL();
        $this->callController($this->url);
        $this->callMethod($this->url);

        $this->params =  $this->url ? array_values($this->url) : [];
        
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    private function parseURL()
    {
        if(ISSET($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            $this->url = $url;
        }
    }

    private function callController($url)
    {
        $file = $this->controllerPath . ucwords($url[0]) . '.php';
  
        if(is_null($this->url)) {
            require_once $this->controllerPath . $this->controller . '.php';

            $this->controller = new $this->controller;
        } elseif(file_exists($file)) {
            $this->controller = ucwords($url[0]);
            unset($url[0]);
            $this->url = $url;

            require_once $file;

            $this->controller = new $this->controller;
        } else {
            $this->pageNotFound();
        }
    }

    private function callMethod($url)
    {
        if($this->method != 'pageNotFound') {
            if(ISSET($url[1])) {
                if(method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);

                $this->url = $url;
                } else {
                    $this->method = 'pageNotFound';
                }
            }
        }
    }

    private function pageNotFound()
    {
        $this->method = 'pageNotFound';

        require_once $this->controllerPath . $this->controller . '.php';
        $this->controller = new $this->controller;
    }
}
?>