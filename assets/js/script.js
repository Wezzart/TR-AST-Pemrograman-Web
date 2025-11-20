// ===== DATA BUKU =====
const booksData = [
    {
        id: 1,
        title: "The Midnight Library",
        author: "Matt Haig",
        genre: "Fiction",
        year: 2020,
        description: "Sebuah novel tentang kehidupan, kematian, dan segala kemungkinan di antaranya. Nora Seed menemukan perpustakaan misterius yang berisi buku-buku tentang kehidupan alternatif yang mungkin dia jalani."
    },
    {
        id: 2,
        title: "Educated",
        author: "Tara Westover",
        genre: "Biography",
        year: 2018,
        description: "Memoar yang menakjubkan tentang seorang wanita muda yang, meskipun tidak pernah memasuki ruang kelas, belajar sendiri cukup untuk masuk ke universitas bergengsi, dan akhirnya mendapatkan PhD dari Cambridge University."
    },
    {
        id: 3,
        title: "Sapiens: A Brief History of Humankind",
        author: "Yuval Noah Harari",
        genre: "Non-Fiction",
        year: 2024,
        description: "Sebuah eksplorasi radikal tentang sejarah umat manusia dari zaman batu hingga abad ke-21, menggali bagaimana Homo sapiens menjadi spesies dominan di planet ini."
    }
];

// ===== STATE =====
let filteredBooks = [...booksData];
let currentTheme = localStorage.getItem('theme') || 'dark';

// ===== PARTICLE ANIMATION =====
class ParticleAnimation {
    constructor() {
        this.canvas = document.getElementById('particleCanvas');
        this.ctx = this.canvas.getContext('2d');
        this.particles = [];
        this.particleCount = 50;
        
        this.resize();
        this.createParticles();
        this.animate();
        
        window.addEventListener('resize', () => this.resize());
    }
    
    resize() {
        this.canvas.width = window.innerWidth;
        this.canvas.height = window.innerHeight;
    }
    
    createParticles() {
        for (let i = 0; i < this.particleCount; i++) {
            this.particles.push({
                x: Math.random() * this.canvas.width,
                y: Math.random() * this.canvas.height,
                vx: (Math.random() - 0.5) * 0.5,
                vy: (Math.random() - 0.5) * 0.5,
                radius: Math.random() * 2 + 1
            });
        }
    }
    
    animate() {
        this.ctx.clearRect(0, 0, this.canvas.width, this.canvas.height);
        
        // Update and draw particles
        this.particles.forEach(particle => {
            particle.x += particle.vx;
            particle.y += particle.vy;
            
            // Wrap around edges
            if (particle.x < 0) particle.x = this.canvas.width;
            if (particle.x > this.canvas.width) particle.x = 0;
            if (particle.y < 0) particle.y = this.canvas.height;
            if (particle.y > this.canvas.height) particle.y = 0;
            
            // Draw particle
            this.ctx.beginPath();
            this.ctx.arc(particle.x, particle.y, particle.radius, 0, Math.PI * 2);
            this.ctx.fillStyle = currentTheme === 'dark' 
                ? 'rgba(201, 169, 110, 0.3)' 
                : 'rgba(93, 138, 138, 0.2)';
            this.ctx.fill();
        });
        
        // Draw connections
        this.particles.forEach((p1, i) => {
            this.particles.slice(i + 1).forEach(p2 => {
                const dx = p1.x - p2.x;
                const dy = p1.y - p2.y;
                const distance = Math.sqrt(dx * dx + dy * dy);
                
                if (distance < 150) {
                    this.ctx.beginPath();
                    this.ctx.strokeStyle = currentTheme === 'dark'
                        ? `rgba(201, 169, 110, ${0.15 * (1 - distance / 150)})`
                        : `rgba(93, 138, 138, ${0.1 * (1 - distance / 150)})`;
                    this.ctx.lineWidth = 0.5;
                    this.ctx.moveTo(p1.x, p1.y);
                    this.ctx.lineTo(p2.x, p2.y);
                    this.ctx.stroke();
                }
            });
        });
        
        requestAnimationFrame(() => this.animate());
    }
}

// ===== THEME TOGGLE =====
function initTheme() {
    if (currentTheme === 'dark') {
        document.body.classList.add('dark-theme');
    }
}

document.getElementById('themeToggle').addEventListener('click', () => {
    document.body.classList.toggle('dark-theme');
    currentTheme = document.body.classList.contains('dark-theme') ? 'dark' : 'light';
    localStorage.setItem('theme', currentTheme);
});

// ===== RENDER BOOKS =====
function renderBooks(books) {
    const bookGrid = document.getElementById('bookGrid');
    const bookCount = document.getElementById('bookCount');
    
    bookCount.textContent = `Menampilkan ${books.length} buku`;
    
    if (books.length === 0) {
        bookGrid.innerHTML = `
            <div style="grid-column: 1/-1; text-align: center; padding: 3rem; color: var(--text-muted);">
                <h3 style="font-family: var(--font-serif); font-size: 1.5rem; margin-bottom: 1rem;">Tidak ada buku ditemukan</h3>
                <p>Coba ubah filter atau kata kunci pencarian Anda</p>
            </div>
        `;
        return;
    }
    
    bookGrid.innerHTML = books.map(book => `
        <div class="book-card" data-id="${book.id}">
            <div class="book-cover"></div>
            <div class="book-info">
                <h3 class="book-title">${book.title}</h3>
                <p class="book-author">oleh ${book.author}</p>
                <div class="book-meta">
                    <span class="book-genre">${book.genre}</span>
                    <span class="book-year">${book.year}</span>
                </div>
            </div>
        </div>
    `).join('');
    
    // Add click event to each card
    document.querySelectorAll('.book-card').forEach(card => {
        card.addEventListener('click', () => {
            const bookId = parseInt(card.dataset.id);
            showBookDetail(bookId);
        });
    });
}

// ===== SHOW BOOK DETAIL =====
function showBookDetail(bookId) {
    const book = booksData.find(b => b.id === bookId);
    if (!book) return;
    
    const modal = document.getElementById('bookModal');
    const modalBody = document.getElementById('modalBody');
    
    modalBody.innerHTML = `
        <div class="modal-book-cover"></div>
        <h2 class="modal-book-title">${book.title}</h2>
        <p class="modal-book-author">oleh ${book.author}</p>
        <div class="modal-book-info">
            <div class="info-item">
                <span class="info-label">Genre</span>
                <span class="info-value">${book.genre}</span>
            </div>
            <div class="info-item">
                <span class="info-label">Tahun Terbit</span>
                <span class="info-value">${book.year}</span>
            </div>
        </div>
        <p class="modal-book-description">${book.description}</p>
    `;
    
    modal.classList.add('active');
}

// ===== SEARCH FUNCTIONALITY =====
document.getElementById('searchInput').addEventListener('input', (e) => {
    const searchTerm = e.target.value.toLowerCase();
    applyFilters(searchTerm);
});

// ===== FILTER FUNCTIONALITY =====
function applyFilters(searchTerm = '') {
    const genreFilter = document.getElementById('genreFilter').value;
    const yearFilter = document.getElementById('yearFilter').value;
    const sortFilter = document.getElementById('sortFilter').value;
    
    // Apply filters
    filteredBooks = booksData.filter(book => {
        const matchesSearch = searchTerm === '' || 
            book.title.toLowerCase().includes(searchTerm) ||
            book.author.toLowerCase().includes(searchTerm);
        
        const matchesGenre = genreFilter === '' || book.genre === genreFilter;
        const matchesYear = yearFilter === '' || book.year.toString() === yearFilter;
        
        return matchesSearch && matchesGenre && matchesYear && matchesRating;
    });
    
    // Apply sorting
    if (sortFilter === 'newest') {
        filteredBooks.sort((a, b) => b.year - a.year);
    } else if (sortFilter === 'title') {
        filteredBooks.sort((a, b) => a.title.localeCompare(b.title));
    }
    
    renderBooks(filteredBooks);
}

// Add event listeners to filters
document.getElementById('genreFilter').addEventListener('change', () => applyFilters(document.getElementById('searchInput').value.toLowerCase()));
document.getElementById('yearFilter').addEventListener('change', () => applyFilters(document.getElementById('searchInput').value.toLowerCase()));
document.getElementById('sortFilter').addEventListener('change', () => applyFilters(document.getElementById('searchInput').value.toLowerCase()));

// Reset filters
document.getElementById('resetFilters').addEventListener('click', () => {
    document.getElementById('searchInput').value = '';
    document.getElementById('genreFilter').value = '';
    document.getElementById('yearFilter').value = '';
    document.getElementById('sortFilter').value = 'newest';
    applyFilters();
});

// ===== MODAL FUNCTIONALITY =====
document.querySelectorAll('.modal-close').forEach(btn => {
    btn.addEventListener('click', () => {
        document.querySelectorAll('.modal').forEach(modal => {
            modal.classList.remove('active');
        });
    });
});

// Close modal when clicking outside
document.querySelectorAll('.modal').forEach(modal => {
    modal.addEventListener('click', (e) => {
        if (e.target === modal) {
            modal.classList.remove('active');
        }
    });
});

// ===== LOGIN FUNCTIONALITY =====
document.getElementById('loginBtn').addEventListener('click', () => {
    document.getElementById('loginModal').classList.add('active');
});

document.getElementById('closeLogin').addEventListener('click', () => {
    document.getElementById('loginModal').classList.remove('active');
});

document.getElementById('loginForm').addEventListener('submit', (e) => {
    e.preventDefault();
    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;
    
    if (username === 'admin' && password === 'admin') {
        // Redirect to admin page
        window.location.href = 'admin.html';
    } else {
        alert('Login berhasil! Selamat datang, ' + username);
        document.getElementById('loginModal').classList.remove('active');
        document.getElementById('loginForm').reset();
    }
});

// ===== INITIALIZATION =====
document.addEventListener('DOMContentLoaded', () => {
    initTheme();
    new ParticleAnimation();
    renderBooks(booksData);
});