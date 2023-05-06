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
            'name' =>'Timbulan Sampah',
            'deskripsi' =>'Tumpukan sampah baru yang muncul di area Kabupaten Mojokerto',
            'image' =>'img/timbulan.jpeg',
            
        ]);

        CategoryAduan::create([
            'name' =>'Gangguan Tumbuhan',
            'deskripsi' =>'Tumbuhan yang mengganggu transportasi jalan raya di area Kabupaten Mojokerto',
            'image' =>'img/gangguan-tumbuhan.jpeg',
        ]);

        CategoryAduan::create([
            'name' =>'Limbah Air',
            'deskripsi' =>'Pencemaran pembuangan limbah air yang menganggu dan terjadi di area Kabupaten Mojokerto',
            'image' =>'img/limbah-air.jpeg',
        ]);

        CategoryAduan::create([
            'name' =>'Limbah Udara',
            'deskripsi' =>'Pencemaran pembuangan limbah udara yang menganggu dan terjadi di area Kabupaten Mojokerto',
            'image' =>'img/limbah-udara.jpeg',
        ]);
    }
}
