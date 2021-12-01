-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 01 Des 2021 pada 14.18
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
-- Struktur dari tabel `non_racikan`
--

CREATE TABLE `non_racikan` (
  `non_racikan_id` int(11) NOT NULL,
  `prescription_id` int(11) NOT NULL,
  `obatalkes_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `signa_id` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `non_racikan`
--

INSERT INTO `non_racikan` (`non_racikan_id`, `prescription_id`, `obatalkes_id`, `qty`, `signa_id`, `created_date`, `created_by`) VALUES
(1, 19, 1732, 10, 132, '2021-11-30 13:57:56', NULL),
(2, 1, 1797, 20, 324, '2021-11-30 13:57:57', NULL),
(3, 20, 1732, 10, 132, '2021-11-30 14:25:12', NULL),
(4, 20, 1797, 20, 324, '2021-11-30 14:25:12', NULL),
(5, 21, 1732, 10, 132, '2021-11-30 14:26:04', NULL),
(6, 21, 1797, 20, 324, '2021-11-30 14:26:04', NULL),
(7, 22, 1732, 10, 132, '2021-11-30 14:27:28', NULL),
(8, 22, 1797, 20, 324, '2021-11-30 14:27:28', NULL),
(9, 23, 1732, 10, 132, '2021-11-30 14:31:29', NULL),
(10, 23, 1797, 20, 324, '2021-11-30 14:31:29', NULL),
(11, 24, 1732, 10, 132, '2021-11-30 14:32:01', NULL),
(12, 24, 1797, 20, 324, '2021-11-30 14:32:01', NULL),
(13, 25, 2285, 3, 85, '2021-11-30 23:08:44', NULL),
(14, 25, 1268, 9, 321, '2021-11-30 23:08:44', NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `non_racikan`
--
ALTER TABLE `non_racikan`
  ADD PRIMARY KEY (`non_racikan_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `non_racikan`
--
ALTER TABLE `non_racikan`
  MODIFY `non_racikan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
