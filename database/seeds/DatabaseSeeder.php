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
        \App\User::factory(10)->create();
        \App\Follow::factory(10)->create();
        \App\Post::factory(10)->create();
        \App\Note::factory(10)->create();
        \App\Comment::factory(10)->create();
        \App\Channel::factory(10)->create();
    }
}
