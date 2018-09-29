<?php

class Pages extends Controller
{
    public function __construct()
    {

    }

    public function index()
    {
        $data = array();

        $this->view('index', $data);
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