<!DOCTYPE html>
<html>
<head>
    <title>Laporan Buku</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        th, td {
            padding: 8px 12px;
            text-align: left;
            border: 1px solid #ddd;
        }
    </style>
</head>
<body>
    <h1>Laporan Buku</h1>

    <h2>Buku Per Tahun Terbit</h2>
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

    <h2>Buku Per Kategori</h2>
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

    <h2>Buku Paling Banyak Dipinjam</h2>
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

    <h2>User Paling Banyak Meminjam Buku</h2>
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
</body>
</html>
