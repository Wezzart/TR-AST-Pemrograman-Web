<?php
session_start();
require '../config/koneksiDB.php';

if(!isset($_SESSION['role']) || $_SESSION['role'] != 'admin'){
    header("Location: login.php");
    exit;
}

if(!isset($_GET['doc'])) {
    $userInputDoc = $_GET['doc'];
    $safeDocName = basename($userInputDoc);
}

$username =  $_SESSION['username'];
$buku = mysqli_query($koneksi, "SELECT * from buku");
$anggota = mysqli_query($koneksi, "SELECT * FROM anggota");
$pinjam = mysqli_query($koneksi, "SELECT * FROM pinjam_buku");


if(isset($_POST["tambahBuku"])){
    $idBuku = $_POST["idBuku"];
    $namaBuku = $_POST["namaBuku"];
    $penulisBuku = $_POST["penulisBuku"];
    $genre_buku = $_POST["genre_buku"];
    $jumlahBuku = $_POST["jumlahBuku"];
    $tahunTerbit = $_POST["tahunTerbit"];

    $stmt = $koneksi->prepare("INSERT INTO buku (id_buku,nama_buku,penulis_buku,genre_buku,jumlah_buku,tahun_terbit) VALUES (?, ?, ?, ?, ?, ?)"); 
    $stmt -> bind_param("ssssis",$idBuku,$namaBuku,$penulisBuku,$genreBuku,$jumlahBuku,$tahunTerbit);
    if ($stmt->execute()) {
        header( "Location: view/admin/adminHome.php?status=success");
        $stmt->close();
        exit();
    } else {
        header( "Location: view/admin/adminHome.php?status=failed");
        $stmt->close();
        exit();
    }
}

if(isset($_POST["updateBuku"])){
    $idBuku = $_POST["idBuku"];
    $namaBuku = $_POST["namaBuku"];
    $penulisBuku = $_POST["penulisBuku"];
    $genre_buku = $_POST["genreBuku"];
    $jumlahBuku = $_POST["jumlahBuku"];
    $tahunTerbit = $_POST["tahunTerbit"];

    $stmt = $koneksi->prepare("UPDATE buku SET nama_buku = ?,penulis_buku =?,genre_buku =?, jumlah_buku=?,tahun_terbit =? WHERE id_buku =?");
    $stmt -> bind_param("sssiss",$namaBuku,$penulisBuku,$genreBuku,$jumlahBuku,$tahunTerbit,$idBuku);
    if ($stmt->execute()) {
        header( "Location: ../view/admin/adminHome.php?status=success");
        $stmt->close();
        exit();
    } else {
        header( "Location: ../view/admin/adminHome.php?status=failed");
        $stmt->close();
        exit();
    }
}

if(isset($_GET["deleteBuku"])){
    $idBuku = $_GET["idBuku"];
    $stmt = $koneksi->prepare("DELETE from buku WHERE id_buku = ?");
    $stmt-> bind_param("s",$idBuku);
    if ($stmt->execute()) {
        header( "Location: view/admin/adminHome.php?status=success");
        $stmt->close();
        exit();
    } else {
        header( "Location: view/admin/adminHome.php?status=failed");
        $stmt->close();
        exit();
    }
}

$editBuku = null;
if (isset($_GET['editBuku'])) {
    $idBuku = $_GET['editBuku'];
    $stmt = $koneksi->prepare("SELECT * FROM buku WHERE id_buku = ?"); 
    $stmt->bind_param("s", $idBuku); 
    $stmt->execute();
    $result = $stmt->get_result(); 
    $editData = $result->fetch_assoc(); 
    $stmt->close();
}

if(isset($_POST["tambahAnggota"])){
    $namaAnggota = $_POST["namaAnggota"];
    $stmt = $koneksi -> prepare("INSERT INTO user (username,password,role) values (?,?,'anggota')");
    $stmt->bind_param("ss",$namaAnggota,$namaAnggota);

    $stmt2 = $koneksi -> prepare("INSERT INTO anggota (username) values (?)");
    $stmt2->bind_param("s",$namaAnggota);
    
    if ($stmt->execute()) { 
        if ($stmt2->execute()) {
        header( "Location: view/admin/adminHome.php?status=success");
        $stmt->close();
        $stmt2->close();
        exit();

        } else {
            header( "Location: view/admin/adminHome.php?status=failed");
            $stmt->close();
            $stmt2->close();
            exit();
        }

    } else {
        header( "Location: view/admin/adminHome.php?status=failed");
        $stmt->close();
        exit();
    }
}

if(isset($_GET["deleteAnggota"])){
    $namaAnggota = $_GET["namaAnggota"];
    $stmt = $koneksi -> prepare("DELETE from anggota where username =?");
    $stmt->bind_param("s",$namaAnggota);

    $stmt2 = $koneksi -> prepare("DELETE from user where username =?");
    $stmt2->bind_param("s",$namaAnggota);

    if ($stmt->execute()) {
        if ($stmt2->execute()) {
        header( "Location: view/admin/adminHome.php?status=success");
        $stmt->close();
        $stmt2->close();
        exit();

        } else {
            header( "Location: view/admin/adminHome.php?status=failed");
            $stmt->close();
            $stmt2->close();
            exit();
        }

    } else {
        header( "Location: view/admin/adminHome.php?status=failed");
        $stmt->close(); 
        exit();
    }
}

// update pass (reset pass)
if(isset($_POST['updatePassword'])){
    $username = $_POST['username'];
    $newPassword = $_POST['password'];

    // update pass di table user
    $stmt = $koneksi->prepare("UPDATE user SET password=? WHERE username=?");
    $stmt->bind_param("ss", $newPassword, $username);

    if ($stmt->execute()) {
        header("Location: ../view/admin/adminHome.php?status=success");
    } else {
        header("Location: ../view/admin/adminHome.php?status=failed");
    }
    $stmt->close();
}