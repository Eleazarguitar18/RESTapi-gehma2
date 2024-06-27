<?php

namespace App\Models\Afiliacion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Afiliacion\InstitucionTitular;

class Titular extends Model
{
    use HasFactory;
    protected $table = 'tbl_afiliacion_titular';
    protected $fillable = [
        'id_titular',
        'id',
        'id_afiliado',
        'fechaAfiliacion',
        'nua', //Matricula Universitaria
        'estadoRequisitos',
        'fechaVencimiento',
        'observaciones',
        'estado_cambio',
        'estado_vigencia',
        'idUsuario',
        'indefinido',
    ];
    public function institucionTitularTitular()
    {
        return $this->hasMany(InstitucionTitular::class, 'id_titular');
    }
}
