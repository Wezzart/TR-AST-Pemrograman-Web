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
    <title>Peminjaman Saya - Perpustakaan PWEB</title>
    <?php require_once '../../components/client/clientHeader.php'; ?>
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="../../assets/css/page/client.css">
</head>
<body>
    <canvas id="particles"></canvas>
    <div class="container">
        <h1>Buku yang Saya Pinjam</h1>
        
        <button name="refresh" onclick="loadBukuPinjaman()" class="btn-pinjam" style="margin-bottom: 20px; max-width: 300px;">Refresh List</button>
        
        <div id="listBukuPinjaman"></div>
        
        <div id="statusKembali"></div>
    </div>

    <!-- buat footernya ges nanti codenya harus diatas ini -->
    <?php require_once '../../components/client/clientFooter.php'; ?>

    <script src="../../assets/js/script.js"></script>
    <script src="../../assets/js/peminjaman.js"></script>
</body>
</html>