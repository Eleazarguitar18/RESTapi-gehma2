<?php

namespace App\Models\Afiliacion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Afiliacion\Afiliado;

class EstadoAfiliado extends Model
{
    use HasFactory;
    protected $table = 'tbl_afiliacion_estado_afiliado';
    protected $fillable = [
        'id_estadoAfiliado',
        'DetalleTipoAfiliado',
    ];
    public $timestamps = false;

    public function afiliadoEstadoAfiliado()
    {
        return $this->hasMany(Afiliado::class, 'id_estadoAfiliado');
    }
}
