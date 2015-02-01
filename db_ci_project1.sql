-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 01 Feb 2015 pada 04.33
-- Versi Server: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_ci_project1`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_admin`
--

CREATE TABLE IF NOT EXISTS `tbl_admin` (
  `id_admin` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(10) NOT NULL,
  `status` enum('admin','petugas') NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`id_admin`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data untuk tabel `tbl_admin`
--

INSERT INTO `tbl_admin` (`id_admin`, `username`, `status`, `password`) VALUES
(1, 'admin', 'admin', '21232f297a57a5a743894a0e4a801fc3'),
(2, 'Alireza', 'petugas', '1a6c7b48041dd5e63de87848fe5bc68a');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_barang_donasi`
--

CREATE TABLE IF NOT EXISTS `tbl_barang_donasi` (
  `id_donasi` int(11) NOT NULL AUTO_INCREMENT,
  `id_donatur` int(11) NOT NULL,
  `id_posko` int(11) NOT NULL,
  `jenis_donasi` varchar(10) NOT NULL,
  `keterangan` text NOT NULL,
  PRIMARY KEY (`id_donasi`),
  KEY `id_donatur` (`id_donatur`,`id_posko`),
  KEY `id_posko` (`id_posko`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_daerah`
--

CREATE TABLE IF NOT EXISTS `tbl_daerah` (
  `id_daerah` int(11) NOT NULL AUTO_INCREMENT,
  `nama_daerah` varchar(100) NOT NULL,
  `latitude` varchar(100) NOT NULL,
  `longitude` varchar(100) NOT NULL,
  PRIMARY KEY (`id_daerah`),
  UNIQUE KEY `nama_daerah` (`nama_daerah`),
  UNIQUE KEY `latitude` (`latitude`),
  UNIQUE KEY `longitude` (`longitude`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumping data untuk tabel `tbl_daerah`
--

INSERT INTO `tbl_daerah` (`id_daerah`, `nama_daerah`, `latitude`, `longitude`) VALUES
(24, 'Teluk Gong, Jakarta Utara', '-6.13785731475512', '106.7819959325409'),
(25, 'Samsat, Jakarta Utara', '-6.1379341', '106.8348195'),
(27, 'Boulevard Barat, Jakut', '-6.1571283', '106.8999654');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_donatur`
--

CREATE TABLE IF NOT EXISTS `tbl_donatur` (
  `id_donatur` int(11) NOT NULL AUTO_INCREMENT,
  `nama_donatur` varchar(20) NOT NULL,
  `password_donatur` varchar(100) NOT NULL,
  `alamat_donatur` text NOT NULL,
  `no_hp_donatur` varchar(20) NOT NULL,
  `status_donatur` enum('Terverifikasi','Belum Terverifikasi') NOT NULL,
  PRIMARY KEY (`id_donatur`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_informasi`
--

CREATE TABLE IF NOT EXISTS `tbl_informasi` (
  `id_informasi` int(11) NOT NULL AUTO_INCREMENT,
  `id_admin` int(11) NOT NULL,
  `judul_informasi` varchar(20) NOT NULL,
  `isi_informasi` text NOT NULL,
  `tanggal_update` date NOT NULL,
  `status_informasi` enum('tampil','tidak') NOT NULL,
  PRIMARY KEY (`id_informasi`),
  KEY `id_petugas` (`id_admin`),
  KEY `id_admin` (`id_admin`),
  KEY `id_admin_2` (`id_admin`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_ketinggian`
--

CREATE TABLE IF NOT EXISTS `tbl_ketinggian` (
  `id_ketinggian` int(11) NOT NULL AUTO_INCREMENT,
  `id_daerah` int(11) NOT NULL,
  `ketinggian_air` int(11) NOT NULL,
  `radius_daerah` int(11) NOT NULL,
  `tanggal_update` datetime NOT NULL,
  PRIMARY KEY (`id_ketinggian`),
  KEY `id_daerah` (`id_daerah`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumping data untuk tabel `tbl_ketinggian`
--

INSERT INTO `tbl_ketinggian` (`id_ketinggian`, `id_daerah`, `ketinggian_air`, `radius_daerah`, `tanggal_update`) VALUES
(25, 24, 60, 100, '2014-08-16 23:48:05'),
(26, 25, 40, 140, '2014-08-16 23:50:02'),
(27, 27, 75, 50, '2014-08-16 23:54:19');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_lap_ketinggian`
--

CREATE TABLE IF NOT EXISTS `tbl_lap_ketinggian` (
  `id_ketinggian` int(11) NOT NULL AUTO_INCREMENT,
  `id_daerah` int(11) NOT NULL,
  `ketinggian_air` int(11) NOT NULL,
  `radius_daerah` int(11) NOT NULL,
  `tanggal_update` datetime NOT NULL,
  PRIMARY KEY (`id_ketinggian`),
  KEY `id_daerah` (`id_daerah`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pengungsi`
--

CREATE TABLE IF NOT EXISTS `tbl_pengungsi` (
  `id_pengungsi` int(11) NOT NULL AUTO_INCREMENT,
  `id_posko` int(11) NOT NULL,
  `nama_pengungsi` varchar(20) NOT NULL,
  `alamat_pengungsi` text NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `foto_pengungsi` text NOT NULL,
  PRIMARY KEY (`id_pengungsi`),
  KEY `id_posko` (`id_posko`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_posko`
--

CREATE TABLE IF NOT EXISTS `tbl_posko` (
  `id_posko` int(11) NOT NULL AUTO_INCREMENT,
  `id_daerah` int(11) NOT NULL,
  `nama_posko` varchar(30) NOT NULL,
  `alamat_posko` varchar(50) NOT NULL,
  PRIMARY KEY (`id_posko`),
  KEY `id_daerah` (`id_daerah`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tbl_barang_donasi`
--
ALTER TABLE `tbl_barang_donasi`
  ADD CONSTRAINT `tbl_barang_donasi_ibfk_1` FOREIGN KEY (`id_donatur`) REFERENCES `tbl_donatur` (`id_donatur`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_barang_donasi_ibfk_2` FOREIGN KEY (`id_posko`) REFERENCES `tbl_posko` (`id_posko`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tbl_informasi`
--
ALTER TABLE `tbl_informasi`
  ADD CONSTRAINT `tbl_informasi_ibfk_1` FOREIGN KEY (`id_admin`) REFERENCES `tbl_admin` (`id_admin`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tbl_ketinggian`
--
ALTER TABLE `tbl_ketinggian`
  ADD CONSTRAINT `tbl_ketinggian_ibfk_1` FOREIGN KEY (`id_daerah`) REFERENCES `tbl_daerah` (`id_daerah`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tbl_pengungsi`
--
ALTER TABLE `tbl_pengungsi`
  ADD CONSTRAINT `tbl_pengungsi_ibfk_1` FOREIGN KEY (`id_posko`) REFERENCES `tbl_posko` (`id_posko`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tbl_posko`
--
ALTER TABLE `tbl_posko`
  ADD CONSTRAINT `tbl_posko_ibfk_1` FOREIGN KEY (`id_daerah`) REFERENCES `tbl_daerah` (`id_daerah`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
