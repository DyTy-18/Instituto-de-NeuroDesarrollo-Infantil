<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Especialista;

class EspecialistasSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['nombre' => 'Pamela Mamani',  'especialidad' => 'psicomotricidad'],
            ['nombre' => 'Carla Carpero',  'especialidad' => 'fonoaudiologia'],
            ['nombre' => 'Brittany Lara',  'especialidad' => 'fonoaudiologia'],
        ];

        foreach ($data as $row) {
            Especialista::firstOrCreate(['nombre' => $row['nombre']], $row);
        }
    }
}
