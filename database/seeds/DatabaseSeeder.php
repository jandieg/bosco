<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(PetsTableSeeder::class);
        $this->call(LocationsTableSeeder::class);
        $this->call(HistoryLocatedTableSeeder::class);
        $this->call(HistoryLocationsTableSeeder::class);
        $this->call(PhotosTableSeeder::class);
        $this->call(ReportsTableSeeder::class);
    }
}
