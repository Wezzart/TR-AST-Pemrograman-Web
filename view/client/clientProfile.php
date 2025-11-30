<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Saya - Perpustakaan PWEB</title>
    <?php require_once '../../components/client/clientHeader.php'; ?>
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="../../assets/css/page/client.css">
    <link rel="stylesheet" href="../../assets/css/page/profile.css">
</head>
<body>
    <canvas id="particles"></canvas>
    <div class="container">
        <h1>Profile Saya</h1>
        
        <div class="profile-grid">
            <div class="profile-card">
                <div class="profile-header">
                    <div class="profile-avatar">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="profile-info">
                        <h2 id="profileUsername">Loading...</h2>
                        <p id="profileRole">Loading...</p>
                    </div>
                </div>
                
                <div class="profile-stats">
                    <div class="stat-item">
                        <i class="fas fa-book"></i>
                        <div class="stat-info">
                            <span class="stat-value" id="totalPinjam">0</span>
                            <span class="stat-label">Buku Dipinjam</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="profile-card">
                <h3><i class="fas fa-lock"></i> Ubah Password</h3>
                <form id="changePasswordForm">
                    <div class="form-group">
                        <label>Password Lama</label>
                        <input type="password" id="oldPassword" required>
                    </div>
                    <div class="form-group">
                        <label>Password Baru</label>
                        <input type="password" id="newPassword" required>
                    </div>
                    <div class="form-group">
                        <label>Konfirmasi Password Baru</label>
                        <input type="password" id="confirmPassword" required>
                    </div>
                    <button type="submit" class="btn-pinjam">Ubah Password</button>
                </form>
                <div id="passwordStatus"></div>
            </div>
        </div>

        <div class="profile-card">
            <h3><i class="fas fa-book-open"></i> Buku yang Sedang Dipinjam</h3>
            <div id="bukuDipinjam"></div>
        </div>
    </div>

    <?php require_once '../../components/client/clientFooter.php'; ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js"></script>
    <script src="../../assets/js/script.js"></script>
    <script src="../../assets/js/profile.js"></script>
</body>
</html>