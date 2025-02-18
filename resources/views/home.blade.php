<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>MySmeaBooks</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="assets/img/logomy.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">


  <!-- Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Ninestars
  * Template URL: https://bootstrapmade.com/ninestars-free-bootstrap-3-theme-for-creative/
  * Updated: Aug 07 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="index-page">

  <header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

      <a href="index.html" class="logo d-flex align-items-center me-auto">
        <img src="assets/img/logomy.png" alt="MySmeaBooks Logo" class="img-fluid">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.png" alt=""> -->
        <h1 class="sitename">MySmeaBooks</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="#hero" class="active">Home</a></li>
          <li><a href="{{ route('about') }}">About</a></li>
          <li><a href="#team">Book</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

        <a class="btn-getstarted" href="{{ route('login') }}">Log In</a>
        <a class="btn-getstarted" href="{{ route('register') }}">Register</a>


    </div>
  </header>

  <main class="main">

    <!-- Hero Section -->
    <section id="hero" class="section hero light-background">
    <div class="container">
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
    </div>
    </section>


    <!-- About Section -->


    <section id="team" class="team section">
        <div class="container section-title" data-aos="fade-up">
            <h2>Book</h2>
            <p>Mari mulai petualangan membaca Anda di MySmeaBooks, tempat penuh pengetahuan yang siap untuk dijelajahi!</p>
        </div>

        <div class="container">
        <div class="row gy-3 justify-content-start">
            @foreach ($books->take(4) as $book)
                <div class="col-lg-3 col-md-3 col-sm-4 col-6 text-center" data-aos="fade-up" data-aos-delay="100">
                    <div class="member" data-bs-toggle="modal" data-bs-target="#bookDetailModal{{ $book->id }}">
                        <img src="{{ $book->image_url }}" class="img-fluid book-image rounded" alt="{{ $book->judul }}">
                        <div class="member-info d-flex align-items-center justify-content-center">
                            <div class="member-info-content">
                                <h6 class="text-truncate text-center text-white">{{ $book->judul }}</h6>
                                <span class="d-block text-center">{{ $book->penulis }}</span>
                                <div class="rating mt-2 text-warning d-flex justify-content-center">
                                    @php
                                        $rating = round($book->averageRating());
                                    @endphp
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= $rating)
                                            <i class="bi bi-star-fill"></i>
                                        @else
                                            <i class="bi bi-star"></i>
                                        @endif
                                    @endfor
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                    <!-- Modal untuk setiap buku -->
                    <div class="modal fade" id="bookDetailModal{{ $book->id }}" tabindex="-1" aria-labelledby="bookDetailModalLabel{{ $book->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered"> <!-- Modal di tengah layar -->
                        <div class="modal-content">
                            <!-- Header -->
                            <div class="modal-header bg-outline-primary text-white">
                                <h5 class="modal-title" id="bookDetailModalLabel{{ $book->id }}">
                                    <i class="bi bi-book"></i> {{ $book->judul }}
                                </h5>
                            </div>

                            <!-- Body -->
                            <div class="modal-body">
                                <div class="row">
                                    <!-- Gambar Buku -->
                                    <div class="col-md-5 text-center">
                                        <img src="{{ $book->image_url }}" class="img-fluid rounded shadow-lg" alt="{{ $book->judul }}">
                                    </div>

                                    <!-- Detail Buku -->
                                    <div class="col-md-7 " data-kategori="{{ $book->kategori }}">
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
                                            <li class="list-group-item"><strong>Deskripsi:</strong> {{ $book->deskripsi }}</li>
                                        </ul>

                                        <!-- Tombol Aksi -->
                                        <div class="mt-4 d-flex gap-2">
                                            <a href="{{ route('login') }}" class="btn btn-primary flex-grow-1">
                                                <i class="bi bi-book"></i> Baca Buku
                                            </a>
                                            <a href="{{ route('login') }}" class="btn btn-outline-primary flex-grow-1">
                                                <i class="bi bi-journal-arrow-down"></i> Pinjam Buku
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                <i class="bi bi-x-circle"></i> Tutup
                                            </button>
                                        </div>

                        </div>
                    </div>
                </div>

                @endforeach
            </div>
        </div>
    </section>

    <section id="team" class="team section">
        <div class="container section-title" data-aos="fade-up">
            <h2>Buku Terbaru</h2>
            <p>Mari mulai petualangan membaca Anda di MySmeaBooks, dengan membaca buku terbaru!</p>
        </div>

        <div class="container">
        <div class="row gy-3 justify-content-start">
            @foreach ($books->sortByDesc('created_at')->take(4) as $book)
                <div class="col-lg-3 col-md-3 col-sm-4 col-6 text-center" data-aos="fade-up" data-aos-delay="100">
                    <div class="member" data-bs-toggle="modal" data-bs-target="#bookDetailModal{{ $book->id }}">
                        <img src="{{ $book->image_url }}" class="img-fluid book-image rounded" alt="{{ $book->judul }}">
                        <div class="member-info d-flex align-items-center justify-content-center">
                            <div class="member-info-content">
                                <h6 class="text-truncate text-center text-white">{{ $book->judul }}</h6>
                                <span class="d-block text-center">{{ $book->penulis }}</span>
                                <div class="rating mt-2 text-warning d-flex justify-content-center">
                                    @php
                                        $rating = round($book->averageRating());
                                    @endphp
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= $rating)
                                            <i class="bi bi-star-fill"></i>
                                        @else
                                            <i class="bi bi-star"></i>
                                        @endif
                                    @endfor
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                    <!-- Modal untuk setiap buku -->
                    <div class="modal fade" id="bookDetailModal{{ $book->id }}" tabindex="-1" aria-labelledby="bookDetailModalLabel{{ $book->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered"> <!-- Modal di tengah layar -->
                        <div class="modal-content">
                            <!-- Header -->
                            <div class="modal-header bg-outline-primary text-white">
                                <h5 class="modal-title" id="bookDetailModalLabel{{ $book->id }}">
                                    <i class="bi bi-book"></i> {{ $book->judul }}
                                </h5>
                            </div>

                            <!-- Body -->
                            <div class="modal-body">
                                <div class="row">
                                    <!-- Gambar Buku -->
                                    <div class="col-md-5 text-center">
                                        <img src="{{ $book->image_url }}" class="img-fluid rounded shadow-lg" alt="{{ $book->judul }}">
                                    </div>

                                    <!-- Detail Buku -->
                                    <div class="col-md-7 " data-kategori="{{ $book->kategori }}">
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
                                            <li class="list-group-item"><strong>Deskripsi:</strong> {{ $book->deskripsi }}</li>
                                        </ul>

                                        <!-- Tombol Aksi -->
                                        <div class="mt-4 d-flex gap-2">
                                            <a href="{{ route('login') }}" class="btn btn-primary flex-grow-1">
                                                <i class="bi bi-book"></i> Baca Buku
                                            </a>
                                            <a href="{{ route('login') }}" class="btn btn-outline-primary flex-grow-1">
                                                <i class="bi bi-journal-arrow-down"></i> Pinjam Buku
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                <i class="bi bi-x-circle"></i> Tutup
                                            </button>
                                        </div>

                        </div>
                    </div>
                </div>

                @endforeach
            </div>
        </div>
    </section>


    <section id="team" class="team section">
        <div class="container section-title" data-aos="fade-up">
            <h2>Buku Populer</h2>
            <p>Mari mulai petualangan membaca Anda di MySmeaBooks,dengan membaca buku terpopuler !</p>
        </div>

        <div class="container">
        <div class="row gy-3 justify-content-start">
            @foreach ($books->sortByDesc('tahun')->take(4) as $book)
                <div class="col-lg-3 col-md-3 col-sm-4 col-6 text-center" data-aos="fade-up" data-aos-delay="100">
                    <div class="member" data-bs-toggle="modal" data-bs-target="#bookDetailModal{{ $book->id }}">
                        <img src="{{ $book->image_url }}" class="img-fluid book-image rounded" alt="{{ $book->judul }}">
                        <div class="member-info d-flex align-items-center justify-content-center">
                            <div class="member-info-content">
                                <h6 class="text-truncate text-center text-white">{{ $book->judul }}</h6>
                                <span class="d-block text-center">{{ $book->penulis }}</span>
                                <div class="rating mt-2 text-warning d-flex justify-content-center">
                                    @php
                                        $rating = round($book->averageRating());
                                    @endphp
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= $rating)
                                            <i class="bi bi-star-fill"></i>
                                        @else
                                            <i class="bi bi-star"></i>
                                        @endif
                                    @endfor
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                    <!-- Modal untuk setiap buku -->
                    <div class="modal fade" id="bookDetailModal{{ $book->id }}" tabindex="-1" aria-labelledby="bookDetailModalLabel{{ $book->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered"> <!-- Modal di tengah layar -->

                        <div class="modal-content">
                            <!-- Header -->
                            <div class="modal-header bg-outline-primary text-white">
                                <h5 class="modal-title" id="bookDetailModalLabel{{ $book->id }}">
                                    <i class="bi bi-book"></i> {{ $book->judul }}
                                </h5>
                            </div>

                            <!-- Body -->
                            <div class="modal-body">
                                <div class="row">
                                    <!-- Gambar Buku -->
                                    <div class="col-md-5 text-center">
                                        <img src="{{ $book->image_url }}" class="img-fluid rounded shadow-lg" alt="{{ $book->judul }}">
                                    </div>

                                    <!-- Detail Buku -->
                                    <div class="col-md-7 " data-kategori="{{ $book->kategori }}">
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
                                            <li class="list-group-item"><strong>Deskripsi:</strong> {{ $book->deskripsi }}</li>
                                        </ul>

                                        <!-- Tombol Aksi -->
                                        <div class="mt-4 d-flex gap-2">
                                            <a href="{{ route('login') }}" class="btn btn-primary flex-grow-1">
                                                <i class="bi bi-book"></i> Baca Buku
                                            </a>
                                            <a href="{{ route('login') }}" class="btn btn-outline-primary flex-grow-1">
                                                <i class="bi bi-journal-arrow-down"></i> Pinjam Buku
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                <i class="bi bi-x-circle"></i> Tutup
                                            </button>
                                        </div>

                        </div>
                    </div>
                </div>

                @endforeach
            </div>
        </div>
    </section>







    <!-- Team Section -->




  </main>

  <footer id="footer" class="footer position-relative">

    <div class="container footer-top">
      <div class="row gy-4">
        <div class="col-lg-4 col-md-6 footer-about">
          <a href="index.html" class="d-flex align-items-center">
            <span class="sitename">Agung Rahayu</span>
          </a>
          <div class="footer-contact pt-3">
            <p>Sinartanjung</p>
            <p>Kota Banjar</p>
            <p class="mt-3"><strong>No handphone:</strong> <span>0831 1669 3777</span></p>
            <p><strong>Email:</strong> <span>agungrahayu99600@gmail.com</span></p>
          </div>
        </div>

        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Useful Links</h4>
          <ul>
            <li><i class="bi bi-chevron-right"></i> <a href="#">Home</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="#about">About us</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="#team">Book</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="#services">Service</a></li>
          </ul>
        </div>

        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Our Services</h4>
          <ul>
            <li><i class="bi bi-chevron-right"></i> <a href="#">Web Design</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="#">Web Development</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="#">Product Management</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="#">Marketing</a></li>
          </ul>
        </div>

        <div class="col-lg-4 col-md-12">
          <h4>Follow Us</h4>
          <p>Ikuti akun media sosial saya</p>
          <div class="social-links d-flex">
            <a href=""><i class="bi bi-github"></i></a>
            <a href=""><i class="bi bi-whatsapp"></i></a>
            <a href=""><i class="bi bi-instagram"></i></a>
            <a href=""><i class="bi bi-linkedin"></i></a>
          </div>
        </div>

      </div>
    </div>

    <div class="container copyright text-center mt-4">
      <p>© <span>Created by |</span> <strong class="px-1 sitename">Agung rahayu</strong></p>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you've purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
        Designed by <a href="#">Agsa Design</a>
      </div>
    </div>

  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>
