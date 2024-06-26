<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;

    protected $table = 'empleados'; 

    protected $fillable = [
        'nombre',
        'telefono',
        'email',
        'descrpcion',
    ];

   
    public function agendamientos()
    {
        return $this->hasMany(Agendamiento::class);
    }
}
