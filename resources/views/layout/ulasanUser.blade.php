    @section('content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        .card {
            max-width: 180px;
            margin-bottom: 15px;
        }
        .card-img-top {
            width: 180px;
            height: 280px;
            object-fit: cover;
        }
        .card-body {
            padding: 0.75rem;
        }
        .card-title {
            font-size: 1rem;
            font-weight: bold;
            margin-bottom: 0.5rem;
        }
        .card-text {
            font-size: 0.875rem;
            margin-bottom: 0.25rem;
        }
        .btn-info {
            font-size: 0.875rem;
            padding: 0.5rem 0;
        }
        .rating-section h6 {
            font-size: 0.875rem;
            margin-bottom: 0.25rem;
        }
        .text-muted {
            font-size: 0.75rem;
        }
        .row {
            display: flex;
            flex-wrap: wrap;
            justify-content: start; /* Align items properly */
            gap: 15px; /* Add spacing between cards */
        }
        .col-custom {
            flex: 0 0 calc(16.66% - 15px); /* Six cards per row */
            max-width: calc(16.66% - 15px);
        }
        @media (max-width: 992px) {
            .col-custom {
                flex: 0 0 calc(33.33% - 15px); /* Three cards per row on medium screens */
                max-width: calc(33.33% - 15px);
            }
        }
        @media (max-width: 576px) {
            .col-custom {
                flex: 0 0 calc(50% - 15px); /* Two cards per row on small screens */
                max-width: calc(50% - 15px);
            }
        }
    </style>
    <style>
.review-text {
    position: relative;
    max-height: 4.5em; /* Sekitar 3 baris text */
    overflow: hidden;
    transition: max-height 0.3s ease-out;
}

.review-text.expanded {
    max-height: 1000px; /* Nilai besar untuk memastikan semua teks terlihat */
}

.show-more-btn {
    color: #007bff;
    background: none;
    border: none;
    padding: 2px 0;
    font-size: 0.8rem;
    cursor: pointer;
    display: inline-block;
    margin-top: 5px;
}

.show-more-btn:hover {
    text-decoration: underline;
}

.review-wrapper {
    margin-bottom: 10px;
}
</style>

    <div class="container mt-5">
        <h2 class="section-title mb-4"><i class="bi bi-star-fill text-primary"></i> Ulasan Saya</h2>
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

        <div class="row">
            @foreach ($koleksi as $item)
            <div class="col-custom">
                <div class="card shadow-sm rounded">
                    <img src="{{ $item->book->image_url }}" class="card-img-top" alt="Gambar Buku">
                    <div class="card-body">
                        <h5 class="card-title">{{ $item->book->judul }}</h5>
                        <p class="card-text text-muted"><strong>Penulis:</strong> {{ $item->book->penulis }}</p>
                        <p class="card-text text-muted"><strong>Tahun:</strong> {{ $item->book->tahun }}</p>

                        <!-- Rating dan Ulasan -->
                        <div class="rating-section">
                            @if($item->book->ratings->isNotEmpty())
                                <h6 class="font-weight-bold">Rating Anda:</h6>
                                <p>{{ $item->book->ratings->first()->rating }} / 5</p>
                                <h6 class="font-weight-bold">Ulasan:</h6>
                                <div class="review-wrapper">
                                    <div class="review-text" id="review-{{ $item->book->ratings->first()->id }}">
                                        {{ $item->book->ratings->first()->review }}
                                    </div>
                                    @if(strlen($item->book->ratings->first()->review) > 100)
                                        <button class="show-more-btn"
                                                onclick="toggleReview('review-{{ $item->book->ratings->first()->id }}', this)">
                                            Lihat Selengkapnya
                                        </button>
                                    @endif
                                </div>
                            @else
                                <p class="text-muted">Anda belum memberikan ulasan untuk buku ini.</p>
                            @endif
                        </div>
                        @if($item->book->ratings->isNotEmpty())
                            <form action="{{ route('ulasan.destroy', $item->book->ratings->first()->id) }}" method="POST" class="mt-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm w-100" onclick="return confirm('Apakah Anda yakin ingin menghapus ulasan ini?')">
                                    Hapus Ulasan
                                </button>
                            </form>
                        @endif


                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <script>
function toggleReview(reviewId, button) {
    const reviewElement = document.getElementById(reviewId);
    const isExpanded = reviewElement.classList.contains('expanded');

    if (isExpanded) {
        reviewElement.classList.remove('expanded');
        button.textContent = 'Lihat Selengkapnya';
    } else {
        reviewElement.classList.add('expanded');
        button.textContent = 'Lihat Lebih Sedikit';
    }
}
</script>
    @endsection
