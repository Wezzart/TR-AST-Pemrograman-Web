function loadProfileData() {
    const formData = new FormData();
    formData.append('getProfileData', '1');
    
    fetch('../../controller/user.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.error) {
            alert('Error: ' + data.error);
        } else {
            document.getElementById('profileUsername').textContent = data.username;
            document.getElementById('profileRole').textContent = data.role === 'anggota' ? 'Anggota' : data.role;
            document.getElementById('totalPinjam').textContent = data.total_pinjam;
        }
    })
    .catch(error => console.error('Error:', error));
}

function loadBukuDipinjam() {
    const formData = new FormData();
    formData.append('getBukuPinjaman', '1');
    
    fetch('../../controller/user.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        const container = document.getElementById('bukuDipinjam');
        
        if (Array.isArray(data) && data.length > 0) {
            let html = '<div class="book-list">';
            data.forEach(buku => {
                html += `
                    <div class="book-card-mini">
                        <h4>${buku.nama_buku}</h4>
                        <p><strong>Penulis:</strong> ${buku.penulis_buku}</p>
                        <p><strong>Genre:</strong> ${buku.genre_buku}</p>
                    </div>
                `;
            });
            html += '</div>';
            container.innerHTML = html;
        } else {
            container.innerHTML = '<p class="no-data">Tidak ada buku yang sedang dipinjam</p>';
        }
    })
    .catch(error => console.error('Error:', error));
}

document.getElementById('changePasswordForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const oldPassword = document.getElementById('oldPassword').value;
    const newPassword = document.getElementById('newPassword').value;
    const confirmPassword = document.getElementById('confirmPassword').value;
    
    if (newPassword !== confirmPassword) {
        document.getElementById('passwordStatus').innerHTML = 
            '<p class="error">Password baru tidak cocok!</p>';
        return;
    }
    
    const formData = new FormData();
    formData.append('changePassword', '1');
    formData.append('oldPassword', oldPassword);
    formData.append('newPassword', newPassword);
    
    fetch('../../controller/user.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        const status = document.getElementById('passwordStatus');
        
        if (data.status === 'success') {
            status.innerHTML = `<p class="success">${data.message}</p>`;
            document.getElementById('changePasswordForm').reset();
            
            setTimeout(() => {
                status.innerHTML = '';
            }, 3000);
        } else {
            status.innerHTML = `<p class="error">${data.message}</p>`;
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan');
    });
});

document.addEventListener('DOMContentLoaded', function() {
    loadProfileData();
    loadBukuDipinjam();
});
