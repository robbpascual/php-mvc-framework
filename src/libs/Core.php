<?php
class Core
{
    protected $controller = '';
    protected $method = 'index';
    protected $params = [];

    public function __construct()
    {
        echo 'hello';
    }

    public function parseURL()
    {
    }
}
?>