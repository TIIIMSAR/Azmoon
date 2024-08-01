<?php

/** @var \Laravel\Lumen\Routing\Router $router */

use App\Http\Controllers\V1\UserController;

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
    
$router->group(['prefix' => 'api/v1'], function () use ($router){
    $router->group(['prefix' => 'users'], function () use ($router){
        $router->post('', 'V1\UserController@store');
        $router->put('', 'V1\UserController@updateInfo');
        $router->put('change-password', 'V1\UserController@updatePassword');
        $router->delete('', 'V1\UserController@delete');
        $router->get('', 'V1\UserController@index');
    });
});