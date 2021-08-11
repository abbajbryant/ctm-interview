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


// User Opt-In API Routes
$router->get('users', 'UserOptInController@index');
$router->get('users/{user}', 'UserOptInController@show');
$router->post('users', 'UserOptInController@store');
$router->put('users/{user}', 'UserOptInController@update');
$router->patch('users/{user}', 'UserOptInController@update');
$router->delete('users/{user}', 'UserOptInController@destroy');
