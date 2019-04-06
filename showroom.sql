-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 01, 2019 at 06:35 PM
-- Server version: 10.1.22-MariaDB
-- PHP Version: 7.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `showroom`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id_customer` varchar(20) NOT NULL,
  `nama_customer` varchar(100) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id_customer`, `nama_customer`, `alamat`, `no_telp`, `email`) VALUES
('CUT201901012', 'Yadi Pratama', 'Jl. Babakan Eundeur No.38 Kota Tasikmalaya', '0265329110', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_mobil`
--

CREATE TABLE `tbl_mobil` (
  `id_mobil` varchar(20) NOT NULL,
  `nama_tipe` varchar(100) NOT NULL,
  `no_plat` varchar(15) NOT NULL,
  `thn_pembuatan` varchar(5) NOT NULL,
  `isi_silinder` varchar(10) NOT NULL,
  `no_rangka` varchar(25) NOT NULL,
  `no_mesin` varchar(25) NOT NULL,
  `bahan_bakar` varchar(50) NOT NULL,
  `no_bpkb` varchar(15) NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_mobil`
--

INSERT INTO `tbl_mobil` (`id_mobil`, `nama_tipe`, `no_plat`, `thn_pembuatan`, `isi_silinder`, `no_rangka`, `no_mesin`, `bahan_bakar`, `no_bpkb`, `harga`) VALUES
('SSM2019010001', 'Suzuki Karimun', 'D4263EO', '2006', '2000cc', 'DF44334F454RR', '2FRGT453QE', 'Premium', 'DFRTGA234', 200000000);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_supplier`
--

CREATE TABLE `tbl_supplier` (
  `id_supplier` varchar(20) NOT NULL,
  `nama_supplier` varchar(100) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `no_tlp` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_supplier`
--

INSERT INTO `tbl_supplier` (`id_supplier`, `nama_supplier`, `alamat`, `no_tlp`) VALUES
('SUP201902020', 'PT Aksara Jaya', 'Jl. Perumahan Blok A6-B12 Bekasi Timur', '021456736');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transaksi`
--

CREATE TABLE `tbl_transaksi` (
  `nopenjualan` varchar(20) NOT NULL,
  `id_user` varchar(20) NOT NULL,
  `id_customer` varchar(20) NOT NULL,
  `id_mobil` varchar(20) NOT NULL,
  `tgl_penjualan` date NOT NULL,
  `unit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_transaksi`
--

INSERT INTO `tbl_transaksi` (`nopenjualan`, `id_user`, `id_customer`, `id_mobil`, `tgl_penjualan`, `unit`) VALUES
('TRNS201902001', 'KRY201902012', 'CUT201901012', 'SSM2019010001', '2019-02-01', 32),
('TRNS201902002', 'KRY201902012', 'CUT201901012', 'SSM2019010001', '2019-02-01', 121),
('TRNS201902003', 'KRY201902002', 'CUT201901012', 'SSM2019010001', '2019-02-01', 2);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` varchar(20) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `lvl_user` enum('admin','kasir') NOT NULL DEFAULT 'kasir'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama`, `username`, `password`, `lvl_user`) VALUES
('KRY201902002', 'Admin', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin'),
('KRY201902012', 'Rahasia', 'rahasia', '25d55ad283aa400af464c76d713c07ad', 'kasir');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id_customer`);

--
-- Indexes for table `tbl_mobil`
--
ALTER TABLE `tbl_mobil`
  ADD PRIMARY KEY (`id_mobil`);

--
-- Indexes for table `tbl_supplier`
--
ALTER TABLE `tbl_supplier`
  ADD PRIMARY KEY (`id_supplier`);

--
-- Indexes for table `tbl_transaksi`
--
ALTER TABLE `tbl_transaksi`
  ADD PRIMARY KEY (`nopenjualan`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
