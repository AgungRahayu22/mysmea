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
  <style>
    .btn {
    padding: 8px 16px;
    border: 2px solid #e5e7eb;
    border-radius: 25px;
    text-decoration: none;
    margin: 10px;
    }

    .btn-login {
    background-color: #5D87FF;
    color: white;
    border-color: #5D87FF;
    }

    .btn-register {
    background-color: white;
    color: #5D87FF;
    border-color: #5D87FF;
    }
    .btn-login:hover {
    background-color: #5D87FF;
    color: white;
    border-color: #5D87FF;
    }

    .btn-register:hover {
    background-color: white;
    color: #5D87FF;
    border-color: #5D87FF;
    }
    </style>

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
          <li><a href="{{ route('home') }}" >Home</a></li>
          <li><a href="{{ route('about') }}"class="active">About</a></li>
          <li><a href="#team">Book</a></li>
          <a class="btn btn-login px-4 py-2 rounded-lg text-white" href="{{ route('login') }}">
                Log In
            </a>
            <a class="btn btn-register px-4 py-2 rounded-lg text-blue-600" href="{{ route('register') }}">
                Register
            </a>
        </ul>

        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>

      </nav>




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
    <section id="about" class="section about">

      <div class="container">

        <div class="row gy-3">

          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
            <img src="assets/img/undraw_organize-resume_ihw6.svg" alt="" class="img-fluid">
          </div>

          <div class="col-lg-6 d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="200">
            <div class="about-content ps-0 ps-lg-3">
              <h3>MySmeaBooks memberikan pengalaman membaca yang menyenangkan dengan akses mudah ke berbagai buku dan sumber belajar</h3>
              <ul>
                <li>
                  <i class="bi bi-diagram-3"></i>
                  <div>
                    <h4>Akses mudah ke buku dan materi pembelajaran di </h4>
                    <p>MySmeaBooks untuk pengalaman belajar yang efisien.</p>
                  </div>
                </li>
                <li>
                  <i class="bi bi-fullscreen-exit"></i>
                  <div>
                    <h4>MySmeaBooks memberikan kemudahan akses </h4>
                    <p>ke berbagai sumber belajar tanpa batas.</p>
                  </div>
                </li>
              </ul>
              <p>
                Nikmati akses mudah ke buku dan materi pembelajaran yang mendukung proses belajar Anda di MySmeaBooks. Temukan berbagai sumber pengetahuan yang membantu, tanpa hambatan, untuk pengalaman belajar yang lebih baik
              </p>
            </div>

          </div>
        </div>

      </div>

    </section><!-- /About Section -->




    <!-- Services Section -->
    <section id="services" class="services section light-background">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Services</h2>
        <p>Kami menyediakan layanan terbaik di MySmeaBooks untuk memastikan pengalaman belajar Anda berjalan lancar dan menyenangkan.</p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row gy-4">

          <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="100">
            <div class="service-item position-relative">
              <div class="icon"><i class="bi bi-activity icon"></i></div>
              <h4><a href="#services" class="stretched-link">Akses Buku Digital</a></h4>
            <p>MySmeaBooks menyediakan akses mudah ke ribuan buku digital untuk mendukung proses belajar Anda.</p>
            </div>
          </div><!-- End Service Item -->

          <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="200">
            <div class="service-item position-relative">
              <div class="icon"><i class="bi bi-bounding-box-circles icon"></i></div>
              <h4><a href="#services" class="stretched-link">Kategori Buku yang Beragam</a></h4>
                <p>Temukan buku berdasarkan kategori seperti pelajaran, literatur, referensi, dan masih banyak lagi.</p>
            </div>
          </div><!-- End Service Item -->

          <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="300">
            <div class="service-item position-relative">
              <div class="icon"><i class="bi bi-calendar4-week icon"></i></div>
              <h4><a href="#services" class="stretched-link">Fitur Bookmark</a></h4>
                <p>Simpan buku favorit Anda untuk memudahkan akses di lain waktu.</p>
            </div>
          </div><!-- End Service Item -->

          <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="400">
            <div class="service-item position-relative">
              <div class="icon"><i class="bi bi-broadcast icon"></i></div>
              <h4><a href="#services" class="stretched-link">Dukungan Pengguna</a></h4>
                <p>Tim kami siap membantu Anda dengan pertanyaan atau masalah terkait MySmeaBooks.</p>
            </div>
          </div><!-- End Service Item -->

        </div>

      </div>

    </section><!-- /Services Section -->



    <!-- Faq Section -->
    <section id="faq" class="faq section light-background">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Frequently Asked Questions</h2>
        <p>Beberapa Pertanyaan yang sering ditanyakan</p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row">

          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">

            <div class="faq-container">

              <div class="faq-item">
                <h3>Apa itu MySmeaBooks?</h3>
                <div class="faq-content">
                  <p>MySmeaBooks adalah platform perpustakaan digital yang dirancang untuk memberikan akses mudah ke berbagai buku dan materi pembelajaran bagi siswa dan guru.</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div><!-- End Faq item-->

              <div class="faq-item">
                <h3>Bagaimana cara mendaftar di MySmeaBooks?</h3>
                <div class="faq-content">
                  <p>Anda dapat mendaftar dengan mengklik tombol "Register" di halaman utama dan mengisi formulir pendaftaran dengan informasi yang diperlukan.</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div><!-- End Faq item-->

              <div class="faq-item">
                <h3>Apa saja buku yang tersedia di MySmeaBooks?</h3>
                <div class="faq-content">
                    <p>Kami menyediakan berbagai macam buku pelajaran, literatur, dan sumber belajar lainnya yang sesuai dengan kebutuhan pendidikan siswa.</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div><!-- End Faq item-->

            </div>

          </div><!-- End Faq Column-->

          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">

            <div class="faq-container">

              <div class="faq-item">
                <h3>Siapa saja yang bisa menggunakan MySmeaBooks?</h3>
                <div class="faq-content">
                  <p>MySmeaBooks dapat digunakan oleh siswa, guru, dan siapa saja yang ingin mengakses buku serta sumber belajar digital.</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div><!-- End Faq item-->

              <div class="faq-item">
                <h3>Apakah saya bisa menyimpan daftar buku favorit di MySmeaBooks?</h3>
                <div class="faq-content">
                    <p>Tentu! Anda bisa menandai buku favorit Anda dan menyimpannya di daftar pribadi untuk akses cepat di masa mendatang.</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div><!-- End Faq item-->

              <div class="faq-item">
                <h3>Apakah ada batasan jumlah buku yang bisa dibaca?</h3>
                <div class="faq-content">
                  <p>Tidak ada batasan untuk membaca buku secara online. Anda bebas membaca sebanyak yang Anda mau!</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div><!-- End Faq item-->

            </div>

          </div><!-- End Faq Column-->

        </div>

      </div>

    </section><!-- /Faq Section -->

    <!-- Team Section -->


    <!-- Clients Section -->


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
