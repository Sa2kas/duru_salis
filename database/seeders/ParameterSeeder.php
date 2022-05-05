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
                'parameter_type_id' => '4',
                'door_type_id' => '2',
            ],
            [
                'title' => 'Montavimas',
                'title_en' => 'Installation',
                'price' => '45',
                'parameter_type_id' => '4',
                'door_type_id' => '2',
            ],
            [
                'title' => 'Montavimas dvivėrių',
                'title_en' => 'Installation of double doors',
                'price' => '70',
                'parameter_type_id' => '4',
                'door_type_id' => '2',
            ],
            [
                'title' => 'Montavimas su viršduriu',
                'title_en' => 'Installation with overhead',
                'price' => '55',
                'parameter_type_id' => '4',
                'door_type_id' => '2',
            ],
            [
                'title' => 'Montavimas  su šaliduriu',
                'title_en' => 'Installation with side door',
                'price' => '55',
                'parameter_type_id' => '4',
                'door_type_id' => '2',
            ],
            [
                'title' => 'Montavimas su viršduriu ir šaliduriu',
                'title_en' => 'Installation with overhead and side door',
                'price' => '80',
                'parameter_type_id' => '4',
                'door_type_id' => '2',
            ]       
        ]);
    }
}
