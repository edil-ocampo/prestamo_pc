<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Computador extends Model
{
    use HasFactory;

      protected $table = 'tbl_computadores';
      protected $primaryKey = 'id';
      public $timestamps = false;
      protected $fillable = [
        'documento',
        'nombres',
        'serial',
        'componente',
        'fecha',
        'estado',
      ];

      public function componentes()
      {

        return $this->hasMany(ComputadorComponente::class, 'id_computador');
      
      }

      public function allComponentes()
{
    return $this->belongsToMany(Componente::class, 'tbl_computador_componente', 'id_computador', 'id_componente');
}

}