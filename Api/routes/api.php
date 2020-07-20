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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('projects', 'ProjectController@index');
Route::get('project/{id}', 'ProjectController@show');
Route::post('project', 'ProjectController@store');
Route::put('projects', 'ProjectController@store');
Route::delete('project/{id}', 'ProjectController@destroy');
/****************************Status Routes**************************************** */
Route::get('statuses', 'StatusController@index');
Route::get('status/{id}', 'StatusController@show');
Route::post('status', 'StatusController@store');
Route::put('statuses', 'StatusController@store');
Route::delete('status/{id}', 'StatusController@destroy');
/****************************Ticket Routes**************************************** */
Route::get('tickets', 'TicketController@index');
Route::get('ticket/{id}', 'TicketController@show');
Route::post('ticket', 'TicketController@store');
Route::put('tickets', 'TicketController@store');
Route::delete('ticket/{id}', 'TicketController@destroy');
