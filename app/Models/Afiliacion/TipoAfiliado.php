<?php

namespace App\Models\Afiliacion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Afiliacion\Afiliado;

class TipoAfiliado extends Model
{
    use HasFactory;
    protected $table = 'tbl_afiliacion_tipo_afiliado';
    protected $fillable = [
        'id_tipoafiliado',
        'DetalleTipoAfiliado',
    ];
    public function afiliadoTipoAfiliado()
    {
        return $this->hasMany(Afiliado::class, 'id_tipoafiliado');
    }
}
