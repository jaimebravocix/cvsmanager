<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('registros_institucionales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('persona_id')->constrained('personas')->cascadeOnDelete();
            $table->string('institucion', 200);
            $table->string('tipo_registro', 200)->nullable();
            $table->string('numero_registro', 100)->nullable();
            $table->date('fecha_registro')->nullable();
            $table->date('fecha_vencimiento')->nullable();
            $table->string('categoria', 100)->nullable();
            $table->string('especialidad', 200)->nullable();
            $table->boolean('vigente')->default(true);
            $table->string('archivo')->nullable();
            $table->text('observaciones')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('registros_institucionales');
    }
};
