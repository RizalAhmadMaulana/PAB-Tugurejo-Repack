-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 25 Feb 2022 pada 04.48
-- Versi server: 10.1.37-MariaDB
-- Versi PHP: 5.6.39

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pab_tugurejo`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `ruser`
--

CREATE TABLE `ruser` (
  `iduser` int(5) NOT NULL,
  `name` varchar(50) NOT NULL,
  `pass` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `ruser`
--

INSERT INTO `ruser` (`iduser`, `name`, `pass`) VALUES
(1, 'rijal', 'rijal123'),
(2, 'pais', 'pais123'),
(3, 'arip', 'arip345');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbaplikasi`
--

CREATE TABLE `tbaplikasi` (
  `username` varchar(200) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nama_lengkap` varchar(200) NOT NULL,
  `jabatan` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbaplikasi`
--

INSERT INTO `tbaplikasi` (`username`, `password`, `nama_lengkap`, `jabatan`) VALUES
('faiz', 'faiz345', 'Faizzz', 'Anggota'),
('rijal', 'rijal123', 'Rizal Ahmad Maulana', 'Ketua Dewan Pengawas'),
('zar', 'Jizar234', 'jizar', 'Pencatat Meter');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbcatatmeter`
--

CREATE TABLE `tbcatatmeter` (
  `kodearea` varchar(5) NOT NULL,
  `bulantrx` varchar(9) NOT NULL,
  `idpelanggan` varchar(10) NOT NULL,
  `standawal` decimal(15,2) NOT NULL,
  `standakhir` decimal(15,2) NOT NULL,
  `userid` int(30) NOT NULL,
  `tglentry` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbcatatmeter`
--

INSERT INTO `tbcatatmeter` (`kodearea`, `bulantrx`, `idpelanggan`, `standawal`, `standakhir`, `userid`, `tglentry`) VALUES
('0001', 'januar', '1002', '102.00', '201.00', 10020001, '2022-01-30 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbpelanggan`
--

CREATE TABLE `tbpelanggan` (
  `idpelanggan` varchar(100) NOT NULL,
  `namapelanggan` varchar(200) NOT NULL,
  `RT` int(4) NOT NULL,
  `RW` int(4) NOT NULL,
  `nomor_rumah` int(20) NOT NULL,
  `jalan` varchar(500) NOT NULL,
  `kelurahan` varchar(200) NOT NULL,
  `kota` varchar(200) NOT NULL,
  `nomor_telpon` varchar(20) NOT NULL,
  `stand_awal` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbpelanggan`
--

INSERT INTO `tbpelanggan` (`idpelanggan`, `namapelanggan`, `RT`, `RW`, `nomor_rumah`, `jalan`, `kelurahan`, `kota`, `nomor_telpon`, `stand_awal`) VALUES
('1001', 'Rizal', 3, 7, 27, 'Bayu Prasetya Timur Raya', 'Bangetayu Wetan', 'Semarang', '082147483647', 1001),
('1002', 'Faiz', 2, 3, 23, 'Warigalit 1', 'krapyak', 'Semarang', '082637468462', 1002),
('1003', 'Jizar', 2, 4, 15, 'Planet Bumi', 'Kuningan', 'Semarang', '081234939293', 1003);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbpembayaran`
--

CREATE TABLE `tbpembayaran` (
  `kodetrx` varchar(20) NOT NULL,
  `bulantrx` varchar(9) NOT NULL,
  `tglbayar` date NOT NULL,
  `idpelanggan` varchar(10) NOT NULL,
  `jmltagihan` decimal(15,2) NOT NULL,
  `jmlbayar` decimal(15,2) NOT NULL,
  `kodelunas` int(1) NOT NULL,
  `tgllunas` date NOT NULL,
  `userid` varchar(30) NOT NULL,
  `tglentry` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbpembayaran`
--

INSERT INTO `tbpembayaran` (`kodetrx`, `bulantrx`, `tglbayar`, `idpelanggan`, `jmltagihan`, `jmlbayar`, `kodelunas`, `tgllunas`, `userid`, `tglentry`) VALUES
('2001', 'januar', '2022-01-30', '1002', '20.00', '20.00', 1, '2022-01-30', '10020001', '2022-01-30 00:00:00'),
('2002', 'maret', '2022-02-03', '1001', '50.00', '10.00', 1, '2022-02-03', '10020002', '2022-02-03 03:00:00'),
('2003', 'April', '2022-02-03', '1003', '70.00', '20.00', 1, '2022-02-03', '10020003', '2022-02-03 07:13:21');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbpenerimaan`
--

CREATE TABLE `tbpenerimaan` (
  `kodetrx` varchar(20) NOT NULL,
  `tgltrx` date NOT NULL,
  `jmlrp` decimal(15,2) NOT NULL,
  `tglentry` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbpenerimaan`
--

INSERT INTO `tbpenerimaan` (`kodetrx`, `tgltrx`, `jmlrp`, `tglentry`) VALUES
('2001', '2022-01-30', '20.00', '2022-01-30 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbtagihan`
--

CREATE TABLE `tbtagihan` (
  `kodetrx` varchar(20) NOT NULL,
  `bulantrx` varchar(9) NOT NULL,
  `idpelanggan` varchar(10) NOT NULL,
  `jmlpakai` decimal(15,2) NOT NULL,
  `tarip` decimal(15,2) NOT NULL,
  `jmltagihan` decimal(10,0) NOT NULL,
  `userid` int(30) NOT NULL,
  `tglentry` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbtagihan`
--

INSERT INTO `tbtagihan` (`kodetrx`, `bulantrx`, `idpelanggan`, `jmlpakai`, `tarip`, `jmltagihan`, `userid`, `tglentry`) VALUES
('2001', 'januar', '1002', '2.00', '20.00', '20', 10020001, '2022-01-30 00:00:00'),
('2002', 'maret', '1001', '3.00', '50.00', '50', 10020002, '2022-02-03 00:00:00'),
('2003', 'April', '1003', '1.00', '70.00', '70', 10020003, '2022-02-03 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbtarif`
--

CREATE TABLE `tbtarif` (
  `kode_tarif` int(10) NOT NULL,
  `pemakaian_min` varchar(200) NOT NULL,
  `pemakaian_max` varchar(200) NOT NULL,
  `jumlah_tarif` varchar(200) NOT NULL,
  `abonemen` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbtarif`
--

INSERT INTO `tbtarif` (`kode_tarif`, `pemakaian_min`, `pemakaian_max`, `jumlah_tarif`, `abonemen`) VALUES
(1001, '30', '100', '200.000', ' Rp 5.000'),
(1002, '30', '400', '80.000', 'Rp 5.000');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbaplikasi`
--
ALTER TABLE `tbaplikasi`
  ADD PRIMARY KEY (`username`);

--
-- Indeks untuk tabel `tbpelanggan`
--
ALTER TABLE `tbpelanggan`
  ADD PRIMARY KEY (`idpelanggan`);

--
-- Indeks untuk tabel `tbtarif`
--
ALTER TABLE `tbtarif`
  ADD PRIMARY KEY (`kode_tarif`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
