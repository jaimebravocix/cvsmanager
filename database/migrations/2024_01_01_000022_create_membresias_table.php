<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('membresias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('persona_id')->constrained('personas')->cascadeOnDelete();
            $table->string('institucion', 300);
            $table->string('siglas', 50)->nullable();
            $table->enum('ambito', ['Nacional', 'Internacional'])->default('Internacional');
            $table->string('tipo_membresia', 100)->nullable();
            $table->string('numero_membresia', 100)->nullable();
            $table->date('fecha_inicio');
            $table->date('fecha_fin')->nullable();
            $table->boolean('vigente')->default(true);
            $table->string('rol_cargo', 200)->nullable();
            $table->string('archivo')->nullable();
            $table->text('descripcion')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('membresias');
    }
};
