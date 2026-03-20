<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    protected $fillable = [
        'nombre_nino', 'edad', 'escolaridad',
        'tutores', 'especialidad', 'especialista_id',
    ];

    public function especialista()
    {
        return $this->belongsTo(Especialista::class);
    }
}
