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
-- Struktur dari tabel `patient_m`
--

CREATE TABLE `patient_m` (
  `patient_id` int(11) NOT NULL,
  `patient_name` varchar(128) NOT NULL,
  `patient_birthplace` varchar(100) NOT NULL,
  `patient_birthdate` date NOT NULL,
  `patient_address` varchar(500) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `patient_m`
--

INSERT INTO `patient_m` (`patient_id`, `patient_name`, `patient_birthplace`, `patient_birthdate`, `patient_address`, `created_date`, `created_by`) VALUES
(1, 'ERGHI IMANNUR ICHSAN', 'BANDUNG', '1994-04-15', 'CIKARANG, BEKASI', '2021-11-30 21:55:57', NULL),
(2, 'JOHN DOE', 'JAKARTA', '1990-01-01', 'DKI JAKARTA', '2021-11-30 21:55:57', NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `patient_m`
--
ALTER TABLE `patient_m`
  ADD PRIMARY KEY (`patient_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `patient_m`
--
ALTER TABLE `patient_m`
  MODIFY `patient_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
