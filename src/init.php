<?php
    // Configuration Files
    define('CONFIG', require_once '../config/config.php'); // Database Conifg
    define('SRCROOT', dirname(__FILE__)); // Source Root
    define('URLROOT',  'http://localhost/php-mvc'); // URL Root
    // define('URLROOT', dirname($_SERVER['PHP_SELF']); same as above
    define('SITENAME', 'PHP-MVC'); // Site Name
    define('APPVERSION', '1.0.0'); // App Version

    // Autoload Core Librariess
    spl_autoload_register(
        function($className)
        {
            require_once 'libs/' . $className . '.php';
        }
    );
?>