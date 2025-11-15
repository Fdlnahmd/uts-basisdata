<?php

namespace Database\Seeders;

use App\Models\Poliklinik;
use App\Models\RumahSakit;
use Illuminate\Database\Seeder;

class PoliklinikSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil ID rumah sakit yang sudah ada
        $rs1 = RumahSakit::where('kode_rs', 'RS001A')->first();
        $rs2 = RumahSakit::where('kode_rs', 'RS001B')->first();

        $data = [
            // Poliklinik untuk RS Sehat Sentosa (RS001A)
            [
                'rumah_sakit_id' => $rs1->id,
                'kode_poliklinik' => 'POLI-001',
                'nama_poliklinik' => 'Poliklinik Umum',
                'lantai' => '1',
                'gedung' => 'Gedung A',
                'status' => 'aktif',
            ],
            [
                'rumah_sakit_id' => $rs1->id,
                'kode_poliklinik' => 'POLI-002',
                'nama_poliklinik' => 'Poliklinik Gigi',
                'lantai' => '2',
                'gedung' => 'Gedung A',
                'status' => 'aktif',
            ],
            [
                'rumah_sakit_id' => $rs1->id,
                'kode_poliklinik' => 'POLI-003',
                'nama_poliklinik' => 'Poliklinik Anak',
                'lantai' => '2',
                'gedung' => 'Gedung B',
                'status' => 'aktif',
            ],
            [
                'rumah_sakit_id' => $rs1->id,
                'kode_poliklinik' => 'POLI-004',
                'nama_poliklinik' => 'Poliklinik Kandungan',
                'lantai' => '3',
                'gedung' => 'Gedung B',
                'status' => 'aktif',
            ],
            
            // Poliklinik untuk RS Sentosa Sehat (RS001B)
            [
                'rumah_sakit_id' => $rs2->id,
                'kode_poliklinik' => 'POLI-005',
                'nama_poliklinik' => 'Poliklinik Umum',
                'lantai' => '1',
                'gedung' => 'Gedung Utama',
                'status' => 'aktif',
            ],
            [
                'rumah_sakit_id' => $rs2->id,
                'kode_poliklinik' => 'POLI-006',
                'nama_poliklinik' => 'Poliklinik Jantung',
                'lantai' => '2',
                'gedung' => 'Gedung Utama',
                'status' => 'aktif',
            ],
            [
                'rumah_sakit_id' => $rs2->id,
                'kode_poliklinik' => 'POLI-007',
                'nama_poliklinik' => 'Poliklinik Mata',
                'lantai' => '3',
                'gedung' => 'Gedung Utama',
                'status' => 'aktif',
            ],
            [
                'rumah_sakit_id' => $rs2->id,
                'kode_poliklinik' => 'POLI-008',
                'nama_poliklinik' => 'Poliklinik THT',
                'lantai' => '2',
                'gedung' => 'Gedung Annex',
                'status' => 'aktif',
            ],
        ];

        foreach ($data as $item) {
            Poliklinik::create($item);
        }
    }
}