<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users') -> insert([
            [
                'name' => 'テスト',
                'email' => 'test@test.com',
                'password' => bcrypt('testtest')
            ]
        ]);
        factory(User::class, 9)->create();
    }
}
