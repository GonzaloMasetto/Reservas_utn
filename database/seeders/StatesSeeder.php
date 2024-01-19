<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\State;

class StatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $states = [
            ['nombre' => 'Confirmado'],
            ['nombre' => 'En espera'],
            ['nombre' => 'Cancelado'],
        ];

        foreach ($states as $state) {
            State::create($state);
        }
    }
}
