<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;

class Asignacion extends Model
{
    use HasFactory;

    protected $table = 'asignaciones';

    protected $fillable = [
        'usuario_id',
        'equipo_id',
        'fecha_asignacion',
        'fecha_devolucion',
    ];

    protected $casts = [
        'fecha_asignacion' => 'datetime',
        'fecha_devolucion' => 'datetime',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELACIONES
    |--------------------------------------------------------------------------
    */

    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }

    public function equipo()
    {
        return $this->belongsTo(Equipo::class);
    }

    /*
    |--------------------------------------------------------------------------
    | HELPERS
    |--------------------------------------------------------------------------
    */

    public function estaActiva()
    {
        return is_null($this->fecha_devolucion);
    }

    public function scopeBuscarAsignacion(Builder $query, $value)
    {
        if (empty($value)) {
            return $query;
        }

        return $query->where(function ($q) use ($value) {

            // 🔎 Buscar en Usuario
            $q->whereHas('usuario', function ($usuarioQuery) use ($value) {
                $usuarioQuery->where('nombre', 'like', "%{$value}%")
                    ->orWhere('correo', 'like', "%{$value}%")
                    ->orWhere('dni', 'like', "%{$value}%");
            })

            // 🔎 Buscar en Equipo
            ->orWhereHas('equipo', function ($equipoQuery) use ($value) {
                $equipoQuery->where('marca', 'like', "%{$value}%")
                    ->orWhere('modelo', 'like', "%{$value}%")
                    ->orWhere('serial', 'like', "%{$value}%");
            });

        });
    }
}
