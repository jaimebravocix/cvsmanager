<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('cuentas_haberes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('persona_id')->constrained('personas')->cascadeOnDelete();
            $table->string('banco', 100);
            $table->string('numero_cuenta', 30);
            $table->enum('tipo_cuenta', ['corriente', 'ahorros', 'otro'])->default('ahorros');
            $table->string('cci', 30)->nullable();
            $table->enum('moneda', ['PEN', 'USD', 'EUR'])->default('PEN');
            $table->boolean('principal')->default(false);
            $table->text('observaciones')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('cuentas_haberes');
    }
};
