<?php

namespace Controller;

/**
 * Router Interface
 *
 * This interface defines methods for routing within the MVP framework's controller module.
 */
interface InterfaceRouter
{
    /**
     * Add Route
     *
     * Adds a route to the router, associating it with a callable function or handler.
     * The $route parameter should be a string in the format 'Class{separator}Function'
     * where {separator} is a character used to separate the class and function names.
     *
     * Example: 'HomeController@index'
     *
     * @param string   $route    The route pattern to match, in the format 'Class{separator}Function'.
     * @param string $function The function or handler to be executed when the route is matched.
     */
    public function addRoute(string $route, string $function);
    /**
     * Route
     *
     * Matches the current request URI against registered routes and executes the associated function.
     * This method is typically called after adding routes using `addRoute`.
     */
    public function route();
    /**
     * Remove Route
     *
     * Removes a route from the router based on its pattern.
     *
     * @param string $route The route pattern to be removed.
     */
    public function removeRoute($route);
  
}
