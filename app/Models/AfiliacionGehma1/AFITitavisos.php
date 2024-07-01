<?php

namespace App\Models\AfiliacionGehma1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AFITitavisos extends Model
{
    use HasFactory;
    protected $table = 'dbo.AFITitavisos';
    protected $connection = 'sqlsrv';
    protected $fillable = [
        'id_avisostit',
        'id_afiliado',
        'id_tipoAviso',
        'fecha',
        'id_institucion',
        'observacion',
    ];
}
