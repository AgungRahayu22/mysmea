<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Buku</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
        }
        .logo {
            display: flex;
            align-items: center;
        }
        .logo img {
            max-height: 100px;
            margin-right: 20px;
        }
        .report-title {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px 12px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="logo">
            <img src="../assets/img/logomy.png" alt="">
            <h1>LAPORAN PERPUSTAKAAN</h1>
        </div>
        <div class="logo">
            <img src="../assets/img/logomy.png" alt="Logo Sekolah">
        </div>
    </div>

    <div class="report-title">
        <h2>Laporan Data Buku</h2>
        <p>Periode: Semester Genap 2024/2025</p>
    </div>

    <h3>Buku Per Tahun Terbit</h3>
    <table>
        <thead>
            <tr>
                <th>Tahun</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bukuPerTahun as $tahun)
                <tr>
                    <td>{{ $tahun->tahun }}</td>
                    <td>{{ $tahun->jumlah }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>


    <h3>Buku Per Kategori</h3>
    <table>
        <thead>
            <tr>
                <th>Kategori</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bukuPerKatagori as $katagori)
                <tr>
                    <td>{{ $katagori->katagori }}</td>
                    <td>{{ $katagori->jumlah }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>


    <h3>Buku Paling Banyak Dipinjam</h3>
    <table>
        <thead>
            <tr>
                <th>Judul</th>
                <th>Jumlah Peminjaman</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bukuPalingDipinjam as $buku)
                <tr>
                    <td>{{ $buku->judul }}</td>
                    <td>{{ $buku->peminjaman_bukus_count }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>


    <h3>User Paling Banyak Meminjam Buku</h3>
    <table>
        <thead>
            <tr>
                <th>Nama User</th>
                <th>Jumlah Peminjaman</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($userPalingBanyakMeminjam as $user)
                <tr>
                    <td>{{ $user->nama }}</td>
                    <td>{{ $user->jumlah_peminjaman }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div style="display: flex; justify-content: space-between; margin-top: 40px;">
        <div style="text-align: center;">
            <p>Mengetahui,<br>Kepala Perpustakaan</p>
            <p style="margin-top: 80px;">________________</p>
        </div>
        <div style="text-align: center;">
            <p>Penanggung Jawab,<br>Staff Perpustakaan</p>
            <p style="margin-top: 80px;">________________</p>
        </div>
    </div>
</body>
</html>
