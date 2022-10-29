-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 27, 2022 at 09:03 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventory_bpr`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` varchar(20) NOT NULL,
  `nama_barang` varchar(60) DEFAULT NULL,
  `id_satuan` int(20) DEFAULT NULL,
  `id_jenis` int(20) DEFAULT NULL,
  `foto` varchar(225) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `nama_barang`, `id_satuan`, `id_jenis`, `foto`) VALUES
('BRG-01', 'AIR MINERAL GALON', 2, 7, '10036631_2.jpg'),
('BRG-03', 'SLIP PEMINDAHAN UANG SETORAN', 10, 6, '5471145_6e76d491-a975-4aa7-94e0-b131b49d1b6c_2048_1536.jpg'),
('BRG-04', 'BUKU TABUNGAN SISWA', 10, 6, 'download.png'),
('BRG-05', 'AMPLOP COKLAT TANPA TALI', 1, 4, '1a115c44-6915-4c54-abd3-b3812d83acf6.jpg'),
('BRG-06', 'KERTAS HVS SIDU 70 GR', 12, 4, '031ffced-f48a-469e-a0cf-d1f76749b28f.jpg'),
('BRG-07', 'HAND SANITIZER', 8, 7, 'Harmon_Face_Values_Hand_Sanitizer.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `barang_keluar`
--

CREATE TABLE `barang_keluar` (
  `id_barang_keluar` varchar(30) NOT NULL,
  `id_barang` varchar(30) DEFAULT NULL,
  `id_user` varchar(50) NOT NULL,
  `id_kcb` varchar(30) DEFAULT NULL,
  `jumlah_keluar` varchar(5) DEFAULT NULL,
  `harga` varchar(50) NOT NULL,
  `total` varchar(50) NOT NULL,
  `tgl_keluar` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang_keluar`
--

INSERT INTO `barang_keluar` (`id_barang_keluar`, `id_barang`, `id_user`, `id_kcb`, `jumlah_keluar`, `harga`, `total`, `tgl_keluar`) VALUES
('PMK-001', 'BRG-07', 'USR-001', 'KCB-02', '1', '33367', '33367', '2022-09-27');

--
-- Triggers `barang_keluar`
--
DELIMITER $$
CREATE TRIGGER `kurangstok` AFTER INSERT ON `barang_keluar` FOR EACH ROW BEGIN
UPDATE barang_masuk SET stok = stok - NEW.jumlah_keluar
WHERE id_barang = NEW.id_barang;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `barang_masuk`
--

CREATE TABLE `barang_masuk` (
  `id_barang_masuk` varchar(40) NOT NULL,
  `id_supplier` varchar(30) DEFAULT NULL,
  `id_barang` varchar(30) DEFAULT NULL,
  `id_user` varchar(30) DEFAULT NULL,
  `jumlah_masuk` int(10) DEFAULT NULL,
  `harga` varchar(50) NOT NULL,
  `tgl_masuk` varchar(30) DEFAULT NULL,
  `stok` varchar(10) NOT NULL,
  `total` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang_masuk`
--

INSERT INTO `barang_masuk` (`id_barang_masuk`, `id_supplier`, `id_barang`, `id_user`, `jumlah_masuk`, `harga`, `tgl_masuk`, `stok`, `total`) VALUES
('PMB-001', 'PMSK-04', 'BRG-07', 'USR-001', 10, '33367', '2022-09-27', '14', '155500'),
('PMB-002', 'PMSK-02', 'BRG-06', 'USR-001', 5, '42433', '2022-09-27', '12', '415000');

-- --------------------------------------------------------

--
-- Table structure for table `jenis`
--

CREATE TABLE `jenis` (
  `id_jenis` int(20) NOT NULL,
  `kode_kategori` varchar(20) DEFAULT NULL,
  `kategori_barang` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jenis`
--

INSERT INTO `jenis` (`id_jenis`, `kode_kategori`, `kategori_barang`) VALUES
(4, 'ATK', 'Alat Tulis Kantor'),
(6, 'CTK', 'Barang Cetakan'),
(7, 'KRT', 'Keperluan Rumah Tangga'),
(8, 'SBH', 'Souvenir / Barang Hadiah');

-- --------------------------------------------------------

--
-- Table structure for table `kcb`
--

CREATE TABLE `kcb` (
  `id_kcb` varchar(10) NOT NULL,
  `nama_kcb` varchar(100) DEFAULT NULL,
  `notelp` varchar(50) DEFAULT NULL,
  `contact` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kcb`
--

INSERT INTO `kcb` (`id_kcb`, `nama_kcb`, `notelp`, `contact`) VALUES
('KCB-01', 'SRG - Kantor Cabang Sragen', '089237516280', 'NINING'),
('KCB-02', 'SKH - Kantor Cabang Sukoharjo', '081256819603', 'ROSA'),
('KCB-03', 'KPO - Kantor Pusat Operasional', '087182025617', 'AKBAR'),
('KCB-04', 'KP - Kantor Pusat', '0271819611022', 'UNING');

-- --------------------------------------------------------

--
-- Table structure for table `satuan`
--

CREATE TABLE `satuan` (
  `id_satuan` int(20) NOT NULL,
  `nama_satuan` varchar(60) DEFAULT NULL,
  `ket` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `satuan`
--

INSERT INTO `satuan` (`id_satuan`, `nama_satuan`, `ket`) VALUES
(1, 'Box', ''),
(2, 'Unit', ''),
(4, 'Pack', ''),
(5, 'Dus', ''),
(6, 'Pcs', ''),
(7, 'Strip', ''),
(8, 'Botol', ''),
(9, 'Bendel', ''),
(10, 'Buku', ''),
(11, 'Lembar', ''),
(12, 'Rim', '');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id_supplier` varchar(10) NOT NULL,
  `nama_supplier` varchar(60) DEFAULT NULL,
  `notelp` varchar(50) DEFAULT NULL,
  `nama_sales` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id_supplier`, `nama_supplier`, `notelp`, `nama_sales`) VALUES
('PMSK-01', 'MIGRASI', '085712681014', 'MIGRASI'),
('PMSK-02', 'SL STATIONERY', '089261830742', 'YUNITA'),
('PMSK-03', 'BINTANG FAJAR OFFSET', '087257192034', 'FAJAR'),
('PMSK-04', 'WISESA JAYA', '081261950728', 'SALES');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `notelp` varchar(15) NOT NULL,
  `level` enum('superadmin','admin','direktur') NOT NULL,
  `password` varchar(255) NOT NULL,
  `foto` varchar(50) NOT NULL,
  `status` enum('Aktif','Tidak Aktif') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama`, `username`, `email`, `notelp`, `level`, `password`, `foto`, `status`) VALUES
('USR-001', 'Administrasi', 'admin', 'admin@admin.com', '087856123445', 'admin', 'e00cf25ad42683b3df678c61f42c6bda', '23749372-removebg-preview1.png', 'Aktif'),
('USR-002', 'Super Admin', 'superadmin', 'superadmin@superadmin.com', '08792681080', 'superadmin', '17c4520f6cfd1ab53d8745e84681eb49', '23749372-removebg-preview.png', 'Aktif'),
('USR-003', 'Direktur', 'direktur', 'direktur@direktur.com', '08932791019', 'direktur', '4fbfd324f5ffcdff5dbf6f019b02eca8', '28236026-removebg-preview.png', 'Aktif');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `barang_keluar`
--
ALTER TABLE `barang_keluar`
  ADD PRIMARY KEY (`id_barang_keluar`),
  ADD UNIQUE KEY `jumlah_keluar` (`jumlah_keluar`);

--
-- Indexes for table `barang_masuk`
--
ALTER TABLE `barang_masuk`
  ADD PRIMARY KEY (`id_barang_masuk`);

--
-- Indexes for table `jenis`
--
ALTER TABLE `jenis`
  ADD PRIMARY KEY (`id_jenis`);

--
-- Indexes for table `kcb`
--
ALTER TABLE `kcb`
  ADD PRIMARY KEY (`id_kcb`);

--
-- Indexes for table `satuan`
--
ALTER TABLE `satuan`
  ADD PRIMARY KEY (`id_satuan`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id_supplier`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jenis`
--
ALTER TABLE `jenis`
  MODIFY `id_jenis` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `satuan`
--
ALTER TABLE `satuan`
  MODIFY `id_satuan` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
