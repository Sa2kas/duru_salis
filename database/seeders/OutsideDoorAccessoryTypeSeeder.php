<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OutsideDoorAccessoryTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('outside_door_accessory_types')->insert([
            [
                'title' => 'Viršduris',
            ],
            [
                'title' => 'Šoninė nevarstoma dalis',
            ],
            [
                'title' => 'Antra varčia (dvivėrės durys)',
            ], 
        ]);
    }
}
