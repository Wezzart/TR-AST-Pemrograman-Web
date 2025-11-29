<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan PWEB</title>
    <link rel="icon" type="image/png" href="../../assets/img/Icon.png">
    <link rel="stylesheet" href="../../assets/css/page/header.css">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
</head>

<body>
    <nav class="navbar" id="navbar">
        <div class="navbar-container">
            <a href="#" class="logo">
                <div class="logo-img">
                    <img src="../../assets/img/Logo.png" alt="Logo Perpustakaan">
                </div>
                <span class="logo-text">Perpustakaan PWEB</span>
            </a>

            <button class="mobile-menu-toggle" id="mobileToggle">
                <i class="fas fa-bars"></i>
            </button>

            <ul class="nav-menu" id="navMenu">
                <li class="nav-item">
                    <a href="#" class="nav-link active">
                        <i class="fas fa-home"></i>
                        <span>Home</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-book"></i>
                        <span>Katalog</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-handshake"></i>
                        <span>Peminjaman</span>
                    </a>
                </li>
                <li class="nav-item profile-dropdown">
                    <button class="profile-btn">
                        <i class="fas fa-user-circle"></i>
                        <span>Profile</span>
                        <i class="fas fa-chevron-down" style="font-size: 0.8rem;"></i>
                    </button>
                    <div class="dropdown-content">
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-user"></i>
                            <span>My Profile</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-sign-out-alt"></i>
                            <span>Logout</span>
                        </a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
    <script src="../../assets/js/header.js"></script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>