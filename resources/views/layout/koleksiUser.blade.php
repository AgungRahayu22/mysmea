@section('content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease-in-out;
    }
    .section-title {
        font-weight: bold;
        font-size: 1.75rem;
        margin-bottom: 1rem;
    }
    .container {
    padding-left: 10px;
    padding-right: 10px;
}

    .card {
        border: none;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        text-align: center;
        display: flex;
        flex-direction: column;
        height: auto;
        width: 180px;
        border-radius: 10px;
        overflow: hidden;
         margin-bottom: 10px;
    }
    .card-img-top {
        width: 100%;
        height: 220px;
        object-fit: cover;
    }
    .card-body {
        padding: 1rem;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }
    .card-title {
        font-size: 1.1rem;
        font-weight: bold;
        margin-bottom: 0.5rem;
        text-overflow: ellipsis;
        overflow: hidden;
        white-space: nowrap;
    }
    .card-text small {
        font-size: 0.85rem;
        color: #6c757d;
    }
    .btn-primary {
        font-size: 0.85rem;
        transition: all 0.2s;
    }
    .btn-primary:hover {
        background-color: #0069d9;
    }
    .btn-sm {
        font-size: 0.8rem;
    }
    .row {
        display: flex;
        flex-wrap: wrap;
        justify-content: start;
        gap: 10px; /* Kurangi jaraknya */
    }


    .card-body p {
        font-size: 0.9rem;
        color: #333;
    }
    .text-muted {
        font-size: 0.85rem;
    }
</style>
<!-- Tambahkan style -->
<style>
    .pdf-container {
        position: relative;
        width: 100%;
        height: 88vh; /* Ukuran tinggi disesuaikan */
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

    /* Perbaikan styling modal */
    .modal-lg {
        max-width: 800px;
    }

    /* Custom scrollbar tetap sama */
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
</style>
<style>
.btn-outline-danger:hover .bi-heart {
    transform: scale(1.2);
    transition: transform 0.2s ease;
}

.btn-outline-danger .bi-heart-fill {
    color: #dc3545;
}
</style>
<style>
#starRating .bi-star-fill {
    color: #ffc107; /* Warna kuning untuk bintang terisi */
    transition: color 0.2s ease;
}

#starRating .bi-star {
    color: #6c757d; /* Warna abu-abu untuk bintang kosong */
    transition: color 0.2s ease;
}

#starRating .bi-star:hover,
#starRating .bi-star:hover ~ .bi-star {
    color: #ffc107; /* Warna kuning saat hover */
    cursor: pointer;
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
    <h2 class="section-title mb-2">
        <i class="bi bi-bookmarks-fill text-primary"></i> Buku Peminjaman Saya
    </h2>

    <div class="alert alert-info d-flex align-items-center p-3 rounded-3 shadow-sm mb-4">
        <i class="bi bi-info-circle-fill text-primary me-3 fs-4"></i>
        <div>
            <h6 class="alert-heading fw-semibold mb-1">Informasi Durasi Peminjaman</h6>
            <p class="mb-0">Buku hanya boleh dipinjam selama maksimal <span class="fw-semibold">7 hari</span>.</p>
        </div>
    </div>
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
                           <!-- Ganti link baca buku -->
                        <!-- Ganti tombol baca buku yang lama dengan ini -->
                        <a href="{{ route('baca.buku', $item->book->id) }}" class="btn btn-primary btn-sm w-100" target="_blank">
                            <i class="bi bi-file-earmark-pdf"></i> Baca Buku
                        </a>
                            <form action="{{ route('peminjaman.return', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin mengembalikan buku ini?')">
                                @csrf
                                <button type="submit" class="btn btn-outline-secondary btn-sm w-100">
                                    <i class="bi bi-arrow-clockwise"></i> Kembalikan
                                </button>
                            </form>
                            @php
                                $hasRated = $item->book->ratings->where('user_id', Auth::id())->count() > 0;
                            @endphp

                            @if(!$hasRated)
                                <form action="" method="POST">
                                    @csrf
                                    <button type="button" class="btn btn-outline-warning btn-sm w-100"
                                            data-bs-toggle="modal"
                                            data-bs-target="#ratingModal"
                                            onclick="setBookId({{ $item->book->id }})">
                                        <i class="bi bi-star"></i> Rating
                                    </button>
                                </form>
                            @else
                                <button type="button" class="btn btn-outline-warning btn-sm w-100" disabled>
                                    <i class="bi bi-star-fill"></i> Sudah Dirating
                                </button>
                            @endif
                            @php
                                $isFavorited = Auth::user()->favorit()->where('book_id', $item->book->id)->exists();
                            @endphp

                            @if($isFavorited)
                                <form action="{{ route('user.hapus-favorit', $item->book->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm w-100">
                                        <i class="bi bi-heart-fill"></i> Hapus Favorit
                                    </button>
                                </form>
                            @else
                                <form action="{{ route('user.tambah-favorit', $item->book->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-danger btn-sm w-100">
                                        <i class="bi bi-heart"></i> Favorit
                                    </button>
                                </form>
                            @endif
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

<!-- Update Modal PDF -->
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


<script>
document.addEventListener('DOMContentLoaded', function() {
    // Star Rating Functionality
    const starRating = document.getElementById('starRating');
    const ratingInput = document.getElementById('ratingInput');
    const stars = starRating.querySelectorAll('.bi-star');

    // Function to set stars
    function setStars(rating) {
        stars.forEach((star, index) => {
            if (index < rating) {
                star.classList.remove('bi-star');
                star.classList.add('bi-star-fill');
            } else {
                star.classList.remove('bi-star-fill');
                star.classList.add('bi-star');
            }
        });
    }

    // Add click event to each star
    stars.forEach((star, index) => {
        star.addEventListener('click', function() {
            const rating = parseInt(this.dataset.value);
            ratingInput.value = rating;
            setStars(rating);
        });

        // Add hover effect
        star.addEventListener('mouseover', function() {
            const hoverRating = parseInt(this.dataset.value);
            setStars(hoverRating);
        });
    });

    // Reset to selected rating when mouse leaves
    starRating.addEventListener('mouseleave', function() {
        const currentRating = ratingInput.value ? parseInt(ratingInput.value) : 0;
        setStars(currentRating);
    });

    // Function to set book ID in the modal
    window.setBookId = function(bookId) {
        document.getElementById('bookId').value = bookId;
        // Reset rating when modal opens
        ratingInput.value = '';
        stars.forEach(star => {
            star.classList.remove('bi-star-fill');
            star.classList.add('bi-star');
        });
    };
});
</script>

@endsection
