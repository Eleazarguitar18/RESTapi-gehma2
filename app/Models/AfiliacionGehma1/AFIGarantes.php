<?php

namespace App\Models\AfiliacionGehma1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AFIGarantes extends Model
{
    use HasFactory;
    protected $table = 'dbo.AFIGarantes';
    protected $connection = 'sqlsrv';
    protected $fillable = [
        'id_garante',
        'id_afiliadoGarante',
        'id_afiliadoConvenio',
        'apellidoPaterno',
        'apellidoMaterno',
        'nombres',
        'tipoDocumento',
        'numeroDocumento',
        'id_departamento',
        'direccion',
        'zona',
        'telefonoDomicilio',
        'telefonoCelular',
        'telefonoReferencia',
        'lugarTrabajo',
        'telefonoTrabajo',
        'telefonoTrabajoInt',
    ];
}
