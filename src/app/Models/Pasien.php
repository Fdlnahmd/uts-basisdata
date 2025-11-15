<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_rm',
        'nik',
        'nama',
        'jenis_kelamin',
        'tanggal_lahir',
        'tempat_lahir',
        'golongan_darah',
        'telepon',
        'email',
        'alamat',
        'pekerjaan',
        'nama_wali',
        'telepon_wali',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
    ];

    public function kunjungans()
    {
        return $this->hasMany(Kunjungan::class);
    }

    public function reseps()
    {
        return $this->hasMany(Resep::class);
    }

    public function getUmurAttribute()
    {
        return $this->tanggal_lahir->age;
    }
}