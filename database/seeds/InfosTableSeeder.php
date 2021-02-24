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
            $newInfo->name = $faker->randomElement(['Paolo','Antonio','Riccardo','Laura','Roberta', 'Alfredo','Rosa','Luis','Simona','Nicola']);
            $newInfo->surname = $faker->randomElement(['Rossi','Bianchi','Verdi','Conte','Esposito','Lamberti','Molinari', 'Cinti', 'Invernizzi']);
            $slug = $newInfo->name . ' ' .  $newInfo->surname;
            $newInfo->slug = Str::slug($slug, '-');
            $newInfo->address = $faker->sentence(1);
            $newInfo->CV = $faker->text(100);
            $newInfo->phone = $faker->randomElement(['111', '222', '333', '444', '555','666','777','888','999']);
            $newInfo->price = $faker->randomFloat(2, 10, 100);
            // Save
            $newInfo->save();
            //! Specialization
            $specNumber = [];
            $time = rand(1,10);
            for ($i = 0; $i < $time; $i++) {
                $number = rand(1,6);

                if (! in_array($number, $specNumber)) {
                    $specNumber[] = $number;
                }
            }
            $newInfo->specializations()->attach($specNumber);
            //! Votes
            $voteNumber = [];
            for ($i = 0; $i < 3; $i++) {
                $number = rand(1,5);

                $voteNumber[] = $number;
            }
            $newInfo->votes()->attach($voteNumber);

            //! sponsorship
            // $sponsorship= rand(0,1);
            // if ($sponsorship === 1) {
                $sponsorType= rand(1,3);

                // Check type of Sponsorship selected
                switch ($sponsorType) {
                    case 1:
                        $sponsor['sponsor_id'] = '1';
                        $expire = date(('Y-m-d H:i:s'), strtotime("+1 day"));
                        break;
                    case 2:
                        $sponsor['sponsor_id'] = '2';
                        $expire = date(('Y-m-d H:i:s'), strtotime("+3 day"));
                        break;
                    case 3:
                        $sponsor['sponsor_id'] = '3';
                        $expire = date(('Y-m-d H:i:s'), strtotime("+6 day"));
                        break;
                }

                $newInfo->sponsors()->attach($sponsor['sponsor_id'],  ['expired_at' => $expire]);
            //}


        }
    }
}
