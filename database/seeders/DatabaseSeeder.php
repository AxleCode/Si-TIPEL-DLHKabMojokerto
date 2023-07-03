<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Logo;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Pengumuman;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */

    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([
            CategoryAduanSeeder::class,
            DownloadableSeeder::class,
            KomentarSeeder::class,
            LaporanSeeder::class,
            LaporanImageSeeder::class,
            StatusSeeder::class,
            NotifikasiSeeder::class,
            LogoSeeder::class,
            PelayananSeeder::class,
        ]);

        User::create([
            'name' => 'AdminDLH',
            'email' => 'dlh@gmail.com',
            'password' => bcrypt('password'),
            'alamatpemohon' => 'Dinas Lingkungan Hidup',
            'nohp' => '12345',
            'email_verified_at' => now(),
            'is_admin' => '1'

        ]);

        User::create([
            'name' => 'Achmad Xander L',
            'email' => 'xander@gmail.com',
            'password' => bcrypt('password'),
            'alamatpemohon' => 'Dinas Lingkungan Hidup',
            'nohp' => '12345',
            'email_verified_at' => now(),
            'is_admin' => '0'
        ]);


        User::factory(3)->create();

        Pengumuman::create([

            'judul' => 'Aplikasi Si-TIPEL versi 1.0',
            'body' => 'Aplikasi belum bisa melakukan pelayanan yang sebenarnya namun silahkan untuk uji coba website kami dan silahkan laporkan ke nomor Whatsapp
                        081333299375 apabila tampilan atau fungsi aplikasi ini ada yang error.<p><p><strong> Best regards TIM DEV Si-TIPEL</strong>',
            'updated_at' => '2023-02-17 08:37:02',
            'status' => '1'	
        ]);

        Pengumuman::create([
            
            'judul' => 'Persiapan Pelayanan Website',
            'body' => 'Aplikasi akan segera bisa menerima pelayanan yang sebernarnya untuk itu kami selaku Dev Team Si-TIPEL mengucapkan banyak terimakasih kepada
                        para user yang sudah.<p><p><strong>Petugas Si-TIPEL DLH KAB MOJOKERTO</strong>',
            'updated_at' => '2023-02-20 09:07:01',
            'status' => '1'		
        ]);

        Pengumuman::create([
            
            'judul' => 'Jam Pelayanan Aplikasi Website Si-TIPEL',
            'body' => 'Aplikasi bisa digunakan 24 jam namun untuk proses pelayanan akan dilakukan oleh petugas Dinas Lingkungan Hidup Kabupaten Mojokerto pada hari
                        dan jam kerja yaitu hari Senin-Kamis 08:30 - 16:00 Jumat 08:00 - 14:00 .<p><p><strong>Petugas Si-TIPEL DLH KAB MOJOKERTO</strong>',
            'updated_at' => '2023-02-21 10:17:11',
            'status' => '1'		
        ]);

    }
}
