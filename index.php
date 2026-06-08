<?php 
require_once __DIR__ . '/includes/bootstrap.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_comment'])) {
    $nama = trim($_POST['nama'] ?? '');
    $komentar = trim($_POST['komentar'] ?? '');

    if ($nama !== '' && $komentar !== '') {
        if (addComment($nama, $komentar)) {
            setFlash('success', 'Komentar berhasil dikirim!');
            header("Location: " . $_SERVER['PHP_SELF'] . "#comments");
            exit;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Nadya Rabila — Portofolio</title>
</head>

<body>
    
    <nav class="navbar" id="navbar">
        <div class="container">
            <a href="#" class="logo">NaraDev<span>.</span></a>
            <div class="hamburger" id="hamburger">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <ul class="nav-links" id="navLinks">
                <li><a href="#home" class="active">Beranda</a></li>
                <li><a href="#about">Tentang</a></li>
                <li><a href="#certifications">Sertifikat</a></li>
                <li><a href="#achievements">Prestasi</a></li>
                <li><a href="#portfolio">Portofolio</a></li>
                <li><a href="#gallery">Galeri</a></li>
                <li><a href="#contact">Kontak</a></li>
            </ul>
        </div>
    </nav>

    
    <?php $siteSettings = getSiteSettings(); ?>
    <section class="hero" id="home">
        <div class="container">
            <div class="hero-text">
                <p class="greeting"><?= e((string) $siteSettings['greeting']) ?></p>
                <h1><?= e((string) $siteSettings['full_name']) ?></h1>
                <p class="tagline">
                    <?= (string) $siteSettings['tagline'] ?>
                </p>
                <div class="cta-buttons">
                    <a href="#about" class="btn btn-primary">Jelajahi Profil</a>
                    <a href="#contact" class="btn btn-outline">Hubungi Saya</a>
                </div>
            </div>
            <div class="hero-image">
                <div class="profile-photo-wrapper">
                    <div class="profile-photo">
                        <img src="<?= e((string) $siteSettings['profile_image']) ?>" alt="<?= e((string) $siteSettings['full_name']) ?>">
                    </div>
                </div>
            </div>
        </div>
    </section>

    
    <section class="music-player-section" id="music-player">
        <div class="container">
            <div class="music-player-card">
                <div class="music-player-header">
                    <div class="music-icon">
                        <i class="fas fa-music"></i>
                    </div>
                    <div class="music-info">
                        <h4 class="music-title" id="musicTitle">Pilih Lagu Favorit</h4>
                        <p class="music-artist" id="musicArtist">Nadya's Playlist</p>
                    </div>
                    <button class="music-toggle-btn" id="musicToggleBtn" title="Sembunyikan Player">
                        <i class="fas fa-chevron-up"></i>
                    </button>
                </div>

                <div class="music-player-body" id="musicPlayerBody">
                    
                    <div class="music-progress-container">
                        <div class="music-progress-bar" id="musicProgressBar">
                            <div class="music-progress-fill" id="musicProgressFill"></div>
                            <div class="music-progress-thumb" id="musicProgressThumb"></div>
                        </div>
                        <div class="music-time">
                            <span id="currentTime">0:00</span>
                            <span id="durationTime">0:00</span>
                        </div>
                    </div>

                    
                    <div class="music-controls">
                        <button class="music-ctrl-btn" id="prevBtn" title="Lagu Sebelumnya">
                            <i class="fas fa-backward"></i>
                        </button>
                        <button class="music-ctrl-btn music-play-btn" id="playBtn">
                            <i class="fas fa-play"></i>
                        </button>
                        <button class="music-ctrl-btn" id="nextBtn" title="Lagu Selanjutnya">
                            <i class="fas fa-forward"></i>
                        </button>
                    </div>

                    
                    <div class="music-playlist">
                        <p class="playlist-label">🎵 Pilih Lagu:</p>
                        <div class="playlist-items" id="playlistItems">
                            
                        </div>
                    </div>

                    
                    <div class="music-volume">
                        <i class="fas fa-volume-up" id="volumeIcon"></i>
                        <input type="range" class="volume-slider" id="volumeSlider" min="0" max="100" value="70">
                    </div>
                </div>

                
                <button class="music-expand-btn" id="musicExpandBtn" style="display: none;" title="Tampilkan Player">
                    <i class="fas fa-music"></i> Putar Lagu
                </button>
            </div>
        </div>
    </section>

    
    <section class="about" id="about">
        <div class="container">
            <h2 class="section-title">Tentang Saya</h2>
            <div class="about-content">
                
                <div>
                    
                    <div class="card" style="margin-bottom: 2rem;">
                        <h3 style="margin-bottom: 1.2rem;">🎓 Pendidikan</h3>

                        <div class="timeline-item-with-logo">
                            <div class="logo-placeholder">
                                <img src="img/logo_unsam.png" alt="Logo Universitas Samudra">
                            </div>
                            <div class="timeline-content">
                                <h4>Universitas Samudra – Informatika</h4>
                                <div class="date">Juli 2024 – Sekarang</div>
                                <p>
                                    • Awardee Beasiswa Unggulan 2024<br>
                                    • Finalis Pilmapres Universitas 2025<br>
                                    • Top 5 NUDC Universitas Samudra 2025<br>
                                    • Tim PKM-KC "Panic Guard" 2025<br>
                                    • Ketua Tim P2MW "PrintGo" 2026 <br>
                                    • Finalis NUDC Universitas Samudra 2026
                                </p>
                            </div>
                        </div>

                        <div class="timeline-item-with-logo">
                            <div class="logo-placeholder">
                                <img src="img/logo_stm.png" alt="Logo SMK Negeri 2 Langsa">
                            </div>
                            <div class="timeline-content">
                                <h4>SMK Negeri 2 Langsa – RPL</h4>
                                <div class="date">Juli 2021 – Mei 2024</div>
                                <p>
                                    • Juara 1 KIHAJAR STEM Provinsi & Nasional (2022)<br>
                                    • Medali Emas Olimpiade Informatika Nasional (2023)<br>
                                    • Siswa Eligible Peringkat 1 SNBP Se-Prodi (2024)<br>
                                    • Juara 1 Cerdas Cermat Classmeet (2022, 2023)
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <h3 style="margin-bottom: 1.2rem;">💼 Pengalaman Kerja</h3>
                        <div class="timeline-item-with-logo">
                            <div class="logo-placeholder">
                                <img src="img/logo_diskominfo.png" alt="Logo Diskominfo">
                            </div>
                            <div class="timeline-content">
                                <h4>Dinas Komunikasi dan Informatika Kota Langsa</h4>
                                <div class="date">Bidang TIK · Juli 2023 – Oktober 2023</div>
                                <p>
                                    • Membantu pembuatan materi sosialisasi publik (video HUT Pemko Langsa & HUT RI)<br>
                                    • Membantu pengelolaan ruang server dan pemantauan CCTV skala kota<br>
                                    • Mempelajari langsung manajemen sistem informasi dan website bersama Kepala Bidang
                                    TIK
                                </p>
                                <button class="btn btn-outline cert-btn" onclick="openModal('img/Sertifikat_PKL.jpeg')"
                                    style="font-size: 0.8rem; padding: 0.4rem 1.2rem; margin-top: 0.8rem;">
                                    <i class="fas fa-eye"></i> Lihat Sertifikat
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <div class="card" style="margin-bottom: 2rem;">
                        <h3 style="margin-bottom: 1rem;">💡 Minat & Tujuan Karier</h3>
                        <p style="color: var(--gray); margin-bottom: 1rem;">
                            Saya tertarik dalam bidang <strong>web development</strong>, english communication, dan
                            program mentoring. Impian saya adalah menjadi seorang full-stack developer yang dapat
                            menciptakan inovasi digital bermanfaat.
                        </p>
                        <p style="color: var(--gray);">
                            🎹 Di luar dunia akademik, saya senang mengisi waktu luang dengan bermain piano, gitar,
                            menonton anime, drama Korea, dan membaca komik.
                        </p>
                    </div>

                    <div class="card" style="margin-bottom: 2rem;">
                        <h3 style="margin-bottom: 1rem;">🛠️ Keahlian</h3>
                        <div class="skill-cloud">
                            <span class="badge">Public Speaking</span>
                            <span class="badge">UI/UX Design Dasar</span>
                            <span class="badge">HTML/CSS</span>
                            <span class="badge">JavaScript</span>
                            <span class="badge">PHP</span>
                            <span class="badge">Python</span>
                            <span class="badge">Microsoft Office</span>
                            <span class="badge">Canva for Education</span>
                            <span class="badge">Penulisan Esai</span>
                            <span class="badge">Mentoring</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php require __DIR__ . '/partials/certifications-section.php'; ?>

    
    <div class="modal-overlay" id="certModal" onclick="closeModal()">
        <div class="modal-content" onclick="event.stopPropagation()">
            <span class="modal-close" onclick="closeModal()">&times;</span>
            <img id="certImage" src="" alt="Sertifikat">
        </div>
    </div>

<?php require __DIR__ . '/partials/achievements-section.php'; ?>

<?php require __DIR__ . '/partials/portfolio-section.php'; ?>

<?php require __DIR__ . '/partials/gallery-section.php'; ?>

    
    <section class="contact" id="contact">
        <div class="container">
            <h2 class="section-title">Kontak</h2>
            <div class="contact-grid">
                <?php
                $allContacts = getAllContacts();
                if ($allContacts === []):
                ?>
                    <p style="text-align: center; color: var(--gray); width: 100%;">Belum ada informasi kontak.</p>
                <?php else: ?>
                    <?php foreach ($allContacts as $contact): ?>
                        <?php if ($contact['url']): ?>
                            <a href="<?= e((string) $contact['url']) ?>" target="_blank" class="contact-item">
                                <div class="contact-icon"><i class="<?= e((string) $contact['icon_class']) ?>"></i></div>
                                <div class="contact-label"><?= e((string) $contact['label']) ?></div>
                                <div class="contact-value"><?= e((string) $contact['username']) ?></div>
                            </a>
                        <?php else: ?>
                            <div class="contact-item">
                                <div class="contact-icon"><i class="<?= e((string) $contact['icon_class']) ?>"></i></div>
                                <div class="contact-label"><?= e((string) $contact['label']) ?></div>
                                <div class="contact-value"><?= e((string) $contact['username']) ?></div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </section>

<?php require __DIR__ . '/partials/comments-section.php'; ?>

    
    <footer>
        <div class="container">
            <p><?= (string) $siteSettings['footer_text'] ?> <span><?= e((string) $siteSettings['footer_name']) ?></span></p>
            <div style="margin-top: 1rem; opacity: 0.5;">
                <a href="admin/auth/login.php" style="color: var(--gray); text-decoration: none; font-size: 0.75rem; transition: all 0.3s ease; display: inline-flex; align-items: center; gap: 0.4rem;">
                    <i class="fas fa-cog" style="font-size: 0.7rem;"></i> Admin Panel
                </a>
            </div>
        </div>
    </footer>

    <script>
        const navbar = document.getElementById('navbar');
        window.addEventListener('scroll', () => {
            navbar.classList.toggle('scrolled', window.scrollY > 50);
        });

        const hamburger = document.getElementById('hamburger');
        const navLinks = document.getElementById('navLinks');
        hamburger.addEventListener('click', () => {
            hamburger.classList.toggle('active');
            navLinks.classList.toggle('active');
        });
        document.querySelectorAll('.nav-links a').forEach(link => {
            link.addEventListener('click', () => {
                hamburger.classList.remove('active');
                navLinks.classList.remove('active');
            });
        });

        const sections = document.querySelectorAll('section');
        const navItems = document.querySelectorAll('.nav-links a');
        window.addEventListener('scroll', () => {
            let current = '';
            sections.forEach(section => {
                if (window.scrollY >= section.offsetTop - 200) {
                    current = section.getAttribute('id');
                }
            });
            navItems.forEach(item => {
                item.classList.remove('active');
                if (item.getAttribute('href') === `#${current}`) {
                    item.classList.add('active');
                }
            });
        });

        function openModal(imgSrc) {
            document.getElementById('certImage').src = imgSrc;
            document.getElementById('certModal').classList.add('active');
            document.body.style.overflow = 'hidden';
        }
        function closeModal() {
            document.getElementById('certModal').classList.remove('active');
            document.body.style.overflow = '';
        }
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') closeModal();
        });

        const playlist = <?= json_encode(array_map(function($track) {
            return [
                'title' => (string)$track['title'],
                'artist' => (string)$track['artist'],
                'src' => (string)$track['audio_file'],
                'cover' => (string)($track['cover_image'] ?? '')
            ];
        }, getAllMusicTracks())) ?>;

        if (playlist.length === 0) {
            playlist.push({
                title: "Belum ada lagu",
                artist: "Silakan tambah di admin",
                src: "",
                cover: ""
            });
        }

        let currentTrack = 0;
        let isPlaying = false;
        let audio = new Audio();

        const musicPlayerCard = document.querySelector('.music-player-card');
        const musicIcon = document.querySelector('.music-icon');
        const musicTitle = document.getElementById('musicTitle');
        const musicArtist = document.getElementById('musicArtist');
        const playBtn = document.getElementById('playBtn');
        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');
        const progressFill = document.getElementById('musicProgressFill');
        const progressBar = document.getElementById('musicProgressBar');
        const currentTimeEl = document.getElementById('currentTime');
        const durationTimeEl = document.getElementById('durationTime');
        const volumeSlider = document.getElementById('volumeSlider');
        const volumeIcon = document.getElementById('volumeIcon');
        const musicToggleBtn = document.getElementById('musicToggleBtn');
        const musicPlayerBody = document.getElementById('musicPlayerBody');
        const musicExpandBtn = document.getElementById('musicExpandBtn');
        const playlistItemsContainer = document.getElementById('playlistItems');

        audio.volume = 0.7;
        volumeSlider.value = 70;

        function renderPlaylist() {
            playlistItemsContainer.innerHTML = '';
            playlist.forEach((song, index) => {
                const item = document.createElement('div');
                item.className = 'playlist-item';
                if (index === currentTrack) item.classList.add('active');
                item.textContent = song.title;
                item.addEventListener('click', () => {
                    currentTrack = index;
                    loadTrack(currentTrack);
                    playAudio();
                    updatePlaylistActive();
                });
                playlistItemsContainer.appendChild(item);
            });
        }

        function updatePlaylistActive() {
            document.querySelectorAll('.playlist-item').forEach((item, index) => {
                item.classList.toggle('active', index === currentTrack);
            });
        }

        function loadTrack(index) {
            audio.src = playlist[index].src;
            musicTitle.textContent = playlist[index].title;
            musicArtist.textContent = playlist[index].artist;
            
            if (playlist[index].cover) {
                musicIcon.style.backgroundImage = `url('${playlist[index].cover}')`;
                musicIcon.style.backgroundSize = 'cover';
                musicIcon.style.backgroundPosition = 'center';
                musicIcon.innerHTML = '';
            } else {
                musicIcon.style.backgroundImage = '';
                musicIcon.innerHTML = '<i class="fas fa-music"></i>';
            }
            
            audio.load();
        }

        function formatTime(seconds) {
            if (isNaN(seconds)) return "0:00";
            const min = Math.floor(seconds / 60);
            const sec = Math.floor(seconds % 60);
            return `${min}:${sec < 10 ? '0' : ''}${sec}`;
        }

        function playAudio() {
            audio.play().then(() => {
                isPlaying = true;
                playBtn.innerHTML = '<i class="fas fa-pause"></i>';
                musicPlayerCard.classList.add('playing');
            }).catch(err => console.log("Playback prevented:", err));
        }

        function pauseAudio() {
            audio.pause();
            isPlaying = false;
            playBtn.innerHTML = '<i class="fas fa-play"></i>';
            musicPlayerCard.classList.remove('playing');
        }

        playBtn.addEventListener('click', () => {
            if (!audio.src || audio.src === window.location.href) {
                loadTrack(currentTrack);
            }
            if (isPlaying) {
                pauseAudio();
            } else {
                playAudio();
            }
        });

        prevBtn.addEventListener('click', () => {
            currentTrack = (currentTrack - 1 + playlist.length) % playlist.length;
            loadTrack(currentTrack);
            playAudio();
            updatePlaylistActive();
        });

        nextBtn.addEventListener('click', () => {
            currentTrack = (currentTrack + 1) % playlist.length;
            loadTrack(currentTrack);
            playAudio();
            updatePlaylistActive();
        });

        audio.addEventListener('timeupdate', () => {
            if (audio.duration) {
                const progress = (audio.currentTime / audio.duration) * 100;
                progressFill.style.width = progress + '%';
                currentTimeEl.textContent = formatTime(audio.currentTime);
            }
        });

        audio.addEventListener('loadedmetadata', () => {
            durationTimeEl.textContent = formatTime(audio.duration);
        });

        progressBar.addEventListener('click', (e) => {
            const rect = progressBar.getBoundingClientRect();
            const clickX = e.clientX - rect.left;
            const width = rect.width;
            const seekTime = (clickX / width) * audio.duration;
            audio.currentTime = seekTime;
        });

        volumeSlider.addEventListener('input', () => {
            audio.volume = volumeSlider.value / 100;
            if (audio.volume === 0) {
                volumeIcon.className = 'fas fa-volume-mute';
            } else if (audio.volume < 0.5) {
                volumeIcon.className = 'fas fa-volume-down';
            } else {
                volumeIcon.className = 'fas fa-volume-up';
            }
        });

        let isPlayerCollapsed = false;
        musicToggleBtn.addEventListener('click', () => {
            isPlayerCollapsed = !isPlayerCollapsed;
            if (isPlayerCollapsed) {
                musicPlayerCard.classList.add('collapsed');
                musicToggleBtn.innerHTML = '<i class="fas fa-chevron-down"></i>';
                musicExpandBtn.style.display = 'flex';
            } else {
                musicPlayerCard.classList.remove('collapsed');
                musicToggleBtn.innerHTML = '<i class="fas fa-chevron-up"></i>';
                musicExpandBtn.style.display = 'none';
            }
        });

        musicExpandBtn.addEventListener('click', () => {
            isPlayerCollapsed = false;
            musicPlayerCard.classList.remove('collapsed');
            musicToggleBtn.innerHTML = '<i class="fas fa-chevron-up"></i>';
            musicExpandBtn.style.display = 'none';
        });

        audio.addEventListener('ended', () => {
            currentTrack = (currentTrack + 1) % playlist.length;
            loadTrack(currentTrack);
            playAudio();
            updatePlaylistActive();
        });

        renderPlaylist();
        loadTrack(currentTrack);

        const themeToggle = document.getElementById('themeToggle');
        const themeToggleMobile = document.getElementById('themeToggleMobile');

        function toggleTheme() {
            document.body.classList.toggle('light-mode');
            const isLight = document.body.classList.contains('light-mode');
            const icon = isLight ? 'fa-moon' : 'fa-sun';
            if (themeToggle) themeToggle.innerHTML = `<i class="fas ${icon}"></i>`;
            if (themeToggleMobile) themeToggleMobile.innerHTML = `<i class="fas ${icon}"></i>`;
            localStorage.setItem('theme', isLight ? 'light' : 'dark');
        }

        if (themeToggle) themeToggle.addEventListener('click', toggleTheme);
        if (themeToggleMobile) themeToggleMobile.addEventListener('click', toggleTheme);

        if (localStorage.getItem('theme') === 'light') {
            document.body.classList.add('light-mode');
            if (themeToggle) themeToggle.innerHTML = '<i class="fas fa-moon"></i>';
            if (themeToggleMobile) themeToggleMobile.innerHTML = '<i class="fas fa-moon"></i>';
        }
    </script>
</body>

</html>