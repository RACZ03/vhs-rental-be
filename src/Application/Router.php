<?php

namespace Application;

class Router
{
    private $routes = [];

    public function addRoute($method, $path, $controller, $controllerMethod)
    {
        $this->routes[$method][$path] = ['controller' => $controller, 'method' => $controllerMethod];
    }

    public function handleRequest($method, $uri)
    {
        try {
            foreach ($this->routes[$method] as $route => $handler) {
                $pattern = str_replace('/', '\/', $route);
                $pattern = preg_replace('/\{([^\/]+)\}/', '(?<$1>[^\/]+)', $pattern);
                if (preg_match('/^' . $pattern . '$/', $uri, $matches)) {
                    $controllerName = $handler['controller'];
                    $methodName = $handler['method'];
                    $controller = new $controllerName();
                    
                    // Extract ID from URI if present
                    $id = isset($matches['id']) ? $matches['id'] : null;
                    
                    $response = $controller->{$methodName}($id);
                    
                    header('Content-Type: application/json');

                    $jsonResponse = json_encode($response);

                    echo $jsonResponse;
                    return;
                }
            }
            return false;
        } catch (\Exception $e) {
            $errorMessage = ['error' => $e->getMessage()];
            header('Content-Type: application/json');
            echo json_encode($errorMessage);
        }
    }
}
