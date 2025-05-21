-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: mysql-kapelo.alwaysdata.net
-- Generation Time: May 21, 2025 at 01:30 PM
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
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ActivityLog`
--

INSERT INTO `ActivityLog` (`id`, `userId`, `action`, `entityType`, `entityId`, `details`, `ipAddress`, `subject_type`, `subject_id`, `description`, `properties`, `created_at`, `updated_at`) VALUES
(1, 1, 'LOGIN', 'USER', 1, 'Connexion utilisateur', '::1', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55', '2025-05-21 04:09:55'),
(2, 1, 'LOGIN', 'USER', 1, 'Connexion utilisateur', '::1', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55', '2025-05-21 04:09:55'),
(3, 1, 'LOGIN', 'USER', 1, 'Connexion utilisateur', '::1', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55', '2025-05-21 04:09:55'),
(4, 1, 'LOGIN', 'USER', 1, 'Connexion utilisateur', '::1', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55', '2025-05-21 04:09:55'),
(5, 1, 'LOGIN', 'USER', 1, 'Connexion utilisateur', '::1', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55', '2025-05-21 04:09:55'),
(6, 1, 'LOGIN', 'USER', 1, 'Connexion utilisateur', '::1', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55', '2025-05-21 04:09:55'),
(7, 1, 'LOGIN', 'USER', 1, 'Connexion utilisateur', '::1', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55', '2025-05-21 04:09:55'),
(8, 1, 'LOGIN', 'USER', 1, 'Connexion utilisateur', '::1', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55', '2025-05-21 04:09:55'),
(9, 1, 'LOGIN', 'USER', 1, 'Connexion utilisateur', '::1', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55', '2025-05-21 04:09:55'),
(10, 1, 'LOGIN', 'USER', 1, 'Connexion utilisateur', '::1', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55', '2025-05-21 04:09:55'),
(11, 1, 'LOGIN', 'USER', 1, 'Connexion utilisateur', '::1', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55', '2025-05-21 04:09:55'),
(12, 1, 'LOGIN', 'USER', 1, 'Connexion utilisateur', '::1', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55', '2025-05-21 04:09:55'),
(13, 1, 'CREATE', 'EVENT', 1, 'Création de l\'événement: happy run', '::1', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55', '2025-05-21 04:09:55'),
(14, 1, 'CREATE', 'EVENT', 2, 'Création de l\'événement: kop', '::1', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55', '2025-05-21 04:09:55'),
(15, 1, 'CREATE', 'EVENT', 3, 'Création de l\'événement: mood', '::1', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55', '2025-05-21 04:09:55'),
(16, 2, 'REGISTER', 'USER', 2, 'Création du compte utilisateur', '::1', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55', '2025-05-21 04:09:55'),
(17, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '::1', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55', '2025-05-21 04:09:55'),
(18, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '::1', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55', '2025-05-21 04:09:55'),
(19, 1, 'LOGIN', 'USER', 1, 'Connexion utilisateur', '::1', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55', '2025-05-21 04:09:55'),
(20, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '::1', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55', '2025-05-21 04:09:55'),
(21, 1, 'LOGIN', 'USER', 1, 'Connexion utilisateur', '::1', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55', '2025-05-21 04:09:55'),
(22, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '::1', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55', '2025-05-21 04:09:55'),
(23, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '::1', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55', '2025-05-21 04:09:55'),
(24, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '::1', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55', '2025-05-21 04:09:55'),
(25, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '::1', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55', '2025-05-21 04:09:55'),
(26, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '::1', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55', '2025-05-21 04:09:55'),
(27, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '::1', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55', '2025-05-21 04:09:55'),
(28, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '::1', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55', '2025-05-21 04:09:55'),
(29, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '::1', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55', '2025-05-21 04:09:55'),
(30, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '::1', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55', '2025-05-21 04:09:55'),
(31, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '::1', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55', '2025-05-21 04:09:55'),
(32, 1, 'LOGIN', 'USER', 1, 'Connexion utilisateur', '::1', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55', '2025-05-21 04:09:55'),
(33, 1, 'CREATE', 'AGENT', 3, 'Création de l\'agent: dave SITTI', '::1', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55', '2025-05-21 04:09:55'),
(34, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '::1', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55', '2025-05-21 04:09:55'),
(35, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '::1', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55', '2025-05-21 04:09:55'),
(36, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '::1', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55', '2025-05-21 04:09:55'),
(37, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '::1', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55', '2025-05-21 04:09:55'),
(38, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '::1', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55', '2025-05-21 04:09:55'),
(39, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '::1', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55', '2025-05-21 04:09:55'),
(40, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '127.0.0.1', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55', '2025-05-21 04:09:55'),
(41, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '192.168.0.137', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55', '2025-05-21 04:09:55'),
(42, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '192.168.0.137', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55', '2025-05-21 04:09:55'),
(43, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '192.168.0.137', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55', '2025-05-21 04:09:55'),
(44, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '192.168.0.137', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55', '2025-05-21 04:09:55'),
(45, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '192.168.0.137', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55', '2025-05-21 04:09:55'),
(46, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '192.168.0.137', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55', '2025-05-21 04:09:55'),
(47, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '192.168.0.137', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55', '2025-05-21 04:09:55'),
(48, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '192.168.0.137', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55', '2025-05-21 04:09:55'),
(49, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '192.168.0.137', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55', '2025-05-21 04:09:55'),
(50, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '192.168.0.137', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55', '2025-05-21 04:09:55'),
(51, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '192.168.0.137', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55', '2025-05-21 04:09:55'),
(52, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '192.168.0.137', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55', '2025-05-21 04:09:55'),
(53, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '192.168.0.137', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55', '2025-05-21 04:09:55'),
(54, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '192.168.0.137', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55', '2025-05-21 04:09:55'),
(55, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '127.0.0.1', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55', '2025-05-21 04:09:55'),
(56, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '127.0.0.1', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55', '2025-05-21 04:09:55'),
(57, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '127.0.0.1', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55', '2025-05-21 04:09:55'),
(58, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '127.0.0.1', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55', '2025-05-21 04:09:55'),
(59, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '127.0.0.1', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55', '2025-05-21 04:09:55'),
(60, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '127.0.0.1', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55', '2025-05-21 04:09:55'),
(61, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '127.0.0.1', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55', '2025-05-21 04:09:55'),
(62, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55', '2025-05-21 04:09:55'),
(63, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55', '2025-05-21 04:09:55'),
(64, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55', '2025-05-21 04:09:55'),
(65, 1, 'LOGIN', 'USER', 1, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55', '2025-05-21 04:09:55'),
(66, 1, 'LOGIN', 'USER', 1, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55', '2025-05-21 04:09:55'),
(67, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55', '2025-05-21 04:09:55'),
(68, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55', '2025-05-21 04:09:55'),
(69, 1, 'LOGIN', 'USER', 1, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55', '2025-05-21 04:09:55'),
(70, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55', '2025-05-21 04:09:55'),
(71, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55', '2025-05-21 04:09:55'),
(72, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55', '2025-05-21 04:09:55'),
(73, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55', '2025-05-21 04:09:55'),
(74, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55', '2025-05-21 04:09:55'),
(75, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55', '2025-05-21 04:09:55'),
(76, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55', '2025-05-21 04:09:55'),
(77, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55', '2025-05-21 04:09:55'),
(78, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55', '2025-05-21 04:09:55'),
(79, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55', '2025-05-21 04:09:55'),
(80, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55', '2025-05-21 04:09:55'),
(81, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55', '2025-05-21 04:09:55'),
(82, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55', '2025-05-21 04:09:55'),
(83, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55', '2025-05-21 04:09:55'),
(84, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55', '2025-05-21 04:09:55'),
(85, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55', '2025-05-21 04:09:55'),
(86, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55', '2025-05-21 04:09:55'),
(87, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55', '2025-05-21 04:09:55'),
(88, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55', '2025-05-21 04:09:55'),
(89, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55', '2025-05-21 04:09:55'),
(90, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55', '2025-05-21 04:09:55'),
(91, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55', '2025-05-21 04:09:55'),
(92, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55', '2025-05-21 04:09:55'),
(93, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55', '2025-05-21 04:09:55'),
(94, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55', '2025-05-21 04:09:55'),
(95, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55', '2025-05-21 04:09:55'),
(96, 3, 'VALIDATE', 'TICKET', 37, 'Validation du ticket: TKT-17474389218878-c6fm8o', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55', '2025-05-21 04:09:55'),
(97, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55', '2025-05-21 04:09:55'),
(98, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55', '2025-05-21 04:09:55'),
(99, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55', '2025-05-21 04:09:55'),
(100, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55', '2025-05-21 04:09:55'),
(101, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55', '2025-05-21 04:09:55'),
(102, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55', '2025-05-21 04:09:55'),
(103, 1, 'LOGIN', 'USER', 1, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55', '2025-05-21 04:09:55'),
(104, 1, 'LOGIN', 'USER', 1, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55', '2025-05-21 04:09:55'),
(105, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55', '2025-05-21 04:09:55'),
(106, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55', '2025-05-21 04:09:55'),
(107, 3, 'VALIDATE', 'TICKET', 37, 'Validation du ticket: TKT-17474389218878-c6fm8o', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55', '2025-05-21 04:09:55'),
(108, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55', '2025-05-21 04:09:55'),
(109, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55', '2025-05-21 04:09:55'),
(110, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55', '2025-05-21 04:09:55'),
(111, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55', '2025-05-21 04:09:55'),
(112, 3, 'LOGIN', 'USER', 3, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55', '2025-05-21 04:09:55'),
(113, 1, 'LOGIN', 'USER', 1, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55', '2025-05-21 04:09:55'),
(114, 1, 'LOGIN', 'USER', 1, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55', '2025-05-21 04:09:55'),
(115, 1, 'LOGIN', 'USER', 1, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55', '2025-05-21 04:09:55'),
(116, 4, 'REGISTER', 'USER', 4, 'Création du compte utilisateur', '127.0.0.1', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55', '2025-05-21 04:09:55'),
(117, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55', '2025-05-21 04:09:55'),
(118, 4, 'LOGIN', 'USER', 4, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55', '2025-05-21 04:09:55'),
(119, 2, 'LOGIN', 'USER', 2, 'Connexion utilisateur', '196.170.49.11', NULL, NULL, NULL, NULL, '2025-05-21 04:09:55', '2025-05-21 04:09:55'),
(120, 4, 'create_ticket_type', 'App\\Models\\TicketType', 11, '{\"quantity\":\"50\"}', '127.0.0.1', NULL, NULL, NULL, NULL, '2025-05-21 04:41:01', '2025-05-21 04:41:01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ActivityLog`
--
ALTER TABLE `ActivityLog`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ActivityLog_userId_fkey` (`userId`),
  ADD KEY `idx_activity_log_subject` (`subject_type`,`subject_id`),
  ADD KEY `idx_activity_log_description` (`description`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ActivityLog`
--
ALTER TABLE `ActivityLog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ActivityLog`
--
ALTER TABLE `ActivityLog`
  ADD CONSTRAINT `ActivityLog_userId_fkey` FOREIGN KEY (`userId`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
