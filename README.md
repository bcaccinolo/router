
## How to test it

```bash
php -S localhost:3000
```
Navigate to http://localhost:3000/

## View all the defined routes

This url http://localhost:3000/routes will list all the existing routes.
It is interessant to have this overview when debugging your routes.

## How to use it ?

Here is an example showing how to defie routes.

```php
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
```

## Launch tests

  ```bash
  ./vendor/bin/phpunit tests
  ```

