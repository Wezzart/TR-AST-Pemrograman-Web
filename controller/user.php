<?php
session_start();
require '../config/koneksiDB.php';

if(!isset($_SESSION['role']) || $_SESSION['role'] != 'anggota'){
     header("Location: login.php");
     exit;
 }

if (isset($_POST["cariBuku"])) {
    $namaBuku = $_POST["namaBuku"];
    $genre = isset($_POST["genre"]) ? $_POST["genre"] : "";
    
    // Build query dengan kondisi dinamis
    if (!empty($genre) && $genre !== "all") {
        if (!empty($namaBuku)) {
            // Filter by nama dan genre
            $stmt = $koneksi->prepare("SELECT * FROM buku WHERE nama_buku LIKE ? AND genre_buku = ?");
            $searchTerm = "%$namaBuku%";
            $stmt->bind_param("ss", $searchTerm, $genre);
        } else {
            // Filter by genre saja
            $stmt = $koneksi->prepare("SELECT * FROM buku WHERE genre_buku = ?");
            $stmt->bind_param("s", $genre);
        }
    } else {
        if (!empty($namaBuku)) {
            // Filter by nama saja
            $stmt = $koneksi->prepare("SELECT * FROM buku WHERE nama_buku LIKE ?");
            $searchTerm = "%$namaBuku%";
            $stmt->bind_param("s", $searchTerm);
        } else {
            // Show semua buku
            $stmt = $koneksi->prepare("SELECT * FROM buku");
        }
    }
    
    $stmt->execute();
    $result = $stmt->get_result();
    
    $books = [];
    while ($buku = $result->fetch_assoc()) {
        $books[] = $buku;
    }
    
    echo json_encode($books);
    $stmt->close();
}

if (isset($_POST["getGenres"])) {
    // Get daftar genre yang tersedia
    $stmt = $koneksi->prepare("SELECT DISTINCT genre_buku FROM buku ORDER BY genre_buku");
    $stmt->execute();
    $result = $stmt->get_result();
    
    $genres = [];
    while ($row = $result->fetch_assoc()) {
        $genres[] = $row['genre_buku'];
    }
    
    echo json_encode($genres);
    $stmt->close();
}

if (isset($_POST["getBukuPinjaman"])) {
    $username = $_SESSION["username"];
    $stmt = $koneksi->prepare("SELECT b.*, p.username FROM pinjam_buku p 
                               JOIN buku b ON p.id_buku = b.id_buku 
                               WHERE p.username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $books = [];
    while ($buku = $result->fetch_assoc()) {
        $books[] = $buku;
    }
    
    echo json_encode($books);
    $stmt->close();
}

if (isset($_POST["pinjamBuku"])){
    $namaBuku = $_POST["namaBuku"];
    $username = $_SESSION["username"];

    $q_jumlah = $koneksi->prepare("SELECT jumlah_buku, id_buku FROM buku WHERE nama_buku =?");
    $q_jumlah -> bind_param("s", $namaBuku);
    $q_jumlah -> execute();
    $result = $q_jumlah->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $jumlahBuku = $row['jumlah_buku'];
        $idBuku = $row['id_buku'];
        
        if ($jumlahBuku <= 0) {
            echo json_encode(["status" => "error", "message" => "Stok buku kosong, silahkan pilih buku lain"]);
        } else {
            // Update jumlah buku
            $newJumlah = $jumlahBuku - 1;
            $updateBuku = $koneksi->prepare("UPDATE buku SET jumlah_buku = ? WHERE nama_buku = ?");
            $updateBuku->bind_param("is", $newJumlah, $namaBuku);
            $updateBuku->execute();
            
            $peminjam = $koneksi->prepare("INSERT INTO pinjam_buku (id_buku, username) VALUES (?, ?)");
            $peminjam->bind_param("ss", $idBuku, $username);
            
            if ($peminjam->execute()) {
                echo json_encode(["status" => "success", "message" => "Buku berhasil dipinjam"]);
            } else {
                echo json_encode(["status" => "error", "message" => "Gagal meminjam buku"]);
            }
            
            $updateBuku->close();
            $peminjam->close();
        }
    } else {
        echo json_encode(["status" => "error", "message" => "Buku tidak ditemukan"]);
    }
    $q_jumlah->close();
}

if(isset($_POST["kembalikanBuku"])){
    $namaBuku = $_POST["namaBuku"];
    $username = $_SESSION["username"];

    $q_buku = $koneksi->prepare("SELECT id_buku, jumlah_buku FROM buku WHERE nama_buku = ?");
    $q_buku->bind_param("s", $namaBuku);
    $q_buku->execute();
    $result = $q_buku->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $idBuku = $row['id_buku'];
        $jumlah = $row['jumlah_buku'];
    
        $checkPinjam = $koneksi->prepare("SELECT * FROM pinjam_buku WHERE id_buku = ? AND username = ?");
        $checkPinjam->bind_param("ss", $idBuku, $username);
        $checkPinjam->execute();
        $pinjamResult = $checkPinjam->get_result();
        
        if ($pinjamResult->num_rows > 0) {
            $newJumlah = $jumlah + 1;
            $kembalikan = $koneksi->prepare("UPDATE buku SET jumlah_buku = ? WHERE nama_buku = ?");
            $kembalikan->bind_param("is", $newJumlah, $namaBuku);
            $kembalikan->execute();
            
            $deletePinjam = $koneksi->prepare("DELETE FROM pinjam_buku WHERE id_buku = ? AND username = ?");
            $deletePinjam->bind_param("ss", $idBuku, $username);
            $deletePinjam->execute();
            
            echo json_encode(["status" => "success", "message" => "Buku berhasil dikembalikan"]);
            
            $kembalikan->close();
            $deletePinjam->close();
        } else {
            echo json_encode(["status" => "error", "message" => "Anda tidak meminjam buku ini"]);
        }
        $checkPinjam->close();
    } else {
        echo json_encode(["status" => "error", "message" => "Buku tidak ditemukan"]);
    }
    $q_buku->close();
}
?>