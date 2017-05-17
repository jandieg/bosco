<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class PetsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pets')->insert([
            'name' => str_random(10),
            'owner_id' => rand(1,5),
            'race' => (rand(0,1) == 1) ? 'cat' : 'dog',
            'gender' => (rand(0,1) == 1) ? 'male' : 'female',
            'description' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin sollicitudin facilisis erat a vestibulum. Aliquam mauris ex, hendrerit eget tincidunt nec, lobortis vitae odio. Nullam tincidunt suscipit nisi. Cras elementum efficitur porttitor integer sed leo quam. Sed aliquam, mi vitae vestibulum ornare, dui ex consectetur nisl, eget vulputate odio mi id est. Sed efficitur bibendum quam. Morbi viverra vitae elit ut commodo.</p><p>Nullam ut leo vitae tortor blandit dictum. Nunc vel imperdiet purus. Maecenas vehicula justo vitae lectus tincidunt fringilla. Fusce sollicitudin et erat non porttitor. Cras non venenatis leo, vitae fermentum ipsum. Donec eu enim convallis, aliquet tortor in, venenatis nisl.</p>',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
    }
}
