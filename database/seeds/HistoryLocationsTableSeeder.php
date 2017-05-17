<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class HistoryLocationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('history_locations')->insert([
            'location_id' => rand(1,5),
            'user_id' => rand(1,5),
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
    }
}
