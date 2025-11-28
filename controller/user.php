<?php
session_start();
require 'koneksiDB.php';

if(!isset($_SESSION['role']) || $_SESSION['role'] != 'anggota'){
    header("Location: login.php");
    exit;
}

if (isset($_POST["cariBuku"])) {
    $namaBuku = $_POST["namaBuku"];

    $stmt = $koneksi->prepare("SELECT * FROM buku where nama_buku = ?");
    $stmt-> bind_param("s", $namaBuku);
    $stmt-> execute();
    //wip
}

if (isset($_POST["pinjamBuku"])){
    $namaBuku = $_POST["namaBuku"];

    $q_jumlah = $koneksi->prepare("SELECT jumlah_buku FROM buku WHERE nama_buku =?");
    $q_jumlah -> bind_param("s", $namaBuku);
    $q_jumlah -> execute();
    if ($q_jumlah <=0) {
        echo "Stok buku kosong, silahkan pilih buku lain";
    }else {
        $stmt = $koneksi->prepare("UPDATE buku SET jumlah_buku = ? WHERE nama_buku =?");
        $stmt -> bind_param("ss", ($q_jumlah-1), $namaBuku );
        $stmt -> execute();
        //wip
    }
}

if(isset($_POST["kembalikanBuku"])){
    $namaBuku = $_POST["namaBuku"];

    $q_jumlah = $koneksi->prepare("SELECT jumlah_buku FROM buku WHERE nama_buku =?");
    $q_jumlah -> bind_param("s", $namaBuku);
    $q_jumlah -> execute();
    if ($q_jumlah <=0) {
        echo "Stok buku kosong, silahkan pilih buku lain";
    }else {
        $stmt = $koneksi->prepare("UPDATE buku SET jumlah_buku = ? WHERE nama_buku =?");
        $stmt -> bind_param("ss", ($q_jumlah+1), $namaBuku );
        $stmt -> execute();
    }
    //wip
}
?>