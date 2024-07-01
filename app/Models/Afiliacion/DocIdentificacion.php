<?php

namespace App\Models\Afiliacion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Afiliacion\Afiliado;

class DocIdentificacion extends Model
{
    use HasFactory;
    protected $table = 'tbl_afiliacion_doc_identificacion';
    protected $fillable = [
        'id_tipoidentificacion',
        'TipoIdentificacion',
        'SiglaIdentificacion',
    ];
    public $timestamps = false;

    public function afiliadoDocIdentificacion()
    {
        return $this->hasMany(Afiliado::class, 'id_tipoidentificacion');
    }
}
