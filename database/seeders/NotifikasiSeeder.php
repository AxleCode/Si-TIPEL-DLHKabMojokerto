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
            'judul'=> 'Laporan Update',
            'logo'=> 'clipboard',
            'textlogo'=> 'text-primary',
            'pesan' => 'Ini adalah notifikasi pertama.',
            'status' => false,
            'created_at' => '2023-02-18 08:37:02',

        ]);
        Notifikasi::create([
            'user_id' => 1,
            'judul'=> 'Laporan Update',
            'logo'=> 'clipboard',
            'textlogo'=> 'text-primary',
            'pesan' => 'Ini adalah notifikasi kedua.',
            'status' => false,
            'created_at' => '2023-02-19 09:37:02',
        ]);
        Notifikasi::create([
            'user_id' => 1,
            'judul'=> 'Laporan Update',
            'logo'=> 'clipboard',
            'textlogo'=> 'text-primary',
            'pesan' => 'Ini adalah notifikasi favng oiegvoe ngvweuh nvw heiu cnhu fhi uhN IEHF VNWE FGNvwf guyeW XNUFGU Yg xwyufuy bufybg wfvewfvw efwevwe bgth btrh bw rcwer ewr eccr ewr',
            'status' => false,
            'created_at' => '2023-04-18 08:37:02',
        ]);
        Notifikasi::create([
            'user_id' => 1,
            'judul'=> 'Laporan Update',
            'logo'=> 'clipboard',
            'textlogo'=> 'text-primary',
            'pesan' => 'Ini adalah notifikasi favng oiegvoe ngvweuh nvw heiu cnhu fhi uhN IEHF VNWE FGNvwf guyeW XNUFGU Yg xwyufuy bufybg wfvewfvw efwevwe bgth btrh bw rcwer ewr eccr ewr',
            'status' => false,
            'created_at' => '2023-04-19 08:37:02',
        ]);
        Notifikasi::create([
            'user_id' => 1,
            'judul'=> 'Laporan Update',
            'logo'=> 'clipboard',
            'textlogo'=> 'text-primary',
            'pesan' => 'Ini adalah notifikasi favng oiegvoe ngvweuh nvw heiu cnhu fhi uhN IEHF VNWE FGNvwf guyeW XNUFGU Yg xwyufuy bufybg wfvewfvw efwevwe bgth btrh bw rcwer ewr eccr ewr',
            'status' => true,
            'created_at' => '2023-04-21 08:37:02',
        ]);
        Notifikasi::create([
            'user_id' => 2,
            'judul'=> 'Laporan Update',
            'logo'=> 'clipboard',
            'textlogo'=> 'text-primary',
            'pesan' => 'halo.',
            'status' => false,
        ]);
    }
}
