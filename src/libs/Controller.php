<?php

class Controller
{
    public function __construct()
    {
        
    }

    public function model($model)
    {
        require_once '..src/models/' . $model . '.php';

        return new $model();
    }

    public function view($view, $data = [])
    {
        $file = '../src/views/' . $view . '.php';
        if(file_exists($file)) {
            require_once $file;
        } else {
            die('View does not Exists');
        }
    }
}
?>