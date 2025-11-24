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
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <header class="header">
        <div class="container header-content">
            <div class="logo">
                <a href="../../view/client/clientHome.php">
                    <img src="../../assets/img/Logo.png" alt="Logo PWEB">
                    <p class="tagline">Perpustakaan PWEB</p>
                </a>
            </div>

            <nav>
                <ul>
                    <li><a href="../../view/client/clientHome.php">Beranda</a></li>
                    <li><a href="../../view/client/clientKatalog.php">Katalog</a></li>
                    <li><a href="../../view/client/clientLend.php">Peminjaman</a></li>
                    <li><a href="../../view/client/clientProfile.php">Profil</a></li>
                </ul>
            </nav>
        </div>
    </header>
</body>
</html>