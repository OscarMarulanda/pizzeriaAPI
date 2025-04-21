<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Sabor;
use App\Models\SaborIngrediente;

class SaborIngredienteControlador2 extends Controller
{
    public function store(Request $request)
{
    // Optional: Validate input
    $validated = $request->validate([
        'idSabor' => 'required|string|unique:sabor,idSabor',
        'Nombre_Pizza' => 'required|string',
        'Precio_Porcion' => 'required|numeric',
        'ingredients' => 'required|array',
        'ingredients.*.idIngrediente' => 'required|string|exists:ingrediente,idIngrediente',
        'ingredients.*.Cantidadkg' => 'required|numeric|min:0',
        'image' => 'nullable|image|max:2048'
    ]);

    // Upload image to S3 (if provided)
    $imageUrl = null;
    if ($request->hasFile('image')) {
        $path = $request->file('image')->store('pizza-images', 's3');
        $imageUrl = Storage::disk('s3')->url($path);
    }

    // Create flavor
    $sabor = Sabor::create([
        'idSabor' => $request->idSabor,
        'Nombre_Pizza' => $request->Nombre_Pizza,
        'Precio_Porcion' => $request->Precio_Porcion,
        'imageUrl' => $imageUrl
    ]);

    // Associate ingredients
    $ingredients = $request->ingredients;

    foreach ($ingredients as $ingredient) {
        SaborIngrediente::create([
            'idSabor' => $sabor->idSabor,
            'idIngrediente' => $ingredient['idIngrediente'],
            'Cantidadkg' => $ingredient['Cantidadkg']
        ]);
    }

    return response()->json(['message' => 'Flavor created successfully'], 201);
}
}
