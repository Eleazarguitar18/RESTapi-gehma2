<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Afiliacion\TitularController;
use App\Http\Controllers\Afiliacion\AfiliadoController;
use App\Http\Controllers\Afiliacion\DepartamentoController;
use App\Models\Afiliacion\Afiliado;
use App\Models\Afiliacion\FotoAfiliado;
/* 
NUEVA BASE				ANTIGUA BASE

TITULAR
--------
estado_requisitos	>> tbl_afiliacion_titular -- estadoRequisitos
estado_vigencia		>> tbl_afiliacion_titular -- estado_vigencia
grupo_sanguineo		>> tbl_afiliacion_afiliado -- id_gruposanguineo
alergias		>> tbl_afiliacion_afiliado -- alergias
telefono_referencia	>> tbl_afiliacion_afiliado -- telefonocontacto
nombre_referencia	>> tbl_afiliacion_afiliado -- detallecontacto
foto_nombre		>> tbl_afiliacion_foto_afiliado -- id_foto<->id_afiliado
observacion		>> tbl_afiliacion_titular -- observaciones
fecha_afiliacion	>> tbl_afiliacion_titular -- fechaAfiliacion y 
			>> tbl_afiliacion_afiliado -- fechaRegistro 
id_persona		>> tbl_afiliacion_afiliado -- (DocIdentificacion,id_identificacion,Tipo..,etc)
id_aporte_v		>> no existe
id_aporte_i		>> no existe
telefono		>> tbl_afiliacion_afiliado -- telefonoDomicilio y telefonoCelular
fecha_reafiliacion	>> no existe
tipo_afiliacion		>> tbl_afiliacion_afiliado -- id_tipoafiliado
created,updated,id_user_created,id_user_updated
*/

class TitularSIGHO2Controller extends Controller
{
    //
    public function crearTitularConSigho(Request $request)
    {


        $afiliado = new AfiliadoController();
        $titular = new TitularController();
        $datoAfiliado = $afiliado->crearAfiliado($request);
        // dd($datoAfiliado->original);
        $dataTitular = $titular->crearTitular($request);
        // dd($titular->getAttributes());
        $data = [
            'afiliado' => $datoAfiliado->original,
            'titular' => $dataTitular->original
        ];

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Fallo al crear Titular'
            ], 500);
        }
        return response()->json([
            'success' => true,
            'message' => 'Titular creado satisfactoriamente',
            'data' => $data
        ], 201);
    }
}
