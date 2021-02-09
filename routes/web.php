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
$router->get('/key', function() {
    return \Illuminate\Support\Str::random(32);
});


// -----------------------------------------
// AUTH and USER CONTROL
// -----------------------------------------
$router->post('/register',             'UserController@register');
$router->post('/login',                'UserController@login');
$router->get('/login',                 ['uses' => 'UserController@loginVerify', 'middleware' => 'auth']);

$router->get('/user',                  ['uses' => 'UserController@getUser', 'middleware' => 'auth']);
$router->get('/user/{id}',                  ['uses' => 'UserController@detailUser', 'middleware' => 'auth']);
$router->post('/user',                  ['uses' => 'UserController@insertUser', 'middleware' => 'auth']);
$router->put('/user',                   ['uses' => 'UserController@updateUser', 'middleware' => 'auth']);
$router->delete('/user/{id}',                ['uses' => 'UserController@deleteUser', 'middleware' => 'auth']);


// -----------------------------------------
// PERSONAL PROFILE
// -----------------------------------------
$router->get('/profil',                  ['uses' => 'ProfilController@getProfil', 'middleware' => 'auth']);
$router->get('/profil/{id}',              ['uses' => 'ProfilController@detailProfil', 'middleware' => 'auth']);
$router->post('/profil',                  ['uses' => 'ProfilController@insertProfil', 'middleware' => 'auth']);
$router->put('/profil',                   ['uses' => 'ProfilController@updateProfil', 'middleware' => 'auth']);
$router->delete('/profil/{id}',                ['uses' => 'ProfilController@deleteProfil', 'middleware' => 'auth']);