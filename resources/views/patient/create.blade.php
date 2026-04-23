{{-- resources/views/patient/create.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <i class="fas fa-user-plus"></i> Tambah Data Pasien Baru
    </div>
    <div class="card-body">
        <form action="{{ route('patient.store') }}" method="POST">
            @csrf
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Nama Pasien <span class="text-danger">*</span></label>
                    <input type="text" name="nama_pasien" class="form-control @error('nama_pasien') is-invalid @enderror" required>
                    @error('nama_pasien') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                
                <div class="col-md-3 mb-3">
                    <label class="form-label">Umur (Tahun) <span class="text-danger">*</span></label>
                    <input type="number" name="umur" class="form-control @error('umur') is-invalid @enderror" required>
                    @error('umur') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                
                <div class="col-md-3 mb-3">
                    <label class="form-label">Tanggal Lahir <span class="text-danger">*</span></label>
                    <input type="date" name="tgl_lahir" class="form-control @error('tgl_lahir') is-invalid @enderror" required>
                    @error('tgl_lahir') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-3 mb-3">
                    <label class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
                    <select name="jenis_kelamin" class="form-select @error('jenis_kelamin') is-invalid @enderror" required>
                        <option value="">Pilih</option>
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                    @error('jenis_kelamin') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                
                <div class="col-md-9 mb-3">
                    <label class="form-label">Alamat <span class="text-danger">*</span></label>
                    <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror" rows="2" required></textarea>
                    @error('alamat') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Riwayat Alergi</label>
                    <input type="text" name="riwayat_alergi" class="form-control" placeholder="Contoh: Amoxicillin, udang, dll (kosongkan jika tidak ada)">
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label">Kondisi Khusus</label>
                    <select name="kondisi_khusus" class="form-select">
                        <option value="">Tidak ada kondisi khusus</option>
                        <option value="Hamil">Hamil</option>
                        <option value="Lansia">Lansia (≥60 tahun)</option>
                        <option value="Anak">Anak (≤12 tahun)</option>
                        <option value="Penyakit Kronis">Penyakit Kronis</option>
                        <option value="Gangguan Ginjal">Gangguan Ginjal</option>
                        <option value="Gangguan Hati">Gangguan Hati</option>
                    </select>
                </div>
            </div>
            
            <hr>
            
            <div class="text-center">
                <button type="submit" class="btn btn-success px-5">
                    <i class="fas fa-save"></i> Simpan Data Pasien
                </button>
                <a href="{{ route('patient.index') }}" class="btn btn-secondary px-5">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection