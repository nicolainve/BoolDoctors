<?php

use Illuminate\Database\Seeder;
use App\Info;
use App\Message;
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
        $infos = Info::all();

        foreach ($infos as $info){

            for ($i = 0; $i < 3; $i++){

                $newMessage = new Message();
                
                // Dati delle colonne 
                $newMessage->info_id = $info->id; // foreing key 
                $newMessage->author = $faker->userName();
                $newMessage->mail = $faker->email();
                $newMessage->body = $faker->sentence(10);
                
                // Salvataggio
                $newMessage->save();
            }
        }
    }
}
