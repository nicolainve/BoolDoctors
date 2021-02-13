<?php

use Illuminate\Database\Seeder;
use App\Vote;

class VotesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    
        for ($i = 1; $i < 6 ; $i++) {
            $newVote = new Vote();
            $newVote->vote = $i;
            $newVote->save();
        }
    }
}
