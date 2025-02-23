@section('content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>
    .pagination-container {
        margin: 2rem 0;
    }

    .pagination-container button {
        min-width: 40px;
        height: 40px;
        border-radius: 4px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-weight: 500;
        transition: all 0.2s ease;
    }

    .pagination-container button:disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }

    .pagination-container button.btn-primary {
        font-weight: bold;
    }

    .pagination-container span {
        display: inline-flex;
        align-items: center;
        color: #6c757d;
    }
</style>
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
<script>
    document.addEventListener("DOMContentLoaded", function() {
    const itemsPerPage = 5; // Jumlah item per halaman
    let currentPage = 1;
    const searchInput = document.getElementById('searchPenerbit');
    const tableRows = document.querySelectorAll('#penerbitTable tbody tr');

    // Tambahkan container pagination setelah tabel
    const table = document.querySelector('#penerbitTable');
    const paginationContainer = document.createElement('div');
    paginationContainer.className = 'pagination-container d-flex justify-content-center mt-4';
    table.parentNode.insertBefore(paginationContainer, table.nextSibling);

    function showPage(page) {
        const startIndex = (page - 1) * itemsPerPage;
        const endIndex = startIndex + itemsPerPage;
        let visibleCount = 0;
        let displayedCount = 0;

        tableRows.forEach(row => {
            const penerbitName = row.cells[1].innerText.toLowerCase();
            const searchValue = searchInput.value.toLowerCase();
            const isVisible = penerbitName.includes(searchValue);

            if (isVisible) {
                visibleCount++;
                const shouldShow = visibleCount > startIndex && visibleCount <= endIndex;
                if (shouldShow) {
                    displayedCount++;
                    row.style.display = "";
                    row.cells[0].textContent = startIndex + displayedCount; // Update nomor urut
                } else {
                    row.style.display = "none";
                }
            } else {
                row.style.display = "none";
            }
        });

        updatePagination(visibleCount);
    }

    function updatePagination(totalItems) {
        const totalPages = Math.ceil(totalItems / itemsPerPage);
        paginationContainer.innerHTML = '';

        if (totalPages <= 1) {
            return;
        }

        // Tombol Previous
        const prevButton = createPaginationButton('«', currentPage > 1);
        prevButton.addEventListener('click', () => {
            if (currentPage > 1) {
                currentPage--;
                showPage(currentPage);
            }
        });
        paginationContainer.appendChild(prevButton);

        // Nomor halaman
        for (let i = 1; i <= totalPages; i++) {
            if (totalPages <= 7 || i === 1 || i === totalPages ||
                (i >= currentPage - 1 && i <= currentPage + 1)) {
                const pageButton = createPaginationButton(i, true, i === currentPage);
                pageButton.addEventListener('click', () => {
                    currentPage = i;
                    showPage(currentPage);
                });
                paginationContainer.appendChild(pageButton);
            } else if (i === currentPage - 2 || i === currentPage + 2) {
                const ellipsis = document.createElement('span');
                ellipsis.className = 'mx-2';
                ellipsis.textContent = '...';
                paginationContainer.appendChild(ellipsis);
            }
        }

        // Tombol Next
        const nextButton = createPaginationButton('»', currentPage < totalPages);
        nextButton.addEventListener('click', () => {
            if (currentPage < totalPages) {
                currentPage++;
                showPage(currentPage);
            }
        });
        paginationContainer.appendChild(nextButton);
    }

    function createPaginationButton(text, enabled, isActive = false) {
        const button = document.createElement('button');
        button.className = `btn btn-sm mx-1 ${isActive ? 'btn-primary' : 'btn-outline-primary'}`;
        button.disabled = !enabled;
        button.textContent = text;
        return button;
    }

    // Ganti event listener pencarian yang lama
    searchInput.addEventListener('keyup', function() {
        currentPage = 1; // Reset ke halaman pertama saat pencarian
        showPage(currentPage);
    });

    // Tampilkan halaman pertama saat halaman dimuat
    showPage(currentPage);
});
</script>
@endsection
