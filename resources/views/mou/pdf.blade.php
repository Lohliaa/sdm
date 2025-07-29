<!DOCTYPE html>
<html>
<head>
    <title>Arsip Surat</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.15.349/pdf.min.js"></script>
</head>
<body>
    <h1>Detail Arsip Surat</h1>
    <p><strong>Nomor Surat:</strong> {{ $arsipSurat->nomor_surat }}</p>
    <p><strong>Kategori:</strong> {{ $arsipSurat->kategori }}</p>
    <p><strong>Judul:</strong> {{ $arsipSurat->judul }}</p>
    <p><strong>Waktu Pengarsipan:</strong> {{ $arsipSurat->created_at }}</p>
    <p><strong>File PDF Asli:</strong></p>
    <iframe src="{{ asset($arsipSurat->file_path) }}" width="600" height="400"></iframe>
</body>
</html>
