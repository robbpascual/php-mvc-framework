<?php

class Pages
{
    public function __construct()
    {

    }

    public function index()
    {
        echo 'This is index';
    }

    public function about($id = '')
    {
        echo "THIS IS ECHO <br>";
        echo $id;
    }

    public function pageNotFound()
    {
        echo 'Page not found';
    }
}
?>