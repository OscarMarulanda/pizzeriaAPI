<?php

namespace App\Http\Controllers;
use App\Models\Sabor;
use App\Models\SaborIngrediente;
use App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SaborIngredienteControlador extends Controller
{
    public function store(Request $request){
        $validacion = Validator::make($request->all(),
        [
            'idSabor' => 'Required|string',
            'idIngrediente'=>'Required|string',
            'Cantidadkg' => 'Required|numeric'
        ]);
        if($validacion->fails()){
            $data=[
                'message'=>'Error en la validacion de datos',
                'errors'=>$validacion->errors(),
                'status'=>200
            ];
            return response()->json($data,400);
        }
        $saborIngrediente = SaborIngrediente::create(
            [
                'idSabor'=>$request->idSabor,
                'idIngrediente' => $request->idIngrediente,
                'Cantidadkg' => $request->Cantidadkg
            ]
        );
    
        if(!$saborIngrediente){
            $data=[
                'message'=>'Error al registrar sabor-ingrediente',
                'status'=>500
            ];
            return response()->json($data,500);
        }
        $data=[
            'sabor-ingrediente'=>$saborIngrediente,
            'status'=>201
        ];
        return response()->json($data,201);
    }
}


