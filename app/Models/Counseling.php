<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Counseling extends Model
{
    protected $fillable = [
        'patient_id',
        'nama_dokter',
        'nama_obat',
        'obat_dan_aturan_pakai',
        // 'dosis_dan_aturan_pakai',
        // 'jumlah_obat',
        // 'lama_terapi',
        'diagnosa',
        'tanggal_konseling',
        'nama_apotek',
        'metode_konseling',
        'materi_yang_disampaikan',
        'cara_penggunaan_obat',
        'waktu_minum_obat',
        'interaksi_obat_makanan',
        'penyimpanan_obat',
        'kepatuhan_minum_obat'
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
