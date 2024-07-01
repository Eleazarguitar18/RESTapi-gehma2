<?php

namespace App\Models\AfiliacionGehma1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AFIBenAvisos extends Model
{
    use HasFactory;
    protected $table = 'dbo.AFIBenAvisos';
    protected $connection = 'sqlsrv';
    protected $fillable = [
        'id_avisoBen',
        'id_beneficiarios',
        'id_TipoAviso',
        'fecha',
        'id_institucion',
        'Observacion',
    ];
}
