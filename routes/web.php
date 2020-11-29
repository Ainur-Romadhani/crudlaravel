<?php

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
    return view('welcome');
});

Auth::routes();

Route::resource('home','HomeController');
// Route::resource('todo','TodosController');
Route::get('todo/index/{id}','TodosController@index');
Route::get('todo/create/{id}','TodosController@create');
Route::post('todo/store/','TodosController@store');
Route::get('todo/edit/{id_todos}','TodosController@edit');
Route::put('todo/update/{id_todos}','TodosController@update');
Route::get('todo/softdelete/{id_todos}','TodosController@softdelete');
Route::get('todo/tongsampah/{id}','TodosController@tongsampah');
Route::get('todo/restore/{id_todos}','TodosController@restore');
Route::get('todo/restoreall','TodosController@restoreall');
Route::get('todo/deletepermanent/{id_todos}','TodosController@deletepermanent');
Route::get('todo/deleteall','TodosController@deleteall');
