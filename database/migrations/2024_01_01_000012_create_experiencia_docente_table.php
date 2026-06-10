<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('experiencia_docente', function (Blueprint $table) {
            $table->id();
            $table->foreignId('persona_id')->constrained('personas')->cascadeOnDelete();
            $table->string('institucion', 300);
            $table->string('pais', 100)->nullable()->default('Perú');
            $table->string('facultad', 200)->nullable();
            $table->string('departamento', 200)->nullable();
            $table->string('curso_asignatura', 300)->nullable();
            $table->enum('categoria', ['Auxiliar', 'Asociado', 'Principal', 'Contratado', 'Jefe de Práctica', 'Otro'])->nullable();
            $table->enum('condicion', ['Ordinario', 'Extraordinario', 'Contratado'])->nullable();
            $table->enum('regimen', ['Tiempo Completo', 'Tiempo Parcial', 'Dedicación Exclusiva', 'Por Horas'])->nullable();
            $table->string('nivel_educativo', 100)->nullable();
            $table->integer('horas_semanales')->nullable();
            $table->date('fecha_inicio');
            $table->date('fecha_fin')->nullable();
            $table->boolean('trabajo_actual')->default(false);
            $table->string('resolucion', 100)->nullable();
            $table->string('archivo')->nullable();
            $table->text('descripcion')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('experiencia_docente');
    }
};
