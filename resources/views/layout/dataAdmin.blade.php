@section('content')
<div class="row">
    <div class="col-12">
        <div class="card w-100">
            <div class="card-body">
                <h3 class="fw-bold text-primary">
                    <i class="fas fa-database me-2"></i>Database Backup
                </h3>
                <p class="text-muted fs-4 mt-3">
                    Backup dan kelola database perpustakaan dengan aman dan mudah.
                </p>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Backup & Import Database Card -->
        <div class="col-12">
            <div class="card text-start">
                <div class="card-body w-100">
                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i>
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="d-flex align-items-center mb-4">
                        <div>
                            <h5 class="mt-3 fw-semibold mb-2">Backup Database Perpustakaan</h5>
                            <p class="text-muted mb-0">
                                Backup dan import database <strong>perpus1</strong>
                            </p>
                        </div>
                    </div>

                    <div class="d-flex gap-3">
                        <a href="{{ route('admin.export-database') }}" class="btn btn-primary btn-lg shadow">
                            <i class="fas fa-download me-2"></i> Backup Sekarang
                        </a>

                        <button type="button" class="btn btn-success btn-lg shadow" data-bs-toggle="modal" data-bs-target="#importModal">
                            <i class="fas fa-upload me-2"></i> Import Database
                        </button>
                    </div>

                    <div class="mt-4">
                        <small class="text-muted">
                            <i class="fas fa-clock me-1"></i>
                            Terakhir Backup: {{ now()->format('d M Y H:i:s') }}
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
                    <i class="fas fa-history text-primary me-2"></i>
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
                                            <i class="fas fa-download me-1"></i> Download
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
</div>

<!-- Import Modal -->
<div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="importModalLabel">Import Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.import-database') }}" method="POST" enctype="multipart/form-data" id="importForm">
                @csrf
                <div class="modal-body">
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        File yang diimport akan disimpan di riwayat backup hari kemarin dan dapat didownload kembali.
                    </div>

                    <div class="mb-3">
                        <label for="importFile" class="form-label">Pilih File SQL</label>
                        <input type="file" class="form-control" id="importFile" name="importFile" accept=".sql" required>
                    </div>

                    <!-- Preview Area -->
                    <div id="previewArea" class="d-none">
                        <h6 class="mb-3">Preview Data:</h6>
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>Tabel</th>
                                        <th>Jumlah Data</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody id="previewTableBody">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary" id="importBtn" disabled>
                        <i class="fas fa-upload me-2"></i> Import Data
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Tambahkan script berikut -->
<script>
document.getElementById('importFile').addEventListener('change', async function(e) {
    const file = e.target.files[0];
    if (!file) return;

    // Validasi ekstensi file
    const extension = file.name.split('.').pop().toLowerCase();
    if (extension !== 'sql') {
        alert('File harus berformat SQL');
        this.value = ''; // Reset input file
        return;
    }

    const formData = new FormData();
    formData.append('importFile', file);

    try {
        const response = await fetch('{{ route("admin.preview-import") }}', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        });

        const data = await response.json();

        if (response.ok) {
            const previewArea = document.getElementById('previewArea');
            const tableBody = document.getElementById('previewTableBody');
            const importBtn = document.getElementById('importBtn');

            tableBody.innerHTML = `
                <tr>
                    <td>
                        <span class="badge bg-success">File siap diimport ke riwayat backup</span>
                    </td>
                </tr>
            `;

            previewArea.classList.remove('d-none');
            importBtn.disabled = false;

        } else {
            throw new Error(data.error);
        }
    } catch (error) {
        alert('Error saat preview file: ' + error.message);
        this.value = ''; // Reset input file
    }
});
</script>
@endsection
