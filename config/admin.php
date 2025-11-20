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