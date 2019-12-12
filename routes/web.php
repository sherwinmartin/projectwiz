<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'DashboardController@index')->name('dashboard');

Route::get('/login', 'UserController@login')->name('login');
Route::post('/authenticate', 'UserController@authenticate')->name('authenticate');

// Password reset link request routes
Route::get('/password/email', 'Auth\PasswordController@getEmail')->name('password.getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail')->name('password.postEmail');

// holidays
Route::get('/holidays', 'HolidayController@index')->name('holidays.index');
Route::get('/holidays/create', 'HolidayController@create')->name('holidays.create');
Route::post('/holidays/store', 'HolidayController@store')->name('holidays.store');
Route::get('/holidays/{holiday}/edit', 'HolidayController@edit')->name('holidays.edit');
Route::patch('/holidays/update', 'HolidayController@update')->name('holidays.update');

/*Route::group(['middleware' => 'web'], function()
{

    // Password reset routes...
    Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
    Route::post('password/reset', 'Auth\PasswordController@postReset');
});*/

// authenticated routes
Route::group(['middleware' => 'auth'], function ()
{
    Route::get('/logout', [
        'as'        => 'logout',
        'uses'      => 'UserController@logout'
    ]);
});

// admin and manager routes
Route::group(['middleware' => 'role:admin|manager'], function ()
{
    Route::resource('clients', 'ClientController');
    Route::resource('milestones', 'MilestoneController');
    Route::resource('projects', 'ProjectController');
    Route::resource('tasks', 'TaskController');

    Route::get('task-user/add', 'TaskUserController@store');
    Route::delete('task-user/delete/{id}', 'TaskUserController@destroy');
});