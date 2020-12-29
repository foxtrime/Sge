<?php

use Illuminate\Support\Facades\Route;

// Auth::routes();
// Route::get('/', function () {
//     return view('auth.login');
// });

Route::get('/', 'AuthController@index')->name('login');
Route::post('/login', 'AuthController@login');

Route::group(['middleware'=>['auth']], function(){
    
    Route::get('/home', 'HomeController@index')->name('home');
/*==================================LOGOUT=================================*/
    Route::post('/logout',function(){
        Auth::logout();
        return redirect()->route('login');
    });
    Route::get('/logout',function(){
        Auth::logout();
        return redirect()->route('login');
        });
/*============================================================================*/
    

/*==================================REGISTRAR=================================*/
Route::get('/register', 'AuthController@create');
Route::post('register', 'AuthController@store');
/*============================================================================*/


// Auth::routes();
//===========================Password=======================================
    Route::get 	('/alterasenha',		'AuthController@AlteraSenha');
	Route::post	('/salvasenha',   		'AuthController@SalvarSenha');
//==========================================================================

    Route::get('/movimento',	'MovimentoController@index');
    Route::get('/entrada', 		'MovimentoController@entrada');
    Route::post('/entrada', 	'MovimentoController@entradaSalva');
    Route::get('/saida', 		'MovimentoController@saida');
    Route::post('/saida', 		'MovimentoController@saidaSalva');
});

//======================= API ===============================================
Route::get('/api/buscaMaterial/{material}',				'Api\ApiController@buscaMaterial');  

//======================= RESOURCE ===========================================
Route::resource('funcionario',		'FuncionarioController');
Route::resource('material',			'MaterialController');
