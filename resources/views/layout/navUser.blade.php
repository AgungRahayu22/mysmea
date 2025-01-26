<header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
        <!-- Logo -->
        <a href="/" class="logo d-flex align-items-center">
            <img src="../assets/img/logomy.png" alt="MySmeaBooks Logo" class="img-fluid">
            <h1 class="sitename">MySmeaBooks</h1>
        </a>

        <!-- Search Bar -->
        <form class="search-bar d-flex mx-auto" style="width: 40%;">
            <input type="text" class="form-control me-2" placeholder="Search book">
            <button type="submit" class="btn btn-primary"><i class="bi bi-search"></i></button>
        </form>

        <!-- Navigation Links -->
        <nav class="nav-links d-flex ms-auto me-5">
            <a href="{{ route ('user.pinjam') }}" class="nav-link ms-4">Home</a>
            <a href="{{ route('user.koleksi') }}" class="nav-link ms-4">Koleksi</a>
            <a href="{{ route ('user.ulasan') }}" class="nav-link ms-4">Ulasan</a>
        </nav>

        <!-- Profile Dropdown -->
        <div class="profile-dropdown d-flex align-items-center position-relative">
            <img src="https://static.promediateknologi.id/crop/48x391:694x1294/750x500/webp/photo/p1/981/2023/11/03/freedom-242033905.jpeg" alt="Profile Picture"
                class="profile-pic img-fluid rounded-circle me-2"
                style="width: 40px; height: 40px; cursor: pointer;"
                id="profileDropdownToggle">
            <span>{{ Auth::user()->nama }}</span>

            <!-- Dropdown Menu -->
            <ul class="dropdown-menu position-absolute bg-white shadow" style="top: 50px; right: 0; display: none;" id="dropdownMenu">
                <li><a href="{{ route('logout') }}" class="dropdown-item">Log Out</a></li>
            </ul>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const profileDropdownToggle = document.getElementById('profileDropdownToggle');
        const dropdownMenu = document.getElementById('dropdownMenu');

        profileDropdownToggle.addEventListener('click', function () {
            dropdownMenu.style.display = dropdownMenu.style.display === 'block' ? 'none' : 'block';
        });

        document.addEventListener('click', function (event) {
            if (!profileDropdownToggle.contains(event.target) && !dropdownMenu.contains(event.target)) {
                dropdownMenu.style.display = 'none';
            }
        });
    });
    </script>
</header>
