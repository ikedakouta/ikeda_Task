<?php

use App\Post;
use Illuminate\Support\Facades\Auth;
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

// Route::get('/', function () {
//     return view('posts.create');
// });

Auth::routes();

Route::get('/', 'PostController@index')->name('index');
Route::post('/posts/search', 'PostController@search');

Route::resource('/posts', 'PostController', ['only' => ['index','show', 'create', 'store']]);
Route::get('posts/edit/{id}','PostController@edit');
Route::post('posts/edit', 'PostController@update');
Route::post('posts/delete/{id}', 'PostController@destroy');
