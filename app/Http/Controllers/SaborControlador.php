<?php

namespace App\Http\Controllers;
use App\Models\Sabor;
use App\Models\SaborIngrediente;
use App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\usuarioModelo;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class SaborControlador extends Controller
{
    public function index(Request $request)
{
    try {
        // Get pagination parameters from request (default to page 1, 10 items per page)
        $perPage = $request->input('per_page', 10);
        $page = $request->input('page', 1);
        
        // Query with pagination
        $sabores = Sabor::with('saborIngrediente') // Eager load relationships if needed
            ->orderBy('idSabor', 'asc')
            ->paginate($perPage, ['*'], 'page', $page);
        
        return response()->json([
            'data' => $sabores->items(),
            'current_page' => $sabores->currentPage(),
            'per_page' => $sabores->perPage(),
            'total' => $sabores->total(),
            'last_page' => $sabores->lastPage(),
            'status' => 200
        ]);
        
    } catch (\Exception $e) {
        return response()->json([
            'message' => 'Error al obtener los sabores',
            'error' => $e->getMessage(),
            'status' => 500
        ], 500);
    }
}


    public function store(Request $request){
        $validacion = Validator::make($request->all(), [
            'idSabor' => 'required|string',
            'Nombre_Pizza' => 'required|string',
            'Precio_Porcion' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        if ($validacion->fails()) {
            return response()->json([
                'message' => 'Error en la validación de datos',
                'errors' => $validacion->errors(),
                'status' => 422,
            ], 422);
        }
    
        DB::beginTransaction();
    
        try {
            $imageUrl = null;
            if ($request->hasFile('image')) {
                $path = $request->file('image')->store('pizza-images', 's3');
                $imageUrl = Storage::disk('s3')->url($path);
            }
    
            $sabor = Sabor::create([
                'idSabor' => $request->idSabor,
                'Nombre_Pizza' => $request->Nombre_Pizza,
                'Precio_Porcion' => $request->Precio_Porcion,
                'imageUrl' => $imageUrl
            ]);
    
            DB::commit();
    
            return response()->json([
                'sabor' => $sabor,
                'status' => 201
            ], 201);
    
        } catch (\Exception $e) {
            DB::rollBack();
    
            // Optional: Delete the uploaded file if it was uploaded
            if (!empty($path) && Storage::disk('s3')->exists($path)) {
                Storage::disk('s3')->delete($path);
            }
    
            return response()->json([
                'message' => 'Error al registrar sabor',
                'error' => $e->getMessage(),
                'status' => 500
            ], 500);
        }
}
}
