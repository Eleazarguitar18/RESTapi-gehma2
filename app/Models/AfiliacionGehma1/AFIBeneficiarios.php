<?php

namespace App\Models\AfiliacionGehma1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AFIBeneficiarios extends Model
{
    use HasFactory;
    protected $table = 'dbo.AFIBeneficiarios';
    protected $connection = 'sqlsrv';
    protected $fillable = [
        'id_beneficiario',
        'id_afiliado',
        'Matriculado',
        'apellidoPaterno',
        'apellidoMaterno',
        'nombres',
        'apellidoEsposo',
        'fechaNacimiento',
        'estadoCivil',
        'sexo',
        'tipoBeneficiario',
        'tipoIdentificacion',
        'numeroIdentificacion',
        'id_departamento',
        'fechaAfiliacion',
        'id_institucion',
        'grupoSanguineo',
        'alergias',
        'estadoVigencia',
        'estado',
        'estadoRequisitos',
        'observaciones',
        'domicilio',
        'id_zona',
        'telefonoDomicilio',
        'telefonoOficina',
        'telefonoCelular',
        'fechaVencimiento',
        'lugarNacimiento',
        'cambioEstado',
        'id_aportante',
        'vigenciaTraspazo',
        'id_institucionTrans',
    ];
}
