<?php

namespace Database\Seeders;

use App\Models\Docente;
use App\Models\Docente_materia;
use App\Models\Materia;
use App\Models\Periodo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Docente_MateriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $materias =  Materia::factory(20)->create();
        $periodos = Periodo::factory(29)->create();
        foreach ($materias as $materia) {
            Docente_materia::factory(1)->create([
                'materia_id' => $materia->id,
                'docente_id' => Docente::all()->random()->id,
                'periodo_id' => $periodos->random()->id
            ]);
            // $materia->docentes()->attach([
            //     rand(1, 2),
                
            // ]);
        }
    }
}
