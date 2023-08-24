<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TypeEvent;

class TypeEventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $type_events = [
            ['nombre' => 'Exposiciones',
            'contenido'=>'Exposiciones'
        
        ],
            ['nombre' => 'Media Tarde',
            'contenido'=>'Exposiciones'],
            ['nombre' => 'Bailongo',
            'contenido'=>'Exposiciones'],
        ];

        foreach ($type_events as $type_event) {
            TypeEvent::create($type_event);
        }
    }
}
