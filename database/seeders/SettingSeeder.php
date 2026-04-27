<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            ['key' => 'nama_mempelai_pria', 'value' => 'Gusti Panji Widodo'],
            ['key' => 'ortu_pria', 'value' => 'Putra dari Bpk. Joko & Ibu Titik'],
            ['key' => 'nama_mempelai_wanita', 'value' => 'Azwa Zahira'],
            ['key' => 'ortu_wanita', 'value' => 'Putri dari Bpk. Rusnaldi & Ibu Verawati'],
            ['key' => 'tanggal_akad', 'value' => "Jum'at, 11 Juli 2026"],
            ['key' => 'waktu_akad', 'value' => '08:00 - 15:00 WIB'],
            ['key' => 'tempat_akad', 'value' => 'Masjid Al-Ikhlas'],
            ['key' => 'alamat_akad', 'value' => 'Jl. Suka Karya, Kel. Tuah Karya, Kec. Tampan, Kota Pekanbaru, Riau'],
            ['key' => 'tanggal_resepsi', 'value' => 'Minggu, 13 Juli 2026'],
            ['key' => 'waktu_resepsi', 'value' => '09:00 - 16:00 WIB'],
            ['key' => 'tempat_resepsi', 'value' => 'Grand Central Hotel Pekanbaru'],
            ['key' => 'alamat_resepsi', 'value' => 'Jl. Jend. Sudirman No.1, Tengkerang Utara, Kec. Bukit Raya, Kota Pekanbaru, Riau'],
            ['key' => 'map_iframe', 'value' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15958.625700547745!2d101.4398322619087!3d0.505504746404761!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31d5aea9f300c14f%3A0x2ad1b12b5952d708!2sGrand%20Central%20Hotel%20Pekanbaru!5e0!3m2!1sid!2sid!4v1711718000000!5m2!1sid!2sid'],
            ['key' => 'map_link', 'value' => 'https://www.google.com/maps/search/?api=1&query=Grand+Central+Hotel+Pekanbaru'],
            ['key' => 'foto_pria', 'value' => 'assets/gustiportrait.jpeg'],
            ['key' => 'foto_wanita', 'value' => 'assets/azwaportrait.jpeg'],
            ['key' => 'foto_cover', 'value' => 'assets/herobg.jpg'],
            ['key' => 'hari_acara', 'value' => '2026-07-11'],
        ];

        \Illuminate\Support\Facades\DB::table('settings')->insert($settings);
    }
}
