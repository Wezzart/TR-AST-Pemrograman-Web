<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$currentPage = basename($_SERVER['PHP_SELF']);
$pageTitle = isset($title) ? $title : "Admin Dashboard - Perpustakaan PWEB";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?></title>
    <link rel="icon" type="image/png" href="../../assets/img/Icon.png">
    
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="../../assets/css/page/header.css">
    
    <link rel="stylesheet" href="../../assets/css/page/admin.css">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
</head>

<body>
    <nav class="navbar" id="navbar">
        <div class="navbar-container">
            <a href="adminHome.php" class="logo">
                <div class="logo-img">
                    <img src="../../assets/img/Logo.png" alt="Logo Perpustakaan">
                </div>
                <span class="logo-text">Admin Panel</span>
            </a>

            <div class="mobile-menu-toggle" id="mobileToggle">
                <i class="fas fa-bars"></i>
            </div>

            <ul class="nav-menu" id="navMenu">
                <li class="nav-item">
                    <a href="#section-buku" class="nav-link">
                        <i class="fas fa-book"></i>
                        <span>Kelola Buku</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#section-anggota" class="nav-link">
                        <i class="fas fa-users"></i>
                        <span>Kelola Anggota</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#section-peminjaman" class="nav-link">
                        <i class="fas fa-clipboard-list"></i>
                        <span>Peminjaman</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="../../index.php" class="nav-link" style="color: #ff6b6b;">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Logout</span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
    
    <script src="../../assets/js/header.js"></script>