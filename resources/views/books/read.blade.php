<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Baca Buku</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html, body {
            height: 100%;
            width: 100%;
            font-family: Arial, sans-serif;
        }

        .app-container {
            position: relative;
            width: 100%;
            height: 100%;
            max-width: 1200px;
            margin: 0 auto;
        }

        .pdf-container {
            position: relative;
            width: 100%;
            height: calc(100% - 50px);
            overflow: hidden;
        }

        .pdf-viewer {
            width: 100%;
            height: 100%;
            border: none;
            filter: blur(20px);
            transition: filter 0.3s ease;
            object-fit: contain;
        }

        .pdf-container:hover .pdf-viewer {
            filter: blur(0);
        }

        /* Mencegah seleksi teks */
        .pdf-viewer {
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        .back-button {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 50px;
            background-color: #f1f1f1;
            display: flex;
            align-items: center;
            padding: 0 15px;
            z-index: 10;
        }

        .back-button a {
            display: inline-flex;
            align-items: center;
            text-decoration: none;
            color: #333;
            font-weight: bold;
            background-color: #e0e0e0;
            padding: 10px 15px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .back-button a:hover {
            background-color: #d0d0d0;
        }

        .back-button a::before {
            content: '←';
            margin-right: 8px;
            font-size: 20px;
        }
    </style>
</head>
<body>
    <div class="app-container">
        <div class="back-button">
            <a href="{{ route('user.koleksi') }}">Kembali</a>
        </div>
        <div class="pdf-container">
            <iframe
                class="pdf-viewer"
                src="{{ $pdfUrl }}#toolbar=0&navpanes=0&scrollbar=1&view=FitH"
                oncontextmenu="return false;"
                allow="fullscreen"
            ></iframe>
        </div>
    </div>

    <script>
        // Mencegah shortcut keyboard untuk print dan download
        document.addEventListener('keydown', function(e) {
            if ((e.ctrlKey || e.metaKey) && (e.key === 'p' || e.key === 's')) {
                e.preventDefault();
            }
        });

        // Mencegah drag and drop file
        document.addEventListener('dragstart', function(e) {
            e.preventDefault();
        });

        // Responsif untuk berbagai ukuran layar
        function adjustPdfViewer() {
            const pdfViewer = document.querySelector('.pdf-viewer');
            const container = document.querySelector('.app-container');

            // Batasi ukuran maksimum
            container.style.maxWidth = '1200px';
            container.style.margin = '0 auto';

            // Sesuaikan tinggi viewer
            pdfViewer.style.height = (window.innerHeight - 50) + 'px';
            pdfViewer.style.width = '100%';
        }

        // Jalankan saat halaman dimuat dan saat ukuran layar berubah
        window.addEventListener('load', adjustPdfViewer);
        window.addEventListener('resize', adjustPdfViewer);
    </script>
</body>
</html>
