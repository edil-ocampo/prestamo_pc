<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Componente extends Model
{
    use HasFactory;
    protected $table = 'tbl_componentes';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
      'nombre',
    ];

    public function computadores()
    {
        return $this->belongsToMany(Computador::class, 'tbl_computador_componente', 'id_componente', 'id_computador');
    }
}

