<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('direcciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('persona_id')->constrained('personas')->cascadeOnDelete();
            $table->enum('tipo', ['domicilio', 'trabajo', 'otro'])->default('domicilio');
            $table->text('direccion');
            $table->string('urbanizacion', 150)->nullable();
            $table->string('distrito', 100)->nullable();
            $table->string('provincia', 100)->nullable();
            $table->string('departamento', 100)->nullable();
            $table->string('pais', 100)->nullable()->default('Perú');
            $table->string('codigo_postal', 20)->nullable();
            $table->text('referencia')->nullable();
            $table->boolean('principal')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('direcciones');
    }
};
