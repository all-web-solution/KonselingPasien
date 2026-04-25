@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span><i class="fas fa-users"></i> Data Master Pasien</span>
        
    </div>
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-4 no-print">
            <h5 class="section-title">
                <i class="fas fa-database"></i> Daftar Semua Pasien
            </h5>
            <div class="d-flex gap-2">
                <form action="{{ route('patient.index') }}" method="GET" class="d-flex">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Cari nama/alamat..." value="{{ request('search') }}">
                        <button class="btn btn-primary" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                    @if(request('search'))
                        <a href="{{ route('patient.index') }}" class="btn btn-secondary ms-1">Reset</a>
                    @endif
                </form>
                <button onclick="window.print()" class="btn btn-sm btn-warning no-print">
                    <i class="fas fa-print"></i> Cetak Laporan
                </button>
                <a href="{{ route('patient.create') }}" class="btn btn-success">
                    <i class="fas fa-plus"></i> Tambah Pasien
                </a>
                
            </div>
        </div>

        <div class="d-none d-print-block text-center mb-4">
            <h4>LAPORAN DATA PASIEN</h4>
            <h5>Apotek Sehat</h5>
            <hr>
        </div>
        
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Pasien</th>
                        <th>Umur</th>
                        <th>Jenis Kelamin</th>
                        <th>Alamat</th>
                        <th>Riwayat Alergi</th>
                        <th class="no-print">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($patients as $index => $patient)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td><strong>{{ $patient->nama_pasien }}</strong><br>
                            <small class="text-muted">Lahir: {{ date('d/m/Y', strtotime($patient->tgl_lahir)) }}</small>
                        </td>
                        <td>{{ $patient->umur }} tahun</td>
                        <td>{{ $patient->jenis_kelamin }}</td>
                        <td>{{ $patient->alamat }}</td>
                        <td>{{ $patient->riwayat_alergi ?: '-' }}</td>
                        <td class="no-print">
                            <a href="{{ route('patient.edit', $patient->id) }}" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('patient.destroy', $patient->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus pasien ini?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-4">
                            <i class="fas fa-user-slash fa-3x text-muted mb-3 d-block"></i>
                            Data tidak ditemukan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection