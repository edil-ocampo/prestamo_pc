<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComputadorComponente extends Model
{
    use HasFactory;
    protected $table = 'tbl_computador_componente';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
      'id_computador',
      'id_componente',
    ];
    
    public function computador()
    {
        return $this->belongsTo(Computador::class, 'id_computador');
    }

    public function componente()
    {
        return $this->belongsTo(Componente::class, 'id_componente');
    }
}
