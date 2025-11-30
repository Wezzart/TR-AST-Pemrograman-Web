<?php
session_start();
require '../../config/koneksiDB.php';

if(!isset($_SESSION['role']) || $_SESSION['role'] != 'anggota'){
     header("Location: ../login.php");
     exit;
 }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Buku - Perpustakaan PWEB</title>
    <?php require_once '../../components/client/clientHeader.php'; ?>
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="../../assets/css/page/client.css">
</head>
<body>
    <canvas id="particles"></canvas>
    <div class="container">
        <h1>Katalog Buku</h1>
        <div class="search-box">
            <input type="text" id="namaBuku" placeholder="Cari buku berdasarkan nama...">
            
            <select id="genreFilter">
                <option value="all">Semua Genre</option>
                <!-- sisane ambil db -->
            </select>
            
            <button onclick="cariBuku()">Cari</button>
        </div>
        
        <div id="hasilCari"></div>
    </div>

    <!-- buat footernya ges nanti codenya harus diatas ini -->
    <?php require_once '../../components/client/clientFooter.php'; ?>

    <script src="../../assets/js/script.js"></script>
    <script src="../../assets/js/katalog.js"></script>
</body>
</html>