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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['prefix' => '/v1', 
   'namespace' => 'Api\V1', 
   'as' => 'api.'], function () {
        Route::resource('employees', 'EmployeesController', 
            ['except' => ['create', 'edit']]);

        Route::resource('positions', 'PositionsController', 
            ['except' => ['create', 'edit']]);

        Route::resource('contacts', 'ContactsController', 
            ['except' => ['create', 'edit']]);

        Route::resource('departments', 'DepartmentsController', 
            ['except' => ['create', 'edit']]);
    });

// Route::get('employees', 'EmployeesController@index'); 
// Route::get('employee/{employee}', 'EmployeesController@show');
// Route::post('employee', 'EmployeesController@store');
// Route::put('employee/{id}', 'EmployeesController@update');
// Route::delete('employee/{id}', 'EmployeesController@destroy');
