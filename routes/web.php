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

    $router->get('/city', 'CityController@index');
    $router->post('/city', 'CityController@store');
    $router->put('/city/{id}', 'CityController@update');
    $router->delete('/city/{id}', 'CityController@destroy');

    $router->get('/country', 'CountryController@index');
    $router->post('/country', 'CountryController@store');
    $router->put('/country/{id}', 'CountryController@update');
    $router->delete('/country/{id}', 'CountryController@destroy');
});
