<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PengolahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pengolahs')->insert([
            'fullname' => 'Eko Wiarso',
            'email' => 'ekowiarso@gmail.com',
            'jabatan_id' => 1,
        ]);
        DB::table('pengolahs')->insert([
            'fullname' => 'Wijayanto',
            'email' => 'wijayanto@gmail.com',
            'jabatan_id' => 2,
        ]);
        DB::table('pengolahs')->insert([
            'fullname' => 'Niken Emiria',
            'email' => 'niken@gmail.com',
            'jabatan_id' => 3,
        ]);
        DB::table('pengolahs')->insert([
            'fullname' => 'Sumito',
            'email' => 'sumito@gmail.com',
            'jabatan_id' => 4,
        ]);
        DB::table('pengolahs')->insert([
            'fullname' => 'Suroso',
            'email' => 'suroso@gmail.com',
            'jabatan_id' => 5,
        ]);
        DB::table('pengolahs')->insert([
            'fullname' => 'Fajar',
            'email' => 'fajar@gmail.com',
            'jabatan_id' => 6,
        ]);
        DB::table('pengolahs')->insert([
            'fullname' => 'Hartono',
            'email' => 'hartono@gmail.com',
            'jabatan_id' => 7,
        ]);
        DB::table('pengolahs')->insert([
            'fullname' => 'Indra',
            'email' => 'walikelas10a@gmail.com',
            'jabatan_id' => 8,
        ]);
        DB::table('pengolahs')->insert([
            'fullname' => 'Setiawan Budiarto',
            'email' => 'setiawanbudiarto@gmail.com',
            'jabatan_id' => 9,
        ]);
        DB::table('pengolahs')->insert([
            'fullname' => 'Fahmi Yahya',
            'email' => 'ekskul@gmail.com',
            'jabatan_id' => 10,
        ]);
    }
}