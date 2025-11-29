<?php
$currentPage = basename($_SERVER['PHP_SELF']);

$navLinks = [
    'clientHome.php' => 'Home',
    'clientKatalog.php' => 'Katalog',
    'clientLend.php' => 'Peminjaman',
];

$pageTitle = isset($title) ? $title : "Perpustakaan PWEB";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?></title>
    <link rel="icon" type="image/png" href="../../assets/img/Icon.png">
    <link rel="stylesheet" href="../../assets/css/page/header.css">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
</head>

<body>
    <nav class="navbar" id="navbar">
        <div class="navbar-container">
            <a href="../../view/client/clientHome.php" class="logo">
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
                    <a href="../../view/client/clientHome.php" class="nav-link <?php echo ($currentPage == 'clientHome.php') ? 'active' : ''; ?>">
                        <i class="fas fa-home"></i>
                        <span>Home</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="../../view/client/clientKatalog.php" class="nav-link <?php echo ($currentPage == 'clientKatalog.php') ? 'active' : ''; ?>">
                        <i class="fas fa-book"></i>
                        <span>Katalog</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="../../view/client/clientLend.php" class="nav-link <?php echo ($currentPage == 'clientLend.php') ? 'active' : ''; ?>">
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
                        <a href="../../view/client/profile.php" class="dropdown-item">
                            <i class="fas fa-user"></i>
                            <span>My Profile</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="../../controller/logout.php" class="dropdown-item">
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