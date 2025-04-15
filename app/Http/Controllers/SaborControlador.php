<?php

namespace App\Http\Controllers;
use App\Models\Sabor;
use App\Models\SaborIngrediente;
use App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\usuarioModelo;

class SaborControlador extends Controller
{
    public function store(Request $request){
        $validacion = Validator::make($request->all(),
        [
            'idSabor' => 'Required|string',
            'Nombre_Pizza'=>'Required|string',
            'Precio_Porcion' => 'Required|numeric',
        ]);
        if($validacion->fails()){
            return response()->json([
                'message' => 'Error en la validación de datos',
                'errors' => $validacion->errors(),
                'status' => 422
            ], 422); // 422 Unprocessable Entity is best for validation errors
        }
        try {
            $sabor = Sabor::create([
                'idSabor'=> $request->idSabor,
                'Nombre_Pizza'=>$request->Nombre_Pizza,
                'Precio_Porcion' => $request->Precio_Porcion
            ]);
        
            return response()->json([
                'sabor' => $sabor,
                'status' => 201
            ], 201);
        
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al registrar sabor',
                'error' => $e->getMessage(),
                'status' => 500
            ], 500);
        }
}
}
