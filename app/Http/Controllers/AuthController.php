<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    // public function login()
	// {

	// 	//testa se o usuário já está logado e redireciona para a home
	// 	if(Auth::user())
	// 	{
	// 		return redirect()->intended('/');
	// 	}
		
	// 	return view('auth.login');
    // }

    public function logout()
	{
		//$modulo = Config::get('site_settings');
		//dd(session()->all()['modulo']);
		//acesso('Logout', Auth::user()->cpf);
		Auth::logout();
		return redirect("login");
    }
    
    // public function entrar(Request $request)
    // {

    // }
    

}
