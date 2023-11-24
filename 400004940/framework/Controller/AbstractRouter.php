<?php

namespace Controller;

/**
 * Abstract Router Class
 *
 * This abstract class provides a basic implementation of the RouterInterface
 * for routing within the MVP framework's controller module. //from slides remove??
 */
abstract class AbstractRouter implements InterfaceRouter
{
    /**
     * @var array Associative array to store registered routes and their associated functions.
     */
    protected $routes = [];
    /**
     * @var string The root directory of the web application
     */
    protected $root_dir = '';

    public function addRoute($route, $function)
    {
        $this->routes[$route] = $function;
    }
    public function removeRoute($route)
    {
        if (isset($this->routes[$route])) {
            unset($this->routes[$route]);
        }
    }

    abstract public function route();

}
