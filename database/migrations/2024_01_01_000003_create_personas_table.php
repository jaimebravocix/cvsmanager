<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('personas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('apellido_paterno', 100);
            $table->string('apellido_materno', 100);
            $table->string('nombres', 200);
            $table->enum('sexo', ['M', 'F'])->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->string('lugar_nacimiento', 200)->nullable();
            $table->string('pais_nacimiento', 100)->nullable()->default('Perú');
            $table->enum('estado_civil', ['soltero', 'casado', 'divorciado', 'viudo', 'conviviente', 'otro'])->nullable();
            $table->string('telefono', 20)->nullable();
            $table->string('celular', 20)->nullable();
            $table->enum('tipo_personal', ['docente', 'administrativo', 'ambos'])->default('docente');
            $table->string('codigo_personal', 50)->nullable()->unique();
            $table->string('foto')->nullable();
            $table->text('resumen_profesional')->nullable();
            $table->boolean('activo')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void {
        Schema::dropIfExists('personas');
    }
};
