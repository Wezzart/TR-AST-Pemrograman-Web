<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Buku - Perpustakaan PWEB</title>
    <?php require_once '../../components/client/clientHeader.php'; ?>
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>
<body>
    <div class="container">
        <h1>Katalog Buku</h1>
        
        <!-- Form Pencarian -->
        <div class="search-box">
            <input type="text" id="namaBuku" placeholder="Cari buku berdasarkan nama...">
            <button onclick="cariBuku()">Cari</button>
        </div>
        
        <!-- Hasil Pencarian -->
        <div id="hasilCari"></div>
    </div>

    <script src="../../assets/js/katalog.js"></script>
</body>
</html>