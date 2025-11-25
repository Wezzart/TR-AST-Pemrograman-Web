<?php
session_start();
require 'koneksiDB.php';

if(!isset($_SESSION['role']) || $_SESSION['role'] != 'admin'){
    header("Location: login.php");
    exit;
}

$username =  $_SESSION['username'];
$buku = mysqli_query($koneksi, "Select * from buku order by desc");
$anggota = mysqli_query($koneksi, "SELECT * FROM anggota");


if(isset($_POST["tambahBuku"])){
    $idBuku = $_POST["idBuku"];
    $namaBuku = $_POST["namaBuku"];
    $penulisBuku = $_POST["penulisBuku"];
    $genreBuku = $_POST["genreBuku"];
    $jumlahBuku = $_POST["jumlahBuku"];
    $tahunTerbit = $_POST["tahunTerbit"];

    $stmt = $conn->prepare("INSERT INTO buku (id_buku,nama_buku,penulis_buku,genre_buku,jumlah_buku,tahun_terbit) VALUES (?, ?, ?, ?, ?, ?)"); 
    $stmt -> bind_param("ssssis",$idBuku,$namaBuku,$penulisBuku,$genreBuku,$jumlahBuku,$tahunTerbit);
    if ($stmt->execute()) {
        header( "view/admin/adminHompage.php?status=success");
        exit();
    } else {
        header( "view/admin/adminHompage.php?status=failed");
        exit();
    }
}

if(isset($_POST["updateBuku"])){
    $idBuku = $_POST["idBuku"];
    $namaBuku = $_POST["namaBuku"];
    $penulisBuku = $_POST["penulisBuku"];
    $genreBuku = $_POST["genreBuku"];
    $jumlahBuku = $_POST["jumlahBuku"];
    $tahunTerbit = $_POST["tahunTerbit"];

    $stmt = $conn->prepare("UPDATE buku SET nama_buku = ?,penulis_buku =?,genreBuku =?, jumlah_buku=?,tahun_terbit =? WHERE id_buku =?");
    $stmt -> bind_param("sssiss",$namaBuku,$penulisBuku,$genreBuku,$jumlahBuku,$tahunTerbit,$idBuku);
    if ($stmt->execute()) {
        header( "view/admin/adminHompage.php?status=success");
        exit();
    } else {
        header( "view/admin/adminHompage.php?status=failed");
        exit();
    }
}

if(isset($_GET["deleteBuku"])){
    $idBuku = $_GET["idBuku"];
    $stmt = $conn->prepare("DELETE from buku WHERE id_buku = ?");
    $stmt-> bind_param("s",$idBuku);
    if ($stmt->execute()) {
        header( "view/admin/adminHompage.php");
        exit();
    }
}

$editBuku = null;
if (isset($_GET['editBuku'])) {
    $idBuku = $_GET['editBuku'];
    $stmt = $conn->prepare("SELECT * FROM buku WHERE id_buku = ?"); 
    $stmt->bind_param("s", $idBuku); 
    $stmt->execute();
    $result = $stmt->get_result(); 
    $editData = $result->fetch_assoc(); 
    $stmt->close();
}

if(isset($_POST["tambahAnggota"])){
    $namaAnggota = $_POST["namaAnggota"];
    $stmt = $conn -> prepare("INSERT INTO user (username,password,role) values (?,?,anggota)");
    $stmt->bind_param("ss",$namaAnggota,$namaAnggota);
    $stmt->execute();

    $stmt2 = $conn -> prepare("INSERT INTO anggota (username) values (?)");
    $stmt2->bind_param("s",$namaAnggota);
    $stmt2->execute();
}

if(isset($_GET["deleteAnggota"])){
    $namaAnggota = $_GET["namaAnggota"];
    $stmt = $conn -> prepare("DELETE from anggota where username =?");
    $stmt->bind_param("s",$namaAnggota);
    $stmt->execute();

    $stmt2 = $conn -> prepare("DELETE from user where username =?");
    $stmt2->bind_param("s",$namaAnggota);
    $stmt2->execute();
}