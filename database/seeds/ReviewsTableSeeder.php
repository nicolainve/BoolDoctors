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
        factory(App\Review::class, 150)->create();

    }
}
