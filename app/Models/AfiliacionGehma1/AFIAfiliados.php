<?php

namespace App\Models\AfiliacionGehma1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AFIAfiliados extends Model
{
    use HasFactory;
    protected $table = 'dbo.AFIAfiliados';
    protected $connection = 'sqlsrv';
    protected $fillable = [
        'id_afiliado',
        'id_aportante',
        'matricula',
        'apellidoPaterno',
        'apellidoMaterno',
        'nombres',
        'apellidoEsposo',
        'fechaNacimiento',
        'estadoCivil',
        'sexo',
        'tipoIdentificacion',
        'numeroIdentificacion',
        'id_departamento',
        'domicilio',
        'id_zona',
        'telefonoDomicilio',
        'telefonoOficina',
        'telefonoCelular',
        'fechaAfiliacion',
        'nua', //matricula en caso de universitarios
        'grupoSanguineo',
        'alergias',
        'id_institucion',
        'id_area',
        'id_horario',
        'fechaIngreso',
        'id_titularidad',
        'cargoActual',
        'item',
        'salario',
        'estadoVigencia',
        'estado',
        'estadoRequisitos',
        'observaciones',
        'fechaVencimiento',
        'lugarNacimiento',
        'tipoAfiliado',
        'oficina',
        'PrintDate',
        'PrintCounter',
    ];
}
