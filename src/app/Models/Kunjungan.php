<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kunjungan extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_kunjungan',
        'pasien_id',
        'dokter_id',
        'tanggal_kunjungan',
        'jam_kunjungan',
        'keluhan',
        'diagnosa',
        'tindakan',
        'catatan',
        'biaya_pemeriksaan',
        'biaya_tindakan',
        'total_biaya',
        'status',
    ];

    protected $casts = [
        'tanggal_kunjungan' => 'date',
        'jam_kunjungan' => 'datetime:H:i',
        'biaya_pemeriksaan' => 'decimal:2',
        'biaya_tindakan' => 'decimal:2',
        'total_biaya' => 'decimal:2',
    ];

    public function pasien()
    {
        return $this->belongsTo(Pasien::class);
    }

    public function dokter()
    {
        return $this->belongsTo(Dokter::class);
    }

    public function reseps()
    {
        return $this->hasMany(Resep::class);
    }
}