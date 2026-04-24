<?php

namespace Database\Seeders;

use App\Models\Patient;
use Illuminate\Database\Seeder;

class PatientSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'nama_pasien' => 'Ahmad Yusuf',
                'umur' => 21,
                'tgl_lahir' => '2003-05-10',
                'jenis_kelamin' => 'Laki-laki',
                'alamat' => 'Yogyakarta',
                'riwayat_alergi' => 'Paracetamol',
                'kondisi_khusus' => 'Tidak ada'
            ],
            [
                'nama_pasien' => 'Suci Ramadhani',
                'umur' => 20,
                'tgl_lahir' => '2004-01-15',
                'jenis_kelamin' => 'Perempuan',
                'alamat' => 'Sleman',
                'riwayat_alergi' => '-',
                'kondisi_khusus' => 'Asma'
            ],
        ];

        foreach ($data as $item) {
            Patient::create($item);
        }
    }
}