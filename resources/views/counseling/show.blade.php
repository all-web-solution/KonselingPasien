{{-- resources/views/counseling/show.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <i class="fas fa-file-medical"></i> Detail Konseling Pasien
    </div>
    <div class="card-body">
        <div class="d-flex justify-content-end mb-3 gap-2 no-print">
            <button onclick="printPage()" class="btn btn-outline-success">
                <i class="fas fa-print"></i> Cetak
            </button>
            <a href="{{ route('counseling.edit', $counseling->id) }}" class="btn btn-warning">
                <i class="fas fa-edit"></i> Edit
            </a>
            <a href="{{ route('counseling.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
        
        <div class="row">
            <!-- Data Pasien -->
            <div class="col-md-6">
                <div class="info-card">
                    <div class="info-label">
                        <i class="fas fa-user"></i> NAMA PASIEN
                    </div>
                    <div class="info-value">{{ $counseling->patient->nama_pasien }}</div>
                </div>
                
                <div class="info-card">
                    <div class="info-label">
                        <i class="fas fa-calendar-alt"></i> UMUR & TANGGAL LAHIR
                    </div>
                    <div class="info-value">{{ $counseling->patient->umur }} tahun ({{ date('d/m/Y', strtotime($counseling->patient->tgl_lahir)) }})</div>
                </div>
                
                <div class="info-card">
                    <div class="info-label">
                        <i class="fas fa-venus-mars"></i> JENIS KELAMIN
                    </div>
                    <div class="info-value">{{ $counseling->patient->jenis_kelamin }}</div>
                </div>
                
                <div class="info-card">
                    <div class="info-label">
                        <i class="fas fa-map-marker-alt"></i> ALAMAT
                    </div>
                    <div class="info-value">{{ $counseling->patient->alamat }}</div>
                </div>
                
                <div class="info-card">
                    <div class="info-label">
                        <i class="fas fa-allergies"></i> RIWAYAT ALERGI
                    </div>
                    <div class="info-value">{{ $counseling->patient->riwayat_alergi ?: 'Tidak ada alergi' }}</div>
                </div>
                
                <div class="info-card">
                    <div class="info-label">
                        <i class="fas fa-heartbeat"></i> KONDISI KHUSUS
                    </div>
                    <div class="info-value">{{ $counseling->patient->kondisi_khusus ?: 'Tidak ada kondisi khusus' }}</div>
                </div>
            </div>
            
            <!-- Data Resep & Konseling -->
            <div class="col-md-6">
                <div class="info-card">
                    <div class="info-label">
                        <i class="fas fa-user-md"></i> NAMA DOKTER
                    </div>
                    <div class="info-value">{{ $counseling->nama_dokter }}</div>
                </div>
                
                <div class="info-card">
                    <div class="info-label">
                        <i class="fas fa-capsules"></i> NAMA OBAT
                    </div>
                    <div class="info-value">{{ $counseling->obat_dan_aturan_pakai }}</div>
                </div>
                
                
                <div class="info-card">
                    <div class="info-label">
                        <i class="fas fa-boxes"></i> LAMA TERAPI
                    </div>
                    <div class="info-value">{{ $counseling->lama_terapi }}</div>
                </div>
                
                <div class="info-card">
                    <div class="info-label">
                        <i class="fas fa-stethoscope"></i> DIAGNOSA
                    </div>
                    <div class="info-value">{{ $counseling->diagnosa }}</div>
                </div>
                
                <div class="info-card">
                    <div class="info-label">
                        <i class="fas fa-calendar-check"></i> TANGGAL KONSELING
                    </div>
                    <div class="info-value">{{ date('d/m/Y', strtotime($counseling->tanggal_konseling)) }}</div>
                </div>
            </div>
        </div>
        
        <hr>
        
        <h5 class="section-title"><i class="fas fa-headset"></i> Data Konseling Lengkap</h5>
        
        <div class="row">
            <div class="col-md-6">
                <div class="info-card">
                    <div class="info-label">🏥 NAMA APOTEK</div>
                    <div class="info-value">{{ $counseling->nama_apotek }}</div>
                </div>
                
                <div class="info-card">
                    <div class="info-label">📞 METODE KONSELING</div>
                    <div class="info-value">{{ $counseling->metode_konseling == 'langsung' ? 'Langsung (Tatap Muka)' : 'Via Telepon' }}</div>
                </div>
                
                <div class="info-card">
                    <div class="info-label">📖 MATERI YANG DISAMPAIKAN</div>
                    <div class="info-value">{{ $counseling->materi_yang_disampaikan }}</div>
                </div>
                
                <div class="info-card">
                    <div class="info-label">💊 CARA PENGGUNAAN OBAT</div>
                    <div class="info-value">{{ $counseling->cara_penggunaan_obat }}</div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="info-card">
                    <div class="info-label">⏰ WAKTU MINUM OBAT</div>
                    <div class="info-value">{{ $counseling->waktu_minum_obat }}</div>
                </div>
                
                <div class="info-card">
                    <div class="info-label">⚠️ INTERAKSI OBAT/MAKANAN</div>
                    <div class="info-value">{{ $counseling->interaksi_obat_makanan }}</div>
                </div>
                
                <div class="info-card">
                    <div class="info-label">🏪 PENYIMPANAN OBAT</div>
                    <div class="info-value">{{ $counseling->penyimpanan_obat }}</div>
                </div>
                
                <div class="info-card">
                    <div class="info-label">✅ KEPATUHAN MINUM OBAT</div>
                    <div class="info-value">
                        @if($counseling->kepatuhan_minum_obat == 'Baik')
                            <span class="badge" style="background: #4caf50;">Baik - Patuh minum obat</span>
                        @elseif($counseling->kepatuhan_minum_obat == 'Cukup')
                            <span class="badge" style="background: #ff9800;">Cukup - Kadang lupa</span>
                        @else
                            <span class="badge" style="background: #f44336;">Kurang - Sering tidak patuh</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection