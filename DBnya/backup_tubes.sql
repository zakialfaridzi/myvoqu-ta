-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 02, 2021 at 08:41 AM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 7.0.4
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */
;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */
;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */
;
/*!40101 SET NAMES utf8mb4 */
;
--
-- Database: `1112312_backup_tubes`
--
-- --------------------------------------------------------
--
-- Table structure for table `backup_comment`
--
CREATE TABLE `backup_comment` (
	`id_comment` int(11) NOT NULL,
	`comment` varchar(100) NOT NULL,
	`date` varchar(50) NOT NULL,
	`id_posting` int(11) NOT NULL,
	`id` int(11) NOT NULL,
	`id_tujuan` int(11) NOT NULL,
	`tanggal_backup` varchar(50) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = latin1;
-- --------------------------------------------------------
--
-- Table structure for table `backup_comment_delete`
--
CREATE TABLE `backup_comment_delete` (
	`comment` varchar(200) NOT NULL,
	`date` varchar(50) NOT NULL,
	`id_posting` int(11) NOT NULL,
	`id_user` int(11) NOT NULL,
	`aksi` varchar(20) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = latin1;
--
-- Dumping data for table `backup_comment_delete`
--
INSERT INTO `backup_comment_delete` (
		`comment`,
		`date`,
		`id_posting`,
		`id_user`,
		`aksi`
	)
VALUES ('ulala', '2020-04-10 06:24:15', 278, 48, '0'),
	(
		'mantap mi :-)',
		'2020-04-10 06:24:50',
		279,
		44,
		'Delete Comm'
	),
	(
		' :-) keren',
		'2020-04-10 08:58:28',
		280,
		46,
		'Delete Comment'
	),
	(
		'hi',
		'2020-04-12 02:21:32',
		277,
		44,
		'Delete Comment'
	),
	(
		' :-) keren',
		'2020-04-12 02:21:32',
		278,
		44,
		'Delete Comment'
	),
	(
		'keren fanny',
		'2020-04-12 02:21:32',
		278,
		46,
		'Delete Comment'
	),
	(
		'mantap',
		'2020-04-12 02:21:32',
		278,
		44,
		'Delete Comment'
	),
	(
		' :-)',
		'2020-04-12 02:21:32',
		281,
		46,
		'Delete Comment'
	),
	(
		'Mantap ',
		'2020-04-13 16:15:15',
		197,
		81,
		'Delete Comment'
	),
	(
		' :-)',
		'2020-04-21 10:28:43',
		236,
		92,
		'Delete Comment'
	),
	(
		'',
		'2020-04-21 23:55:25',
		236,
		92,
		'Delete Comment'
	),
	(
		'2',
		'2020-04-22 00:14:43',
		236,
		92,
		'Delete Comment'
	),
	(
		'1',
		'2020-04-22 00:14:45',
		236,
		92,
		'Delete Comment'
	),
	(
		'&lt;h1&gt;hai',
		'2020-04-22 00:14:46',
		236,
		92,
		'Delete Comment'
	),
	(
		'1',
		'2020-04-22 00:14:47',
		236,
		92,
		'Delete Comment'
	),
	(
		'123456789012345678901234567890123456789012345678901234567890',
		'2020-04-22 00:14:50',
		236,
		92,
		'Delete Comment'
	),
	(
		'12345678901234567890123456789012345678900987654321',
		'2020-04-22 00:14:53',
		236,
		92,
		'Delete Comment'
	),
	(
		'',
		'2020-04-22 00:14:55',
		236,
		92,
		'Delete Comment'
	),
	(
		'test 123',
		'2020-04-22 00:14:57',
		236,
		92,
		'Delete Comment'
	),
	(
		'komennya kepanjangan kayanya ya',
		'2020-04-22 00:14:59',
		236,
		92,
		'Delete Comment'
	),
	(
		'',
		'2020-04-22 00:35:01',
		236,
		92,
		'Delete Comment'
	),
	(
		'123456789009876543212345678909876543212345678909876543212345678909876543234567',
		'2020-04-22 00:38:52',
		236,
		92,
		'Delete Comment'
	),
	(
		'12345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890',
		'2020-04-22 00:38:55',
		236,
		92,
		'Delete Comment'
	),
	(
		'12345678912345678901234567892345678923456783456789',
		'2020-04-22 00:40:19',
		236,
		92,
		'Delete Comment'
	),
	(
		' :-)',
		'2020-04-22 02:12:27',
		284,
		53,
		'Delete Comment'
	),
	(
		' :-)',
		'2020-04-22 02:12:27',
		286,
		52,
		'Delete Comment'
	),
	(
		' :-)',
		'2020-04-22 02:12:27',
		285,
		52,
		'Delete Comment'
	),
	(
		' :-)',
		'2020-04-22 02:12:27',
		197,
		81,
		'Delete Comment'
	),
	(
		' :smirk:',
		'2020-04-22 02:12:27',
		197,
		81,
		'Delete Comment'
	),
	(
		' %-P',
		'2020-04-22 02:12:27',
		197,
		81,
		'Delete Comment'
	),
	(
		'weew',
		'2020-04-22 02:12:27',
		123,
		123,
		'Delete Comment'
	),
	(
		' :wow:',
		'2020-04-22 02:12:27',
		197,
		80,
		'Delete Comment'
	),
	(
		' :lol:',
		'2020-04-22 02:12:27',
		197,
		81,
		'Delete Comment'
	),
	(
		'MABAR',
		'2020-04-22 02:12:27',
		198,
		74,
		'Delete Comment'
	),
	(
		' :-)',
		'2020-04-22 02:12:27',
		224,
		86,
		'Delete Comment'
	),
	(
		' :-)',
		'2020-04-22 02:12:27',
		236,
		92,
		'Delete Comment'
	),
	(
		'&lt;h1&gt; hai',
		'2020-04-22 02:12:27',
		236,
		92,
		'Delete Comment'
	),
	(
		' :-) :-)',
		'2020-04-22 02:12:27',
		236,
		91,
		'Delete Comment'
	),
	(
		' :lol: :lol: :lol: :lol:',
		'2020-04-22 02:12:27',
		236,
		91,
		'Delete Comment'
	),
	(
		' 8-/ 8-/ 8-/ 8-/ 8-/ 8-/ 8-/ 8-/',
		'2020-04-22 02:12:27',
		236,
		91,
		'Delete Comment'
	),
	(
		'Keren Sekali :)',
		'2020-04-22 02:12:27',
		236,
		91,
		'Delete Comment'
	),
	(
		' :-)',
		'2020-04-23 04:20:04',
		234,
		90,
		'Delete Comment'
	);
-- --------------------------------------------------------
--
-- Table structure for table `backup_pesan`
--
CREATE TABLE `backup_pesan` (
	`id_pesan` int(11) NOT NULL,
	`id_pengirim` int(11) NOT NULL,
	`id_penerima` int(11) NOT NULL,
	`pesan` varchar(200) NOT NULL,
	`date` varchar(20) NOT NULL,
	`sudah_dibaca` varchar(10) NOT NULL,
	`image` varchar(20) NOT NULL,
	`tanggal_backup` varchar(30) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = latin1;
--
-- Dumping data for table `backup_pesan`
--
INSERT INTO `backup_pesan` (
		`id_pesan`,
		`id_pengirim`,
		`id_penerima`,
		`pesan`,
		`date`,
		`sudah_dibaca`,
		`image`,
		`tanggal_backup`
	)
VALUES (
		51,
		81,
		80,
		' :-)',
		'1586758882',
		'belum',
		'',
		'2020-04-14 03:08:30'
	),
	(
		51,
		81,
		80,
		' :-)',
		'1586758882',
		'belum',
		'',
		'2020-04-14 10:08:30'
	);
-- --------------------------------------------------------
--
-- Table structure for table `backup_pesan_delete`
--
CREATE TABLE `backup_pesan_delete` (
	`id_pengirim` int(11) NOT NULL,
	`id_penerima` int(11) NOT NULL,
	`pesan` varchar(200) NOT NULL,
	`date` varchar(20) NOT NULL,
	`tanggal_backup` varchar(30) NOT NULL,
	`aksi` varchar(20) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = latin1;
--
-- Dumping data for table `backup_pesan_delete`
--
INSERT INTO `backup_pesan_delete` (
		`id_pengirim`,
		`id_penerima`,
		`pesan`,
		`date`,
		`tanggal_backup`,
		`aksi`
	)
VALUES (
		44,
		41,
		'haii',
		'1586238992',
		'2020-04-10 08:19:28',
		'Delete Pesan'
	),
	(
		45,
		46,
		'hallo rahmat :-)',
		'1586483937',
		'2020-04-10 08:59:23',
		'Delete Pesan'
	),
	(
		46,
		48,
		'Hi Fydhia',
		'1586243686',
		'2020-04-12 02:22:18',
		'Delete Pesan'
	),
	(
		83,
		81,
		' :-)',
		'1586754042',
		'2020-04-13 12:39:42',
		'Delete Pesan'
	),
	(
		52,
		53,
		' :-)',
		'1586639914',
		'2020-04-13 12:40:12',
		'Delete Pesan'
	),
	(
		78,
		49,
		'hi ersa aku zaki suka kamu',
		'1586685677',
		'2020-04-13 12:40:12',
		'Delete Pesan'
	),
	(
		49,
		78,
		'anjayy',
		'1586685728',
		'2020-04-13 12:40:12',
		'Delete Pesan'
	),
	(
		49,
		78,
		'aku dah punya bopip',
		'1586685741',
		'2020-04-13 12:40:12',
		'Delete Pesan'
	),
	(
		81,
		83,
		' :-)',
		'1586757117',
		'2020-04-13 13:12:45',
		'Delete Pesan'
	),
	(
		81,
		81,
		' :-)',
		'1586758646',
		'2020-04-13 13:22:00',
		'Delete Pesan'
	),
	(
		52,
		53,
		' :-)',
		'1586639914',
		'2020-04-22 01:31:38',
		'Delete Pesan'
	),
	(
		78,
		49,
		'hi ersa aku zaki suka kamu',
		'1586685677',
		'2020-04-22 01:31:38',
		'Delete Pesan'
	),
	(
		49,
		78,
		'anjayy',
		'1586685728',
		'2020-04-22 01:31:38',
		'Delete Pesan'
	),
	(
		49,
		78,
		'aku dah punya bopip',
		'1586685741',
		'2020-04-22 01:31:38',
		'Delete Pesan'
	),
	(
		87,
		86,
		'hai',
		'1586800007',
		'2020-04-22 01:31:38',
		'Delete Pesan'
	),
	(
		87,
		86,
		'kamu tau gak cowo ber 4 yang suka negliatin',
		'1586800024',
		'2020-04-22 01:31:38',
		'Delete Pesan'
	),
	(
		86,
		87,
		'tauuu',
		'1586800214',
		'2020-04-22 01:31:38',
		'Delete Pesan'
	),
	(
		86,
		87,
		'hai',
		'1586802030',
		'2020-04-22 01:31:38',
		'Delete Pesan'
	),
	(
		92,
		91,
		'haii  :-)',
		'1587439805',
		'2020-04-22 01:31:39',
		'Delete Pesan'
	),
	(
		91,
		92,
		'hai juga',
		'1587439818',
		'2020-04-22 01:31:39',
		'Delete Pesan'
	),
	(
		92,
		89,
		' :-)',
		'1587439841',
		'2020-04-22 01:31:39',
		'Delete Pesan'
	),
	(
		91,
		92,
		'12345678912345678912345678912345678912345678900000',
		'1587490950',
		'2020-04-22 01:31:39',
		'Delete Pesan'
	),
	(
		91,
		92,
		'1234567891234567891234567891234567891234567890000012345678912345678912345678912345678912345678900000',
		'1587490955',
		'2020-04-22 01:31:39',
		'Delete Pesan'
	),
	(
		91,
		92,
		'1234567891234567891234567891234567891234567890000012345678901234567890',
		'1587490980',
		'2020-04-22 01:31:39',
		'Delete Pesan'
	),
	(
		91,
		92,
		'',
		'1587491210',
		'2020-04-22 01:31:39',
		'Delete Pesan'
	),
	(
		91,
		92,
		' :-)',
		'1587491440',
		'2020-04-22 01:31:39',
		'Delete Pesan'
	),
	(
		91,
		92,
		'<h1> mantap',
		'1587491449',
		'2020-04-22 01:31:39',
		'Delete Pesan'
	),
	(
		91,
		92,
		'&lt;h1&gt; mantap',
		'1587491491',
		'2020-04-22 01:31:39',
		'Delete Pesan'
	);
-- --------------------------------------------------------
--
-- Table structure for table `backup_suka`
--
CREATE TABLE `backup_suka` (
	`id_suka` int(11) NOT NULL,
	`status` int(11) NOT NULL,
	`date` varchar(20) NOT NULL,
	`id_posting` int(11) NOT NULL,
	`id` int(11) NOT NULL,
	`id_tujuan` int(11) NOT NULL,
	`tanggal_backup` varchar(30) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = latin1;
--
-- Dumping data for table `backup_suka`
--
INSERT INTO `backup_suka` (
		`id_suka`,
		`status`,
		`date`,
		`id_posting`,
		`id`,
		`id_tujuan`,
		`tanggal_backup`
	)
VALUES (145, 2, '', 284, 52, 52, '2020-04-14 10:08:30'),
	(145, 2, '', 284, 52, 52, '2020-04-14 03:08:30'),
	(
		146,
		2,
		'1586633191',
		284,
		53,
		52,
		'2020-04-14 10:08:30'
	),
	(
		146,
		2,
		'1586633191',
		284,
		53,
		52,
		'2020-04-14 03:08:30'
	),
	(147, 2, '', 285, 53, 53, '2020-04-14 10:08:30'),
	(147, 2, '', 285, 53, 53, '2020-04-14 03:08:30'),
	(
		148,
		2,
		'1586636152',
		286,
		52,
		52,
		'2020-04-14 10:08:30'
	),
	(
		148,
		2,
		'1586636152',
		286,
		52,
		52,
		'2020-04-14 03:08:30'
	),
	(
		149,
		1,
		'1586636222',
		285,
		52,
		53,
		'2020-04-14 10:08:30'
	),
	(
		149,
		1,
		'1586636222',
		285,
		52,
		53,
		'2020-04-14 03:08:30'
	),
	(
		150,
		1,
		'1586636273',
		286,
		53,
		52,
		'2020-04-14 03:08:30'
	),
	(
		150,
		1,
		'1586636273',
		286,
		53,
		52,
		'2020-04-14 10:08:30'
	),
	(151, 2, '', 195, 78, 0, '2020-04-14 03:08:30'),
	(
		152,
		2,
		'1586685413',
		196,
		78,
		0,
		'2020-04-14 03:08:30'
	),
	(151, 2, '', 195, 78, 0, '2020-04-14 10:08:30'),
	(153, 2, '', 197, 80, 0, '2020-04-14 03:08:30'),
	(
		152,
		2,
		'1586685413',
		196,
		78,
		0,
		'2020-04-14 10:08:30'
	),
	(
		154,
		2,
		'1586770216',
		197,
		81,
		80,
		'2020-04-14 03:08:30'
	),
	(153, 2, '', 197, 80, 0, '2020-04-14 10:08:30'),
	(155, 2, '', 198, 81, 0, '2020-04-14 03:08:30'),
	(156, 2, '', 199, 81, 0, '2020-04-14 03:08:30'),
	(
		154,
		2,
		'1586770216',
		197,
		81,
		80,
		'2020-04-14 10:08:30'
	),
	(157, 2, '', 200, 81, 0, '2020-04-14 03:08:30'),
	(155, 2, '', 198, 81, 0, '2020-04-14 10:08:30'),
	(158, 2, '', 201, 81, 0, '2020-04-14 03:08:30'),
	(156, 2, '', 199, 81, 0, '2020-04-14 10:08:30'),
	(159, 2, '', 202, 80, 0, '2020-04-14 03:08:30'),
	(157, 2, '', 200, 81, 0, '2020-04-14 10:08:30'),
	(160, 2, '', 203, 81, 0, '2020-04-14 03:08:30'),
	(158, 2, '', 201, 81, 0, '2020-04-14 10:08:30'),
	(161, 2, '', 204, 81, 0, '2020-04-14 03:08:30'),
	(159, 2, '', 202, 80, 0, '2020-04-14 10:08:30'),
	(162, 2, '', 205, 81, 0, '2020-04-14 03:08:30'),
	(160, 2, '', 203, 81, 0, '2020-04-14 10:08:30'),
	(163, 2, '', 206, 80, 0, '2020-04-14 03:08:30'),
	(161, 2, '', 204, 81, 0, '2020-04-14 10:08:30'),
	(164, 2, '', 207, 80, 0, '2020-04-14 03:08:30'),
	(162, 2, '', 205, 81, 0, '2020-04-14 10:08:30'),
	(163, 2, '', 206, 80, 0, '2020-04-14 10:08:30'),
	(164, 2, '', 207, 80, 0, '2020-04-14 10:08:30');
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */
;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */
;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */
;
