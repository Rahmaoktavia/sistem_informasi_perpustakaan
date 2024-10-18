-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 13, 2024 at 07:09 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
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
  `isbn` varchar(25) NOT NULL,
  `judul` varchar(64) NOT NULL,
  `category_id` int(11) NOT NULL,
  `pengarang_id` int(11) NOT NULL,
  `penerbit_id` int(11) NOT NULL,
  `available_books` int(12) NOT NULL,
  `total_books` int(12) NOT NULL,
  `sampul` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`kode_buku`, `isbn`, `judul`, `category_id`, `pengarang_id`, `penerbit_id`, `available_books`, `total_books`, `sampul`) VALUES
('k3913434', '2.2.2.2', 'visual basic 2012', 6, 14, 4, 5, 5, 'visual basic 2012.jpg'),
('k832483', '2.2.2.2', 'teknologi revelusioner', 6, 12, 8, 5, 5, 'teknologi revolusioner.jpg'),
('k838208', '4.4.4.4', 'Ilmu Pengetahuan Alam', 4, 8, 1, 9, 9, 'pendidikan ipa.jpg'),
('k83t5544', '5.5.5.5', 'Agama Ibrahimi', 8, 6, 4, 10, 10, 'agama ibrahimi.jpg'),
('k863482', '2.2.2.2', 'pengenalan : teknologi informasi', 6, 12, 1, 5, 5, 'teknologi informasi.jpg'),
('k91328', '5.5.5.5', 'agama untuk peradaban', 8, 9, 7, 5, 5, 'agama untuk peradaban.jpg'),
('k9183909', '1.1.1.1', 'easy bahasa inggris', 7, 15, 6, 5, 5, 'super easy bahasa inggris.jpeg'),
('k9183945', '1.1.1.1', 'easy bahasa german', 7, 15, 1, 5, 5, 'super easy bahasa german.jpeg'),
('k9183977', '1.1.1.1', 'kamus bahasa arab', 7, 15, 1, 3, 3, 'kamus bahasa arab.jpg'),
('k9183999', '1.1.1.1', 'pedoman bahasa indonesia', 7, 16, 8, 3, 3, 'pedoman bahasa indonesia.jpg'),
('k934731', '5.5.5.5', 'wajah sejuk agama', 8, 9, 6, 5, 5, 'wajah sejuk agama.jpg'),
('k934737', '6.6.6.6', 'jean paul : biografi', 1, 10, 1, 5, 5, 'buku3.jpg'),
('k934738', '6.6.6.6', 'sir alex ferguson : biografi', 1, 10, 1, 5, 5, 'sir alex ferguson.jpg'),
('k974252', '2.2.2.2', 'cyber society', 6, 13, 1, 5, 5, 'cyber society.jpeg'),
('k983984', '4.4.4.4', 'Pendidikan Jasmani dan kesehatan', 4, 4, 7, 10, 10, 'pendidikan jasmani dan kesehatan.jpg'),
('k9839865', '5.5.5.5', 'Jangan rusak Agamamu', 8, 6, 4, 10, 10, 'jangan rusak agama mu dengan exstrem.jpg'),
('k98754', '4.4.4.4', 'kekayaan intelektual', 4, 8, 4, 10, 10, 'hak kekayaan intelektual.jpg'),
('k9879863', '4.4.4.4', 'pancasila', 4, 1, 7, 10, 10, 'pendidikan pancasila dan kewarganegaraan.jpg'),
('k9937190', '6.6.6.6', 'Tjokroaminoto : Biografi', 1, 11, 4, 3, 3, 'tjokroaminoto.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `buku_tamu`
--

CREATE TABLE `buku_tamu` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `tgl_kunjungan` varchar(25) NOT NULL,
  `keterangan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `buku_tamu`
--

INSERT INTO `buku_tamu` (`id`, `nama`, `tgl_kunjungan`, `keterangan`) VALUES
(3, 'Tio', '5 January 2024', ''),
(4, 'Fulan', ' 5 January 2024', ''),
(5, 'Aldo Erianda', '5 January 2024', ''),
(6, 'Orry Frasetyo', '5 January 2024', ''),
(7, 'mita', '11 January 2024', '');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(64) NOT NULL,
  `keterangan` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id_kategori`, `nama_kategori`, `keterangan`) VALUES
(1, 'biografi', 'Baru'),
(4, 'Pendidikan', 'Ada'),
(6, 'teknologi', 'Baru'),
(7, 'bahasa', 'Baru'),
(8, 'agama', 'Baru');

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
  `status` enum('mahasiswa','dosen','tendik','admpustakawan') NOT NULL,
  `no_tlp` varchar(15) NOT NULL,
  `tgl_daftar` date NOT NULL,
  `tgl_berakhir` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`id_member`, `nim`, `nama`, `jenis_kelamin`, `prodi_id`, `email`, `password`, `level`, `status`, `no_tlp`, `tgl_daftar`, `tgl_berakhir`) VALUES
('M-000001', '123123', 'Ratnawati', 'perempuan', 7, 'admin@gmail.com', '9273d1180cd98f6cac22366be628d5f6', 'admin', '', '123123', '2023-12-27', '2026-12-27'),
('M-000002', '122123', 'Nurmaweeli', 'perempuan', 9, 'pustakawan@gmail.com', 'b007b7d6520a7b3dcccd2a1ec2891009', 'pustakawan', '', '082112121212', '2024-01-01', '2027-01-01'),
('M-000003', '2201092009', 'gitta hutari dewinzha', 'perempuan', 6, 'gittahutari81@gmail.com', 'gitta', 'anggota', 'mahasiswa', '089524627544', '2025-01-10', '2025-01-10'),
('M-000004', '2201092025', 'Orry Frasetyo', 'laki-laki', 6, 'orry@gmail.com', 'orry', 'anggota', 'mahasiswa', '08979342434', '2025-01-10', '2025-01-10'),
('M-000005', '2201091011', 'rahma oktavia', 'perempuan', 6, 'rahma@gmail.com', 'rahma', 'anggota', 'mahasiswa', '08953457826', '2025-01-10', '2025-01-10'),
('M-000006', '2201092056', 'yuni sartika', 'perempuan', 6, 'yuni@gmail.com', 'yuni', 'anggota', 'mahasiswa', '08953457826', '2025-01-10', '2025-01-10'),
('M-000007', '298376', 'windi', 'perempuan', 6, 'wun@gmail.com', '12345', 'anggota', 'mahasiswa', '082674286', '2025-01-11', '2025-01-11');

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id_transaksi` varchar(12) NOT NULL,
  `member_id` varchar(12) NOT NULL,
  `tanda_buku` varchar(13) NOT NULL,
  `tgl_pinjam` varchar(25) NOT NULL,
  `tgl_kembali` varchar(25) NOT NULL,
  `denda` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`id_transaksi`, `member_id`, `tanda_buku`, `tgl_pinjam`, `tgl_kembali`, `denda`) VALUES
('T-000007', 'M-000003', 'k3913434', '10 January 2024', '17 January 2024', '0'),
('T-000009', 'M-000006', 'k838208', '11 January 2024', '18 January 2024', '0');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penerbit`
--

INSERT INTO `penerbit` (`id_penerbit`, `nama_penerbit`, `alamat_penerbit`, `kota`, `negara`, `email_penerbit`, `tlp_penerbit`, `tautan`) VALUES
(1, 'PT Erlangga', 'Jln Kebon Jeruk', 'Jakarta', 'Indonesia', 'erlangga@gmail.com', '0751232323', 'erlangga.com'),
(4, 'GagasMedia', 'Jl. H. Montong No.57 9, RT.6/RW.3, Ciganjur, Kec. Jagakarsa, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12630', 'Jakarta Selatan', 'Indonesia', 'gagasmedia@gmail.com', '123456', 'https://gagasmedia.net/'),
(6, 'Deepublish', 'jl rajawali Gg.elang 6 no 3', 'jogjakarta', 'Indonesia', 'Deepublish@gmail.com', '089664775653', 'https://duniadosen.com/penerbit-buku/'),
(7, 'Gramedia pustaka', 'jl palmerah barat 29. Jakarta 10270', 'Jakarta', 'indonesia', 'gramedia@gmail.com', '08964755653', 'https://duniadosen.com/penerbit-buku/'),
(8, 'Kata Depan', 'Jl.Curug Agung No.36, Tanah Baru', 'Depok', 'Indonesia', 'katadepan@gmail.com', '089654325', 'https://duniadosen.com/penerbit-buku/');

-- --------------------------------------------------------

--
-- Table structure for table `pengarang`
--

CREATE TABLE `pengarang` (
  `id_pengarang` int(11) NOT NULL,
  `nama_pengarang` varchar(64) NOT NULL,
  `tgl_lahir` varchar(25) NOT NULL,
  `alamat` text NOT NULL,
  `email` varchar(64) NOT NULL,
  `telepon` varchar(15) NOT NULL,
  `referensi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengarang`
--

INSERT INTO `pengarang` (`id_pengarang`, `nama_pengarang`, `tgl_lahir`, `alamat`, `email`, `telepon`, `referensi`) VALUES
(1, 'Tere Liye', '21 February 1979', 'Sumatera Selatan', 'tereliye@gmail.com', '0821323232', 'https://id.wikipedia.org/wiki/Tere_Liye'),
(4, 'Dewi Lestari', '20 January 1976', 'Bandung', 'dewi@gmail.com', '1243377', 'https://id.wikipedia.org/wiki/Dewi_Lestari'),
(6, 'Arie Wahyu', '29 November 1995', 'jakarta', 'wahyu@gmail.com', '0897652637', 'https://id.wikipedia.org/'),
(7, 'Anisa Septianingrum, M.pd.', '19 September 1992', 'magelang', 'annisa@gmail.com', '08952346234', 'https://books.google.co.id/books/about/'),
(8, 'Jonar T.h Situmorang', '15 October 1989', 'tebing tinggi, sumatera utara', 'jonar@gmail.com', '0895643278', 'https://books.google.co.id/books/about/'),
(9, 'Komaruddin Hidayat', '18 August 1953', 'jakarta', 'Komarrudin@gmail.com', '089562632323', 'https://id.wikipedia.org/wiki/Komaruddin_Hidayat'),
(10, 'Prilo Sekundiari', '16 January 1990', 'jakarta', 'prilo@gmail.com', '08954327832', 'https://www.gramedia.com/author/author-prilo-sekundiari'),
(11, 'Sayyidah Mawani', '01 January 1993', 'jakarta', 'sayyidah@gmail.com', '08979342434', 'https://www.gramedia.com/author/author-sayyidah-mawani'),
(12, 'Sony Adams', '18 March 1999', 'jakarta', 'Sony@gmail.com', '089637434143', 'https://www.gramedia.com/author/author-sony-adams'),
(13, 'Bambang Gunawan', '17 July 1998', 'jakarta', 'bambang@gmail.com', '08956789224', 'https://www.gramedia.com/author/author-bambang-gunawan'),
(14, 'ir yuniar sapardi', '22 October 1991', 'jakarta', 'yuniar@gmail.com', '0896374341', 'https://www.gramedia.com/'),
(15, 'Ulin Nuha Masruchin', '12 November 2024', 'jakarta', 'ullin@gmail.com', '0895683434', 'gramedia.com'),
(16, 'Tim Litbang', '22 October 2024', 'jakarta', 'Litbang@gmail.com', '08953457888', 'gramedia.com');

-- --------------------------------------------------------

--
-- Table structure for table `pengembalian`
--

CREATE TABLE `pengembalian` (
  `id` int(11) NOT NULL,
  `nim` varchar(15) NOT NULL,
  `id_member` varchar(15) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `isbn` varchar(15) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `tgl_pinjam` varchar(25) NOT NULL,
  `tgl_kembali` varchar(25) NOT NULL,
  `denda` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengembalian`
--

INSERT INTO `pengembalian` (`id`, `nim`, `id_member`, `nama`, `isbn`, `judul`, `tgl_pinjam`, `tgl_kembali`, `denda`) VALUES
(12, '2201092056', 'M-000006', 'yuni sartika', '5.5.5.5', 'Agama Ibrahimi', '10 January 2024', '17 January 2024', 'o'),
(13, '2201092025', 'M-000004', 'Orry Frasetyo', '3.3.3.3', 'Sejarah Mesir Kuno', '10 January 2024', '17 January 2024', 'o'),
(14, '2201091011', 'M-000005', 'rahma oktavia', '1.1.1.1', 'easy bahasa inggris', '11 January 2024', '25 January 2024', '0');

-- --------------------------------------------------------

--
-- Table structure for table `prodi`
--

CREATE TABLE `prodi` (
  `id_prodi` int(11) NOT NULL,
  `nama_prodi` varchar(64) NOT NULL,
  `keterangan` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `prodi`
--

INSERT INTO `prodi` (`id_prodi`, `nama_prodi`, `keterangan`) VALUES
(6, 'D-3 Manajemen Informatika', 'Aktif'),
(7, 'D-3 Teknik Komputer', 'Aktif'),
(9, 'D-4 TRPL', 'Aktif');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`kode_buku`),
  ADD KEY `penerbit_id` (`penerbit_id`) USING BTREE,
  ADD KEY `pengarang_id` (`pengarang_id`) USING BTREE,
  ADD KEY `category_id` (`category_id`) USING BTREE;

--
-- Indexes for table `buku_tamu`
--
ALTER TABLE `buku_tamu`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `anggota_id` (`nama`);

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
  ADD KEY `prodi_id` (`prodi_id`) USING BTREE;

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `tanda_buku` (`tanda_buku`) USING BTREE,
  ADD KEY `member_id` (`member_id`,`tanda_buku`) USING BTREE;

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
-- Indexes for table `pengembalian`
--
ALTER TABLE `pengembalian`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `penerbit`
--
ALTER TABLE `penerbit`
  MODIFY `id_penerbit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `pengarang`
--
ALTER TABLE `pengarang`
  MODIFY `id_pengarang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `pengembalian`
--
ALTER TABLE `pengembalian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `prodi`
--
ALTER TABLE `prodi`
  MODIFY `id_prodi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id_kategori`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `books_ibfk_2` FOREIGN KEY (`penerbit_id`) REFERENCES `penerbit` (`id_penerbit`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `books_ibfk_3` FOREIGN KEY (`pengarang_id`) REFERENCES `pengarang` (`id_pengarang`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `member`
--
ALTER TABLE `member`
  ADD CONSTRAINT `member_ibfk_3` FOREIGN KEY (`prodi_id`) REFERENCES `prodi` (`id_prodi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD CONSTRAINT `peminjaman_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `member` (`id_member`) ON UPDATE CASCADE,
  ADD CONSTRAINT `peminjaman_ibfk_2` FOREIGN KEY (`tanda_buku`) REFERENCES `books` (`kode_buku`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
