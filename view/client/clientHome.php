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
    <title>Home - Perpustakaan PWEB</title>
    <?php require_once '../../components/client/clientHeader.php'; ?>
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="../../assets/css/page/home.css">
</head>
<body>
    <div class="home-container">
        <div class="welcome-section">
            <div class="datetime-display">
                <div class="date" id="currentDate"></div>
                <div class="time" id="currentTime"></div>
            </div>
            
            <h1 class="library-name">Perpustakaan Digital PWEB</h1>
            <p class="library-tagline">Membaca Membuka Jendela Dunia</p>
            
            <div class="library-image">
                <img src="../../assets/img/perpus.webp" alt="Perpustakaan PWEB" />
            </div>
            
            <div class="welcome-text">
                <p>Selamat datang di Perpustakaan Digital PWEB, tempat di mana pengetahuan bertemu dengan teknologi
                Temukan berbagai koleksi buku berkualitas dan nikmati pengalaman membaca yang modern</p>
            </div>
        </div>
    </div>

    <?php require_once '../../components/client/clientFooter.php'; ?>
    
    <script src="../../assets/js/home.js"></script>
</body>
</html>