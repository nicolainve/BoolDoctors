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
        $fakeAvatar = [
            'avatar/1.png',
            'avatar/2.png',
            'avatar/4.png',
            'avatar/5.png',
            'avatar/6.png',
            'avatar/7.png',
            'avatar/8.png',
            'avatar/9.png',
            'avatar/10.png',
            'avatar/11.png',
            'avatar/12.png',
            'avatar/13.png',
            'avatar/14.png',
            'avatar/15.png',
            'avatar/16.png',
            'avatar/17.png',
        ];

        foreach ($users as $user) { 
            $newInfo = new Info();
            // faker info 
            $newInfo->user_id = $user->id;
            $newInfo->name = $faker->unique()->firstName;
            $newInfo->surname = $faker->unique()->lastName;
            $slug = $newInfo->name . ' ' .  $newInfo->surname;
            $newInfo->slug = Str::slug($slug, '-');
            $newInfo->address = $faker->sentence(1);
            $newInfo->CV = $faker->text(100);
            $newInfo->phone = $faker->unique()->phoneNumber;
            $newInfo->price = $faker->randomFloat(2, 10, 100);
            // $newInfo->photo = $faker->randomElement(['avatar/a.png', 'avatar/b.png', 'avatar/c.png']);
            $newInfo->photo = $faker->randomElement($fakeAvatar);
            // Save
            $newInfo->save();
            //! Specialization
            $specNumber = [];
            $time = rand(1,2);
            for ($i = 0; $i < $time; $i++) {
                $number = rand(1,6);

                if (! in_array($number, $specNumber)) {
                    $specNumber[] = $number;
                }
            }
            $newInfo->specializations()->attach($specNumber);
            // ! Votes
            $voteNumber = [];
            for ($i = 0; $i < 4; $i++) {
                $number = rand(1,5);

                $voteNumber[] = $number;
            }
            $newInfo->votes()->attach($voteNumber);

            //! sponsorship
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

        }
    }
}
