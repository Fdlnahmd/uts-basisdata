<?php

namespace Database\Seeders;

use App\Models\Dokter;
use Illuminate\Database\Seeder;

class DokterSeeder extends Seeder
{
    public function run(): void
    {
        $dokters = [
            [
                'kode_dokter' => 'DOK001',
                'nama' => 'Dr. Ahmad Fauzi, Sp.PD',
                'jenis_kelamin' => 'L',
                'spesialisasi' => 'Penyakit Dalam',
                'no_sip' => 'SIP/001/2020',
                'telepon' => '081234567801',
                'email' => 'ahmad.fauzi@klinik.com',
                'alamat' => 'Jl. Kesehatan No. 10, Jakarta',
            ],
            [
                'kode_dokter' => 'DOK002',
                'nama' => 'Dr. Siti Nurhaliza, Sp.A',
                'jenis_kelamin' => 'P',
                'spesialisasi' => 'Anak',
                'no_sip' => 'SIP/002/2020',
                'telepon' => '081234567802',
                'email' => 'siti.nurhaliza@klinik.com',
                'alamat' => 'Jl. Merdeka No. 15, Jakarta',
            ],
            [
                'kode_dokter' => 'DOK003',
                'nama' => 'Dr. Budi Santoso, Sp.OG',
                'jenis_kelamin' => 'L',
                'spesialisasi' => 'Kandungan',
                'no_sip' => 'SIP/003/2020',
                'telepon' => '081234567803',
                'email' => 'budi.santoso@klinik.com',
                'alamat' => 'Jl. Pahlawan No. 20, Jakarta',
            ],
            [
                'kode_dokter' => 'DOK004',
                'nama' => 'Dr. Rina Wijaya, Sp.JP',
                'jenis_kelamin' => 'P',
                'spesialisasi' => 'Jantung',
                'no_sip' => 'SIP/004/2020',
                'telepon' => '081234567804',
                'email' => 'rina.wijaya@klinik.com',
                'alamat' => 'Jl. Sudirman No. 25, Jakarta',
            ],
            [
                'kode_dokter' => 'DOK005',
                'nama' => 'Dr. Hendra Gunawan, Sp.B',
                'jenis_kelamin' => 'L',
                'spesialisasi' => 'Bedah Umum',
                'no_sip' => 'SIP/005/2020',
                'telepon' => '081234567805',
                'email' => 'hendra.gunawan@klinik.com',
                'alamat' => 'Jl. Thamrin No. 30, Jakarta',
            ],
        ];

        foreach ($dokters as $dokter) {
            Dokter::create($dokter);
        }
    }
}