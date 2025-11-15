<?php

namespace Database\Seeders;

use App\Models\RumahSakit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RumahSakitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //ini jika tidak punya data
        //RumahSakit::factory(3)->create();


        //ini jika punya data
        $data = [
            [
                'kode_rs' => 'RS001A',
                'nama_rs' => 'Rumah Sakit Sehat Sentosa',
                'alamat' => 'Jl. Merdeka No. 10, Jakarta',
                'kota' => 'Jakarta',
                'provinsi' => 'DKI Jakarta',
                'telepon' => '021-12345678',
                'email' => 'sehatsentosa@gmail.com',
                'status' => 'aktif',
                'tipe_rs' => 'A',
            ],
            [
                'kode_rs' => 'RS001B',
                'nama_rs' => 'Rumah Sakit Sentosa Sehat',
                'alamat' => 'Jl. Merdeka No. 10, Jakarta',
                'kota' => 'Jakarta',
                'provinsi' => 'DKI Jakarta',
                'telepon' => '021-12345678',
                'email' => 'sentosasehat@gmail.com',
                'status' => 'aktif',
                'tipe_rs' => 'B',
            ]
        ];
        foreach ($data as $item) {
            RumahSakit::create($item);
        }
    }
}
