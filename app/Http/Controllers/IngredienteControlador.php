<?php

namespace App\Http\Controllers;
use App\Models\IngredienteModelo;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

class IngredienteControlador extends Controller
{
    public function index()
    {
        $ingredientes = IngredienteModelo::all();

        if ($ingredientes->isEmpty()) {
            return response()->json([
                'message' => 'No hay ingredientes registrados',
                'status' => 404
            ], 404);
        }

        return response()->json($ingredientes, 200);
    }

    public function store(Request $request){
        $validacion = Validator::make($request->all(),
        [
            'idIngrediente' => 'Required|string',
            'Descripcion'=>'Required|string',
            'Existenciaskg' => 'Required|numeric',
        ]);
        if($validacion->fails()){
            return response()->json([
                'message' => 'Error en la validación de datos',
                'errors' => $validacion->errors(),
                'status' => 422
            ], 422); // 422 Unprocessable Entity is best for validation errors
        }
        try {
            $ingrediente = IngredienteModelo::create([
                'idIngrediente'=> $request->idIngrediente,
                'Descripcion'=>$request->Descripcion,
                'Existenciaskg' => $request->Existenciaskg
            ]);
        
            return response()->json([
                'ingrediente' => $ingrediente,
                'status' => 201
            ], 201);
        
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al registrar ingrediente',
                'error' => $e->getMessage(),
                'status' => 500
            ], 500);
        }
}

}
