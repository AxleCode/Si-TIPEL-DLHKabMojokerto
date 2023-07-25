<?php

namespace Database\Seeders;

use App\Models\Pelayanan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PelayananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pelayanan::create([
            'nomor' => 1,
            'slug' => 'Registrasi Akun si-Tipel',
            'body' => 'Silahkan buat akun terlebih daluhu pada link http://127.0.0.1:8000/register masukkan identitas diri anda dan cek inbox email yang sudah anda masukkan untuk verifikasi',
        ]);
        Pelayanan::create([
            'nomor' => 2,
            'slug' => 'Login Akun si-Tipel',
            'body' => 'Silahkan buka link http://127.0.0.1:8000/login kemudian login menggunakan username dan password yang sudah anda daftarkan',
        ]);
        Pelayanan::create([
            'nomor' => 3,
            'slug' => 'Isi Formulir',
            'body' => 'Silahkan buka dashboard anda dan pada bagian kiri sidebar klik <strong>Isi Formulir</strong> kemudian silahkan isi formulir sesuai dengan perintah dan klik submit',
        ]);
        Pelayanan::create([
            'nomor' => 4,
            'slug' => 'Proses Pelayanan',
            'body' => 'Apabila formulir sudah anda sudah submit maka laporan akan segera dilayani oleh petugas dan silahkan tunggu status laporan selanjutnya',
        ]);
    }
}
