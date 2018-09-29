<?php
/**
 * Base Controller Class
 * Load the model and views
 */

class Controller
{
    // Loads the Models
    public function model($model)
    {
        // Require the model file
        require_once '../src/models/' . $model . '.php';

        // Instantiate the model
        return new $model();
    }

    // Loads the View
    public function view($view, $data = [])
    {
        // The file path
        $file = '../src/views/' . $view . '.php';

        // Check if the file exist
        if(file_exists($file)) {
            // require the View
            require_once $file;
        } else {
            // View does not exixts
            die('View does not Exists');
        }
    }
}
?>