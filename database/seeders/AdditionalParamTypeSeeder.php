<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class AdditionalParamTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('additional_param_types')->insert([
            [
                'title' => 'Viršduris',
                'title_en' => 'Overhead',
            ],
            [
                'title' => 'Šoninė nevarstoma dalis',
                'title_en' => 'Side non-swinging part',
            ],
            [
                'title' => 'Antra varčia (dvivėrės durys)',
                'title_en' => 'Second leaf (double door)',
            ]      
        ]);
    }
}
