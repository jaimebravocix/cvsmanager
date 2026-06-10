<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('congresos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('persona_id')->constrained('personas')->cascadeOnDelete();
            $table->string('nombre', 400);
            $table->enum('tipo', ['Congreso', 'Simposio', 'Seminario', 'Taller', 'Coloquio', 'Conferencia', 'Foro', 'Jornada', 'Otro']);
            $table->enum('ambito', ['Local', 'Nacional', 'Internacional']);
            $table->date('fecha_inicio');
            $table->date('fecha_fin')->nullable();
            $table->string('ciudad', 100)->nullable();
            $table->string('pais', 100)->nullable();
            $table->string('institucion_organizadora', 300)->nullable();
            $table->integer('numero_horas')->nullable();
            $table->text('tematica')->nullable();
            $table->enum('rol_participacion', ['Asistente', 'Ponente', 'Conferencista', 'Organizador', 'Moderador', 'Otro'])->default('Asistente');
            $table->string('titulo_ponencia', 400)->nullable();
            $table->string('numero_certificado', 100)->nullable();
            $table->string('archivo_certificado')->nullable();
            $table->text('observaciones')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('congresos');
    }
};
