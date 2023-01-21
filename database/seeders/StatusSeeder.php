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
        DB::table('statuses')->insert(
            [
                'id' => 1,
                'keterangan' => 'Hadir'
                
            ]
        );
        DB::table('statuses')->insert(
            [
                'id' => 2,
                'keterangan' => 'Izin'
                
            ]
        );
        DB::table('statuses')->insert(
            [
                'id' => 3,
                'keterangan' => 'Sakit'
                
            ]
        );
        DB::table('statuses')->insert(
            [
                'id' => 4,
                'keterangan' => 'Alpa'
                
            ],
        );
    }
}
