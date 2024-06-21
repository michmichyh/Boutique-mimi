<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'email', 'telefono'];

    public function agendamientos()
    {
        return $this->hasMany(Agendamiento::class);
    }
}
