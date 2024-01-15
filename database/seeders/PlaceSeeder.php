<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Place;

class PlaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $places = [
            ['titulo' => 'Auditorio',
            'cant_max' => 100,
            'contenido'=>'Exposiciones'
        
        ],
            ['titulo' => 'Zum',
            'cant_max' => 100,
            'contenido'=>'Exposiciones'
        
        ],
            ['titulo' => 'Sala Norte',
            'cant_max' => 100,
            'contenido'=>'Exposiciones'

        ],
        ];

        foreach ($places as $place) {
            Place::create($place);
        }
    }
}
