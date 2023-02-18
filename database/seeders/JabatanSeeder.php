<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('jabatans')->insert([
            'name' => 'Wakasek Kurikulum',
        ]);
        DB::table('jabatans')->insert([
            'name' => 'Wakasek Kesiswaan',
        ]);
        DB::table('jabatans')->insert([
            'name' => 'Wakasek Humas',
        ]);
        DB::table('jabatans')->insert([
            'name' => 'Wakasek Sarpras',
        ]);
        DB::table('jabatans')->insert([
            'name' => 'Kasubag TU',
        ]);
        DB::table('jabatans')->insert([
            'name' => 'Koordinator BK',
        ]);
        DB::table('jabatans')->insert([
            'name' => 'Bendahara/BOS/BOP/PSM',
        ]);
        DB::table('jabatans')->insert([
            'name' => 'Wali Kelas',
        ]);
        DB::table('jabatans')->insert([
            'name' => 'Guru Mata Pelajaran',
        ]);
        DB::table('jabatans')->insert([
            'name' => 'Pembina Ekstrakurikuler',
        ]);
    }
}
