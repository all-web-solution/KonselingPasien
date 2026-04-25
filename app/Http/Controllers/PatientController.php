<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function index(Request $request)
    {
        // Mengambil kata kunci dari input bernama 'search'
        $search = $request->input('search');

        // Query dasar
        $query = Patient::query();

        // Jika ada kata kunci, lakukan filter berdasarkan nama atau alamat
        if ($search) {
            $query->where('nama_pasien', 'LIKE', "%{$search}%")
                ->orWhere('alamat', 'LIKE', "%{$search}%");
        }

        // Urutkan berdasarkan yang terbaru dan ambil datanya
        $patients = $query->latest()->get();

        return view('patient.index', compact('patients'));
    }

    public function create()
    {
        return view('patient.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pasien' => 'required',
            'umur' => 'required|numeric',
            'tgl_lahir' => 'required|date',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
        ]);

        Patient::create($request->all());

        return redirect()->route('patient.index')->with('success', 'Data pasien berhasil disimpan!');
    }

    public function edit($id)
    {
        $patient = Patient::findOrFail($id);
        return view('patient.edit', compact('patient'));
    }


    public function update(Request $request, $id)
    {
        // 1. Validasi data terlebih dahulu
        $validatedData = $request->validate([
            'nama_pasien'   => 'required|string|max:255',
            'umur'          => 'required|numeric',
            'tgl_lahir'     => 'required|date',
            'jenis_kelamin' => 'required',
            'alamat'        => 'required',
            'riwayat_alergi'=> 'nullable', // Boleh kosong
            'kondisi_khusus'=> 'nullable', // Boleh kosong
        ]);

        // 2. Cari data pasien
        $patient = Patient::findOrFail($id);

        // 3. Update menggunakan data yang sudah tervalidasi
        $patient->update($validatedData);

        // 4. Redirect dengan pesan sukses
        return redirect()->route('patient.index')
                        ->with('success', 'Data pasien berhasil diupdate!');
    }

    public function destroy($id)
    {
        Patient::findOrFail($id)->delete();
        return redirect()->route('patient.index')->with('success', 'Data pasien berhasil dihapus!');
    }

    public function cetakPdf()
    {
        // Ambil semua data pasien
        $patients = Patient::orderBy('nama_pasien')->get();

        // Load view khusus untuk PDF dengan membawa data pasien
        $pdf = Pdf::loadView('patient.pdf', compact('patients'));

        // stream() agar PDF terbuka di tab baru. Gunakan download() jika ingin langsung terunduh.
        return $pdf->stream('Laporan_Data_Pasien.pdf');
    }
}
