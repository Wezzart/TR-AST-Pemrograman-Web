<?php
session_start();
require '../../config/koneksiDB.php';

if(!isset($_SESSION['role']) || $_SESSION['role'] != 'anggota'){
     header("Location: ../login.php");
     exit;
}

$userName = isset($_SESSION['name']) ? $_SESSION['name'] : 'Anggota';
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
</head>
<body>
    <main style="flex: 1"></main>
        <div class="home-container">
            <div class="welcome-section">
                <div class="greeting-banner">
                    <div class="greeting-icon">
                        <i class="fas fa-book-reader"></i>
                    </div>
                    <h2 class="greeting-text">
                        <span id="dynamicGreeting">Selamat Datang, Selamat Membaca</span>
                    </h2>
                </div>

                <div class="datetime-display">
                    <div class="date" id="currentDate"></div>
                    <div class="time" id="currentTime"></div>
                </div>
                
                <h1 class="library-name">Perpustakaan Digital PWEB</h1>
                <p class="library-tagline">Membaca Membuka Jendela Dunia</p>

                <div class="library-image">
                    <img src="../../assets/img/homeImage.jpg" alt="Perpustakaan PWEB" />
                </div>
                <div class="welcome-text">
                    <div class="welcome-icon">
                        <i class="fas fa-info-circle"></i>
                    </div>
                    <p>Selamat datang di Perpustakaan Digital PWEB, tempat di mana pengetahuan bertemu dengan teknologi. 
                    Temukan berbagai koleksi buku berkualitas dan nikmati pengalaman membaca yang modern.</p>
                </div>

                <div class="features-section">
                    <h2 class="features-title">Kenapa Memilih Kami?</h2>
                    <div class="features-grid">
                        <div class="feature-card">
                            <div class="feature-icon">
                                <i class="fas fa-clock"></i>
                            </div>
                            <h3>24/7 Akses</h3>
                            <p>Akses katalog buku kapan saja, di mana saja</p>
                        </div>
                        <div class="feature-card">
                            <div class="feature-icon">
                                <i class="fas fa-shield-alt"></i>
                            </div>
                            <h3>Aman & Terpercaya</h3>
                            <p>Data Anda terlindungi dengan sistem keamanan terbaik</p>
                        </div>
                        <div class="feature-card">
                            <div class="feature-icon">
                                <i class="fas fa-sync"></i>
                            </div>
                            <h3>Update Berkala</h3>
                            <p>Koleksi buku selalu diperbarui dengan judul terbaru</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php require_once '../../components/client/clientFooter.php'; ?>
    
    <script src="../../assets/js/home.js"></script>
</body>
</html>