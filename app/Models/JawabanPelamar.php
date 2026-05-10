<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JawabanPelamar extends Model
{
    use HasFactory;

    protected $fillable = [
        'pengerjaan_id',
        'soal_id',
        'jawaban',
        'benar',
    ];

    public function pengerjaanPelamar()
    {
        return $this->belongsTo(PengerjaanPelamar::class, 'pengerjaan_id');
    }

    public function soal()
    {
        return $this->belongsTo(Soal::class, 'soal_id');
    }
    public function jawabanPelamars()
    {
        return $this->hasMany(JawabanPelamar::class, 'soal_id');
    }
}
