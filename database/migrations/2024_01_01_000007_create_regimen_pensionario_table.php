<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('regimen_pensionario', function (Blueprint $table) {
            $table->id();
            $table->foreignId('persona_id')->constrained('personas')->cascadeOnDelete();
            $table->enum('tipo', ['ONP', 'AFP', 'Ninguno', 'Otro']);
            $table->string('nombre_afp', 100)->nullable();
            $table->string('numero_cuspp', 50)->nullable();
            $table->date('fecha_afiliacion')->nullable();
            $table->string('archivo')->nullable();
            $table->text('observaciones')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('regimen_pensionario');
    }
};
