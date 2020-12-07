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

Route::get('/', function () {
    return view('auth.login');
});

Route::get ('/logout', 		'AuthController@logout')->name('logout');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/movimento',	'MovimentoController@index');
Route::get('/entrada', 		'MovimentoController@entrada');
Route::post('/entrada', 	'MovimentoController@entradaSalva');

Route::get('/saida', 		'MovimentoController@saida');
Route::post('/saida', 		'MovimentoController@saidaSalva');

//======================= API ===============================================
Route::get('/api/buscaMaterial/{material}',				'Api\ApiController@buscaMaterial');  

Route::resource('funcionario',		'FuncionarioController');
Route::resource('material',			'MaterialController');



