-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 19, 2018 at 12:54 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `samuelapi`
--

--
-- Dumping data for table `parameters`
--

INSERT INTO `parameters` (`id`, `param`, `data_type`, `description`, `required`, `created_at`, `updated_at`) VALUES
(1, 'text', 'string', 'The collection of text data.', 1, NULL, NULL),
(2, 'translate_from', 'string', 'Translate data from specific language.', 0, NULL, NULL),
(3, 'translate_to', 'string', 'Translate data to specific language', 0, NULL, NULL),
(4, 'threshold_classifier\r\n', 'float', 'N/A', 0, NULL, NULL),
(5, 'visualize', 'boolean', 'Determines if the samuel will return the dashboard.', 0, NULL, NULL),
(6, 'dashboard_style', 'boolean', 'Determines if the samuel will return the dashboard with style.', 0, NULL, NULL),
(7, 'summary_length', 'integer', 'The number of sentences needed in the summary.', 1, NULL, NULL),
(8, 'sort_by_score', 'boolean', 'Determines if the sentences should be sorted by appearance or score.', 0, NULL, NULL),
(9, 'query', 'string', 'The subject where the summarizer would be referenced to.', 0, NULL, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
