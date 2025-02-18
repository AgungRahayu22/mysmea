@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
<style>
    .pdf-container {
        position: relative;
        width: 100%;
        height: 70vh;
        overflow: hidden;
    }

    .pdf-viewer {
        width: 100%;
        height: 100%;
        border: none;
        filter: blur(5px);
        transition: filter 0.3s ease;
        -webkit-overflow-scrolling: touch;
        overflow-y: auto;
    }

    .pdf-container:hover .pdf-viewer {
        filter: blur(0);
    }

    .pdf-viewer::-webkit-scrollbar {
        width: 8px;
    }

    .pdf-viewer::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 4px;
    }

    .pdf-viewer::-webkit-scrollbar-thumb {
        background: #888;
        border-radius: 4px;
    }

    .pdf-viewer::-webkit-scrollbar-thumb:hover {
        background: #555;
    }
    .pagination-container {
    margin-top: 2rem;
    margin-bottom: 2rem;
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
</style>
<div class="row mt-5">
    <div class="col-12">
        <div class="card w-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="fw-bold text-primary">Pendataan Buku</h3>
                    <button class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#tambahBukuModal">
                        <i class="ti ti-plus"></i> Tambah Buku
                    </button>
                </div>

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="d-flex mb-3">
                    <input type="text" id="searchNama" class="form-control me-2" placeholder="Cari berdasarkan nama">

                   <select id="kategori" class="form-control">
                        <option value="">Semua Kategori</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category }}"
                                {{ isset($book) && $book->kategori_id == $category->id ? 'selected' : '' }}>
                                {{ $category }}
                            </option>
                        @endforeach
                    </select>


                </div>
                <div class="row">
                    @foreach($books as $book)
                       <div class="col-md-3 mb-4" data-kategori="{{ $book->kategori }}">
                            <div class="card" data-bs-toggle="modal" data-bs-target="#bookDetailModal{{ $book->id }}">
                                <img src="{{ $book->image_url }}" alt="Gambar Buku" class="card-img-top" style="height: 400px; object-fit: cover;">

                                <div class="card-body">
                                    <h5 class="card-title">{{ $book->judul }}</h5>
                                    <p class="card-text"><strong>Penulis:</strong> {{ $book->penulis }}</p>
                                    <p class="rating text-warning">
                                                    @php
                                                        $rating = round($book->averageRating());
                                                    @endphp
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        @if ($i <= $rating)
                                                            <i class="bi bi-star-fill"></i> {{-- Bintang penuh --}}
                                                        @else
                                                            <i class="bi bi-star"></i> {{-- Bintang kosong --}}
                                                        @endif
                                                    @endfor
                                    </p>



                                    <div class="d-flex justify-content-between">
                                       <a href="#" onclick="openPdf('{{ Storage::url($book->pdf_path) }}')" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#pdfModal">
                                            <i class="ti ti-file"></i> Lihat PDF
                                        </a>

                                        <button class="btn btn-outline-primary btn-sm edit-button"
                                            data-id="{{ $book->id }}"
                                            data-judul="{{ $book->judul }}"
                                            data-penulis="{{ $book->penulis }}"
                                            data-penerbit="{{ $book->penerbit_id }}"
                                            data-kategori="{{ $book->kategori_id }}"
                                            data-tahun="{{ $book->tahun }}"
                                            data-jumlah="{{ $book->jumlah }}"
                                            data-deskripsi="{{ $book->deskripsi }}"
                                            data-image_url="{{ $book->image_url }}"
                                            data-pdf_url="{{ $book->pdf_url }}"
                                            data-bs-toggle="modal"
                                            data-bs-target="#editBukuModal">
                                            <i class="ti ti-pencil"></i> Edit
                                        </button>

                                        <form action="{{ route('petugas.databuku.destroy', $book->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus buku ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="ti ti-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="pdfModal" tabindex="-1" aria-labelledby="pdfModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="pdfModalLabel">Baca Buku</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body p-0">
                                        <div class="pdf-container" id="pdfContainer">
                                            <iframe id="pdfViewer" class="pdf-viewer"></iframe>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- Modal untuk buku ini -->
                        <div class="modal fade" id="bookDetailModal{{ $book->id }}" tabindex="-1" aria-labelledby="bookDetailModalLabel{{ $book->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header bg-outline-primary text-white">
                                        <h5 class="modal-title" id="bookDetailModalLabel{{ $book->id }}">
                                            <i class="bi bi-book"></i> {{ $book->judul }}
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>

                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-5 text-center">
                                                <img src="{{ $book->image_url }}" class="img-fluid rounded shadow-lg" alt="{{ $book->judul }}">
                                            </div>

                                            <div class="col-md-7">
                                                <ul class="list-group list-group-flush">
                                                    <li class="list-group-item rating text-warning">
                                                    @php
                                                        $rating = round($book->averageRating());
                                                    @endphp
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        @if ($i <= $rating)
                                                            <i class="bi bi-star-fill"></i> {{-- Bintang penuh --}}
                                                        @else
                                                            <i class="bi bi-star"></i> {{-- Bintang kosong --}}
                                                        @endif
                                                    @endfor
                                                    </li>
                                                    <li class="list-group-item"><strong>Penulis:</strong> {{ $book->penulis }}</li>
                                                    <li class="list-group-item"><strong>Penerbit:</strong> {{ $book->penerbit->nama_penerbit ?? '-' }}</li>
                                                    <li class="list-group-item"><strong>Kategori:</strong> {{ $book->kategori->nama_kategori ?? '-' }}</li>
                                                    <li class="list-group-item"><strong>Tahun Terbit:</strong> {{ $book->tahun }}</li>
                                                    <li class="list-group-item"><strong>Jumlah:</strong> {{ $book->jumlah }}</li>
                                                    <li class="list-group-item"><strong>Deskripsi:</strong> {{ $book->deskripsi }}</li>

                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal-footer">

                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
    </div>
    <!-- Modal Tambah Buku -->
    <div class="modal fade" id="tambahBukuModal" tabindex="-1" aria-labelledby="tambahBukuModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('petugas.databuku.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahBukuModalLabel">Tambah Buku</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Form Input -->
                        <div class="mb-3">
                            <label for="judul" class="form-label">Judul Buku</label>
                            <input type="text" name="judul" class="form-control" id="judul" required>
                        </div>
                        <div class="mb-3">
                            <label for="penulis" class="form-label">Penulis</label>
                            <input type="text" name="penulis" class="form-control" id="penulis" required>
                        </div>
                        <div class="mb-3">
                            <label for="penerbit_id" class="form-label">Penerbit</label>
                            <select name="penerbit_id" class="form-control" id="penerbit_id" required>
                                <option value="">Pilih Penerbit</option>
                                @foreach($penerbits as $id => $nama_penerbit)
                                    <option value="{{ $id }}">{{ $nama_penerbit }}</option>
                                @endforeach
                            </select>
                        </div>
                       <div class="mb-3">
                            <label for="kategori_id" class="form-label">Kategori</label>
                            <select name="kategori_id" class="form-control" id="kategori_id" required>
                                <option value="">Pilih Kategori</option>
                                @foreach($categories as $id => $nama_kategori)
                                    <option value="{{ $id }}">{{ $nama_kategori }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="tahun" class="form-label">Tahun Terbit</label>
                            <input type="number" name="tahun" class="form-control" id="tahun" required>
                        </div>
                        <div class="mb-3">
                            <label for="jumlah" class="form-label">Jumlah</label>
                            <input type="number" name="jumlah" class="form-control" id="jumlah" required>
                        </div>
                        <div class="mb-3">
                            <label for="image_url" class="form-label">URL Gambar</label>
                            <input type="url" name="image_url" class="form-control" id="image_url" required>
                        </div>
                       <div class="mb-3">
                            <label for="pdf_file" class="form-label">File PDF</label>
                            <input type="file" name="pdf_file" class="form-control" id="pdf_file" accept=".pdf" required>
                        </div>
                        <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" id="deskripsi" rows="3" required></textarea>
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


    <!-- Modal Edit Buku -->
    <div class="modal fade" id="editBukuModal" tabindex="-1" aria-labelledby="editBukuModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="editForm" action="{{ route('petugas.databuku.update', $book->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="editBukuModalLabel">Edit Buku</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Form Input -->
                        <div class="mb-3">
                            <label for="judul" class="form-label">Judul Buku</label>
                            <input type="text" name="judul" class="form-control" id="judul_edit" required>
                        </div>
                        <div class="mb-3">
                            <label for="penulis" class="form-label">Penulis</label>
                            <input type="text" name="penulis" class="form-control" id="penulis_edit" required>
                        </div>
                        <div class="mb-3">
                            <label for="penerbit_id" class="form-label">Penerbit</label>
                            <select name="penerbit_id" class="form-control" id="penerbit_id_edit" required>
                                <option value="">Pilih Penerbit</option>
                                @foreach($penerbits as $id => $nama_penerbit)
                                    <option value="{{ $id }}">{{ $nama_penerbit }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="kategori_id" class="form-label">Kategori</label>
                            <select name="kategori_id" class="form-control" id="kategori_id_edit" required>
                                <option value="">Pilih Kategori</option>
                                @foreach($categories as $id => $nama_kategori)
                                    <option value="{{ $id }}">{{ $nama_kategori }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="tahun" class="form-label">Tahun Terbit</label>
                            <input type="number" name="tahun" class="form-control" id="tahun_edit" required>
                        </div>
                        <div class="mb-3">
                            <label for="jumlah" class="form-label">Jumlah</label>
                            <input type="number" name="jumlah" class="form-control" id="jumlah_edit" required>
                        </div>
                        <div class="mb-3">
                            <label for="image_url" class="form-label">URL Gambar</label>
                            <input type="url" name="image_url" class="form-control" id="image_url_edit" required>
                        </div>
                       <div class="mb-3">
                            <label for="pdf_file" class="form-label">File PDF (Opsional)</label>
                            <input type="file" name="pdf_file" class="form-control" id="pdf_file_edit" accept=".pdf">
                        </div>

                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <input type="text" name="deskripsi" class="form-control" id="deskripsi_edit" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Perbarui</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.querySelectorAll('.edit-button').forEach(button => {
    button.addEventListener('click', function() {
        const form = document.getElementById('editForm'); // Ganti ke 'editForm'
        const bookId = this.getAttribute('data-id');

        // Update form action dinamis
        form.action = `/petugas/databuku/${bookId}`;

        // Isi form dengan data
        document.getElementById('judul_edit').value = this.getAttribute('data-judul');
        document.getElementById('penulis_edit').value = this.getAttribute('data-penulis');
        document.getElementById('tahun_edit').value = this.getAttribute('data-tahun');
        document.getElementById('jumlah_edit').value = this.getAttribute('data-jumlah');
        document.getElementById('deskripsi_edit').value = this.getAttribute('data-deskripsi');
        document.getElementById('image_url_edit').value = this.getAttribute('data-image_url');

        // Pilih kategori dan penerbit sesuai data
        document.getElementById('kategori_id_edit').value = this.getAttribute('data-kategori');
        document.getElementById('penerbit_id_edit').value = this.getAttribute('data-penerbit');
    });
});
</script>
<script>
document.querySelectorAll('.edit-button').forEach(button => {
    button.addEventListener('click', function() {
        const form = document.getElementById('editBukuForm');
        const bookId = this.getAttribute('data-id');

        // Update form action dinamis
        form.action = `/petugas/databuku/${bookId}`;

        // Set hidden input id
        document.getElementById('edit_id').value = bookId;

        // Isi form dengan data
        document.getElementById('edit_judul').value = this.getAttribute('data-judul');
        document.getElementById('edit_penulis').value = this.getAttribute('data-penulis');
        document.getElementById('edit_tahun').value = this.getAttribute('data-tahun');
        document.getElementById('edit_jumlah').value = this.getAttribute('data-jumlah');
        document.getElementById('edit_deskripsi').value = this.getAttribute('data-deskripsi');
        document.getElementById('edit_image_url').value = this.getAttribute('data-image_url');

        // Pilih kategori dan penerbit sesuai data
        document.getElementById('edit_kategori_id').value = this.getAttribute('data-kategori');
        document.getElementById('edit_penerbit_id').value = this.getAttribute('data-penerbit');
    });
});
</script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const searchNama = document.querySelector("#searchNama");
    const kategori = document.querySelector("#kategori");
    const books = document.querySelectorAll(".col-md-3");

    function filterBooks() {
        const searchText = searchNama.value.toLowerCase();
        const selectedCategory = kategori.value.toLowerCase();

        books.forEach(book => {
            const title = book.querySelector(".card-title").textContent.toLowerCase();
            const category = book.getAttribute("data-kategori").toLowerCase();

            const nameMatch = title.includes(searchText);
            const categoryMatch = selectedCategory === "" || category === selectedCategory;

            book.style.display = nameMatch && categoryMatch ? "" : "none";
        });
    }

    searchNama.addEventListener("input", filterBooks);
    kategori.addEventListener("change", filterBooks);
});
</script>
<script>
    function openPdf(pdfUrl) {
        const viewer = document.getElementById('pdfViewer');
        viewer.src = pdfUrl + "#toolbar=0&scrollbar=1&view=FitH&zoom=80";
    }

    // Mencegah klik kanan
    document.getElementById('pdfViewer').addEventListener('contextmenu', function(e) {
        e.preventDefault();
    });

    // Smooth scroll
    document.getElementById('pdfViewer').addEventListener('load', function() {
        this.contentWindow.addEventListener('scroll', function(e) {
            e.preventDefault();
            this.scrollBy({
                top: e.deltaY,
                behavior: 'smooth'
            });
        });
    });
    document.addEventListener("DOMContentLoaded", function () {
    const itemsPerPage = 8; // Jumlah buku per halaman
    let currentPage = 1;
    const searchNama = document.querySelector("#searchNama");
    const kategori = document.querySelector("#kategori");
    const books = document.querySelectorAll(".col-md-3");

    // Tambahkan container pagination setelah row buku
    const bookContainer = document.querySelector('.row');
    const paginationContainer = document.createElement('div');
    paginationContainer.className = 'pagination-container d-flex justify-content-center mt-4';
    bookContainer.parentNode.insertBefore(paginationContainer, bookContainer.nextSibling);

    function showPage(page) {
        const startIndex = (page - 1) * itemsPerPage;
        const endIndex = startIndex + itemsPerPage;
        let visibleCount = 0;

        books.forEach((book, index) => {
            const searchText = searchNama.value.toLowerCase();
            const selectedCategory = kategori.value.toLowerCase();
            const title = book.querySelector(".card-title").textContent.toLowerCase();
            const category = book.getAttribute("data-kategori").toLowerCase();

            const nameMatch = title.includes(searchText);
            const categoryMatch = selectedCategory === "" || category === selectedCategory;
            const isVisible = nameMatch && categoryMatch;

            if (isVisible) {
                visibleCount++;
                const shouldShow = visibleCount > startIndex && visibleCount <= endIndex;
                book.style.display = shouldShow ? "" : "none";
            } else {
                book.style.display = "none";
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
            const pageButton = createPaginationButton(i, true, i === currentPage);
            pageButton.addEventListener('click', () => {
                currentPage = i;
                showPage(currentPage);
            });
            paginationContainer.appendChild(pageButton);
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

    function filterBooks() {
        currentPage = 1; // Reset ke halaman pertama saat melakukan filter
        showPage(currentPage);
    }

    // Event listeners
    searchNama.addEventListener("input", filterBooks);
    kategori.addEventListener("change", filterBooks);

    // Tampilkan halaman pertama saat halaman dimuat
    showPage(currentPage);
});
</script>


@endsection
