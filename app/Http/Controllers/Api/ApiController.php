<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Material;

class ApiController extends Controller
{
    public function buscaMaterial($material_id)
	{
		if($material_id == 0){
			return response()->json("", 200);
		}

		$material = Material::where('id', $material_id)->orderBy('modelo')->get();

		if(sizeof($material) > 0 ){
			return response()->json($material, 200);
		}else{
			return response()->json($material, 204);
		}
        
	}
}
