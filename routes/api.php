<?php

use Illuminate\Http\Request;

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

Route::apiResource('piso', 'FloorController');
Route::apiResource('reservaciones', 'ReservationController');
Route::apiResource('tpd', 'DocumentTypeController');
Route::apiResource('categorias', 'CategoryController');
Route::apiResource('habitaciones', 'RoomController');
Route::post('auth', 'AuthorizationController@auth');
Route::get('getpisos', 'FloorController@get');
Route::get('gethabitaciones', 'RoomController@get');
Route::get('reportes', 'ReservationController@reportes');
