<?php

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
    return view('welcome');
});

Auth::routes();



Route::group(['middleware' => ['auth', 'notification'], 'as' => 'app.'], function() {

	Route::get('/home', 'HomeController@index')->name('home'); // DASHBOARD
    Route::resource('users', 'UserController');
    Route::resource('inventory', 'InventoryController');
	Route::get('schedule/check-date', 'ScheduleController@checkScheduleDate')->name('check-date');
    Route::resource('schedule', 'ScheduleController');
    Route::get('record/get-tracking-no/{tracking_no}', 'RecordController@getTrackingNo');
    Route::resource('record', 'RecordController');
});
