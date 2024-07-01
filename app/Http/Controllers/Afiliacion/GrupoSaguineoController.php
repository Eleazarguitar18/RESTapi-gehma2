<?php

namespace App\Http\Controllers\Afiliacion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Afiliacion\GrupoSanguineo;

class GrupoSaguineoController extends Controller
{
    //
    public function crearGrupoSanguineo(Request $request)
    {
        $data = GrupoSanguineo::create([
            'descripcionGrupoSanguineo' => $request->descripcionGrupoSanguineo,
        ]);
        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Fallo al crear Grupo sanquineo'
            ], 500);
        }
        return response()->json([
            'success' => true,
            'message' => 'Grupo sanquineo creado satisfactoriamente'
        ], 201);
    }
    public function listarGrupoSanguineo(Request $request)
    {
        $data = GrupoSanguineo::all();
        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Fallo al listar Grupo sanquineo'
            ], 500);
        }
        return response()->json([
            'success' => true,
            'message' => 'Grupo sanquineo listado satisfactoriamente',
            'data' => $data,
        ], 200);
    }
}
