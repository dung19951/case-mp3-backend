<?php

namespace Database\Seeders;

use App\Models\Singer;
use Database\Factories\SingerFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserTableSeeder::class);
        $this->call(CategorySeeder::class);
        \App\Models\Singer::factory(100)->create();
        $this->call(SongSeeder::class);
    }
}
