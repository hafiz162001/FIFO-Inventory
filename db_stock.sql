-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 17 Feb 2023 pada 08.06
-- Versi server: 10.4.20-MariaDB
-- Versi PHP: 7.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_stock`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang_masuk`
--

CREATE TABLE `barang_masuk` (
  `kode_barang` varchar(10) NOT NULL,
  `kode_supplier` varchar(11) NOT NULL,
  `jenis_barang` varchar(10) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `satuan` varchar(10) NOT NULL,
  `harga` int(100) NOT NULL,
  `jumlah` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_barang`
--

CREATE TABLE `data_barang` (
  `stok` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `data_barang`
--

INSERT INTO `data_barang` (`stok`) VALUES
(19),
(19),
(0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_barang`
--

CREATE TABLE `jenis_barang` (
  `id_jenis` varchar(50) NOT NULL,
  `jenis_brg` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemasukan`
--

CREATE TABLE `pemasukan` (
  `id` int(11) NOT NULL,
  `unit` varchar(30) NOT NULL,
  `kode_brg` varchar(7) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tgl_masuk` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Trigger `pemasukan`
--
DELIMITER $$
CREATE TRIGGER `MASUK` AFTER INSERT ON `pemasukan` FOR EACH ROW BEGIN
  update stokbarang SET stok=stok + NEW.jumlah 
  WHERE kode_brg = NEW.kode_brg;
  
  update stokbarang SET sisa=sisa + NEW.jumlah 
  WHERE kode_brg = NEW.kode_brg;
  
	update pengajuan SET status=1 WHERE kode_brg=NEW.kode_brg AND 
	unit=NEW.unit;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengajuan`
--

CREATE TABLE `pengajuan` (
  `id_pengajuan` int(11) NOT NULL,
  `unit` varchar(20) NOT NULL,
  `kode_brg` varchar(7) NOT NULL,
  `id_jenis` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `satuan` varchar(11) NOT NULL,
  `hargabarang` double NOT NULL,
  `total` double NOT NULL,
  `tgl_pengajuan` date NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengajuan_sementara`
--

CREATE TABLE `pengajuan_sementara` (
  `id_pengajuan_sementara` int(11) NOT NULL,
  `unit` varchar(20) NOT NULL,
  `kode_brg` varchar(7) NOT NULL,
  `id_jenis` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `satuan` varchar(20) NOT NULL,
  `hargabarang` double NOT NULL,
  `total` double NOT NULL,
  `tgl_pengajuan` date NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengeluaran`
--

CREATE TABLE `pengeluaran` (
  `id` int(11) NOT NULL,
  `unit` varchar(20) NOT NULL,
  `kode_brg` varchar(7) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tgl_keluar` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Trigger `pengeluaran`
--
DELIMITER $$
CREATE TRIGGER `TG_STOK_UPDATE` AFTER INSERT ON `pengeluaran` FOR EACH ROW BEGIN
	update stokbarang SET keluar=keluar + NEW.jumlah, 
	sisa=stok-keluar WHERE 
	kode_brg = NEW.kode_brg;

	update permintaan SET status=1 WHERE kode_brg=NEW.kode_brg AND 
	unit=NEW.unit;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `permintaan`
--

CREATE TABLE `permintaan` (
  `id_permintaan` int(100) NOT NULL,
  `unit` varchar(20) NOT NULL,
  `instansi` varchar(20) NOT NULL,
  `kode_brg` varchar(7) NOT NULL,
  `id_jenis` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tgl_permintaan` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `permintaan`
--

INSERT INTO `permintaan` (`id_permintaan`, `unit`, `instansi`, `kode_brg`, `id_jenis`, `jumlah`, `tgl_permintaan`) VALUES
(1, 'Andika Setyawan', 'Toolman', '111.001', 0, 18, '2022-07-26'),
(2, 'Andika Setyawan', 'Toolman', '111.003', 0, 45, '2022-07-26'),
(3, 'Andika Setyawan', 'Toolman', '111.002', 0, 23, '2022-07-26'),
(4, 'Andika Setyawan', 'Toolman', '111.002', 0, 3, '2022-07-28'),
(5, 'Andika Setyawan', 'Toolman', '111.003', 0, 1000, '2022-07-28'),
(6, 'Andika Setyawan', 'Toolman', '111.003', 0, 45, '2022-07-28'),
(7, 'Andika Setyawan', 'Toolman', '111.003', 0, 2, '2022-07-28'),
(8, 'Andika Setyawan', 'Toolman', '111.002', 0, 1000000, '2023-01-12'),
(9, 'Andika Setyawan', 'Toolman', '111.003', 0, 145, '2023-01-12'),
(10, 'wawan', 'Pegawai', '111.005', 0, 50, '2023-02-17'),
(11, 'wawan', 'Pegawai', '111.005', 0, 20, '2023-02-17'),
(12, 'wawan', 'Pegawai', '111.005', 0, 20, '2023-02-17'),
(13, 'wawan', 'Pegawai', '111.005', 0, 15, '2023-02-17');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sementara`
--

CREATE TABLE `sementara` (
  `id_sementara` int(100) NOT NULL,
  `unit` varchar(50) NOT NULL,
  `instansi` varchar(20) NOT NULL,
  `kode_brg` varchar(7) NOT NULL,
  `id_jenis` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tgl_permintaan` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `stokbarang`
--

CREATE TABLE `stokbarang` (
  `id_kode_brg` int(2) NOT NULL,
  `kode_brg` varchar(7) CHARACTER SET latin1 NOT NULL,
  `id_jenis` int(2) NOT NULL,
  `nama_brg` varchar(50) CHARACTER SET latin1 NOT NULL,
  `hargabarang` varchar(50) CHARACTER SET latin1 NOT NULL,
  `satuan` varchar(50) CHARACTER SET latin1 NOT NULL,
  `stok` int(11) NOT NULL,
  `keluar` int(11) NOT NULL,
  `sisa` int(11) NOT NULL,
  `keterangan` varchar(50) CHARACTER SET latin1 NOT NULL,
  `supplier` varchar(100) NOT NULL,
  `tgl_input` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `stokbarang`
--

INSERT INTO `stokbarang` (`id_kode_brg`, `kode_brg`, `id_jenis`, `nama_brg`, `hargabarang`, `satuan`, `stok`, `keluar`, `sisa`, `keterangan`, `supplier`, `tgl_input`) VALUES
(2, '111.002', 0, 'Sulak', '900000', 'Buah', 0, 1000026, 0, '', 'Raseco', '2022-07-24'),
(3, '111.003', 0, 'Nasi Goreng', '90000', 'Buah', 0, 1237, 50, '', 'Bakul sego', '2022-07-24'),
(5, '111.003', 0, 'Nasi Goreng', '70000', 'Buah', 0, 1237, 79, '', 'Bakul sego', '2022-07-27'),
(6, '111.002', 0, 'Sulak', '554545', 'Buah', 0, 1000026, 0, '', 'Raseco', '2022-07-27'),
(7, '111.003', 0, 'Nasi Goreng', '8989898', 'Buah', 45, 1237, 0, '1111e', 'Raseco', '2022-07-27'),
(9, '111.003', 0, 'Nasi Goreng', '900', 'Buah', 10, 1237, 0, '', 'Wawan', '2022-07-24'),
(10, '111.001', 0, 'Sapu', '4000', 'Buah', 80, 342, 6, '', 'Bakul sego', '2022-07-24'),
(11, '111.001', 0, 'Sapu', '30000', 'Buah', 100, 0, 0, '', 'Wawan', '2022-07-26'),
(12, '111.001', 0, 'Sapu', '3000', 'Buah', 20, 0, 0, '', 'Raseco', '2022-07-26'),
(13, '111.002', 0, 'Sulak', '20000', 'Buah', 99008000, 1000000, 100000221, '', 'Bakul sego', '2023-01-12'),
(14, '111.004', 0, 'Sapu Kaki', '0', 'buah', 0, 0, 0, '', '', '0000-00-00'),
(15, '111.005', 0, 'Minyak Wangi', '0', 'Botol', 0, 105, 0, '', '', '0000-00-00'),
(16, '111.005', 0, 'Minyak Wangi', '30000', 'Botol', 0, 105, 0, '', 'PT Raseco', '2023-02-17'),
(17, '111.005', 0, 'Minyak Wangi', '39000', 'Botol', 95, 35, 0, '', 'Bakul sego', '2023-02-17');

-- --------------------------------------------------------

--
-- Struktur dari tabel `supplier`
--

CREATE TABLE `supplier` (
  `id_supplier` int(11) NOT NULL,
  `nama_supplier` varchar(100) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `telepone` int(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `supplier`
--

INSERT INTO `supplier` (`id_supplier`, `nama_supplier`, `alamat`, `telepone`) VALUES
(1, 'Raseco', 'Jakarta', 812121212),
(2, 'Bakul sego', 'Purworejo', 88888),
(3, 'Wawan', 'Jakarta', 808080),
(4, 'PT Raseco', 'Purworejo', 81112222);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` enum('instansi','bendahara','kepala') NOT NULL,
  `jabatan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `level`, `jabatan`) VALUES
(1, 'Puspa', '21232f297a57a5a743894a0e4a801fc3', 'bendahara', 'Staff Waka Sarpras'),
(14, 'Andri Wijaya', '21232f297a57a5a743894a0e4a801fc3', 'kepala', 'Wakil Kepala Waka Sarpras'),
(15, 'Andika Setyawan', '21232f297a57a5a743894a0e4a801fc3', 'instansi', 'Toolman'),
(17, 'didik', '2ff462bc49e322708a48d3d5e3ca4bab', 'bendahara', 'admin'),
(18, 'wawan', '0a000f688d85de79e3761dec6816b2a5', 'instansi', 'Pegawai');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `jenis_barang`
--
ALTER TABLE `jenis_barang`
  ADD PRIMARY KEY (`id_jenis`);

--
-- Indeks untuk tabel `pemasukan`
--
ALTER TABLE `pemasukan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pengajuan`
--
ALTER TABLE `pengajuan`
  ADD PRIMARY KEY (`id_pengajuan`);

--
-- Indeks untuk tabel `pengajuan_sementara`
--
ALTER TABLE `pengajuan_sementara`
  ADD PRIMARY KEY (`id_pengajuan_sementara`);

--
-- Indeks untuk tabel `pengeluaran`
--
ALTER TABLE `pengeluaran`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `permintaan`
--
ALTER TABLE `permintaan`
  ADD PRIMARY KEY (`id_permintaan`);

--
-- Indeks untuk tabel `sementara`
--
ALTER TABLE `sementara`
  ADD PRIMARY KEY (`id_sementara`);

--
-- Indeks untuk tabel `stokbarang`
--
ALTER TABLE `stokbarang`
  ADD PRIMARY KEY (`id_kode_brg`);

--
-- Indeks untuk tabel `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id_supplier`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `pemasukan`
--
ALTER TABLE `pemasukan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pengajuan`
--
ALTER TABLE `pengajuan`
  MODIFY `id_pengajuan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pengajuan_sementara`
--
ALTER TABLE `pengajuan_sementara`
  MODIFY `id_pengajuan_sementara` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pengeluaran`
--
ALTER TABLE `pengeluaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT untuk tabel `permintaan`
--
ALTER TABLE `permintaan`
  MODIFY `id_permintaan` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `sementara`
--
ALTER TABLE `sementara`
  MODIFY `id_sementara` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- AUTO_INCREMENT untuk tabel `stokbarang`
--
ALTER TABLE `stokbarang`
  MODIFY `id_kode_brg` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id_supplier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
