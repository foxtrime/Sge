<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use Auth;

class AuthController extends Controller
{
    public function index()
	{
		return view('auth.login');
	}
	
	public function login(Request $request)
    {
		// dd($request);
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $credentials = ['email'=>$request->email,'password'=>$request->password];

        if(Auth::attempt($credentials)){
            return redirect()->intended('home');
        }else{
            return redirect()->back()->with('msg','Acesso Negado, Email ou senha invalida');
        }
    }

    public function logout()
	{
		//$modulo = Config::get('site_settings');
		//dd(session()->all()['modulo']);
		//acesso('Logout', Auth::user()->cpf);
		Auth::logout();
		return redirect("login");
    }
    
    public function AlteraSenha()
	{
		$usuario = Auth::user();
		return view('auth.altera_senha',compact('usuario'));    	
    }
    
    public function SalvarSenha(Request $request)
	{
	    // Validar
		$this->validate($request, [
			'password_atual'        => 'required',
			'password'              => 'required|min:6|confirmed',
			'password_confirmation' => 'required|min:6'
		]);

		// Obter o usuário
		$usuario = User::find(Auth::user()->id);

		if (Hash::check($request->password_atual, $usuario->password))
		{

			$usuario->update(['password' => bcrypt($request->password)]);            

			return redirect('/home')->with('sucesso','Senha alterada com sucesso.');
		}else{
			return back()->withErrors('Senha atual não confere');
		}
	}

	public function create()
    {
        $usuarios = User::all();
        //dd($usuarios);
        return view('authe/create', compact('usuarios'));
    }

    public function store(Request $request)
    {
		
		$md5 = Hash::make($request->password);
		// dd($md5);
		
		$user = User::create([

			'name' => $request->name,
			'email' => $request->email,
			'password' => $md5,
			]
		);
        
        return redirect()->to('/register');
    }
}
