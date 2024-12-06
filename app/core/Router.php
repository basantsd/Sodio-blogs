<?php

namespace App\Core;

class Router {
    protected $routes = [];
    protected $middlewares = [];

    

    public function add($route, $action, $middleware = null) {
        $this->routes[$route] = $action;
        if ($middleware) {
            $this->middlewares[$route] = $middleware;
        }
    }

    public function dispatch($url) {
        $url = rtrim($url, '/');
        $url = empty($url) ? '/' : '/'.$url;
        
        foreach ($this->routes as $route => $data) {
            $pattern = preg_replace_callback('/\/{([^}]+)}/', function ($matches) {
                return '/(?P<' . $matches[1] . '>[^/]+)';
            }, $route);
        
            if (preg_match('#^' . $pattern . '$#', $url, $matches)) {
                if (isset($this->middlewares[$route]) && isset($this->middlewares[$route][1])) {
                    if($this->middlewares[$route][1] == 'isAdminAuthenticated'){
                        Middleware::isAdminAuthenticated();
                    }else if($this->middlewares[$route][1] == 'isUserAuthenticated'){
                        Middleware::isUserAuthenticated();
                    }
                }
                return $this->invoke($data, $matches);
            }
        }
        

        http_response_code(404);
        include BASE_PATH . "/app/views/404.php";
    }
    
    protected function invoke($action, $params = []) {
        [$class, $method] = explode('@', $action);
        $class = "App\\Controllers\\" . $class;
        $controller = new $class();

        return $controller->$method($params);
    }
}
