<?php
session_start();
require_once '../../config/koneksiDB.php';

if(!isset($_SESSION['role']) || $_SESSION['role'] != 'admin'){
    header("Location: ../login.php");
    exit;
}

// get id dari url
$id = $_GET['id'];
$query = mysqli_query($koneksi, "SELECT * FROM buku WHERE id_buku = '$id'");
$data = mysqli_fetch_assoc($query);

$title = "Edit Buku";
require_once '../../components/admin/adminHeader.php';
?>

<div class="admin-container" style="margin-top: 20px !important;">
    <h2 class="section-title">Edit Data Buku</h2>
    
    <div class="admin-card">
        <form action="../../controller/admin.php" method="POST" class="admin-form">
            <div class="form-group">
                <label>ID Buku (Tidak bisa diubah)</label>
                <input type="text" name="idBuku" value="<?= $data['id_buku'] ?>" readonly style="background: rgba(0,0,0,0.5); color: gray;">
            </div>

            <div class="form-group">
                <label>Judul Buku</label>
                <input type="text" name="namaBuku" value="<?= $data['nama_buku'] ?>" required>
            </div>

            <div class="form-group">
                <label>Penulis</label>
                <input type="text" name="penulisBuku" value="<?= $data['penulis_buku'] ?>" required>
            </div>

            <div class="form-group">
                <label>Genre</label>
                <input type="text" name="genreBuku" value="<?= $data['genre_buku'] ?>" required>
            </div>

            <div class="form-group">
                <label>Stok</label>
                <input type="number" name="jumlahBuku" value="<?= $data['jumlah_buku'] ?>" required>
            </div>

            <div class="form-group">
                <label>Tahun Terbit</label>
                <input type="text" name="tahunTerbit" value="<?= $data['tahun_terbit'] ?>" required>
            </div>

            <div class="form-group">
                <label>&nbsp;</label>
                <button type="submit" name="updateBuku" class="btn-submit">Update Data</button>
            </div>
            
            <div class="form-group">
                <label>&nbsp;</label>
                <a href="adminHome.php" class="btn-delete" style="background:gray; border:none; text-align:center; padding:12px;">Batal</a>
            </div>
        </form>
    </div>
</div>

<script src="../../assets/js/script.js"></script>
<?php require_once '../../components/client/clientFooter.php'; ?>