@section('content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        transition: all 0.3s ease-in-out;
    }
    .section-title {
        font-weight: bold;
        font-size: 1.5rem;
    }
    .card {
        border: none;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        text-align: center;
        display: flex;
        flex-direction: column;
        height: 520px;
        width: 280px;
    }
    .card-img-top {
        width: 180px;
        height: 280px; /* Ukuran tetap untuk gambar */
        object-fit: cover; /* Menjaga proporsi gambar */
        border-radius: 0.25rem 0.25rem 0 0;
    }
    .card-body {
        padding: 1rem;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }
    .card-title {
        font-size: 1rem;
        font-weight: bold;
        margin-bottom: 0.5rem;
    }
    .card-text small {
        font-size: 0.85rem;
        color: #6c757d;
    }
    .btn-primary {
        font-size: 0.85rem;
    }
    .row {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
    }
</style>

<div class="container mt-5">
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
    <h2 class="section-title mb-4"><i class="bi bi-bookmarks-fill text-primary"></i> Koleksi Saya</h2>

    @if($koleksi->isEmpty())
        <div class="text-center text-muted py-5">
            <p class="fs-5">Anda belum memiliki koleksi buku yang dipinjam.</p>
        </div>
    @else
        <div class="row">
            @foreach($koleksi as $item)
                <div class="card shadow-sm">
                    <img src="{{ $item->book->image_url }}" class="card-img-top" alt="Gambar Buku">
                    <div class="card-body">
                        <h6 class="card-title text-truncate">
                            <i class="bi bi-book text-primary"></i> {{ $item->book->judul }}
                        </h6>
                        <small>
                            <i class="bi bi-person text-secondary"></i> {{ $item->book->penulis }}
                        </small>
                        <p class="card-text mt-2 mb-3">
                            <strong><i class="bi bi-calendar2 text-info"></i> Tahun:</strong> {{ $item->book->tahun }}
                        </p>
                        <div class="mt-auto d-grid gap-2">
                            <a href="{{ $item->book->pdf_url }}" target="_blank" class="btn btn-primary btn-sm">
                                <i class="bi bi-file-earmark-pdf"></i> Baca Buku
                            </a>
                            <form action="{{ route('peminjaman.return', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin mengembalikan buku ini?')">
                                @csrf
                                <button type="submit" class="btn btn-warning btn-sm">
                                    <i class="bi bi-arrow-clockwise"></i> Kembalikan
                                </button>
                            </form>
                            <form action="" method="POST">
                                @csrf
                            <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#ratingModal" onclick="setBookId({{ $item->book->id }})">
                                <i class="bi bi-star"></i> Rating
                            </button>
                            </form>
                        </div>

                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
<!-- Modal Rating -->
<div class="modal fade" id="ratingModal" tabindex="-1" aria-labelledby="ratingModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('book.rating') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="ratingModalLabel">Berikan Rating</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="bookId" name="book_id">
                    <div class="mb-3 text-center">
                        <label for="rating" class="form-label">Rating:</label>
                        <div id="starRating">
                            @for($i = 1; $i <= 5; $i++)
                                <i class="bi bi-star" data-value="{{ $i }}"></i>
                            @endfor
                        </div>
                        <input type="hidden" id="ratingInput" name="rating" required>
                    </div>
                    <div class="mb-3">
                        <label for="review" class="form-label">Ulasan:</label>
                        <textarea class="form-control" id="review" name="review" rows="3" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Kirim</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    // Menyimpan ID Buku ke dalam Modal
    function setBookId(bookId) {
        document.getElementById('bookId').value = bookId;
    }

    // Mengatur interaksi bintang
    document.addEventListener('DOMContentLoaded', function () {
        const stars = document.querySelectorAll('#starRating .bi-star');
        stars.forEach(star => {
            star.addEventListener('click', function () {
                const ratingValue = this.getAttribute('data-value');
                document.getElementById('ratingInput').value = ratingValue;

                // Reset warna bintang
                stars.forEach(s => s.classList.remove('text-warning'));

                // Tambahkan warna ke bintang yang dipilih dan sebelumnya
                for (let i = 0; i < ratingValue; i++) {
                    stars[i].classList.add('text-warning');
                }
            });
        });
    });
</script>

@endsection
