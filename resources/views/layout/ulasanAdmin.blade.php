<div class="row mt-5">
    <!-- Ulasan Buku -->
    <div class="col-12">
        <div class="card w-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="fw-bold text-primary">Ulasan Buku</h3>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Pengulas</th>
                                <th>Judul Buku</th>
                                <th>Rating</th>
                                <th>Komentar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($ratings as $rating)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $rating->user->nama }}</td>
                                <td>{{ $rating->book->judul }}</td>
                                 <td>
                                    <!-- Menampilkan Rating dalam format teks -->
                                    {{ $rating->rating }} / 5
                                </td>
                                <td>{{ $rating->review }}</td>
                                <td>
                                    <!-- Form untuk Hapus Rating -->
                                    <form action="{{ route('admin.deleteRating', $rating->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus rating ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
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
</div>
