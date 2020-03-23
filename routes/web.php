<?php

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

//Tests purpose
$router->get('/test', function () {
    return response()->json(['msg' => 'hello']);
});

$router->get('/', function () use ($router) {
    return $router->app->version();
});



// API route group
$router->group(['prefix' => 'api'], function () use ($router) {

    //Guest Part of API
    $router->post('register', [
        'as' => 'register', 'uses' => 'UserController@create'
    ]);
    $router->post ('login', [
        'as' => 'login', 'uses' => 'AuthController@login'
    ]);
    
    //Authentified Part of API
    $router->get('profile', [
        'as' => 'profile', 'uses' => 'AuthController@me'
    ]);
 });


