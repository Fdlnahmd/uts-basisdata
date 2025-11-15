<?php

namespace Database\Seeders;

use App\Models\Resep;
use Illuminate\Database\Seeder;

class ResepSeeder extends Seeder
{
    public function run(): void
    {
        $reseps = [
            // Resep untuk Kunjungan 1 (Demam Tifoid) - 3 obat = 3 resep
            [
                'no_resep' => 'RSP' . date('Ymd') . '001',
                'kunjungan_id' => 1,
                'dokter_id' => 1,
                'pasien_id' => 1,
                'obat_id' => 1, // Paracetamol
                'jumlah' => 3,
                'aturan_pakai' => '3x sehari 1 tablet setelah makan',
                'harga_satuan' => 5000,
                'subtotal' => 15000,
                'tanggal_resep' => now()->format('Y-m-d'),
                'status' => 'Diambil',
                'catatan' => 'Obat diminum sesuai aturan',
            ],
            [
                'no_resep' => 'RSP' . date('Ymd') . '002',
                'kunjungan_id' => 1,
                'dokter_id' => 1,
                'pasien_id' => 1,
                'obat_id' => 2, // Amoxicillin
                'jumlah' => 2,
                'aturan_pakai' => '3x sehari 1 kapsul setelah makan, habiskan',
                'harga_satuan' => 12000,
                'subtotal' => 24000,
                'tanggal_resep' => now()->format('Y-m-d'),
                'status' => 'Diambil',
            ],
            [
                'no_resep' => 'RSP' . date('Ymd') . '003',
                'kunjungan_id' => 1,
                'dokter_id' => 1,
                'pasien_id' => 1,
                'obat_id' => 5, // Vitamin C
                'jumlah' => 1,
                'aturan_pakai' => '1x sehari 1 tablet setelah makan',
                'harga_satuan' => 15000,
                'subtotal' => 15000,
                'tanggal_resep' => now()->format('Y-m-d'),
                'status' => 'Diambil',
            ],

            // Resep untuk Kunjungan 2 (ISPA)
            [
                'no_resep' => 'RSP' . date('Ymd') . '004',
                'kunjungan_id' => 2,
                'dokter_id' => 2,
                'pasien_id' => 2,
                'obat_id' => 3, // OBH Combi
                'jumlah' => 1,
                'aturan_pakai' => '3x sehari 1 sendok teh',
                'harga_satuan' => 22000,
                'subtotal' => 22000,
                'tanggal_resep' => now()->format('Y-m-d'),
                'status' => 'Diambil',
                'catatan' => 'Untuk anak, perhatikan dosis',
            ],
            [
                'no_resep' => 'RSP' . date('Ymd') . '005',
                'kunjungan_id' => 2,
                'dokter_id' => 2,
                'pasien_id' => 2,
                'obat_id' => 7, // CTM
                'jumlah' => 1,
                'aturan_pakai' => '3x sehari 1/2 tablet',
                'harga_satuan' => 3500,
                'subtotal' => 3500,
                'tanggal_resep' => now()->format('Y-m-d'),
                'status' => 'Diambil',
            ],

            // Resep untuk Kunjungan 3 (Gastritis)
            [
                'no_resep' => 'RSP' . date('Ymd', strtotime('-1 day')) . '006',
                'kunjungan_id' => 3,
                'dokter_id' => 1,
                'pasien_id' => 3,
                'obat_id' => 4, // Antasida
                'jumlah' => 2,
                'aturan_pakai' => '3x sehari 1 tablet sebelum makan',
                'harga_satuan' => 6500,
                'subtotal' => 13000,
                'tanggal_resep' => now()->subDays(1)->format('Y-m-d'),
                'status' => 'Diambil',
                'catatan' => 'Minum sebelum makan',
            ],
            [
                'no_resep' => 'RSP' . date('Ymd', strtotime('-1 day')) . '007',
                'kunjungan_id' => 3,
                'dokter_id' => 1,
                'pasien_id' => 3,
                'obat_id' => 1, // Paracetamol
                'jumlah' => 1,
                'aturan_pakai' => '3x sehari 1 tablet jika nyeri',
                'harga_satuan' => 5000,
                'subtotal' => 5000,
                'tanggal_resep' => now()->subDays(1)->format('Y-m-d'),
                'status' => 'Diambil',
            ],

            // Resep untuk Kunjungan 4 (Kehamilan) - tidak ada resep

            // Resep untuk Kunjungan 5 (Hipertensi)
            [
                'no_resep' => 'RSP' . date('Ymd') . '008',
                'kunjungan_id' => 5,
                'dokter_id' => 4,
                'pasien_id' => 5,
                'obat_id' => 6, // Ibuprofen
                'jumlah' => 2,
                'aturan_pakai' => '2x sehari 1 tablet setelah makan',
                'harga_satuan' => 8000,
                'subtotal' => 16000,
                'tanggal_resep' => now()->format('Y-m-d'),
                'status' => 'Selesai',
                'catatan' => 'Kontrol tekanan darah setiap minggu',
            ],
            [
                'no_resep' => 'RSP' . date('Ymd') . '009',
                'kunjungan_id' => 5,
                'dokter_id' => 4,
                'pasien_id' => 5,
                'obat_id' => 5, // Vitamin C
                'jumlah' => 1,
                'aturan_pakai' => '1x sehari 1 tablet',
                'harga_satuan' => 15000,
                'subtotal' => 15000,
                'tanggal_resep' => now()->format('Y-m-d'),
                'status' => 'Selesai',
            ],

            // Resep untuk Kunjungan 6 (Luka Jahit)
            [
                'no_resep' => 'RSP' . date('Ymd', strtotime('-3 days')) . '010',
                'kunjungan_id' => 6,
                'dokter_id' => 5,
                'pasien_id' => 1,
                'obat_id' => 2, // Amoxicillin
                'jumlah' => 2,
                'aturan_pakai' => '3x sehari 1 kapsul, habiskan',
                'harga_satuan' => 12000,
                'subtotal' => 24000,
                'tanggal_resep' => now()->subDays(3)->format('Y-m-d'),
                'status' => 'Diambil',
                'catatan' => 'Jaga luka tetap kering dan bersih',
            ],
            [
                'no_resep' => 'RSP' . date('Ymd', strtotime('-3 days')) . '011',
                'kunjungan_id' => 6,
                'dokter_id' => 5,
                'pasien_id' => 1,
                'obat_id' => 8, // Salep Kulit
                'jumlah' => 1,
                'aturan_pakai' => 'Oleskan 2x sehari pada luka',
                'harga_satuan' => 18000,
                'subtotal' => 18000,
                'tanggal_resep' => now()->subDays(3)->format('Y-m-d'),
                'status' => 'Diambil',
            ],
            [
                'no_resep' => 'RSP' . date('Ymd', strtotime('-3 days')) . '012',
                'kunjungan_id' => 6,
                'dokter_id' => 5,
                'pasien_id' => 1,
                'obat_id' => 1, // Paracetamol
                'jumlah' => 1,
                'aturan_pakai' => '3x sehari 1 tablet jika nyeri',
                'harga_satuan' => 5000,
                'subtotal' => 5000,
                'tanggal_resep' => now()->subDays(3)->format('Y-m-d'),
                'status' => 'Diambil',
            ],
        ];

        foreach ($reseps as $resep) {
            Resep::create($resep);
        }
    }
}