<?php

namespace App\Http\Controllers\Afiliacion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Afiliacion\DocIdentificacion;

class DocIdentificacionController extends Controller
{
    //
    public function crearDocIdentificacion(Request $request)
    {
        $docIdentificaion = DocIdentificacion::create([
            'TipoIdentificacion' => $request->TipoIdentificacion,
            'SiglaIdentificacion' => $request->SiglaIdentificacion,
        ]);
        if (!$docIdentificaion) {
            return response()->json([
                'success' => false,
                'message' => 'Fallo al crear Documento identificacion'
            ], 500);
        }
        return response()->json([
            'success' => true,
            'message' => 'Documento identificacion creado satisfactoriamente'
        ], 201);
    }
}
