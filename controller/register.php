<?php
require '../config/koneksiDB.php';

if(isset($_POST["register"])){
    $username = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $koneksi->prepare("INSERT INTO user (username,password,role) values (?,?,'anggota')");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();

    $stmt2 = $koneksi->prepare("INSERT INTO anggota (username) values (?)");
    $stmt2->bind_param("s", $username);
    header( "Location: ../view/login.php");
    $stmt2->execute();
    
}
?>