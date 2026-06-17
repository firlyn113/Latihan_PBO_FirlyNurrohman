-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 17, 2026 at 06:44 AM
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
-- Database: `db_latihan_pbo_trpl1b_firlynurrohman`
--

-- --------------------------------------------------------

--
-- Table structure for table `tabel_tiket`
--

CREATE TABLE `tabel_tiket` (
  `id_tiket` int(11) NOT NULL,
  `nama_film` varchar(100) NOT NULL,
  `jadwal_tayang` datetime NOT NULL,
  `jumlah_kursi` int(11) NOT NULL,
  `harga_dasar_tiket` decimal(10,2) NOT NULL,
  `jenis_studio` enum('Regular','IMAX','Velvet') NOT NULL,
  `tipe_audio` varchar(50) DEFAULT NULL,
  `lokasi_baris` varchar(10) DEFAULT NULL,
  `kacamata_3d_id` varchar(20) DEFAULT NULL,
  `efek_gerak_fitur` varchar(50) DEFAULT NULL,
  `bantal_selimut_pack` varchar(20) DEFAULT NULL,
  `layanan_butler` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tabel_tiket`
--

INSERT INTO `tabel_tiket` (`id_tiket`, `nama_film`, `jadwal_tayang`, `jumlah_kursi`, `harga_dasar_tiket`, `jenis_studio`, `tipe_audio`, `lokasi_baris`, `kacamata_3d_id`, `efek_gerak_fitur`, `bantal_selimut_pack`, `layanan_butler`) VALUES
(1, 'Avengers: Endgame', '2026-06-20 14:30:00', 50, 45000.00, 'Regular', 'Dolby Digital', 'A1-A10', NULL, NULL, NULL, NULL),
(2, 'Spider-Man: No Way Home', '2026-06-20 17:00:00', 50, 45000.00, 'Regular', 'DTS', 'B1-B10', NULL, NULL, NULL, NULL),
(3, 'Doctor Strange 2', '2026-06-21 10:00:00', 50, 45000.00, 'Regular', 'Dolby Atmos', 'C1-C10', NULL, NULL, NULL, NULL),
(4, 'Black Panther', '2026-06-21 13:30:00', 50, 45000.00, 'Regular', 'Stereo', 'D1-D10', NULL, NULL, NULL, NULL),
(5, 'Thor: Love and Thunder', '2026-06-22 16:00:00', 50, 45000.00, 'Regular', 'Dolby Digital', 'E1-E10', NULL, NULL, NULL, NULL),
(6, 'Guardians of the Galaxy', '2026-06-22 19:30:00', 50, 45000.00, 'Regular', 'DTS', 'F1-F10', NULL, NULL, NULL, NULL),
(7, 'The Batman', '2026-06-23 11:00:00', 50, 45000.00, 'Regular', 'Dolby Atmos', 'G1-G10', NULL, NULL, NULL, NULL),
(8, 'Dune: Part Two', '2026-06-20 15:00:00', 100, 120000.00, 'IMAX', 'Dolby Atmos', 'A1-A20', 'IMAX-3D-001', 'Full Motion', NULL, NULL),
(9, 'Avatar 3', '2026-06-20 19:00:00', 100, 120000.00, 'IMAX', 'Dolby Digital', 'B1-B20', 'IMAX-3D-002', 'Full Motion', NULL, NULL),
(10, 'Oppenheimer', '2026-06-21 12:00:00', 100, 120000.00, 'IMAX', 'DTS', 'C1-C20', 'IMAX-3D-003', 'Partial Motion', NULL, NULL),
(11, 'Interstellar', '2026-06-21 18:00:00', 100, 120000.00, 'IMAX', 'Dolby Atmos', 'D1-D20', 'IMAX-3D-004', 'Full Motion', NULL, NULL),
(12, 'Top Gun: Maverick', '2026-06-22 14:00:00', 100, 120000.00, 'IMAX', 'Dolby Digital', 'E1-E20', 'IMAX-3D-005', 'Partial Motion', NULL, NULL),
(13, 'Tenet', '2026-06-22 20:00:00', 100, 120000.00, 'IMAX', 'DTS', 'F1-F20', 'IMAX-3D-006', 'Full Motion', NULL, NULL),
(14, 'The Dark Knight', '2026-06-23 16:00:00', 100, 120000.00, 'IMAX', 'Dolby Atmos', 'G1-G20', 'IMAX-3D-007', 'Partial Motion', NULL, NULL),
(15, 'Fast X', '2026-06-20 16:30:00', 30, 250000.00, 'Velvet', 'Dolby Atmos', 'VIP-A1-A5', NULL, NULL, 'Bantal+Selimut', 'Butler Service'),
(16, 'John Wick 4', '2026-06-20 20:00:00', 30, 250000.00, 'Velvet', 'Dolby Digital', 'VIP-B1-B5', NULL, NULL, 'Bantal+Selimut', 'Butler Service'),
(17, 'Mission Impossible 8', '2026-06-21 15:30:00', 30, 250000.00, 'Velvet', 'DTS', 'VIP-C1-C5', NULL, NULL, 'Bantal+Selimut', 'Butler Service'),
(18, 'James Bond: No Time To Die', '2026-06-21 19:30:00', 30, 250000.00, 'Velvet', 'Dolby Atmos', 'VIP-D1-D5', NULL, NULL, 'Bantal+Selimut', 'Butler Service'),
(19, 'The Equalizer 3', '2026-06-22 17:30:00', 30, 250000.00, 'Velvet', 'Dolby Digital', 'VIP-E1-E5', NULL, NULL, 'Bantal+Selimut', 'Butler Service'),
(20, 'Indiana Jones 5', '2026-06-23 13:30:00', 30, 250000.00, 'Velvet', 'DTS', 'VIP-F1-F5', NULL, NULL, 'Bantal+Selimut', 'Butler Service');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tabel_tiket`
--
ALTER TABLE `tabel_tiket`
  ADD PRIMARY KEY (`id_tiket`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tabel_tiket`
--
ALTER TABLE `tabel_tiket`
  MODIFY `id_tiket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
