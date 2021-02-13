<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i=0; $i < 5; $i++) { 
            $newUser = new User();
            $newUser->email = $faker->email();
            $newUser->password = $faker->password(10);

            $newUser->save();
        }
    }
}
