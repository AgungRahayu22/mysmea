
@section('content')
<!-- SweetAlert CDN -->
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
                    <h3 class="fw-bold text-primary">Data Kategori</h3>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
                        <i class="ti ti-plus"></i> Tambah Kategori
                    </button>
                </div>

                @if (session('success'))
                    <script>
                        Swal.fire({
                            title: 'Sukses!',
                            text: '{{ session('success') }}',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        });
                    </script>
                @endif
                <div class="mb-3">
                    <input type="text" id="searchCategory" class="form-control" placeholder="Cari kategori...">
                </div>

                <div class="table-responsive">
                    <table class="table table-striped" id="categoryTable">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-left" style="width: 80%;">Nama Kategori</th>
                                <th class="text-right" style="width: 20%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $index => $category)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $category->nama_kategori }}</td>
                                    <td>
                                        <button class="btn btn-outline-primary btn-sm edit-button"
                                            data-id="{{ $category->id }}"
                                            data-name="{{ $category->nama_kategori }}"
                                            data-bs-toggle="modal"
                                            data-bs-target="#editCategoryModal">
                                            <i class="ti ti-pencil"></i> Edit
                                        </button>

                                        <form action="{{ route('admin.katagori.destroy', $category->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="ti ti-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Kategori -->
    <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCategoryModalLabel">Tambah Kategori</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.katagori.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama_kategori">Nama Kategori</label>
                            <input type="text" name="nama_kategori" class="form-control" id="nama_kategori" required>
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

    <!-- Modal Edit Kategori -->
    <div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editCategoryModalLabel">Edit Kategori</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editCategoryForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <input type="hidden" id="editCategoryId">
                        <div class="form-group">
                            <label for="edit_nama_kategori">Nama Kategori</label>
                            <input type="text" name="nama_kategori" class="form-control" id="edit_nama_kategori" required>
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
document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll('.edit-button').forEach(button => {
        button.addEventListener('click', function() {
            let id = this.getAttribute('data-id');
            let name = this.getAttribute('data-name');

            document.getElementById('editCategoryId').value = id;
            document.getElementById('edit_nama_kategori').value = name;
            document.getElementById('editCategoryForm').action = "/admin/katagori/" + id;
        });
    });
});
</script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    // Event listener untuk tombol edit
    document.querySelectorAll('.edit-button').forEach(button => {
        button.addEventListener('click', function() {
            let id = this.getAttribute('data-id');
            let name = this.getAttribute('data-name');

            document.getElementById('editCategoryId').value = id;
            document.getElementById('edit_nama_kategori').value = name;
            document.getElementById('editCategoryForm').action = "/admin/katagori/" + id;
        });
    });

    // Fitur pencarian kategori
    document.getElementById('searchCategory').addEventListener('keyup', function() {
        let searchValue = this.value.toLowerCase();
        let rows = document.querySelectorAll('#categoryTable tbody tr');

        rows.forEach(row => {
            let categoryName = row.cells[1].innerText.toLowerCase();
            if (categoryName.includes(searchValue)) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        });
    });
});
document.addEventListener("DOMContentLoaded", function() {
    const itemsPerPage = 5; // Jumlah item per halaman
    let currentPage = 1;
    const searchInput = document.getElementById('searchCategory');
    const tableRows = document.querySelectorAll('#categoryTable tbody tr');

    // Tambahkan container pagination setelah tabel
    const table = document.querySelector('#categoryTable');
    const paginationContainer = document.createElement('div');
    paginationContainer.className = 'pagination-container d-flex justify-content-center mt-4';
    table.parentNode.insertBefore(paginationContainer, table.nextSibling);

    function showPage(page) {
        const startIndex = (page - 1) * itemsPerPage;
        const endIndex = startIndex + itemsPerPage;
        let visibleCount = 0;
        let displayedCount = 0;

        tableRows.forEach(row => {
            const categoryName = row.cells[1].innerText.toLowerCase();
            const searchValue = searchInput.value.toLowerCase();
            const isVisible = categoryName.includes(searchValue);

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

    // Event listener untuk pencarian
    searchInput.addEventListener('keyup', function() {
        currentPage = 1; // Reset ke halaman pertama saat pencarian
        showPage(currentPage);
    });

    // Tampilkan halaman pertama saat halaman dimuat
    showPage(currentPage);
});
</script>


@endsection
