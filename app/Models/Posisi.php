<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posisi extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_rs',
        'nama_posisi',
        'deskripsi_posisi',
        'tanggal_ditutup',
        'kode_pelamar'
    ];

    public function kuis()
    {
        return $this->hasMany(Kuis::class, 'posisi_id');
    }
    public function pelamars()
    {
        return $this->hasMany(Pelamar::class, 'id_posisi');
    }
    public function rumahSakit()
    {
        return $this->belongsTo(RumahSakit::class, 'id_rs');
    }
}
