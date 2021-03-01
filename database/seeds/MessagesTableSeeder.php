<?php

use Illuminate\Database\Seeder;
use App\Info;
use App\Message;
use Faker\Factory;
use Faker\Generator as Faker;

class MessagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {

        factory(App\Message::class, 200)->create();
    }
}
