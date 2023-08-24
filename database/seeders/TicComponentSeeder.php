<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TicComponent;

class TicComponentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tic_components = [
            ['nombre' => 'proyector',
            'contenido'=>'Exposiciones',
            'stock'=> 5
        
        ],
            ['nombre' => 'tele',
            'contenido'=>'Exposiciones',
            'stock'=> 5],
            ['nombre' => 'pizarron',
            'contenido'=>'Exposiciones',
            'stock'=> 5],
        ];
        foreach ($tic_components as $tic_component) {
            TicComponent::create($tic_component);
        }
    }
}
