// Fungsi untuk load genre options
function loadGenres() {
    const formData = new FormData();
    formData.append('getGenres', '1');
    
    fetch('../../controller/user.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(genres => {
        const select = document.getElementById('genreFilter');
        genres.forEach(genre => {
            const option = document.createElement('option');
            option.value = genre;
            option.textContent = genre;
            select.appendChild(option);
        });
    })
    .catch(error => console.error('Error loading genres:', error));
}

// Fungsi untuk mencari buku
function cariBuku() {
    const namaBuku = document.getElementById('namaBuku').value;
    const genre = document.getElementById('genreFilter').value;
    
    const formData = new FormData();
    formData.append('cariBuku', '1');
    formData.append('namaBuku', namaBuku);
    formData.append('genre', genre);
    
    fetch('../../controller/user.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        const hasil = document.getElementById('hasilCari');
        
        if (Array.isArray(data) && data.length > 0) {
            let html = '<div class="book-list">';
            data.forEach(buku => {
                html += createBookCard(buku);
            });
            html += '</div>';
            hasil.innerHTML = html;
        } else {
            hasil.innerHTML = '<p class="no-data">Tidak ada buku ditemukan.</p>';
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

document.addEventListener('DOMContentLoaded', function() {
    loadGenres();
    cariBuku();
    const searchInput = document.getElementById('namaBuku');
    if (searchInput) {
        searchInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                cariBuku();
            }
        });
        searchInput.addEventListener('input', function() {
            cariBuku();
        });
    }
    
    // Auto-search saat genre berubah
    const genreFilter = document.getElementById('genreFilter');
    if (genreFilter) {
        genreFilter.addEventListener('change', function() {
            cariBuku();
        });
    }
});
