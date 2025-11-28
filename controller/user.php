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
    $username = $_SESSION["username"];
    $q_jumlah = $koneksi->prepare("SELECT jumlah_buku FROM buku WHERE nama_buku =?");
    $q_jumlah -> bind_param("s", $namaBuku);
    $q_jumlah -> execute();
    if ($q_jumlah <=0) {
        echo "Stok buku kosong, silahkan pilih buku lain";
    }else {
        $updateBuku = $koneksi->prepare("UPDATE buku SET jumlah_buku = ? WHERE nama_buku =?");
        $updateBuku -> bind_param("ss", ($q_jumlah-1), $namaBuku );
        $updateBuku -> execute();
        $idBuku = $koneksi->prepare("SELECT id buku FROM buku WHERE nama_buku = ?");
        $idBuku-> bind_param("s",$namaBuku);
        $idBuku-> execute();
        $peminjam = $koneksi->prepare("INSERT INTO pinjam_buku (id_peminjaman, id_buku,  username) VALUES
        (?, ?, ?)");
        $peminjam -> bind_param("s,s,s", NULL, $idBuku, $username);
        $peminjam -> execute();
        //wip
    }
}

if(isset($_POST["kembalikanBuku"])){
    $namaBuku = $_POST["namaBuku"];
    $username = $_SESSION["username"];

    $q_jumlah = $koneksi->prepare("SELECT jumlah_buku FROM buku WHERE nama_buku =?");
    $q_jumlah -> bind_param("s", $namaBuku);
    $q_jumlah -> execute();
    if ($q_jumlah <=0) {
        echo "Stok buku kosong, silahkan pilih buku lain";
    }else {
        $kembalikan = $koneksi->prepare("UPDATE buku SET jumlah_buku = ? WHERE nama_buku =?");
        $kembalikan -> bind_param("ss", ($q_jumlah+1), $namaBuku );
        $kembalikan -> execute();
        
        $deletePinjam = $koneksi->prepare("DELETE FROM pinjam_buku WHERE username = ?");
        $deletePinjam -> bind_param("s", $username);
        $deletePinjam -> execute();
    }
    //wip
}
?>