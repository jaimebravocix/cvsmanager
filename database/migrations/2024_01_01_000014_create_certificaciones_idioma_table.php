<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('certificaciones_idioma', function (Blueprint $table) {
            $table->id();
            $table->foreignId('persona_id')->constrained('personas')->cascadeOnDelete();
            $table->string('idioma', 100);
            $table->enum('nivel_comprension', ['A1', 'A2', 'B1', 'B2', 'C1', 'C2', 'Nativo'])->nullable();
            $table->enum('nivel_escritura', ['A1', 'A2', 'B1', 'B2', 'C1', 'C2', 'Nativo'])->nullable();
            $table->enum('nivel_habla', ['A1', 'A2', 'B1', 'B2', 'C1', 'C2', 'Nativo'])->nullable();
            $table->string('examen_certificacion', 100)->nullable();
            $table->string('puntaje', 50)->nullable();
            $table->string('institucion', 200)->nullable();
            $table->date('fecha')->nullable();
            $table->date('fecha_vencimiento')->nullable();
            $table->string('archivo')->nullable();
            $table->text('observaciones')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('certificaciones_idioma');
    }
};
