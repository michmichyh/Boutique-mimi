<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agendamiento extends Model
{
    use HasFactory;

    protected $fillable = [
        'cliente_id', 

        'empleado_id', 
        
        'fecha_hora',
    ];

    // Relación con Cliente (muchos a uno)
    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    // Relación con Empleado (muchos a uno)
    public function empleado()
    {
        return $this->belongsTo(Empleado::class);
    }
}
