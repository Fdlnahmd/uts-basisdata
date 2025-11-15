<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Poliklinik extends Model
{
    use HasFactory;

    protected $fillable = [
        'rumah_sakit_id',
        'kode_poliklinik',
        'nama_poliklinik',
        'lantai',
        'gedung',
        'status',
    ];

    // Relasi: Poliklinik belong to Rumah Sakit
    public function rumahSakit(): BelongsTo
    {
        return $this->belongsTo(RumahSakit::class);
    }
}