<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MetricsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('metrics')->insert([
            [
                'name' => 'in-patients',
                'category' => 'patients',
            ],
            [
                'name' => 'out-patients',
                'category' => 'patients',
            ],
            [
                'name' => 'surgeries',
                'category' => 'patients',
            ],
            [
                'name' => 'doctors',
                'category' => 'staff',
            ],
            [
                'name' => 'mid-wives',
                'category' => 'staff',
            ],
            [
                'name' => 'support',
                'category' => 'staff',
            ],
            [
                'name' => 'others',
                'category' => 'staff',
            ],
            [
                'name' => 'doctors',
                'category' => 'staff-hop',
            ],
            [
                'name' => 'mid-wives',
                'category' => 'staff-hop',
            ],
            [
                'name' => 'support',
                'category' => 'staff-hop',
            ],
            [
                'name' => 'others',
                'category' => 'staff-hop',
            ],
            [
                'name' => 'total',
                'category' => 'prescriptions',
            ],
            [
                'name' => 'unfilled',
                'category' => 'prescriptions',
            ],
            [
                'name' => 'sku',
                'category' => 'prescriptions',
            ],
        ]);
    }
}
