<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\Afiliacion\DepartamentoController;
use App\Http\Controllers\Afiliacion\GrupoSaguineoController;
use App\Http\Controllers\TitularSIGHO2Controller;
use App\Http\Controllers\Afiliacion\TitularController;
use App\Http\Controllers\Afiliacion\AfiliadoController;
use App\Http\Controllers\Afiliacion\TipoAfiliadoController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/inicio', [InicioController::class, 'funcionInicio']);
Route::get('/departamentos', [DepartamentoController::class, 'listarDepartamentos']);
Route::get('/gruposanguineo', [GrupoSaguineoController::class, 'listarGrupoSanguineo']);

Route::post('/departamento', [TitularSIGHO2Controller::class, 'crearTitularConSigho']);
Route::post('/titularsigho', [TitularSIGHO2Controller::class, 'crearTitularConSigho']);
// rutas crud de titutlar
Route::get('/titular', [TitularController::class, 'listarTitular']);
Route::post('/titular', [TitularController::class, 'crearTitular']);
Route::get('/titular/{id}', [TitularController::class, 'obtenerTitular']);
// rutas crud de afiliado
Route::get('/afiliado', [TitularController::class, 'listarAfiliado']);
Route::post('/afiliado', [AfiliadoController::class, 'crearAfiliado']);
Route::get('/afiliado/{id}', [AfiliadoController::class, 'obtenerAfiliado']);
//tipo afiliado
Route::get('/tipoafiliado', [TipoAfiliadoController::class, 'listar']);
