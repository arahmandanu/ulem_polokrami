@extends('admin.shared.main')

@section('content')
    <div class="main-content flex-grow-1">
        <h1 class="section-title mb-4">Welcome, Admin!</h1>

        <div class="row g-4 mb-4">
            <div class="col-md-4">
                <div class="card bg-white shadow-sm h-100" style="border: 1px solid #b88a44;">
                    <div class="card-body">
                        <h5 class="card-title fw-bold text-secondary">Total Tamu</h5>
                        <p class="card-text fs-2">120</p>
                        <i class="bi bi-person-check-fill float-end fs-3 text-success"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-white shadow-sm h-100" style="border: 1px solid #b88a44;">
                    <div class="card-body">
                        <h5 class="card-title fw-bold text-secondary">Amplop Diterima</h5>
                        <p class="card-text fs-2">Rp 5.000.000</p>
                        <i class="bi bi-wallet2 float-end fs-3 text-primary"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-white shadow-sm h-100" style="border: 1px solid #b88a44;">
                    <div class="card-body">
                        <h5 class="card-title fw-bold text-secondary">Foto Kenangan</h5>
                        <p class="card-text fs-2">45</p>
                        <i class="bi bi-camera-fill float-end fs-3 text-info"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="card bg-white shadow-lg" style="border: none; border-radius: 10px;">
            <div class="card-header bg-light border-bottom">
                <h5 class="mb-0 fw-bold">Kontrol Utama</h5>
            </div>
            <div class="card-body">
                <p>Gunakan tombol di bawah untuk mengakses menu utama.</p>
                <a href="#" class="btn btn-warning me-2">Kelola RSVP</a>
                <a href="#" class="btn btn-secondary">Upload Foto Baru</a>
            </div>
        </div>

    </div>
@endsection
