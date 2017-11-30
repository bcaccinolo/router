

## Todo

 - DONE pouvoir lancer tous les tests d'un coup.

 - DONE faire une passe sur les commentaires.

 - publier sur github.

  - préparer un article de blog pour cela en utilisant les buzz words.

## How to test

```bash
php -S localhost:3000
```
Navigate to http://localhost:3000/

## View all the defined routes

Navigate to http://localhost:3000/routes

# How to use it ?

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

