<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('formacion_academica', function (Blueprint $table) {
            $table->id();
            $table->foreignId('persona_id')->constrained('personas')->cascadeOnDelete();
            $table->enum('nivel', [
                'Doctorado', 'Maestría', 'Segunda Especialidad',
                'Licenciatura', 'Bachillerato', 'Técnico Superior',
                'Diplomado', 'Curso de Especialización', 'Curso',
                'Certificación', 'Otro'
            ]);
            $table->string('especialidad', 300);
            $table->string('mencion', 300)->nullable();
            $table->string('institucion', 300);
            $table->string('pais', 100)->nullable()->default('Perú');
            $table->year('anio_inicio')->nullable();
            $table->year('anio_fin')->nullable();
            $table->date('fecha_grado')->nullable();
            $table->string('numero_resolucion', 100)->nullable();
            $table->string('numero_registro_sunedu', 100)->nullable();
            $table->boolean('es_titulo_habilitante')->default(false);
            $table->string('archivo')->nullable();
            $table->text('observaciones')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('formacion_academica');
    }
};
