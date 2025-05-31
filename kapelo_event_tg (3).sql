-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: mysql-kapelo.alwaysdata.net
-- Generation Time: May 27, 2025 at 04:20 AM
-- Server version: 10.11.11-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kapelo_event_tg`
--

-- --------------------------------------------------------

--
-- Table structure for table `ActivityLog`
--

CREATE TABLE `ActivityLog` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `action` varchar(191) NOT NULL,
  `entityType` varchar(191) NOT NULL,
  `entityId` int(11) NOT NULL,
  `details` text DEFAULT NULL,
  `ipAddress` varchar(191) DEFAULT NULL,
  `subject_type` varchar(255) DEFAULT NULL COMMENT 'Type de l''entité concernée (ex: App\\Models\\TicketType)',
  `subject_id` bigint(20) UNSIGNED DEFAULT NULL COMMENT 'ID de l''entité concernée',
  `description` varchar(255) DEFAULT NULL COMMENT 'Type d''action (create_ticket_type, add_quantity, remove_quantity)',
  `properties` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL COMMENT 'Données JSON additionnelles (ex: {"quantity": 5})' CHECK (json_valid(`properties`)),
  `created_at` timestamp(3) NULL DEFAULT current_timestamp(3),
  `updated_at` timestamp(3) NULL DEFAULT current_timestamp(3)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ActivityLog`
--

INSERT INTO `ActivityLog` (`id`, `userId`, `action`, `entityType`, `entityId`, `details`, `ipAddress`, `subject_type`, `subject_id`, `description`, `properties`, `created_at`, `updated_at`) VALUES
(1, 1, 'LOGIN', 'USER', 1, 'Connexion utilisateur', '::1', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55.000', '2025-05-21 04:09:55.000'),
(2, 1, 'LOGIN', 'USER', 1, 'Connexion utilisateur', '::1', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55.000', '2025-05-21 04:09:55.000'),
(3, 1, 'LOGIN', 'USER', 1, 'Connexion utilisateur', '::1', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55.000', '2025-05-21 04:09:55.000'),
(4, 1, 'LOGIN', 'USER', 1, 'Connexion utilisateur', '::1', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55.000', '2025-05-21 04:09:55.000'),
(5, 1, 'LOGIN', 'USER', 1, 'Connexion utilisateur', '::1', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55.000', '2025-05-21 04:09:55.000'),
(6, 1, 'LOGIN', 'USER', 1, 'Connexion utilisateur', '::1', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55.000', '2025-05-21 04:09:55.000'),
(7, 1, 'LOGIN', 'USER', 1, 'Connexion utilisateur', '::1', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55.000', '2025-05-21 04:09:55.000'),
(8, 1, 'LOGIN', 'USER', 1, 'Connexion utilisateur', '::1', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55.000', '2025-05-21 04:09:55.000'),
(9, 1, 'LOGIN', 'USER', 1, 'Connexion utilisateur', '::1', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55.000', '2025-05-21 04:09:55.000'),
(10, 1, 'LOGIN', 'USER', 1, 'Connexion utilisateur', '::1', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55.000', '2025-05-21 04:09:55.000'),
(11, 1, 'LOGIN', 'USER', 1, 'Connexion utilisateur', '::1', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55.000', '2025-05-21 04:09:55.000'),
(12, 1, 'LOGIN', 'USER', 1, 'Connexion utilisateur', '::1', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55.000', '2025-05-21 04:09:55.000'),
(13, 1, 'CREATE', 'EVENT', 1, 'Création de l\'événement: happy run', '::1', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55.000', '2025-05-21 04:09:55.000'),
(14, 1, 'CREATE', 'EVENT', 2, 'Création de l\'événement: kop', '::1', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55.000', '2025-05-21 04:09:55.000'),
(15, 1, 'CREATE', 'EVENT', 3, 'Création de l\'événement: mood', '::1', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55.000', '2025-05-21 04:09:55.000'),
(16, 2, 'REGISTER', 'USER', 2, 'Création du compte utilisateur', '::1', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55.000', '2025-05-21 04:09:55.000'),
(17, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '::1', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55.000', '2025-05-21 04:09:55.000'),
(18, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '::1', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55.000', '2025-05-21 04:09:55.000'),
(19, 1, 'LOGIN', 'USER', 1, 'Connexion utilisateur', '::1', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55.000', '2025-05-21 04:09:55.000'),
(20, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '::1', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55.000', '2025-05-21 04:09:55.000'),
(21, 1, 'LOGIN', 'USER', 1, 'Connexion utilisateur', '::1', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55.000', '2025-05-21 04:09:55.000'),
(22, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '::1', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55.000', '2025-05-21 04:09:55.000'),
(23, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '::1', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55.000', '2025-05-21 04:09:55.000'),
(24, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '::1', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55.000', '2025-05-21 04:09:55.000'),
(25, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '::1', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55.000', '2025-05-21 04:09:55.000'),
(26, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '::1', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55.000', '2025-05-21 04:09:55.000'),
(27, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '::1', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55.000', '2025-05-21 04:09:55.000'),
(28, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '::1', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55.000', '2025-05-21 04:09:55.000'),
(29, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '::1', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55.000', '2025-05-21 04:09:55.000'),
(30, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '::1', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55.000', '2025-05-21 04:09:55.000'),
(31, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '::1', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55.000', '2025-05-21 04:09:55.000'),
(32, 1, 'LOGIN', 'USER', 1, 'Connexion utilisateur', '::1', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55.000', '2025-05-21 04:09:55.000'),
(33, 1, 'CREATE', 'AGENT', 3, 'Création de l\'agent: dave SITTI', '::1', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55.000', '2025-05-21 04:09:55.000'),
(34, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '::1', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55.000', '2025-05-21 04:09:55.000'),
(35, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '::1', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55.000', '2025-05-21 04:09:55.000'),
(36, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '::1', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55.000', '2025-05-21 04:09:55.000'),
(37, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '::1', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55.000', '2025-05-21 04:09:55.000'),
(38, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '::1', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55.000', '2025-05-21 04:09:55.000'),
(39, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '::1', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55.000', '2025-05-21 04:09:55.000'),
(40, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '127.0.0.1', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55.000', '2025-05-21 04:09:55.000'),
(41, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '192.168.0.137', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55.000', '2025-05-21 04:09:55.000'),
(42, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '192.168.0.137', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55.000', '2025-05-21 04:09:55.000'),
(43, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '192.168.0.137', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55.000', '2025-05-21 04:09:55.000'),
(44, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '192.168.0.137', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55.000', '2025-05-21 04:09:55.000'),
(45, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '192.168.0.137', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55.000', '2025-05-21 04:09:55.000'),
(46, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '192.168.0.137', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55.000', '2025-05-21 04:09:55.000'),
(47, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '192.168.0.137', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55.000', '2025-05-21 04:09:55.000'),
(48, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '192.168.0.137', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55.000', '2025-05-21 04:09:55.000'),
(49, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '192.168.0.137', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55.000', '2025-05-21 04:09:55.000'),
(50, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '192.168.0.137', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55.000', '2025-05-21 04:09:55.000'),
(51, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '192.168.0.137', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55.000', '2025-05-21 04:09:55.000'),
(52, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '192.168.0.137', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55.000', '2025-05-21 04:09:55.000'),
(53, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '192.168.0.137', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55.000', '2025-05-21 04:09:55.000'),
(54, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '192.168.0.137', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55.000', '2025-05-21 04:09:55.000'),
(55, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '127.0.0.1', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55.000', '2025-05-21 04:09:55.000'),
(56, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '127.0.0.1', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55.000', '2025-05-21 04:09:55.000'),
(57, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '127.0.0.1', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55.000', '2025-05-21 04:09:55.000'),
(58, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '127.0.0.1', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55.000', '2025-05-21 04:09:55.000'),
(59, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '127.0.0.1', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55.000', '2025-05-21 04:09:55.000'),
(60, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '127.0.0.1', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55.000', '2025-05-21 04:09:55.000'),
(61, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '127.0.0.1', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55.000', '2025-05-21 04:09:55.000'),
(62, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55.000', '2025-05-21 04:09:55.000'),
(63, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55.000', '2025-05-21 04:09:55.000'),
(64, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55.000', '2025-05-21 04:09:55.000'),
(65, 1, 'LOGIN', 'USER', 1, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55.000', '2025-05-21 04:09:55.000'),
(66, 1, 'LOGIN', 'USER', 1, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55.000', '2025-05-21 04:09:55.000'),
(67, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55.000', '2025-05-21 04:09:55.000'),
(68, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55.000', '2025-05-21 04:09:55.000'),
(69, 1, 'LOGIN', 'USER', 1, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55.000', '2025-05-21 04:09:55.000'),
(70, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55.000', '2025-05-21 04:09:55.000'),
(71, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55.000', '2025-05-21 04:09:55.000'),
(72, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55.000', '2025-05-21 04:09:55.000'),
(73, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55.000', '2025-05-21 04:09:55.000'),
(74, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55.000', '2025-05-21 04:09:55.000'),
(75, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55.000', '2025-05-21 04:09:55.000'),
(76, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55.000', '2025-05-21 04:09:55.000'),
(77, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55.000', '2025-05-21 04:09:55.000'),
(78, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55.000', '2025-05-21 04:09:55.000'),
(79, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55.000', '2025-05-21 04:09:55.000'),
(80, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55.000', '2025-05-21 04:09:55.000'),
(81, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55.000', '2025-05-21 04:09:55.000'),
(82, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55.000', '2025-05-21 04:09:55.000'),
(83, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55.000', '2025-05-21 04:09:55.000'),
(84, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55.000', '2025-05-21 04:09:55.000'),
(85, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55.000', '2025-05-21 04:09:55.000'),
(86, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55.000', '2025-05-21 04:09:55.000'),
(87, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55.000', '2025-05-21 04:09:55.000'),
(88, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55.000', '2025-05-21 04:09:55.000'),
(89, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55.000', '2025-05-21 04:09:55.000'),
(90, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55.000', '2025-05-21 04:09:55.000'),
(91, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55.000', '2025-05-21 04:09:55.000'),
(92, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55.000', '2025-05-21 04:09:55.000'),
(93, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55.000', '2025-05-21 04:09:55.000'),
(94, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55.000', '2025-05-21 04:09:55.000'),
(95, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55.000', '2025-05-21 04:09:55.000'),
(96, 3, 'VALIDATE', 'TICKET', 37, 'Validation du ticket: TKT-17474389218878-c6fm8o', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55.000', '2025-05-21 04:09:55.000'),
(97, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55.000', '2025-05-21 04:09:55.000'),
(98, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55.000', '2025-05-21 04:09:55.000'),
(99, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55.000', '2025-05-21 04:09:55.000'),
(100, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55.000', '2025-05-21 04:09:55.000'),
(101, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55.000', '2025-05-21 04:09:55.000'),
(102, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55.000', '2025-05-21 04:09:55.000'),
(103, 1, 'LOGIN', 'USER', 1, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55.000', '2025-05-21 04:09:55.000'),
(104, 1, 'LOGIN', 'USER', 1, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55.000', '2025-05-21 04:09:55.000'),
(105, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55.000', '2025-05-21 04:09:55.000'),
(106, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55.000', '2025-05-21 04:09:55.000'),
(107, 3, 'VALIDATE', 'TICKET', 37, 'Validation du ticket: TKT-17474389218878-c6fm8o', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55.000', '2025-05-21 04:09:55.000'),
(108, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55.000', '2025-05-21 04:09:55.000'),
(109, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55.000', '2025-05-21 04:09:55.000'),
(110, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55.000', '2025-05-21 04:09:55.000'),
(111, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55.000', '2025-05-21 04:09:55.000'),
(112, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55.000', '2025-05-21 04:09:55.000'),
(113, 1, 'LOGIN', 'USER', 1, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55.000', '2025-05-21 04:09:55.000'),
(114, 1, 'LOGIN', 'USER', 1, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55.000', '2025-05-21 04:09:55.000'),
(115, 1, 'LOGIN', 'USER', 1, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55.000', '2025-05-21 04:09:55.000'),
(116, 4, 'REGISTER', 'USER', 4, 'Création du compte utilisateur', '127.0.0.1', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55.000', '2025-05-21 04:09:55.000'),
(117, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55.000', '2025-05-21 04:09:55.000'),
(118, 4, 'LOGIN', 'USER', 4, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55.000', '2025-05-21 04:09:55.000'),
(119, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55.000', '2025-05-21 04:09:55.000'),
(120, 4, 'create_ticket_type', 'App\\Models\\TicketType', 11, '{\"quantity\":\"50\"}', '127.0.0.1', NULL, NULL, NULL, NULL, '2025-05-21 04:41:01.000', '2025-05-21 04:41:01.000'),
(121, 4, 'add_quantity', 'App\\Models\\TicketType', 11, '{\"quantity\":\"10\"}', '127.0.0.1', NULL, NULL, NULL, NULL, '2025-05-21 10:23:16.000', '2025-05-21 10:23:16.000'),
(122, 4, 'add_quantity', 'App\\Models\\TicketType', 11, '{\"quantity\":\"5\"}', '127.0.0.1', NULL, NULL, NULL, NULL, '2025-05-21 10:26:42.000', '2025-05-21 10:26:42.000'),
(123, 4, 'remove_quantity', 'App\\Models\\TicketType', 11, '{\"quantity\":\"3\"}', '127.0.0.1', NULL, NULL, NULL, NULL, '2025-05-21 10:27:16.000', '2025-05-21 10:27:16.000'),
(124, 4, 'create_ticket_type', 'App\\Models\\TicketType', 12, '{\"quantity\":\"20\"}', '127.0.0.1', NULL, NULL, NULL, NULL, '2025-05-21 10:48:21.000', '2025-05-21 10:48:21.000'),
(125, 4, 'add_quantity', 'App\\Models\\TicketType', 12, '{\"quantity\":\"10\"}', '127.0.0.1', NULL, NULL, NULL, NULL, '2025-05-21 10:48:55.000', '2025-05-21 10:48:55.000'),
(126, 4, 'remove_quantity', 'App\\Models\\TicketType', 12, '{\"quantity\":\"3\"}', '127.0.0.1', NULL, NULL, NULL, NULL, '2025-05-21 10:49:37.000', '2025-05-21 10:49:37.000'),
(127, 4, 'create_ticket_type', 'App\\Models\\TicketType', 13, '{\"quantity\":\"20\"}', '127.0.0.1', NULL, NULL, NULL, NULL, '2025-05-21 11:05:05.000', '2025-05-21 11:05:05.000'),
(128, 4, 'create_ticket_type', 'App\\Models\\TicketType', 14, '{\"quantity\":\"20\"}', '127.0.0.1', NULL, NULL, NULL, NULL, '2025-05-21 11:05:54.000', '2025-05-21 11:05:54.000'),
(129, 4, 'create_ticket_type', 'App\\Models\\TicketType', 15, '{\"quantity\":\"25\"}', '127.0.0.1', NULL, NULL, NULL, NULL, '2025-05-21 11:09:39.000', '2025-05-21 11:09:39.000'),
(130, 4, 'add_quantity', 'App\\Models\\TicketType', 15, '{\"quantity\":\"10\"}', '127.0.0.1', NULL, NULL, NULL, NULL, '2025-05-21 11:10:23.000', '2025-05-21 11:10:23.000'),
(131, 4, 'create_ticket_type', 'App\\Models\\TicketType', 16, '{\"quantity\":\"1300\"}', '127.0.0.1', NULL, NULL, NULL, NULL, '2025-05-21 11:25:13.000', '2025-05-21 11:25:13.000'),
(132, 4, 'create_ticket_type', 'App\\Models\\TicketType', 17, '{\"quantity\":\"120\"}', '127.0.0.1', NULL, NULL, NULL, NULL, '2025-05-21 11:30:56.000', '2025-05-21 11:30:56.000'),
(133, 4, 'create_ticket_type', 'App\\Models\\TicketType', 18, '{\"quantity\":\"120\"}', '127.0.0.1', NULL, NULL, NULL, NULL, '2025-05-21 11:41:09.000', '2025-05-21 11:41:09.000'),
(134, 4, 'create_ticket_type', 'App\\Models\\TicketType', 19, '{\"quantity\":\"120\"}', '127.0.0.1', NULL, NULL, NULL, NULL, '2025-05-21 11:41:15.000', '2025-05-21 11:41:15.000'),
(135, 4, 'create_ticket_type', 'App\\Models\\TicketType', 20, '{\"quantity\":\"120\"}', '127.0.0.1', NULL, NULL, NULL, NULL, '2025-05-21 11:41:21.000', '2025-05-21 11:41:21.000'),
(136, 4, 'create_ticket_type', 'App\\Models\\TicketType', 21, '{\"quantity\":\"120\"}', '127.0.0.1', NULL, NULL, NULL, NULL, '2025-05-21 11:41:25.000', '2025-05-21 11:41:25.000'),
(137, 4, 'add_quantity', 'App\\Models\\TicketType', 13, '{\"quantity\":\"10\"}', '127.0.0.1', NULL, NULL, NULL, NULL, '2025-05-21 11:55:41.000', '2025-05-21 11:55:41.000'),
(138, 4, 'create_ticket_type', 'App\\Models\\TicketType', 22, '{\"quantity\":\"20\"}', '127.0.0.1', NULL, NULL, NULL, NULL, '2025-05-21 11:56:25.000', '2025-05-21 11:56:25.000'),
(139, 4, 'create_ticket_type', 'App\\Models\\TicketType', 23, '{\"quantity\":\"12\"}', '127.0.0.1', NULL, NULL, NULL, NULL, '2025-05-21 11:59:46.000', '2025-05-21 11:59:46.000'),
(140, 4, 'create_ticket_type', 'App\\Models\\TicketType', 24, '{\"quantity\":\"30\"}', '127.0.0.1', NULL, NULL, NULL, NULL, '2025-05-21 12:33:39.000', '2025-05-21 12:33:39.000'),
(141, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 14:49:26.761', '2025-05-21 14:49:26.761'),
(142, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 14:50:30.356', '2025-05-21 14:50:30.356'),
(143, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 15:04:05.843', '2025-05-21 15:04:05.843'),
(144, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 15:16:34.845', '2025-05-21 15:16:34.845'),
(145, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 15:18:12.027', '2025-05-21 15:18:12.027'),
(146, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 15:19:44.727', '2025-05-21 15:19:44.727'),
(147, 4, 'LOGIN', 'USER', 4, '\"Connexion utilisateur\"', '127.0.0.1', NULL, NULL, NULL, NULL, '2025-05-21 15:40:58.000', '2025-05-21 15:40:58.000'),
(148, 4, 'add_quantity', 'App\\Models\\TicketType', 5, '{\"quantity\":\"10\"}', '127.0.0.1', NULL, NULL, NULL, NULL, '2025-05-21 15:42:07.000', '2025-05-21 15:42:07.000'),
(149, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 15:45:37.946', '2025-05-21 15:45:37.946'),
(150, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 15:50:02.429', '2025-05-21 15:50:02.429'),
(151, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 15:59:49.624', '2025-05-21 15:59:49.624'),
(152, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 16:23:33.779', '2025-05-21 16:23:33.779'),
(153, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 16:24:07.537', '2025-05-21 16:24:07.537'),
(154, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 16:28:54.098', '2025-05-21 16:28:54.098'),
(155, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 16:42:30.572', '2025-05-21 16:42:30.572'),
(156, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 17:32:27.407', '2025-05-21 17:32:27.407'),
(157, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 17:33:08.474', '2025-05-21 17:33:08.474'),
(158, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 18:06:58.651', '2025-05-21 18:06:58.651'),
(159, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 18:07:55.654', '2025-05-21 18:07:55.654'),
(160, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 18:14:54.552', '2025-05-21 18:14:54.552'),
(161, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 18:35:19.000', '2025-05-21 18:35:19.000'),
(162, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 18:42:49.329', '2025-05-21 18:42:49.329'),
(163, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 18:49:08.651', '2025-05-21 18:49:08.651'),
(164, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 18:52:24.416', '2025-05-21 18:52:24.416'),
(165, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 18:55:24.679', '2025-05-21 18:55:24.679'),
(166, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 19:32:27.899', '2025-05-21 19:32:27.899'),
(167, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 19:43:00.038', '2025-05-21 19:43:00.038'),
(168, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 19:48:03.942', '2025-05-21 19:48:03.942'),
(169, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 19:48:32.364', '2025-05-21 19:48:32.364'),
(170, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 20:07:42.123', '2025-05-21 20:07:42.123'),
(171, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 20:09:44.458', '2025-05-21 20:09:44.458'),
(172, 4, 'LOGIN', 'USER', 4, '\"Connexion utilisateur\"', '2600:1f16:e0:8505:15c1::34', NULL, NULL, NULL, NULL, '2025-05-21 20:21:25.000', '2025-05-21 20:21:25.000'),
(173, 4, 'LOGIN', 'USER', 4, '\"Connexion utilisateur\"', '2600:1f16:e0:8503:950a::10', NULL, NULL, NULL, NULL, '2025-05-21 20:27:46.000', '2025-05-21 20:27:46.000'),
(174, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 20:29:47.919', '2025-05-21 20:29:47.919'),
(175, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 20:37:47.449', '2025-05-21 20:37:47.449'),
(176, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 20:39:17.589', '2025-05-21 20:39:17.589'),
(177, 4, 'LOGIN', 'USER', 4, '\"Connexion utilisateur\"', '2600:1f16:e0:8503:950a::10', NULL, NULL, NULL, NULL, '2025-05-21 20:42:53.000', '2025-05-21 20:42:53.000'),
(178, 4, 'LOGIN', 'USER', 4, '\"Connexion utilisateur\"', '2600:1f16:e0:8504:d850::32', NULL, NULL, NULL, NULL, '2025-05-21 20:51:34.000', '2025-05-21 20:51:34.000'),
(179, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 20:53:19.248', '2025-05-21 20:53:19.248'),
(180, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 20:54:37.887', '2025-05-21 20:54:37.887'),
(181, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 20:55:16.577', '2025-05-21 20:55:16.577'),
(182, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 21:57:39.405', '2025-05-21 21:57:39.405'),
(183, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 22:05:34.886', '2025-05-21 22:05:34.886'),
(184, 4, 'LOGIN', 'USER', 4, '\"Connexion utilisateur\"', '2600:1f16:e0:8504:d850::32', NULL, NULL, NULL, NULL, '2025-05-21 22:10:18.000', '2025-05-21 22:10:18.000'),
(185, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 22:20:56.704', '2025-05-21 22:20:56.704'),
(186, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 22:33:11.262', '2025-05-21 22:33:11.262'),
(187, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 22:40:11.628', '2025-05-21 22:40:11.628'),
(188, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 23:24:00.466', '2025-05-21 23:24:00.466'),
(189, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 23:28:47.427', '2025-05-21 23:28:47.427'),
(190, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 23:40:57.303', '2025-05-21 23:40:57.303'),
(191, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 23:41:50.097', '2025-05-21 23:41:50.097'),
(192, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 23:42:02.980', '2025-05-21 23:42:02.980'),
(193, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 23:43:04.455', '2025-05-21 23:43:04.455'),
(194, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 23:43:50.961', '2025-05-21 23:43:50.961'),
(195, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 23:44:33.658', '2025-05-21 23:44:33.658'),
(196, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 23:44:50.004', '2025-05-21 23:44:50.004'),
(197, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 23:45:09.640', '2025-05-21 23:45:09.640'),
(198, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 23:45:33.919', '2025-05-21 23:45:33.919'),
(199, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 23:49:16.499', '2025-05-21 23:49:16.499'),
(200, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 23:54:20.440', '2025-05-21 23:54:20.440'),
(201, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 23:54:47.004', '2025-05-21 23:54:47.004'),
(202, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 23:55:08.528', '2025-05-21 23:55:08.528'),
(203, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 23:56:00.063', '2025-05-21 23:56:00.063'),
(204, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 23:59:55.424', '2025-05-21 23:59:55.424'),
(205, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-22 00:01:26.665', '2025-05-22 00:01:26.665'),
(206, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-22 00:01:48.228', '2025-05-22 00:01:48.228'),
(207, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-22 00:02:24.924', '2025-05-22 00:02:24.924'),
(208, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-22 00:02:58.030', '2025-05-22 00:02:58.030'),
(209, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-22 00:09:24.874', '2025-05-22 00:09:24.874'),
(210, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-22 00:19:07.789', '2025-05-22 00:19:07.789'),
(211, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-22 00:29:10.724', '2025-05-22 00:29:10.724'),
(212, 4, 'LOGIN', 'USER', 4, '\"Connexion utilisateur\"', '2600:1f16:e0:8503:950a::10', NULL, NULL, NULL, NULL, '2025-05-22 00:45:59.000', '2025-05-22 00:45:59.000'),
(213, 4, 'LOGIN', 'USER', 4, '\"Connexion utilisateur\"', '2600:1f16:e0:8503:950a::10', NULL, NULL, NULL, NULL, '2025-05-22 00:46:31.000', '2025-05-22 00:46:31.000'),
(214, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-22 00:56:26.055', '2025-05-22 00:56:26.055'),
(215, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-22 01:03:35.396', '2025-05-22 01:03:35.396'),
(216, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-22 01:04:07.406', '2025-05-22 01:04:07.406'),
(217, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-22 01:21:35.167', '2025-05-22 01:21:35.167'),
(218, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-22 01:28:25.282', '2025-05-22 01:28:25.282'),
(219, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-22 01:29:45.103', '2025-05-22 01:29:45.103'),
(220, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-22 05:39:46.885', '2025-05-22 05:39:46.885'),
(221, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-22 05:42:08.701', '2025-05-22 05:42:08.701'),
(222, 4, 'LOGIN', 'USER', 4, '\"Connexion utilisateur\"', '2600:1f16:e0:8503:b24c::2f', NULL, NULL, NULL, NULL, '2025-05-22 07:14:17.000', '2025-05-22 07:14:17.000'),
(223, 4, 'LOGIN', 'USER', 4, '\"Connexion utilisateur\"', '2600:1f16:e0:8503:950a::46', NULL, NULL, NULL, NULL, '2025-05-22 07:14:43.000', '2025-05-22 07:14:43.000'),
(224, 4, 'create_ticket_type', 'App\\Models\\TicketType', 25, '{\"quantity\":\"100\"}', '2600:1f16:e0:8503:20f8::27', NULL, NULL, NULL, NULL, '2025-05-22 07:20:26.000', '2025-05-22 07:20:26.000'),
(225, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.169.14.189', NULL, NULL, NULL, NULL, '2025-05-22 09:56:42.952', '2025-05-22 09:56:42.952'),
(226, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-22 13:25:16.820', '2025-05-22 13:25:16.820'),
(227, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-22 13:30:03.444', '2025-05-22 13:30:03.444'),
(228, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-22 13:31:15.256', '2025-05-22 13:31:15.256'),
(229, 4, 'LOGIN', 'USER', 4, '\"Connexion utilisateur\"', '127.0.0.1', NULL, NULL, NULL, NULL, '2025-05-22 13:34:29.000', '2025-05-22 13:34:29.000'),
(230, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-22 13:35:45.627', '2025-05-22 13:35:45.627'),
(231, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-22 15:06:01.405', '2025-05-22 15:06:01.405'),
(232, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-22 15:21:18.688', '2025-05-22 15:21:18.688'),
(233, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-22 15:30:04.363', '2025-05-22 15:30:04.363'),
(234, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-22 15:41:42.964', '2025-05-22 15:41:42.964'),
(235, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-22 15:48:29.034', '2025-05-22 15:48:29.034'),
(236, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-22 15:59:46.320', '2025-05-22 15:59:46.320'),
(237, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-22 16:14:10.014', '2025-05-22 16:14:10.014'),
(238, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-22 16:16:52.684', '2025-05-22 16:16:52.684'),
(239, 4, 'LOGIN', 'USER', 4, '\"Connexion utilisateur\"', '127.0.0.1', NULL, NULL, NULL, NULL, '2025-05-22 16:46:17.000', '2025-05-22 16:46:17.000'),
(240, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-22 17:43:37.720', '2025-05-22 17:43:37.720'),
(241, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-22 17:52:24.081', '2025-05-22 17:52:24.081'),
(242, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-22 18:02:54.263', '2025-05-22 18:02:54.263'),
(243, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-22 18:21:05.611', '2025-05-22 18:21:05.611'),
(244, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-22 18:30:49.666', '2025-05-22 18:30:49.666'),
(245, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-22 18:46:33.466', '2025-05-22 18:46:33.466'),
(246, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-22 19:00:30.729', '2025-05-22 19:00:30.729'),
(247, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-22 20:21:57.385', '2025-05-22 20:21:57.385'),
(248, 4, 'LOGIN', 'USER', 4, '\"Connexion utilisateur\"', '2600:1f16:e0:8505:15c1::34', NULL, NULL, NULL, NULL, '2025-05-22 22:23:44.000', '2025-05-22 22:23:44.000'),
(249, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-22 22:35:48.110', '2025-05-22 22:35:48.110'),
(250, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-22 23:59:58.543', '2025-05-22 23:59:58.543'),
(251, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-23 00:22:38.166', '2025-05-23 00:22:38.166'),
(252, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-23 11:37:42.783', '2025-05-23 11:37:42.783'),
(253, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-23 11:39:28.119', '2025-05-23 11:39:28.119'),
(254, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-23 12:57:50.351', '2025-05-23 12:57:50.351'),
(255, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-23 13:36:47.221', '2025-05-23 13:36:47.221'),
(256, 5, 'REGISTER', 'USER', 5, 'Création du compte utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-23 13:38:24.275', '2025-05-23 13:38:24.275'),
(257, 5, 'LOGIN', 'USER', 5, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-23 13:39:33.344', '2025-05-23 13:39:33.344'),
(258, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-23 13:42:46.133', '2025-05-23 13:42:46.133'),
(259, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-23 13:45:19.064', '2025-05-23 13:45:19.064'),
(260, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-23 14:00:05.481', '2025-05-23 14:00:05.481'),
(261, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-23 14:00:46.885', '2025-05-23 14:00:46.885'),
(262, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-23 14:03:49.435', '2025-05-23 14:03:49.435'),
(263, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-23 14:04:56.191', '2025-05-23 14:04:56.191'),
(264, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-23 14:05:30.072', '2025-05-23 14:05:30.072'),
(265, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-23 14:07:22.313', '2025-05-23 14:07:22.313'),
(266, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-23 14:09:56.112', '2025-05-23 14:09:56.112'),
(267, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-23 14:12:04.800', '2025-05-23 14:12:04.800'),
(268, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-23 14:19:29.704', '2025-05-23 14:19:29.704'),
(269, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-23 14:19:38.930', '2025-05-23 14:19:38.930'),
(270, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-23 14:27:13.720', '2025-05-23 14:27:13.720'),
(271, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-23 14:27:39.120', '2025-05-23 14:27:39.120'),
(272, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-23 14:28:44.120', '2025-05-23 14:28:44.120'),
(273, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-23 14:29:07.659', '2025-05-23 14:29:07.659'),
(274, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-23 14:29:23.841', '2025-05-23 14:29:23.841'),
(275, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-23 14:34:33.070', '2025-05-23 14:34:33.070'),
(276, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-23 14:34:56.878', '2025-05-23 14:34:56.878'),
(277, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-23 14:35:52.322', '2025-05-23 14:35:52.322'),
(278, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-23 14:37:19.561', '2025-05-23 14:37:19.561'),
(279, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-23 14:38:16.162', '2025-05-23 14:38:16.162'),
(280, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-23 14:38:46.641', '2025-05-23 14:38:46.641'),
(281, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-23 14:46:02.188', '2025-05-23 14:46:02.188'),
(282, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-23 14:51:46.485', '2025-05-23 14:51:46.485'),
(283, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-23 14:51:59.226', '2025-05-23 14:51:59.226'),
(284, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-23 14:53:36.509', '2025-05-23 14:53:36.509'),
(285, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-23 14:56:40.514', '2025-05-23 14:56:40.514'),
(286, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-23 15:05:02.156', '2025-05-23 15:05:02.156'),
(287, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-23 15:06:13.862', '2025-05-23 15:06:13.862'),
(288, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-23 15:07:13.077', '2025-05-23 15:07:13.077'),
(289, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-23 15:20:20.679', '2025-05-23 15:20:20.679'),
(290, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-23 15:24:48.822', '2025-05-23 15:24:48.822'),
(291, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-23 15:26:12.593', '2025-05-23 15:26:12.593'),
(292, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-23 16:08:49.932', '2025-05-23 16:08:49.932'),
(293, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-23 16:12:04.952', '2025-05-23 16:12:04.952'),
(294, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-23 16:41:39.788', '2025-05-23 16:41:39.788'),
(295, 5, 'LOGIN', 'USER', 5, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-23 16:41:54.145', '2025-05-23 16:41:54.145'),
(296, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-23 17:38:11.273', '2025-05-23 17:38:11.273'),
(297, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-23 18:06:02.511', '2025-05-23 18:06:02.511'),
(298, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-23 18:06:36.309', '2025-05-23 18:06:36.309'),
(299, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-23 18:06:52.804', '2025-05-23 18:06:52.804'),
(300, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-23 18:30:52.720', '2025-05-23 18:30:52.720'),
(301, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-23 18:33:44.268', '2025-05-23 18:33:44.268'),
(302, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-23 18:41:43.049', '2025-05-23 18:41:43.049'),
(303, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-23 18:41:56.544', '2025-05-23 18:41:56.544'),
(304, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-23 18:42:55.887', '2025-05-23 18:42:55.887'),
(305, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-23 18:43:28.952', '2025-05-23 18:43:28.952'),
(306, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-23 18:55:03.756', '2025-05-23 18:55:03.756'),
(307, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-23 19:09:20.720', '2025-05-23 19:09:20.720'),
(308, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-23 19:10:53.749', '2025-05-23 19:10:53.749'),
(309, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-23 19:11:36.499', '2025-05-23 19:11:36.499'),
(310, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-23 21:22:30.879', '2025-05-23 21:22:30.879'),
(311, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-23 21:30:26.179', '2025-05-23 21:30:26.179'),
(312, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-23 21:34:53.528', '2025-05-23 21:34:53.528'),
(313, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-23 21:54:37.158', '2025-05-23 21:54:37.158'),
(314, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-24 06:38:35.319', '2025-05-24 06:38:35.319'),
(315, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-24 06:49:03.391', '2025-05-24 06:49:03.391'),
(316, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '196.169.21.13', NULL, NULL, NULL, NULL, '2025-05-24 10:13:05.291', '2025-05-24 10:13:05.291'),
(317, 4, 'LOGIN', 'USER', 4, '\"Connexion utilisateur\"', '2600:1f16:e0:8503:20f8::27', NULL, NULL, NULL, NULL, '2025-05-24 10:14:25.000', '2025-05-24 10:14:25.000'),
(318, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.169.21.13', NULL, NULL, NULL, NULL, '2025-05-24 10:22:19.452', '2025-05-24 10:22:19.452'),
(319, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-24 18:22:49.093', '2025-05-24 18:22:49.093'),
(320, 4, 'LOGIN', 'USER', 4, '\"Connexion utilisateur\"', '127.0.0.1', NULL, NULL, NULL, NULL, '2025-05-24 21:10:26.000', '2025-05-24 21:10:26.000'),
(321, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-24 21:28:08.790', '2025-05-24 21:28:08.790'),
(322, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-25 00:56:11.529', '2025-05-25 00:56:11.529'),
(323, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-25 05:57:26.636', '2025-05-25 05:57:26.636'),
(324, 4, 'LOGIN', 'USER', 4, '\"Connexion utilisateur\"', '127.0.0.1', NULL, NULL, NULL, NULL, '2025-05-25 06:31:38.000', '2025-05-25 06:31:38.000'),
(325, 4, 'LOGIN', 'USER', 4, '\"Connexion utilisateur\"', '127.0.0.1', NULL, NULL, NULL, NULL, '2025-05-25 09:16:30.000', '2025-05-25 09:16:30.000'),
(326, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-25 12:23:19.192', '2025-05-25 12:23:19.192'),
(327, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-25 13:04:32.159', '2025-05-25 13:04:32.159'),
(328, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-25 13:16:47.543', '2025-05-25 13:16:47.543'),
(329, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.169.17.241', NULL, NULL, NULL, NULL, '2025-05-26 15:15:34.718', '2025-05-26 15:15:34.718'),
(330, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-26 21:37:44.128', '2025-05-26 21:37:44.128'),
(331, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-26 23:06:36.220', '2025-05-26 23:06:36.220'),
(332, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-26 23:29:31.886', '2025-05-26 23:29:31.886');

-- --------------------------------------------------------

--
-- Table structure for table `AgentEvent`
--

CREATE TABLE `AgentEvent` (
  `agentId` int(11) NOT NULL,
  `eventId` int(11) NOT NULL,
  `createdAt` datetime(3) NOT NULL DEFAULT current_timestamp(3)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `AgentEvent`
--

INSERT INTO `AgentEvent` (`agentId`, `eventId`, `createdAt`) VALUES
(3, 2, '2025-05-18 19:03:39.791'),
(3, 3, '2025-05-18 19:03:39.791');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(191) NOT NULL,
  `description` text DEFAULT NULL,
  `slug` varchar(191) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime(3) NOT NULL DEFAULT current_timestamp(3),
  `updated_at` datetime(3) NOT NULL DEFAULT current_timestamp(3)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `slug`, `active`, `created_at`, `updated_at`) VALUES
(1, 'Concert', 'Événements musicaux et performances live', 'concert', 1, '2025-05-18 17:49:59.004', '2025-05-20 21:29:47.000'),
(2, 'Sport', 'Événements sportifs et compétitions', 'sport', 1, '2025-05-18 17:49:59.004', '2025-05-18 17:49:59.004'),
(3, 'Festival', 'Festivals culturels et artistiques', 'festival', 1, '2025-05-18 17:49:59.004', '2025-05-18 17:49:59.004'),
(4, 'Conférence', 'Conférences professionnelles et séminaires', 'conference', 1, '2025-05-18 17:49:59.004', '2025-05-18 17:49:59.004'),
(5, 'Populaire', 'Événements les plus populaires', 'populaire', 1, '2025-05-18 17:49:59.004', '2025-05-18 17:49:59.004'),
(6, 'Formation', 'Ateliers et sessions de formation', 'formation', 1, '2025-05-18 17:49:59.004', '2025-05-18 17:49:59.004'),
(7, 'Exposition', 'Expositions d\'art et salons', 'exposition', 1, '2025-05-18 17:49:59.004', '2025-05-18 17:49:59.004');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `title` varchar(191) NOT NULL,
  `description` text NOT NULL,
  `start_date` datetime(3) NOT NULL,
  `end_date` datetime(3) NOT NULL,
  `is_multi_day` tinyint(1) NOT NULL DEFAULT 0,
  `has_specific_time` tinyint(1) NOT NULL DEFAULT 1,
  `start_time` varchar(191) DEFAULT NULL,
  `end_time` varchar(191) DEFAULT NULL,
  `location` varchar(191) NOT NULL,
  `status` varchar(191) NOT NULL DEFAULT 'DRAFT',
  `organizer` varchar(191) DEFAULT NULL,
  `created_at` datetime(3) DEFAULT current_timestamp(3),
  `updated_at` datetime(3) DEFAULT current_timestamp(3),
  `image_url` varchar(191) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `latitude` double DEFAULT NULL,
  `longitude` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `title`, `description`, `start_date`, `end_date`, `is_multi_day`, `has_specific_time`, `start_time`, `end_time`, `location`, `status`, `organizer`, `created_at`, `updated_at`, `image_url`, `category_id`, `latitude`, `longitude`) VALUES
(1, 'happy run', 'fun', '2025-05-18 00:00:00.000', '2025-05-18 00:00:00.000', 0, 1, '03:13', '05:13', 'lome ny', 'DRAFT', NULL, '2025-05-16 01:12:12.344', '2025-05-21 10:47:33.000', 'https://res.cloudinary.com/dhzibf7tu/image/upload/v1747824453/event-covers/php5C4F_p12r9d.jpg', 2, NULL, NULL),
(2, 'kop', 'k', '2025-05-17 00:00:00.000', '2025-05-17 00:00:00.000', 0, 1, '10:00', '11:00', 'lome ny', 'DRAFT', NULL, '2025-05-16 01:16:48.177', '2025-05-21 10:48:54.000', 'https://res.cloudinary.com/dhzibf7tu/image/upload/v1747824533/event-covers/php9108_xsfbuw.jpg', 3, NULL, NULL),
(3, 'mood', 'ko', '2025-05-16 00:00:00.000', '2025-05-23 00:00:00.000', 1, 0, '05:28', '07:30', 'lome ny', 'DRAFT', NULL, '2025-05-16 01:21:25.766', '2025-05-21 04:28:12.000', 'https://res.cloudinary.com/dhzibf7tu/image/upload/v1747801691/event-covers/php1117_cccij9.png', 1, NULL, NULL),
(4, 'gala', 'coool', '2025-06-01 00:00:00.000', '2025-06-01 00:00:00.000', 0, 1, '23:00', '23:59', 'Hôtel Sarakawa, Lomé, Togo', 'DRAFT', NULL, '2025-05-20 21:58:18.858', '2025-05-21 10:47:00.000', 'https://res.cloudinary.com/dhzibf7tu/image/upload/v1747824419/event-covers/phpDAAB_amljq3.jpg', 5, 6.125247944175287, 1.2166425100238416),
(5, 'zondo12', 'qwer', '2025-05-24 00:00:00.000', '2025-05-24 00:00:00.000', 0, 1, '10:30', '12:30', 'lome 2', 'DRAFT', NULL, '2025-05-20 22:04:48.116', '2025-05-21 04:26:13.000', 'https://res.cloudinary.com/dhzibf7tu/image/upload/v1747801572/event-covers/php34F2_law48x.png', 4, NULL, NULL),
(6, 'tttttttt', 'ws', '2025-05-24 00:00:00.000', '2025-05-24 00:00:00.000', 0, 1, '00:50', '00:59', 'Hôtel Sarakawa, Lomé, Togo', 'DRAFT', NULL, '2025-05-20 22:46:22.955', '2025-05-20 22:46:22.955', 'https://res.cloudinary.com/dhzibf7tu/image/upload/v1747773982/event-covers/php3F67_bfk2g9.jpg', 2, 6.164716545770456, 1.2287875359067135),
(7, 'GALA ESAG', 'Le Gala de fin d\'année ESAG-NDE Tokoin Séminaire 🎉 est un événement prestigieux organisé par l’École Supérieure d’Administration et de Gestion Notre-Dame de l’Église (ESAG-NDE), située au 52 Boulevard des Armées, dans l’enceinte du CESAL à Lomé, Togo 🌍. Cette célébration marque la clôture de l’année académique avec éclat et élégance, réunissant étudiants, professeurs, alumni et invités de marque dans une ambiance festive et conviviale 🥂.\r\n\r\nL’édition de cette année se tiendra dans le cadre somptueux de l’Hôtel Sarakawa 🏨, un lieu emblématique de Lomé connu pour son luxe et son hospitalité exceptionnelle. Niché en bord de mer, l’Hôtel Sarakawa offre un décor fastueux avec des salles de banquet modulables, une vue imprenable sur l’océan et des installations modernes, parfaites pour un événement d’une telle envergure 🌊✨. Les participants pourront profiter d’un service de haute qualité, d’une gastronomie raffinée mêlant saveurs locales et internationales 🍴, et d’une organisation irréprochable, soutenue par l’expertise de l’hôtel en matière d’événements prestigieux.\r\n\r\nLe gala promet une soirée mémorable avec au programme :\r\n\r\nDiscours inspirants 🎤 de la Directrice Générale, Sr Dr Louise de Jésus Assivon, et d’autres figures clés de l’ESAG-NDE, célébrant les réussites académiques et professionnelles des étudiants 📚.\r\nRemise de prix 🏆 pour récompenser l’excellence académique, l’engagement associatif et les réalisations exceptionnelles des étudiants.\r\nAnimations culturelles 🎭, incluant des performances musicales, danses traditionnelles et modernes, mettant en lumière le riche patrimoine togolais et la créativité des étudiants 🎶.\r\nCocktail dînatoire 🍸 avec des mets délicieux et des boissons raffinées, favorisant les échanges et le réseautage dans une atmosphère détendue.\r\nSoirée dansante 💃🕺 jusqu’au bout de la nuit, animée par un DJ ou un groupe live pour enflammer la piste de danse !\r\nCe gala est également une occasion unique de renforcer la cohésion entre les membres de la communauté ESAG-NDE, de célébrer les valeurs d’excellence et d’innovation prônées par l’école, et de créer des souvenirs inoubliables 🌟. Les tenues de gala élégantes sont de rigueur, ajoutant une touche de glamour à cette soirée exceptionnelle 👗🤵.\r\n\r\n📍 Lieu : Hôtel Sarakawa, Lomé, Togo\r\n\r\n📅 Date : Fin d’année académique (date exacte à confirmer)\r\n\r\n🎫 Participation : Réservée aux étudiants, alumni, professeurs et invités spéciaux\r\n\r\nNe manquez pas cet événement grandiose qui allie célébration, élégance et esprit communautaire ! 🎊', '2025-05-30 00:00:00.000', '2025-05-30 00:00:00.000', 0, 1, '18:00', '23:00', 'Hôtel Sarakawa, Lomé, Togo', 'DRAFT', NULL, '2025-05-20 22:57:11.000', '2025-05-20 22:57:11.000', 'https://res.cloudinary.com/dhzibf7tu/image/upload/v1747781832/event-covers/php361_o40k3i.jpg', 5, 6.164716545770456, 1.2287875359067135),
(8, 'zondo12', 'qwer', '2025-05-24 00:00:00.000', '2025-05-24 00:00:00.000', 0, 1, '10:30', '12:30', 'lome 2', 'DRAFT', NULL, '2025-05-21 04:25:41.000', '2025-05-21 04:25:41.000', 'https://res.cloudinary.com/dhzibf7tu/image/upload/v1747801540/event-covers/phpC33C_guhyxc.png', 4, NULL, NULL),
(9, 'test', 'oklm', '2025-05-30 00:00:00.000', '2025-05-30 00:00:00.000', 0, 1, '09:45', '10:46', 'lome 2', 'DRAFT', NULL, '2025-05-21 04:41:00.000', '2025-05-21 04:41:00.000', 'https://res.cloudinary.com/dhzibf7tu/image/upload/v1747802460/event-covers/phpC85D_hevgv1.jpg', 1, NULL, NULL),
(10, 'asdf', 'qwerty', '2025-05-24 00:00:00.000', '2025-05-24 00:00:00.000', 0, 1, '11:55', '17:59', 'togo', 'DRAFT', NULL, '2025-05-21 11:53:51.000', '2025-05-21 11:53:51.000', 'https://res.cloudinary.com/dhzibf7tu/image/upload/v1747828431/event-covers/phpF3F_ib75am.png', 2, NULL, NULL),
(11, 'qwert', 'ok', '2025-05-25 00:00:00.000', '2025-05-25 00:00:00.000', 0, 1, '11:02', '11:14', 'lome 2', 'DRAFT', NULL, '2025-05-21 12:00:01.000', '2025-05-21 12:07:00.000', 'https://res.cloudinary.com/dhzibf7tu/image/upload/v1747829220/event-covers/php138C_bxzovi.jpg', 1, NULL, NULL),
(12, 'oo', 'ok', '2025-05-25 00:00:00.000', '2025-05-25 00:00:00.000', 0, 1, '13:50', '13:48', 'togo', 'DRAFT', NULL, '2025-05-21 12:48:20.000', '2025-05-21 12:48:20.000', 'https://res.cloudinary.com/dhzibf7tu/image/upload/v1747831700/event-covers/phpF195_khgluf.jpg', 2, NULL, NULL),
(13, 'MEEW', 'zxc', '2025-05-24 00:00:00.000', '2025-05-25 00:00:00.000', 1, 1, '13:10', '18:13', 'togo', 'DRAFT', NULL, '2025-05-21 13:09:38.000', '2025-05-21 13:09:38.000', 'https://res.cloudinary.com/dhzibf7tu/image/upload/v1747832978/event-covers/php72C0_heczsq.jpg', 4, NULL, NULL),
(14, 'Kaba', 'Tu n’est pas fou ?', '2025-09-22 00:00:00.000', '2025-09-22 00:00:00.000', 0, 1, '09:19', '22:19', 'Lome', 'DRAFT', NULL, '2025-05-22 09:20:25.000', '2025-05-22 09:20:25.000', 'https://res.cloudinary.com/dhzibf7tu/image/upload/v1747905625/event-covers/phpi6heodggtc2qaKxABsE_g5pb9x.jpg', 3, 6.154646996687837, 1.229002112623661);

-- --------------------------------------------------------

--
-- Table structure for table `mobile_money_transactions`
--

CREATE TABLE `mobile_money_transactions` (
  `id` int(11) NOT NULL,
  `ticketId` int(11) NOT NULL,
  `transactionReference` varchar(191) NOT NULL,
  `amount` double NOT NULL,
  `phoneNumber` varchar(191) DEFAULT NULL,
  `provider` varchar(191) NOT NULL,
  `status` varchar(191) NOT NULL DEFAULT 'PENDING',
  `paymentUrl` varchar(191) DEFAULT NULL,
  `paymentToken` varchar(191) DEFAULT NULL,
  `responseData` text DEFAULT NULL,
  `createdAt` datetime(3) DEFAULT current_timestamp(3),
  `updatedAt` datetime(3) DEFAULT current_timestamp(3),
  `userId` int(11) NOT NULL,
  `ticketTypeId` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mobile_money_transactions`
--

INSERT INTO `mobile_money_transactions` (`id`, `ticketId`, `transactionReference`, `amount`, `phoneNumber`, `provider`, `status`, `paymentUrl`, `paymentToken`, `responseData`, `createdAt`, `updatedAt`, `userId`, `ticketTypeId`, `quantity`) VALUES
(1, 36, 'TXN-1747438921598-gw5ifh', 1000, '+22892948264', 'PAYDUNYA', 'PENDING', 'https://paydunya.com/checkout/invoice/2cm6Z9kWaRmay3CRFcD3', '2cm6Z9kWaRmay3CRFcD3', NULL, '2025-05-16 23:42:02.709', '2025-05-16 23:42:06.088', 2, 1, 1),
(4, 0, 'test_webhook_123', 50000, '22890123456', 'PAYDUNYA', 'completed', NULL, 'test_webhook_123', '{\"response_code\":\"00\",\"response_text\":\"Transaction Found\",\"hash\":\"8c6666a27fe5daeb76dae6abc7308a557dca5be1\",\"invoice\":{\"token\":\"test_webhook_123\",\"items\":{\"item_0\":{\"name\":\"VIP Pass\",\"quantity\":\"2\",\"unit_price\":\"25000\",\"total_price\":\"50000\"}},\"total_amount\":\"50000\",\"description\":\"Achat de tickets pour l\'événement\"},\"custom_data\":{\"userId\":\"2\",\"ticketTypeId\":\"2\"},\"status\":\"completed\",\"customer\":{\"name\":\"John Doe\",\"phone\":\"22890123456\",\"email\":\"john@example.com\"}}', '2025-05-22 13:17:27.277', '2025-05-22 13:17:27.277', 2, 2, 2),
(7, 0, 'test_token_123', 15000, '+22890123456', 'PAYDUNYA', 'completed', 'https://app.paydunya.com/sandbox-receipt/test_123', 'test_token_123', '{\"status\":\"completed\",\"invoice\":{\"token\":\"test_token_123\",\"total_amount\":15000,\"items\":{\"item_0\":{\"name\":\"Ticket VIP\",\"quantity\":2,\"price\":5000,\"ticketTypeId\":\"1\"},\"item_1\":{\"name\":\"Ticket Standard\",\"quantity\":1,\"price\":3000,\"ticketTypeId\":\"2\"},\"item_2\":{\"name\":\"Ticket Early Bird\",\"quantity\":1,\"price\":2000,\"ticketTypeId\":\"3\"}}},\"customer\":{\"name\":\"John Doe\",\"phone\":\"+22890123456\",\"email\":\"john@example.com\"},\"receipt_url\":\"https://app.paydunya.com/sandbox-receipt/test_123\"}', '2025-05-22 13:40:27.300', '2025-05-22 13:40:27.300', 0, 0, 1),
(9, 0, 'test_token_123_Bada', 15000, '+22890123456', 'PAYDUNYA', 'completed', 'https://app.paydunya.com/sandbox-receipt/test_123', 'test_token_123_Bada', '{\"status\":\"completed\",\"invoice\":{\"token\":\"test_token_123_Bada\",\"total_amount\":15000,\"items\":{\"item_0\":{\"name\":\"Ticket VIP\",\"quantity\":2,\"price\":5000,\"ticketTypeId\":\"1\"},\"item_1\":{\"name\":\"Ticket Standard\",\"quantity\":1,\"price\":3000,\"ticketTypeId\":\"2\"},\"item_2\":{\"name\":\"Ticket Early Bird\",\"quantity\":1,\"price\":2000,\"ticketTypeId\":\"3\"}}},\"custom_data\":{\"userId\":\"1\"},\"customer\":{\"name\":\"John Doe\",\"phone\":\"+22890123456\",\"email\":\"john@example.com\"},\"receipt_url\":\"https://app.paydunya.com/sandbox-receipt/test_123\"}', '2025-05-22 13:46:25.729', '2025-05-22 13:46:25.729', 1, 0, 1),
(10, 0, 'test_Jh2T8skw1j', 10000, '90123456', 'PAYDUNYA', 'pending', NULL, 'test_Jh2T8skw1j', '{\"response_code\":\"00\",\"response_text\":\"Transaction Found\",\"invoice\":{\"items\":{\"item_0\":{\"name\":\"Ticket VIP\",\"quantity\":\"2\",\"unit_price\":\"5000\",\"total_price\":\"10000\",\"ticketTypeId\":\"1\"}},\"token\":\"test_Jh2T8skw1j\",\"total_amount\":\"10000\"},\"custom_data\":{\"userId\":\"1\",\"eventTitle\":\"Concert\"},\"status\":\"pending\",\"customer\":{\"name\":\"John Doe\",\"phone\":\"90123456\"}}', '2025-05-22 16:27:13.702', '2025-05-22 16:27:13.702', 1, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `promo_codes`
--

CREATE TABLE `promo_codes` (
  `id` varchar(191) NOT NULL,
  `code` varchar(50) NOT NULL,
  `eventId` int(11) NOT NULL,
  `discount` decimal(10,2) NOT NULL,
  `discountType` enum('PERCENTAGE','FIXED') NOT NULL DEFAULT 'PERCENTAGE',
  `maxUses` int(11) DEFAULT NULL,
  `usedCount` int(11) NOT NULL DEFAULT 0,
  `startDate` datetime(3) DEFAULT NULL,
  `endDate` datetime(3) DEFAULT NULL,
  `isActive` tinyint(1) NOT NULL DEFAULT 1,
  `createdAt` datetime(3) NOT NULL DEFAULT current_timestamp(3),
  `updatedAt` datetime(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `promo_code_uses`
--

CREATE TABLE `promo_code_uses` (
  `id` varchar(191) NOT NULL,
  `promoCodeId` varchar(191) NOT NULL,
  `ticketId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `discountAmount` decimal(10,2) NOT NULL,
  `originalPrice` decimal(10,2) NOT NULL,
  `finalPrice` decimal(10,2) NOT NULL,
  `createdAt` datetime(3) NOT NULL DEFAULT current_timestamp(3)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Ticket`
--

CREATE TABLE `Ticket` (
  `id` int(11) NOT NULL,
  `ticketTypeId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `status` varchar(191) NOT NULL DEFAULT 'PENDING',
  `code` varchar(191) NOT NULL,
  `createdAt` datetime(3) DEFAULT current_timestamp(3),
  `updatedAt` datetime(3) DEFAULT current_timestamp(3),
  `validationDate` datetime(3) DEFAULT NULL,
  `validatedById` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `Ticket`
--

INSERT INTO `Ticket` (`id`, `ticketTypeId`, `userId`, `status`, `code`, `createdAt`, `updatedAt`, `validationDate`, `validatedById`) VALUES
(36, 8, 2, 'PAID', 'TKT-1747438921598-c6fm8o', '2025-05-16 23:42:02.027', '2025-05-16 23:42:02.027', NULL, NULL),
(37, 4, 2, 'USED', 'TKT-17474389218878-c6fm8o', '2025-05-16 23:42:02.027', '2025-05-20 00:37:03.248', '2025-05-20 00:37:03.000', 3),
(39, 2, 2, 'PAID', 'TKT-17474389218879-c6fm8o', '2025-05-16 23:42:02.027', '2025-05-16 23:42:02.027', NULL, NULL),
(40, 2, 2, 'PAID', 'TKT-1747912647006-8h3ghv', '2025-05-22 11:17:27.000', '2025-05-22 11:17:27.000', NULL, NULL),
(41, 2, 2, 'PAID', 'TKT-1747912647400-3whtqu', '2025-05-22 11:17:27.000', '2025-05-22 11:17:27.000', NULL, NULL),
(43, 1, 1, 'PAID', 'TKT-1747914385679-b5io57', '2025-05-22 11:46:25.000', '2025-05-22 11:46:25.000', NULL, NULL),
(44, 1, 1, 'PAID', 'TKT-1747914385978-rfh1c8', '2025-05-22 11:46:25.000', '2025-05-22 11:46:25.000', NULL, NULL),
(45, 9, 1, 'PAID', 'TKT-1747914386288-86yhhn', '2025-05-22 11:46:25.000', '2025-05-22 11:46:25.000', NULL, NULL),
(46, 22, 1, 'PAID', 'TKT-1747914386968-m3ovrg', '2025-05-22 11:46:25.000', '2025-05-22 11:46:25.000', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `TicketType`
--

CREATE TABLE `TicketType` (
  `id` int(11) NOT NULL,
  `name` varchar(191) NOT NULL,
  `price` double NOT NULL,
  `quantity` int(11) NOT NULL,
  `description` text DEFAULT NULL,
  `eventId` int(11) NOT NULL,
  `createdAt` datetime(3) DEFAULT current_timestamp(3),
  `updatedAt` datetime(3) DEFAULT current_timestamp(3)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `TicketType`
--

INSERT INTO `TicketType` (`id`, `name`, `price`, `quantity`, `description`, `eventId`, `createdAt`, `updatedAt`) VALUES
(1, 'standard', 1000, 8, '', 1, '2025-05-16 01:12:12.344', '2025-05-16 01:12:12.344'),
(2, 'standard', 1000, 10, '', 2, '2025-05-16 01:16:48.177', '2025-05-16 01:16:48.177'),
(3, 'standard', 1000, 10, '', 3, '2025-05-16 01:21:25.766', '2025-05-16 01:21:25.766'),
(4, 'normal', 4000, 20, '', 3, '2025-05-16 01:21:25.766', '2025-05-16 01:21:25.766'),
(5, 'Simple', 200, 20, 'cockteil simple buffet debout', 5, '2025-05-20 22:04:48.383', '2025-05-20 22:04:48.383'),
(6, 'Standard', 100, 12, 'cockteil simple buffet droit a une table', 5, '2025-05-20 22:04:48.661', '2025-05-20 22:04:48.661'),
(7, 'Simple', 100, 10, 'cockteil simple buffet debout', 6, '2025-05-20 22:46:23.255', '2025-05-20 22:46:23.255'),
(8, 'Simple', 300, 100, 'cockteil simple buffet debout', 7, '2025-05-21 00:57:13.724', '2025-05-21 00:57:13.724'),
(9, 'Standard', 500, 50, 'cockteil simple buffet droit a une table', 7, '2025-05-21 00:57:13.983', '2025-05-21 00:57:13.983'),
(10, 'Simple', 2000, 300, 'ok', 8, '2025-05-21 06:25:41.635', '2025-05-21 06:25:41.635'),
(11, 'Simple', 1200, 62, 'ok', 9, '2025-05-21 06:41:00.924', '2025-05-21 06:41:00.924'),
(12, 'Simple', 1200, 27, 'cockteil simple buffet debout', 12, '2025-05-21 14:48:21.487', '2025-05-21 14:48:21.487'),
(13, 'Simple', 15000, 30, 'bon', 4, '2025-05-21 15:05:05.902', '2025-05-21 15:05:05.902'),
(14, 'gbandzo', 1800, 20, 'cool', 11, '2025-05-21 15:05:54.940', '2025-05-21 15:05:54.940'),
(15, 'Zondo mina', 200, 35, 'cockteil simple buffet debout', 13, '2025-05-21 15:09:39.700', '2025-05-21 15:09:39.700'),
(16, 'Simple', 800, 1300, 'lop', 10, '2025-05-21 15:25:14.181', '2025-05-21 15:25:14.181'),
(17, 'Vip', 2000, 120, 'kolk', 1, '2025-05-21 15:30:56.972', '2025-05-21 15:30:56.972'),
(18, 'Simple', 200, 120, 'ok', 1, '2025-05-21 15:41:09.592', '2025-05-21 15:41:09.592'),
(19, 'Simple', 200, 120, 'ok', 1, '2025-05-21 15:41:15.337', '2025-05-21 15:41:15.337'),
(20, 'Simple', 200, 120, 'ok', 1, '2025-05-21 15:41:22.150', '2025-05-21 15:41:22.150'),
(21, 'Simple', 200, 120, 'ok', 1, '2025-05-21 15:41:26.390', '2025-05-21 15:41:26.390'),
(22, 'Vip', 8000, 20, 'ok', 4, '2025-05-21 15:56:25.948', '2025-05-21 15:56:25.948'),
(23, 'Standard', 900, 12, 'kolman', 4, '2025-05-21 15:59:46.347', '2025-05-21 15:59:46.347'),
(24, 'gbandzo', 1200, 30, 'ok', 4, '2025-05-21 16:33:39.550', '2025-05-21 16:33:39.550'),
(25, 'Standard', 1200, 100, 'Oklm', 14, '2025-05-22 11:20:26.126', '2025-05-22 11:20:26.126');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(191) NOT NULL,
  `password` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `first_name` varchar(191) NOT NULL,
  `last_name` varchar(191) NOT NULL,
  `phone` varchar(191) DEFAULT NULL,
  `status` varchar(191) NOT NULL DEFAULT 'ACTIVE',
  `role` varchar(191) NOT NULL DEFAULT 'USER',
  `created_at` datetime(3) NOT NULL DEFAULT current_timestamp(3),
  `updated_at` datetime(3) NOT NULL DEFAULT current_timestamp(3)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `first_name`, `last_name`, `phone`, `status`, `role`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$2a$10$kWmmZu5KLdPro1nok2MaVu8OIUz3ponD3KrtrHsX/y20yBze1y2xO', 'admin@kapelo.com', 'Administrateur', 'System', NULL, 'ACTIVE', 'ADMIN', '2025-05-16 00:14:32.000', '2025-05-16 00:14:32.000'),
(2, 'DANSOU', '$2a$10$kWmmZu5KLdPro1nok2MaVu8OIUz3ponD3KrtrHsX/y20yBze1y2xO', 'landry@gmail.com', 'landry', 'DANSOU', NULL, 'ACTIVE', 'USER', '2025-05-16 01:32:31.411', '2025-05-16 01:32:31.411'),
(3, 'dave', '$2a$10$AnCyJ43AwCzNzITxp1z7vu1sTcWjAT1feHSIfebTZg55RPyu0WCO6', 'dave@gmail.com', 'dave', 'SITTI', '90234434', 'ACTIVE', 'AGENT', '2025-05-18 19:03:39.791', '2025-05-18 19:03:39.791'),
(4, 'admin12', '$2y$12$OouHhqrpLMni.DJHBF3hS.hpEj3brnoU5yjYfp/KBDiMfmHc8Ek1q', 'test@gmail.com', 'Jonathan', 'Sitti', '+22892948268', 'ACTIVE', 'ADMIN', '2025-05-20 15:31:14.000', '2025-05-20 15:31:14.000'),
(5, 'Kapelo228', '$2a$10$5ew2RqJ5F1e.lARw5nY3oO48zTcQH/xt5uDaiiemEk/xHUJN9AZyO', 'sittijonathan99@gmail.com', 'Fabio', 'Kapelo', NULL, 'ACTIVE', 'USER', '2025-05-23 15:38:23.796', '2025-05-23 15:38:23.796');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ActivityLog`
--
ALTER TABLE `ActivityLog`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ActivityLog_userId_fkey` (`userId`);

--
-- Indexes for table `AgentEvent`
--
ALTER TABLE `AgentEvent`
  ADD PRIMARY KEY (`agentId`,`eventId`),
  ADD KEY `AgentEvent_eventId_fkey` (`eventId`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_name_key` (`name`),
  ADD UNIQUE KEY `categories_slug_key` (`slug`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `events_category_id_fkey` (`category_id`);

--
-- Indexes for table `mobile_money_transactions`
--
ALTER TABLE `mobile_money_transactions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mobile_money_transactions_transactionReference_key` (`transactionReference`);

--
-- Indexes for table `promo_codes`
--
ALTER TABLE `promo_codes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `promo_codes_code_eventId_unique` (`code`,`eventId`),
  ADD KEY `promo_codes_eventId_fkey` (`eventId`);

--
-- Indexes for table `promo_code_uses`
--
ALTER TABLE `promo_code_uses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `promo_code_uses_promoCodeId_fkey` (`promoCodeId`),
  ADD KEY `promo_code_uses_ticketId_fkey` (`ticketId`),
  ADD KEY `promo_code_uses_userId_fkey` (`userId`);

--
-- Indexes for table `Ticket`
--
ALTER TABLE `Ticket`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Ticket_code_key` (`code`),
  ADD KEY `Ticket_validatedById_fkey` (`validatedById`),
  ADD KEY `Ticket_userId_fkey` (`userId`),
  ADD KEY `Ticket_ticketTypeId_fkey` (`ticketTypeId`);

--
-- Indexes for table `TicketType`
--
ALTER TABLE `TicketType`
  ADD PRIMARY KEY (`id`),
  ADD KEY `TicketType_eventId_fkey` (`eventId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_key` (`email`),
  ADD UNIQUE KEY `users_username_key` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ActivityLog`
--
ALTER TABLE `ActivityLog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=333;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `mobile_money_transactions`
--
ALTER TABLE `mobile_money_transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `Ticket`
--
ALTER TABLE `Ticket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `TicketType`
--
ALTER TABLE `TicketType`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ActivityLog`
--
ALTER TABLE `ActivityLog`
  ADD CONSTRAINT `ActivityLog_userId_fkey` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `AgentEvent`
--
ALTER TABLE `AgentEvent`
  ADD CONSTRAINT `AgentEvent_agentId_fkey` FOREIGN KEY (`agentId`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `AgentEvent_eventId_fkey` FOREIGN KEY (`eventId`) REFERENCES `events` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_category_id_fkey` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `promo_codes`
--
ALTER TABLE `promo_codes`
  ADD CONSTRAINT `promo_codes_eventId_fkey` FOREIGN KEY (`eventId`) REFERENCES `events` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `promo_code_uses`
--
ALTER TABLE `promo_code_uses`
  ADD CONSTRAINT `promo_code_uses_promoCodeId_fkey` FOREIGN KEY (`promoCodeId`) REFERENCES `promo_codes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `promo_code_uses_ticketId_fkey` FOREIGN KEY (`ticketId`) REFERENCES `Ticket` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `promo_code_uses_userId_fkey` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Ticket`
--
ALTER TABLE `Ticket`
  ADD CONSTRAINT `Ticket_ticketTypeId_fkey` FOREIGN KEY (`ticketTypeId`) REFERENCES `TicketType` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `Ticket_userId_fkey` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `Ticket_validatedById_fkey` FOREIGN KEY (`validatedById`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `TicketType`
--
ALTER TABLE `TicketType`
  ADD CONSTRAINT `TicketType_eventId_fkey` FOREIGN KEY (`eventId`) REFERENCES `events` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
