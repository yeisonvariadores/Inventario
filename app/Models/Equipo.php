<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Livewire\Attributes\Url;

class Equipo extends Model
{
    use HasFactory;

    protected $table = 'equipos';

    protected $fillable = [
        'activo_fijo',
        'marca',
        'serial',
        'modelo',
        'ram',
        'sistema_operativo',
        'almacenamiento',
        'estado_id',
        'ciudad_id',
    ];

    // ============================================================
    // CONFIGURACIÓN DE ORDENAMIENTO DE TABLA - HISTORIAL Y FILTROS
    // ============================================================
    #[Url(history:TRUE)]
    Public $sortBy = 'created_at';
    public $sortDirection = 'ASC';
    protected array $sortTable = [
        'id' => 'equipos.id',
        'marca' => 'equipos.marca',
        'modelo' => 'equipos.modelo',
        'serial' => 'equipos.serial',
        'activo_fijo' => 'equipos.activo_fijo',
        'almacenamiento' => 'equipos.almacenamiento',
        'ram' => 'equipos.ram',
        'sistema_operativo' => 'equipos.sistema_operativo',
        'created_at' => 'equipos.created_at',
        'estado_id' => 'equipos.estado_id',
        'ciudad_id' => 'equipos.ciudad_id',
    ];

    public function setSortBy(string $field)
    {
        if ($this->sortBy === $field) {
            $this->sortDirection = $this->sortDirection === 'ASC' ? 'DESC' : 'ASC';
        } else {
            $this->sortBy = $field;
            $this->sortDirection = 'ASC';
        }

        $this->resetPage();
    }


    // ============================================================
    // FINAL DE LA CONFIGURACIÓN DE FILTROS Y ORDENAMIENTO
    // ============================================================

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */

    protected function almacenamiento(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value . ' GB'
        );
    }

    protected function ram(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value . ' GB'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | RELACIONES
    |--------------------------------------------------------------------------
    */

    // 🔗 Un equipo pertenece a un estado
    public function estado()
    {
        return $this->belongsTo(Estado::class);
    }

    // 🔗 Un equipo pertenece a una ciudad
    public function ciudad()
    {
        return $this->belongsTo(Ciudad::class);
    }

    // 🔗 Un equipo tiene muchas asignaciones
    public function asignaciones()
    {
        return $this->hasMany(Asignacion::class);
    }

    // 🔗 Usuarios que lo han tenido
    public function usuarios()
    {
        return $this->belongsToMany(Usuario::class, 'asignaciones')
            ->withPivot('fecha_asignacion', 'fecha_devolucion')
            ->withTimestamps();
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    public function scopeBuscar(Builder $query, $value)
    {
        if (blank($value)) {
            return $query;
        }

        return $query->where(function ($q) use ($value) {
            $q->where('serial', 'like', "%{$value}%")
              ->orWhere('marca', 'like', "%{$value}%")
              ->orWhere('modelo', 'like', "%{$value}%")
              ->orWhereHas('estado', function ($e) use ($value) {
                  $e->where('nombre', 'like', "%{$value}%");
              })
              ->orWhereHas('ciudad', function ($c) use ($value) {
                  $c->where('nombre', 'like', "%{$value}%");
              });
        });
    }
}
