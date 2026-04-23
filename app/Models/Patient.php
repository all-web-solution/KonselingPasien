<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $fillable = [
        'nama_pasien',
        'umur',
        'tgl_lahir',
        'jenis_kelamin',
        'alamat',
        'riwayat_alergi',
        'kondisi_khusus'
    ];

    public function counselings()
    {
        return $this->hasMany(Counseling::class);
    }
}
