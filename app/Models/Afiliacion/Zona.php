<?php

namespace App\Models\Afiliacion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Afiliacion\Afiliado;

class Zona extends Model
{
    use HasFactory;
    protected $table = 'tbl_afiliacion_zona';
    protected $fillable = [
        'id_zona',
        'descripcionZona',
    ];
    public function afiliadoZona()
    {
        return $this->hasMany(Afiliado::class, 'id_zona');
    }
}
