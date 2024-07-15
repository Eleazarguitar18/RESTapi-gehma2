<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Afiliacion\TitularController;
use App\Http\Controllers\Afiliacion\AfiliadoController;
use App\Http\Controllers\Afiliacion\BeneficiarioController;
use App\Http\Controllers\Afiliacion\MigracionController;
use App\Http\Controllers\Afiliacion\DepartamentoController;
use App\Models\Afiliacion\Afiliado;
use App\Models\Afiliacion\FotoAfiliado;
use App\Http\Controllers\Afiliacion\CambioBeneficiarioControlller;

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
        //dd($request->all()); 
        if (false) {
            //cambiar de Beneficiario a Titular
            //agregar la tabla cambio_beneficiario
            //ya no agregar afiliado, solo optener el ID y llevarlo a titular
            try {
                //code...
            } catch (\Throwable $th) {
                //throw $th;
            }
        } else {

            $datoError = "Error";
            try {
                $request['id_tipoafiliado'] = 2;

                // dd($request->request);
                $afiliado = new AfiliadoController();
                $datoAfiliado = $afiliado->crearAfiliado($request);
                // $request['id_afiliado'] = $id_afiliado;
                // dd($datoAfiliado);
                if (!$datoAfiliado->original['success']) {
                    $datoError = $datoAfiliado;
                    return response()->json([
                        'error' => 'No se pudo crear el afiliado',
                        'message' => $datoAfiliado->original,
                    ], $datoAfiliado->original['status']);
                }
                // * SE CREO EL AFILIADO Y SE MIGRO A LA TABLA MIGRACION 
                // $migracion= new MigracionController();

                $id_afiliado = $datoAfiliado->original['data']->id;
                // $migracion->agregarMigracion($id_afiliado);
                $request['id_afiliado'] = (int)$id_afiliado;
                $titular = new TitularController();
                $datoTitular = $titular->crearTitular($request);
                // return $datoTitular;
                $migracion = new MigracionController();
                $datoMigracion = $migracion->agregarMigracion($request);
                // dd($data);
                // return $datoMigracion;
                $data = [
                    'afiliado' => $datoAfiliado->original,
                    'titular' => $datoTitular->original,
                    'migracion' => $datoMigracion->original
                ];
                //! CAMBIO DE BENEFICIARIO A TITULAR
                $buscaAfiliado = new AfiliadoController();
                $afiliadoBeneficiario = $buscaAfiliado->obtenerAfiliadoBeneficiario($request->DocIdentificacion);
                if ($afiliadoBeneficiario->original['success']) {
                    // dd('3ntr');
                    // sacar el id titular
                    // $id_beneficiario = $buscaBeneficiario->buscarBeneficiarioCI($request->DocIdentificacion);
                    // sacar beneficiario


                    //*para agregar en la tabla cambio titular
                    $cambio_A_titular = new CambioBeneficiarioControlller();
                    $request['id_titular'] = $datoTitular->original['data']->id_titular;
                    $request['id_titularB'] = $afiliadoBeneficiario->original['data']->id_titular;
                    $request['id_afiliado'] = $afiliadoBeneficiario->original['data']->id_afiliado;
                    $request['id_parentesco'] = $afiliadoBeneficiario->original['data']->id_parentesco;
                    $request['id_beneficiario'] = $afiliadoBeneficiario->original['data']->id_beneficiario;
                    // dd(
                    //     $request['id_titular'],
                    //     $request['id_afiliado'],
                    //     $request['id_beneficiario'],
                    // );
                    // $request['id_afiliado'] = $afiliado->data['id_afiliado'];
                    $cambioTitular = $cambio_A_titular->crearCambioBeneficiario($request);
                    // dd($cambioTitular);
                    //! para cambiar el estado del titular
                    $buscaBeneficiario = new BeneficiarioController();
                    $cambio_estado = $buscaBeneficiario->actualizaEstadoCambio($request);

                    // ir con id titular a actualizar el estado cambio
                    //cambiar de Titular a Beneficiario
                    //agregar la tabla cambio_titular

                    //ya no agregar afiliado, solo optener el ID y llevarlo a beneficiario junto con el id titular
                    //cambiar id_tipoafiliado a 3, id_parentesco
                    $data['estado_cambio'] = $cambio_estado->original;
                    $data['busca Beneficiario'] = $cambioTitular->original;
                }




                if (!$datoTitular->original['success']) {
                    $datoError = $datoAfiliado;
                    return response()->json([
                        'success' => false,
                        'message' => 'Fallo al crear Titular',
                        'detalle' => $datoTitular->original,
                    ], $datoTitular->original['status']);
                }

                return response()->json([
                    'success' => true,
                    'message' => 'Titular creado satisfactoriamente',
                    'data' => $data
                ], 201);
            } catch (\Throwable $th) {
                // dd($th);
                return response()->json([
                    'success' => false,
                    'message' => 'Error al crear el titular afiliado a través del sistema SighoV2.
                 Datos inválidos, por favor revisa los datos ingresados.',
                    'error' => $th->getMessage(), //Mensaje del error
                    'line' => $th->getLine(),     // Línea donde ocurrió el error
                    'file' => $th->getFile(),     // Archivo donde ocurrió el error
                    'data' => $datoError
                ], 500);
            }
        }
    }
}
