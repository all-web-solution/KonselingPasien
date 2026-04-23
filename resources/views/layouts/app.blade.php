{{-- resources/views/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Apotek Sehat - Rekam Medis & Konseling</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            background: linear-gradient(135deg, #e8f5e8 0%, #c8e6c9 100%);
            font-family: 'Segoe UI', 'Poppins', system-ui, sans-serif;
            min-height: 100vh;
        }
        
        /* Navbar Hijau */
        .navbar {
            background: linear-gradient(135deg, #1b5e1b 0%, #2e7d32 100%);
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            padding: 1rem 0;
        }
        
        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: white !important;
        }
        
        .navbar-brand i {
            margin-right: 10px;
        }
        
        .nav-link {
            color: rgba(255,255,255,0.9) !important;
            font-weight: 500;
            transition: all 0.3s;
        }
        
        .nav-link:hover {
            color: white !important;
            transform: translateY(-2px);
        }
        
        /* Card Style */
        .card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
            overflow: hidden;
            margin-bottom: 30px;
        }
        
        .card-header {
            background: linear-gradient(135deg, #2e7d32 0%, #388e3c 100%);
            color: white;
            padding: 18px 25px;
            font-weight: 600;
            font-size: 1.2rem;
            border: none;
        }
        
        .card-header i {
            margin-right: 10px;
        }
        
        .card-body {
            background: white;
            padding: 30px;
        }
        
        /* Form Style */
        .form-label {
            font-weight: 600;
            color: #1b5e1b;
            margin-bottom: 8px;
        }
        
        .form-control, .form-select {
            border: 2px solid #e0e0e0;
            border-radius: 12px;
            padding: 10px 15px;
            transition: all 0.3s;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: #2e7d32;
            box-shadow: 0 0 0 0.2rem rgba(46,125,50,0.25);
        }
        
        /* Button Hijau */
        .btn-success {
            background: linear-gradient(135deg, #2e7d32 0%, #388e3c 100%);
            border: none;
            border-radius: 12px;
            padding: 10px 25px;
            font-weight: 600;
            transition: all 0.3s;
        }
        
        .btn-success:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(46,125,50,0.4);
        }
        
        .btn-outline-success {
            border: 2px solid #2e7d32;
            color: #2e7d32;
            border-radius: 12px;
            font-weight: 600;
        }
        
        .btn-outline-success:hover {
            background: #2e7d32;
            border-color: #2e7d32;
            color: white;
        }
        
        /* Table Style */
        .table {
            border-radius: 15px;
            overflow: hidden;
        }
        
        .table thead {
            background: linear-gradient(135deg, #2e7d32 0%, #388e3c 100%);
            color: white;
        }
        
        .table thead th {
            padding: 12px;
            font-weight: 600;
            border: none;
        }
        
        .table tbody tr:hover {
            background-color: #f1f8e9;
        }
        
        /* Badge */
        .badge-hijau {
            background: #2e7d32;
            color: white;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
        }
        
        /* Footer */
        footer {
            background: linear-gradient(135deg, #1b5e1b 0%, #2e7d32 100%);
            color: white;
            text-align: center;
            padding: 20px 0;
            margin-top: 50px;
        }
        
        /* Section Title */
        .section-title {
            color: #1b5e1b;
            font-weight: 700;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 3px solid #2e7d32;
            display: inline-block;
        }
        
        hr {
            border: none;
            height: 2px;
            background: linear-gradient(90deg, #2e7d32, #c8e6c9, #2e7d32);
            margin: 30px 0;
        }
        
        /* Info Card di Show */
        .info-card {
            background: #f1f8e9;
            border-radius: 15px;
            padding: 15px 20px;
            margin-bottom: 15px;
            border-left: 4px solid #2e7d32;
        }
        
        .info-label {
            font-weight: 700;
            color: #1b5e1b;
            margin-bottom: 5px;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .info-value {
            color: #333;
            font-size: 1rem;
            font-weight: 500;
        }
        
        /* Filter Card */
        .filter-card {
            background: #f8f9fa;
            border-radius: 15px;
            padding: 15px;
            margin-bottom: 20px;
        }
        
        @media print {
            .navbar, footer, .no-print, .btn, .aksi-column {
                display: none !important;
            }
            .card {
                box-shadow: none;
            }
            body {
                background: white;
            }
            .container {
                width: 100%;
                max-width: none;
            }
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg sticky-top">
    <div class="container">
        <a class="navbar-brand" href="{{ route('counseling.index') }}">
            <i class="fas fa-hospital-user"></i> Apotek Sehat
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('counseling.index') }}">
                        <i class="fas fa-home"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('counseling.create') }}">
                        <i class="fas fa-plus-circle"></i> Konseling Baru
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('patient.index') }}">
                        <i class="fas fa-users"></i> Data Pasien
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('patient.create') }}">
                        <i class="fas fa-user-plus"></i> Tambah Pasien
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-4">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert" style="background: #c8e6c9; border: none; color: #1b5e1b; border-radius: 12px;">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    
    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert" style="border-radius: 12px;">
            <i class="fas fa-exclamation-triangle"></i> Ada kesalahan input!
            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    
    @yield('content')
</div>

<footer class="no-print">
    <div class="container">
        <p class="mb-0">
            <i class="fas fa-leaf"></i> Sistem Informasi Rekam Medis & Konseling Apotek 
            <br>© 2024 - Dibuat untuk Kesehatan Anda
        </p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function printPage() {
        window.print();
    }
    
    function confirmDelete(url) {
        if(confirm('Yakin mau hapus data ini?')) {
            window.location.href = url;
        }
    }
</script>
</body>
</html>