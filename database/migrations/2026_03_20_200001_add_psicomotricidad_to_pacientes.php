<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE pacientes MODIFY COLUMN especialidad ENUM('fonoaudiologia', 'quiropraxia', 'psicomotricidad') NOT NULL");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE pacientes MODIFY COLUMN especialidad ENUM('fonoaudiologia', 'quiropraxia') NOT NULL");
    }
};
