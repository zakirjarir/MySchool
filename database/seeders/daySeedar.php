<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class daySeedar extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('day')->truncate();

        DB::table('day')->insert([
            ['name' => 'Sunday'],
            ['name' => 'Monday'],
            ['name' => 'Tuesday'],
            ['name' => 'Wednesday'],
            ['name' => 'Thursday'],
            ['name' => 'Friday'],
            ['name' => 'Saturday']
        ]);

    }
}
