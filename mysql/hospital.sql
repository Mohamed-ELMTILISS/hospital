-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 01, 2021 at 03:16 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hospital`
--
CREATE DATABASE IF NOT EXISTS `hospital` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `hospital`;

-- --------------------------------------------------------

--
-- Table structure for table `chamber`
--

CREATE TABLE `chamber` (
  `chamber_id` varchar(20) NOT NULL,
  `is_empty` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `chamber`
--

INSERT INTO `chamber` (`chamber_id`, `is_empty`) VALUES
('C01T1', 1),
('C01T2', 1),
('C02T1', 1),
('C02T2', 1),
('C03T1', 1),
('C03T2', 1),
('C04T1', 1),
('C04T2', 1),
('C05T1', 1),
('C05T2', 1),
('C06T1', 1),
('C06T2', 1),
('C07T1', 1),
('C07T2', 1),
('C08T1', 1),
('C08T2', 1),
('C09T1', 1),
('C09T2', 1),
('C10T1', 1),
('C10T2', 1);

-- --------------------------------------------------------

--
-- Table structure for table `docteur`
--

CREATE TABLE `docteur` (
  `cin_D` varchar(20) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `tel` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `docteur`
--

INSERT INTO `docteur` (`cin_D`, `nom`, `prenom`, `tel`) VALUES
('AH90900', 'naim', 'rami', 699887766),
('MM000000', 'rami', 'lamin', 655445544),
('OD39390', 'ahmed', 'mansouri', 654142530),
('OD39391', 'moaman', 'ben jaloun', 654142531),
('OD39392', 'mounir', 'ben chaaroun', 654142532),
('OD39393', 'abd', 'bennani', 654142533),
('OD39394', 'abd rahim', 'hmamsi', 654142534),
('OD39395', 'hamza', 'ait lhssen', 654142535),
('OD39396', 'aymen', 'wasso', 654142536),
('OD39397', 'anwar', 'ben lfkih', 654142537),
('OD39398', 'amine', 'dahbi', 654142538);

-- --------------------------------------------------------

--
-- Table structure for table `etat_patient`
--

CREATE TABLE `etat_patient` (
  `id_E` int(11) NOT NULL,
  `cin_P` varchar(20) NOT NULL,
  `Etat` varchar(20) DEFAULT NULL,
  `cin_D` varchar(20) DEFAULT NULL,
  `chamber_id` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `etat_patient`
--

INSERT INTO `etat_patient` (`id_E`, `cin_P`, `Etat`, `cin_D`, `chamber_id`) VALUES
(88554, 'MM000099', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `facture`
--

CREATE TABLE `facture` (
  `id_F` int(11) NOT NULL,
  `cin_P` varchar(20) NOT NULL,
  `total` int(11) DEFAULT NULL,
  `avance` int(11) DEFAULT NULL,
  `date_paiment` date DEFAULT NULL,
  `date_sortie` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `facture`
--

INSERT INTO `facture` (`id_F`, `cin_P`, `total`, `avance`, `date_paiment`, `date_sortie`) VALUES
(24400, 'MM000099', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `cin_P` varchar(20) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `prenom` varchar(20) NOT NULL,
  `sex` varchar(1) DEFAULT NULL,
  `tel` int(20) NOT NULL,
  `date_entree` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`cin_P`, `nom`, `prenom`, `sex`, `tel`, `date_entree`) VALUES
('MM000099', 'Naimee', 'Nome', NULL, 666666666, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `rendez_vous`
--

CREATE TABLE `rendez_vous` (
  `id_RV` int(11) NOT NULL,
  `cin_P` varchar(20) NOT NULL,
  `date_RV` date NOT NULL,
  `observation` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rendez_vous`
--

INSERT INTO `rendez_vous` (`id_RV`, `cin_P`, `date_RV`, `observation`) VALUES
(49693, 'MM000099', '2021-06-16', 'Hart');

-- --------------------------------------------------------

--
-- Table structure for table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `cin_U` varchar(20) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `user_name` varchar(15) NOT NULL,
  `password` varchar(30) NOT NULL,
  `email` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `utilisateur`
--

INSERT INTO `utilisateur` (`cin_U`, `nom`, `prenom`, `user_name`, `password`, `email`) VALUES
('OD57907', 'elmitliss', 'mohamed', 'demahom', 'mdesmss1971', 'elmitliss.dakhla@gmail.com'),
('OD58366', 'Siham', 'Boussetta', 'siham', '1234', 'sihamboussetta353@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chamber`
--
ALTER TABLE `chamber`
  ADD PRIMARY KEY (`chamber_id`);

--
-- Indexes for table `docteur`
--
ALTER TABLE `docteur`
  ADD PRIMARY KEY (`cin_D`);

--
-- Indexes for table `etat_patient`
--
ALTER TABLE `etat_patient`
  ADD PRIMARY KEY (`id_E`),
  ADD KEY `etat_patient_ibfk_1` (`cin_P`),
  ADD KEY `etat_patient_ibfk_2` (`cin_D`),
  ADD KEY `etat_patient_ibfk_3` (`chamber_id`);

--
-- Indexes for table `facture`
--
ALTER TABLE `facture`
  ADD PRIMARY KEY (`id_F`),
  ADD KEY `facture_ibfk_1` (`cin_P`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`cin_P`);

--
-- Indexes for table `rendez_vous`
--
ALTER TABLE `rendez_vous`
  ADD PRIMARY KEY (`id_RV`),
  ADD KEY `rendez_vous_ibfk_1` (`cin_P`);

--
-- Indexes for table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`cin_U`),
  ADD UNIQUE KEY `unique-user-name` (`user_name`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `etat_patient`
--
ALTER TABLE `etat_patient`
  ADD CONSTRAINT `etat_patient_ibfk_1` FOREIGN KEY (`cin_P`) REFERENCES `patient` (`cin_P`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `etat_patient_ibfk_2` FOREIGN KEY (`cin_D`) REFERENCES `docteur` (`cin_D`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `etat_patient_ibfk_3` FOREIGN KEY (`chamber_id`) REFERENCES `chamber` (`chamber_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `facture`
--
ALTER TABLE `facture`
  ADD CONSTRAINT `facture_ibfk_1` FOREIGN KEY (`cin_P`) REFERENCES `patient` (`cin_P`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rendez_vous`
--
ALTER TABLE `rendez_vous`
  ADD CONSTRAINT `rendez_vous_ibfk_1` FOREIGN KEY (`cin_P`) REFERENCES `patient` (`cin_P`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
