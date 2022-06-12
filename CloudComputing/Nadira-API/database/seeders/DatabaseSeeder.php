<?php

namespace Database\Seeders;

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

        $this->call(AdminSeeder::class);
        $this->call(PeopleSeeder::class);
        $this->call(NewsSeeder::class);
        $this->call(CategorySeeder::class);
        // $this->call(PembimbingSeeder::class);
        // \App\Models\User::factory(10)->create();
    }
}
