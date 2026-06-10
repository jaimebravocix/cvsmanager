<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('produccion_cientifica', function (Blueprint $table) {
            $table->id();
            $table->foreignId('persona_id')->constrained('personas')->cascadeOnDelete();
            $table->enum('tipo', [
                'Artículo Científico', 'Artículo de Revisión',
                'Libro', 'Capítulo de Libro', 'Ponencia en Congreso',
                'Patente', 'Reporte Técnico', 'Tesis Asesorada',
                'Software', 'Otro'
            ]);
            $table->text('titulo');
            $table->text('autores');
            $table->string('revista_editorial', 300)->nullable();
            $table->string('volumen', 50)->nullable();
            $table->string('numero', 50)->nullable();
            $table->string('paginas', 50)->nullable();
            $table->string('doi', 200)->nullable();
            $table->string('issn_isbn', 50)->nullable();
            $table->year('anio_publicacion')->nullable();
            $table->enum('indexacion', ['Scopus', 'Web of Science', 'PubMed', 'Latindex', 'SciELO', 'Redalyc', 'Sin indexar', 'Otro'])->nullable();
            $table->string('cuartil', 10)->nullable();
            $table->integer('factor_impacto')->nullable();
            $table->string('enlace_url', 500)->nullable();
            $table->string('archivo')->nullable();
            $table->text('observaciones')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('produccion_cientifica');
    }
};
