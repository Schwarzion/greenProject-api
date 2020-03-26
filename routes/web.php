<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
 */

 //return home dasboard view
$router->group(['prefix' => 'dashboard'], function () use ($router) {
    $router->get('home', [
        'as' => 'home', 'uses' => 'HomeController@index',
    ]);
    $router->get('quests', [
        'as' => 'quests', 'uses' => 'QuestController@index',
    ]);
    $router->get('tips', [
        'as' => 'tips', 'uses' => 'TipController@index',
    ]);
    $router->get('users', [
        'as' => 'users', 'uses' => 'UserController@index',
    ]);
    $router->get('stats', [
        'as' => 'users', 'uses' => 'StatsController@index',
    ]);
});
