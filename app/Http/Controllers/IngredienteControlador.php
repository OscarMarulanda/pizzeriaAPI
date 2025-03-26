<?php

namespace App\Http\Controllers;
use App\Models\IngredienteModelo;

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

}
