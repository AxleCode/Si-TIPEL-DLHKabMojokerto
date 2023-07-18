<?php

namespace Database\Seeders;

use App\Models\LaporanImage;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class LaporanImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LaporanImage::create([
            'laporan_id' => '1',
            'image_path' => 'laporan_images/timsam3.jpg',
        ]);
        LaporanImage::create([
            'laporan_id' => '1',
            'image_path' => 'laporan_images/timsam4.jpg',
        ]);
        LaporanImage::create([
            'laporan_id' => '2',
            'image_path' => 'laporan_images/gangtum1.jpg',
        ]);
        LaporanImage::create([
            'laporan_id' => '2',
            'image_path' => 'laporan_images/gangtum2.jpg',
        ]);
        LaporanImage::create([
            'laporan_id' => '2',
            'image_path' => 'laporan_images/gangtum3.jpg',
        ]);
        LaporanImage::create([
            'laporan_id' => '3',
            'image_path' => 'laporan_images/timsam1.jpg',
        ]);
        LaporanImage::create([
            'laporan_id' => '3',
            'image_path' => 'laporan_images/timsam2.jpg',
        ]);
        LaporanImage::create([
            'laporan_id' => '4',
            'image_path' => 'laporan_images/timsam9.jpg',
        ]);
        LaporanImage::create([
            'laporan_id' => '4',
            'image_path' => 'laporan_images/timsam10.jpg',
        ]);
    }
}
