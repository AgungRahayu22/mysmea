@section('content')
<!-- SweetAlert CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>
    .pagination-container {
    margin: 2rem 0;
}

.pagination-container button {
    min-width: 40px;
    height: 40px;
    border-radius: 4px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-weight: 500;
    transition: all 0.2s ease;
}

.pagination-container button:disabled {
    opacity: 0.5;
    cursor: not-allowed;
}

.pagination-container button.btn-primary {
    font-weight: bold;
}

.pagination-container span {
    display: inline-flex;
    align-items: center;
    color: #6c757d;
}
</style>
<div class="row mt-5">
    <div class="col-12">
        <div class="card w-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="fw-bold text-primary">Data Pengguna</h3>
                    <!-- Tombol Tambah Pengguna -->
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">
                        <i class="ti ti-plus"></i> Tambah Pengguna
                    </button>
                </div>

               @if (session('success'))
                    <script>
                        Swal.fire({
                            title: 'Sukses!',
                            text: '{{ session('success') }}',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        });
                    </script>
                @endif


                 <div class="d-flex mb-3">
                    <input type="text" id="searchNama" class="form-control me-2" placeholder="Cari berdasarkan nama">

                    <select id="jenis" class="form-control">
                        <option value="">Semua Role</option>
                        <option value="petugas">Petugas</option>
                        <option value="user">User</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>
                <!-- Tabel Pengguna -->
                <div class="table-responsive">
                  <table class="table table-striped" id="userTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Jenis Pengguna</th>
                                <th>Alamat</th>
                                <th>Telepon</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
    @foreach ($users as $index => $user)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $user->nama }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ ucfirst($user->jenis) }}</td>
            <td>{{ $user->alamat }}</td>
            <td>{{ $user->telepon }}</td>
            <td>
                @if ($user->jenis !== 'admin') <!-- Hanya petugas dan user yang bisa diedit/dihapus -->
                    <!-- Tombol Edit -->
                    <button class="btn btn-outline-primary btn-sm edit-button"
                        data-id="{{ $user->id }}"
                        data-name="{{ $user->nama }}"
                        data-email="{{ $user->email }}"
                        data-alamat="{{ $user->alamat }}"
                        data-telepon="{{ $user->telepon }}"
                        data-jenis="{{ $user->jenis }}"
                        data-bs-toggle="modal"
                        data-bs-target="#editUserModal">
                        <i class="ti ti-pencil"></i> Edit
                    </button>

                    <!-- Tombol Hapus -->
                    <form action="{{ route('admin.kelola.destroy', $user->id) }}" method="POST" style="display: inline;" class="delete-form">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">
                            <i class="ti ti-trash"></i> Hapus
                        </button>
                    </form>
                @endif
            </td>
        </tr>
    @endforeach
</tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal Tambah Pengguna -->
    <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                        <h5 class="modal-title" id="addUserModalLabel">Tambah Pengguna</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.kelola.store') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <!-- Form Input -->
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="text" name="nama" class="form-control" id="nama" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control" id="email" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" class="form-control" id="password" required>
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation">Konfirmasi Password</label>
                                <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" required>
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <input type="text" name="alamat" class="form-control" id="alamat" required>
                            </div>
                            <div class="form-group">
                                <label for="telepon">Telepon</label>
                                <input type="text" name="telepon" class="form-control" id="telepon" required>
                            </div>

                            <div class="form-group">
                                <label for="jenis">Jenis Pengguna</label>
                                <select name="jenis" class="form-control" id="jenis" required>
                                    <option value="" disabled selected>Pilih Jenis</option>
                                    <option value="petugas">Petugas</option>
                                    <option value="user">User</option>
                                    <option value="admin">Admin</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>

                    </form>
            </div>
        </div>
    </div>

    <!-- Modal Edit Pengguna -->
    <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="editForm" action="{{ route('admin.kelola.update', $user->id) }}" method="POST">
                @csrf
                @method('POST')
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserModalLabel">Edit Pengguna</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form Input -->
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" name="nama" class="form-control" id="nama" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control" id="email" required>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input type="text" name="alamat" class="form-control" id="alamat" required>
                    </div>
                    <div class="form-group">
                        <label for="telepon">Telepon</label>
                        <input type="text" name="telepon" class="form-control" id="telepon" required>
                    </div>
                    <div class="form-group">
                        <label for="jenis">Jenis Pengguna</label>
                        <select name="jenis" class="form-control" id="jenis" required>
                            <option value="" disabled selected>Pilih Jenis</option>
                            <option value="petugas">Petugas</option>
                            <option value="user">User</option>
                        </select>
                    </div>
                    <input type="hidden" id="user_id" name="user_id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary" id="saveButton">Perbarui</button>
                </div>
            </form>

            </div>
        </div>
    </div>
</div>
<script>
document.addEventListener("DOMContentLoaded", function () {
        const nama = document.querySelector("#searchNama"); // Input pencarian nama
        const jenis = document.querySelector("#jenis"); // Select filter role
        const tableRows = document.querySelectorAll("#userTable tbody tr"); // Semua baris tabel

        function filterTable() {
            const searchText = nama.value.toLowerCase();
            const selectedRole = jenis.value.toLowerCase();

            tableRows.forEach(row => {
                const name = row.querySelector("td:nth-child(2)").textContent.toLowerCase(); // Kolom Nama
                const role = row.querySelector("td:nth-child(4)").textContent.toLowerCase(); // Kolom Role

                const nameMatch = name.includes(searchText);
                const roleMatch = selectedRole === "" || role === selectedRole;

                row.style.display = nameMatch && roleMatch ? "" : "none";
            });
        }

        // Ganti ID input nama agar tidak bentrok
        nama.addEventListener("input", filterTable);
        jenis.addEventListener("change", filterTable);
    });
    document.addEventListener("DOMContentLoaded", function () {
        // Tangkap semua tombol edit
        const editButtons = document.querySelectorAll(".edit-button");

        editButtons.forEach(button => {
            button.addEventListener("click", function () {
                // Ambil data dari tombol yang diklik
                const userId = this.getAttribute("data-id");
                const userName = this.getAttribute("data-name");
                const userEmail = this.getAttribute("data-email");
                const userAlamat = this.getAttribute("data-alamat");
                const userTelepon = this.getAttribute("data-telepon");
                const userJenis = this.getAttribute("data-jenis");

                // Masukkan data ke dalam form edit
                document.querySelector("#editUserModal #user_id").value = userId;
                document.querySelector("#editUserModal #nama").value = userName;
                document.querySelector("#editUserModal #email").value = userEmail;
                document.querySelector("#editUserModal #alamat").value = userAlamat;
                document.querySelector("#editUserModal #telepon").value = userTelepon;
                document.querySelector("#editUserModal #jenis").value = userJenis;

                // Ubah action form agar sesuai dengan user ID
                document.querySelector("#editForm").action = `/admin/kelola/${userId}`;
            });
        });
    });
    document.addEventListener("DOMContentLoaded", function () {
    const deleteForms = document.querySelectorAll(".delete-form");

    deleteForms.forEach(form => {
        form.addEventListener("submit", function (e) {
            e.preventDefault(); // Mencegah pengiriman form langsung

            // Tampilkan SweetAlert konfirmasi
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: 'Data ini akan dihapus!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Hapus',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit(); // Jika konfirmasi, kirimkan form
                }
            });
        });
    });
});
document.addEventListener("DOMContentLoaded", function () {
    const itemsPerPage = 10; // Jumlah item per halaman
    let currentPage = 1;
    const nama = document.querySelector("#searchNama");
    const jenis = document.querySelector("#jenis");
    const tableRows = document.querySelectorAll("#userTable tbody tr");

    // Tambahkan container pagination setelah tabel
    const table = document.querySelector('#userTable');
    const paginationContainer = document.createElement('div');
    paginationContainer.className = 'pagination-container d-flex justify-content-center mt-4';
    table.parentNode.insertBefore(paginationContainer, table.nextSibling);

    function showPage(page) {
        const startIndex = (page - 1) * itemsPerPage;
        const endIndex = startIndex + itemsPerPage;
        let visibleCount = 0;

        tableRows.forEach(row => {
            const name = row.querySelector("td:nth-child(2)").textContent.toLowerCase();
            const role = row.querySelector("td:nth-child(4)").textContent.toLowerCase();
            const searchText = nama.value.toLowerCase();
            const selectedRole = jenis.value.toLowerCase();

            const nameMatch = name.includes(searchText);
            const roleMatch = selectedRole === "" || role === selectedRole;
            const isVisible = nameMatch && roleMatch;

            if (isVisible) {
                visibleCount++;
                const shouldShow = visibleCount > startIndex && visibleCount <= endIndex;
                row.style.display = shouldShow ? "" : "none";
            } else {
                row.style.display = "none";
            }
        });

        // Update nomor urut
        let counter = startIndex + 1;
        tableRows.forEach(row => {
            if (row.style.display !== "none") {
                row.querySelector("td:first-child").textContent = counter++;
            }
        });

        updatePagination(visibleCount);
    }

    function updatePagination(totalItems) {
        const totalPages = Math.ceil(totalItems / itemsPerPage);
        paginationContainer.innerHTML = '';

        if (totalPages <= 1) {
            return;
        }

        // Tombol Previous
        const prevButton = createPaginationButton('«', currentPage > 1);
        prevButton.addEventListener('click', () => {
            if (currentPage > 1) {
                currentPage--;
                showPage(currentPage);
            }
        });
        paginationContainer.appendChild(prevButton);

        // Nomor halaman
        for (let i = 1; i <= totalPages; i++) {
            if (totalPages <= 7 || i === 1 || i === totalPages ||
                (i >= currentPage - 1 && i <= currentPage + 1)) {
                const pageButton = createPaginationButton(i, true, i === currentPage);
                pageButton.addEventListener('click', () => {
                    currentPage = i;
                    showPage(currentPage);
                });
                paginationContainer.appendChild(pageButton);
            } else if (i === currentPage - 2 || i === currentPage + 2) {
                const ellipsis = document.createElement('span');
                ellipsis.className = 'mx-2';
                ellipsis.textContent = '...';
                paginationContainer.appendChild(ellipsis);
            }
        }

        // Tombol Next
        const nextButton = createPaginationButton('»', currentPage < totalPages);
        nextButton.addEventListener('click', () => {
            if (currentPage < totalPages) {
                currentPage++;
                showPage(currentPage);
            }
        });
        paginationContainer.appendChild(nextButton);
    }

    function createPaginationButton(text, enabled, isActive = false) {
        const button = document.createElement('button');
        button.className = `btn btn-sm mx-1 ${isActive ? 'btn-primary' : 'btn-outline-primary'}`;
        button.disabled = !enabled;
        button.textContent = text;
        return button;
    }

    function filterTable() {
        currentPage = 1; // Reset ke halaman pertama saat melakukan filter
        showPage(currentPage);
    }

    // Event listeners untuk filter
    nama.addEventListener("input", filterTable);
    jenis.addEventListener("change", filterTable);

    // Tampilkan halaman pertama saat halaman dimuat
    showPage(currentPage);
});
    </script>
@endsection
