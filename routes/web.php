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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::any('/', 'IndexController@index');
Route::any('index/fileUpload', 'IndexController@fileUpload');

Route::any('product', 'ProductController@default');
Route::resource('products', 'ProductController');

Route::any('test', 'TestController@default');
Route::resource('tests', 'TestController');