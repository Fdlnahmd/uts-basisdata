<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_dokter',
        'nama',
        'jenis_kelamin',
        'spesialisasi',
        'no_sip',
        'telepon',
        'email',
        'alamat',
        'foto',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function jadwalPrakteks()
    {
        return $this->hasMany(JadwalPraktek::class);
    }

    public function kunjungans()
    {
        return $this->hasMany(Kunjungan::class);
    }

    public function reseps()
    {
        return $this->hasMany(Resep::class);
    }
}
