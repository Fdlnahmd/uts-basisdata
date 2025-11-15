<?php

namespace Database\Seeders;

use App\Models\Obat;
use Illuminate\Database\Seeder;

class ObatSeeder extends Seeder
{
    public function run(): void
    {
        $obats = [
            [
                'kode_obat' => 'OBT001',
                'nama_obat' => 'Paracetamol 500mg',
                'kategori' => 'Tablet',
                'satuan' => 'Strip',
                'stok' => 200,
                'stok_minimum' => 50,
                'harga_beli' => 3000,
                'harga_jual' => 5000,
                'tanggal_kadaluarsa' => '2025-12-31',
                'produsen' => 'PT Farmasi Indonesia',
                'deskripsi' => 'Obat penurun panas dan pereda nyeri',
            ],
            [
                'kode_obat' => 'OBT002',
                'nama_obat' => 'Amoxicillin 500mg',
                'kategori' => 'Kapsul',
                'satuan' => 'Strip',
                'stok' => 150,
                'stok_minimum' => 30,
                'harga_beli' => 8000,
                'harga_jual' => 12000,
                'tanggal_kadaluarsa' => '2025-10-31',
                'produsen' => 'PT Medika Farma',
                'deskripsi' => 'Antibiotik untuk infeksi bakteri',
            ],
            [
                'kode_obat' => 'OBT003',
                'nama_obat' => 'OBH Combi',
                'kategori' => 'Sirup',
                'satuan' => 'Botol',
                'stok' => 80,
                'stok_minimum' => 20,
                'harga_beli' => 15000,
                'harga_jual' => 22000,
                'tanggal_kadaluarsa' => '2025-09-30',
                'produsen' => 'PT Anugrah Medika',
                'deskripsi' => 'Obat batuk dan flu',
            ],
            [
                'kode_obat' => 'OBT004',
                'nama_obat' => 'Antasida DOEN',
                'kategori' => 'Tablet',
                'satuan' => 'Strip',
                'stok' => 120,
                'stok_minimum' => 40,
                'harga_beli' => 4000,
                'harga_jual' => 6500,
                'tanggal_kadaluarsa' => '2026-01-31',
                'produsen' => 'PT Kimia Farma',
                'deskripsi' => 'Obat maag dan gangguan lambung',
            ],
            [
                'kode_obat' => 'OBT005',
                'nama_obat' => 'Vitamin C 1000mg',
                'kategori' => 'Tablet',
                'satuan' => 'Strip',
                'stok' => 180,
                'stok_minimum' => 50,
                'harga_beli' => 10000,
                'harga_jual' => 15000,
                'tanggal_kadaluarsa' => '2026-03-31',
                'produsen' => 'PT Supra Medika',
                'deskripsi' => 'Suplemen vitamin C',
            ],
            [
                'kode_obat' => 'OBT006',
                'nama_obat' => 'Ibuprofen 400mg',
                'kategori' => 'Tablet',
                'satuan' => 'Strip',
                'stok' => 100,
                'stok_minimum' => 30,
                'harga_beli' => 5000,
                'harga_jual' => 8000,
                'tanggal_kadaluarsa' => '2025-11-30',
                'produsen' => 'PT Farmasi Indonesia',
                'deskripsi' => 'Anti inflamasi dan pereda nyeri',
            ],
            [
                'kode_obat' => 'OBT007',
                'nama_obat' => 'CTM 4mg',
                'kategori' => 'Tablet',
                'satuan' => 'Strip',
                'stok' => 150,
                'stok_minimum' => 40,
                'harga_beli' => 2000,
                'harga_jual' => 3500,
                'tanggal_kadaluarsa' => '2025-08-31',
                'produsen' => 'PT Medika Farma',
                'deskripsi' => 'Obat alergi',
            ],
            [
                'kode_obat' => 'OBT008',
                'nama_obat' => 'Salep Kulit',
                'kategori' => 'Salep',
                'satuan' => 'Tube',
                'stok' => 60,
                'stok_minimum' => 15,
                'harga_beli' => 12000,
                'harga_jual' => 18000,
                'tanggal_kadaluarsa' => '2025-07-31',
                'produsen' => 'PT Derma Care',
                'deskripsi' => 'Salep untuk infeksi kulit',
            ],
        ];

        foreach ($obats as $obat) {
            Obat::create($obat);
        }
    }
}

