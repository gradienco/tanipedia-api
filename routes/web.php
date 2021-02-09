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


// -----------------------------------------
// USER CONTROLLER
// -----------------------------------------
$router->post('/register',             'UserController@register');
$router->post('/login',                'UserController@login');
$router->get('/login',                 ['uses' => 'UserController@loginVerify', 'middleware' => 'auth']);
$router->get('/user',                  ['uses' => 'UserController@user', 'middleware' => 'auth']);
$router->put('/user/password',         ['uses' => 'UserController@editPassword', 'middleware' => 'auth']);

