@section('content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
    .card {
        border: none;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        text-align: center;
        display: flex;
        flex-direction: column;
        height: 450px;
        width: 180px;
        border-radius: 10px;
        overflow: hidden;
        margin-bottom: 20px;
        transition: transform 0.3s ease;
    }

    .card-img-top {
        width: 100%;
        height: 250px;
        object-fit: cover;
    }

    .card-body {
        padding: 1rem;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        flex-grow: 1;
    }

    .row {
        display: flex;
        flex-wrap: wrap;
        justify-content: start;
        gap: 15px;
    }

    .card-body .mt-auto {
        margin-top: auto;
        width: 100%;
        padding-top: 10px;
    }
</style>

<div class="container mt-5">
    <h2 class="section-title mb-4">
        <i class="bi bi-heart-fill text-danger"></i> Buku Favorit Saya
    </h2>

    @if($favorites->isEmpty())
        <div class="text-center text-muted py-5">
            <p class="fs-5">Anda belum memiliki buku favorit.</p>
        </div>
    @else
        <div class="row">
            @foreach($favorites as $favorite)
                <div class="card shadow-sm">
                    <img src="{{ $favorite->book->image_url }}" class="card-img-top" alt="Gambar Buku">
                    <div class="card-body">
                        <h6 class="card-title text-truncate">
                            <i class="bi bi-book text-primary"></i> {{ $favorite->book->judul }}
                        </h6>
                        <small>
                            <i class="bi bi-person text-secondary"></i> {{ $favorite->book->penulis }}
                        </small>
                        <p class="card-text mt-2 mb-3">
                            <strong><i class="bi bi-calendar2 text-info"></i> Tahun:</strong> {{ $favorite->book->tahun }}
                        </p>

                        <a href="{{ route('user.pinjam') }}" class="btn btn-outline-primary btn-sm w-100">Pinjam Buku</a>
                        <div class="mt-1">
                            <button onclick="konfirmasiHapus('{{ route('user.hapus-favorit', $favorite->book->id) }}')"
                                    class="btn btn-outline-danger btn-sm w-100">
                                <i class=""></i> Hapus Favorit
                            </button>
                        </div>

                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Show success message if exists
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session('success') }}',
            timer: 3000,
            showConfirmButton: false
        });
    @endif
});

function konfirmasiHapus(url) {
    Swal.fire({
        title: 'Apakah Anda yakin?',
        text: "Buku akan dihapus dari daftar favorit Anda",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            // Create form element
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = url;

            // Add CSRF token
            const csrfToken = document.createElement('input');
            csrfToken.type = 'hidden';
            csrfToken.name = '_token';
            csrfToken.value = '{{ csrf_token() }}';
            form.appendChild(csrfToken);

            // Add method DELETE
            const methodField = document.createElement('input');
            methodField.type = 'hidden';
            methodField.name = '_method';
            methodField.value = 'DELETE';
            form.appendChild(methodField);

            // Append form to body and submit
            document.body.appendChild(form);
            form.submit();
        }
    });
}
</script>
@endsection
