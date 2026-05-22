<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Pelamar extends Authenticatable
{
    use HasFactory;

    protected $table = 'pelamars';

    protected $fillable = [
        'id_posisi',
        'rumah_sakit_id',
        'nama',
        'username',
        'nik',
        'jenis_kelamin',
        'no_str',
        'jenis_pelamar',
        'email',
        'password',
        'no_ijasah',
        'no_hp',
        'kota_domisili',
        'jenjang',
        'alamat',
        'pengalaman_kerja',
        'keterangan_pengalaman',
        'nomer_peserta',
        'status_pelamar',
        'token',
        'catatan',
        'tempat_lahir',
        'tanggal_lahir',
        'usia',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATION
    |--------------------------------------------------------------------------
    */

    public function posisi()
    {
        return $this->belongsTo(Posisi::class, 'id_posisi');
    }

    public function pengerjaanPelamars()
    {
        return $this->hasMany(PengerjaanPelamar::class, 'id_pelamar');
    }

    public function files()
    {
        return $this->hasMany(PelamarFile::class, 'pelamar_id');
    }
    public function rumahSakit()
    {
        return $this->belongsTo(RumahSakit::class, 'rumah_sakit_id');
    }
}
