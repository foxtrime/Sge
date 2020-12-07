<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;

use App\Movimento;
use App\Material;
use App\Funcionario;

class MovimentoController extends Controller
{

    public function index()
    {
        $movimentos = Movimento::all();

        return view ('movimento.index', compact('movimentos'));    
    }

    public function entrada()
    {
        $titulo     = 'Entrada de Material';
        //$grupos     = Grupo::orderBy('nome')->get();
        // $materiais = Material::with('grupo')->orderBy('modelo')->get();
        $materiais = Material::all();
        return view ('movimento.entrada', compact('titulo','materiais'));
    }

    public function entradaSalva(Request $request)
    {
        // $request->merge(['usuario_id' => Auth::user()->id]);

        $this->validate($request,[
            'material_id'       => 'required',
            'quantidade'           => 'required',
        ]);

        DB::beginTransaction();
        try {
            $movimento = new Movimento($request->all());
            $movimento->save();

            $material = Material::find($request->material_id);

            $material->quantidade = $material->quantidade + ($request->quantidade);
            $material->save();  
            
        } catch (\Throwable $th) {
            DB::rollBack();
            //dd($th);
            return back()->withInput()->with('erro', 'Falha ao realizar a Entrada de Material.');    
        }
        DB::commit();

        return redirect('entrada')->with('sucesso', 'Entrada de Material Realizada com sucesso!');    
    }

    public function saida()
    {
        $titulo         = 'Saída de Material';
        $funcionarios   = Funcionario::orderBy('nome')->get();
        $materiais      = Material::orderBy('modelo')->get();
        
        //dd( $funcionarios );
        return view ('movimento.saida', compact('titulo','materiais','funcionarios'));
    }

    public function saidaSalva(Request $request)
    {
        if( $request->quantidade <= 0){
            return back()->withInput()->with('erro', 'Quantidade solicitada inválida.');    
        }
       
        //dd($request->all());
        
        $this->validate($request,[
            'funcionario'       => 'required',
            'material_id'       => 'required',
            'quantidade'        => 'required',
            // 'departamento_id'   => 'required',
        ]);

        $funcionario = Funcionario::where('cpf',$request->funcionario)->first();
        
        $request->merge(['funcionario_id'   => $funcionario->id]);
        // $request->merge(['usuario_id'       => Auth::user()->id]);
        $request->merge(['tipo'             => "SAÍDA"]);




        $material = Material::find($request->material_id);
       
        if( $material->quantidade < $request->quantidade){
            return back()->withInput()->with('erro', 'Quantidade solicitada superior a existente em estoque.');    
        }
         
        //dd($request->all());
        DB::beginTransaction();
        try {
            $movimento = new Movimento($request->all());
            $movimento->save();

        
            $material->quantidade = $material->quantidade - ($request->quantidade);
            $material->save();  
            
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th);
            return back()->withInput()->with('erro', 'Falha ao realizar a Entrada de Material.');    
        }
        DB::commit();

        return redirect('saida')->with('sucesso', 'Saida de Material Realizada com sucesso!');    
    }
}
