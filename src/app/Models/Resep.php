<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resep extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_resep',
        'kunjungan_id',
        'dokter_id',
        'pasien_id',
        'obat_id',
        'jumlah',
        'aturan_pakai',
        'harga_satuan',
        'subtotal',
        'tanggal_resep',
        'status',
        'catatan',
    ];

    protected $casts = [
        'tanggal_resep' => 'date',
        'harga_satuan' => 'decimal:2',
        'subtotal' => 'decimal:2',
    ];

    public function kunjungan()
    {
        return $this->belongsTo(Kunjungan::class);
    }

    public function dokter()
    {
        return $this->belongsTo(Dokter::class);
    }

    public function pasien()
    {
        return $this->belongsTo(Pasien::class);
    }

    public function obat()
    {
        return $this->belongsTo(Obat::class);
    }
}