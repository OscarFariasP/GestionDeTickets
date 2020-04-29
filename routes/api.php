<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('/fetchUser','UserController@fetchUser');
Route::get('/fetchTickets','UserController@fetchTickets');
Route::post('/postTicket','UserController@postTicket');
Route::delete('/eliminarTicket','UserController@eliminarTicket');
Route::post('/getTicket','UserController@getTicket');
Route::put('/editarTicket', 'UserController@editarTicket');
Route::put('/adquirirTicket', 'UserController@adquirirTicket');

//Route::middleware('auth:api')->put('/adquirirTicket', 'HomeController@adquirirTicket');
/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/

