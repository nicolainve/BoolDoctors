<?php

use Illuminate\Database\Seeder;
use App\Specialization;

class SpecializationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $specializations = [
            [
                'type' => 'Dentista',
                'fontawesome' => '<i class="fas fa-tooth"></i>'
            ],
            [
                'type' => 'Ginecologo',
                'fontawesome' => '<i class="fas fa-venus"></i>'
            ],
            [
                'type' => 'Psicologo',
                'fontawesome' => '<i class="fas fa-brain"></i>'
            ],
            [
                'type' => 'Oculista',
                'fontawesome' => '<i class="fas fa-glasses"></i>'
            ],
            [
                'type' => 'Dermatologo',
                'fontawesome' => '<i class="fas fa-allergies"></i>'
            ],
            [
                'type' => 'Medico Dello Sport',
                'fontawesome' => '<i class="fas fa-football-ball"></i>'
            ],
        ];

        foreach ($specializations as $specialization){
             $newSpecialization = new  Specialization();
             $newSpecialization->type = $specialization['type'];
             $newSpecialization->fontawesome = $specialization['fontawesome'];
             $newSpecialization->save();
        }
    }
}
