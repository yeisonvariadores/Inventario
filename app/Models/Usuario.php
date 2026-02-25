<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;

class Usuario extends Model
{
    use HasFactory;

    protected $table = 'usuarios';

    protected $fillable = [
        'nombre',
        'correo',
        'dni',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELACIONES
    |--------------------------------------------------------------------------
    */

    // 🔗 Un usuario tiene muchas asignaciones
    public function asignaciones()
    {
        return $this->hasMany(Asignacion::class);
    }

    // 🔗 Un usuario tiene muchos equipos (histórico)
    public function equipos()
    {
        return $this->belongsToMany(Equipo::class, 'asignaciones')
            ->withPivot('fecha_asignacion', 'fecha_devolucion')
            ->withTimestamps();
    }

    // 🔗 Equipo actualmente asignado (activo)
    public function equipoActual()
    {
        return $this->belongsToMany(Equipo::class, 'asignaciones')
            ->wherePivotNull('fecha_devolucion')
            ->latest('fecha_asignacion');
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    public function scopeBuscarUsuario(Builder $query, $value)
    {
        if (blank($value)) {
            return $query;
        }

        return $query->where(function ($q) use ($value) {
            $q->where('nombre', 'like', "%{$value}%")
              ->orWhere('correo', 'like', "%{$value}%")
              ->orWhere('dni', 'like', "%{$value}%");
        });
    }
}
