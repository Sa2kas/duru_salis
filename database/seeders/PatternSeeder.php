<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class PatternSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('patterns')->insert([
            [
                'title' => 'R1',
                'title_en' => 'R1',
                'photo' => '',
                'panel_id' => '1',
            ],
            [
                'title' => 'R2',
                'title_en' => 'R2',
                'photo' => '',
                'panel_id' => '1',
            ],      
            [
                'title' => 'R3',
                'title_en' => 'R3',
                'photo' => '',
                'panel_id' => '1',
            ],
            [
                'title' => 'R4',
                'title_en' => 'R4',
                'photo' => '',
                'panel_id' => '1',
            ], [
                'title' => 'R5',
                'title_en' => 'R5',
                'photo' => '',
                'panel_id' => '1',
            ], 
            [
                'title' => 'R1',
                'title_en' => 'R1',
                'photo' => '',
                'panel_id' => '2',
            ],
            [
                'title' => 'R2',
                'title_en' => 'R2',
                'photo' => '',
                'panel_id' => '2',
            ],      
            [
                'title' => 'R3',
                'title_en' => 'R3',
                'photo' => '',
                'panel_id' => '2',
            ],
            [
                'title' => 'R4',
                'title_en' => 'R4',
                'photo' => '',
                'panel_id' => '2',
            ], [
                'title' => 'R5',
                'title_en' => 'R5',
                'photo' => '',
                'panel_id' => '2',
            ], 
            [
                'title' => 'R1',
                'title_en' => 'R1',
                'photo' => '',
                'panel_id' => '3',
            ],
            [
                'title' => 'R2',
                'title_en' => 'R2',
                'photo' => '',
                'panel_id' => '3',
            ],      
            [
                'title' => 'R3',
                'title_en' => 'R3',
                'photo' => '',
                'panel_id' => '3',
            ],
            [
                'title' => 'R4',
                'title_en' => 'R4',
                'photo' => '',
                'panel_id' => '3',
            ], [
                'title' => 'R5',
                'title_en' => 'R5',
                'photo' => '',
                'panel_id' => '3',
            ], 
            [
                'title' => 'Nėra',
                'title_en' => 'None',
                'photo' => '',
                'panel_id' => '4',
            ],
            [
                'title' => 'R1',
                'title_en' => 'R1',
                'photo' => '',
                'panel_id' => '5',
            ],
            [
                'title' => 'R2',
                'title_en' => 'R2',
                'photo' => '',
                'panel_id' => '5',
            ],      
            [
                'title' => 'R3',
                'title_en' => 'R3',
                'photo' => '',
                'panel_id' => '5',
            ],
            [
                'title' => 'R4',
                'title_en' => 'R4',
                'photo' => '',
                'panel_id' => '5',
            ], [
                'title' => 'R5',
                'title_en' => 'R5',
                'photo' => '',
                'panel_id' => '5',
            ] 
        ]);
    }
}
