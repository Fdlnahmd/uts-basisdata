<?php

namespace Database\Seeders;

use App\Models\Kunjungan;
use Illuminate\Database\Seeder;

class KunjunganSeeder extends Seeder
{
    public function run(): void
    {
        $kunjungans = [
            [
                'no_kunjungan' => 'KNJ' . date('Ymd') . '001',
                'pasien_id' => 1,
                'dokter_id' => 1,
                'tanggal_kunjungan' => now()->format('Y-m-d'),
                'jam_kunjungan' => '08:30:00',
                'keluhan' => 'Demam tinggi sejak 2 hari yang lalu, disertai sakit kepala',
                'diagnosa' => 'Demam Tifoid',
                'tindakan' => 'Pemberian obat antipiretik dan antibiotik',
                'catatan' => 'Pasien disarankan istirahat total dan konsumsi makanan bergizi',
                'biaya_pemeriksaan' => 150000,
                'biaya_tindakan' => 0,
                'total_biaya' => 150000,
                'status' => 'Selesai',
            ],
            [
                'no_kunjungan' => 'KNJ' . date('Ymd') . '002',
                'pasien_id' => 2,
                'dokter_id' => 2,
                'tanggal_kunjungan' => now()->format('Y-m-d'),
                'jam_kunjungan' => '09:15:00',
                'keluhan' => 'Batuk dan pilek, anak rewel',
                'diagnosa' => 'ISPA (Infeksi Saluran Pernapasan Atas)',
                'tindakan' => 'Pemberian obat batuk dan vitamin',
                'catatan' => 'Jaga suhu ruangan tetap hangat',
                'biaya_pemeriksaan' => 100000,
                'biaya_tindakan' => 0,
                'total_biaya' => 100000,
                'status' => 'Selesai',
            ],
            [
                'no_kunjungan' => 'KNJ' . date('Ymd') . '003',
                'pasien_id' => 3,
                'dokter_id' => 1,
                'tanggal_kunjungan' => now()->subDays(1)->format('Y-m-d'),
                'jam_kunjungan' => '10:00:00',
                'keluhan' => 'Nyeri perut dan mual',
                'diagnosa' => 'Gastritis',
                'tindakan' => 'Pemberian obat maag dan antasida',
                'catatan' => 'Hindari makanan pedas dan asam',
                'biaya_pemeriksaan' => 120000,
                'biaya_tindakan' => 50000,
                'total_biaya' => 170000,
                'status' => 'Selesai',
            ],
            [
                'no_kunjungan' => 'KNJ' . date('Ymd') . '004',
                'pasien_id' => 4,
                'dokter_id' => 3,
                'tanggal_kunjungan' => now()->subDays(2)->format('Y-m-d'),
                'jam_kunjungan' => '14:30:00',
                'keluhan' => 'Kontrol kehamilan rutin',
                'diagnosa' => 'Kehamilan normal 20 minggu',
                'tindakan' => 'USG dan pemeriksaan tekanan darah',
                'catatan' => 'Janin berkembang normal, konsumsi vitamin prenatal',
                'biaya_pemeriksaan' => 200000,
                'biaya_tindakan' => 150000,
                'total_biaya' => 350000,
                'status' => 'Selesai',
            ],
            [
                'no_kunjungan' => 'KNJ' . date('Ymd') . '005',
                'pasien_id' => 5,
                'dokter_id' => 4,
                'tanggal_kunjungan' => now()->format('Y-m-d'),
                'jam_kunjungan' => '15:00:00',
                'keluhan' => 'Nyeri dada dan sesak napas saat aktivitas',
                'diagnosa' => 'Hipertensi Grade 2',
                'tindakan' => 'EKG dan pemberian obat antihipertensi',
                'catatan' => 'Disarankan mengurangi konsumsi garam dan olahraga teratur',
                'biaya_pemeriksaan' => 180000,
                'biaya_tindakan' => 100000,
                'total_biaya' => 280000,
                'status' => 'Selesai',
            ],
            [
                'no_kunjungan' => 'KNJ' . date('Ymd') . '006',
                'pasien_id' => 1,
                'dokter_id' => 5,
                'tanggal_kunjungan' => now()->subDays(3)->format('Y-m-d'),
                'jam_kunjungan' => '11:00:00',
                'keluhan' => 'Luka sayat di tangan kanan',
                'diagnosa' => 'Vulnus Laceratum',
                'tindakan' => 'Jahit luka dan pemberian antibiotik',
                'catatan' => 'Kontrol kembali 7 hari untuk buka jahitan',
                'biaya_pemeriksaan' => 150000,
                'biaya_tindakan' => 200000,
                'total_biaya' => 350000,
                'status' => 'Selesai',
            ],
        ];

        foreach ($kunjungans as $kunjungan) {
            Kunjungan::create($kunjungan);
        }
    }
}