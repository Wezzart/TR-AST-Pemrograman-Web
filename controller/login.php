<?php
session_start();
require '../config/koneksiDB.php';
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $stmt = $koneksi->prepare("SELECT * FROM user WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['username'] = $username;
        
        $q_admin = $koneksi->prepare("SELECT * FROM admin WHERE username=?");
        $q_admin->bind_param("s", $username);
        $q_admin->execute();
        if (mysqli_num_rows($q_admin) > 0) {
            $_SESSION['role'] = 'admin';
            header("Location: ../view/admin/adminHome.php");
            exit;
        } else {
            $_SESSION['role'] = 'anggota';
            header("Location: ../view/client/clientHome.php"); 
            exit;
        }
    } else {
        echo "<script>
            alert('Username atau Password Salah');
            window.location = 'login.php';
        </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Anggota & Admin - Perpustakaan PWEB</title>
    
    <link rel="stylesheet" href="../assets/css/page/login.css"> 
    <link rel="stylesheet" href="../assets/css/style.css">
    </head>
<body>
    <div class="login-container">
        <h2>LOGIN PERPUSTAKAAN</h2>
        <form method="POST" action="login.php">
            <input type="text" name="username" class="login-input" placeholder="Username" required>
            <input type="password" name="password" class="login-input" placeholder="Password" required>
            <button type="submit" name="login" class="login-button">Masuk</button>
        </form>
        <a href="#" class="register-link">Belum punya akun? Daftar di sini.</a>
    </div>
</body>
</html>