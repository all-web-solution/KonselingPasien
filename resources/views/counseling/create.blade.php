{{-- resources/views/counseling/create.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <i class="fas fa-stethoscope"></i> Tambah Konseling Baru
    </div>
    <div class="card-body">
        <form action="{{ route('counseling.store') }}" method="POST">
            @csrf
            
            <div class="alert alert-info" style="background: #e8f5e9; border: none; border-radius: 12px;">
                <i class="fas fa-info-circle"></i> <strong>Info:</strong> Pilih pasien yang sudah terdaftar. 
                <a href="{{ route('patient.create') }}" class="text-success">Klik disini</a> untuk tambah pasien baru.
            </div>
            
            <!-- Pilih Pasien yang udah ada -->
            <div class="mb-4">
                <label class="form-label">Pilih Pasien <span class="text-danger">*</span></label>
                <select name="patient_id" class="form-select @error('patient_id') is-invalid @enderror" required>
                    <option value="">-- Pilih Pasien --</option>
                    @foreach($patients as $patient)
                    <option value="{{ $patient->id }}">
                        {{ $patient->nama_pasien }} ({{ $patient->umur }} thn, {{ $patient->jenis_kelamin }}) 
                        @if($patient->kondisi_khusus) - {{ $patient->kondisi_khusus }} @endif
                    </option>
                    @endforeach
                </select>
                @error('patient_id') <small class="text-danger">{{ $message }}</small> @enderror
                <small class="text-muted">Data diri dan riwayat alergi pasien sudah otomatis terbaca dari data master</small>
            </div>
            
            <hr>
            
            <h5 class="section-title mb-3"><i class="fas fa-prescription-bottle"></i> Data Resep & Diagnosa</h5>
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Nama Dokter <span class="text-danger">*</span></label>
                    <input type="text" name="nama_dokter" class="form-control @error('nama_dokter') is-invalid @enderror" required>
                    @error('nama_dokter') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label">Nama Obat <span class="text-danger">*</span></label>
                    <input type="text" name="nama_obat" class="form-control @error('nama_obat') is-invalid @enderror" required>
                    @error('nama_obat') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">Dosis & Aturan Pakai <span class="text-danger">*</span></label>
                    <input type="text" name="dosis_dan_aturan_pakai" class="form-control @error('dosis_dan_aturan_pakai') is-invalid @enderror" placeholder="Contoh: 3x1 tablet" required>
                    @error('dosis_dan_aturan_pakai') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                
                <div class="col-md-4 mb-3">
                    <label class="form-label">Jumlah Obat <span class="text-danger">*</span></label>
                    <input type="number" name="jumlah_obat" class="form-control @error('jumlah_obat') is-invalid @enderror" required>
                    @error('jumlah_obat') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                
                <div class="col-md-4 mb-3">
                    <label class="form-label">Lama Terapi <span class="text-danger">*</span></label>
                    <input type="text" name="lama_terapi" class="form-control @error('lama_terapi') is-invalid @enderror" placeholder="Contoh: 7 hari / 3 bulan" required>
                    @error('lama_terapi') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Diagnosa <span class="text-danger">*</span></label>
                <input type="text" name="diagnosa" class="form-control @error('diagnosa') is-invalid @enderror" required>
                @error('diagnosa') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            
            <hr>
            
            <h5 class="section-title mb-3"><i class="fas fa-headset"></i> Data Konseling</h5>
            
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">Tanggal Konseling <span class="text-danger">*</span></label>
                    <input type="date" name="tanggal_konseling" class="form-control @error('tanggal_konseling') is-invalid @enderror" value="{{ date('Y-m-d') }}" required>
                    @error('tanggal_konseling') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                
                <div class="col-md-4 mb-3">
                    <label class="form-label">Nama Apotek <span class="text-danger">*</span></label>
                    <input type="text" name="nama_apotek" class="form-control @error('nama_apotek') is-invalid @enderror" required>
                    @error('nama_apotek') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                
                <div class="col-md-4 mb-3">
                    <label class="form-label">Metode Konseling <span class="text-danger">*</span></label>
                    <select name="metode_konseling" class="form-select @error('metode_konseling') is-invalid @enderror" required>
                        <option value="langsung">Langsung (Tatap Muka)</option>
                        <option value="via telp">Via Telepon</option>
                    </select>
                    @error('metode_konseling') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Materi yang Disampaikan <span class="text-danger">*</span></label>
                <textarea name="materi_yang_disampaikan" class="form-control @error('materi_yang_disampaikan') is-invalid @enderror" rows="3" required></textarea>
                @error('materi_yang_disampaikan') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Cara Penggunaan Obat <span class="text-danger">*</span></label>
                    <textarea name="cara_penggunaan_obat" class="form-control @error('cara_penggunaan_obat') is-invalid @enderror" rows="2" placeholder="Contoh: Diminum sesudah makan" required></textarea>
                    @error('cara_penggunaan_obat') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label">Waktu Minum Obat <span class="text-danger">*</span></label>
                    <textarea name="waktu_minum_obat" class="form-control @error('waktu_minum_obat') is-invalid @enderror" rows="2" placeholder="Contoh: Pagi, Siang, Malam / Sesuai kebutuhan" required></textarea>
                    @error('waktu_minum_obat') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Interaksi Obat/Makanan <span class="text-danger">*</span></label>
                    <textarea name="interaksi_obat_makanan" class="form-control @error('interaksi_obat_makanan') is-invalid @enderror" rows="2" placeholder="Contoh: Hindari konsumsi dengan susu / alkohol" required></textarea>
                    @error('interaksi_obat_makanan') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label">Penyimpanan Obat <span class="text-danger">*</span></label>
                    <textarea name="penyimpanan_obat" class="form-control @error('penyimpanan_obat') is-invalid @enderror" rows="2" placeholder="Contoh: Simpan di tempat sejuk dan kering, hindari sinar matahari" required></textarea>
                    @error('penyimpanan_obat') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
            </div>
            
    
            <div class="mb-3">
                    <label class="form-label">Kepatuhan Minum Obat <span class="text-danger">*</span></label>
                    <textarea name="kepatuhan_minum_obat" class="form-control @error('kepatuhan_minum_obat') is-invalid @enderror" rows="2" placeholder="Contoh: Simpan di tempat sejuk dan kering, hindari sinar matahari" required></textarea>
                    @error('kepatuhan_minum_obat') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
            
            <hr>
            
            <div class="text-center">
                <button type="submit" class="btn btn-success px-5">
                    <i class="fas fa-save"></i> Simpan Konseling
                </button>
                <a href="{{ route('counseling.index') }}" class="btn btn-secondary px-5">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection