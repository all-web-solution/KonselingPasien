@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h4>Edit Data Pasien</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('patient.update', $patient->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label>Nama Pasien</label>
                    <input type="text" name="nama_pasien" class="form-control" value="{{ $patient->nama_pasien }}" required>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Umur</label>
                        <input type="number" name="umur" class="form-control" value="{{ $patient->umur }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Tanggal Lahir</label>
                        <input type="date" name="tgl_lahir" class="form-control" value="{{ $patient->tgl_lahir }}" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label>Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="form-control" required>
                        <option value="Laki-laki" {{ $patient->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="Perempuan" {{ $patient->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label>Alamat</label>
                    <textarea name="alamat" class="form-control" rows="3" required>{{ $patient->alamat }}</textarea>
                </div>

                <div class="mb-3">
                    <label>Riwayat Alergi</label>
                    <input type="text" name="riwayat_alergi" class="form-control" value="{{ $patient->riwayat_alergi }}">
                </div>

                <div class="mb-3">
                    <label>Kondisi Khusus</label>
                    <input type="text" name="kondisi_khusus" class="form-control" value="{{ $patient->kondisi_khusus }}">
                </div>

                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="{{ route('patient.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection