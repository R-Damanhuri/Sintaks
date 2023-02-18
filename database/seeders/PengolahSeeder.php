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
            'fullname' => 'Muhammad',
            'email' => 'wakasek1@gmail.com',
            'jabatan_id' => 1,
        ]);
        DB::table('pengolahs')->insert([
            'fullname' => 'Ahmad',
            'email' => 'wakasek2@gmail.com',
            'jabatan_id' => 2,
        ]);
        DB::table('pengolahs')->insert([
            'fullname' => 'Ibnu',
            'email' => 'wakasek3@gmail.com',
            'jabatan_id' => 3,
        ]);
        DB::table('pengolahs')->insert([
            'fullname' => 'Abdul',
            'email' => 'wakasek4@gmail.com',
            'jabatan_id' => 4,
        ]);
        DB::table('pengolahs')->insert([
            'fullname' => 'Heri',
            'email' => 'kasubagtu@gmail.com',
            'jabatan_id' => 5,
        ]);
        DB::table('pengolahs')->insert([
            'fullname' => 'Fajar',
            'email' => 'koorbk@gmail.com',
            'jabatan_id' => 6,
        ]);
        DB::table('pengolahs')->insert([
            'fullname' => 'Anisa',
            'email' => 'bendahara@gmail.com',
            'jabatan_id' => 7,
        ]);
        DB::table('pengolahs')->insert([
            'fullname' => 'Indra',
            'email' => 'walikelas10a@gmail.com',
            'jabatan_id' => 8,
        ]);
        DB::table('pengolahs')->insert([
            'fullname' => 'Jaya',
            'email' => 'mapelipa@gmail.com',
            'jabatan_id' => 9,
        ]);
        DB::table('pengolahs')->insert([
            'fullname' => 'Fahmi',
            'email' => 'ekskul@gmail.com',
            'jabatan_id' => 10,
        ]);
    }
}