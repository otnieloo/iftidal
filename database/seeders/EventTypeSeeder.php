<?php

namespace Database\Seeders;

use App\Models\EventType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EventType::create([
            "event_type" => "Corporate Annual Dinners"
        ]);
        EventType::create([
            "event_type" => "Meeting"
        ]);
        EventType::create([
            "event_type" => "Community and Neighbourhood Events"
        ]);
        EventType::create([
            "event_type" => "Gathering"
        ]);
        EventType::create([
            "event_type" => "Malaysia Day"
        ]);
    }
}
