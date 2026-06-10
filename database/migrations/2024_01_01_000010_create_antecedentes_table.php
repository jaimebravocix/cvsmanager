<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('antecedentes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('persona_id')->constrained('personas')->cascadeOnDelete();
            $table->enum('tipo', ['Penal', 'Judicial', 'Policial', 'REDAM', 'Otro']);
            $table->enum('resultado', ['Sin antecedentes', 'Con antecedentes', 'No aplica'])->default('Sin antecedentes');
            $table->string('entidad', 200)->nullable();
            $table->date('fecha_emision');
            $table->date('fecha_vencimiento')->nullable();
            $table->string('numero_certificado', 100)->nullable();
            $table->string('archivo')->nullable();
            $table->text('detalle')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('antecedentes');
    }
};
