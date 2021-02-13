<?php

use Illuminate\Database\Seeder;
use App\Info;
use App\Review;
use Faker\Generator as Faker;

class ReviewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $infos = Info::all();

        foreach ($infos as $info) {

            for ($i = 0; $i < 3; $i++) {

                $newReview = new Review();

                // Dati delle colonne 
                $newReview->info_id = $info->id; // foreing key 
                $newReview->author = $faker->userName();
                $newReview->body = $faker->sentence(10);

                // Salvataggio
                $newReview->save();
            }
        }
    }
}
