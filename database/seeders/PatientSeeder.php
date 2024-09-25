<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('patients')->insert([
            [
                'name' => 'Muhammad Adi Septian',
                'keluhan' => 'Pilek dan bersin terus',
                'date_of_birth' => '1980-01-01',
                'gender' => 'male',
                'no_telp' => '0812345678',
                'email' => 'aseptian@example.com',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Tian Adi Muhammad',
                'keluhan' => 'Kulit gatal gatal',
                'date_of_birth' => '1990-05-12',
                'gender' => 'male',
                'no_telp' => '0812345678',
                'email' => 'aseptian@example.com',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Asep Tian',
                'keluhan' => 'Grogi waktu presentasi',
                'date_of_birth' => '2003-05-12',
                'gender' => 'female',
                'no_telp' => '0812345678',
                'email' => 'aseptian@example.com',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
