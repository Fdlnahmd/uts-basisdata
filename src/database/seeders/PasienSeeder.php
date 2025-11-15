<?php

namespace Database\Seeders;

use App\Models\Pasien;
use Illuminate\Database\Seeder;

class PasienSeeder extends Seeder
{
    public function run(): void
    {
        $pasiens = [
            [
                'no_rm' => 'RM001001',
                'nik' => '3175012345670001',
                'nama' => 'Andi Wijaya',
                'jenis_kelamin' => 'L',
                'tanggal_lahir' => '1990-05-15',
                'tempat_lahir' => 'Jakarta',
                'golongan_darah' => 'A',
                'telepon' => '081234567890',
                'email' => 'andi.wijaya@email.com',
                'alamat' => 'Jl. Mawar No. 10, Jakarta Selatan',
                'pekerjaan' => 'Karyawan Swasta',
            ],
            [
                'no_rm' => 'RM001002',
                'nik' => '3175012345670002',
                'nama' => 'Sari Indah',
                'jenis_kelamin' => 'P',
                'tanggal_lahir' => '1985-08-20',
                'tempat_lahir' => 'Bandung',
                'golongan_darah' => 'B',
                'telepon' => '081234567891',
                'email' => 'sari.indah@email.com',
                'alamat' => 'Jl. Melati No. 15, Jakarta Pusat',
                'pekerjaan' => 'Guru',
            ],
            [
                'no_rm' => 'RM001003',
                'nik' => '3175012345670003',
                'nama' => 'Budi Hartono',
                'jenis_kelamin' => 'L',
                'tanggal_lahir' => '2015-03-10',
                'tempat_lahir' => 'Jakarta',
                'golongan_darah' => 'O',
                'telepon' => '081234567892',
                'alamat' => 'Jl. Anggrek No. 20, Jakarta Barat',
                'pekerjaan' => 'Pelajar',
                'nama_wali' => 'Hartono',
                'telepon_wali' => '081234567893',
            ],
            [
                'no_rm' => 'RM001004',
                'nik' => '3175012345670004',
                'nama' => 'Dewi Lestari',
                'jenis_kelamin' => 'P',
                'tanggal_lahir' => '1978-12-05',
                'tempat_lahir' => 'Surabaya',
                'golongan_darah' => 'AB',
                'telepon' => '081234567894',
                'email' => 'dewi.lestari@email.com',
                'alamat' => 'Jl. Kenanga No. 25, Jakarta Timur',
                'pekerjaan' => 'Wiraswasta',
            ],
            [
                'no_rm' => 'RM001005',
                'nik' => '3175012345670005',
                'nama' => 'Rudi Setiawan',
                'jenis_kelamin' => 'L',
                'tanggal_lahir' => '1995-07-25',
                'tempat_lahir' => 'Semarang',
                'golongan_darah' => 'A',
                'telepon' => '081234567895',
                'email' => 'rudi.setiawan@email.com',
                'alamat' => 'Jl. Dahlia No. 30, Jakarta Utara',
                'pekerjaan' => 'Programmer',
            ],
        ];

        foreach ($pasiens as $pasien) {
            Pasien::create($pasien);
        }
    }
}