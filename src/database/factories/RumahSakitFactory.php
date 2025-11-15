<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RumahSakitFactory extends Factory
{
    public function definition() : array
    {
        $cities = ['Jakarta', 'Bandung', 'Surabaya'];
        $provinces = ['DKI Jakarta', 'Jawa Barat', 'Jawa Timur'];
        return [
            'kode_rs' => strtoupper($this->faker->bothify('RS###??')),
            'nama_rs' => $this->faker->company() . ' Hospital',
            'alamat' => $this->faker->address(),
            'kota' => $this->faker->randomElement($cities),
            'provinsi' => $this->faker->randomElement($provinces),
            'telepon' => $this->faker->phoneNumber(),
            'email' => $this->faker->unique()->safeEmail(),
            'status' => $this->faker->randomElement(['aktif', 'nonaktif']),
            'tipe_rs' => $this->faker->randomElement(['A', 'B', 'C']),
        ];
    }
}
