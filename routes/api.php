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

Route::post('loginuser','api\UserController@login');
Route::post('register','api\UserController@Register');
Route::get('user','api\UserController@index');

Route::get('todo','api\TodoListController@index');
Route::post('create','api\TodoListController@create');
// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
