<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Status::create([
            'name' => 'Dalam antrian',
            'kode_status' => '0',
            'warna' => 'warning',
            'deskripsi' => 'Laporan anda akan segera diperiksa petugas',
        ]);

        Status::create([
            'name' => 'Diterima',
            'kode_status' => '1',
            'warna' => 'primary',
            'deskripsi' => 'Laporan anda diterima dan akan segera diproses oleh petugas mohon cek komentar laporan',
        ]);

        Status::create([
            'name' => 'Survey Lokasi',
            'kode_status' => '2',
            'warna' => 'primary',
            'deskripsi' => 'Petugas melakukan survey lokasi ke koordinat menurut laporan aduan',
        ]);

        Status::create([
            'name' => 'Eksekusi Lokasi',
            'kode_status' => '3',
            'warna' => 'primary',
            'deskripsi' => 'Petugas melakukan langkah eksekusi lokasi ke koordinat menurut laporan aduan',
        ]);

        Status::create([
            'name' => 'Selesai',
            'kode_status' => '99',
            'warna' => 'success',
            'deskripsi' => 'Laporan anda selesai ditangani petugas mohon cek komentar laporan',
        ]);

        Status::create([
            'name' => 'Ditolak',
            'kode_status' => '100',
            'warna' => 'danger',
            'deskripsi' => 'Laporan anda ditolak oleh petugas mohon cek komentar laporan anda',
        ]);
    }
}
