<?php

namespace App\Models\Afiliacion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Afiliacion\Afiliado;

class GrupoSanguineo extends Model
{
    use HasFactory;
    protected $table = 'tbl_afiliacion_grupo_sanguineo';
    protected $fillable = [
        'id_gruposanguineo',
        'descripcionGrupoSanguineo',
    ];
    public function afiliadoGrupoSanguineo()
    {
        return $this->hasMany(Afiliado::class, 'id_gruposanguineo');
    }
}
