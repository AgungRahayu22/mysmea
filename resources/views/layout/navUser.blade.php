<header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
        <!-- Mobile Hamburger Menu -->
        <div class="mobile-menu-toggle d-lg-none">
            <button class="btn btn-outline-primary" id="mobileMenuToggle">
                <i class="fas fa-bars"></i>
            </button>
        </div>

        <!-- Logo -->
        <a href="" class="logo d-flex align-items-center">
            <img src="../assets/img/logomy.png" alt="MySmeaBooks Logo" class="img-fluid">
            <h1 class="sitename d-none d-md-block">MySmeaBooks</h1>
        </a>

        <!-- Navigation Links - Desktop -->
        <nav class="nav-links d-none d-lg-flex ms-auto me-5">
            <a href="{{ route ('user.pinjam') }}" class="nav-link ms-4">Home</a>
            <a href="{{ route('user.koleksi') }}" class="nav-link ms-4">Peminjaman</a>
            <a href="{{ route('user.favorit') }}" class="nav-link ms-4">Koleksi</a>
            <a href="{{ route ('user.ulasan') }}" class="nav-link ms-4">Ulasan</a>
        </nav>

        <!-- Profile Dropdown - Hidden on Mobile -->
        <div class="profile-dropdown d-none d-lg-flex align-items-center position-relative">
            <img src="https://c.pxhere.com/images/0f/3f/4dbc54d34a6b984a6c5f283be804-1447673.jpg!d" alt="Profile Picture"
                class="profile-pic img-fluid rounded-circle me-2"
                style="width: 40px; height: 40px; cursor: pointer;"
                id="profileDropdownToggle">

            <!-- Dropdown Menu -->
            <ul class="dropdown-menu position-absolute bg-white shadow" style="top: 50px; right: 0; display: none;" id="dropdownMenu">
                <li><a href=""  class="dropdown-item">{{ Auth::user()->nama }}</a></li>
                <li><a href="{{ route('logout') }}" onclick="confirmLogout(event)" class="dropdown-item">Log Out</a></li>
            </ul>
        </div>
    </div>

    <!-- Mobile Menu Overlay -->
    <div class="mobile-menu-overlay" id="mobileMenuOverlay">
        <div class="mobile-menu-content">
            <button class="btn-close" id="mobileMenuClose">&times;</button>
            <div class="mobile-nav-links">
                <a href="{{ route ('user.pinjam') }}" class="nav-link">Home</a>
                <a href="{{ route('user.koleksi') }}" class="nav-link">Peminjaman</a>
                <a href="{{ route('user.favorit') }}" class="nav-link">Koleksi</a>
                <a href="{{ route ('user.ulasan') }}" class="nav-link">Ulasan</a>

                <!-- Profile Info for Mobile -->
                <div class="mobile-profile-section mt-4 pt-3 border-top">
                    <p class="text-muted mb-2">{{ Auth::user()->nama }}</p>
                    <a href="{{ route('logout') }}" onclick="confirmLogout(event)" class="btn btn-outline-danger w-100">Log Out</a>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Base Styles */
        .header {
            background-color: #ffffff;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            padding: 15px 0;
            transition: all 0.3s ease;
        }

        .logo img {
            max-height: 40px;
            margin-right: 10px;
        }

        .sitename {
            font-size: 1.2rem;
            font-weight: 600;
            color: #333;
            margin: 0;
        }

        .nav-link {
            color: #333;
            text-decoration: none;
            margin: 0 10px;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .nav-link:hover {
            color: #007bff;
        }

        .profile-pic {
            object-fit: cover;
            border: 2px solid #f1f1f1;
            transition: transform 0.3s ease;
        }

        .profile-pic:hover {
            transform: scale(1.1);
        }

        /* Mobile Menu Overlay */
        .mobile-menu-toggle {
            z-index: 1050;
        }

        .mobile-menu-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.8);
            display: none;
            z-index: 1100;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .mobile-menu-content {
            background-color: white;
            width: 80%;
            max-width: 400px;
            height: 100%;
            position: absolute;
            right: 0;
            top: 0;
            padding: 20px;
            transform: translateX(100%);
            transition: transform 0.3s ease;
        }

        .mobile-menu-overlay.show {
            display: block;
            opacity: 1;
        }

        .mobile-menu-overlay.show .mobile-menu-content {
            transform: translateX(0);
        }

        .mobile-nav-links {
            display: flex;
            flex-direction: column;
            margin-top: 50px;
        }

        .mobile-nav-links .nav-link {
            padding: 15px 0;
            border-bottom: 1px solid #f1f1f1;
            font-size: 1.1rem;
        }

        .btn-close {
            position: absolute;
            top: 15px;
            right: 15px;
            font-size: 2rem;
            background: none;
            border: none;
            color: #333;
            cursor: pointer;
        }

        /* Mobile Profile Section */
        .mobile-profile-section {
            text-align: center;
        }

        /* Responsive Adjustments */
        @media (max-width: 991px) {
            .header {
                padding: 10px 0;
            }

            .logo img {
                max-height: 35px;
            }

            .sitename {
                font-size: 1rem;
            }
        }
    </style>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const profileDropdownToggle = document.getElementById('profileDropdownToggle');
        const dropdownMenu = document.getElementById('dropdownMenu');
        const mobileMenuToggle = document.getElementById('mobileMenuToggle');
        const mobileMenuOverlay = document.getElementById('mobileMenuOverlay');
        const mobileMenuClose = document.getElementById('mobileMenuClose');

        // Profile Dropdown - Desktop
        if (profileDropdownToggle) {
            profileDropdownToggle.addEventListener('click', function () {
                dropdownMenu.style.display = dropdownMenu.style.display === 'block' ? 'none' : 'block';
            });

            document.addEventListener('click', function (event) {
                if (!profileDropdownToggle.contains(event.target) && !dropdownMenu.contains(event.target)) {
                    dropdownMenu.style.display = 'none';
                }
            });
        }

        // Mobile Menu Toggle
        mobileMenuToggle.addEventListener('click', function () {
            mobileMenuOverlay.classList.add('show');
        });

        mobileMenuClose.addEventListener('click', function () {
            mobileMenuOverlay.classList.remove('show');
        });

        // Close mobile menu when clicking outside
        mobileMenuOverlay.addEventListener('click', function (event) {
            if (event.target === mobileMenuOverlay) {
                mobileMenuOverlay.classList.remove('show');
            }
        });
    });

    function confirmLogout(event) {
        event.preventDefault();
        Swal.fire({
            title: "Apakah Anda yakin?",
            text: "Anda akan logout dari sistem!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, logout!",
            cancelButtonText: "Batal"
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = event.target.href;
            }
        });
    }
    </script>

    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</header>
