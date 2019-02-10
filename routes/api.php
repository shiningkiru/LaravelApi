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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('signup', 'AuthController@register');
Route::post('login', 'AuthController@login');


Route::middleware('jwt.refresh')->get('/token/refresh', 'AuthController@refresh');

Route::group(['middleware' => 'jwt.auth'], function(){
    Route::get('auth/current-user', 'AuthController@user');
    Route::post('auth/logout', 'AuthController@logout');


    //country
    Route::get('country', 'CountryController@listCountries');
    Route::get('country/{id}', 'CountryController@getCountry');
    Route::post('country', 'CountryController@updateCountry');
    Route::delete('country/{id}', 'CountryController@deleteCountry');

    //state
    Route::get('state', 'StateController@listStates');
    Route::get('state/{id}', 'StateController@getState');
    Route::post('state', 'StateController@updateState');
    Route::delete('state/{id}', 'StateController@deleteState');
});

