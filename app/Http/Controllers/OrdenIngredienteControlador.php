<?php

namespace App\Http\Controllers;
use App\Models\OrdenCompraModelo;
use App\Models\OrdenIngredienteModelo;
use App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrdenIngredienteControlador extends Controller
{
    public function store(Request $request){
        $validacion = Validator::make($request->all(),
        [
            'idIngrediente'=>'Required|string',
            'CantidadComprada' =>'Required|numeric'
        ]);
        if($validacion->fails()){
            $data=[
                'message'=>'Error en la validacion de datos',
                'errors'=>$validacion->errors(),
                'status'=>200
            ];
            return response()->json($data,400);
        }
        $ordenIngrediente = OrdenIngredienteModelo::create(
            [
                'idOrden'=>OrdenCompraModelo::max('idOrden'),
                'idIngrediente' => $request->idIngrediente,
                'CantidadSolicitada' => 0,
                'idProveedor' => 1,
                'CantidadComprada' => $request->CantidadComprada,
            ]
        );

        if(!$ordenIngrediente){
            $data=[
                'message'=>'Error al registrar Orden Ingrediente',
                'status'=>500
            ];
            return response()->json($data,500);
        }
        $data=[
            'Orden Ingrediente'=>$ordenIngrediente,
            'status'=>201
        ];
        return response()->json($data,201);
    }
}
