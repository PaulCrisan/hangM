-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 23, 2018 at 01:10 PM
-- Server version: 10.1.33-MariaDB
-- PHP Version: 7.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hangmanphp`
--

-- --------------------------------------------------------

--
-- Table structure for table `functions`
--

CREATE TABLE `functions` (
  `id_` int(50) NOT NULL,
  `function_list_short` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `functions`
--

INSERT INTO `functions` (`id_`, `function_list_short`) VALUES
(1, 'array'),
(2, 'isset'),
(3, 'define'),
(4, 'empty'),
(5, 'assert'),
(6, 'file'),
(7, 'end'),
(8, 'count'),
(9, 'date'),
(10, 'ord'),
(11, 'print'),
(12, 'substr'),
(13, 'dir'),
(14, 'pos'),
(15, 'time'),
(16, 'exp'),
(17, 'key'),
(18, 'list'),
(19, 'log'),
(20, 'com'),
(21, 'each'),
(22, 'header'),
(23, 'is_a'),
(24, 'chr'),
(25, 'defined'),
(26, 'unset'),
(27, 'dl'),
(28, 'is_array'),
(29, 'strlen'),
(30, 'tan'),
(31, 'link'),
(32, 'str_replace'),
(33, 'printf'),
(34, 'in_array'),
(35, 'trim'),
(36, 'die'),
(37, 'sprintf'),
(38, 'strpos'),
(39, 'preg_match'),
(40, 'pi'),
(41, 'delete'),
(42, 'explode'),
(43, 'min'),
(44, 'implode'),
(45, 'strtolower'),
(46, 'preg_replace'),
(47, 'exec'),
(48, 'intval'),
(49, 'file_exists'),
(50, 'dirname'),
(51, 'htmlspecialchars'),
(52, 'stat'),
(53, 'sin'),
(54, 'current'),
(55, 'mail'),
(56, 'is_null'),
(57, 'array_merge'),
(58, 'trigger_error'),
(59, 'pack'),
(60, 'eval'),
(61, 'function_exists'),
(62, 'strtoupper'),
(63, 'sizeof'),
(64, 'array_keys'),
(65, 'is_object'),
(66, 'idate'),
(67, 'serialize'),
(68, 'sort'),
(69, 'reset'),
(70, 'array_key_exists'),
(71, 'is_numeric'),
(72, 'abs'),
(73, 'exit'),
(74, 'extract'),
(75, 'is_string'),
(76, 'next'),
(77, 'max'),
(78, 'rand'),
(79, 'main'),
(80, 'settype'),
(81, 'fclose'),
(82, 'round'),
(83, 'fopen'),
(84, 'is_dir'),
(85, 'getopt'),
(86, 'addslashes'),
(87, 'urlencode'),
(88, 'fread'),
(89, 'md5'),
(90, 'unlink'),
(91, 'fwrite'),
(92, 'copy'),
(93, 'get_class'),
(94, 'hash'),
(95, 'split'),
(96, 'array_shift'),
(97, 'class_exists'),
(98, 'call_user_func'),
(99, 'basename'),
(100, 'array_push'),
(101, 'prev'),
(102, 'glob'),
(103, 'array_pop'),
(104, 'strstr'),
(105, 'gettext'),
(106, 'gettype'),
(107, 'is_file'),
(108, 'mktime'),
(109, 'join'),
(110, 'stripslashes'),
(111, 'floor'),
(112, 'ini_get'),
(113, 'ob_start'),
(114, 'flush'),
(115, 'unserialize'),
(116, 'array_values'),
(117, 'file_get_contents'),
(118, 'preg_match_all'),
(119, 'constant'),
(120, 'gmdate'),
(121, 'chmod'),
(122, 'array_map'),
(123, 'strrpos'),
(124, 'print_r'),
(125, 'strtotime'),
(126, 'method_exists'),
(127, 'is_readable'),
(128, 'filesize'),
(129, 'microtime'),
(130, 'array_unique'),
(131, 'system'),
(132, 'is_int'),
(133, 'mysql_query'),
(134, 'str_repeat'),
(135, 'func_get_arg'),
(136, 'strip_tags'),
(137, 'call_user_func_array'),
(138, 'ini_set'),
(139, 'array_slice'),
(140, 'range'),
(141, 'fputs'),
(142, 'preg_quote'),
(143, 'getdate'),
(144, 'mkdir'),
(145, 'func_get_args'),
(146, 'ucfirst'),
(147, 'xml_parse'),
(148, 'rename'),
(149, 'strtr'),
(150, 'preg_split'),
(151, 'mt_rand'),
(152, 'ceil'),
(153, 'version_compare'),
(154, 'array_diff'),
(155, 'rtrim'),
(156, 'curl_setopt'),
(157, 'ob_end_clean'),
(158, 'strftime'),
(159, 'is_writable'),
(160, 'base64_encode'),
(161, 'urldecode'),
(162, 'extension_loaded'),
(163, 'ksort'),
(164, 'stristr'),
(165, 'error_log'),
(166, 'realpath'),
(167, 'array_search'),
(168, 'crypt'),
(169, 'substr_count'),
(170, 'is_bool'),
(171, 'configuration'),
(172, 'ftell'),
(173, 'readdir'),
(174, 'var_export'),
(175, 'cos'),
(176, 'usage'),
(177, 'htmlentities'),
(178, 'preg_replace_callback'),
(179, 'feof'),
(180, 'error_reporting'),
(181, 'pow'),
(182, 'setcookie'),
(183, 'array_reverse'),
(184, 'ob_get_contents'),
(185, 'get_object_vars'),
(186, 'opendir'),
(187, 'number_format'),
(188, 'stripos'),
(189, 'fgets'),
(190, 'hexdec'),
(191, 'getenv'),
(192, 'parse_url'),
(193, 'is_resource'),
(194, 'compact'),
(195, 'strcmp'),
(196, 'filemtime'),
(197, 'sha1'),
(198, 'array_unshift'),
(199, 'get_current_user'),
(200, 'strrchr');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_` int(11) NOT NULL,
  `user` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_`, `user`, `password`, `level`) VALUES
(124, 'paul', 'e827e957d413864dd8563c4ab9ece694', 1);

-- --------------------------------------------------------

--
-- Table structure for table `usrscore`
--

CREATE TABLE `usrscore` (
  `id_` int(50) NOT NULL,
  `user` varchar(50) NOT NULL,
  `score` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usrscore`
--

INSERT INTO `usrscore` (`id_`, `user`, `score`) VALUES
(115, 'paul', 92),
(116, 'paul', 93),
(117, 'paul', 82),
(118, 'paul', 42);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `functions`
--
ALTER TABLE `functions`
  ADD PRIMARY KEY (`id_`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_`);

--
-- Indexes for table `usrscore`
--
ALTER TABLE `usrscore`
  ADD PRIMARY KEY (`id_`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `functions`
--
ALTER TABLE `functions`
  MODIFY `id_` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=201;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;

--
-- AUTO_INCREMENT for table `usrscore`
--
ALTER TABLE `usrscore`
  MODIFY `id_` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
