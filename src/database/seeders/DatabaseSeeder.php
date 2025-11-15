<?php

namespace Database\Seeders;

use App\Models\RumahSakit;
use App\Models\Poliklinik;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            RumahSakitSeeder::class,
             PoliklinikSeeder::class,
             DokterSeeder::class,
             PasienSeeder::class,
             ObatSeeder::class,
             JadwalPraktekSeeder::class,
             KunjunganSeeder::class,
             ResepSeeder::class,
        ]);
    }
}
