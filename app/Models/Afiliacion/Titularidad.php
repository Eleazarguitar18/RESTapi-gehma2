<?php

namespace App\Models\Afiliacion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Afiliacion\InstitucionTitular;

class Titularidad extends Model
{
    use HasFactory;
    protected $table = 'tbl_afiliacion_titularidad';
    protected $fillable = [
        'id_titularidad',
        'nombreTitularidad',
    ];
    public $timestamps = false;

    public function institucionTitularTitularidad()
    {
        return $this->hasMany(InstitucionTitular::class, 'id_titularidad');
    }
}
