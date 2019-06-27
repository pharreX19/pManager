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

Route::get('/', function(){
    return view('auth.login');
});


Auth::routes();



Route::get('projects/{id}/tasks/create','TaskController@create');
Route::post('projects/{id}/members','ProjectController@members');
Route::post('tasks/{id}/members','TaskController@members');

Route::resource('companies','CompanyController');
Route::resource('projects','ProjectController');
Route::resource('tasks','TaskController');
Route::resource('users','UserController');
Route::resource('roles','RoleController');
Route::resource('comments','CommentController');