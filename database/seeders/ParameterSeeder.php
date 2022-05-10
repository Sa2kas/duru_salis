<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class ParameterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('parameters')->insert([
            [
                'title' => 'Nėra',
                'title_en' => 'None',
                'price' => '0',
                'parameter_type_id' => '3',
                'door_type_id' => '1',
            ],
            [
                'title' => 'Į vidų atsidarančios durys',
                'title_en' => 'Doors opening inwards',
                'price' => '20',
                'parameter_type_id' => '3',
                'door_type_id' => '1',
            ],
            [
                'title' => 'Glass package (tinted 48 mm.)',
                'title_en' => 'Mottura 40805 small, 5 keys',
                'price' => '60',
                'parameter_type_id' => '3',
                'door_type_id' => '1',
            ],
            [
                'title' => 'Dažymas skirtingų pusių skirtingomis spalvomis',
                'title_en' => 'Painting different sides with different colors',
                'price' => '15',
                'parameter_type_id' => '3',
                'door_type_id' => '1',
            ],
            [
                'title' => 'Nenulenkiama rankena ASSA (bumbulas) iš vienos pusės',
                'title_en' => 'Non-folding handle ASSA (bulge) on one side',
                'price' => '30',
                'parameter_type_id' => '3',
                'door_type_id' => '1',
            ],
            [
                'title' => 'Naktinukas (paprastas)',
                'title_en' => 'Night lock (simple)',
                'price' => '12',
                'parameter_type_id' => '3',
                'door_type_id' => '1',
            ],
            [
                'title' => 'Nėra',
                'title_en' => 'None',
                'price' => '0',
                'parameter_type_id' => '3',
                'door_type_id' => '2',
            ],
            [
                'title' => 'Akutė',
                'title_en' => 'Peephole',
                'price' => '0',
                'parameter_type_id' => '3',
                'door_type_id' => '2',
            ],
            [
                'title' => 'Į vidų atsidarančios durys',
                'title_en' => 'Doors opening inwards',
                'price' => '20',
                'parameter_type_id' => '3',
                'door_type_id' => '2',
            ],
            [
                'title' => 'Kojelė durims',
                'title_en' => 'Door support leg',
                'price' => '15',
                'parameter_type_id' => '3',
                'door_type_id' => '2',
            ],
            [
                'title' => 'Nenulenkiama rankena ASSA (bumbulas) iš vienos pusės',
                'title_en' => 'Non-folding handle ASSA (bulge) on one side',
                'price' => '30',
                'parameter_type_id' => '3',
                'door_type_id' => '2',
            ],
            [
                'title' => 'Naktinukas (paprastas)',
                'title_en' => 'Night lock (simple)',
                'price' => '12',
                'parameter_type_id' => '3',
                'door_type_id' => '2',
            ],
        ]);
    }
}
