<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RacerSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('racers')->insert([
            'abbreviation' => 'AAA',
            'full_name' => 'A Racer',
            'car' => 'A Car',
            'best_time_start' => '2022-01-01 00:00:00.000',
            'best_time_end' => '2022-01-01 00:00:00.111',
        ]);

        DB::table('racers')->insert([
            'abbreviation' => 'BBB',
            'full_name' => 'B Racer',
            'car' => 'B Car',
            'best_time_start' => '2022-01-01 00:00:00.000',
            'best_time_end' => '2022-01-01 00:00:00.222',
        ]);
    }
}
