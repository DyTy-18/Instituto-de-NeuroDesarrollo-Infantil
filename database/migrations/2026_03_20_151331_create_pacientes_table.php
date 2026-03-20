<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pacientes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_nino', 100);
            $table->unsignedTinyInteger('edad');
            $table->string('escolaridad', 100);
            $table->string('tutores', 255);
            $table->enum('especialidad', ['fonoaudiologia', 'quiropraxia']);
            $table->foreignId('especialista_id')->constrained('especialistas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pacientes');
    }
};
