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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/post/{post}', 'HomeController@post')->name('post');
Route::get('/posts/categoria/{category}', 'HomeController@categoryPost')->name('postCategory');
Route::get('/posts/mes/{mes}', 'HomeController@monthPosts')->name('postMonth');
Route::post('/search', 'HomeController@search')->name('search');
Route::get('/contato', 'ContactController@contact')->name('contact');
Route::post('/contato', 'ContactController@sendContact')->name('send_contact');

Route::middleware('auth')->group(function(){
    Route::get('/admin', function () {
        return view('admin.layouts.app');
        
    })->name('admin');

    //Usuarios
    Route::resource('/users','UserController')->names('users');
    Route::put('/users/aprovar/{user}', 'UserController@approve')->name('users.approve');

    //Categorias
    Route::resource('/categories', 'CategoryController')->names('categories');

    //Posts
    Route::resource('/posts', 'PostController')->names('posts');
});
