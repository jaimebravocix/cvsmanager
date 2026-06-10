<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('reconocimientos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('persona_id')->constrained('personas')->cascadeOnDelete();
            $table->enum('tipo', [
                'Premio', 'Distinción', 'Beca', 'Honor al Mérito',
                'Ciudadano Ilustre', 'Reconocimiento Institucional',
                'Medalla', 'Diploma de Honor', 'Otro'
            ]);
            $table->string('descripcion', 400);
            $table->string('institucion_otorgante', 300);
            $table->string('pais', 100)->nullable();
            $table->date('fecha');
            $table->string('resolucion', 100)->nullable();
            $table->string('archivo')->nullable();
            $table->text('detalle')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('reconocimientos');
    }
};
