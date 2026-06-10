<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('produccion_bibliografica', function (Blueprint $table) {
            $table->id();
            $table->foreignId('persona_id')->constrained('personas')->cascadeOnDelete();
            $table->enum('tipo', [
                'Libro', 'Texto Universitario', 'Material Didáctico',
                'Guía de Laboratorio', 'Manual', 'Módulo de Enseñanza',
                'Artículo de Divulgación', 'Otro'
            ]);
            $table->text('titulo');
            $table->text('autores');
            $table->string('editorial', 200)->nullable();
            $table->string('lugar_edicion', 200)->nullable();
            $table->year('anio_publicacion')->nullable();
            $table->string('isbn', 50)->nullable();
            $table->integer('numero_edicion')->nullable();
            $table->integer('numero_paginas')->nullable();
            $table->string('enlace_url', 500)->nullable();
            $table->string('archivo')->nullable();
            $table->text('descripcion')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('produccion_bibliografica');
    }
};
