<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * -
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => str_random(10),
            'last_name' => str_random(10),
            'phone' => '999-999-999',
            'email' => str_random(10).'@gmail.com',
            'password' => bcrypt('secret'),
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
    }
}
