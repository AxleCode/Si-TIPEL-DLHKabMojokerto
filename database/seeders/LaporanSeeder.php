<?php

namespace Database\Seeders;

use App\Models\Laporan;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class LaporanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Laporan::create([
            'category_aduan_id' =>'1',
            'user_id' =>'1',
            'nama' => 'admin',
            'nomor_tiket' => 2806202311,
            'telpon' => '08587392109',
            'email' => 'axander@gmail.com',
            'judul' =>'Sampah liar samping jalan raya ngrame',
            'body' =>'Menumpuk dan perlu diambil pak',
            'coordinates' =>'-7.48989679257064, 112.56462304272291',
            'posisi' =>'-7.48989679257064, 112.56462304272291',
            'address' =>'JI-157, Ngrame, Mojokerto, East Java, 61382, Indonesia',
            'status' => '99',
        ]);
        Laporan::create([
            'category_aduan_id' =>'1',
            'user_id' =>'2',
            'nama' => 'xander',
            'nomor_tiket' => 2806202312,
            'telpon' => '08587392109',
            'email' => 'xander@gmail.com',
            'judul' =>'ranting pohon besar melebihi garis pembatas jalan ',
            'body' =>'dijalan ini terdapat ranting pohon yang menganggu pengguna jalan',
            'coordinates' =>'-7.525574949258333, 112.58562150093381',
            'posisi' =>'-7.525574949258333, 112.58562150093381',
            'address' =>'Pungging, Mojokerto, East Java, 61384, Indonesia',
            'status' => '0',
        ]);
        Laporan::create([
            'category_aduan_id' =>'2',
            'user_id' =>'2',
            'nama' => 'xander',
            'nomor_tiket' => 2806202323,
            'telpon' => '08587392109',
            'email' => 'axander@gmail.com',
            'judul' =>'Bau menyengat sampah dijalan sebelah makam wonosari',
            'body' =>'Warga yang melintas tidak nyaman mohon segera diangkut sampahnya dan diberi larangan buang sampah disekitar area situ',
            'coordinates' =>'-7.498446969127178, 112.4771356269647',
            'posisi' =>'-7.498446969127178, 112.4771356269647',
            'address' =>'Pacing, Bangsal, Mojokerto Regency, East Java',
            'status' => '1',
        ]);
        Laporan::create([
            'category_aduan_id' =>'1',
            'user_id' =>'2',
            'nama' => 'xander',
            'nomor_tiket' => 2806202314,
            'telpon' => '08587392109',
            'email' => 'axander@gmail.com',
            'judul' =>'Banyak sampah menumpuk dijalan desa Tambakrejo',
            'body' =>'banyak warga yang tetap buang sampah sembarangan di area situ mohon petugas dinas lingkungan hidup untuk memberikan solusi',
            'coordinates' =>'-7.550669797052894, 112.65387746174548',
            'posisi' =>'-7.550669797052894, 112.65387746174548',
            'address' =>'Tambakrejo, Mojokerto, East Java, 67155, Indonesia',
            'status' => '0',
        ]);
    }
}
