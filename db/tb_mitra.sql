-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 16, 2024 at 04:01 AM
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
-- Table structure for table `tb_mitra`
--

CREATE TABLE `tb_mitra` (
  `id_mitra` int NOT NULL,
  `instansi_mitra` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email_mitra` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `notelp_mitra` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `provinsi` varchar(35) NOT NULL,
  `kota` varchar(35) NOT NULL,
  `website` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `alamat_mitra` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_mitra`
--

INSERT INTO `tb_mitra` (`id_mitra`, `instansi_mitra`, `email_mitra`, `notelp_mitra`, `provinsi`, `kota`, `website`, `alamat_mitra`) VALUES
(1, 'PEMERINTAH KOTA PADANG', 'diskominfo@padang.go.id', '0751 4640800', 'SUMATERA BARAT', 'PADANG', 'https://padang.go.id/', 'Jl. Bagindo Azis Chan No. 1\r\n\r\nAie Pacah - Kota Padang\r\n\r\nSumatera Barat'),
(2, 'KOMINFO', 'humas@mail.kominfo.go.id', '(021) 345284', 'Jakarta Pusat', 'Jakarta', 'https://www.kominfo.go.id/', 'Jl. Medan Merdeka Barat no. 9, Jakarta 10110'),
(5, 'PEMERINTAH NAGARI PANAMPUANG', 'Nagaripanampuang@gmail.com', '(0752) 426767', 'SUMATERA BARAT', 'AGAM', 'https://panampuang.id/', 'Jln. Raya Biaro-Koto Baru Km.2 Pakan Kaluang Jorong Surau Lauik, Nagari Panampuang., Kec. Ampek Angkek, Kab. Agam'),
(7, 'BALAI PENERAPAN TEKNOLOGI KONSTRUKSI KEMENTERIAN PU', 'portaldjbk@pu.go.id', 'KOSONG', 'JAKARTA SELATAN', 'JAKARTA', 'KOSONG', 'KOSONG'),
(9, 'PT. ANDALAN MITRA PRESTASI', 'headoffice@andalanmitraprestasi.co.id', '07517059045', 'SUMATERA BARAT ', 'PADANG', 'https://www.andalanmitraprestasi.co.id/', 'Jl. S. Parman No.80-82-118B Padang,\r\nSumatera Barat - 25136,\r\nIndonesia.'),
(11, 'PEMERINTAH KOTA PADANG', 'diskominfo@padang.go.id', '0751 4640800', 'SUMATERA BARAT', 'PADANG', 'https://padang.go.id/', 'Jl. Bagindo Azis Chan No. 1\r\n\r\nAie Pacah - Kota Padang\r\n\r\nSumatera Barat'),
(15, 'PEMERINTAH NAGARI TANJUNG BONAI AUR', '', '', 'SUMATERA BARAT', 'SIJUNJUNG', '', ''),
(16, 'PEMERINTAH NAGARI BATU TABA', '', '', 'SUMATERA BARAT', 'AGAM', '', ''),
(17, 'PEMERINTAH NAGARI PANAMPUANG', 'Nagaripanampuang@gmail.co', '(0752) 42676', 'SUMATERA BARAT', 'AGAM', 'https://panampuang.id/', 'Jln. Raya Biaro-Koto Baru Km.2 Pakan Kaluang Jorong Surau Lauik, Nagari Panampuang., Kec. Ampek Angkek, Kab. Agam\r\n'),
(18, 'AKADEMI PARIWISATA BUNDA', 'info@akparbundapadang.ac.', '(0751)34212', 'SUMATERA BARAT', 'PADANG', 'https://www.akparbundapadang.ac.id/', 'Jl. Arif Rahman Hakim No.57 Padang - Sumatera Barat.\r\n'),
(20, 'SMA NEGERI 5 BUKITTINGGI', 'sman5bukittinggi@gmail.co', '(0752) 34099', 'SUMATERA BARAT', 'BUKITTINGGI', 'https://www.sman5bukittinggi.sch.id', 'Jl. Nj Dt Mangkuto Ameh Kec. Mandiangin Koto Selayan, Kota Bukittinggi - Sumatera Barat\r\n'),
(21, 'DINAS KOPERASI DAN UMKM SUMATERA BA', 'diskop@sumbarprov.go.id', '0751 - 70552', 'SUMATERA BARAT', 'PADANG', 'https://diskopukm.sumbarprov.go.id/', '\"Jl. Khatib Sulaiman No. 11 Padang\r\nSumatera Barat 27113\"\r\n'),
(22, 'POLITEKNIK NEGERI PONTIANAK', 'kampus@polnep.ac.id', '561736180 or', 'KALIMANTAN BARAT', 'PONTIANAK', 'https://polnep.ac.id/page/polnep-s-', '\"Jl. Jenderal Ahmad Yani, Bansir Laut, Pontianak Tenggara, Kota Pontianak, Kalimantan Barat\r\n78124\"\r\n'),
(23, 'STMIK HANG TUAH PEKANBARU', 'universitas@htp.ac.id', '(0761) 57152', 'RIAU', 'PEKANBARU', 'https://htp.ac.id/', 'Jl. Mustafa Sari No. 5, Tangkerang Selatan, Pekanbaru, Riau-28288\r\n'),
(24, 'STMIK JAYANUSA PADANG', 'jayanusa@jayanusa.ac.id', '0751-28984, ', 'SUMATERA BARAT', 'PADANG', 'https://jayanusa.ac.id/', 'Jl. Damar No.69 E Padang, Sumatera Barat\r\n'),
(25, 'AMIK JAYANUSA PADANG', 'jayanusa@jayanusa.ac.id', '0751-28984, ', 'SUMATERA BARAT', 'PADANG', 'https://jayanusa.ac.id/', 'Jl. Damar No.69 E Padang, Sumatera Barat\r\n'),
(26, 'SEKOLAH TINGGI ILMU EKONOMI HAJI AG', 'itbhasbkt@gmail.com', '(0752)34201 ', 'SUMATERA BARAT', 'BUKITTINGGI', 'http://www.itbhas.ac.idd', 'Jalan Bahder Johan 26136 Bukittinggi Sumatera Barat · ~69,6 km\r\n'),
(27, 'SEKOLAH TINGGI TEKNOLOGI INDUSTRI', '', '', 'SUMATERA BARAT', 'PADANG', 'https://sttind.ac.id/', ''),
(28, 'FAKULTAS TEKNIK UNIVERSITAS PAMULAN', 'humas@unpam.ac.id', '(021) 741256', 'BANTEN', 'TANGERANG', 'https://unpam.ac.id/fakultas-teknik', 'Kampus Pusat : Jl. Surya Kencana No.1, Pamulang Bar., Kec. Pamulang, Kota Tangerang Selatan, Banten 15417\r\n'),
(29, 'PT PLN (PERSERO) UPK TELUK SIRIH', 'pln123@pln.co.id', '(0751) 46500', 'SUMATERA BARAT', 'PADANG', 'https://web.pln.co.id/', 'Desa Teluk Sirih, RT001/RW004, Kel.. Teluk Kabung Tengah, Kec. Bungus Teluk Kabung, Kota Padang, Prov. Sumatera Barat.\r\n'),
(30, 'GRAND ZURI HOTEL', 'reserservation@premiereho', '+62 751 894 ', 'SUMATERA BARAT', 'PADANG', 'http://www.zhmhotels.com/hotel/the-', '\"Jalan M. Thamrin No.27, Padang 25211\r\nSumatera Barat, Indonesia\"\r\n'),
(31, 'KAWANA HOTEL', 'nfo@kawanahotel.co.id', '+62 (751) 89', 'SUMATERA BARAT', 'PADANG', 'https://www.kawanahotel.co.id/', '\"Jl. MH. Thamrin No. 71 Kelurahan Ranah Parak Rumbio, Padang Selatan, Kota Padang - Sumatera Barat 25212\r\nIndonesia.\"\r\n'),
(32, 'ASTRA DAIHATSU SUMBAR', 'cs@dso.astra.co.id', '(0751)705222', 'SUMATERA BARAT', 'PADANG', 'https://www.astra-daihatsu.id/', 'Jl. Khatib Sulaiman No.101, Ulakkarang Utara, Padang Utara, Padang, Sumatera Barat, 25133\r\n'),
(33, 'PT MEDIA INDOTAMA EXPO', 'hello@kolegal.id', '0817-325-600', 'SUMATERA BARAT', 'PADANG', 'https://kolegal.id/media-indotama-expo', 'Indonesia Stock Exchange Tower 1 Level 3-04, SCBD\r\nJakarta Selatan 12190'),
(34, 'INNER DRIVE', 'info@innerdrive.co.uk', '+44 208 693 3191', 'SUMATERA BARAT', 'PADANG', 'https://www.innerdrive.co.uk/contact/', 'United Kingdom'),
(35, 'SMK NEGERI 5 PAYAKUMBUH', '', '', 'SUMATERA BARAT', 'PAYAKUMBUH', 'https://ppid.sma5pyk.sch.id/profil-sekolah//', 'PJJ3+PC4 Tangah Padang Indah, Situjuah Banda Dalam, Kec. Situjuah Limo Nagari, Kota Payakumbuh, Sumatera Barat 26225'),
(56, 'HIMPUNAN AHLI TEKNIK HIDRAULIK INDONESIA', 'hathi.pusat@gmail.com', '+62-21-72792263', 'JAKARTA SELATAN', 'JAKARTA', 'https://hathi.id/', 'Gedung Dit.Jend. SDA, Lt. 8, Kementerian PUPR Jl Pattimura No. 20, Jakarta\r\n'),
(57, 'PT. PUTRA BAJA DELI', '', '', 'SUMATERA UTARA', 'MEDAN', 'www.putrabajadeli.com or https://www.instagram.com/pt_putrabajadeli/?hl=id', 'Wisma ADR Lt 5 Jl Pluit Raya 1 no 1, Jakarta Utara\r\nJakarta Utara, DKI Jakarta 14440, ID Utara, DKI Jakarta\r\n'),
(58, 'IKATAN AHLI INFORMATIKA INDONESIA', 'siswantodppiaii@gmail.com', '+62 87767275025', 'JAKARTA SELATAN', 'JAKARTA', 'https://iaii.or.id/', 'Jalan Jati Padang Raya No. 41 Jati Padang Pasar Minggu Jakarta Selatan Kode Pos 12540\r\n'),
(59, 'KOMINFO', 'humas@mail.kominfo.go.id', '(021) 3452841', 'Jakarta Pusat', 'JAKARTA', 'https://www.kominfo.go.id/', 'Jl. Medan Merdeka Barat no. 9, Jakarta 10110'),
(60, 'PEMERINTAH NAGARI KAMANG HILIA', '', '', 'SUMATERA BARAT', 'AGAM', '', ''),
(61, 'PT KURNIA ABADI PADANG', '', '', 'SUMATERA BARAT', 'PADANG', '', ''),
(62, 'NATIONAL YUNLIN UNIVERSITY OF SCIENCE AND TECHNOLOGY', '', '886-5-534-2601 ', 'TAIWAN', 'TAIWAN', 'https://eng.yuntech.edu.tw/', '123 University Road, Section 3,Douliou, Yunlin 64002, Taiwan, R.O.C.'),
(63, 'POLITEKNIK SULTAN MIZAN ZAINAL ABIDIN ', 'webmaster@psmza.edu.my', '09-8400800', 'MALAYSIA', 'TERENGGANU', 'https://psmza.mypolycc.edu.my/', 'Politeknik Sultan Mizan Zainal Abidin (PSMZA),KM 08 Jalan Paka,23000 Dungun, Terengganu Darul Iman\r\n'),
(64, 'PT HALUAN CYBER MEDIA', 'Refer to its website.', '0813 7283 8945', 'SUMATERA BARAT', 'PADANG', 'https://use.infobelpro.com/indonesia/en/businessdetails/ID/0742135390', 'KOMPLEK BANDARA TABING LANUD- KOTA PADANG'),
(65, 'CHANGZHOU INSTITUTE OF INDUSTRIAL TECHNOLOGY (CHILI)', 'contact@isac.org.cn', '+86-180-4242-4161', 'CHINA', 'JIANGSU SHENG', 'https://www.isacteach.com/university/changzhou-institute-of-industry-technology/', 'C1604 Xinyinzuo Building, Luohu, Shenzhen'),
(66, 'HIMPUNAN AHLI TEKNIK HIDRAULIK INDONESIA', 'hathi.pusat@gmail.com', '+62-21-72792263', 'JAKARTA SELATAN', 'JAKARTA', 'https://hathi.id/', 'Gedung Dit.Jend. SDA, Lt. 8, Kementerian PUPR Jl Pattimura No. 20, Jakarta\r\n'),
(67, 'PT. PUTRA BAJA DELI', '', '', 'SUMATERA UTARA', 'MEDAN', 'www.putrabajadeli.com or https://www.instagram.com/pt_putrabajadeli/?hl=id', 'Wisma ADR Lt 5 Jl Pluit Raya 1 no 1, Jakarta Utara\r\nJakarta Utara, DKI Jakarta 14440, ID Utara, DKI Jakarta\r\n'),
(68, 'IKATAN AHLI INFORMATIKA INDONESIA', 'siswantodppiaii@gmail.com', '+62 87767275025', 'JAKARTA SELATAN', 'JAKARTA', 'https://iaii.or.id/', 'Jalan Jati Padang Raya No. 41 Jati Padang Pasar Minggu Jakarta Selatan Kode Pos 12540\r\n'),
(69, 'KOMINFO', 'humas@mail.kominfo.go.id', '(021) 3452841', 'Jakarta Pusat', 'JAKARTA', 'https://www.kominfo.go.id/', 'Jl. Medan Merdeka Barat no. 9, Jakarta 10110'),
(70, 'PEMERINTAH NAGARI KAMANG HILIA', '', '', 'SUMATERA BARAT', 'AGAM', '', ''),
(71, 'PT KURNIA ABADI PADANG', '', '', 'SUMATERA BARAT', 'PADANG', '', ''),
(72, 'NATIONAL YUNLIN UNIVERSITY OF SCIENCE AND TECHNOLOGY', '', '886-5-534-2601 ', 'TAIWAN', 'TAIWAN', 'https://eng.yuntech.edu.tw/', '123 University Road, Section 3,Douliou, Yunlin 64002, Taiwan, R.O.C.'),
(73, 'POLITEKNIK SULTAN MIZAN ZAINAL ABIDIN ', 'webmaster@psmza.edu.my', '09-8400800', 'MALAYSIA', 'TERENGGANU', 'https://psmza.mypolycc.edu.my/', 'Politeknik Sultan Mizan Zainal Abidin (PSMZA),KM 08 Jalan Paka,23000 Dungun, Terengganu Darul Iman\r\n'),
(74, 'PT HALUAN CYBER MEDIA', 'Refer to its website.', '0813 7283 8945', 'SUMATERA BARAT', 'PADANG', 'https://use.infobelpro.com/indonesia/en/businessdetails/ID/0742135390', 'KOMPLEK BANDARA TABING LANUD- KOTA PADANG'),
(75, 'CHANGZHOU INSTITUTE OF INDUSTRIAL TECHNOLOGY (CHILI)', 'contact@isac.org.cn', '+86-180-4242-4161', 'CHINA', 'JIANGSU SHENG', 'https://www.isacteach.com/university/changzhou-institute-of-industry-technology/', 'C1604 Xinyinzuo Building, Luohu, Shenzhen'),
(76, 'CHANGZHOU VOCATIONAL INSTITUTE OF ENGINEERING TECHNOLOGY', 'contact@isac.org.cn', '+86-180-4242-4161', 'CHINA', 'JIANGSU SHENG', 'https://www.isacteach.com/university/changzhou-institute-of-industry-technology/', 'C1604 Xinyinzuo Building, Luohu, Shenzhen'),
(77, 'CHANGZHOU VOCATIONAL INSTITUTE OF MECHATRONIC TECHNOLOGY', '', '+8613632437050', 'CHINA', 'JIANGSU SHENG', 'https://www.digiedupro.com/changzhou-institute-of-mechatronic-technology/', 'No. 26 Mingxin Middle Road, Wujin District, Changzhou City, Jiangsu Province, China'),
(78, 'POLITEKNIK MUADZAM SHAH (PMS)', 'webmasterpms@pms.edu.my', '09 450 2005', 'MALAYSIA', 'PAHANG', 'https://pms.mypolycc.edu.my/', 'Politeknik Muadzam Shah, Lebuhraya Tun Abdul Razak, 26700 Muadzam Shah, Pahang Darul Makmur.'),
(79, 'NATIONAL KAOHSIUNG UNIVERSITY OF SCIENCE AND TECHNOLOGY.', 'qaoffice01@nkust.edu.tw', '', 'TAIWAN', 'KAOHSIUNG CITY', 'https://eng.nkust.edu.tw/', 'No.1, University Rd., Yanchao Dist., Kaohsiung City 824005, Taiwan'),
(80, 'PERUSAHAN JEPANG\r\n', '', '', '', '', '', ''),
(111, 'MANAGEMENT AND SCIENCE UNIVERSITY (MSU)\r\n', '', '(603) 55216868', 'Malaysia', 'Malaysia', 'https://www.msu.edu.my/\r\n', '\"Management and Science University DU019(B)\r\nUniversity Drive, Off Persiaran Olahraga,\r\nSection 13, 40100 Shah Alam,\r\nSelangor Darul Ehsan, Malaysia\"\r\n'),
(112, 'POLITEKNIK MUADZAM SHAH (PMS)\r\n', 'webmasterpms@pms.edu.my\r\n', '09 450 2005/ 2006', 'Malaysia', 'Pahang', 'https://pms.mypolycc.edu.my/\r\n', 'Politeknik Muadzam Shah, Lebuhraya Tun Abdul Razak, 26700 Muadzam Shah, Pahang Darul Makmur.\r\n'),
(113, 'PEMERINTAHAN NAGARI BATIPUAH ATEH\r\n', 'armen.batipuahateh@desa.mail.go.id\r\n', '085263327871 ', '', '', 'https://batipuahateh.desa.id/\r\n', '\"Jln.Tuan Gadang Batipuh\r\nKecamatan Batipuh Kabupaten Tanah Datar Provinsi Sumatera Barat\r\nKode Pos 27265\"\r\n'),
(114, 'PEMERINTAHAN NAGARI SUNGAI BATUANG\r\n', '', '', 'Sumatera Barat', 'Sijunjung', '', ''),
(115, 'BANK NAGARI\r\n', 'sekper@banknagari.co.id\r\n', '(0751)150234', '', '', 'Jl. Pemuda No.21, Padang, Sumatera Barat\r\n', 'https://www.banknagari.co.id/\r\n'),
(116, 'MASYARAKAT KETENAGALISTRIKAN INDONESIA\r\n', '', '', 'Sumatera Barat', 'Padang', 'https://mki-ieps.id/8/mki-profile\r\n', ''),
(117, 'SEKOLAH TINGGI EKONOMI SYARIAH MANNA WA SALWA\r\n', 'Refer to its website.\r\n', '', 'Sumatera Barat', 'Tanah Datar', 'https://www.pmb.mannawasalwa.ac.id/\r\n', 'Komplek PPM. Nurul Ikhlas Jl. Raya Padang Panjang - Bukittinggi Km. 3 Pincuran Tinggi - Tanah Datar - Sumatera Bara\r\n'),
(118, 'KEMENTERIAN PARIWISATA DAN EKONOMI KREATIF\r\n', 'info@kemenparekraf.go.id\r\n', '0752-4871073 ', 'Indonesia', 'Jakarta', 'https://www.pmb.mannawasalwa.ac.id/\r\n', 'Komplek PPM. Nurul Ikhlas Jl. Raya Padang Panjang - Bukittinggi Km. 3 Pincuran Tinggi - Tanah Datar - Sumatera Bara\r\n'),
(119, 'SEKOLAH TINGGI ILMU EKONOMI BINA KARYA\r\n', 'Refer to its website.\r\n', '0878 9223 9052', 'Sumatera Barat', 'Tebing Tinggi', 'https://kemenparekraf.go.id/\r\n', 'Jl. Medan Merdeka Barat No. 17, RT/RW 02/03, Gambir, Daerah Khusus Ibukota Jakarta 10110, Indonesia.\r\n'),
(120, 'GABUNGAN INDUSTRI PARIWISATA INDONESIA\r\n', 'Refer to its website.\r\n', '0852 8678 8616', 'Sumatera Barat', 'Padang', 'https://www.kemenparekraf.go.id/direktori/asosiasilembaga-kepariwisataan\r\n', 'Wisma Nugra Santana Lt. 9 Jl. Jend. Sudirman Kav. 7-8, Jakarta 10220\r\n'),
(121, 'PT. DIVA IKHLAS TOURS & TRAVEL', 'Refer to its website.', '0813-6377-4678', 'SUMATERA BARAT ', 'PADANG PARIAMAN', 'https://diva-ikhlas-tour-travel.business.site/\r\n', '\"Jalan Akses Bandara\r\nKasang\r\nBatang Anai\r\nSumatera Barat 25586\r\nIndonesia\"\r\n');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_mitra`
--
ALTER TABLE `tb_mitra`
  ADD PRIMARY KEY (`id_mitra`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_mitra`
--
ALTER TABLE `tb_mitra`
  MODIFY `id_mitra` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
