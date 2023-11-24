<?php

namespace Controller;

class Router extends AbstractRouter
{
    public function __construct($root_dir)
    {
        if (empty($this->routes)) {
            $this->routes['/'] = '\Controller\LoginResponse->execute';
        }
        $this->root_dir = $root_dir;
    }


    public function route()
    {
        $errorHandler = new ErrorHandler(E_ALL); //set error handler
        // Get URL and Method
        $url = $_SERVER['REQUEST_URI'] ?? '/';
        $method = $_SERVER['REQUEST_METHOD'];

        $token = '';
        if ($method === 'GET') {
            $params = $_GET;
        } else {
            $params = $_POST;
        }

        // Extracting path from the URL
        $pathParts = parse_url($url);
        $path = trim($pathParts['path'], '/');

        // Check if user param is set
        if (isset($params['user'])) {
            $token = $params['user'];
            $req = pathinfo($url);
            $path = $req['filename'];
        } else {
            $req = pathinfo($url);
            $path = $req['filename'];
        }
        if ($path == $this->root_dir) {
            $path = '/';
        }
        $path = strtolower($path);

        // Removes .php from path if it is there
        if (preg_match('/.php/', $path)) {
            $path = preg_replace('/\.php$/', '', $path);
        }


        $api = new WebAPI();

        $handler = $this->routes[$path];
        list($responseName, $methodName) = explode('->', $handler);

        // If token is verified pass token to response
        if ($api->verifyToken($token)) {
            if (class_exists($responseName)) {
                $response = new $responseName();

                if (method_exists($response, $methodName)) {
                    $response->$methodName($token);
                } else {
                    echo "Method does not exist: $methodName";
                    trigger_error("Method does not exist: $methodName");
                }
            } else {
                echo "Class does not exist: $responseName";
                trigger_error("Class does not exist: $responseName");
            }
        } else { //Don't pass token
            if (class_exists($responseName)) {
                $response = new $responseName();

                if (method_exists($response, $methodName)) {
                    $response->$methodName();
                } else {
                    echo "Method does not exist: $methodName";
                    trigger_error("Method does not exist: $methodName");
                }
            } else {
                echo "Class does not exist: $responseName";
                trigger_error("Class does not exist: $responseName");
            }
        }
    }
}
