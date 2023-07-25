<?php

namespace Database\Seeders;

use App\Models\CategoryAduan;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategoryAduanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CategoryAduan::create([
            'name' =>'Pengaduan Masyarakat',
            'deskripsi' =>'Semua masyarakat dapat mengadukan masalah yang ada di lingkungan hidup kabupaten mojokerto',
            'image' =>'img/pengaduan.jpg',
            
        ]);

        CategoryAduan::create([
            'name' =>'Pelayanan Pengangkutan Sampah',
            'deskripsi' =>'Pelayanan ini melibatkan proses pengumpulan, pengangkutan, dan pemrosesan sampah sesuai dengan regulasi dan kebijakan yang berlaku',
            'image' =>'img/pengambilan-sampah.jpg',
        ]);

        CategoryAduan::create([
            'name' =>'Pengujian Laboratorium',
            'deskripsi' =>'Pengukuran berbagai parameter dan komponen dalam air dan udara yang dapat memberikan informasi tentang tingkat polusi beserta dampaknya terhadap lingkungan dan kesehatan masyarakat',
            'image' =>'img/laboratorium.jpg',
        ]);
    }
}
