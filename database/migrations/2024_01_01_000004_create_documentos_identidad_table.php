<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('documentos_identidad', function (Blueprint $table) {
            $table->id();
            $table->foreignId('persona_id')->constrained('personas')->cascadeOnDelete();
            $table->enum('tipo', ['DNI', 'Pasaporte', 'Carnet de Extranjería', 'RUC', 'Otro']);
            $table->string('numero', 50);
            $table->string('pais_emision', 100)->nullable()->default('Perú');
            $table->date('fecha_emision')->nullable();
            $table->date('fecha_vencimiento')->nullable();
            $table->string('archivo')->nullable();
            $table->boolean('principal')->default(false);
            $table->text('observaciones')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('documentos_identidad');
    }
};
