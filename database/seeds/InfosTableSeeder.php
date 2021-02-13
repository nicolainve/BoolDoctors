<?php

use Illuminate\Database\Seeder;
use App\Info;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

class InfosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {   
        $users = User::all();

        foreach ($users as $user) { 
            $newInfo = new Info();
            // faker info 
            $newInfo->user_id = $user->id;
            $newInfo->name = $faker->unique()->randomElement(['Paolo','Antonio','Riccardo','Laura','Roberta', 'Alfredo','Rosa','Luis']);
            $newInfo->surname = $faker->unique()->randomElement(['Rossi','Bianchi','Verdi','Conte','Esposito','Lamberti','Molinari']);
            $slug = $newInfo->name . ' ' .  $newInfo->surname;
            $newInfo->slug = Str::slug($slug, '-');
            $newInfo->address = $faker->sentence(1);
            $newInfo->CV = $faker->text(100);
            $newInfo->phone = $faker->unique()->randomElement(['111', '222', '333', '444', '555',]);
            $newInfo->price = $faker->randomFloat(2, 10, 100);
            // Save
            $newInfo->save();
        }
    }
}