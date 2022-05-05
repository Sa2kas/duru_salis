<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class DoorTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('door_types')->insert([
            [
                'title' => 'lauko',
                'title_en' => 'outside',
            ],
            [
                'title' => 'buto',
                'title_en' => 'inside',
            ]      
        ]);
    }
}
