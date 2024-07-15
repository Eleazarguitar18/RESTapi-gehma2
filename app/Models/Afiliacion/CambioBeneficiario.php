<?php

namespace App\Models\Afiliacion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CambioBeneficiario extends Model
{
    use HasFactory;
    protected $table = 'tbl_afiliacion_cambio_beneficiario';
    protected $fillable = [
        'id_cambioB',
        'id_beneficiario',
        'id_titular',
        'id_afiliado',
        'Fecha_Cambio',
        'id_tipo_cambio',
        'id_titularB',
        'id_parentesco',
        'id_Usuario',
    ];
    public $timestamps = false;
}
