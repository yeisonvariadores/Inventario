<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ciudad extends Model
{
    use HasFactory;
    protected $table = 'ciudades';

    protected $fillable = ['nombre'];

    public function equipos()
    {
        return $this->hasMany(Equipo::class);
    }
}
