<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'fullname' => 'administrator',
            'nip' => '123456789012345678',
            'foto' => 'pic-1.png',
            'role_id' => 1,
            'email' => "damans.remix2061@gmail.com",
            'password' => Hash::make("12345678")
        ]);
    }
}