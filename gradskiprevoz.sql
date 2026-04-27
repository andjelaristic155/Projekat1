-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 11, 2026 at 12:50 AM
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
-- Database: `gradskiprevoz`
--

-- --------------------------------------------------------

--
-- Table structure for table `karta`
--

CREATE TABLE `karta` (
  `idKarte` int(11) NOT NULL,
  `Trajanje` enum('Dnevna','Mesecna','','') NOT NULL,
  `Zona` varchar(20) NOT NULL,
  `Cena` decimal(11,0) NOT NULL,
  `status` enum('aktivan','neaktivan','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `karta`
--

INSERT INTO `karta` (`idKarte`, `Trajanje`, `Zona`, `Cena`, `status`) VALUES
(1, 'Dnevna', 'A', 110, 'neaktivan'),
(2, 'Dnevna', 'B', 100, 'aktivan'),
(3, 'Dnevna', 'C(A+B)', 110, 'aktivan'),
(4, 'Mesecna', 'A', 1500, 'aktivan'),
(5, 'Mesecna', 'B', 1500, 'aktivan'),
(6, 'Mesecna', 'C(A+B)', 1800, 'aktivan'),
(11, 'Dnevna', 'A', 11, 'aktivan');

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

CREATE TABLE `korisnik` (
  `idKorisnika` int(11) NOT NULL,
  `Ime` varchar(30) NOT NULL,
  `Prezime` varchar(30) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Sifra` varchar(512) NOT NULL,
  `Uloga` enum('Korisnik','Admin','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`idKorisnika`, `Ime`, `Prezime`, `Email`, `Sifra`, `Uloga`) VALUES
(1, 'Andjela1', 'Ristic', 'andjelaristic155@gmail.com', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', 'Korisnik'),
(3, 'Petar', 'Petrovic', 'korisnik@gmail.com', '396ebbec80ce4ae542245ae0312111fe054a3fa8b99b33384d8e368ba943dcd41fe78a02af26ff984d1c9cd9e6ccca57304df9ca6c5f2f7e3d08b58fe2ba7bfe', 'Korisnik'),
(4, 'Ivana', 'Ivanovic', 'admin@gmail.com', '58b5444cf1b6253a4317fe12daff411a78bda0a95279b1d5768ebf5ca60829e78da944e8a9160a0b6d428cb213e813525a72650dac67b88879394ff624da482f', 'Admin'),
(7, 'Mina', 'Milic', 'mina@gmail.com', 'dbc8715a1ada1ff31f338bd9d6a9b43b0c668eb5e2386cfb4efdad8956e2ac3dd0fbcdb696e481bb49ede630239f080e2ff58d94c5e6fd06a0fde41f3b2eb516', 'Korisnik');

-- --------------------------------------------------------

--
-- Table structure for table `rezervacija`
--

CREATE TABLE `rezervacija` (
  `idRezervacije` int(11) NOT NULL,
  `idKorisnika` int(11) NOT NULL,
  `idKarte` int(11) NOT NULL,
  `DatumRezervacije` date NOT NULL DEFAULT current_timestamp(),
  `DatumIsteka` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rezervacija`
--

INSERT INTO `rezervacija` (`idRezervacije`, `idKorisnika`, `idKarte`, `DatumRezervacije`, `DatumIsteka`) VALUES
(5, 3, 3, '2026-02-26', '2026-03-26'),
(7, 1, 5, '2026-02-26', '2026-03-26'),
(9, 1, 4, '2026-03-10', '2026-04-10'),
(16, 1, 3, '2026-03-11', '2026-03-12'),
(17, 1, 11, '2026-03-11', '2026-03-12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `karta`
--
ALTER TABLE `karta`
  ADD PRIMARY KEY (`idKarte`);

--
-- Indexes for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD PRIMARY KEY (`idKorisnika`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indexes for table `rezervacija`
--
ALTER TABLE `rezervacija`
  ADD PRIMARY KEY (`idRezervacije`),
  ADD KEY `fkKorisnika` (`idKorisnika`),
  ADD KEY `fkKarte` (`idKarte`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `karta`
--
ALTER TABLE `karta`
  MODIFY `idKarte` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `korisnik`
--
ALTER TABLE `korisnik`
  MODIFY `idKorisnika` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `rezervacija`
--
ALTER TABLE `rezervacija`
  MODIFY `idRezervacije` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `rezervacija`
--
ALTER TABLE `rezervacija`
  ADD CONSTRAINT `fkKarte` FOREIGN KEY (`idKarte`) REFERENCES `karta` (`idKarte`),
  ADD CONSTRAINT `fkKorisnika` FOREIGN KEY (`idKorisnika`) REFERENCES `korisnik` (`idKorisnika`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
