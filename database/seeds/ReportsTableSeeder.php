<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class ReportsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('reports')->insert([
            'pet_id' => rand(1,10),
            'last_location_id' => rand(1,5),
            'date' => new DateTime(),
            'description' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin sollicitudin facilisis erat a vestibulum.</p>',
            'status' => (rand(0,1) == 1) ? 'lost' : 'found',
            'reward' => 1000/rand(1,1000),
            'code_qr' => str_random(64),
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
    }
}
