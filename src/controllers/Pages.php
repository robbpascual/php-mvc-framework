<?php

class Pages extends Controller
{
    public function __construct()
    {
        // How to use Model
        $this->postModel = $this->model('Post');
    }

    public function index()
    {
        $data = array(
            'title' => 'This is the Home Page'
        );

        $this->view('pages/index', $data);
    }

    public function about()
    {
        $data = array(
            'title' => 'This is the About Page'
        );
        
        $this->view('pages/about', $data);
    }

    public function contact()
    {
        $data = array(
            'title' => 'This is the Contact Page'
        );

        $this->view('pages/contact', $data);
    }

    public function pageNotFound()
    {
        echo 'Page not found';
    }
}
?>