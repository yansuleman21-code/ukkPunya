<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kategori extends Model
{
    use HasFactory;
    protected $fillable = ['ket_kategori'];
    public function aspirasi()
    {
    return $this->hasMany(Aspirasi::class);
    }
}
