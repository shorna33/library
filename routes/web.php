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

Route::get('/', 'PagesController@home');

//....Search...
Route::get('/searchCat', 'CategoriesController@searchCat');
Route::get('/searchBook', 'BooksController@searchBook');
Route::get('/searchTea', 'TeachersController@searchTea');
Route::get('/searchStud', 'StudentsController@searchStud');

//....AccessnosController....
Route::get('access_nos/{id}', 'AccessnosController@create');
Route::post('store/{id}', 'AccessnosController@store');
Route::get('/access_nos/{book_id}/{id}/edit', 'AccessnosController@edit');
Route::put('update/{book_id}/{id}', 'AccessnosController@update');
Route::delete('destroy/{id}', 'AccessnosController@destroy');

//...Resource.....
Route::resource('categories','CategoriesController');
Route::resource('books','BooksController');
Route::resource('batches','BatchesController');
Route::resource('students','StudentsController');
Route::resource('teachers','TeachersController');
Route::resource('issuestuds','IssuestudsController');
Route::resource('issueteachers','IssueteachersController');
