{{-- resources/views/counseling/edit.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <i class="fas fa-edit"></i> Edit Konseling
    </div>
    <div class="card-body">
        <form action="{{ route('counseling.update', $counseling->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="alert alert-info" style="background: #e8f5e9; border: none; border-radius: 12px;">
                <i class="fas fa-info-circle"></i> <strong>Info:</strong> Data pasien tidak bisa diubah di sini. 
                <a href="{{ route('patient.edit', $counseling->patient_id) }}" class="text-success">Klik disini</a> untuk edit data pasien.
            </div>
            
            <!-- Data Pasien (Readonly) -->
            <h5 class="section-title mb-3"><i class="fas fa-user-circle"></i> Data Pasien (Readonly)</h5>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">Nama Pasien</label>
                    <input type="text" class="form-control" value="{{ $counseling->patient->nama_pasien }}" readonly>
                </div>
                <div class="col-md-2 mb-3">
                    <label class="form-label">Umur</label>
                    <input type="text" class="form-control" value="{{ $counseling->patient->umur }} tahun" readonly>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Jenis Kelamin</label>
                    <input type="text" class="form-control" value="{{ $counseling->patient->jenis_kelamin }}" readonly>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Kondisi Khusus</label>
                    <input type="text" class="form-control" value="{{ $counseling->patient->kondisi_khusus ?: '-' }}" readonly>
                </div>
            </div>
            
            <hr>
            
            <!-- Data Resep -->
            <h5 class="section-title mb-3"><i class="fas fa-prescription-bottle"></i> Data Resep & Diagnosa</h5>
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Nama Dokter <span class="text-danger">*</span></label>
                    <input type="text" name="nama_dokter" class="form-control @error('nama_dokter') is-invalid @enderror" value="{{ old('nama_dokter', $counseling->nama_dokter) }}" required>
                    @error('nama_dokter') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label">Nama Obat <span class="text-danger">*</span></label>
                    <input type="text" name="nama_obat" class="form-control @error('nama_obat') is-invalid @enderror" value="{{ old('nama_obat', $counseling->nama_obat) }}" required>
                    @error('nama_obat') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">Dosis & Aturan Pakai <span class="text-danger">*</span></label>
                    <input type="text" name="dosis_dan_aturan_pakai" class="form-control @error('dosis_dan_aturan_pakai') is-invalid @enderror" value="{{ old('dosis_dan_aturan_pakai', $counseling->dosis_dan_aturan_pakai) }}" required>
                    @error('dosis_dan_aturan_pakai') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                
                <div class="col-md-4 mb-3">
                    <label class="form-label">Jumlah Obat <span class="text-danger">*</span></label>
                    <input type="number" name="jumlah_obat" class="form-control @error('jumlah_obat') is-invalid @enderror" value="{{ old('jumlah_obat', $counseling->jumlah_obat) }}" required>
                    @error('jumlah_obat') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                
                <div class="col-md-4 mb-3">
                    <label class="form-label">Lama Terapi <span class="text-danger">*</span></label>
                    <input type="text" name="lama_terapi" class="form-control @error('lama_terapi') is-invalid @enderror" value="{{ old('lama_terapi', $counseling->lama_terapi) }}" required>
                    @error('lama_terapi') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Diagnosa <span class="text-danger">*</span></label>
                <input type="text" name="diagnosa" class="form-control @error('diagnosa') is-invalid @enderror" value="{{ old('diagnosa', $counseling->diagnosa) }}" required>
                @error('diagnosa') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            
            <hr>
            
            <!-- Data Konseling -->
            <h5 class="section-title mb-3"><i class="fas fa-headset"></i> Data Konseling</h5>
            
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">Tanggal Konseling <span class="text-danger">*</span></label>
                    <input type="date" name="tanggal_konseling" class="form-control @error('tanggal_konseling') is-invalid @enderror" value="{{ old('tanggal_konseling', $counseling->tanggal_konseling) }}" required>
                    @error('tanggal_konseling') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                
                <div class="col-md-4 mb-3">
                    <label class="form-label">Nama Apotek <span class="text-danger">*</span></label>
                    <input type="text" name="nama_apotek" class="form-control @error('nama_apotek') is-invalid @enderror" value="{{ old('nama_apotek', $counseling->nama_apotek) }}" required>
                    @error('nama_apotek') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                
                <div class="col-md-4 mb-3">
                    <label class="form-label">Metode Konseling <span class="text-danger">*</span></label>
                    <select name="metode_konseling" class="form-select @error('metode_konseling') is-invalid @enderror" required>
                        <option value="langsung" {{ $counseling->metode_konseling == 'langsung' ? 'selected' : '' }}>Langsung (Tatap Muka)</option>
                        <option value="via telp" {{ $counseling->metode_konseling == 'via telp' ? 'selected' : '' }}>Via Telepon</option>
                    </select>
                    @error('metode_konseling') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Materi yang Disampaikan <span class="text-danger">*</span></label>
                <textarea name="materi_yang_disampaikan" class="form-control @error('materi_yang_disampaikan') is-invalid @enderror" rows="3" required>{{ old('materi_yang_disampaikan', $counseling->materi_yang_disampaikan) }}</textarea>
                @error('materi_yang_disampaikan') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Cara Penggunaan Obat <span class="text-danger">*</span></label>
                    <textarea name="cara_penggunaan_obat" class="form-control @error('cara_penggunaan_obat') is-invalid @enderror" rows="2" required>{{ old('cara_penggunaan_obat', $counseling->cara_penggunaan_obat) }}</textarea>
                    @error('cara_penggunaan_obat') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label">Waktu Minum Obat <span class="text-danger">*</span></label>
                    <textarea name="waktu_minum_obat" class="form-control @error('waktu_minum_obat') is-invalid @enderror" rows="2" required>{{ old('waktu_minum_obat', $counseling->waktu_minum_obat) }}</textarea>
                    @error('waktu_minum_obat') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Interaksi Obat/Makanan <span class="text-danger">*</span></label>
                    <textarea name="interaksi_obat_makanan" class="form-control @error('interaksi_obat_makanan') is-invalid @enderror" rows="2" required>{{ old('interaksi_obat_makanan', $counseling->interaksi_obat_makanan) }}</textarea>
                    @error('interaksi_obat_makanan') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label">Penyimpanan Obat <span class="text-danger">*</span></label>
                    <textarea name="penyimpanan_obat" class="form-control @error('penyimpanan_obat') is-invalid @enderror" rows="2" required>{{ old('penyimpanan_obat', $counseling->penyimpanan_obat) }}</textarea>
                    @error('penyimpanan_obat') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Kepatuhan Minum Obat <span class="text-danger">*</span></label>
                <select name="kepatuhan_minum_obat" class="form-select @error('kepatuhan_minum_obat') is-invalid @enderror" required>
                    <option value="Baik" {{ $counseling->kepatuhan_minum_obat == 'Baik' ? 'selected' : '' }}>Baik - Patuh minum obat sesuai aturan</option>
                    <option value="Cukup" {{ $counseling->kepatuhan_minum_obat == 'Cukup' ? 'selected' : '' }}>Cukup - Kadang lupa tapi masih wajar</option>
                    <option value="Kurang" {{ $counseling->kepatuhan_minum_obat == 'Kurang' ? 'selected' : '' }}>Kurang - Sering lupa / tidak patuh</option>
                </select>
                @error('kepatuhan_minum_obat') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            
            <hr>
            
            <div class="text-center">
                <button type="submit" class="btn btn-success px-5">
                    <i class="fas fa-save"></i> Update Konseling
                </button>
                <a href="{{ route('counseling.index') }}" class="btn btn-secondary px-5">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection