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
            'user_id' => 1,
            'pesan' => 'Ini adalah notifikasi pertama.',
            'status' => false,
            'link' => '/',
        ]);
        Notifikasi::create([
            'user_id' => 1,
            'pesan' => 'Ini adalah notifikasi kedua.',
            'status' => true,
            'link' => '/',
        ]);
        Notifikasi::create([
            'user_id' => 1,
            'pesan' => 'Ini adalah notifikasi favng oiegvoe ngvweuh nvw heiu cnhu fhi uhN IEHF VNWE FGNvwf guyeW XNUFGU Yg xwyufuy bufybg wfvewfvw efwevwe bgth btrh bw rcwer ewr eccr ewr',
            'status' => true,
            'link' => '/',
        ]);
        Notifikasi::create([
            'user_id' => 2,
            'pesan' => 'halo.',
            'status' => false,
            'link' => '/',
        ]);
    }
}
