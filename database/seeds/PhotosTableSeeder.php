<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class PhotosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('photos')->insert([
            'pet_id' => rand(1,9),
            'url' => 'images/pets/pet_' . rand(1,5) . '.jpg',
            'width' => '494px',
            'height' => '464px',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
    }
}
