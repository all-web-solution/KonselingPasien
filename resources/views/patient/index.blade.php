{{-- resources/views/patient/index.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <i class="fas fa-users"></i> Data Master Pasien
    </div>
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="section-title">
                <i class="fas fa-database"></i> Daftar Semua Pasien
            </h5>
            <a href="{{ route('patient.create') }}" class="btn btn-success">
                <i class="fas fa-plus"></i> Tambah Pasien Baru
            </a>
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
                        <th>Kondisi Khusus</th>
                        <th>Aksi</th>
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
                        <td>{{ \Illuminate\Support\Str::limit($patient->alamat, 30) }}</td>
                        <td>{{ $patient->riwayat_alergi ?: '-' }}</td>
                        <td>{{ $patient->kondisi_khusus ?: '-' }}</td>
                        <td>
                            <a href="{{ route('patient.edit', $patient->id) }}" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('patient.destroy', $patient->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus pasien ini? Semua riwayat konseling juga akan hilang!')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center py-4">
                            <i class="fas fa-user-slash fa-3x text-muted mb-3 d-block"></i>
                            Belum ada data pasien. <a href="{{ route('patient.create') }}">Tambahkan sekarang</a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection