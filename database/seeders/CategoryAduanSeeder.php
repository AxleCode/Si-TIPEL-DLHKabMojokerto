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
            'name' =>'Pengujian Parameter Udara',
            'deskripsi' =>'Pengukuran berbagai parameter dan komponen dalam udara yang dapat memberikan informasi tentang tingkat polusi udara dan dampaknya terhadap lingkungan dan kesehatan masyarakat',
            'image' =>'img/limbah-udara.jpeg',
        ]);

        CategoryAduan::create([
            'name' =>'Pengujian Parameter Air',
            'deskripsi' =>'Pemantauan dan pengendalian kualitas air dilakukan untuk menentukan kualitas air dalam berbagai aspek seperti kebersihan, keamanan, dan kesesuaian dengan standar lingkungan yang telah ditetapkan',
            'image' =>'img/limbah-air.jpeg',
        ]);
    }
}
