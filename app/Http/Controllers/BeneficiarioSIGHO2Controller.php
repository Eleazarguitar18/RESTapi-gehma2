<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Afiliacion\TitularController;
use App\Http\Controllers\Afiliacion\AfiliadoController;
use App\Http\Controllers\Afiliacion\BeneficiarioController;
use App\Http\Controllers\Afiliacion\CambioTitularController;
use App\Http\Controllers\Afiliacion\DepartamentoController;
use App\Http\Controllers\Afiliacion\MigracionController;
use App\Models\Afiliacion\Afiliado;
use App\Models\Afiliacion\CambioTitular;
use App\Models\Afiliacion\Titular;

class BeneficiarioSIGHO2Controller extends Controller
{
    public function crearBeneficiarioConSighoV2(Request $request)
    {

        $datoError = "Error";
        try {

            $request['id_tipoafiliado'] = 3;
            $afiliado = new AfiliadoController();
            $datoAfiliado = $afiliado->crearAfiliado($request);

            // $request['id_afiliado'] = $id_afiliado;
            // dd($datoAfiliado->original['success']);
            // dd($datoAfiliado);
            if (!$datoAfiliado->original['success']) {
                $datoError = $datoAfiliado;
                return response()->json([
                    'error' => 'No se pudo crear el afiliado Beneficiario',
                    'message' => $datoAfiliado->original,
                ], $datoAfiliado->original['status']);
            }

            $carnetTitular = $request->ci_titular;
            $Afiliado_titular = $afiliado->obtenerAfiliadoPor_Carnet($carnetTitular);
            // dd($Afiliado_titular->original['success']);
            if (!$Afiliado_titular->original['success']) {
                $datoError = $Afiliado_titular;
                return response()->json([
                    'error' => 'No se encontro al Beneficiario',
                    'message' => $datoAfiliado->original,
                ], $datoAfiliado->original['status']);
            }

            // return $Afiliado_titular->original['data']->id_afiliado;
            $request['id_titular'] = (int)$Afiliado_titular->original['data']->id_afiliado;
            // dd((int)$Afiliado_titular->original['data']->id_afiliado);
            $id_afiliado = $datoAfiliado->original['data']->id_afiliado;
            $request['id_afiliado'] = $id_afiliado;
            $beneficiario = new BeneficiarioController();
            $datoBeneficiario = $beneficiario->crearBeneficiario($request);
            // $migracion = new MigracionController();
            // $datoMigracion = $migracion->agregarMigracion($request);
            // dd($datoBeneficiario);

            $data = [
                'afiliado' => $datoAfiliado->original,
                'beneficiario' => $datoBeneficiario->original,
                // 'migracion'=> $datoMigracion->original
            ];

            //cambio
            //buscar si es Beneficiario o titular
            $buscaAfiliado = new AfiliadoController();
            $afiliado = $buscaAfiliado->obtenerAfiliadoTitular($request->DocIdentificacion);
            // return $afiliado->original['data']->id_titular;
            // dd($afiliado->original['success']);
            if ($afiliado->original['success']) {
                // dd('3ntr');
                // sacar el id titular
                $buscaTitular = new TitularController();
                $id_titular = $buscaTitular->buscarTitularCI($request->DocIdentificacion);
                // sacar beneficiario


                //*para agregar en la tabla cambio titular
                $cambio_A_beneficiario = new CambioTitularController();
                $request['id_titular'] = $afiliado->original['data']->id_titular;
                $request['id_afiliado'] = $afiliado->original['data']->id_afiliado;
                $request['id_beneficiario'] = $datoBeneficiario->original['data']->id_beneficiario;
                // dd(
                //     $request['id_titular'],
                //     $request['id_afiliado'],
                //     $request['id_beneficiario'],
                // );
                // $request['id_afiliado'] = $afiliado->data['id_afiliado'];
                $cambioTitular = $cambio_A_beneficiario->crearCambioTitular($request);
                // dd($cambioTitular);
                //! para cambiar el estado del titular
                $cambio_estado = $buscaTitular->actualizaEstadoCambio($request);

                // ir con id titular a actualizar el estado cambio
                //cambiar de Titular a Beneficiario
                //agregar la tabla cambio_titular

                //ya no agregar afiliado, solo optener el ID y llevarlo a beneficiario junto con el id titular
                //cambiar id_tipoafiliado a 3, id_parentesco
            }
            $data['estado_cambio'] = $cambio_estado->original;
            $data['busca titular'] = $cambioTitular->original;
            if (!$datoBeneficiario->original['success']) {
                return response()->json([
                    'success' => false,
                    'message' => 'Fallo al crear Beneficiario',
                    'detalle' => $datoBeneficiario->original,
                ], $datoBeneficiario->original['status']);
            }
            return response()->json([
                'success' => true,
                'message' => 'Beneficiario creado satisfactoriamente',
                'data' => $data,

            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Error al crear el Beneficiario afiliado atravez del sistema SighoV2',
                'error' => $th->getMessage(), //Mensaje del error
                'line' => $th->getLine(),     // Línea donde ocurrió el error
                'file' => $th->getFile(),     // Archivo donde ocurrió el error
                'data' => $datoError
            ], 500);
        }
    }
}
