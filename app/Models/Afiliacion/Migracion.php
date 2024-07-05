<?php

namespace App\Models\Afiliacion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Migracion extends Model
{
    use HasFactory;
    protected $table = 'dbo.tbl_migracion_afiliado_sighov2';
    protected $connection = 'sqlsrv';
    protected $fillable = [
        'id_migracion',
        'id_afiliado',
        'estado_migracion',
    ];
    public $timestamps = false;
}
