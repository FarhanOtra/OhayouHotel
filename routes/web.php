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

$router->group(['prefix' => 'auth'], function() use($router){
    $router->post('/register', 'AuthController@register');
    $router->post('/login', 'AuthController@login');
});

$router->group(['prefix' => 'api','middleware' => 'auth'], function () use ($router) {
    $router->get('hotelroom', ['uses' => 'HotelRoomController@index']);
    $router->get('hotelroom/{id}',['uses' => 'HotelRoomController@show']);
    $router->post('booking',['uses' => 'BookingController@store']);
    $router->get('history',['uses' => 'HistoryController@index']);
});

$router->group(['prefix' => 'api'], function () use ($router) {
    $router->put('booking/editstatus', ['uses' => 'BookingController@edit']);
});