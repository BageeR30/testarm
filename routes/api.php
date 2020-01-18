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

Route::get('employees', 'EmployeesController@index'); 
Route::get('employee/{id}', 'EmployeesController@show');
Route::post('employee', 'EmployeesController@store');
Route::put('employee/{id}', 'EmployeesController@update');
Route::delete('employee/{id}', 'EmployeesController@destroy');
