@section('content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="row mt-5">
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
    <!-- Peminjaman Buku -->
    <div class="col-12">
        <div class="card w-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="fw-bold text-primary">Peminjaman Buku</h3>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Peminjam</th>
                                <th>Judul Buku</th>
                                <th>Tanggal Pinjam</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($peminjaman as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->user->nama }}</td>  <!-- Menampilkan nama peminjam -->
                                <td>{{ $item->book->judul }}</td>
                                <td>{{ $item->tanggal_pinjam->format('d-m-Y') }}</td> <!-- Menampilkan tanggal pinjam -->

                                <td>
                                    @if($item->tanggal_kembali) <!-- Jika tanggal kembali ada, status "Dikembalikan" -->
                                    <span class="badge bg-success">Dikembalikan</span>
                                    @else
                                    <span class="badge bg-warning">Belum Dikembalikan</span>
                                    @endif
                                </td>
                                    <td>
                                        <form action="{{ route('peminjaman.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus peminjaman ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger">
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
</div>
@endsection
