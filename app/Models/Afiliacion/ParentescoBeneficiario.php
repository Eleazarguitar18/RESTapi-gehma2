<?php

namespace App\Models\Afiliacion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Afiliacion\Beneficiario;

class ParentescoBeneficiario extends Model
{
    use HasFactory;
    protected $table = 'tbl_afiliacion_parentesco_beneficiario';
    protected $fillable = [
        'id_parentesco',
        'DetalleParentesco',
    ];

    public function beneficiarioParentescoBeneficiario()
    {
        return $this->hasMany(Afiliado::class, 'id_parentesco');
    }
}
