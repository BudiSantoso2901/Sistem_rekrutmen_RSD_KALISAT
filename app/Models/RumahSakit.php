<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RumahSakit extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_rs',
        'kode_rs',
    ];

    // =========================
    // RELATION
    // =========================

    public function pelamars()
    {
        return $this->hasMany(Pelamar::class);
    }
    public function posisis()
    {
        return $this->hasMany(Posisi::class, 'id_rs');
    }
}
