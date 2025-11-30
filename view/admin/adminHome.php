<?php
session_start();
require_once '../../config/koneksiDB.php';

// security cek
if(!isset($_SESSION['role']) || $_SESSION['role'] != 'admin'){
    header("Location: ../login.php");
    exit;
}

// fetch data
$buku = mysqli_query($koneksi, "SELECT * from buku");
$anggota = mysqli_query($koneksi, "SELECT * FROM anggota");
$pinjam = mysqli_query($koneksi, "SELECT * FROM pinjam_buku");

$title = "Admin Dashboard";
require_once '../../components/admin/adminHeader.php';
?>

<canvas id="particles"></canvas>

<div class="admin-container">
    <h1>Dashboard Admin</h1>
    
    <?php if(isset($_GET['status'])): ?>
        <script>
            <?php if($_GET['status'] == 'success'): ?>
                alert("Berhasil!\nData telah diperbarui.");
            <?php elseif($_GET['status'] == 'failed'): ?>
                alert("Gagal!\nTerjadi kesalahan saat memproses data.");
            <?php endif; ?>

            if (window.history.replaceState) {
                window.history.replaceState(null, null, window.location.pathname);
            }
        </script>
    <?php endif; ?>

    <div id="section-buku">
        <h2 class="section-title"><i class="fas fa-book"></i> Manajemen Buku</h2>
        
        <div class="admin-card">
            <h3>Tambah Buku Baru</h3>
            <form action="../../controller/admin.php" method="POST" class="admin-form">
                <div class="form-group">
                    <label>ID Buku</label>
                    <input type="text" name="idBuku" placeholder="Contoh: B001" required>
                </div>
                <div class="form-group">
                    <label>Judul Buku</label>
                    <input type="text" name="namaBuku" placeholder="Judul..." required>
                </div>
                <div class="form-group">
                    <label>Penulis</label>
                    <input type="text" name="penulisBuku" placeholder="Nama Penulis" required>
                </div>
                <div class="form-group">
                    <label>Genre</label>
                    <input type="text" name="genreBuku" placeholder="Fiksi/Sains..." required>
                </div>
                <div class="form-group">
                    <label>Stok</label>
                    <input type="number" name="jumlahBuku" placeholder="0" required>
                </div>
                <div class="form-group">
                    <label>Tahun Terbit</label>
                    <input type="text" name="tahunTerbit" placeholder="2024" required>
                </div>
                <button type="submit" name="tambahBuku" class="btn-submit">Simpan Buku</button>
            </form>
        </div>

        <div class="admin-card">
            <h3>Daftar Buku</h3>
            <div class="table-responsive">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Judul</th>
                            <th>Penulis</th>
                            <th>Stok</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = mysqli_fetch_assoc($buku)): ?>
                        <tr>
                            <td><?= $row['id_buku'] ?></td>
                            <td><?= $row['nama_buku'] ?></td>
                            <td><?= $row['penulis_buku'] ?></td>
                            <td><?= $row['jumlah_buku'] ?></td>
                            <td>
                                <a href="editBuku.php?id=<?= $row['id_buku'] ?>" class="btn-delete" style="background: #f39c12; border-color: #f39c12; color: white;">
                                   <i class="fas fa-edit"></i> Edit
                                </a>
                                <a href="../../controller/admin.php?deleteBuku=1&idBuku=<?= $row['id_buku'] ?>" 
                                   class="btn-delete" 
                                   onclick="return confirm('Yakin ingin menghapus buku ini?')">
                                   <i class="fas fa-trash"></i> Hapus
                                </a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div id="section-anggota">
        <h2 class="section-title"><i class="fas fa-users"></i> Manajemen Anggota</h2>

        <div class="admin-card">
            <h3>Tambah Anggota Manual</h3>
            <form action="../../controller/admin.php" method="POST" class="admin-form" style="grid-template-columns: 1fr 1fr auto;">
                <div class="form-group">
                    <label>Username (Email)</label>
                    <input type="text" name="namaAnggota" placeholder="user@gmail.com" required>
                </div>
                <div class="form-group">
                    <label>Password Default</label>
                    <input type="password" name="password" placeholder="******" required>
                </div>
                <button type="submit" name="tambahAnggota" class="btn-submit">Tambah</button>
            </form>
        </div>

        <div class="admin-card">
            <div class="table-responsive">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>Reset Password</th> <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = mysqli_fetch_assoc($anggota)): ?>
                        <tr>
                            <td><?= $row['username'] ?></td>
                            <td>
                                <form action="../../controller/admin.php" method="POST" style="display:flex; gap:5px;">
                                    <input type="hidden" name="username" value="<?= $row['username'] ?>">
                                    <input type="text" name="password" placeholder="Pass Baru" style="width:100px; padding:5px; border-radius:5px; border:none;" required>
                                    <button type="submit" name="updatePassword" style="background:#2ecc71; color:white; border:none; padding:5px 10px; border-radius:5px; cursor:pointer;">
                                        <i class="fas fa-key"></i>
                                    </button>
                                </form>
                            </td>
                            <td>
                                <a href="../../controller/admin.php?deleteAnggota=1&namaAnggota=<?= $row['username'] ?>" 
                                   class="btn-delete"
                                   onclick="return confirm('Yakin ingin menghapus anggota ini? Data user juga akan terhapus.')">
                                   <i class="fas fa-trash"></i> Hapus
                                </a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div id="section-peminjaman">
        <h2 class="section-title"><i class="fas fa-clipboard-list"></i> Data Peminjaman</h2>
        
        <div class="admin-card">
            <div class="table-responsive">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>ID Peminjaman</th>
                            <th>ID Buku</th>
                            <th>Peminjam</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        if(mysqli_num_rows($pinjam) > 0):
                            while($row = mysqli_fetch_assoc($pinjam)): 
                        ?>
                        <tr>
                            <td><?= $row['id_peminjaman'] ?></td>
                            <td><?= $row['id_buku'] ?></td>
                            <td><?= $row['username'] ?></td>
                        </tr>
                        <?php 
                            endwhile; 
                        else:
                        ?>
                        <tr>
                            <td colspan="3" style="text-align:center;">Belum ada data peminjaman.</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<script src="../../assets/js/script.js"></script>

<?php require_once '../../components/client/clientFooter.php'; ?>