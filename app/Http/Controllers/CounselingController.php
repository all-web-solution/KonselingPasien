<?php

namespace App\Http\Controllers;

use App\Models\Counseling;
use App\Models\Patient;
use Illuminate\Http\Request;

class CounselingController extends Controller
{
    // app/Http/Controllers/CounselingController.php - update method index
    public function index(Request $request)
    {
        $query = Counseling::with('patient');

        // Filter search by nama pasien
        if ($request->search) {
            $query->whereHas('patient', function ($q) use ($request) {
                $q->where('nama_pasien', 'like', '%' . $request->search . '%');
            });
        }

        // Filter tanggal
        if ($request->start_date) {
            $query->whereDate('tanggal_konseling', '>=', $request->start_date);
        }
        if ($request->end_date) {
            $query->whereDate('tanggal_konseling', '<=', $request->end_date);
        }

        // Filter metode
        if ($request->metode) {
            $query->where('metode_konseling', $request->metode);
        }

        $counselings = $query->orderBy('tanggal_konseling', 'desc')->paginate(10);

        return view('counseling.index', compact('counselings'));
    }
    public function create()
    {
        $patients = Patient::orderBy('nama_pasien')->get();
        return view('counseling.create', compact('patients'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'nama_dokter' => 'required',
            'nama_obat' => 'required',
            'dosis_dan_aturan_pakai' => 'required',
            'jumlah_obat' => 'required|numeric',
            'lama_terapi' => 'required',
            'diagnosa' => 'required',
            'tanggal_konseling' => 'required|date',
            'nama_apotek' => 'required',
            'metode_konseling' => 'required',
            'materi_yang_disampaikan' => 'required',
            'cara_penggunaan_obat' => 'required',
            'waktu_minum_obat' => 'required',
            'interaksi_obat_makanan' => 'required',
            'penyimpanan_obat' => 'required',
            'kepatuhan_minum_obat' => 'required',
        ]);

        Counseling::create($request->all());

        return redirect()->route('counseling.index')->with('success', 'Data konseling berhasil disimpan!');
    }

    public function show($id)
    {
        $counseling = Counseling::with('patient')->findOrFail($id);
        return view('counseling.show', compact('counseling'));
    }

    public function edit($id)
    {
        $counseling = Counseling::with('patient')->findOrFail($id);
        $patients = Patient::orderBy('nama_pasien')->get();
        return view('counseling.edit', compact('counseling', 'patients'));
    }

    public function update(Request $request, $id)
    {
        $counseling = Counseling::findOrFail($id);
        $counseling->update($request->all());

        return redirect()->route('counseling.index')->with('success', 'Data konseling berhasil diupdate!');
    }

    public function destroy($id)
    {
        Counseling::findOrFail($id)->delete();
        return redirect()->route('counseling.index')->with('success', 'Data konseling berhasil dihapus!');
    }
}
