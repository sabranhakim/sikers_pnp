-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 10, 2024 at 07:44 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sikerma_pnp`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_dokumen`
--

CREATE TABLE `tb_dokumen` (
  `id_dokumen` int NOT NULL,
  `no_dokumen` varchar(50) NOT NULL,
  `jenis_dokumen` enum('MOU','MOA','IA') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `jangka_waktu` varchar(25) NOT NULL,
  `awal_kerjasama` date NOT NULL,
  `akhir_kerjasama` date NOT NULL,
  `keterangan` enum('Aktif','Tidak Aktif') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `bidang_usaha` varchar(50) NOT NULL,
  `jurusan_terkait` varchar(20) NOT NULL,
  `topik_kerjasama` varchar(50) NOT NULL,
  `link_dokumen` varchar(100) NOT NULL,
  `mitra_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_dokumen`
--

INSERT INTO `tb_dokumen` (`id_dokumen`, `no_dokumen`, `jenis_dokumen`, `jangka_waktu`, `awal_kerjasama`, `akhir_kerjasama`, `keterangan`, `bidang_usaha`, `jurusan_terkait`, `topik_kerjasama`, `link_dokumen`, `mitra_id`) VALUES
(7, '654G', 'MOU', 'JHKLJ', '2024-12-21', '2024-12-27', 'Tidak Aktif', 'KJGK', 'General', 'JHFJ', 'Draft-Class-Diagram.docx', 1),
(11, 'asdfasdf', 'MOU', 'asdfasd', '2024-12-12', '2024-12-27', 'Tidak Aktif', 'asdfas', 'Akuntansi', 'asdfas', 'Draft-Class-Diagram.docx', 2),
(13, '123das', 'MOA', 'asdf', '2024-12-03', '2024-12-28', 'Tidak Aktif', 'fasdf', 'General', 'asfdfad', 'Draft-Class-Diagram.docx', NULL),
(14, 'rweqr', 'MOA', 'afsdfas', '2024-12-03', '2024-12-26', 'Tidak Aktif', 'asdf', 'General', 'fasdfas', 'Draft-Class-Diagram.docx', NULL),
(18, 'asdfasd', 'MOA', 'fasdf', '2024-12-03', '2024-12-27', 'Tidak Aktif', 'asdfasd', 'General', 'fasdfa', 'Draft-Class-Diagram.docx', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_jurusan`
--

CREATE TABLE `tb_jurusan` (
  `id_jurusan` int NOT NULL,
  `nama_jurusan` varchar(25) NOT NULL,
  `email_jurusan` varchar(20) NOT NULL,
  `notelp_jurusan` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_jurusan`
--

INSERT INTO `tb_jurusan` (`id_jurusan`, `nama_jurusan`, `email_jurusan`, `notelp_jurusan`) VALUES
(1, 'Teknologi Informasi', 'ti@pnp.ac.id', '075172590'),
(2, 'Teknik Mesin', 'mesin@pnp.ac.id', '075172590'),
(3, 'Teknik Sipil', 'ts@pnp.ac.id', '075172590'),
(4, 'Teknik Elektro', 'elektro@pnp.ac.id', '075172590'),
(5, 'Administrasi Niaga', 'an@pnp.ac.id', '075172590'),
(6, 'Akuntansi', 'akuntansi@pnp.ac.id', '075172590'),
(7, 'Bahasa Inggris', 'info@pnp.ac.id', '075172590'),
(8, 'GENERAL', 'info@pnp.ac.id', '075172590');

-- --------------------------------------------------------

--
-- Table structure for table `tb_mitra`
--

CREATE TABLE `tb_mitra` (
  `id_mitra` int NOT NULL,
  `instansi_mitra` varchar(35) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email_mitra` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `notelp_mitra` varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `provinsi` varchar(35) NOT NULL,
  `kota` varchar(35) NOT NULL,
  `website` varchar(35) NOT NULL,
  `alamat_mitra` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_mitra`
--

INSERT INTO `tb_mitra` (`id_mitra`, `instansi_mitra`, `email_mitra`, `notelp_mitra`, `provinsi`, `kota`, `website`, `alamat_mitra`) VALUES
(1, 'PEMERINTAH KOTA PADANG', 'diskominfo@padang.go.id', '0751 4640800', 'SUMATERA BARAT', 'PADANG', 'https://padang.go.id/', 'Jl. Bagindo Azis Chan No. 1\r\n\r\nAie Pacah - Kota Padang\r\n\r\nSumatera Barat'),
(2, 'KOMINFO', 'humas@mail.kominfo.go.id', '(021) 345284', 'Jakarta Pusat', 'Jakarta', 'https://www.kominfo.go.id/', 'Jl. Medan Merdeka Barat no. 9, Jakarta 10110'),
(3, 'semen', 'adfa@ad', '23123', 'fdads', 'adfa', 'asdf', 'adf');

-- --------------------------------------------------------

--
-- Table structure for table `tb_users`
--

CREATE TABLE `tb_users` (
  `id` int NOT NULL,
  `username` varchar(20) NOT NULL,
  `email` varchar(25) NOT NULL,
  `password` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `level` enum('superAdmin','admin','mitra','jurusan') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_users`
--

INSERT INTO `tb_users` (`id`, `username`, `email`, `password`, `level`) VALUES
(2, 'admin', 'admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'superAdmin'),
(3, 'hakim', 'hakim@gmail.com', 'c96041081de85714712a79319cb2be5f', 'admin'),
(6, 'TI', 'TI@gmail.com', '2720da9199bad0fc2eb7236dbe219ef5', 'jurusan');

-- --------------------------------------------------------

--
-- Table structure for table `tb_usulan`
--

CREATE TABLE `tb_usulan` (
  `id_usulan` int NOT NULL,
  `nama_instansi` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `nama_pejabat_penanda_tangan` varchar(50) NOT NULL,
  `nama_jabatan` varchar(50) NOT NULL,
  `no_kontak` varchar(12) NOT NULL,
  `alamat_email` varchar(30) NOT NULL,
  `upload_dokumen` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_usulan`
--

INSERT INTO `tb_usulan` (`id_usulan`, `nama_instansi`, `alamat`, `nama_pejabat_penanda_tangan`, `nama_jabatan`, `no_kontak`, `alamat_email`, `upload_dokumen`) VALUES
(1, 'kim corp', 'adsfasf', 'asdf', 'fasd', '3423', 'faaf@asdf', 'Draft-Class-Diagram.docx'),
(3, 'Teknik Komputer', 'asdf', 'asdf', 'fasd', '23123', 'asdf@ad', 'Draft-Class-Diagram.docx'),
(10, 'asdfa', 'asdfwer', 'werwe', 'wer', '3423', 'fas@adf', 'Draft-Class-Diagram.docx'),
(11, 'sdfa', 'fadsfas', 'dfasd', 'afsfd', '23123', 'afsdfa@adf', 'Draft-Class-Diagram.docx'),
(12, 'fasd', 'fasdfxcvbxc', 'xbcvxcvb', 'bxcvb', '53453', 'adfa@hg', 'Draft-Class-Diagram.docx'),
(13, 'asdfa', 'sdfas', 'fasdf', 'werwe', '2345234', 'asdfas@adf', 'Draft-Class-Diagram.docx'),
(14, 'fasdf', 'fasdfa', 'sdfasdf', 'asdf', '34234', 'fasdf@daf', 'Draft-Class-Diagram.docx'),
(15, 'dsfasd', 'fasdf', 'asdfasd', 'afsdfa', '342342', 'asdf@keke', 'Draft-Class-Diagram_Kel-5.pdf'),
(16, 'afa', 'dfgrasdf', 'efdfzw', 'fawaf', '234', 'asf@hk', 'usecase1.1.pdf'),
(17, 'asdf', 'fasdf', '3r23gd', 'asdfaf', '35345', 'fasd@kj', 'Draft-Class-Diagram_Kel-5.pdf'),
(18, 'asfa', 'sadfa', 'dfasdf', 'asd', '4564564', 'fasd@ldfg', '5-6.docx'),
(19, 'asfa', 'sadfa', 'dfasdf', 'asd', '4564564', 'fasd@ldfg', '5-6.docx'),
(20, 'lkasdjfl', 'fasdfasdf', 'asdfasd', 'asdfa', '98734923', 'kim@corp', 'Document1.docx'),
(21, 'agusCorp', 'padang', 'cau', 'CEO', '0983423', 'Asdf@asdf', 'Draft-Class-Diagram.docx'),
(22, 'asdf', 'fasdfas', 'dfasdf', 'afsdf', '456456', 'fasd@gamda', 'Draft-Class-Diagram.docx'),
(23, 'asdfasd', 'fasdfa', 'asdfasdf', 'asdfasdf', '345345', 'fasdf@sdgka', 'Draft-Class-Diagram.docx');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_dokumen`
--
ALTER TABLE `tb_dokumen`
  ADD PRIMARY KEY (`id_dokumen`),
  ADD KEY `mitra_id` (`mitra_id`) USING BTREE;

--
-- Indexes for table `tb_jurusan`
--
ALTER TABLE `tb_jurusan`
  ADD PRIMARY KEY (`id_jurusan`);

--
-- Indexes for table `tb_mitra`
--
ALTER TABLE `tb_mitra`
  ADD PRIMARY KEY (`id_mitra`);

--
-- Indexes for table `tb_users`
--
ALTER TABLE `tb_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_usulan`
--
ALTER TABLE `tb_usulan`
  ADD PRIMARY KEY (`id_usulan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_dokumen`
--
ALTER TABLE `tb_dokumen`
  MODIFY `id_dokumen` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tb_jurusan`
--
ALTER TABLE `tb_jurusan`
  MODIFY `id_jurusan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tb_mitra`
--
ALTER TABLE `tb_mitra`
  MODIFY `id_mitra` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_users`
--
ALTER TABLE `tb_users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_usulan`
--
ALTER TABLE `tb_usulan`
  MODIFY `id_usulan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_dokumen`
--
ALTER TABLE `tb_dokumen`
  ADD CONSTRAINT `mitra-id_mitra` FOREIGN KEY (`mitra_id`) REFERENCES `tb_mitra` (`id_mitra`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
