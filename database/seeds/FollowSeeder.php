<?php

use Illuminate\Database\Seeder;
use App\Follow;

class FollowSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Follow::class, 10)->create();
    }
}
