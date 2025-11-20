<?php
session_start();
require 'koneksi.php';

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $q_user = mysqli_query($koneksi, "SELECT * FROM user WHERE username='$username' AND password='$password'");

    if (mysqli_num_rows($q_user) > 0) {
        $_SESSION['username'] = $username;
        
        $q_admin = mysqli_query($koneksi, "SELECT * FROM admin WHERE username='$username'");
        
        if (mysqli_num_rows($q_admin) > 0) {
            $_SESSION['role'] = 'admin';
            header("Location: admin.php");
        } else {
            $_SESSION['role'] = 'anggota';
        }
    } else {
        echo "<script>
            alert('Gagal Login');
        </script>";
    }
}
?>