<aside class="left-sidebar">
      <!-- Sidebar scroll-->
      <div>
        <div class="brand-logo d-flex align-items-center justify-content-center mt-8">
          <a href="#" class="text-nowrap logo-img">
            <img src="../assets/img/logomy.png" width="180" alt="" />
          </a>
          <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
            <i class="ti ti-x fs-8"></i>
          </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
          <ul id="sidebarnav">
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Home</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{ route('petugas.dabuk') }}" aria-expanded="false">
                <span>
                  <i class="ti ti-books"></i>
                </span>
                <span class="hide-menu">Pendataan Buku</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{ route('petugas.kategori') }}" aria-expanded="false">
                <span>
                  <i class="ti ti-category"></i>
                </span>
                <span class="hide-menu">Kategori</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{ route('petugas.penerbit') }}" aria-expanded="false">
                <span>
                  <i class="ti ti-sun"></i>
                </span>
                <span class="hide-menu">Penerbit</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{ route('petugas.laporan') }}" aria-expanded="false">
                <span>
                  <i class="ti ti-book"></i>
                </span>
                <span class="hide-menu">Laporan Buku</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{ route('logout') }}" aria-expanded="false" onclick="confirmLogout(event)">
                <span>
                  <i class="ti ti-login"></i>
                </span>
                <span class="hide-menu">Log out</span>
              </a>
            </li>
          </ul>

        </nav>
        <!-- End Sidebar navigation -->
      </div>
      <!-- End Sidebar scroll-->
    </aside>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
  function confirmLogout(event) {
    event.preventDefault(); // Mencegah logout langsung
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
        window.location.href = event.target.href; // Redirect ke logout jika dikonfirmasi
      }
    });
  }
</script>
