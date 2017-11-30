<?php
declare(strict_types=1);

require_once  __DIR__ . '/../router.php';

use PHPUnit\Framework\TestCase;

/**
* @covers Router
*/
final class RouterTest extends TestCase
{
    public function testAddSeveralRoutesOfDifferentHttpMethods()
    {
        $router = new Router();
        $router->add_route('GET', '/', function(){
            return "this is the root";
        });
        $router->add_route('POST', '/user/:id/article', function($id){
            return "saving the article linked to the user id: " . $id;
        });
        $router->add_route('PUT', '/update/:id', function($id){
            return "updating the article id: " . $id;
        });
        // we check the second one cause the first one is the /routes default route
        $this->assertEquals($router->routes['GET'][1]->path, '/');
        $this->assertEquals($router->routes['POST'][0]->path, '/user/:id/article');
        $this->assertEquals($router->routes['PUT'][0]->path, '/update/:id');
    }

    public function testMatchAndExecSeveralMethods()
    {
        $router = new Router();
        $router->add_route('GET', '/', function(){
            return "this is the root";
        });
        $router->add_route('POST', '/user/:id/article', function($id){
            return "saving the article linked to the user id: " . $id;
        });
        $router->add_route('PUT', '/user/:user_id/update/:id', function($id, $user_id){
            return "updating the article id: " . $id . " linked to user " . $user_id;
        });

        $this->assertEquals("this is the root", $router->match_and_exec('GET', '/'));
        $this->assertFalse($router->match_and_exec('POST', '/'));

        $this->assertEquals("saving the article linked to the user id: 12", $router->match_and_exec('POST', '/user/12/article'));
        $this->assertEquals("updating the article id: 12 linked to user 42", $router->match_and_exec('PUT', '/user/12/update/42'));
    }

    public function testMatchAndExecSeveralRoutes()
    {
        $router = new Router();
        $router->add_route('GET', '/', function(){
            return "this is the root";
        });
        $router->add_route('GET', '/user/:id/article', function($id){
            return "saving the article linked to the user id: " . $id;
        });
        $router->add_route('GET', '/user/:user_id/update/:id', function($id, $user_id){
            return "updating the article id: " . $id . " linked to user " . $user_id;
        });

        $this->assertEquals("this is the root", $router->match_and_exec('GET', '/'));
        $this->assertFalse($router->match_and_exec('POST', '/'));

        $this->assertEquals("saving the article linked to the user id: 12", $router->match_and_exec('GET', '/user/12/article'));
        $this->assertEquals("updating the article id: 12 linked to user 42", $router->match_and_exec('GET', '/user/12/update/42'));
    }

}