-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 01 Des 2021 pada 14.19
-- Versi server: 10.4.17-MariaDB
-- Versi PHP: 7.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_test`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `racikan_obat`
--

CREATE TABLE `racikan_obat` (
  `racikan_obat_id` int(11) NOT NULL,
  `racikan_id` int(11) NOT NULL,
  `obatalkes_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `racikan_obat`
--

INSERT INTO `racikan_obat` (`racikan_obat_id`, `racikan_id`, `obatalkes_id`, `qty`, `created_date`, `created_by`) VALUES
(13, 7, 1784, 100, '2021-11-30 13:57:57', NULL),
(14, 7, 1974, 200, '2021-11-30 13:57:57', NULL),
(15, 8, 1784, 101, '2021-11-30 13:57:57', NULL),
(16, 8, 2328, 102, '2021-11-30 13:57:57', NULL),
(17, 9, 1784, 100, '2021-11-30 14:25:12', NULL),
(18, 9, 1974, 200, '2021-11-30 14:25:12', NULL),
(19, 10, 1784, 101, '2021-11-30 14:25:13', NULL),
(20, 10, 2328, 102, '2021-11-30 14:25:13', NULL),
(21, 11, 1784, 100, '2021-11-30 14:26:05', NULL),
(22, 11, 1974, 200, '2021-11-30 14:26:05', NULL),
(23, 12, 1784, 101, '2021-11-30 14:26:05', NULL),
(24, 12, 2328, 102, '2021-11-30 14:26:05', NULL),
(25, 13, 1784, 100, '2021-11-30 14:27:28', NULL),
(26, 13, 1974, 200, '2021-11-30 14:27:28', NULL),
(27, 14, 1784, 101, '2021-11-30 14:27:28', NULL),
(28, 14, 2328, 102, '2021-11-30 14:27:28', NULL),
(29, 15, 1784, 100, '2021-11-30 14:31:29', NULL),
(30, 15, 1974, 200, '2021-11-30 14:31:30', NULL),
(31, 16, 1784, 101, '2021-11-30 14:31:30', NULL),
(32, 16, 2328, 102, '2021-11-30 14:31:30', NULL),
(33, 17, 1784, 100, '2021-11-30 14:32:02', NULL),
(34, 17, 1974, 200, '2021-11-30 14:32:02', NULL),
(35, 18, 1784, 101, '2021-11-30 14:32:03', NULL),
(36, 18, 2328, 102, '2021-11-30 14:32:03', NULL),
(37, 19, 1802, 10, '2021-11-30 23:08:45', NULL),
(38, 20, 1796, 10, '2021-11-30 23:08:45', NULL),
(39, 20, 2211, 20, '2021-11-30 23:08:45', NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `racikan_obat`
--
ALTER TABLE `racikan_obat`
  ADD PRIMARY KEY (`racikan_obat_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `racikan_obat`
--
ALTER TABLE `racikan_obat`
  MODIFY `racikan_obat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
