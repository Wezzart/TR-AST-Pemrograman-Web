<?php
session_start();
require '../config/koneksiDB.php';
if (isset($_POST['login'])) {
    $username = $_POST['email'];
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
        $result_admin = $q_admin->get_result(); // Get the actual result set
        if ($result_admin->num_rows > 0) {
            $_SESSION['role'] = 'admin';
            header("Location: ../view/admin/adminHome.php");
            exit;
        } else {
            $_SESSION['role'] = 'anggota';
            header("Location: ../view/client/clientHome.php"); 
            exit;
        }
    } else {
        header("Location: ../view/login.php?error=1");
        exit;
    }
}
?>