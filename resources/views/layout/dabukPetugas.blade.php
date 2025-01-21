
@section('content')
<div class="row mt-5">
    <div class="col-12">
        <div class="card w-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="fw-bold text-primary">Pendataan Buku</h3>
                    <button class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#tambahBukuModal">
                        <i class="ti ti-plus"></i> Tambah Buku
                    </button>
                </div>

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="row">
                    @foreach($books as $book)
                        <div class="col-md-3 mb-4">
                            <div class="card">
                                <img src="{{ $book->image_url }}" alt="Gambar Buku" class="card-img-top" style="height: 400px; object-fit: cover;">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $book->judul }}</h5>
                                    <p class="card-text"><strong>Penulis:</strong> {{ $book->penulis }}</p>
                                    <p class="card-text"><strong>Penerbit:</strong> {{ $book->penerbit }}</p>
                                    <p class="card-text"><strong>Kategori:</strong> {{ $book->katagori }}</p>
                                    <p class="card-text"><strong>Tahun Terbit:</strong> {{ $book->tahun }}</p>
                                    <p class="card-text"><strong>Jumlah:</strong> {{ $book->jumlah }}</p>
                                    <p class="card-text"><strong>Deskripsi:</strong> {{ $book->deskripsi }}</p>

                                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                        <a href="{{ $book->pdf_url }}" class="btn btn-info btn-sm" target="_blank">
                                            <i class="ti ti-file"></i> Lihat PDF
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Buku -->
    <div class="modal fade" id="tambahBukuModal" tabindex="-1" aria-labelledby="tambahBukuModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('petugas.databuku.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahBukuModalLabel">Tambah Buku</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="judul" class="form-label">Judul Buku</label>
                            <input type="text" name="judul" class="form-control" id="judul" required>
                        </div>
                        <div class="mb-3">
                            <label for="penulis" class="form-label">Penulis</label>
                            <input type="text" name="penulis" class="form-control" id="penulis" required>
                        </div>
                        <div class="mb-3">
                            <label for="penerbit" class="form-label">Penerbit</label>
                            <input type="text" name="penerbit" class="form-control" id="penerbit" required>
                        </div>
                        <div class="mb-3">
                            <label for="katagori" class="form-label">Kategori</label>
                            <input type="text" name="katagori" class="form-control" id="katagori" required>
                        </div>
                        <div class="mb-3">
                            <label for="tahun" class="form-label">Tahun Terbit</label>
                            <input type="number" name="tahun" class="form-control" id="tahun" required>
                        </div>
                        <div class="mb-3">
                            <label for="jumlah" class="form-label">Jumlah</label>
                            <input type="number" name="jumlah" class="form-control" id="jumlah" required>
                        </div>
                        <div class="mb-3">
                            <label for="image_url" class="form-label">URL Gambar</label>
                            <input type="url" name="image_url" class="form-control" id="image_url" required>
                        </div>
                        <div class="mb-3">
                            <label for="pdf_url" class="form-label">URL PDF</label>
                            <input type="url" name="pdf_url" class="form-control" id="pdf_url" required>
                        </div>
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <input type="text" name="deskripsi" class="form-control" id="deskripsi" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection
