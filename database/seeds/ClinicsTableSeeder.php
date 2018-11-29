<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClinicsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('clinics')->insert([
            [
                'name' => 'Rushozi HCII',
            ],
            [
                'name' => 'Bugongi HCIII',
            ],
            [
                'name' => 'Kabwohe HCIV',
            ],
            [
                'name' => 'Kitagata Hospital',
            ],
            [
                'name' => 'Shuuku HCIV',
            ],
            [
                'name' => 'Kigarama HCIII',
            ],
        ]);
    }
}
