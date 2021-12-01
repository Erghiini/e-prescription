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
-- Struktur dari tabel `racikan`
--

CREATE TABLE `racikan` (
  `racikan_id` int(11) NOT NULL,
  `prescription_id` int(11) NOT NULL,
  `racikan_nama` varchar(500) NOT NULL,
  `signa_id` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `racikan`
--

INSERT INTO `racikan` (`racikan_id`, `prescription_id`, `racikan_nama`, `signa_id`, `created_date`, `created_by`) VALUES
(7, 2, 'Racikan 1', 308, '2021-11-30 13:57:57', NULL),
(8, 2, 'Racikan 2', 425, '2021-11-30 13:57:57', NULL),
(9, 20, 'Racikan 1', 308, '2021-11-30 14:25:12', NULL),
(10, 20, 'Racikan 2', 425, '2021-11-30 14:25:12', NULL),
(11, 21, 'Racikan 1', 308, '2021-11-30 14:26:04', NULL),
(12, 21, 'Racikan 2', 425, '2021-11-30 14:26:05', NULL),
(13, 22, 'Racikan 1', 308, '2021-11-30 14:27:28', NULL),
(14, 22, 'Racikan 2', 425, '2021-11-30 14:27:28', NULL),
(15, 23, 'Racikan 1', 308, '2021-11-30 14:31:29', NULL),
(16, 23, 'Racikan 2', 425, '2021-11-30 14:31:30', NULL),
(17, 24, 'Racikan 1', 308, '2021-11-30 14:32:02', NULL),
(18, 24, 'Racikan 2', 425, '2021-11-30 14:32:03', NULL),
(19, 25, 'Racikan 1', 308, '2021-11-30 23:08:45', NULL),
(20, 25, 'Racikan 2', 122, '2021-11-30 23:08:45', NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `racikan`
--
ALTER TABLE `racikan`
  ADD PRIMARY KEY (`racikan_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `racikan`
--
ALTER TABLE `racikan`
  MODIFY `racikan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
