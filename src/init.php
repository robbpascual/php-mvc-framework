<?php

// Autoload Core Librariess
spl_autoload_register(
    function($className)
    {
        require_once 'libs/' . $className . '.php';
    }
);
?>