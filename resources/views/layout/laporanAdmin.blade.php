@section('content')
<!-- Font Awesome CDN -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

<div class="row mt-5">
    <div class="col-12">
        <div class="card w-100">
            <div class="card-body">
    <h3 class="fw-bold text-primary">
        Laporan Buku
    </h3>

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 mb-4">
        <!-- Daftar Buku Per Tahun Terbit -->
        <div class="col">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <div class="text-white bg-primary rounded-circle p-4 d-flex align-items-center justify-content-center mx-auto" style="width: 70px; height: 70px;">
                        <i class="fas fa-calendar-alt fa-lg"></i>
                    </div>
                    <h5 class="mt-3 fw-semibold">Daftar Buku Per Tahun Terbit</h5>
                    <button class="btn btn-primary btn-sm mt-3" data-bs-toggle="modal" data-bs-target="#detailModalTahun">Detail</button>
                </div>
            </div>
        </div>

        <!-- Modal Detail Daftar Buku Per Tahun Terbit -->
        <div class="modal fade" id="detailModalTahun" tabindex="-1" aria-labelledby="detailModalLabelTahun" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="detailModalLabelTahun">Detail Buku Per Tahun Terbit</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @foreach($bukuPerTahun as $tahun)
                            <p><strong>Tahun:</strong> {{ $tahun->tahun }} - <strong>Jumlah Buku:</strong> {{ $tahun->jumlah }}</p>
                        @endforeach
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-danger" onclick="exportPDFTahun()">
                            <i class="fas fa-file-pdf"></i> Export PDF
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Daftar Buku Per Kategori -->
        <div class="col">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <div class="text-white bg-success rounded-circle p-4 d-flex align-items-center justify-content-center mx-auto" style="width: 70px; height: 70px;">
                        <i class="fas fa-tags fa-lg"></i>
                    </div>
                    <h5 class="mt-3 fw-semibold">Daftar Buku Per Kategori</h5>
                    <button class="btn btn-primary btn-sm mt-3" data-bs-toggle="modal" data-bs-target="#detailModalKatagori">Detail</button>
                </div>
            </div>
        </div>

        <!-- Modal Detail Daftar Buku Per Kategori -->
        <div class="modal fade" id="detailModalKatagori" tabindex="-1" aria-labelledby="detailModalLabelKatagori" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="detailModalLabelKatagori">Detail Buku Per Kategori</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @foreach($bukuPerKategori as $kategori)
                            <p><strong>Kategori:</strong> {{ $kategori->kategori->nama_kategori ?? '-' }} -
                            <strong>Jumlah Buku:</strong> {{ $kategori->jumlah }}</p>
                        @endforeach

                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-danger" onclick="exportPDFKategori()">
                            <i class="fas fa-file-pdf"></i> Export PDF
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Daftar Buku yang Paling Banyak Dipinjam -->
        <div class="col">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <div class="text-white bg-warning rounded-circle p-4 d-flex align-items-center justify-content-center mx-auto" style="width: 70px; height: 70px;">
                        <i class="fas fa-book-reader fa-lg"></i>
                    </div>
                    <h5 class="mt-3 fw-semibold">Daftar Buku yang Paling Banyak Dipinjam</h5>
                    <button class="btn btn-primary btn-sm mt-3" data-bs-toggle="modal" data-bs-target="#detailModalBuku">Detail</button>
                </div>
            </div>
        </div>

        <!-- Modal Detail Daftar Buku yang Paling Banyak Dipinjam -->
        <div class="modal fade" id="detailModalBuku" tabindex="-1" aria-labelledby="detailModalLabelBuku" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="detailModalLabelBuku">Detail Buku yang Paling Banyak Dipinjam</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @foreach($bukuPalingDipinjam as $buku)
                            <p><strong>Judul:</strong> {{ $buku->judul }} - <strong>Jumlah Peminjaman:</strong> {{ $buku->peminjaman_bukus_count }}</p>
                        @endforeach
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-danger" onclick="exportPDFBukuPopuler()">
                            <i class="fas fa-file-pdf"></i> Export PDF
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Daftar User yang Paling Banyak Meminjam Buku -->
        <div class="col">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <div class="text-white bg-info rounded-circle p-4 d-flex align-items-center justify-content-center mx-auto" style="width: 70px; height: 70px;">
                        <i class="fas fa-users fa-lg"></i>
                    </div>
                    <h5 class="mt-3 fw-semibold">Daftar User yang Paling Banyak Meminjam Buku</h5>
                    <button class="btn btn-primary btn-sm mt-3" data-bs-toggle="modal" data-bs-target="#detailModalUser">Detail</button>
                </div>
            </div>
        </div>

        <!-- Modal Detail Daftar User yang Paling Banyak Meminjam Buku -->
        <div class="modal fade" id="detailModalUser" tabindex="-1" aria-labelledby="detailModalLabelUser" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="detailModalLabelUser">Detail User yang Paling Banyak Meminjam Buku</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @foreach($userPalingBanyakMeminjam as $user)
                            <p><strong>Nama User:</strong> {{ $user->nama }} - <strong>Jumlah Peminjaman:</strong> {{ $user->jumlah_peminjaman }}</p>
                        @endforeach
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-danger" onclick="exportPDFUserAktif()">
                            <i class="fas fa-file-pdf"></i> Export PDF
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
        </div>
        </div>
</div><!-- jsPDF CDN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.19/jspdf.plugin.autotable.min.js"></script>

<script>
// Export PDF untuk Buku Per Tahun
function exportPDFTahun() {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();

    // Judul PDF
    doc.setFontSize(18);
    doc.text('Laporan Buku Per Tahun', 14, 20);
    doc.setFontSize(12);

    const bukuPerTahunData = [];
    @foreach($bukuPerTahun as $tahun)
        bukuPerTahunData.push(['{{ $tahun->tahun }}', '{{ $tahun->jumlah }}']);
    @endforeach

    doc.autoTable({
        startY: 30,
        head: [['Tahun', 'Jumlah Buku']],
        body: bukuPerTahunData,
        theme: 'striped'
    });

    doc.save('laporan buku pertahun.pdf');
}

// Export PDF untuk Buku Per Kategori
function exportPDFKategori() {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();

    doc.setFontSize(18);
    doc.text('Laporan Buku Per Kategori', 14, 20);
    doc.setFontSize(12);

    const bukuPerKategoriData = [];
    @foreach($bukuPerKategori as $kategori)
        bukuPerKategoriData.push(['{{ $kategori->kategori->nama_kategori ?? "-" }}', '{{ $kategori->jumlah }}']);
    @endforeach

    doc.autoTable({
        startY: 30,
        head: [['Kategori', 'Jumlah Buku']],
        body: bukuPerKategoriData,
        theme: 'striped'
    });

    doc.save('laporan buku perkategori.pdf');
}

// Export PDF untuk Buku Paling Banyak Dipinjam
function exportPDFBukuPopuler() {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();

    doc.setFontSize(18);
    doc.text('Laporan Buku Paling Banyak Dipinjam', 14, 20);
    doc.setFontSize(12);

    const bukuDipinjamData = [];
    @foreach($bukuPalingDipinjam as $buku)
        bukuDipinjamData.push(['{{ $buku->judul }}', '{{ $buku->peminjaman_bukus_count }}']);
    @endforeach

    doc.autoTable({
        startY: 30,
        head: [['Judul Buku', 'Jumlah Peminjaman']],
        body: bukuDipinjamData,
        theme: 'striped'
    });

    doc.save('laporan buku yang paling banyak dipinjam.pdf');
}

// Export PDF untuk User Paling Banyak Meminjam
function exportPDFUserAktif() {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();

    doc.setFontSize(18);
    doc.text('Laporan User Paling Aktif Meminjam', 14, 20);
    doc.setFontSize(12);

    const userDipinjamData = [];
    @foreach($userPalingBanyakMeminjam as $user)
        userDipinjamData.push(['{{ $user->nama }}', '{{ $user->jumlah_peminjaman }}']);
    @endforeach

    doc.autoTable({
        startY: 30,
        head: [['Nama User', 'Jumlah Peminjaman']],
        body: userDipinjamData,
        theme: 'striped'
    });

    doc.save('laporan user peminjam yang paling banyak.pdf');
}
</script>


@endsection
