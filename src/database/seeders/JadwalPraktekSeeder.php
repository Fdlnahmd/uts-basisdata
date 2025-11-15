<?php

namespace Database\Seeders;

use App\Models\JadwalPraktek;
use Illuminate\Database\Seeder;

class JadwalPraktekSeeder extends Seeder
{
    public function run(): void
    {
        $jadwals = [
            // Dr. Ahmad Fauzi
            ['dokter_id' => 1, 'hari' => 'Senin', 'jam_mulai' => '08:00', 'jam_selesai' => '12:00', 'kuota_pasien' => 20, 'ruangan' => 'Poli 1'],
            ['dokter_id' => 1, 'hari' => 'Rabu', 'jam_mulai' => '08:00', 'jam_selesai' => '12:00', 'kuota_pasien' => 20, 'ruangan' => 'Poli 1'],
            ['dokter_id' => 1, 'hari' => 'Jumat', 'jam_mulai' => '08:00', 'jam_selesai' => '12:00', 'kuota_pasien' => 20, 'ruangan' => 'Poli 1'],
            
            // Dr. Siti Nurhaliza
            ['dokter_id' => 2, 'hari' => 'Selasa', 'jam_mulai' => '09:00', 'jam_selesai' => '13:00', 'kuota_pasien' => 25, 'ruangan' => 'Poli 2'],
            ['dokter_id' => 2, 'hari' => 'Kamis', 'jam_mulai' => '09:00', 'jam_selesai' => '13:00', 'kuota_pasien' => 25, 'ruangan' => 'Poli 2'],
            ['dokter_id' => 2, 'hari' => 'Sabtu', 'jam_mulai' => '09:00', 'jam_selesai' => '12:00', 'kuota_pasien' => 15, 'ruangan' => 'Poli 2'],
            
            // Dr. Budi Santoso
            ['dokter_id' => 3, 'hari' => 'Senin', 'jam_mulai' => '13:00', 'jam_selesai' => '17:00', 'kuota_pasien' => 15, 'ruangan' => 'Poli 3'],
            ['dokter_id' => 3, 'hari' => 'Rabu', 'jam_mulai' => '13:00', 'jam_selesai' => '17:00', 'kuota_pasien' => 15, 'ruangan' => 'Poli 3'],
            ['dokter_id' => 3, 'hari' => 'Jumat', 'jam_mulai' => '13:00', 'jam_selesai' => '17:00', 'kuota_pasien' => 15, 'ruangan' => 'Poli 3'],
            
            // Dr. Rina Wijaya
            ['dokter_id' => 4, 'hari' => 'Selasa', 'jam_mulai' => '14:00', 'jam_selesai' => '18:00', 'kuota_pasien' => 18, 'ruangan' => 'Poli 4'],
            ['dokter_id' => 4, 'hari' => 'Kamis', 'jam_mulai' => '14:00', 'jam_selesai' => '18:00', 'kuota_pasien' => 18, 'ruangan' => 'Poli 4'],
            
            // Dr. Hendra Gunawan
            ['dokter_id' => 5, 'hari' => 'Senin', 'jam_mulai' => '10:00', 'jam_selesai' => '14:00', 'kuota_pasien' => 12, 'ruangan' => 'Poli 5'],
            ['dokter_id' => 5, 'hari' => 'Rabu', 'jam_mulai' => '10:00', 'jam_selesai' => '14:00', 'kuota_pasien' => 12, 'ruangan' => 'Poli 5'],
            ['dokter_id' => 5, 'hari' => 'Jumat', 'jam_mulai' => '10:00', 'jam_selesai' => '14:00', 'kuota_pasien' => 12, 'ruangan' => 'Poli 5'],
        ];

        foreach ($jadwals as $jadwal) {
            JadwalPraktek::create($jadwal);
        }
    }
}

