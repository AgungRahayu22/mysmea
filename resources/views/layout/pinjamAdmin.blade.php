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
     @if(session('error'))
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Terjadi Kesalahan',
                    text: "{{ session('error') }}",
                });
            </script>
        @endif

        @if(session('success'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Sukses',
                    text: "{{ session('success') }}",
                });
            </script>
        @endif


    <!-- Peminjaman Buku -->
    <div class="col-12">
        <div class="card w-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="fw-bold text-primary">Peminjaman Buku</h3>
                </div>
                        <div class="mb-3">
            <input type="text" id="searchPeminjaman" class="form-control" placeholder="Cari berdasarkan nama peminjam atau judul buku...">
        </div>
                <div class="table-responsive">
                    <table class="table table-striped" id="peminjamanTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Peminjam</th>
                                <th>Judul Buku</th>
                                <th>Tanggal Pinjam</th>
                                <th>Batas Pengembalian</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($peminjaman as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->user->nama }}</td>  <!-- Menampilkan nama peminjam -->
                                <td>{{ $item->book->judul }}</td>
                                <td>{{ $item->tanggal_pinjam->format('d-m-Y') }}</td> <!-- Menampilkan tanggal pinjam -->

                                <td>
                                    @php
                                        $batas_waktu = $item->tanggal_pinjam->copy()->addDays(7); // Contoh: Batas waktu 7 hari setelah peminjaman
                                    @endphp
                                    {{ $batas_waktu->format('d-m-Y') }}
                                </td>

                                    <td>
                                        <form action="{{ route('peminjaman.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus peminjaman ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger">
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
</div>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        document.getElementById('searchPeminjaman').addEventListener('keyup', function () {
            let searchValue = this.value.toLowerCase();
            let rows = document.querySelectorAll('.table tbody tr');

            rows.forEach(row => {
                let namaPeminjam = row.cells[1].innerText.toLowerCase(); // Kolom Nama Peminjam
                let judulBuku = row.cells[2].innerText.toLowerCase(); // Kolom Judul Buku

                if (namaPeminjam.includes(searchValue) || judulBuku.includes(searchValue)) {
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
    const searchInput = document.getElementById('searchPeminjaman');
    const tableRows = document.querySelectorAll('#peminjamanTable tbody tr');

    // Tambahkan container pagination setelah tabel
    const table = document.querySelector('#peminjamanTable');
    const paginationContainer = document.createElement('div');
    paginationContainer.className = 'pagination-container d-flex justify-content-center mt-4';
    table.parentNode.insertBefore(paginationContainer, table.nextSibling);

    function showPage(page) {
        const startIndex = (page - 1) * itemsPerPage;
        const endIndex = startIndex + itemsPerPage;
        let visibleCount = 0;
        let displayedCount = 0;

        tableRows.forEach(row => {
            const namaPeminjam = row.cells[1].innerText.toLowerCase();
            const judulBuku = row.cells[2].innerText.toLowerCase();
            const searchValue = searchInput.value.toLowerCase();
            const isVisible = namaPeminjam.includes(searchValue) || judulBuku.includes(searchValue);

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
