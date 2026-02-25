<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('equipos', function (Blueprint $table) {
            $table->id();
            $table->string('activo_fijo');
            $table->string('marca');
            $table->string('serial')->unique();
            $table->string('modelo');
            $table->string('ram');
            $table->string('sistema_operativo');
            $table->string('almacenamiento');

            // FK estado
            $table->foreignId('estado_id')
                ->nullable()
                ->constrained('estados')
                ->nullOnDelete()
                ->cascadeOnUpdate();

            // FK ciudad
            $table->foreignId('ciudad_id')
                ->nullable()
                ->constrained('ciudades')
                ->nullOnDelete()
                ->cascadeOnUpdate();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipos');
    }
};
