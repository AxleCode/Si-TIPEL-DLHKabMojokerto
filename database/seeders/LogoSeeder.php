<?php

namespace Database\Seeders;

use App\Models\Logo;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class LogoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Logo::create([
            'name' => 'Logo Utama',
            'image_path' => 'logo/logo-baru.png',
        ]);
        Logo::create([
            'name' => 'Logo Login dan Dashboard',
            'image_path' => 'logo/si-TIPEL.png',
        ]);
        Logo::create([
            'name' => 'Logo DLH Kabupaten Mojokerto',
            'image_path' => 'logo/logo-mojokerto.png',
        ]);
        Logo::create([
            'name' => 'Alur Pendaftaran',
            'image_path' => 'logo/hero-img.png',
        ]);
       
    }
}
