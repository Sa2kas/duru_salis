<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class DecorationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('decorations')->insert([
            [
                'title' => 'MDF dažyta pagal RAL paletę iš abiejų pusių',
                'title_en' => 'MDF painted according to RAL palette on both sides',
                'price' => '380',
                'panel_id' => '1',
            ],
            [
                'title' => 'MDF dažyta pagal RAL paletę iš abiejų pusių (TERMO durys)',
                'title_en' => 'MDF painted according to RAL palette on both sides (THERMAL DOOR)',
                'price' => '420',
                'panel_id' => '1',
            ],
            [
                'title' => 'Bakalitas (fanera laminuota) iš abiejų pusių',
                'title_en' => 'Bakalite (plywood laminated) on both sides',
                'price' => '290',
                'panel_id' => '2',
            ],
            [
                'title' => 'Bakalitas (fanera laminuota) iš abiejų pusių (TERMO durys)',
                'title_en' => 'Bakalite (plywood laminated) on both sides (THERMAL DOOR)',
                'price' => '330',
                'panel_id' => '2',
            ],
            [
                'title' => 'OKOUME plokštė iš abiejų pusių (TERMO durys)',
                'title_en' => 'OKOUME panel on both sides (THERMAL DOOR)',
                'price' => '490',
                'panel_id' => '3',
            ],
            [
                'title' => 'Iš abiejų pusių drožlių plokštė (LMDP)',
                'title_en' => 'Chipboard on both sides (LMDP)',
                'price' => '240',
                'panel_id' => '4',
            ],
            [
                'title' => '+MDF laminuota PVC iš vienos pusės',
                'title_en' => '+ MDF laminated PVC on one side',
                'price' => '280',
                'panel_id' => '5',
            ],
            [
                'title' => '+MDF laminuota PVC iš abiejų pusių',
                'title_en' => '+ MDF laminated PVC on one both sides',
                'price' => '320',
                'panel_id' => '5',
            ]        
        ]);
    }
}
