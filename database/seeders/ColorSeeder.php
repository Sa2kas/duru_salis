<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('colors')->insert([
            [
                'title' => 'RAL 1000',
                'title_en' => 'RAL 1000',
                'photo' => '',
                'panel_id' => '1',
            ],
            [
                'title' => 'RAL 1001',
                'title_en' => 'RAL 1001',
                'photo' => '',
                'panel_id' => '1',
            ],      
            [
                'title' => 'RAL 1002',
                'title_en' => 'RAL 1002',
                'photo' => '',
                'panel_id' => '1',
            ],
            [
                'title' => 'RAL 1003',
                'title_en' => 'RAL 1003',
                'photo' => '',
                'panel_id' => '1',
            ], [
                'title' => 'RAL 1004',
                'title_en' => 'RAL 1004',
                'photo' => '',
                'panel_id' => '1',
            ],    
            [
                'title' => 'Šviesi fanera',
                'title_en' => 'Light plywood',
                'photo' => '',
                'panel_id' => '2',
            ], [
                'title' => 'Tamsi fanera',
                'title_en' => 'Dark plywood',
                'photo' => '',
                'panel_id' => '2',
            ], 
            [
                'title' => 'Pl-1',
                'title_en' => 'Pl-1',
                'photo' => '',
                'panel_id' => '3',
            ],
            [
                'title' => 'Pl-2',
                'title_en' => 'Pl-2',
                'photo' => '',
                'panel_id' => '3',
            ],      
            [
                'title' => 'Pl-3',
                'title_en' => 'Pl-3',
                'photo' => '',
                'panel_id' => '3',
            ],
            [
                'title' => 'Pl-4',
                'title_en' => 'Pl-4',
                'photo' => '',
                'panel_id' => '3',
            ], [
                'title' => 'Pl-5',
                'title_en' => 'Pl-5',
                'photo' => '',
                'panel_id' => '3',
            ], 
            [
                'title' => 'Ąžuolas Amer R3101L',
                'title_en' => 'Oak Amer R3101L',
                'photo' => '',
                'panel_id' => '4',
            ],
            [
                'title' => 'Ąžuolas Bordo R4414L',
                'title_en' => 'Oak Bordo R4414L',
                'photo' => '',
                'panel_id' => '4',
            ],
            [
                'title' => 'Ąžuolas Lefka R3226L',
                'title_en' => 'Oak Lefka R3226L',
                'photo' => '',
                'panel_id' => '4',
            ],
            [
                'title' => 'Ąžuolas Nelso R3226L',
                'title_en' => 'Oak Nelso R3226L',
                'photo' => '',
                'panel_id' => '4',
            ],
            [
                'title' => 'Ąžuolas Sedan R4442',
                'title_en' => 'Oak Sedan R4442',
                'photo' => '',
                'panel_id' => '4',
            ],
            [
                'title' => 'PVC-1',
                'title_en' => 'PVC-1',
                'photo' => '',
                'panel_id' => '5',
            ],
            [
                'title' => 'PVC-2',
                'title_en' => 'PVC-2',
                'photo' => '',
                'panel_id' => '5',
            ],      
            [
                'title' => 'PVC-3',
                'title_en' => 'PVC-3',
                'photo' => '',
                'panel_id' => '5',
            ],
            [
                'title' => 'PVC-4',
                'title_en' => 'PVC-4',
                'photo' => '',
                'panel_id' => '5',
            ], [
                'title' => 'PVC-5',
                'title_en' => 'PVC-5',
                'photo' => '',
                'panel_id' => '5',
            ] 
        ]);
    }
}
