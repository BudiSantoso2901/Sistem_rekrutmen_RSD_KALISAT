<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PelamarFile extends Model
{
    use HasFactory;

    protected $fillable = [
        'pelamar_id',
        'jenis_file',
        'file_path',
    ];

    public function pelamar()
    {
        return $this->belongsTo(Pelamar::class, 'pelamar_id');
    }
    public function getUrlAttribute()
    {
        return asset('storage/' . $this->file_path);
    }
}
