<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('experiencia_profesional', function (Blueprint $table) {
            $table->id();
            $table->foreignId('persona_id')->constrained('personas')->cascadeOnDelete();
            $table->string('institucion', 300);
            $table->string('pais', 100)->nullable()->default('Perú');
            $table->string('cargo', 200);
            $table->string('area', 200)->nullable();
            $table->enum('tipo', ['Pública', 'Privada', 'ONG', 'Consultora', 'Independiente', 'Otro'])->nullable();
            $table->date('fecha_inicio');
            $table->date('fecha_fin')->nullable();
            $table->boolean('trabajo_actual')->default(false);
            $table->text('descripcion_funciones')->nullable();
            $table->string('archivo')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('experiencia_profesional');
    }
};
