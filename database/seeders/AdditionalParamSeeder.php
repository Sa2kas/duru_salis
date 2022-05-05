<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class AdditionalParamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('additional_params')->insert([
            [
                'title' => 'Bakalito viršduris',
                'title_en' => 'Bakalite overhead',
                'glass_packet' => '0',
                'price' => '70',
                'additional_param_type_id' => '1',
                'panel_id' => '2',
            ],
            [
                'title' => 'MDF viršduris',
                'title_en' => 'MDF overhead',
                'glass_packet' => '0',
                'price' => '140',
                'additional_param_type_id' => '1',
                'panel_id' => '1',
            ],
            [
                'title' => 'OKOUME viršduris',
                'title_en' => 'OKOUME overhead',
                'glass_packet' => '0',
                'price' => '180',
                'additional_param_type_id' => '1',
                'panel_id' => '3',
            ],
            [
                'title' => 'Bakalito viršduris',
                'title_en' => 'Bakalite overhead',
                'glass_packet' => '1',
                'price' => '120',
                'additional_param_type_id' => '1',
                'panel_id' => '2',
            ],
            [
                'title' => 'MDF viršduris',
                'title_en' => 'MDF overhead',
                'glass_packet' => '1',
                'price' => '190',
                'additional_param_type_id' => '1',
                'panel_id' => '1',
            ],
            [
                'title' => 'OKOUME viršduris',
                'title_en' => 'OKOUME overhead',
                'glass_packet' => '1',
                'price' => '230',
                'additional_param_type_id' => '1',
                'panel_id' => '3',
            ],
            [
                'title' => 'Bakalito šoninė nevarstoma dalis',
                'title_en' => 'Bakalite side non-swinging part',
                'glass_packet' => '0',
                'price' => '120',
                'additional_param_type_id' => '2',
                'panel_id' => '2',
            ],
            [
                'title' => 'MDF šoninė nevarstoma dalis',
                'title_en' => 'MDF side non-swinging part',
                'glass_packet' => '0',
                'price' => '180',
                'additional_param_type_id' => '2',
                'panel_id' => '1',
            ],
            [
                'title' => 'OKOUME šoninė nevarstoma dalis',
                'title_en' => 'OKOUME side non-swinging part',
                'glass_packet' => '0',
                'price' => '290',
                'additional_param_type_id' => '2',
                'panel_id' => '3',
            ],
            [
                'title' => 'Bakalito šoninė nevarstoma dalis',
                'title_en' => 'Bakalite side non-swinging part',
                'glass_packet' => '1',
                'price' => '170',
                'additional_param_type_id' => '2',
                'panel_id' => '2',
            ],
            [
                'title' => 'MDF šoninė nevarstoma dalis',
                'title_en' => 'MDF side non-swinging part',
                'glass_packet' => '1',
                'price' => '230',
                'additional_param_type_id' => '2',
                'panel_id' => '1',
            ],
            [
                'title' => 'OKOUME šoninė nevarstoma dalis',
                'title_en' => 'OKOUME side non-swinging part',
                'glass_packet' => '1',
                'price' => '340',
                'additional_param_type_id' => '2',
                'panel_id' => '3',
            ],    
            [
                'title' => 'Bakalito Bakalito antra varčia (dvivėrės durys)',
                'title_en' => 'Bakalite overhead',
                'glass_packet' => '0',
                'price' => '290',
                'additional_param_type_id' => '3',
                'panel_id' => '2',
            ],
            [
                'title' => 'MDF Bakalito antra varčia (dvivėrės durys)',
                'title_en' => 'MDF overhead',
                'glass_packet' => '0',
                'price' => '370',
                'additional_param_type_id' => '3',
                'panel_id' => '1',
            ],
            [
                'title' => 'OKOUME Bakalito antra varčia (dvivėrės durys)',
                'title_en' => 'OKOUME overhead',
                'glass_packet' => '0',
                'price' => '470',
                'additional_param_type_id' => '3',
                'panel_id' => '3',
            ],
            [
                'title' => 'Bakalito antra varčia (dvivėrės durys)',
                'title_en' => 'Bakalite overhead',
                'glass_packet' => '1',
                'price' => '350',
                'additional_param_type_id' => '3',
                'panel_id' => '2',
            ],
            [
                'title' => 'MDF Bakalito antra varčia (dvivėrės durys)',
                'title_en' => 'MDF overhead',
                'glass_packet' => '1',
                'price' => '430',
                'additional_param_type_id' => '3',
                'panel_id' => '1',
            ],
            [
                'title' => 'OKOUME Bakalito antra varčia (dvivėrės durys)',
                'title_en' => 'OKOUME overhead',
                'glass_packet' => '1',
                'price' => '530',
                'additional_param_type_id' => '3',
                'panel_id' => '3',
            ],    
        ]);
    }
}
