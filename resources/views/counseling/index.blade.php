{{-- resources/views/counseling/index.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <i class="fas fa-history"></i> Riwayat Konseling Pasien
    </div>
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
            <h5 class="section-title">
                <i class="fas fa-list-alt"></i> Daftar Semua Konseling
            </h5>
            <div class="d-flex gap-2">
                <button onclick="printPage()" class="btn btn-outline-success">
                    <i class="fas fa-print"></i> Cetak
                </button>
                <a href="{{ route('counseling.create') }}" class="btn btn-success">
                    <i class="fas fa-plus"></i> Konseling Baru
                </a>
            </div>
        </div>
        
        <!-- Filter Form -->
        <div class="filter-card">
            <form method="GET" action="{{ route('counseling.index') }}" class="row g-3">
                <div class="col-md-3">
                    <label class="form-label">Cari Nama Pasien</label>
                    <input type="text" name="search" class="form-control" placeholder="Nama pasien..." value="{{ request('search') }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Tanggal Mulai</label>
                    <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Tanggal Sampai</label>
                    <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Metode Konseling</label>
                    <select name="metode" class="form-select">
                        <option value="">Semua</option>
                        <option value="langsung" {{ request('metode') == 'langsung' ? 'selected' : '' }}>Langsung</option>
                        <option value="via telp" {{ request('metode') == 'via telp' ? 'selected' : '' }}>Via Telepon</option>
                    </select>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-search"></i> Filter
                    </button>
                    <a href="{{ route('counseling.index') }}" class="btn btn-secondary">
                        <i class="fas fa-undo"></i> Reset
                    </a>
                </div>
            </form>
        </div>
        
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Pasien</th>
                        <th>Umur</th>
                        <th>Diagnosa</th>
                        <th>Obat</th>
                        <th>Dokter</th>
                        <th>Metode</th>
                        <th>Kepatuhan</th>
                        <th class="aksi-column">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($counselings as $index => $item)
                    <tr>
                        <td>{{ $counselings->firstItem() + $index }}</td>
                        <td>{{ date('d/m/Y', strtotime($item->tanggal_konseling)) }}</td>
                        <td>
                            <strong>{{ $item->patient->nama_pasien }}</strong>
                        </td>
                        <td>{{ $item->patient->umur }} thn</td>
                        <td>{{ \Illuminate\Support\Str::limit($item->diagnosa, 25) }}</td>
                        <td>{{ \Illuminate\Support\Str::limit($item->nama_obat, 20) }}</td>
                        <td>{{ $item->nama_dokter }}</td>
                        <td>
                            @if($item->metode_konseling == 'langsung')
                                <span class="badge-hijau"><i class="fas fa-users"></i> Langsung</span>
                            @else
                                <span class="badge-hijau"><i class="fas fa-phone-alt"></i> Via Telp</span>
                            @endif
                         </td>
                        <td>
                            @if($item->kepatuhan_minum_obat == 'Baik')
                                <span class="badge" style="background: #4caf50; padding: 5px 12px;">Baik</span>
                            @elseif($item->kepatuhan_minum_obat == 'Cukup')
                                <span class="badge" style="background: #ff9800; padding: 5px 12px;">Cukup</span>
                            @else
                                <span class="badge" style="background: #f44336; padding: 5px 12px;">Kurang</span>
                            @endif
                         </td>
                         <td class="aksi-column">
                            <a href="{{ route('counseling.show', $item->id) }}" class="btn btn-sm btn-info text-white" title="Detail">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('counseling.edit', $item->id) }}" class="btn btn-sm btn-warning" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('counseling.destroy', $item->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus data ini?')" title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                         </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="10" class="text-center py-4">
                            <i class="fas fa-folder-open fa-3x text-muted mb-3 d-block"></i>
                            Belum ada data konseling. <a href="{{ route('counseling.create') }}">Mulai konseling sekarang</a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="mt-3">
            {{ $counselings->appends(request()->query())->links() }}
        </div>
    </div>
</div>
@endsection