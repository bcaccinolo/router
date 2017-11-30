<?php
declare(strict_types=1);

require_once  __DIR__ . '/../route.php';

use PHPUnit\Framework\TestCase;

/**
* @covers Route
*/
final class RouteTest extends TestCase
{
    public function testMatchForSimpleUrl()
    {
        $route = new GET('/', function(){
            return "get root";
        });

        $this->assertFalse(is_array($route->match('/not-good')));
        $this->assertFalse($route->match('/user/12/article'));
        $this->assertTrue(is_array($route->match('/')));
    }

    public function testMatchForSimpleUrl2()
    {
        $route = new GET('/about', function(){
            return "get about page";
        });

        $this->assertFalse($route->match('/not-good'));
        $this->assertTrue(is_array($route->match('/about')));
    }

    public function testMatchWithParameter()
    {
        $route = new GET('/user/:id', function(){
            return "get user";
        });

        $this->assertFalse($route->match('/user'));
        $this->assertFalse($route->match('/user/12/edit'));

        $this->assertTrue(is_array($route->match('/user/12')));
        $this->assertEquals($route->match('/user/12'), ['12']);
    }

    public function testMatchWith2Parameters()
    {
        $route = new GET('/user/:id/book/:book_id', function(){
            return "get user";
        });

        $this->assertFalse($route->match('/user/book/12'));
        $this->assertFalse($route->match('/user/12/edit'));

        $this->assertTrue(is_array($route->match('/user/12/book/42')));
        $this->assertEquals($route->match('/user/12/book/42'), ['12', '42']);
    }

    public function testCallTheFunctionWithoutParameter()
    {
        $route = new GET('/user/:id/book/:book_id', function(){
            return "get user book";
        });

        $this->assertEquals($route->call([]), "get user book");
    }

    public function testCallTheFunctionWithParameters()
    {
        $route = new GET('/user/:id/book/:book_id', function($id, $book_id) {
            return "get user " . $id . " book " . $book_id;
        });
        $params_from_url = $route->match('/user/12/book/42');

        $this->assertEquals($route->call($params_from_url), "get user 12 book 42");
    }

}
