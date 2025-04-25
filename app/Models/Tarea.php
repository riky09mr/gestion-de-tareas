<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    protected $fillable = ['titulo', 'descripcion', 'estado', 'fecha_vencimiento', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

   const ESTADOS = [
    'Pendiente' => 1,
    'En progreso' => 2,
    'Completada' => 3,
   ];
}
