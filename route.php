<?php

class Route {

    var $path;
    var $fun;

    function __construct($path, Closure $fun)
    {
        $this->path = $path;
        $this->fun = $fun;
    }

    // Returns:
    //  - if it matches, it returns an array with the matching parameters
    //  - it it does not match, it returns false
    function match($path)
    {
        // replacing variables by a variable regexp
        $regexp_path = preg_replace ('#:[a-z-_]+#' , '([a-zA-Z0-9]+)' , $this->path);
        // print("\nInitial path " . $this->path);
        // print("\npath after filtering: " . $regexp_path);

        // searching for variables in the given path
        $result = preg_match('#^'.$regexp_path.'$#', $path, $matches);
        // print("\n>" . $regexp_path . "< >" . $path . "< match result : " . $result);
        // print("\n");

        // removing the first value of the $matches cause it's not a match.
        array_splice($matches, 0, 1);

        if ($result == 1)
        {
            return $matches;
        }
        return false;
    }

    // It calls the method with the given parameters
    function call($params)
    {
        return call_user_func_array($this->fun, $params);
    }
}

// Helper class to create GET routes
class GET extends Route {
    function __construct($path, $fun)
    {
        parent::__construct($path, $fun);
    }
}

// Helper class to create POST routes
class POST extends Route {
    function __construct($path, $fun)
    {
        parent::__construct($path, $fun);
    }
}

// Helper class to create PUT routes
class PUT extends Route {
    function __construct($path, $fun)
    {
        parent::__construct($path, $fun);
    }
}
