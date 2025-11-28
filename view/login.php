<?php
include '../controller/login.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan PWEB</title>
    <link rel="icon" type="image/png" href="../assets/img/Icon.png">
    <link rel="stylesheet" href="../assets/css/page/login.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <canvas id="particles"></canvas>
    <div class="container" id="container">
        <div class="form-container sign-up-container">
            <form action="../controller/register.php" method="POST">
                <h1>Create Account</h1>
                <div class="infield">
                    <i class="fas fa-user input-icon"></i>
                    <input type="text" placeholder="Name" name="name" required />
                </div>
                <div class="infield">
                    <i class="fas fa-envelope input-icon"></i>
                    <input type="text" placeholder="Email" name="email" required />
                </div>
                <div class="infield">
                    <i class="fas fa-lock input-icon"></i>
                    <input type="password" placeholder="Password" name="password" required />
                </div>
                <button type="submit" name="register">Sign Up</button>
            </form>
        </div>
        <div class="form-container sign-in-container">
            <form action="../controller/login.php" method="POST">
                <h1>Sign in</h1>
                <div class="infield">
                    <i class="fas fa-user input-icon"></i>
                    <input type="text" placeholder="Email" name="email" required />
                </div>
                <div class="infield">
                    <i class="fas fa-lock input-icon"></i>
                    <input type="password" placeholder="Password" name="password" required />
                </div>
                <button type="submit" name ="login">Sign In</button>
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Masuk Akun</h1>
                    <p>"Aku rela di penjara asalkan bersama buku, karena degan buku aku bebas"<br>Mohammad Hatta</p>
                    <button class="ghost" id="signIn">Sign In</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>Registrasi Akun</h1>
                    <p>"Jika kamu tidak suka membaca, kamu belum menemukan buku yang tepat"<br>J. K. Rowling</p>
                    <button class="ghost" id="signUp">Sign Up</button>
                </div>
            </div>
        </div>
    </div>

    <script src="../assets/js/script.js"></script>
    <script src="../assets/js/login.js"></script>
</body>
</html>