<?php

namespace App\Core;

use Exception;

class Controller {
    
    protected function model($model) {
        require_once BASE_PATH . '/app/models/' . $model . '.php';
        $modelName = 'App\Models\\' . $model;
        return new $modelName();
    }

    protected function view($view, $data = []) {
        extract($data);
        $path = BASE_PATH . '/app/views/' . $view . '.php';
        if (file_exists($path)) {
            require_once $path;
        } else {
            throw new Exception("View file not found: " . $path);
        }
    }
    
}
