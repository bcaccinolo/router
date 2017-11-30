<?php
require_once("route.php");

class Router {
    var $routes = ['GET' => [], 'PUT' => [], 'POST' => []];

    function __construct()
    {
        $this->add_listing_routes();
    }

    // Add the /routes route
    function add_listing_routes()
    {
        $this->add_route('GET', '/routes', function(){
            print "<h1>Routes</h1>";
            foreach($this->routes as $method => $routes) {
                print "<h3>".$method."</h3>";
                print "<ul>";
                foreach ($routes as $route) {
                    print "<li>".$route->path."</li>";
                }
                print "</ul>";
            }
        });
    }

    function add_route($method, $path, $fun)
    {
        switch (trim($method)) {
            case 'GET':
            array_push($this->routes['GET'], new GET($path, $fun));
            break;
            case 'POST':
            array_push($this->routes['POST'], new GET($path, $fun));
            break;
            case 'PUT':
            array_push($this->routes['PUT'], new PUT($path, $fun));
            break;
        }
    }

    // Search for a matching route and execute the related function
    function match_and_exec($method, $path)
    {
        $possible_routes = $this->routes[$method];
        foreach($possible_routes as $route)
        {
            $result = $route->match($path);
            if (is_array($result) == false)
            {
                continue;
            }
            return $route->call($result);
        }
        return false;
    }

    // method listening for the http request
    function listen()
    {
        $method = strtoupper($_SERVER['REQUEST_METHOD']);
        $path = trim($_SERVER['REQUEST_URI']);

        print $this->match_and_exec($method, $path);
    }
}
