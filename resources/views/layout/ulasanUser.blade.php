    @section('content')
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
            justify-content: space-between; /* Align items properly */
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

    <div class="container mt-5">
        <h3 class="mb-5 text-xl font-semibold">Ulasan Buku Anda</h3>

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
                            <p>{{ $item->book->ratings->first()->review }}</p>
                            @else
                            <p class="text-muted">Anda belum memberikan ulasan untuk buku ini.</p>
                            @endif
                        </div>

                        <a href="{{ $item->book->pdf_url }}" target="_blank" class="btn btn-info btn-sm w-100">
                            Baca Buku
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endsection
