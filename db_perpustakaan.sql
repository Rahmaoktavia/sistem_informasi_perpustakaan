-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 03, 2024 at 03:59 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_perpustakaan`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `kode_buku` varchar(13) NOT NULL,
  `sampul` longblob NOT NULL,
  `judul` varchar(64) NOT NULL,
  `category_id` int(11) NOT NULL,
  `pengarang_id` int(11) NOT NULL,
  `penerbit_id` int(11) NOT NULL,
  `available_books` int(12) NOT NULL,
  `total_books` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`kode_buku`, `sampul`, `judul`, `category_id`, `pengarang_id`, `penerbit_id`, `available_books`, `total_books`) VALUES
('K02132', 0x62756b75312e6a7067, 'Algoritma dan Pemograman', 1, 2, 3, 36, 40),
('K0232091471', 0x73692e6a7067, 'Sistem Infromasi', 3, 3, 2, 39, 40),
('SH984320', 0x616b756e74616e73692e6a7067, 'Akuntansi Manajemen', 8, 4, 4, 30, 40);

-- --------------------------------------------------------

--
-- Table structure for table `buku_tamu`
--

CREATE TABLE `buku_tamu` (
  `id` int(11) NOT NULL,
  `member_id` varchar(13) NOT NULL,
  `tgl_kunjungan` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(64) NOT NULL,
  `keterangan` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id_kategori`, `nama_kategori`, `keterangan`) VALUES
(1, 'Teknologi', 'Buku Teknologi ini di peruntukkan untuk Mahasiswa PNP'),
(3, 'Pendidikan', 'Kemendikbud'),
(4, 'Kesehatan', 'Ilmu Kesehatannn'),
(6, 'Olahraga', 'Ilmu yang menyenangkan'),
(7, 'Kesenian', 'Seniiiiii'),
(8, 'Novel', 'Buku novel '),
(9, 'Politik', 'Books'),
(10, 'Parenting', 'Buku Pengasuhan'),
(11, 'Majalah', 'Bersumber '),
(12, 'Teknik', 'gatauuu'),
(13, 'Hukum', 'Indonesia');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `id_member` varchar(13) NOT NULL,
  `nim` varchar(15) NOT NULL,
  `nama` varchar(64) NOT NULL,
  `jenis_kelamin` enum('laki-laki','perempuan') NOT NULL,
  `prodi_id` int(11) NOT NULL,
  `email` varchar(64) NOT NULL,
  `password` varchar(32) NOT NULL,
  `level` enum('admin','pustakawan','anggota') NOT NULL,
  `status` enum('mahasiswa','dosen','tendik','-') NOT NULL,
  `no_tlp` varchar(15) NOT NULL,
  `tgl_daftar` date NOT NULL,
  `tgl_kembali` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`id_member`, `nim`, `nama`, `jenis_kelamin`, `prodi_id`, `email`, `password`, `level`, `status`, `no_tlp`, `tgl_daftar`, `tgl_kembali`) VALUES
('M-000001', '123123', 'Joto', 'laki-laki', 7, 'joto@gmail.com', 'joto', 'admin', '-', '123123', '2023-12-27', '2026-12-27');

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id_transaksi` varchar(12) NOT NULL,
  `member_id` varchar(12) NOT NULL,
  `tanda_buku` varchar(13) NOT NULL,
  `tgl_pinjam` date NOT NULL,
  `tgl_kembali` date NOT NULL,
  `denda` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `penerbit`
--

CREATE TABLE `penerbit` (
  `id_penerbit` int(11) NOT NULL,
  `nama_penerbit` varchar(64) NOT NULL,
  `alamat_penerbit` text NOT NULL,
  `kota` varchar(64) NOT NULL,
  `negara` varchar(64) NOT NULL,
  `email_penerbit` varchar(64) NOT NULL,
  `tlp_penerbit` varchar(15) NOT NULL,
  `tautan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penerbit`
--

INSERT INTO `penerbit` (`id_penerbit`, `nama_penerbit`, `alamat_penerbit`, `kota`, `negara`, `email_penerbit`, `tlp_penerbit`, `tautan`) VALUES
(2, 'PT Gramedia', 'Monas', 'Jakarta', 'Indonesia', 'gramedia@gmail.com', '0822783463', 'hhtps://gramedia.com'),
(3, 'PT Erlan', 'Jakarta barat', 'Jakarta', 'Indonesia', 'erlangga@co.id', '082257345', 'www.erlan.com'),
(4, 'PT books', 'Padang', 'Padang', 'Indonesia', 'yuni11@gmail.com', '082834387233', 'www.books'),
(5, 'PT Cakrawala', 'Serambi', 'Aceh', 'Indonesia', 'cakrawala@gmail.com', '082329847', 'www.cakrawala.com');

-- --------------------------------------------------------

--
-- Table structure for table `pengarang`
--

CREATE TABLE `pengarang` (
  `id_pengarang` int(11) NOT NULL,
  `nama_pengarang` varchar(64) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `alamat` text NOT NULL,
  `email` varchar(64) NOT NULL,
  `telepon` varchar(15) NOT NULL,
  `referensi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengarang`
--

INSERT INTO `pengarang` (`id_pengarang`, `nama_pengarang`, `tgl_lahir`, `alamat`, `email`, `telepon`, `referensi`) VALUES
(2, 'Gitta', '2000-02-29', 'Padang', 'gitta@gmail.com', '0822234711', 'google'),
(3, 'Tika', '2012-07-30', 'Padang', 'yuni@gmail.com', '08283438729', 'www.google'),
(4, 'Orry', '2023-12-31', 'Lubuak Buaya', 'orry@gamil.com', '0822234732', 'Youtube');

-- --------------------------------------------------------

--
-- Table structure for table `prodi`
--

CREATE TABLE `prodi` (
  `id_prodi` int(11) NOT NULL,
  `nama_prodi` varchar(64) NOT NULL,
  `keterangan` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prodi`
--

INSERT INTO `prodi` (`id_prodi`, `nama_prodi`, `keterangan`) VALUES
(6, 'D-3 Manajemen Informatika', 'Aktif'),
(7, '-', '-');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`kode_buku`),
  ADD UNIQUE KEY `category_id` (`category_id`),
  ADD UNIQUE KEY `pengarang_id` (`pengarang_id`),
  ADD UNIQUE KEY `penerbit_id` (`penerbit_id`);

--
-- Indexes for table `buku_tamu`
--
ALTER TABLE `buku_tamu`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `anggota_id` (`member_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id_member`),
  ADD UNIQUE KEY `nim` (`nim`),
  ADD UNIQUE KEY `prodi_id` (`prodi_id`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD UNIQUE KEY `member_id` (`member_id`,`tanda_buku`),
  ADD UNIQUE KEY `tanda_buku` (`tanda_buku`);

--
-- Indexes for table `penerbit`
--
ALTER TABLE `penerbit`
  ADD PRIMARY KEY (`id_penerbit`);

--
-- Indexes for table `pengarang`
--
ALTER TABLE `pengarang`
  ADD PRIMARY KEY (`id_pengarang`);

--
-- Indexes for table `prodi`
--
ALTER TABLE `prodi`
  ADD PRIMARY KEY (`id_prodi`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buku_tamu`
--
ALTER TABLE `buku_tamu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `penerbit`
--
ALTER TABLE `penerbit`
  MODIFY `id_penerbit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pengarang`
--
ALTER TABLE `pengarang`
  MODIFY `id_pengarang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `prodi`
--
ALTER TABLE `prodi`
  MODIFY `id_prodi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_ibfk_6` FOREIGN KEY (`pengarang_id`) REFERENCES `pengarang` (`id_pengarang`) ON UPDATE CASCADE,
  ADD CONSTRAINT `books_ibfk_7` FOREIGN KEY (`penerbit_id`) REFERENCES `penerbit` (`id_penerbit`) ON UPDATE CASCADE,
  ADD CONSTRAINT `books_ibfk_8` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id_kategori`) ON UPDATE CASCADE;

--
-- Constraints for table `buku_tamu`
--
ALTER TABLE `buku_tamu`
  ADD CONSTRAINT `buku_tamu_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `member` (`id_member`) ON UPDATE CASCADE;

--
-- Constraints for table `member`
--
ALTER TABLE `member`
  ADD CONSTRAINT `member_ibfk_3` FOREIGN KEY (`prodi_id`) REFERENCES `prodi` (`id_prodi`) ON UPDATE CASCADE;

--
-- Constraints for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD CONSTRAINT `peminjaman_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `member` (`id_member`) ON UPDATE CASCADE,
  ADD CONSTRAINT `peminjaman_ibfk_2` FOREIGN KEY (`tanda_buku`) REFERENCES `books` (`kode_buku`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
