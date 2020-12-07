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
Route::post('datauser','api\UserController@datauser');

Route::post('todoid','api\TodoListController@todoid');
Route::post('create','api\TodoListController@create');
Route::post('update','api\TodoListController@update');
Route::post('delete','api\TodoListController@destroy');
Route::post('tong','api\TodoListController@tongsampah');
Route::post('restore','api\TodoListController@restore');
Route::post('permanen','api\TodoListController@deletepermanent');
Route::post('deleteall','api\TodoListController@deleteall');
Route::post('restoreall','api\TodoListController@restoreall');
// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
