<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Material;

class MaterialController extends Controller
{
    public function index()
    {
        $materiais = Material::all();
        return view('material.index', compact('materiais'));
    }

    public function create()
    {
        $titulo  = 'Novo Material';
        return view('material.create',compact('titulo'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'modelo' => 'required',
        ]);

        DB::beginTransaction();
        try {
            $material = new Material($request->all());
            $material->save();
        } catch (\Throwable $th) {
            DB::rollBack();
            //dd($th);
            return back()->withInput()->with('erro', 'Falha ao criar o Material.');    
        }
        DB::commit();

        return redirect('material')->with('sucesso', 'Material criada com sucesso!');

    }
}
