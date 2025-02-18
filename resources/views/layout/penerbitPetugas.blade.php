@section('content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<div class="row mt-5">
    <div class="col-12">
        <div class="card w-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="fw-bold text-primary">Pendataan Penerbit</h3>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPenerbitModal">
                        <i class="ti ti-plus"></i> Tambah Penerbit
                    </button>
                </div>

                <div class="mb-3">
                    <input type="text" id="searchPenerbit" class="form-control" placeholder="Cari penerbit...">
                </div>

                <div class="table-responsive">
                    <table class="table table-striped" id="penerbitTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Penerbit</th>
                                <th>Alamat</th>
                                <th>Kontak</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($penerbits as $penerbit)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $penerbit->nama_penerbit }}</td>
                                    <td>{{ $penerbit->alamat }}</td>
                                    <td>{{ $penerbit->kontak }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary edit-button"
                                            data-id="{{ $penerbit->id }}"
                                            data-nama="{{ $penerbit->nama_penerbit }}"
                                            data-alamat="{{ $penerbit->alamat }}"
                                            data-kontak="{{ $penerbit->kontak }}"
                                            data-bs-toggle="modal"
                                            data-bs-target="#editPenerbitModal">
                                            <i class="ti ti-pencil"></i> Edit
                                        </button>
                                        <button onclick="konfirmasiHapus('{{ $penerbit->id }}')"
                                                class="btn btn-sm btn-danger">
                                            <i class="ti ti-trash"></i> Hapus
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Penerbit -->
    <div class="modal fade" id="addPenerbitModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Penerbit</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('petugas.penerbit.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label>Nama Penerbit</label>
                            <input type="text" name="nama_penerbit" class="form-control" required>
                        </div>
                        <div class="form-group mb-3">
                            <label>Alamat</label>
                            <input type="text" name="alamat" class="form-control" required>
                        </div>
                        <div class="form-group mb-3">
                            <label>Kontak</label>
                            <input type="number" name="kontak" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Edit Penerbit -->
    <div class="modal fade" id="editPenerbitModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Penerbit</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="editPenerbitForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <input type="hidden" name="id" id="editPenerbitId">
                        <div class="form-group mb-3">
                            <label>Nama Penerbit</label>
                            <input type="text" name="nama_penerbit" id="editNamaPenerbit" class="form-control" required>
                        </div>
                        <div class="form-group mb-3">
                            <label>Alamat</label>
                            <input type="text" name="alamat" id="editAlamat" class="form-control" required>
                        </div>
                        <div class="form-group mb-3">
                            <label>Kontak</label>
                            <input type="number" name="kontak" id="editKontak" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    // Handler untuk edit
    const editButtons = document.querySelectorAll(".edit-button");
    const editForm = document.getElementById("editPenerbitForm");

    editButtons.forEach(button => {
        button.addEventListener("click", function () {
            const id = this.dataset.id;
            const nama = this.dataset.nama;
            const alamat = this.dataset.alamat;
            const kontak = this.dataset.kontak;

            document.getElementById("editPenerbitId").value = id;
            document.getElementById("editNamaPenerbit").value = nama;
            document.getElementById("editAlamat").value = alamat;
            document.getElementById("editKontak").value = kontak;

            editForm.action = `{{ route('petugas.penerbit.update', '') }}/${id}`;
        });
    });

    // Handler untuk submit form edit
    editForm.addEventListener('submit', function(e) {
        e.preventDefault();

        Swal.fire({
            title: 'Konfirmasi',
            text: 'Apakah Anda yakin ingin menyimpan perubahan?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Ya, simpan',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit();
            }
        });
    });

    // Show success message if exists
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session('success') }}',
            timer: 3000,
            showConfirmButton: false
        });
    @endif
});

// Fungsi konfirmasi hapus
function konfirmasiHapus(id) {
    Swal.fire({
        title: 'Apakah Anda yakin?',
        text: "Data penerbit akan dihapus secara permanen!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `{{ url('petugas/penerbit') }}/${id}`;

            const csrfToken = document.createElement('input');
            csrfToken.type = 'hidden';
            csrfToken.name = '_token';
            csrfToken.value = '{{ csrf_token() }}';
            form.appendChild(csrfToken);

            const methodField = document.createElement('input');
            methodField.type = 'hidden';
            methodField.name = '_method';
            methodField.value = 'DELETE';
            form.appendChild(methodField);

            document.body.appendChild(form);
            form.submit();
        }
    });
}
</script>
@endsection
