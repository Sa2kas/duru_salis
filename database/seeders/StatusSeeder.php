<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('statuses')->insert([
            [
                'title' => 'nepatvirtinta',
                'title_en' => 'not approved',
            ],
            [
                'title' => 'apmokėta',
                'title_en' => 'paid',
            ],
            [
                'title' => 'patvirtinta',
                'title_en' => 'approved',
            ],
            [
                'title' => 'gaminama',
                'title_en' => 'in production',
            ],
            [
                'title' => 'pagaminta',
                'title_en' => 'produced',
            ],
            [
                'title' => 'užbaigta',
                'title_en' => 'completed',
            ]       
        ]);
    }
}
