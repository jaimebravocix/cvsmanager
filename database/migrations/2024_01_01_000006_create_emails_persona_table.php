<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('emails_persona', function (Blueprint $table) {
            $table->id();
            $table->foreignId('persona_id')->constrained('personas')->cascadeOnDelete();
            $table->enum('tipo', ['personal', 'institucional', 'otro'])->default('personal');
            $table->string('email');
            $table->boolean('principal')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('emails_persona');
    }
};
