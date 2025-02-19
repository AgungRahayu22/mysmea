
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card w-100">
            <div class="card-body">
                <h3 class="fw-bold text-primary">
                    <i class="ti ti-database me-2"></i>Database Backup
                </h3>
                <p class="text-muted fs-4 mt-3">
                    Backup dan kelola database perpustakaan dengan aman dan mudah.
                </p>
            </div>
        </div>
    </div>

    <div class="row">
    <!-- Backup Database Card -->
        <div class="col-12">
                <div class="card text-start">
                <div class="card-body w-100">
                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="ti ti-alert-triangle me-2"></i>
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="d-flex align-items-center mb-4">

                        <div>
                            <h5 class="mt-3 fw-semibold mb-2">Backup Database Perpustakaan</h5>
                            <p class="text-muted mb-0">
                                Tekan tombol di bawah untuk membuat backup database <strong>perpus1</strong>
                            </p>
                        </div>
                    </div>

                    <a href="{{ route('admin.export-database') }}" class="btn btn-primary btn-lg shadow">
                        <i class="ti ti-download me-2"></i> Backup Sekarang
                    </a>

                    <div class="mt-4">
                        <small class="text-muted">
                            <i class="ti ti-clock me-1"></i>
                            Terakhir Backup:
                            {{ now()->format('d M Y H:i:s') }}
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 mt-3">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold">
                    <i class="ti ti-history text-primary me-2"></i>
                    Riwayat Backup Hari Kemarin
                </h5>

                <div class="table-responsive mt-3">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Nama File</th>
                                <th>Ukuran</th>
                                <th>Waktu Backup</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($yesterdayBackups as $backup)
                                <tr>
                                    <td>{{ $backup['filename'] }}</td>
                                    <td>{{ number_format($backup['size'] / 1024, 2) }} KB</td>
                                    <td>{{ date('H:i:s', $backup['created_at']) }}</td>
                                    <td>
                                        <a href="{{ route('admin.download-backup', $backup['filename']) }}" class="btn btn-sm btn-success">
                                            <i class="ti ti-download me-1"></i> Download
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted">
                                        Tidak ada backup database hari kemarin
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
</div>
@endsection
