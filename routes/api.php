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

Route::post('register', 'UserController@register');
Route::post('login', 'UserController@login');

Route::middleware(['auth:sanctum'])->group(function () {
    Route::apiResource('departments', 'DepartmentController');
    Route::get('departments/{department}/subdepartments', 'DepartmentController@subdepartments');
    Route::post('departments/searchByColumn', 'DepartmentController@searchByColumn');
});
