<?php

namespace App\Http\Controllers\Afiliacion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Afiliacion\CambioTitular;
use Carbon\Carbon;

class CambioTitularController extends Controller
{
    public function crearCambioTitular(Request $request)
    {
        try {
            $FECHA = Carbon::now();
            $cambioTitular = CambioTitular::create([
                'id_titular' => $request->id_titular,
                'id_beneficiario' => $request->id_beneficiario,
                'id_afiliado' => $request->id_afiliado,
                'Fecha_Cambio' => Carbon::parse($FECHA)->format('d-m-Y'), // Fecha actual del sistema
                'id_tipo_cambio' => 1, // Valor por defecto
                'id_Usuario' => 251, // Valor por defecto
            ]);

            // Guardar el registro en la base de datos


            // Retornar una respuesta exitosa
            return response()->json([
                'message' => 'Registro creado exitosamente',
                'data' => $cambioTitular
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Error al crear el Cambiotitular',
                'data' => $th
            ], 500);
        }
    }
}
