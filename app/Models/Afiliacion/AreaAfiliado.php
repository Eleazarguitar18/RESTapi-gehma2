<?php

namespace App\Models\Afiliacion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Afiliacion\InstitucionTitular;

class AreaAfiliado extends Model
{
    use HasFactory;
    protected $table = 'tbl_afiliacion_area_afiliado';
    protected $fillable = [
        'id_area',
        'descripcionArea',
    ];
    public $timestamps = false;

    public function institucionTitularArea()
    {
        return $this->hasMany(InstitucionTitular::class, 'id_area');
    }
}
