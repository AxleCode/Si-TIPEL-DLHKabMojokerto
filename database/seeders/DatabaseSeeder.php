<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\CategoryAduan;
use App\Models\Downloadable;
use App\Models\Komentar;
use App\Models\Laporan;
use App\Models\LaporanImage;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Pengumuman;
use App\Models\Status;

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

        Laporan::create([
            'category_aduan_id' =>'1',
            'user_id' =>'1',
            'judul' =>'Sampah liar samping jalan raya ngrame',
            'body' =>'Menumpuk dan perlu diambil pak',
            'coordinates' =>'-7.48989679257064, 112.56462304272291',
            'address' =>'JI-157, Ngrame, Mojokerto, East Java, 61382, Indonesia',
            'status' => '99',
        ]);

        LaporanImage::create([
            'laporan_id' => '1',
            'image_path' => 'laporan_images/timsam3.jpg',
        ]);
        LaporanImage::create([
            'laporan_id' => '1',
            'image_path' => 'laporan_images/timsam4.jpg',
        ]);
       

        Laporan::create([
            'category_aduan_id' =>'2',
            'user_id' =>'2',
            'judul' =>'ranting pohon besar melebihi garis pembatas jalan ',
            'body' =>'dijalan ini terdapat ranting pohon yang menganggu pengguna jalan',
            'coordinates' =>'-7.525574949258333, 112.58562150093381',
            'address' =>'Pungging, Mojokerto, East Java, 61384, Indonesia',
            'status' => '0',
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

        Laporan::create([
            'category_aduan_id' =>'1',
            'user_id' =>'2',
            'judul' =>'Bau menyengat sampah dijalan sebelah makam wonosari',
            'body' =>'Warga yang melintas tidak nyaman mohon segera diangkut sampahnya dan diberi larangan buang sampah disekitar area situ',
            'coordinates' =>'-7.498446969127178, 112.4771356269647',
            'address' =>'Jalan Raya Watukosek, Wonosari, Mojokerto, East Java, 61384, Indonesia',
            'status' => '1',
        ]);

        LaporanImage::create([
            'laporan_id' => '3',
            'image_path' => 'laporan_images/timsam1.jpg',
        ]);
        LaporanImage::create([
            'laporan_id' => '3',
            'image_path' => 'laporan_images/timsam2.jpg',
        ]);

        Laporan::create([
            'category_aduan_id' =>'1',
            'user_id' =>'2',
            'judul' =>'Banyak sampah menumpuk dijalan desa Tambakrejo',
            'body' =>'banyak warga yang tetap buang sampah sembarangan di area situ mohon petugas dinas lingkungan hidup untuk memberikan solusi',
            'coordinates' =>'-7.550669797052894, 112.65387746174548',
            'address' =>'Tambakrejo, Mojokerto, East Java, 67155, Indonesia',
            'status' => '0',
        ]);

        LaporanImage::create([
            'laporan_id' => '4',
            'image_path' => 'laporan_images/timsam5.jpg',
        ]);
        LaporanImage::create([
            'laporan_id' => '4',
            'image_path' => 'laporan_images/timsam6.jpg',
        ]);
        

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

        Downloadable::create([
            'name' => 'Tata cara pendaftaran akun si-Tipel',
            'deskripsi' => 'Berisi panduan tata cara pendaftaran akun si-Tipel',
            'ukuran' => '1.09 MB',
            'file' => 'pendaftaran.pdf',
        ]);

        Downloadable::create([
            'name' => 'Tata cara pelaporan aduan',
            'deskripsi' => 'Berisi panduan tata cara pelaporan aduan si-Tipel',
            'ukuran' => '3.15 MB',
            'file' => 'aduan.pdf',
        ]);

        Komentar::create([
            'laporan_id' => '1',
            'komentar' => 'ashiappp kami terima aduannya boss',
            'file' => '',
            'updated_at' => '2023-02-17 08:37:02',
            'status' => '1',
        ]);
        Komentar::create([
            'laporan_id' => '1',
            'komentar' => 'survey lokasi dulu boss beneran banyak sampah ape zonk',
            'file' => '',
            'updated_at' => '2023-02-18 08:37:02',
            'status' => '2',
        ]);
        Komentar::create([
            'laporan_id' => '1',
            'komentar' => 'sip udah diangkut boss',
            'file' => 'sip.jpg',
            'updated_at' => '2023-02-19 08:37:02',
            'status' => '3',
        ]);

        Komentar::create([
            'laporan_id' => '1',
            'komentar' => 'udah bersih boss shengghol dhonk',
            'file' => 'bersih.jpg',
            'updated_at' => '2023-02-19 10:37:02',
            'status' => '99',
        ]);

    }
}
