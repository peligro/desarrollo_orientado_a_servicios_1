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

Route::get('/', 'IndexController@index')->name('index_index');
//Acceso
Route::get('acceso/login', 'AccesoController@login')->name('acceso_login');
Route::post('acceso/login_post', 'AccesoController@login_post')->name('acceso_login_post');
Route::get('acceso/salir', 'AccesoController@salir')->name('acceso_salir');
//Usuarios
Route::get('usuarios', 'UsuariosController@index')->name('usuarios_index');
Route::get('usuarios/add', 'UsuariosController@add')->name('usuarios_add');
Route::post('usuarios/add', 'UsuariosController@add_post')->name('usuarios_add_post');
Route::get('usuarios/edit/{id}', 'UsuariosController@edit')->name('usuarios_edit');
Route::post('usuarios/edit/{id}', 'UsuariosController@edit_post')->name('usuarios_edit_post');
Route::get('usuarios/delete/{id}', 'UsuariosController@delete')->name('usuarios_delete');
//Categorías
Route::get('categorias', 'CategoriasController@index')->name('categorias_index');
Route::get('categorias/add', 'CategoriasController@add')->name('categorias_add');
Route::get('categorias/edit/{id}', 'CategoriasController@edit')->name('categorias_edit');
Route::get('categorias/delete/{id}', 'CategoriasController@delete')->name('categorias_delete');
//Productos
Route::get('productos', 'ProductosController@index')->name('productos_index');
Route::get('productos/add', 'ProductosController@add')->name('productos_add');
Route::get('productos/edit/{id}', 'ProductosController@edit')->name('productos_edit');
Route::get('productos/delete/{id}', 'ProductosController@delete')->name('productos_delete');