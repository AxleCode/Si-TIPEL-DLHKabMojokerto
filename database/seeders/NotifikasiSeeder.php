<?php

namespace Database\Seeders;

use App\Models\Notifikasi;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class NotifikasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Notifikasi::create([
            'user_id' => 2,
            'judul'=> 'Laporan Update',
            'logo'=> 'clipboard',
            'textlogo'=> 'text-primary',
            'pesan' => 'Status Laporan Id 3 diupdate oleh petugas',
            'link' => '/dashboard/laporan/3',
            'status' => true,
        ]);
    }
}
