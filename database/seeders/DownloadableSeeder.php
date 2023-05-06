<?php

namespace Database\Seeders;

use App\Models\Downloadable;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DownloadableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Downloadable::create([
            'name' => 'Tata cara pendaftaran akun si-Tipel',
            'deskripsi' => 'Berisi panduan tata cara pendaftaran akun si-Tipel',
            'ukuran' => '1.09 MB',
            'file' => 'pendaftaran.pdf',
        ]);

        Downloadable::create([
            'name' => 'Tata cara pelaporan aduan',
            'deskripsi' => 'Berisi panduan tata cara pelaporan aduan si-Tipel',
            'ukuran' => '3.15 MB',
            'file' => 'aduan.pdf',
        ]);
    }
}
