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

/*Dos peticiones http, las peticiones GET las usamos cuando queremos consultar informacion y POST
es usada cuando necesitamso registrar o actualizar informacion*/


Route::get('/', 'TestController@welcome');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/products/{id}', 'ProductController@show');

Route::post('/cart', 'CartDetailController@store');
Route::delete('/cart', 'CartDetailController@destroy');
Route::post('/order', 'CartController@update');

Route::middleware(['auth','admin'])->prefix('admin')->namespace('Admin')->group(function () {
    Route::get('/products', 'ProductController@index');
    //Ruta de formulario de creacion de productos
    Route::get('/products/create', 'ProductController@create');
    //Ruta para el registro de informacion de producto
    Route::post('/products', 'ProductController@store');
    //Ruta para formulario de creacion de producto
    Route::get('/products/{id}/edit', 'ProductController@edit');
    Route::post('/products/{id}/edit', 'ProductController@update'); // registro de informacion de producto

    Route::delete('/products/{id}', 'ProductController@destroy'); //formulario de eliminacion

    Route::get('/products/{id}/images', 'ImageController@index');
    Route::post('/products/{id}/images', 'ImageController@store');
    Route::delete('/products/{id}/images', 'ImageController@destroy');
    Route::get('/products/{id}/images/select/{image}', 'ImageController@select');
});


//Rutas del CRUD
//Ruta para el listado de productos

