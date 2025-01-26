@section('content')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        transition: all 0.3s ease-in-out;
    }
    .card-title {
        font-weight: bold;
        font-size: 1rem;
    }
    .carousel-item img {
        height: 400px;
        object-fit: cover;
    }
    .section-title {
        font-weight: bold;
        font-size: 1.5rem;
    }
    .btn-outline-primary {
        border-color: #007bff;
        color: #007bff;
    }
    .btn-outline-primary:hover {
        background-color: #007bff;
        color: white;
    }
    .card-img-top {
        height: 200px;
        object-fit: cover;
        width: 150px;
    }
    .card-body {
        padding: 1rem;
    }
    .card-title {
        font-size: 0.9rem;
    }
    .card-text small {
        font-size: 0.8rem;
    }
    .buku-populer-container {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
        gap: 20px;
        justify-content: center;
        padding: 10px;
    }
    .card {
        width: 150px;
        height: 350px;
    }
    .card-body {
        height: 150px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }
    .modal-header {
        background-color: #f8f9fa;
        border-bottom: 1px solid #dee2e6;
    }
    .modal-body h4 {
        font-weight: bold;
        margin-bottom: 10px;
    }
    .img-fluid {
        max-width: 100%;
        height: auto;
    }
    .modal-footer button {
        min-width: 100px;
    }
    hr {
        margin: 1.5rem 0;
    }
    p {
        margin-bottom: 0.5rem;
    }
    .badge {
        font-size: 0.75rem;
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
    <!-- Slider Premium Package -->
    <div id="premiumSlider" class="carousel slide mb-5" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="../assets/img/undraw_collaborators_rgw4.svg" class="d-block w-100" alt="Premium Package Banner">
            </div>
            <div class="carousel-item">
                <img src="../assets/img/undraw_collaborators_rgw4.svg" class="d-block w-100" alt="Premium Package Banner">
            </div>
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#premiumSlider" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#premiumSlider" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <!-- Buku Populer -->
    <div class="mb-5">
        <h2 class="section-title mb-4"><i class="bi bi-star-fill text-warning"></i> Buku Populer</h2>
        <div class="buku-populer-container">
            @foreach($books as $book)
            <div class="card h-100 shadow-sm border-0" data-bs-toggle="modal" data-bs-target="#detailModal" onclick="showBookDetail({{ json_encode($book) }})">
                <img src="{{ $book->image_url }}" alt="Gambar Buku" class="card-img-top">
                <div class="card-body d-flex flex-column">
                    <h6 class="card-title text-truncate mb-1">
                        <i class="bi bi-book text-primary"></i> {{ $book->judul }}
                    </h6>
                    <small class="text-muted mb-2"><i class="bi bi-person text-secondary"></i> {{ $book->penulis }}</small>
                    <p class="card-text text-muted mb-auto">
                        <small><strong><i class="bi bi-calendar2 text-info"></i> Tahun:</strong> {{ $book->tahun }}</small>
                    </p>
                    <div class="d-flex justify-content-between mt-2">
                        <button class="btn btn-outline-danger btn-sm">
                            <i class="bi bi-heart"></i>
                        </button>
                            <form action="{{ route('user.pinjam', ['bookId' => $book->id]) }}" method="POST">
                                @csrf
                                <button class="btn btn-primary btn-sm">
                                    <i class="bi bi-book"></i> Pinjam
                                </button>
                            </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailModalLabel">
                        <i class="bi bi-info-circle-fill text-primary"></i> Detail Buku
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-3 text-center">
                            <img id="modalImage" src="path/to/book-image.jpg" alt="Gambar Buku" class="img-fluid rounded">
                        </div>
                        <div class="col-md-9">
                            <h4 id="modalTitle" class="mb-2"></h4>
                            <p><strong><i class="bi bi-person text-info"></i> Penulis:</strong> <span id="modalAuthor"></span></p>
                            <p><strong><i class="bi bi-calendar2 text-info"></i> Tahun:</strong> <span id="modalYear"></span></p>
                            <p><strong><i class="bi bi-calendar4 text-info"></i> Katagori:</strong> <span id="modalKatagori"></span></p>
                            <p><strong><i class="bi bi-book text-info"></i> Jumlah Buku:</strong> <span id="modalTotal"></span></p>
                            <p><strong>Sedang Dipinjam Oleh:</strong> 2 Orang</p>
                            <p>
                                <strong><i class="bi bi-star-fill text-warning"></i> Rating:</strong>
                                <span class="text-warning">
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-half"></i>
                                    <i class="bi bi-star"></i>
                                </span>
                                <small>(3.5 dari 5)</small>
                            </p>
                        </div>
                    </div>
                    <hr>
                    <h5><i class="bi bi-bookmark-check text-warning"></i> Deskripsi</h5>
                    <p id="modalDescription">Kita semua tahu bahwa naskah kuno Nusantara merupakan salah satu warisa...</p>
                    <hr>
                    <h5><i class="bi bi-chat-dots text-success"></i> Ulasan</h5>
                    <div class="reviews">
                        <div class="review mb-3">
                            <p><strong>John Doe</strong> </p>
                            <p>"Buku ini sangat informatif dan mudah dipahami!"</p>
                            <span class="text-warning">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star"></i>
                                <i class="bi bi-star"></i>
                            </span>
                        </div>
                </div>
                <div class="modal-footer">
                    <form id="borrowForm" action="" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary">Pinjam Buku</button>
                    </form>
                </div>
            </div>
        </div>
    </div>



</div>

<script>
function showBookDetail(book) {
    document.getElementById('modalImage').src = book.image_url;
    document.getElementById('modalTitle').textContent = book.judul;
    document.getElementById('modalAuthor').textContent = book.penulis;
    document.getElementById('modalYear').textContent = book.tahun;
    document.getElementById('modalKatagori').textContent = book.katagori;
    document.getElementById('modalTotal').textContent = book.jumlah;
    document.getElementById('modalDescription').textContent = book.deskripsi ;
    document.getElementById('borrowForm').action = `/user/pinjam/${book.id}`;
}

</script>
@endsection
