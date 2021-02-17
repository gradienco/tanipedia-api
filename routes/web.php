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
// SYSTEM and CONFIG
// -----------------------------------------
$router->get('/master',                  'ConfigController@getMaster');
$router->post('/attachment',              ['uses' => 'ConfigController@insertAttachment', 'middleware' => 'auth']);

// -----------------------------------------
// PERSONAL PROFILE
// -----------------------------------------
$router->get('/profil',                  ['uses' => 'ProfilController@getProfil', 'middleware' => 'auth']);
$router->get('/profil/{id}',              ['uses' => 'ProfilController@detailProfil', 'middleware' => 'auth']);
$router->post('/profil',                  ['uses' => 'ProfilController@insertProfil', 'middleware' => 'auth']);
$router->put('/profil',                   ['uses' => 'ProfilController@updateProfil', 'middleware' => 'auth']);
$router->put('/profil/image',             ['uses' => 'ProfilController@updateImage', 'middleware' => 'auth']);
$router->delete('/profil/{id}',           ['uses' => 'ProfilController@deleteProfil', 'middleware' => 'auth']);

// -----------------------------------------
// MANAGEMENT PUPUK
// -----------------------------------------
$router->get('/jadwal-pupuk',                  ['uses' => 'JadwalPupukController@getJadwalPupuk', 'middleware' => 'auth']);
$router->get('/jadwal-pupuk/{id}',              ['uses' => 'JadwalPupukController@detailJadwalPupuk', 'middleware' => 'auth']);
$router->post('/jadwal-pupuk',                  ['uses' => 'JadwalPupukController@insertJadwalPupuk', 'middleware' => 'auth']);
$router->put('/jadwal-pupuk',                   ['uses' => 'JadwalPupukController@updateJadwalPupuk', 'middleware' => 'auth']);
$router->delete('/jadwal-pupuk/{id}',                ['uses' => 'JadwalPupukController@deleteJadwalPupuk', 'middleware' => 'auth']);

// -----------------------------------------
// LAHAN PERTANIAN
// -----------------------------------------
$router->get('/lahan',                  ['uses' => 'LahanController@getLahan', 'middleware' => 'auth']);
$router->get('/lahan/{id}',              ['uses' => 'LahanController@detailLahan', 'middleware' => 'auth']);
$router->post('/lahan',                  ['uses' => 'LahanController@insertLahan', 'middleware' => 'auth']);
$router->put('/lahan',                   ['uses' => 'LahanController@updateLahan', 'middleware' => 'auth']);
$router->delete('/lahan/{id}',           ['uses' => 'LahanController@deleteLahan', 'middleware' => 'auth']);
