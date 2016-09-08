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
        // $this->call(UsersTableSeeder::class);

        DB::table('images')->insert([
            'id' => 1,
            'image_url' => 'http://localhost/uploads/1.jpg',
            'ext' => 'jpg'
        ]);
        DB::table('images')->insert([
            'id' => 2,
            'image_url' => 'http://localhost/uploads/2.jpg',
            'ext' => 'jpg'
        ]);
        DB::table('images')->insert([
            'id' => 3,
            'image_url' => 'http://localhost/uploads/3.jpg',
            'ext' => 'jpg'
        ]);
        DB::table('images')->insert([
            'id' => 4,
            'image_url' => 'http://localhost/uploads/4.jpg',
            'ext' => 'jpg'
        ]);
    }
}
