<div class="row mt-5">
    <!-- Peminjaman Buku -->
    <div class="col-12">
        <div class="card w-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="fw-bold text-primary">Peminjaman Buku</h3>
                    <button class="btn btn-primary">
                        <i class="ti ti-plus"></i> Tambah Peminjaman
                    </button>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Peminjam</th>
                                <th>Judul Buku</th>
                                <th>Tanggal Pinjam</th>
                                <th>Batas Pengembalian</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Contoh Data -->
                            <tr>
                                <td>1</td>
                                <td>John Doe</td>
                                <td>The Great Gatsby</td>
                                <td>2025-01-01</td>
                                <td>2025-01-15</td>
                                <td>
                                    <span class="badge bg-success">Dikembalikan</span>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-warning">
                                        <i class="ti ti-pencil"></i> Edit
                                    </button>
                                    <button class="btn btn-sm btn-danger">
                                        <i class="ti ti-trash"></i> Hapus
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </
