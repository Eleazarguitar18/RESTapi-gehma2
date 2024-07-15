<?php

namespace App\Http\Controllers\Afiliacion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Afiliacion\CambioBeneficiario;

class CambioBeneficiarioControlller extends Controller
{
    //
    public function crearCambioBeneficiario(Request $request)
    {
        try {
            $FECHA = Carbon::now();
            $cambioTitular = CambioBeneficiario::create([
                'id_beneficiario' => $request->id_beneficiario,
                'id_titular' => $request->id_titular,
                'id_afiliado' => $request->id_afiliado,
                'Fecha_Cambio' => Carbon::parse($FECHA)->format('d-m-Y'), // Fecha actual del sistema
                'id_tipo_cambio' => 2, // Valor por defecto
                'id_titularB' => $request->id_titularB, //id titular anterior
                'id_parentesco' => $request->id_parentesco,
                'id_Usuario' => 251, // Valor por defecto
            ]);

            // Guardar el registro en la base de datos


            // Retornar una respuesta exitosa
            return response()->json([
                'message' => 'Registro CambioBeneficiario creado exitosamente',
                'data' => $cambioTitular
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Error al crear el CambioBeneficiario',
                'data' => $th
            ], 500);
        }
    }
}
