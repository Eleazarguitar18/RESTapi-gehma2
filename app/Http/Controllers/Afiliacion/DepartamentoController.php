<?php

namespace App\Http\Controllers\Afiliacion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Afiliacion\Departamento;

class DepartamentoController extends Controller
{
    public function listarDepartamentos(Request $request)
    {
        $departamentos = Departamento::all();
        return response()->json($departamentos, 200);
    }
    public function crearDepartamento(Request $request)
    {
        // dd([
        //     $request->Departamento,
        //     $request->codigoDepartamento
        // ]);
        $data = Departamento::create([
            'Departamento' => $request->Departamento,
            'codigoDepartamento' => $request->codigoDepartamento
        ]);
        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Fallo al crear Departamento'
            ], 500);
        }
        return response()->json([
            'success' => true,
            'message' => 'Departamento creado satisfactoriamente'
        ], 201);
    }
}
