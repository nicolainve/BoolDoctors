<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        $this->call(SpecializationsTableSeeder::class);
        $this->call(VotesTableSeeder::class);
        $this->call(SponsorsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(InfosTableSeeder::class);
        $this->call(MessagesTableSeeder::class);
        $this->call(ReviewsTableSeeder::class);

    }
}
