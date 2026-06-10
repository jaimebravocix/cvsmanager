<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('licencias_profesionales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('persona_id')->constrained('personas')->cascadeOnDelete();
            $table->string('nombre_licencia', 300);
            $table->enum('tipo', ['Colegiatura Profesional', 'Licencia de Ejercicio', 'Habilitación Profesional', 'Certificación Profesional', 'Otro']);
            $table->string('institucion_emisora', 300);
            $table->string('numero_licencia', 100)->nullable();
            $table->string('especialidad', 200)->nullable();
            $table->date('fecha_emision')->nullable();
            $table->date('fecha_vencimiento')->nullable();
            $table->boolean('vigente')->default(true);
            $table->string('pais', 100)->nullable()->default('Perú');
            $table->string('archivo')->nullable();
            $table->text('observaciones')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('licencias_profesionales');
    }
};
