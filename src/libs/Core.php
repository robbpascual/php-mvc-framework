<?php
/**
 * Core Class
 * Creates URL & loads core controller
 * URL Format - controller/method/params
 *  url[0] = controller
 *  url[1] = method
 *  url[2] = params
 */
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

    // create an array from the URL
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
        
        // Check if the URL is null or empty
        if(is_null($this->url)) {
            require_once $this->controllerPath . $this->controller . '.php';

            $this->controller = new $this->controller;

        // Look in controllers for the first value - url[0]
        } elseif(file_exists($file)) {
            // If exists, set url[0] as the controller 
            $this->controller = ucwords($url[0]);
            // Unset 0 index
            unset($url[0]);
            $this->url = $url;

            // Require the controller
            require_once $file;

            // Instantiate the controller
            $this->controller = new $this->controller;
        } else {
            // if the file does not exists, load 404 file
            $this->pageNotFound();
        }
    }

    private function callMethod($url)
    {
        // Check if the method is not pageNotFound
        if($this->method != 'pageNotFound') {

            // Check for the second part of the url or index 1
            if(ISSET($url[1])) {
                // Check if the method exists in the controller
                if(method_exists($this->controller, $url[1])) {
                    // Set method to index 1
                    $this->method = $url[1];
                    // Unset Index 1
                    unset($url[1]);

                    $this->url = $url;
                } else {

                    // If the method does not exits in the controller, load 404 file
                    $this->method = 'pageNotFound';
                }
            }
        }
    }

    private function pageNotFound()
    {
        // Set method to pageNotFound or 404 error
        $this->method = 'pageNotFound';

        // Require the method
        require_once $this->controllerPath . $this->controller . '.php';

        // Instantiate the method of pageNotFound or 404 error
        $this->controller = new $this->controller;
    }
}
?>