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

Route::get('/', 'SexyactressesController@index')->name('top');
Route::post('/index', 'SexyactressesController@create');
Route::get('/index', 'SexyactressesController@display')->name('index');
Route::get('/index/{id}', 'SexyactressesController@detail')->name('detail');
Route::get('/search/{id}', 'SexyactressesController@recommendedSearch')->name('recommended.search');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home/create', 'SexyactressesController@getCreateForm')->name('admin.create');
Route::post('/home/create', 'SexyactressesController@addSexyActresses')->name('add');
Route::get('/index/{id}/edit', 'SexyactressesController@showEditForm')->name('detail.edit');
Route::post('/index/{id}/edit', 'SexyactressesController@edit')->name('edit');

/*Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
*/
