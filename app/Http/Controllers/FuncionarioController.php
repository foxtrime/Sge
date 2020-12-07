<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Funcionario;

class FuncionarioController extends Controller
{
    public function index()
    {

        $funcionarios = Funcionario::all();
        return view('funcionario.index', compact('funcionarios'));
    }

    public function create()
    {
        $titulo         = 'Nova Funcionario';
        return view('funcionario.create', compact('titulo'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'nome' => 'required',
            'cpf'  => 'required|unique:funcionarios',
        ]);

        DB::beginTransaction();
        try {
            $funcionario = new Funcionario($request->all());
            $funcionario->save();
        } catch (\Throwable $th) {
            DB::rollBack();
            //dd($th);
            return back()->withInput()->with('erro', 'Falha ao criar a Funcionario.');    
        }
        DB::commit();

        return redirect('funcionario')->with('sucesso', 'Funcionario criada com sucesso!');    

    }

    public function destroy(Funcionario $modelo)
    {
        DB::beginTransaction();
        try {
        
            $modelo->delete();

        } catch (\Throwable $th) {
			DB::rollBack();
            //dd($th);
			return response('erro', 500);
        }
        DB::commit();
        return response('ok', 200);
    }
}
