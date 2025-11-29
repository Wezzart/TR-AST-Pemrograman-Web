<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peminjaman Saya - Perpustakaan PWEB</title>
    <?php require_once '../../components/client/clientHeader.php'; ?>
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>
<body>
    <div class="container">
        <h1>Buku yang Saya Pinjam</h1>
        
        <!-- Tombol refresh list -->
        <button onclick="loadBukuPinjaman()" style="margin-bottom: 20px;">Refresh List</button>
        
        <!-- List buku yang dipinjam -->
        <div id="listBukuPinjaman"></div>
        
        <!-- Status message -->
        <div id="statusKembali"></div>
    </div>

    <!-- buat footernya ges nanti codenya harus diatas ini -->
    <?php require_once '../../components/client/clientFooter.php'; ?>

    <script src="../../assets/js/peminjaman.js"></script>
</body>
</html>