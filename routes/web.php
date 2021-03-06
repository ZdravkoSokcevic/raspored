<?php

namespace App\Http\Controllers\SettingsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->to('/settings');
});


Route::get('/settings', '\App\Http\Controllers\SettingsController@view');
Route::post('/settings', '\App\Http\Controllers\SettingsController@saveOrUpdate');

Route::get('/calendar', '\App\Http\Controllers\CalendarController@display');
Route::post('/calendar', '\App\Http\Controllers\CalendarController@update');
Route::delete('/calendar', '\App\Http\Controllers\CalendarController@delete');
Route::get('/calendar/check', '\App\Http\Controllers\CalendarController@check');

