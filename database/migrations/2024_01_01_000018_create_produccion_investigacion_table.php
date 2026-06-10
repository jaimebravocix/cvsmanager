<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('produccion_investigacion', function (Blueprint $table) {
            $table->id();
            $table->foreignId('persona_id')->constrained('personas')->cascadeOnDelete();
            $table->text('titulo');
            $table->enum('rol', ['Investigador Principal', 'Co-investigador', 'Asesor', 'Colaborador']);
            $table->string('codigo_proyecto', 100)->nullable();
            $table->string('entidad_financiadora', 300)->nullable();
            $table->enum('ambito', ['Institucional', 'Nacional', 'Internacional'])->nullable();
            $table->decimal('monto_financiado', 12, 2)->nullable();
            $table->string('moneda', 10)->nullable()->default('PEN');
            $table->date('fecha_inicio')->nullable();
            $table->date('fecha_fin')->nullable();
            $table->enum('estado', ['En Ejecución', 'Concluido', 'Suspendido', 'En Formulación'])->default('En Ejecución');
            $table->string('resolucion_aprobacion', 100)->nullable();
            $table->text('descripcion')->nullable();
            $table->string('archivo')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('produccion_investigacion');
    }
};
