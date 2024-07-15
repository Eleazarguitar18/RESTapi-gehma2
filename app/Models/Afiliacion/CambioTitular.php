<?php

namespace App\Models\Afiliacion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CambioTitular extends Model
{
    use HasFactory;
    protected $table = 'tbl_afiliacion_cambio_titular';
    protected $fillable = [
        'id_cambio',
        'id_titular',
        'id_beneficiario',
        'id_afiliado',
        'Fecha_Cambio',
        'id_tipo_cambio',
        'id_Usuario',
    ];
    public $timestamps = false;
}
