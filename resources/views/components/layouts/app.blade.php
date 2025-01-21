<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="assets/img/logomy.png" rel="icon">
    <title>{{ $title ?? 'MyBookSmea' }}</title>
    @vite('resources/css/app.css') {{-- Sesuaikan jika menggunakan Vite --}}
    @livewireStyles
</head>
<body>
    <header>
        <!-- Header Konten -->
    </header>
    <main>
        {{ $slot }}
    </main>
    <footer>
        <!-- Footer Konten -->
    </footer>
    @livewireScripts
</body>
</html>
