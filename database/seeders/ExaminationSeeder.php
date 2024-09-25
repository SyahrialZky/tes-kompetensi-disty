<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExaminationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('examinations')->insert([
            [
                'patient_id' => 1, // ID pasien
                'category_id' => 1, // ID kategori BPJS
                'date' => '2023-09-20',
                'results' => 'Hasil pemeriksaan untuk pasien 1',
                'tarif' => 820000,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'patient_id' => 2, // ID pasien
                'category_id' => 2, // ID kategori Umum
                'date' => '2023-09-21',
                'results' => 'Hasil pemeriksaan untuk pasien 2',
                'tarif' => 730000,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'patient_id' => 3,
                'category_id' => 1,
                'date' => '2023-09-22',
                'results' => 'Hasil pemeriksaan untuk pasien no 3',
                'tarif' => 640000,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
