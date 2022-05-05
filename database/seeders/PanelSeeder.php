<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class PanelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('panels')->insert([
            [
                'title' => 'MDF',
                'title_en' => 'MDF',
                'door_type_id' => '1',
            ],
            [
                'title' => 'Bakalitas',
                'title_en' => 'Bakalitas',
                'door_type_id' => '1',
            ],
            [
                'title' => 'OKOUME',
                'title_en' => 'OKOUME',
                'door_type_id' => '1',
            ],
            [
                'title' => 'LMDP',
                'title_en' => 'LMDP',
                'door_type_id' => '2',
            ],
            [
                'title' => 'MDF PVC',
                'title_en' => 'MDF PVC',
                'door_type_id' => '2',
            ]       
        ]);
    }
}
