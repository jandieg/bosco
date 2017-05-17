<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class HistoryLocatedTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('history_located')->insert([
            'history_location_id' => rand(1,5),
            'pet_id' => rand(1,10),
            'status' => (rand(0,1) == 1) ? 'lost' : 'found',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
    }
}
