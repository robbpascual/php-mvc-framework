<?php

class Pages extends Controller
{
    public function __construct()
    {

    }

    public function index()
    {
        $data = array(
            'title' => 'This is Home Page'
        );

        $this->view('pages/index', $data);
    }

    public function about()
    {
        $data = array(
            
        );
        
        $this->view('pages/about', $data);
    }

    public function pageNotFound()
    {
        echo 'Page not found';
    }
}
?>