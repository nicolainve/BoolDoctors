<?php

use Illuminate\Database\Seeder;
use App\Sponsor;

class SponsorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sponsors = [   
                [
                    'type'=>'Bronze',
                    'price' => 2.99,
                    'duration' => '24 ore'
                ],
                [
                    'type'=>'Silver',
                    'price' => 5.99,
                    'duration' => '72 ore'
                ],
                [
                    'type'=>'Gold',
                    'price' => 9.99,
                    'duration' => '144 ore'
                ]
        ];


        foreach ($sponsors as $sponsor){
            $newSponsor = new Sponsor();

            $newSponsor->type = $sponsor['type'];
            $newSponsor->price = $sponsor['price'];
            $newSponsor->duration = $sponsor['duration'];
            $newSponsor->save();
        }
    }
}
