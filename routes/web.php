<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('/ping', ['middleware' => 'auth', function () {
    return 'pong';
}]);

$router->post('/register', 'AuthController@register');
$router->post('/login', 'AuthController@login');
$router->post('/refresh', 'AuthController@refresh');

$router->group(['middleware' => 'auth:api'], function () use ($router) {
    $router->post('/logout', 'AuthController@logout');

    $router->get('/cities', 'CityController@index');
    $router->post('/city', 'CityController@store');
    $router->put('/city/{id}', 'CityController@update');
    $router->delete('/city/{id}', 'CityController@destroy');

    $router->get('/countries', 'CountryController@index');
    $router->post('/country', 'CountryController@store');
    $router->put('/country/{id}', 'CountryController@update');
    $router->delete('/country/{id}', 'CountryController@destroy');

    $router->get('/books', 'BookController@index');
    $router->post('/book', 'BookController@store');
    $router->put('/book/{id}', 'BookController@update');
    $router->delete('/book/{id}', 'BookController@destroy');

    $router->get('/authors', 'AuthorController@index');
    $router->post('/author', 'AuthorController@store');
    $router->put('/author/{id}', 'AuthorController@update');
    $router->delete('/author/{id}', 'AuthorController@destroy');

    $router->get('/reviews', 'ReviewController@index');
    $router->post('/review', 'ReviewController@store');
    $router->put('/review/{id}', 'ReviewController@update');
    $router->delete('/review/{id}', 'ReviewController@destroy');

    $router->get('/languages', 'LanguageController@index');
    $router->post('/language', 'LanguageController@store');
    $router->put('/language/{id}', 'LanguageController@update');
    $router->delete('/language/{id}', 'LanguageController@destroy');

    $router->get('/carts', 'CartController@index');
    $router->post('/cart', 'CartController@store');
    $router->put('/cart/{id}', 'CartController@update');
    $router->delete('/cart/{id}', 'CartController@destroy');

    $router->get('/orders', 'OrderController@index');
    $router->post('/order', 'OrderController@store');
    $router->put('/order/{id}', 'OrderController@update');
    $router->delete('/order/{id}', 'OrderController@destroy');
});
