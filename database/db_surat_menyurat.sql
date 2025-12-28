-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 28, 2025 at 06:23 PM
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
-- Database: `db_surat_menyurat`
--

-- --------------------------------------------------------

--
-- Table structure for table `pengajuan_surat`
--

CREATE TABLE `pengajuan_surat` (
  `id_pengajuan` int(11) NOT NULL,
  `jenis_surat` varchar(100) NOT NULL,
  `nik` varchar(30) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `tempat_lahir` varchar(50) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `whatsapp` varchar(20) DEFAULT NULL,
  `pekerjaan` varchar(50) DEFAULT NULL,
  `agama` varchar(30) DEFAULT NULL,
  `lingkungan` varchar(30) DEFAULT NULL,
  `jenis_kelamin` varchar(20) DEFAULT NULL,
  `status_perkawinan` varchar(30) DEFAULT NULL,
  `nama_orang_tua` varchar(100) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `keperluan` text DEFAULT NULL,
  `file_ktp` varchar(255) DEFAULT NULL,
  `file_kk` varchar(255) DEFAULT NULL,
  `status_pengajuan` varchar(30) NOT NULL,
  `email` varchar(100) NOT NULL,
  `tanggal_pengajuan` date NOT NULL DEFAULT curdate(),
  `id_pegawai_verifikasi` int(11) DEFAULT NULL,
  `tgl_verifikasi` datetime DEFAULT NULL,
  `id_kades_acc` int(11) DEFAULT NULL,
  `tgl_acc` datetime DEFAULT NULL,
  `keterangan_tolak` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengajuan_surat`
--

INSERT INTO `pengajuan_surat` (`id_pengajuan`, `jenis_surat`, `nik`, `nama_lengkap`, `tempat_lahir`, `tanggal_lahir`, `whatsapp`, `pekerjaan`, `agama`, `lingkungan`, `jenis_kelamin`, `status_perkawinan`, `nama_orang_tua`, `alamat`, `keperluan`, `file_ktp`, `file_kk`, `status_pengajuan`, `email`, `tanggal_pengajuan`, `id_pegawai_verifikasi`, `tgl_verifikasi`, `id_kades_acc`, `tgl_acc`, `keterangan_tolak`) VALUES
(1, 'SKTM', '123456789876543', 'Haqil Abdillah', 'Kuningan', '2006-09-21', '89668655132', 'Belum Bekerja', 'islam', 'lingk_subur', 'laki_laki', 'belum_kawin', 'Lilis Suryaningsih', 'Jln. Subur', 'Untuk Beasiswa', '123456789876543_KTP_1766931686.png', '123456789876543_KK_1766931686.png', 'Pending', 'haqilabdillah@gmail.com', '2025-12-28', NULL, NULL, NULL, NULL, NULL),
(2, 'SKU', '3201010101010002', 'Siti Aminah', 'Kuningan', '1992-02-02', '81345678901', 'Pedagang', 'islam', 'lingk_mukti', 'perempuan', 'belum_kawin', 'Aminah Sulaiman', 'Jl. Sudirman No.2', 'Keperluan usaha', 'ktp_siti.jpg', 'kk_siti.jpg', 'Selesai', 'haqilabdillah@gmail.com', '2025-12-24', 1, '2025-12-26 16:15:07', 4, '2025-12-26 16:15:24', NULL),
(7, 'SKU', '3208090101900001', 'Ahmad Fauzi', 'Kuningan', '1990-05-12', '081234567890', 'Wiraswasta', 'Islam', 'Manis', 'Laki-laki', 'Kawin', 'Suparman', 'Dusun Manis RT 01 RW 01', 'Persyaratan Pengajuan KUR BRI', 'ktp_ahmad.jpg', 'kk_ahmad.jpg', 'Pending', 'haqilabdillah@gmail.com', '2025-12-29', NULL, NULL, NULL, NULL, NULL),
(8, 'SKTM', '3208094502020002', 'Siti Aminah', 'Kuningan', '2002-02-20', '085712345678', 'Mahasiswa', 'Islam', 'Pahing', 'Perempuan', 'Belum Kawin', 'Abdul Rojak', 'Dusun Pahing RT 03 RW 02', 'Pendaftaran KIP Kuliah', 'ktp_siti.jpg', 'kk_siti.jpg', 'Diproses', 'haqilbetter@gmail.com', '2025-12-29', NULL, NULL, NULL, NULL, NULL),
(9, 'SKD', '3208091203950003', 'Budi Santoso', 'Cirebon', '1995-08-17', '089612340987', 'Buruh Harian Lepas', 'Islam', 'Pon', 'Laki-laki', 'Kawin', 'Suharto', 'Dusun Pon RT 02 RW 01', 'Persyaratan Melamar Pekerjaan', 'ktp_budi.jpg', 'kk_budi.jpg', 'Selesai', '20240810062@gmail.com', '2025-12-29', NULL, NULL, NULL, NULL, NULL),
(11, 'SKU', '3208092005850005', 'Rahmat Hidayat', 'Kuningan', '1985-11-25', '082156789012', 'Pedagang', 'Islam', 'Kliwon', 'Laki-laki', 'Kawin', 'Junaedi', 'Dusun Kliwon RT 04 RW 02', 'Bantuan UMKM Desa', 'ktp_rahmat.jpg', 'kk_rahmat.jpg', 'Selesai', 'haqilbetter@gmail.com', '2025-12-29', NULL, NULL, NULL, NULL, NULL),
(12, 'SKTM', '3208096006000006', 'Nurul Huda', 'Majalengka', '2000-06-15', '087890123456', 'Belum Bekerja', 'Islam', 'Manis', 'Perempuan', 'Belum Kawin', 'Muhaimin', 'Dusun Manis RT 02 RW 01', 'Pembuatan BPJS PBI', 'ktp_nurul.jpg', 'kk_nurul.jpg', 'Diproses', '20240810062@gmail.com', '2025-12-29', NULL, NULL, NULL, NULL, NULL),
(13, 'SKD', '3208090507920007', 'Agus Setiawan', 'Kuningan', '1992-07-05', '085234567890', 'Wiraswasta', 'Islam', 'Pahing', 'Laki-laki', 'Kawin', 'Slamet', 'Dusun Pahing RT 01 RW 01', 'Izin Domisili Usaha', 'ktp_agus.jpg', 'kk_agus.jpg', 'Pending', 'haqilabdillah@gmail.com', '2025-12-29', NULL, NULL, NULL, NULL, NULL),
(15, 'SKU', '3208091509800009', 'Dedi Mulyadi', 'Kuningan', '1980-03-30', '081298765432', 'Petani', 'Islam', 'Wage', 'Laki-laki', 'Kawin', 'Koswara', 'Dusun Wage RT 02 RW 02', 'Pinjaman Modal Tani', 'ktp_dedi.jpg', 'kk_dedi.jpg', 'Pending', '20240810062@gmail.com', '2025-12-29', NULL, NULL, NULL, NULL, NULL),
(16, 'SKTM', '3208096510050010', 'Indah Permatasari', 'Kuningan', '2005-10-10', '085609876543', 'Pelajar', 'Islam', 'Kliwon', 'Perempuan', 'Belum Kawin', 'Bambang', 'Dusun Kliwon RT 01 RW 01', 'Keringanan Biaya Sekolah', 'ktp_indah.jpg', 'kk_indah.jpg', 'Diproses', 'haqilabdillah@gmail.com', '2025-12-29', NULL, NULL, NULL, NULL, NULL),
(17, 'SKD', '3208092211970011', 'Rizky Pratama', 'Bandung', '1997-12-01', '081323456789', 'Karyawan Swasta', 'Islam', 'Manis', 'Laki-laki', 'Belum Kawin', 'Asep Saepudin', 'Dusun Manis RT 05 RW 02', 'Persyaratan Pindah Penduduk', 'ktp_rizky.jpg', 'kk_rizky.jpg', 'Pending', 'haqilbetter@gmail.com', '2025-12-29', NULL, NULL, NULL, NULL, NULL),
(19, 'SKU', '3208090302880013', 'Yudi Kurniawan', 'Kuningan', '1988-05-14', '082134567890', 'Pedagang', 'Islam', 'Pon', 'Laki-laki', 'Kawin', 'Tatang', 'Dusun Pon RT 01 RW 02', 'Izin Usaha Warung', 'ktp_yudi.jpg', 'kk_yudi.jpg', 'Pending', 'haqilabdillah@gmail.com', '2025-12-29', NULL, NULL, NULL, NULL, NULL),
(20, 'SKTM', '3208094903030014', 'Anisa Rahmawati', 'Kuningan', '2003-08-08', '085812345678', 'Mahasiswa', 'Islam', 'Wage', 'Perempuan', 'Belum Kawin', 'Cecep', 'Dusun Wage RT 03 RW 01', 'Beasiswa Pemerintah Daerah', 'ktp_anisa.jpg', 'kk_anisa.jpg', 'Diproses', 'haqilbetter@gmail.com', '2025-12-29', NULL, NULL, NULL, NULL, NULL),
(21, 'SKD', '3208091704940015', 'Muhammad Ilham', 'Kuningan', '1994-04-21', '089512345678', 'Wiraswasta', 'Islam', 'Kliwon', 'Laki-laki', 'Kawin', 'Dodi', 'Dusun Kliwon RT 02 RW 02', 'Keperluan Administrasi Bank', 'ktp_ilham.jpg', 'kk_ilham.jpg', 'Selesai', '20240810062@gmail.com', '2025-12-29', NULL, NULL, NULL, NULL, NULL),
(23, 'SKU', '3208092906870017', 'Hendra Gunawan', 'Kuningan', '1987-11-30', '085312345678', 'Mekanik', 'Islam', 'Pahing', 'Laki-laki', 'Kawin', 'Usep', 'Dusun Pahing RT 01 RW 04', 'Kredit Modal Usaha', 'ktp_hendra.jpg', 'kk_hendra.jpg', 'Diproses', 'haqilbetter@gmail.com', '2025-12-29', NULL, NULL, NULL, NULL, NULL),
(24, 'SKTM', '3208095407000018', 'Fitri Handayani', 'Kuningan', '2000-07-20', '087812345678', 'Belum Bekerja', 'Islam', 'Pon', 'Perempuan', 'Belum Kawin', 'Oman', 'Dusun Pon RT 02 RW 01', 'Keringanan Biaya Rumah Sakit', 'ktp_fitri.jpg', 'kk_fitri.jpg', 'Selesai', '20240810062@gmail.com', '2025-12-29', NULL, NULL, NULL, NULL, NULL),
(25, 'SKD', '3208091008930019', 'Eko Prasetyo', 'Kuningan', '1993-09-09', '081398765432', 'Buruh Pabrik', 'Islam', 'Wage', 'Laki-laki', 'Kawin', 'Yanto', 'Dusun Wage RT 01 RW 01', 'Persyaratan Leasing', 'ktp_eko.jpg', 'kk_eko.jpg', 'Pending', 'haqilabdillah@gmail.com', '2025-12-29', NULL, NULL, NULL, NULL, NULL),
(27, 'SKU', '3208092510960021', 'Gilang Ramadhan', 'Kuningan', '1996-06-06', '089698765432', 'Peternak', 'Islam', 'Manis', 'Laki-laki', 'Belum Kawin', 'Iwan', 'Dusun Manis RT 02 RW 03', 'Pengajuan Bantuan Ternak', 'ktp_gilang.jpg', 'kk_gilang.jpg', 'Selesai', '20240810062@gmail.com', '2025-12-29', NULL, NULL, NULL, NULL, NULL),
(28, 'SKTM', '3208095111040022', 'Titi Kamal', 'Kuningan', '2004-03-15', '082198765432', 'Pelajar', 'Islam', 'Pahing', 'Perempuan', 'Belum Kawin', 'Rohman', 'Dusun Pahing RT 04 RW 01', 'Syarat Beasiswa Sekolah', 'ktp_titi.jpg', 'kk_titi.jpg', 'Pending', 'haqilabdillah@gmail.com', '2025-12-29', NULL, NULL, NULL, NULL, NULL),
(29, 'SKD', '3208091312910023', 'Aji Pangestu', 'Kuningan', '1991-10-20', '081212345678', 'Wiraswasta', 'Islam', 'Pon', 'Laki-laki', 'Kawin', 'Nanang', 'Dusun Pon RT 01 RW 02', 'Pembuatan Paspor', 'ktp_aji.jpg', 'kk_aji.jpg', 'Diproses', 'haqilbetter@gmail.com', '2025-12-29', NULL, NULL, NULL, NULL, NULL),
(31, 'SKU', '3208092802990025', 'Dimas Anggara', 'Kuningan', '1999-01-30', '087798765432', 'Wiraswasta', 'Islam', 'Kliwon', 'Laki-laki', 'Belum Kawin', 'Agus', 'Dusun Kliwon RT 03 RW 03', 'Modal Usaha Percetakan', 'ktp_dimas.jpg', 'kk_dimas.jpg', 'Pending', 'haqilabdillah@gmail.com', '2025-12-29', NULL, NULL, NULL, NULL, NULL),
(32, 'SKTM', '3208096303860026', 'Elis Sulistiawati', 'Kuningan', '1986-07-17', '089912345678', 'Ibu Rumah Tangga', 'Islam', 'Manis', 'Perempuan', 'Cerai Mati', 'Karna', 'Dusun Manis RT 01 RW 05', 'Pengajuan Bansos PKH', 'ktp_elis.jpg', 'kk_elis.jpg', 'Selesai', 'haqilbetter@gmail.com', '2025-12-29', NULL, NULL, NULL, NULL, NULL),
(33, 'SKD', '3208090704010027', 'Fajar Shodiq', 'Kuningan', '2001-09-09', '081312349876', 'Belum Bekerja', 'Islam', 'Pahing', 'Laki-laki', 'Belum Kawin', 'Endang', 'Dusun Pahing RT 05 RW 01', 'Pendaftaran TNI AD', 'ktp_fajar.jpg', 'kk_fajar.jpg', 'Diproses', '20240810062@gmail.com', '2025-12-29', NULL, NULL, NULL, NULL, NULL),
(35, 'SKU', '3208091606980029', 'Galih Ginanjar', 'Kuningan', '1998-11-11', '081256781234', 'Wiraswasta', 'Islam', 'Wage', 'Laki-laki', 'Belum Kawin', 'Toto', 'Dusun Wage RT 01 RW 01', 'Kredit Usaha Rakyat', 'ktp_galih.jpg', 'kk_galih.jpg', 'Selesai', 'haqilbetter@gmail.com', '2025-12-29', NULL, NULL, NULL, NULL, NULL),
(36, 'SKTM', '3208096707900030', 'Hana Hanifah', 'Kuningan', '1990-12-25', '085898761234', 'Ibu Rumah Tangga', 'Islam', 'Kliwon', 'Perempuan', 'Kawin', 'Eman', 'Dusun Kliwon RT 04 RW 02', 'Jampersal (Jaminan Persalinan)', 'ktp_hana.jpg', 'kk_hana.jpg', 'Diproses', '20240810062@gmail.com', '2025-12-29', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `nama_lengkap`, `username`, `email`, `password`, `role`, `status`) VALUES
(1, 'Administrator', 'admin', 'admin@email.com', 'admin123', 'admin', 'aktif'),
(2, 'Petugas Desa', 'petugas', 'petugas@email.com', 'petugas123', 'petugas', 'aktif'),
(4, 'Lina Yulina', 'kades', 'kades@email.com', 'kades123', 'kades', 'aktif'),
(5, 'Haqil Abdillah', 'warga', 'wargauser@email.com', 'warga123', 'user', 'aktif');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pengajuan_surat`
--
ALTER TABLE `pengajuan_surat`
  ADD PRIMARY KEY (`id_pengajuan`),
  ADD KEY `email` (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pengajuan_surat`
--
ALTER TABLE `pengajuan_surat`
  MODIFY `id_pengajuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
