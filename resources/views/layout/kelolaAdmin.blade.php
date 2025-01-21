@section('content')
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
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Tabel Pengguna -->
                <div class="table-responsive">
                    <table class="table table-striped">
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
                                        <!-- Tombol Edit -->
                                        <button class="btn btn-warning btn-sm edit-button"
                                            data-id="{{ $user->id }}"
                                            data-name="{{ $user->nama }}"
                                            data-email="{{ $user->email }}"
                                            data-alamat="{{ $user->alamat }}"
                                            data-telepon="{{ $user->telepon }}"
                                            data-jenis="{{ $user->jenis }}"
                                            data-bs-toggle="modal"
                                            data-bs-target="#editUserModal">
                                            Edit
                                        </button>



                                        <!-- Tombol Hapus -->
                                        <form action="{{ route('admin.kelola.destroy', $user->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?')">
                                                <i class="ti ti-trash"></i> Hapus
                                            </button>
                                        </form>
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
                                    <option value="admin">Admin</option>
                                    <option value="petugas">Petugas</option>
                                    <option value="user">User</option>
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
                            <option value="admin">Admin</option>
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
@endsection
