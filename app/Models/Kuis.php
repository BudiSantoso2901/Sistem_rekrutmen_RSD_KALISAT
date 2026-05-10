<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kuis extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_kuis',
        'waktu',
        'deskripsi',
        'dibuat_oleh',
        'posisi_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'dibuat_oleh');
    }

    public function posisi()
    {
        return $this->belongsTo(Posisi::class, 'posisi_id');
    }

    public function soals()
    {
        return $this->hasMany(Soal::class, 'id_kuis');
    }

    public function pengerjaanPelamars()
    {
        return $this->hasMany(PengerjaanPelamar::class, 'id_kuis');
    }
}
