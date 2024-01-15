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
        $this->call(SeederTablaPermisos::class);
        $this->call(RolesTableSeeder::class);
        $this->call(TypeEventSeeder::class);
        $this->call(TicComponentSeeder::class);
        $this->call(StatesSeeder::class);
        $this->call(PlaceSeeder::class);

    }
}
