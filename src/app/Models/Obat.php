<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Obat extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_obat',
        'nama_obat',
        'kategori',
        'satuan',
        'stok',
        'stok_minimum',
        'harga_beli',
        'harga_jual',
        'tanggal_kadaluarsa',
        'produsen',
        'deskripsi',
        'is_active',
    ];

    protected $casts = [
        'tanggal_kadaluarsa' => 'date',
        'harga_beli' => 'decimal:2',
        'harga_jual' => 'decimal:2',
        'is_active' => 'boolean',
    ];


}
