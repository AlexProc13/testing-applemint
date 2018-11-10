<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'alexproc',
            'email' => 'alexproc1313@gmail.com',
            'password' => app('hash')->make('123456')
        ]);
        //to do load users
    }
}
