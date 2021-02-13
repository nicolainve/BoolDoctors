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
        $specializations = ['Dentista', 'Ginecologo', 'Psicologo', 'Oculista', 'Dermatologo', 'Medico Dello Sport'];

        foreach ($specializations as $specialization){
             $newSpecialization = new  Specialization();
             $newSpecialization->type = $specialization;
             $newSpecialization->save();
        }
    }
}
