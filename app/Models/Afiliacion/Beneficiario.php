<?php

namespace App\Models\Afiliacion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beneficiario extends Model
{
    use HasFactory;
    protected $table = 'tbl_afiliacion_beneficiario';
    protected $fillable = [
        'id_beneficiario',
        'id_afiliado',
        'id_titular',
        'id_parentesco',
        'fechaAfiliacion',
        'estadoRequisitos',
        'observaciones',
        'fechaVencimiento',
        'estado_cambio',
        'idUsuario',
    ];
    public $timestamps = false;

    public function parentescoBeneficiarioBeneficiario()
    {
        return $this->belongsTo(ParentescoBeneficiario::class, 'id_beneficiario');
    }
}
