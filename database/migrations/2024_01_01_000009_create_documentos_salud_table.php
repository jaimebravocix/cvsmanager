<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('documentos_salud', function (Blueprint $table) {
            $table->id();
            $table->foreignId('persona_id')->constrained('personas')->cascadeOnDelete();
            $table->enum('tipo', [
                'Examen Médico Ocupacional',
                'Seguro de Salud',
                'Historia Clínica',
                'Vacunación',
                'Discapacidad',
                'Otro'
            ]);
            $table->string('descripcion', 300);
            $table->string('entidad', 200)->nullable();
            $table->date('fecha_emision')->nullable();
            $table->date('fecha_vencimiento')->nullable();
            $table->string('numero_documento', 100)->nullable();
            $table->string('archivo')->nullable();
            $table->text('observaciones')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('documentos_salud');
    }
};
