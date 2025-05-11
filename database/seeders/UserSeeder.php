<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin User',
                'email' => 'asekpro12@gmail.com',
                'password' => Hash::make('Tmk_ceuyah12'),
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pasien User',
                'email' => 'pasien@example.com',
                'password' => Hash::make('password'),
                'role' => 'pasien',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
