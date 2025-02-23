@section('content')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
    .btn-outline-primary.active {
    background-color: #007bff;
    color: white;
}

.btn-outline-primary {
    margin: 0 2px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
}

.btn-outline-primary i {
    font-size: 0.9rem;
}
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
    /* Container untuk buku agar bisa discroll */
.buku-scroll-container {
    display: flex;
    gap: 15px;
    overflow-x: auto;
    scroll-snap-type: x mandatory;
    padding-bottom: 10px;
    white-space: nowrap;
}

/* Menghilangkan scrollbar di browser */
.buku-scroll-container::-webkit-scrollbar {
    display: none;
}

.buku-scroll-container {
    -ms-overflow-style: none;
    scrollbar-width: none;
}

/* Gaya setiap kartu buku */
.buku-scroll-container .card {
    flex: 0 0 auto;
    width: 150px;
    height: 350px;
    scroll-snap-align: start;
}
</style>
<style>
    .reviews-list .review-item {
        background-color: #f8f9fa;
        border-radius: 8px;
        margin-bottom: 10px;
    }
    .reviews-list .review-item strong {
        color: #007bff;
    }
</style>
<style>
.reviews-list .review-item {
    background-color: #f8f9fa;
    padding: 15px;
    border-radius: 8px;
    margin-bottom: 15px;
}

.reviews-list .review-item .reviewer-name {
    color: #007bff;
    font-weight: bold;
    margin-bottom: 5px;
}

.reviews-list .review-item .rating {
    color: #ffc107;
    margin-bottom: 8px;
}

.reviews-list .review-item .review-text {
    color: #6c757d;
    font-size: 0.95rem;
}

.no-reviews {
    text-align: center;
    padding: 20px;
    color: #6c757d;
    font-style: italic;
}
.reviews-container {
    max-height: 300px;
    overflow-y: auto;
    margin-bottom: 15px;
}

.reviews-container.collapsed {
    max-height: initial;
    overflow: hidden;
}

.show-more-btn {
    color: #007bff;
    background: none;
    border: none;
    padding: 8px 16px;
    cursor: pointer;
    font-weight: 500;
    display: flex;
    align-items: center;
    margin: 0 auto;
}

.show-more-btn:hover {
    text-decoration: underline;
}

.show-more-btn i {
    margin-left: 5px;
}

/* Styling untuk scrollbar */
.reviews-container::-webkit-scrollbar {
    width: 6px;
}

.reviews-container::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 3px;
}

.reviews-container::-webkit-scrollbar-thumb {
    background: #888;
    border-radius: 3px;
}

.reviews-container::-webkit-scrollbar-thumb:hover {
    background: #555;
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
                <img src="../assetss/images/bnweb2.png" class="d-block w-100 h-100" alt="Premium Package Banner">
            </div>
            <div class="carousel-item">
                <img src="../assetss/images/bnweb3.png" class="d-block w-100 h-100" alt="Premium Package Banner">
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
        <h2 class="section-title mb-4"><i class="bi bi-star-fill text-warning"></i> Buku </h2>
        <div class="d-flex mb-3">
            <input type="text" id="searchNama" class="form-control me-2" placeholder="Cari berdasarkan judul buku">
        </div>
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
                    <!-- Rating Buku -->
                    <div class="rating mt-2 text-warning">
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
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" >X</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-3 text-center">
                            <img id="modalImage" src="" alt="Gambar Buku" class="img-fluid rounded">
                        </div>
                        <div class="col-md-9">
                            <h4 id="modalTitle" class="mb-2"></h4>
                            <p><strong><i class="bi bi-person text-info"></i> Penulis:</strong> <span id="modalAuthor"></span></p>
                            <p><strong><i class="bi bi-calendar3 text-info"></i> Tahun:</strong> <span id="modalYear"></span></p>
                            <p><strong><i class="bi bi-calendar2 text-info"></i> Penerbit:</strong> <span id="modalPenerbit"></span></p>
                            <p><strong><i class="bi bi-calendar4 text-info"></i> Kategori:</strong> <span id="modalKategori"></span></p>
                            <p><strong><i class="bi bi-book text-info"></i> Jumlah Buku:</strong> <span id="modalTotal"></span></p>
                        </div>
                    </div>
                    <hr>
                    <h5><i class="bi bi-bookmark-check text-warning"></i> Deskripsi</h5>
                    <p id="modalDescription"></p>
                    <hr>
                    <h5><i class="bi bi-chat-dots text-warning"></i> Ulasan</h5>
                    <div id="reviewsContainer" class="reviews-list">
                        <!-- Ulasan akan dimuat di sini -->
                    </div>
                </div>
                <div class="modal-footer">
                    <form id="borrowForm" action="" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary"><i class="bi bi-journal-arrow-down"></i> Pinjam Buku</button>
                    </form>
                </div>
            </div>
        </div>
    </div>



</div>

<script>
function showBookDetail(book) {
    // Kode sebelumnya tetap sama
    document.getElementById('modalImage').src = book.image_url;
    document.getElementById('modalTitle').textContent = book.judul;
    document.getElementById('modalAuthor').textContent = book.penulis;
    document.getElementById('modalYear').textContent = book.tahun;
    document.getElementById('modalPenerbit').textContent = book.penerbit ? book.penerbit.nama_penerbit : 'Tidak ada data';
    document.getElementById('modalKategori').textContent = book.kategori ? book.kategori.nama_kategori : 'Tidak ada data';
    document.getElementById('modalTotal').textContent = book.jumlah;
    document.getElementById('modalDescription').textContent = book.deskripsi;
    document.getElementById('borrowForm').action = `/user/pinjam/${book.id}`;

    // Bagian ulasan
    const reviewsContainer = document.getElementById('reviewsContainer');
    reviewsContainer.innerHTML = ''; // Bersihkan ulasan sebelumnya

    if (book.ratings && book.ratings.length > 0) {
        // Buat container untuk ulasan dengan scroll
        const scrollContainer = document.createElement('div');
        scrollContainer.className = 'reviews-container collapsed';

        // Tampilkan hanya 2 ulasan pertama
        book.ratings.slice(0, 1).forEach(rating => {
            const reviewElement = createReviewElement(rating);
            scrollContainer.appendChild(reviewElement);
        });

        reviewsContainer.appendChild(scrollContainer);

        // Tambahkan tombol "Lihat Selengkapnya" jika ada lebih dari 2 ulasan
        if (book.ratings.length > 2) {
            const showMoreBtn = document.createElement('button');
            showMoreBtn.className = 'show-more-btn';
            showMoreBtn.innerHTML = 'Lihat Selengkapnya <i class="bi bi-chevron-down"></i>';

            let isExpanded = false;
            showMoreBtn.onclick = function() {
                if (!isExpanded) {
                    // Tampilkan semua ulasan
                    scrollContainer.innerHTML = ''; // Bersihkan container
                    book.ratings.forEach(rating => {
                        const reviewElement = createReviewElement(rating);
                        scrollContainer.appendChild(reviewElement);
                    });
                    scrollContainer.classList.remove('collapsed');
                    showMoreBtn.innerHTML = 'Lihat Lebih Sedikit <i class="bi bi-chevron-up"></i>';
                } else {
                    // Kembalikan ke 2 ulasan
                    scrollContainer.innerHTML = ''; // Bersihkan container
                    book.ratings.slice(0, 2).forEach(rating => {
                        const reviewElement = createReviewElement(rating);
                        scrollContainer.appendChild(reviewElement);
                    });
                    scrollContainer.classList.add('collapsed');
                    showMoreBtn.innerHTML = 'Lihat Selengkapnya <i class="bi bi-chevron-down"></i>';
                }
                isExpanded = !isExpanded;
            };

            reviewsContainer.appendChild(showMoreBtn);
        }
    } else {
        reviewsContainer.innerHTML = `
            <div class="no-reviews">
                <i class="bi bi-chat-dots me-2"></i>
                Belum ada ulasan untuk buku ini
            </div>
        `;
    }
}

// Fungsi helper untuk membuat elemen ulasan
function createReviewElement(rating) {
    const reviewElement = document.createElement('div');
    reviewElement.className = 'review-item';

    // Buat tampilan bintang
    let stars = '';
    for (let i = 1; i <= 5; i++) {
        if (i <= rating.rating) {
            stars += '<i class="bi bi-star-fill"></i>';
        } else {
            stars += '<i class="bi bi-star"></i>';
        }
    }

    reviewElement.innerHTML = `
        <div class="reviewer-name">
            <i class="bi bi-person-circle"></i> ${rating.user ? rating.user.nama : 'Anonim'}
        </div>
        <div class="rating text-warning">
            ${stars}
        </div>
        <div class="review-text">
            "${rating.review}"
        </div>
    `;

    return reviewElement;
}
function fetchBookReviews(book) {
    const reviewsContainer = document.getElementById('reviewsContainer');
    reviewsContainer.innerHTML = ''; // Bersihkan ulasan sebelumnya

    if (book.ratings && book.ratings.length > 0) {
        book.ratings.forEach(review => {
            const reviewElement = document.createElement('div');
            reviewElement.classList.add('review-item', 'mb-3', 'p-3', 'border', 'rounded');

            reviewElement.innerHTML = `
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <strong class="text-primary">${review.user ? review.user.name : 'Anonim'}</strong>
                </div>
                <p class="mb-0">${review.review}</p>
            `;

            reviewsContainer.appendChild(reviewElement);
        });
    } else {
        reviewsContainer.innerHTML = `
            <div class="text-center text-muted p-3">
                <i class="bi bi-chat-dots"></i> Belum ada ulasan untuk buku ini
            </div>
        `;
    }
}
document.getElementById('searchNama').addEventListener('keyup', function() {
    let filter = this.value.toLowerCase();
    let cards = document.querySelectorAll('.buku-populer-container .card');

    cards.forEach(card => {
        let title = card.querySelector('.card-title').textContent.toLowerCase();
        if (title.includes(filter)) {
            card.style.display = "block";
        } else {
            card.style.display = "none";
        }
    });
});
// Pagination functionality
document.addEventListener('DOMContentLoaded', function() {
    const itemsPerPage = 14; // Number of books to show per page
    const bookContainer = document.querySelector('.buku-populer-container');
    const bookCards = Array.from(bookContainer.querySelectorAll('.card'));
    const searchInput = document.getElementById('searchNama');

    let filteredBooks = bookCards;

    // Create pagination elements
    const paginationContainer = document.createElement('div');
    paginationContainer.classList.add('d-flex', 'justify-content-center', 'mt-4');
    bookContainer.parentNode.insertBefore(paginationContainer, bookContainer.nextSibling);

    function renderPagination(totalPages, currentPage) {
        paginationContainer.innerHTML = '';

        // Previous button
        if (currentPage > 1) {
            const prevButton = document.createElement('button');
            prevButton.classList.add('btn', 'btn-outline-primary', 'me-2');
            prevButton.innerHTML = '<i class="bi bi-chevron-left"></i>';
            prevButton.addEventListener('click', () => changePage(currentPage - 1));
            paginationContainer.appendChild(prevButton);
        }

        // Page numbers
        for (let i = 1; i <= totalPages; i++) {
            const pageButton = document.createElement('button');
            pageButton.classList.add('btn', 'btn-outline-primary', 'me-2');
            pageButton.textContent = i;

            if (i === currentPage) {
                pageButton.classList.add('active');
            }

            pageButton.addEventListener('click', () => changePage(i));
            paginationContainer.appendChild(pageButton);
        }

        // Next button
        if (currentPage < totalPages) {
            const nextButton = document.createElement('button');
            nextButton.classList.add('btn', 'btn-outline-primary');
            nextButton.innerHTML = '<i class="bi bi-chevron-right"></i>';
            nextButton.addEventListener('click', () => changePage(currentPage + 1));
            paginationContainer.appendChild(nextButton);
        }
    }

    function displayBooks(page) {
        const startIndex = (page - 1) * itemsPerPage;
        const endIndex = startIndex + itemsPerPage;

        // Hide all books first
        bookCards.forEach(card => card.style.display = 'none');

        // Show books for current page
        filteredBooks
            .slice(startIndex, endIndex)
            .forEach(card => card.style.display = 'block');
    }

    function changePage(page) {
        const totalPages = Math.ceil(filteredBooks.length / itemsPerPage);
        displayBooks(page);
        renderPagination(totalPages, page);
    }

    // Initial setup
    function initPagination() {
        const totalPages = Math.ceil(filteredBooks.length / itemsPerPage);
        displayBooks(1);
        renderPagination(totalPages, 1);
    }

    // Search functionality with pagination
    searchInput.addEventListener('keyup', function() {
        let filter = this.value.toLowerCase();

        // Filter books
        filteredBooks = bookCards.filter(card => {
            let title = card.querySelector('.card-title').textContent.toLowerCase();
            return title.includes(filter);
        });

        // Reinitialize pagination with filtered results
        const totalPages = Math.ceil(filteredBooks.length / itemsPerPage);
        displayBooks(1);
        renderPagination(totalPages, 1);
    });

    // Initial pagination setup
    initPagination();
});


</script>
@endsection
