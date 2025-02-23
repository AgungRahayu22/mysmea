@section('content')

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
    <!-- Ulasan Buku -->
    <div class="col-12">
        <div class="card w-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="fw-bold text-primary">Ulasan Buku</h3>
                </div>
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
                <div class="mb-3">
                    <input type="text" id="searchUlasan" class="form-control" placeholder="Cari berdasarkan nama pengulas atau judul buku...">
                </div>

                <div class="table-responsive">
                    <table class="table table-striped" id="ulasanTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Pengulas</th>
                                <th>Judul Buku</th>
                                <th>Rating</th>
                                <th>Komentar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($ratings as $rating)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $rating->user->nama }}</td>
                                <td>{{ $rating->book->judul }}</td>
                                 <td>
                                    <!-- Menampilkan Rating dalam format teks -->
                                    {{ $rating->rating }} / 5
                                </td>
                                <td>{{ $rating->review }}</td>
                                <td>
                                    <!-- Form untuk Hapus Rating -->
                                    <form action="{{ route('admin.deleteRating', $rating->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus rating ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="ti ti-trash"></i>Hapus</button>
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
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        document.getElementById('searchUlasan').addEventListener('keyup', function () {
            let searchValue = this.value.toLowerCase();
            let rows = document.querySelectorAll('.table tbody tr');

            rows.forEach(row => {
                let namaPengulas = row.cells[1].innerText.toLowerCase(); // Kolom Nama Pengulas
                let judulBuku = row.cells[2].innerText.toLowerCase(); // Kolom Judul Buku

                if (namaPengulas.includes(searchValue) || judulBuku.includes(searchValue)) {
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
    const searchInput = document.getElementById('searchUlasan');
    const tableRows = document.querySelectorAll('#ulasanTable tbody tr');

    // Tambahkan container pagination setelah tabel
    const table = document.querySelector('#ulasanTable');
    const paginationContainer = document.createElement('div');
    paginationContainer.className = 'pagination-container d-flex justify-content-center mt-4';
    table.parentNode.insertBefore(paginationContainer, table.nextSibling);

    function showPage(page) {
        const startIndex = (page - 1) * itemsPerPage;
        const endIndex = startIndex + itemsPerPage;
        let visibleCount = 0;
        let displayedCount = 0;

        tableRows.forEach(row => {
            const namaPengulas = row.cells[1].innerText.toLowerCase();
            const judulBuku = row.cells[2].innerText.toLowerCase();
            const searchValue = searchInput.value.toLowerCase();
            const isVisible = namaPengulas.includes(searchValue) || judulBuku.includes(searchValue);

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

