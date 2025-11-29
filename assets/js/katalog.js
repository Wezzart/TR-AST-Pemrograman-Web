// Fungsi untuk mencari buku
function cariBuku() {
    const namaBuku = document.getElementById('namaBuku').value;
    
    if (!namaBuku.trim()) {
        alert('Masukkan nama buku untuk dicari');
        return;
    }
    
    const formData = new FormData();
    formData.append('cariBuku', '1');
    formData.append('namaBuku', namaBuku);
    
    fetch('../../controller/user.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        const hasil = document.getElementById('hasilCari');
        
        if (data.message) {
            hasil.innerHTML = `<p class="error">${data.message}</p>`;
        } else {
            if (Array.isArray(data)) {
                let html = '<div class="book-list">';
                data.forEach(buku => {
                    html += createBookCard(buku);
                });
                html += '</div>';
                hasil.innerHTML = html;
            } else {
                // Single result
                hasil.innerHTML = createBookCard(data);
            }
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat mencari buku');
    });
}

// Fungsi untuk membuat card buku
function createBookCard(buku) {
    return `
        <div class="book-card">
            <h3>${buku.nama_buku}</h3>
            <p><strong>ID:</strong> ${buku.id_buku}</p>
            <p><strong>Penulis:</strong> ${buku.penulis_buku}</p>
            <p><strong>Genre:</strong> ${buku.genre_buku}</p>
            <p><strong>Tahun Terbit:</strong> ${buku.tahun_terbit}</p>
            <p><strong>Stok:</strong> ${buku.jumlah_buku}</p>
            ${buku.jumlah_buku > 0 
                ? `<button class="btn-pinjam" onclick="pinjamBuku('${buku.nama_buku}')">Pinjam Buku</button>` 
                : `<span class="stok-habis">Stok Habis</span>`
            }
        </div>
    `;
}

// Fungsi untuk meminjam buku
function pinjamBuku(namaBuku) {
    if (!confirm(`Apakah Anda yakin ingin meminjam buku "${namaBuku}"?`)) {
        return;
    }
    
    const formData = new FormData();
    formData.append('pinjamBuku', '1');
    formData.append('namaBuku', namaBuku);
    
    fetch('../../controller/user.php', {
        method: 'POST',
        body: formData 
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            alert(data.message);

            cariBuku();
        } else {
            alert('Error: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat meminjam buku');
    });
}

// Event listener untuk Enter key pada input search
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('namaBuku');
    if (searchInput) {
        searchInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                cariBuku();
            }
        });
    }
});
