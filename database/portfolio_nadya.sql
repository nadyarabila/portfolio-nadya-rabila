-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Jun 07, 2026 at 11:22 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `portfolio_nadya`
--

-- --------------------------------------------------------

--
-- Table structure for table `achievements`
--

CREATE TABLE `achievements` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `year` varchar(10) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(500) NOT NULL DEFAULT '',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `achievements`
--

INSERT INTO `achievements` (`id`, `title`, `year`, `description`, `image`, `created_at`) VALUES
(1, '🏆 Juara 1 KIHAJAR STEM Tingkat Nasional', '2022', 'Juara 1 kategori Terkreatif dalam ajang KIHAJAR STEM Nasional jenjang SMK, setelah sebelumnya meraih Juara 1 di tingkat Provinsi Aceh.', 'uploads/achievements/achievements_7dce3f2c330542ea_1779983808.jpg', '2026-05-28 15:42:11'),
(2, '🥇 Medali Emas Olimpiade Pelajar Nasional – Informatika', '2023', 'Meraih Medali Emas dalam Olimpiade Pelajar Nasional bidang Informatika, menjadi pencapaian tertinggi di tingkat nasional.', 'uploads/achievements/achievements_320a686265ba1f7b_1779983739.jpg', '2026-05-28 15:42:11'),
(3, '🥇 Finalis Pemilihan Mahasiswa Berprestasi Universitas Samudra', '2025', 'Menjadi satu-satunya finalis yang berasal dari angkatan 2024 merupakan sebuah pengalaman berharga bagi saya.', 'uploads/achievements/achievements_9c04509efe68ab32_1779983853.jpeg', '2026-05-28 15:42:11');

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL COMMENT 'password_hash()'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`) VALUES
(1, 'nadya', '$2y$10$Ie1WfhGXhSePE0O4.0Zq3u7PVPsURfaKNigrvnqMMdQJ8qWi9mKi.');

-- --------------------------------------------------------

--
-- Table structure for table `certifications`
--

CREATE TABLE `certifications` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(500) NOT NULL DEFAULT '',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `certifications`
--

INSERT INTO `certifications` (`id`, `title`, `description`, `image`, `created_at`) VALUES
(1, '📝 UKBI – Predikat Sangat Unggul', 'Skor 681 · Uji Kemahiran Bahasa Indonesia', 'uploads/certifications/certifications_5f01473ff0f0e52f_1779983479.jpeg', '2026-05-28 15:42:11'),
(2, '💻 Belajar Dasar Pemrograman Web', 'Dicoding Indonesia · Mar 2026 – Mar 2029\r\nID: ERZRLGGV2ZYV · Skills: HTML, CSS', 'uploads/certifications/certifications_664c62a46f90d53e_1779983209.png', '2026-05-28 15:42:11'),
(3, '💰 Introduction to Financial Literacy', 'Dicoding Indonesia · Mar 2026 – Mar 2029 ID: 1RXYWOKGKZVM · Skills: Financial Planning', 'uploads/certifications/certifications_0fe877fd3bab5bef_1779983178.jpg', '2026-05-28 15:42:11'),
(4, '🌐 TOEFL Training – TOEFL Clinic Corner', 'Pelatihan persiapan TOEFL oleh IAIN Zawiyah Cot Kala Langsa', 'uploads/certifications/certifications_ed22575a6734d6d7_1779983130.jpeg', '2026-05-28 15:42:11'),
(6, '🎯 Part Of Speech English Training', 'Pelatihan bahasa Inggris oleh mahasiswa Prodi Pendidikan Bahasa Inggris FKIP selama 8 hari', 'uploads/certifications/certifications_c30955299af9b96f_1780853079.png', '2026-06-07 17:24:39');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `komentar` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `nama`, `komentar`, `created_at`) VALUES
(12, 'Chanyeol Park', '당신의 웹사이트는 정말 훌륭합니다!', '2026-06-07 21:11:38'),
(13, 'Levi Ackerman', 'とても良い', '2026-06-07 21:12:55'),
(14, 'Frieren', 'Wie lange haben Sie für die Erstellung dieser Website gebraucht?', '2026-06-07 21:14:00');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(10) UNSIGNED NOT NULL,
  `platform` varchar(100) NOT NULL,
  `label` varchar(100) NOT NULL DEFAULT '',
  `username` varchar(255) NOT NULL,
  `url` varchar(500) DEFAULT NULL,
  `icon_class` varchar(100) NOT NULL DEFAULT 'fas fa-link'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `platform`, `label`, `username`, `url`, `icon_class`) VALUES
(1, 'GitHub', 'GitHub', 'nadyarabila', 'https://github.com/nadyarabila', 'fab fa-github'),
(2, 'Email', 'Email', 'nadyarabila@gmail.com', 'mailto:nadyarabila@gmail.com', 'fas fa-envelope'),
(3, 'LinkedIn', 'LinkedIn', 'Nadya Rabila', 'https://www.linkedin.com/in/nadyarabila', 'fab fa-linkedin'),
(4, 'Instagram', 'Instagram', '@cnl_ndy', 'https://instagram.com/cnl_ndy', 'fab fa-instagram');

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `id` int(10) UNSIGNED NOT NULL,
  `image` varchar(500) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`id`, `image`, `created_at`) VALUES
(1, 'img/galeri/kihajar.jpeg', '2026-05-28 15:42:11'),
(2, 'img/galeri/kihajar3.jpeg', '2026-05-28 15:42:11'),
(3, 'img/galeri/kihajar_fotbar.jpeg', '2026-05-28 15:42:11'),
(4, 'img/galeri/kihajar_plakat.jpeg', '2026-05-28 15:42:11'),
(5, 'img/galeri/BU.jpeg', '2026-05-28 15:42:11'),
(6, 'img/galeri/pilmapres.jpeg', '2026-05-28 15:42:11'),
(7, 'img/galeri/nudc.jpeg', '2026-05-28 15:42:11'),
(8, 'img/galeri/pameran.jpeg', '2026-05-28 15:42:11'),
(9, 'img/galeri/cc.jpeg', '2026-05-28 15:42:11'),
(10, 'img/galeri/p2mw.jpeg', '2026-05-28 15:42:11'),
(11, 'img/galeri/nudc26_1.jpeg', '2026-05-28 15:42:11'),
(12, 'img/galeri/nudc26_2_1.jpeg', '2026-05-28 15:42:11'),
(13, 'img/galeri/newsa.jpeg', '2026-05-28 15:42:11'),
(14, 'img/galeri/tari.jpeg', '2026-05-28 15:42:11'),
(15, 'img/galeri/present_pmp.jpeg', '2026-05-28 15:42:11'),
(16, 'img/galeri/cc2.jpeg', '2026-05-28 15:42:11'),
(17, 'uploads/gallery/gallery_e4f53b7064c37da5_1780864415.jpeg', '2026-05-28 15:42:11');

-- --------------------------------------------------------

--
-- Table structure for table `music_tracks`
--

CREATE TABLE `music_tracks` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `artist` varchar(255) NOT NULL,
  `audio_file` varchar(500) NOT NULL,
  `cover_image` varchar(500) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `music_tracks`
--

INSERT INTO `music_tracks` (`id`, `title`, `artist`, `audio_file`, `cover_image`, `created_at`, `updated_at`) VALUES
(1, 'Rewrite The Stars', 'Zendaya & Zac Efron', 'song/rewrite_the_stars.mp3', NULL, '2026-05-28 16:44:56', '2026-05-28 16:44:56'),
(2, 'A Million Dreams', 'Ziv Zaifman, Hugh Jackman and Michelle Williams', 'song/a-million-dreams.mp3', NULL, '2026-05-28 16:44:56', '2026-05-28 16:44:56');

-- --------------------------------------------------------

--
-- Table structure for table `portfolios`
--

CREATE TABLE `portfolios` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(500) NOT NULL DEFAULT '',
  `tech_stack` text DEFAULT NULL COMMENT 'Tag dipisah koma, contoh: PHP,HTML,CSS',
  `project_link` varchar(500) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `portfolios`
--

INSERT INTO `portfolios` (`id`, `title`, `description`, `image`, `tech_stack`, `project_link`, `created_at`) VALUES
(1, '🌿 DEMANG – Deterjen Mangrove Non-Sintetik', 'Inovasi deterjen ramah lingkungan berbahan dasar mangrove sebagai upaya mengurangi pencemaran lingkungan.', 'img/demang.png', 'Research,STEM Project', 'https://youtu.be/YvoFR_UiQMc', '2026-01-05 03:00:00'),
(2, '📚 Website MyADYA Bookstore', 'Website dinamis untuk toko buku online. Proyek UAS Pemrograman Web kelas 12 SMK.', 'img/bookstore.png', 'PHP,HTML,CSS,Bootstrap,JavaScript', NULL, '2026-01-05 04:00:00'),
(3, '🏝️ Website Promosi NTB', 'Website statis promosi wisata Nusa Tenggara Barat. Proyek UAS Pemrograman Web I semester 3.', 'img/ntb_tourism.png', 'HTML,CSS', 'https://nadyarabila.github.io/web-wisata/', '2026-01-05 05:00:00'),
(4, '🖨️ Website PrintHub', 'Website dinamis untuk layanan percetakan. Proyek UAS Interaksi Manusia dan Komputer semester 3.', 'img/printhub.png', 'HTML,Tailwind CSS,PHP,JavaScript', 'https://nana-printhub.byethost31.com/index.php?i=1', '2026-01-05 06:00:00'),
(5, '🩺 Sistem Pakar Diagnosa Penyakit Kulit', 'Aplikasi sistem pakar menggunakan metode forward chaining dengan Python. Proyek UTS Sistem Pakar Semester 4.', 'img/sistempakar.png', 'Python,Forward Chaining', 'https://github.com/nadyarabila/sistem-pakar-forward-chaining', '2026-01-05 07:00:00'),
(7, '🐋Animasi Aquarium HTML5', 'Animasi aquarium 2D menggunakan HTML5 Canvas dan JavaScript sebagai implementasi konsep dasar komputer grafik.', 'uploads/portfolio/portfolio_6f9b84e2a541c161_1780854394.png', 'HTML5, CSS3, JavaScript', 'https://github.com/nadyarabila/html5-aquarium-animation', '2026-06-07 17:46:34');

-- --------------------------------------------------------

--
-- Table structure for table `site_settings`
--

CREATE TABLE `site_settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `greeting` varchar(255) NOT NULL,
  `tagline` text NOT NULL,
  `profile_image` varchar(500) NOT NULL DEFAULT '',
  `footer_name` varchar(255) NOT NULL,
  `footer_text` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `site_settings`
--

INSERT INTO `site_settings` (`id`, `full_name`, `greeting`, `tagline`, `profile_image`, `footer_name`, `footer_text`) VALUES
(1, 'Nadya Rabila', 'Halo, saya', 'Mahasiswa Informatika Universitas Samudra yang memiliki ketertarikan di <strong>web development</strong>, public speaking, english communication, dan aktif dalam berbagai kompetisi serta proyek teknologi.', 'img/profil.png', 'Nadya Rabila', '&copy; 2026 -');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `achievements`
--
ALTER TABLE `achievements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_achievements_year` (`year`),
  ADD KEY `idx_achievements_created_at` (`created_at`);

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uk_admins_username` (`username`);

--
-- Indexes for table `certifications`
--
ALTER TABLE `certifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_certifications_created_at` (`created_at`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uk_contacts_platform` (`platform`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_gallery_created_at` (`created_at`);

--
-- Indexes for table `music_tracks`
--
ALTER TABLE `music_tracks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `portfolios`
--
ALTER TABLE `portfolios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_portfolios_created_at` (`created_at`);

--
-- Indexes for table `site_settings`
--
ALTER TABLE `site_settings`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `achievements`
--
ALTER TABLE `achievements`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `certifications`
--
ALTER TABLE `certifications`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `music_tracks`
--
ALTER TABLE `music_tracks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `portfolios`
--
ALTER TABLE `portfolios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `site_settings`
--
ALTER TABLE `site_settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
