<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Aspirasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'siswa_id',
        'kategori_id',
        'lokasi',
        'keterangan',
        'status'
    ];
    public function siswa()
    {
    return $this->belongsTo(Siswa::class);
    }

    public function kategori()
    {
    return $this->belongsTo(Kategori::class);
    }

    public function tanggapan()
    {
    return $this->hasMany(Tanggapan::class);
    }
}
