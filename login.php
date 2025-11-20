<?php
session_start();
require 'koneksiDB.php';
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
            header("Location: admin.php");
            exit;
        } else {
            $_SESSION['role'] = 'anggota';
            header("Location: index.php"); 
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