<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Especialista extends Model
{
    protected $fillable = ['nombre', 'especialidad', 'activo'];

    public function pacientes()
    {
        return $this->hasMany(Paciente::class);
    }
}
