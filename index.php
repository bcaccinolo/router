<?php
//
// MINI ROUTER
//

require('router.php');

$router = new Router();

$router->add_route('GET', '/', function(){
    return "this is the root";
});

$router->add_route('GET', '/user/:id/article', function($id){
    return "saving the article linked to the user id: " . $id;
});

$router->add_route('GET', '/update/:id', function($id){
    return "updating the article id: " . $id;
});

$router->add_route('PUT', '/update/:id', function($id){
    return "updating the article id: " . $id;
});

$router->listen();
