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
                'name' => 'Rushozi HC',
                'level' => 2,
            ],
            [
                'name' => 'Bugongi HC',
                'level' => 3,
            ],
            [
                'name' => 'Kabwohe HC',
                'level' => 4,
            ],
            [
                'name' => 'Kitagata Hospital',
                'level' => 5,
            ],
        ]);
    }
}
