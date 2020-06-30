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

// Route::get('/', function () {
//     $title = 'Welcome to LoginSystem';
//     return view('index')->with('title',$title);
// });


Route::get('/','HomeController@dashboard');
Route::get('/dashboard','HomeController@dashboard');
Route::get('/home','HomeController@dashboard');
Route::get('/logout','HomeController@dashboard');
Route::get('/infor/{id}','UserController@inforView')-> name('infor');
Route::post('/infor/{id}','UserController@update');

Route::resource('posts','PostsController');
Auth::routes(['verify' => true]);

