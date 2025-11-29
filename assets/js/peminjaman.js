// Fungsi untuk load buku yang sedang dipinjam
function loadBukuPinjaman() {
    const formData = new FormData();
    formData.append('getBukuPinjaman', '1');
    
    fetch('../../controller/user.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        const listContainer = document.getElementById('listBukuPinjaman');
        
        if (Array.isArray(data) && data.length > 0) {
            let html = '<div class="book-list">';
            data.forEach(buku => {
                html += createBorrowedBookCard(buku);
            });
            html += '</div>';
            listContainer.innerHTML = html;
        } else {
            listContainer.innerHTML = '<p class="no-data">Anda belum meminjam buku apapun.</p>';
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat memuat data');
    });
}

// Fungsi untuk membuat card buku yang dipinjam
function createBorrowedBookCard(buku) {
    return `
        <div class="book-card">
            <h3>${buku.nama_buku}</h3>
            <p><strong>ID:</strong> ${buku.id_buku}</p>
            <p><strong>Penulis:</strong> ${buku.penulis_buku}</p>
            <p><strong>Genre:</strong> ${buku.genre_buku}</p>
            <p><strong>Tahun Terbit:</strong> ${buku.tahun_terbit}</p>
            <button class="btn-return" onclick="kembalikanBuku('${buku.nama_buku}')">Kembalikan Buku</button>
        </div>
    `;
}

// Fungsi untuk mengembalikan buku
function kembalikanBuku(namaBuku) {
    if (!confirm(`Apakah Anda yakin ingin mengembalikan buku "${namaBuku}"?`)) {
        return;
    }
    
    const formData = new FormData();
    formData.append('kembalikanBuku', '1');
    formData.append('namaBuku', namaBuku);
    
    fetch('../../controller/user.php', {
        method: 'POST',
        body: formData 
    })
    .then(response => response.json())
    .then(data => {
        const status = document.getElementById('statusKembali');
        
        if (data.status === 'success') {
            status.innerHTML = `<p class="success">${data.message}</p>`;
            
            // Reload list buku pinjaman
            loadBukuPinjaman();
            
            // Hapus pesan setelah 3 detik
            setTimeout(() => {
                status.innerHTML = '';
            }, 3000);
        } else {
            status.innerHTML = `<p class="error">${data.message}</p>`;
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat mengembalikan buku');
    });
}

// Load buku pinjaman saat halaman dimuat
document.addEventListener('DOMContentLoaded', function() {
    loadBukuPinjaman();
});
