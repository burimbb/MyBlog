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

/*
Route::name('home')->middleware('auth')->get('/home', 'HomeController@index');

Route::prefix('auth')->group(function(){
    Route::name('home')->get('/home', 'HomeController@index');
});

*/


//Auth Routes
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

//Pages Routes
Route::get('/', 'PageController@index');
Route::get('/about', 'PageController@about');
Route::get('/contact', 'PageController@contact');

//Categories Route
Route::resource('/categories','CategoryController')->except('create');

//Posts Route
Route::resource('posts', 'PostController');

//Tags Route
Route::resource('tags', 'TagController')->except('create');

//Blog Routes
Route::get('blog/{slug}', 'BlogController@getSlug')->name('blog.single')->where('slug','[\w\d\_\-]+');
Route::get('blog', 'BlogController@index');

//Comments Routes
Route::post('comments/{post_id}', 'CommentController@store')->name('comments.store');
Route::get('comments/{id}/edit', 'CommentController@edit')->name('comments.edit');
Route::put('comments/{id}', 'CommentController@update')->name('comments.update');
Route::delete('comments/{post_id}', 'CommentController@destroy')->name('comments.destroy');