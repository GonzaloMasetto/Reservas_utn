<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Event;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $events = [
            [
                'event' => 'Cita #1',
                'start_date' => '2023-7-17 08:00',
                'end_date' => '2023-7-17 11:00',
            ],
            [
                'event' => 'Cita #2',
                'start_date' => '2023-8-17 08:00',
                'end_date' => '2023-8-17 11:00',
            ],
            [
                'event' => 'Cita #3',
                'start_date' => '2023-9-17 08:00',
                'end_date' => '2023-9-17 11:00',
            ],
            [
                'event' => 'Cita #4',
                'start_date' => '2023-10-17 08:00',
                'end_date' => '2023-10-17 11:00',
            ],
        ];

        foreach ($events as $event) {
            Event::create($event);
        }
    }
}
