-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 02, 2021 at 11:14 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.4
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
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
-- Database: `myvoqu_fixed`
--
DELIMITER $$ --
-- Procedures
--
CREATE DEFINER = `root` @`localhost` PROCEDURE `backup_pesan_comment_like` () BEGIN TRUNCATE TABLE backup_tubes.backup_comment;
INSERT INTO backup_tubes.backup_comment(
		select id_comment,
			comment,
			date,
			id_posting,
			id,
			id_tujuan,
			now() tanggal_backup
		from tubes.comment
	);
TRUNCATE TABLE backup_tubes.backup_suka;
INSERT INTO backup_tubes.backup_suka(
		select id_suka,
			status,
			date,
			id_posting,
			id,
			id_tujuan,
			now() tanggal_backup
		from tubes.suka
	);
TRUNCATE TABLE backup_tubes.backup_pesan;
INSERT INTO backup_tubes.backup_pesan(
		select id_pesan,
			id_pengirim,
			id_penerima,
			pesan,
			date,
			sudah_dibaca,
			image,
			now() tanggal_backup
		from tubes.pesan
	);
END $$ CREATE DEFINER = `root` @`localhost` PROCEDURE `backup_semua_table` () begin truncate table backup_tbs.user_token;
INSERT INTO backup_tbs.user_token(id, backup_date, email, token, date_created) (
		SELECT id,
			now(),
			email,
			token,
			date_created
		FROM myvoqu_fixed.user_token
	);
truncate table backup_tbs.user_role;
INSERT INTO backup_tbs.user_role(id, backup_date, role) (
		SELECT id,
			now(),
			role
		FROM myvoqu_fixed.user_role
	);
truncate table backup_tbs.suka;
INSERT INTO backup_tbs.suka(
		id_suka,
		backup_date,
		status,
		date,
		id_posting,
		id,
		id_tujuan
	) (
		SELECT id_suka,
			now(),
			status,
			date,
			id_posting,
			id,
			id_tujuan
		FROM myvoqu_fixed.suka
	);
truncate table backup_tbs.report;
INSERT INTO backup_tbs.report(
		id_report,
		backup_date,
		report,
		date,
		id_posting,
		id_user
	) (
		SELECT id_report,
			now(),
			report,
			date,
			id_posting,
			id_user
		FROM myvoqu_fixed.report
	);
truncate table backup_tbs.posting;
INSERT INTO backup_tbs.posting(
		id_posting,
		backup_date,
		caption,
		id_user,
		name,
		fileName,
		html,
		date_post
	) (
		SELECT id_posting,
			now(),
			caption,
			id_user,
			name,
			fileName,
			html,
			date_post
		FROM myvoqu_fixed.posting
	);
truncate table backup_tbs.postgen;
INSERT INTO backup_tbs.postgen(
		id_posting,
		backup_date,
		caption,
		fileName,
		html,
		date_post,
		id_user
	) (
		SELECT id_posting,
			now(),
			caption,
			fileName,
			html,
			date_post,
			id_user
		FROM myvoqu_fixed.postgen
	);
truncate table backup_tbs.pesan;
INSERT INTO backup_tbs.pesan(
		id_pesan,
		backup_date,
		id_pengirim,
		id_penerima,
		pesan,
		date,
		sudah_dibaca,
		image
	) (
		SELECT id_pesan,
			now(),
			id_pengirim,
			id_penerima,
			pesan,
			date,
			sudah_dibaca,
			image
		FROM myvoqu_fixed.pesan
	);
truncate table backup_tbs.notification;
INSERT INTO backup_tbs.notification(
		id_notification,
		backup_date,
		notif,
		date,
		id_posting,
		id,
		id_tujuan
	) (
		SELECT id_notification,
			now(),
			notif,
			date,
			id_posting,
			id,
			id_tujuan
		FROM myvoqu_fixed.notification
	);
truncate table backup_tbs.menu_item;
INSERT INTO backup_tbs.menu_item(
		id_menu_item,
		backup_date,
		icon,
		name_menu_item,
		link,
		id_menu
	) (
		SELECT id_menu_item,
			now(),
			icon,
			name_menu_item,
			link,
			id_menu
		FROM myvoqu_fixed.menu_item
	);
truncate table backup_tbs.menu;
INSERT INTO backup_tbs.menu(id_menu, backup_date, title_menu) (
		SELECT id_menu,
			now(),
			title_menu
		FROM myvoqu_fixed.menu
	);
truncate table backup_tbs.materi;
INSERT INTO backup_tbs.materi(
		id,
		backup_date,
		nama,
		id_surat,
		id_user,
		nama_mentor,
		filename,
		html,
		date_post
	) (
		SELECT id,
			now(),
			nama,
			id_surat,
			id_user,
			nama_mentor,
			filename,
			html,
			date_post
		FROM myvoqu_fixed.materi
	);
truncate table backup_tbs.katmateri;
INSERT INTO backup_tbs.katmateri(id, backup_date, nama, arti, ayat, suratke) (
		SELECT id,
			now(),
			nama,
			arti,
			ayat,
			suratke
		FROM myvoqu_fixed.katmateri
	);
truncate table backup_tbs.hafalan;
INSERT INTO backup_tbs.hafalan(id, backup_date, judul, id_user, id_group) (
		SELECT id,
			now(),
			judul,
			id_user,
			id_group
		FROM myvoqu_fixed.hafalan
	);
truncate table backup_tbs.grup;
INSERT INTO backup_tbs.grup(id, backup_date, nama, deskripsi, image, owner) (
		SELECT id,
			now(),
			nama,
			deskripsi,
			image,
			owner
		FROM myvoqu_fixed.grup
	);
truncate table backup_tbs.group_postingan;
INSERT INTO backup_tbs.group_postingan(
		id_posting,
		backup_date,
		caption,
		id_group,
		id_user,
		filename,
		html,
		date_post
	) (
		SELECT id_posting,
			now(),
			caption,
			id_group,
			id_user,
			filename,
			html,
			date_post
		FROM myvoqu_fixed.group_postingan
	);
truncate table backup_tbs.group_notif;
INSERT INTO backup_tbs.group_notif(
		id_notif,
		backup_date,
		notif,
		id_group,
		id_user,
		date
	) (
		SELECT id_notif,
			now(),
			notif,
			id_group,
			id_user,
			date
		FROM myvoqu_fixed.group_notif
	);
truncate table backup_tbs.group_comment;
INSERT INTO backup_tbs.group_comment(
		id_comment,
		backup_date,
		comment,
		id_posting,
		date,
		id_user
	) (
		SELECT id_comment,
			now(),
			comment,
			id_posting,
			date,
			id_user
		FROM myvoqu_fixed.group_comment
	);
truncate table backup_tbs.group_information;
INSERT INTO backup_tbs.group_information(
		id,
		backup_date,
		info,
		id_group,
		id_user,
		date_post
	) (
		SELECT id,
			now(),
			info,
			id_group,
			id_user,
			date_post
		FROM myvoqu_fixed.group_information
	);
truncate table backup_tbs.follow;
INSERT INTO backup_tbs.follow(
		id_follow,
		backup_date,
		stat,
		date,
		id_userfollow,
		id_usertarget,
		namatarget,
		biotarget,
		imagetarget
	) (
		SELECT id_follow,
			now(),
			stat,
			date,
			id_userfollow,
			id_usertarget,
			namatarget,
			biotarget,
			imagetarget
		FROM myvoqu_fixed.follow
	);
truncate table backup_tbs.comment;
INSERT INTO backup_tbs.comment(
		id_comment,
		backup_date,
		comment,
		date,
		id_posting,
		id,
		id_tujuan
	) (
		SELECT id_comment,
			now(),
			comment,
			date,
			id_posting,
			id,
			id_tujuan
		FROM myvoqu_fixed.comment
	);
truncate table backup_tbs.anggota;
INSERT INTO backup_tbs.anggota(id_anggota, backup_date, id_user, id_group) (
		SELECT id_anggota,
			now(),
			id_user,
			id_group
		FROM myvoqu_fixed.anggota
	);
truncate table backup_tbs.user;
INSERT INTO backup_tbs.user(
		id,
		backup_date,
		name,
		gender,
		email,
		image,
		passsword,
		role_id,
		is_active,
		date_created,
		status,
		birthdate,
		city,
		bio,
		work,
		instansi,
		sertif,
		verified
	) (
		SELECT id,
			now(),
			name,
			gender,
			email,
			image,
			passsword,
			role_id,
			is_active,
			date_created,
			status,
			birthdate,
			city,
			bio,
			work,
			instansi,
			sertif,
			verified
		FROM myvoqu_fixed.user
	);
end $$ CREATE DEFINER = `root` @`localhost` PROCEDURE `chartinstansi` () begin
select instansi,
	count(instansi) as total
from user
where role_id = 3
	and verified = 1
group by instansi;
end $$ CREATE DEFINER = `root` @`localhost` PROCEDURE `chartpost` () begin
select user.name,
	count(*) as total
from posting
	join user on posting.id_user = user.id
group by id_user;
end $$ CREATE DEFINER = `root` @`localhost` PROCEDURE `chartroleid` () begin
select role_id,
	count(role_id) as total
from user
group by role_id;
end $$ CREATE DEFINER = `root` @`localhost` PROCEDURE `chartuser` () begin
select gender,
	count(*) as total
from user
where role_id = 2
group by gender;
end $$ CREATE DEFINER = `root` @`localhost` PROCEDURE `detailpost` (`id` INT) begin
select *,
	count(r.report) as cr
from posting p
	join user u on p.id_user = u.id
	join report r on r.id_posting = p.id_posting
where p.id_posting = id;
end $$ CREATE DEFINER = `root` @`localhost` PROCEDURE `profileAdmin` () begin
select *
from user
where role_id = 1;
end $$ CREATE DEFINER = `root` @`localhost` PROCEDURE `tampilgrup` () begin
select *
from grup;
end $$ CREATE DEFINER = `root` @`localhost` PROCEDURE `tampilmentor` () begin
select *
from user
where role_id = "3";
end $$ CREATE DEFINER = `root` @`localhost` PROCEDURE `tampilpenghafal` () BEGIN
select *
from user
WHERE role_id = 2;
end $$ CREATE DEFINER = `root` @`localhost` PROCEDURE `tampilpost` () begin
select *
from posting
	join user u on id_user = u.id;
end $$ CREATE DEFINER = `root` @`localhost` PROCEDURE `tampilpostgen` () begin
select *
from postgen;
end $$ DELIMITER;
-- --------------------------------------------------------
--
-- Table structure for table `anggota`
--
CREATE TABLE `anggota` (
	`id_anggota` int(11) NOT NULL,
	`id_user` int(11) NOT NULL,
	`id_group` int(11) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = latin1;
--
-- Triggers `anggota`
--
DELIMITER $$ CREATE TRIGGER `after_penghafal_join`
AFTER
INSERT ON `anggota` FOR EACH ROW BEGIN
INSERT INTO group_notif
SET notif = 'Joined This Group',
	id_group = new.id_group,
	id_user = new.id_user,
	date = now();
end $$ DELIMITER;
DELIMITER $$ CREATE TRIGGER `after_penghafal_kick`
AFTER DELETE ON `anggota` FOR EACH ROW BEGIN
INSERT INTO group_notif
SET notif = 'Kicked From This Group',
	id_group = old.id_group,
	id_user = old.id_user,
	date = now();
end $$ DELIMITER;
-- --------------------------------------------------------
--
-- Table structure for table `comment`
--
CREATE TABLE `comment` (
	`id_comment` int(11) NOT NULL,
	`comment` varchar(250) NOT NULL,
	`date` varchar(50) NOT NULL,
	`id_posting` int(11) NOT NULL,
	`id` int(11) NOT NULL,
	`id_tujuan` int(11) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = latin1;
--
-- Triggers `comment`
--
DELIMITER $$ CREATE TRIGGER `after_penghafal_delete_comment`
AFTER DELETE ON `comment` FOR EACH ROW BEGIN
INSERT INTO backup_tubes.backup_comment_delete
SET aksi = 'Delete Comment',
	Comment = old.comment,
	id_posting = old.id_posting,
	id_user = old.id,
	date = now();
INSERT INTO notification
SET notif = concat(
		'delete comment on your post: "',
		old.comment,
		'"'
	),
	id_posting = old.id_posting,
	id = old.id,
	date = old.date,
	id_tujuan = old.id_tujuan;
end $$ DELIMITER;
DELIMITER $$ CREATE TRIGGER `after_penghafal_insert`
AFTER
INSERT ON `comment` FOR EACH ROW BEGIN
INSERT INTO notification
SET notif = concat('comment on your post: "', new.comment, '"'),
	id_posting = new.id_posting,
	id = new.id,
	date = new.date,
	id_tujuan = new.id_tujuan;
end $$ DELIMITER;
-- --------------------------------------------------------
--
-- Table structure for table `follow`
--
CREATE TABLE `follow` (
	`id_follow` int(11) NOT NULL,
	`stat` int(11) NOT NULL,
	`date` varchar(200) NOT NULL,
	`id_userfollow` int(11) NOT NULL,
	`id_usertarget` int(11) NOT NULL,
	`namatarget` varchar(100) NOT NULL,
	`biotarget` varchar(100) NOT NULL,
	`imagetarget` varchar(100) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = latin1;
--
-- Dumping data for table `follow`
--
INSERT INTO `follow` (
		`id_follow`,
		`stat`,
		`date`,
		`id_userfollow`,
		`id_usertarget`,
		`namatarget`,
		`biotarget`,
		`imagetarget`
	)
VALUES (
		1,
		2,
		'1579687251',
		89,
		89,
		'zalfaridzi',
		'',
		'default.png'
	),
	(
		2,
		2,
		'1579687251',
		90,
		90,
		'zalfaridzi',
		'',
		'default.png'
	),
	(
		3,
		2,
		'1579687251',
		91,
		91,
		'zalfaridzi',
		'',
		'default.png'
	),
	(
		4,
		2,
		'1617353653',
		92,
		92,
		'Karyn Bender',
		'Hello World!',
		'default.png'
	),
	(
		5,
		2,
		'1617353929',
		93,
		93,
		'Hedy Hale',
		'Hello World!',
		'default.png'
	),
	(
		6,
		2,
		'1617354021',
		94,
		94,
		'Lareina Langley',
		'Hello World!',
		'default.png'
	),
	(
		7,
		2,
		'1617354269',
		95,
		95,
		'Sydnee House',
		'Hello World!',
		'default.png'
	),
	(
		8,
		1,
		'1617354409',
		95,
		94,
		'Lareina Langley',
		'Hello World!',
		'default.png'
	);
-- --------------------------------------------------------
--
-- Table structure for table `group_comment`
--
CREATE TABLE `group_comment` (
	`id_comment` int(11) NOT NULL,
	`comment` text NOT NULL,
	`id_posting` int(11) NOT NULL,
	`date` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
	`id_user` int(11) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = latin1;
-- --------------------------------------------------------
--
-- Table structure for table `group_information`
--
CREATE TABLE `group_information` (
	`id` int(11) NOT NULL,
	`info` text NOT NULL,
	`id_group` int(11) NOT NULL,
	`id_user` int(11) NOT NULL,
	`date_post` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE = InnoDB DEFAULT CHARSET = latin1;
--
-- Triggers `group_information`
--
DELIMITER $$ CREATE TRIGGER `after_mentor_post_info`
AFTER
INSERT ON `group_information` FOR EACH ROW BEGIN
INSERT INTO group_notif
SET notif = 'Announce Information',
	id_group = new.id_group,
	id_user = new.id_user,
	date = now();
end $$ DELIMITER;
-- --------------------------------------------------------
--
-- Table structure for table `group_notif`
--
CREATE TABLE `group_notif` (
	`id_notif` int(11) NOT NULL,
	`notif` varchar(255) NOT NULL,
	`id_group` int(11) NOT NULL,
	`id_user` int(11) NOT NULL,
	`date` datetime NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;
-- --------------------------------------------------------
--
-- Table structure for table `group_postingan`
--
CREATE TABLE `group_postingan` (
	`id_posting` int(11) NOT NULL,
	`caption` varchar(255) NOT NULL,
	`id_group` int(11) NOT NULL,
	`id_user` int(11) NOT NULL,
	`filename` varchar(255) NOT NULL,
	`html` varchar(255) NOT NULL,
	`date_post` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE = InnoDB DEFAULT CHARSET = latin1;
--
-- Triggers `group_postingan`
--
DELIMITER $$ CREATE TRIGGER `after_anggota_posting`
AFTER
INSERT ON `group_postingan` FOR EACH ROW BEGIN
INSERT INTO group_notif
SET notif = 'Posted on Timeline',
	id_group = new.id_group,
	id_user = new.id_user,
	date = now();
end $$ DELIMITER;
-- --------------------------------------------------------
--
-- Table structure for table `grup`
--
CREATE TABLE `grup` (
	`id` int(11) NOT NULL,
	`nama` varchar(100) NOT NULL,
	`deskripsi` varchar(500) NOT NULL,
	`image` varchar(150) NOT NULL,
	`owner` int(11) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = latin1;
-- --------------------------------------------------------
--
-- Table structure for table `hafalan`
--
CREATE TABLE `hafalan` (
	`id` int(11) NOT NULL,
	`judul` varchar(200) NOT NULL,
	`id_user` int(11) NOT NULL,
	`id_group` int(11) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = latin1;
-- --------------------------------------------------------
--
-- Table structure for table `katmateri`
--
CREATE TABLE `katmateri` (
	`id` int(11) NOT NULL,
	`nama` varchar(255) NOT NULL,
	`arti` varchar(255) NOT NULL,
	`ayat` int(255) NOT NULL,
	`suratke` int(255) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = latin1;
-- --------------------------------------------------------
--
-- Table structure for table `materi`
--
CREATE TABLE `materi` (
	`id` int(11) NOT NULL,
	`nama` varchar(100) NOT NULL,
	`id_surat` int(11) NOT NULL,
	`id_user` int(11) NOT NULL,
	`filename` varchar(255) NOT NULL,
	`html` varchar(255) NOT NULL,
	`date_post` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE = InnoDB DEFAULT CHARSET = latin1;
-- --------------------------------------------------------
--
-- Table structure for table `menu`
--
CREATE TABLE `menu` (
	`id_menu` int(11) NOT NULL,
	`title_menu` varchar(128) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = latin1;
-- --------------------------------------------------------
--
-- Table structure for table `menu_item`
--
CREATE TABLE `menu_item` (
	`id_menu_item` int(11) NOT NULL,
	`icon` varchar(128) NOT NULL,
	`name_menu_item` varchar(128) NOT NULL,
	`link` varchar(128) NOT NULL,
	`id_menu` int(11) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = latin1;
-- --------------------------------------------------------
--
-- Table structure for table `notification`
--
CREATE TABLE `notification` (
	`id_notification` int(11) NOT NULL,
	`notif` varchar(250) NOT NULL,
	`date` varchar(50) NOT NULL,
	`id_posting` int(11) NOT NULL,
	`id` int(11) NOT NULL,
	`id_tujuan` int(11) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = latin1;
--
-- Dumping data for table `notification`
--
INSERT INTO `notification` (
		`id_notification`,
		`notif`,
		`date`,
		`id_posting`,
		`id`,
		`id_tujuan`
	)
VALUES (276, 'like on your post', '', 226, 94, 0),
	(
		277,
		'comment on your post: \" ;-) ;-)\"',
		'1617354191',
		226,
		94,
		94
	),
	(
		278,
		'delete comment on your post: \" ;-) ;-)\"',
		'1617354191',
		226,
		94,
		94
	),
	(
		279,
		'unlike on your post',
		'1617354197',
		226,
		94,
		0
	),
	(
		280,
		'unlike on your post',
		'1617354200',
		226,
		94,
		0
	),
	(
		281,
		'unlike on your post',
		'1617354203',
		226,
		94,
		0
	),
	(282, 'like on your post', '', 227, 95, 0);
-- --------------------------------------------------------
--
-- Table structure for table `pesan`
--
CREATE TABLE `pesan` (
	`id_pesan` int(11) NOT NULL,
	`id_pengirim` int(11) NOT NULL,
	`id_penerima` int(11) NOT NULL,
	`pesan` text NOT NULL,
	`date` int(11) NOT NULL,
	`sudah_dibaca` enum('sudah', 'belum', '', '') NOT NULL,
	`image` varchar(50) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = latin1;
--
-- Triggers `pesan`
--
DELIMITER $$ CREATE TRIGGER `after_penghafal_delete_pesan`
AFTER DELETE ON `pesan` FOR EACH ROW BEGIN
INSERT INTO backup_tubes.backup_pesan_delete
SET aksi = 'Delete Pesan',
	pesan = old.pesan,
	id_pengirim = old.id_pengirim,
	id_penerima = old.id_penerima,
	date = old.date,
	tanggal_backup = now();
end $$ DELIMITER;
-- --------------------------------------------------------
--
-- Table structure for table `postgen`
--
CREATE TABLE `postgen` (
	`id_posting` int(11) NOT NULL,
	`caption` varchar(500) NOT NULL,
	`fileName` varchar(500) NOT NULL,
	`html` varchar(500) NOT NULL,
	`date_post` varchar(500) NOT NULL,
	`id_user` int(11) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;
--
-- Dumping data for table `postgen`
--
INSERT INTO `postgen` (
		`id_posting`,
		`caption`,
		`fileName`,
		`html`,
		`date_post`,
		`id_user`
	)
VALUES (
		34,
		'asdasd',
		'6066df8f97461.mkv',
		'<div class=\"video-wrapper\"><video class=\"post-video\" controls width=\"500\" height=\"500\"><source src=http://localhost/myvoqu/assets_user/file_upload/6066df8f97461.mkv type=\"video/mp4\"></video></div>',
		'1617354639',
		91
	);
-- --------------------------------------------------------
--
-- Table structure for table `posting`
--
CREATE TABLE `posting` (
	`id_posting` int(11) NOT NULL,
	`caption` varchar(128) NOT NULL,
	`id_user` int(11) NOT NULL,
	`name` varchar(100) NOT NULL,
	`fileName` varchar(250) NOT NULL,
	`html` varchar(250) NOT NULL,
	`date_post` varchar(128) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = latin1;
--
-- Dumping data for table `posting`
--
INSERT INTO `posting` (
		`id_posting`,
		`caption`,
		`id_user`,
		`name`,
		`fileName`,
		`html`,
		`date_post`
	)
VALUES (
		226,
		'Proident quis id qu',
		94,
		'',
		'6066ddc1318e4.mkv',
		'<div class=\"video-wrapper\"><video class=\"post-video\" controls><source src=http://localhost/myvoqu/assets_user/file_upload/6066ddc1318e4.mkv type=\"video/mp4\"></video></div>',
		'1617354177'
	),
	(
		227,
		'Dolor nostrum lorem',
		95,
		'',
		'6066e022d7b0c.mkv',
		'<div class=\"video-wrapper\"><video class=\"post-video\" controls  width=\"500\" height=\"500\"><source src=http://localhost/myvoqu/assets_user/file_upload/6066e022d7b0c.mkv type=\"video/mp4\"></video></div>',
		'1617354786'
	);
--
-- Triggers `posting`
--
DELIMITER $$ CREATE TRIGGER `after_penghafal_insert_post`
AFTER
INSERT ON `posting` FOR EACH ROW BEGIN
INSERT INTO suka
SET status = 2,
	id_posting = new.id_posting,
	id = new.id_user,
	date = '';
INSERT INTO report
SET report = 0,
	id_posting = new.id_posting,
	id_user = new.id_user,
	date = '';
end $$ DELIMITER;
DELIMITER $$ CREATE TRIGGER `delete_posting` BEFORE DELETE ON `posting` FOR EACH ROW begin
insert into trigger_user
set aksi = "Ada yang baru delete posting",
	id = old.id_user,
	name = old.caption,
	tglubah = now();
end $$ DELIMITER;
-- --------------------------------------------------------
--
-- Table structure for table `report`
--
CREATE TABLE `report` (
	`id_report` int(11) NOT NULL,
	`report` int(11) NOT NULL,
	`date` varchar(50) NOT NULL,
	`id_posting` int(11) NOT NULL,
	`id_user` int(11) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = latin1;
--
-- Dumping data for table `report`
--
INSERT INTO `report` (
		`id_report`,
		`report`,
		`date`,
		`id_posting`,
		`id_user`
	)
VALUES (54, 0, '', 226, 94),
	(55, 0, '', 227, 95);
-- --------------------------------------------------------
--
-- Table structure for table `suka`
--
CREATE TABLE `suka` (
	`id_suka` int(11) NOT NULL,
	`status` int(11) NOT NULL,
	`date` varchar(50) NOT NULL,
	`id_posting` int(11) NOT NULL,
	`id` int(11) NOT NULL,
	`id_tujuan` int(11) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = latin1;
--
-- Dumping data for table `suka`
--
INSERT INTO `suka` (
		`id_suka`,
		`status`,
		`date`,
		`id_posting`,
		`id`,
		`id_tujuan`
	)
VALUES (183, 1, '1617354203', 226, 94, 0),
	(184, 2, '', 227, 95, 0);
--
-- Triggers `suka`
--
DELIMITER $$ CREATE TRIGGER `after_penghafal_insert_like`
AFTER
INSERT ON `suka` FOR EACH ROW BEGIN
INSERT INTO notification
SET notif = 'like on your post',
	id_posting = new.id_posting,
	id = new.id,
	date = new.date,
	id_tujuan = new.id_tujuan;
end $$ DELIMITER;
DELIMITER $$ CREATE TRIGGER `after_penghafal_update_like`
AFTER
UPDATE ON `suka` FOR EACH ROW BEGIN
INSERT INTO notification
SET notif = 'unlike on your post',
	id_posting = new.id_posting,
	id = new.id,
	date = new.date,
	id_tujuan = new.id_tujuan;
end $$ DELIMITER;
-- --------------------------------------------------------
--
-- Table structure for table `tasks`
--
CREATE TABLE `tasks` (
	`id` int(11) NOT NULL,
	`task_name` varchar(150) NOT NULL,
	`state` int(11) NOT NULL,
	`id_user` int(11) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8;
-- --------------------------------------------------------
--
-- Table structure for table `trigger_user`
--
CREATE TABLE `trigger_user` (
	`no` int(11) NOT NULL,
	`id` int(11) NOT NULL,
	`name` text NOT NULL,
	`email` text NOT NULL,
	`role_id` int(11) NOT NULL,
	`aksi` text NOT NULL,
	`tglubah` datetime NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = latin1;
-- --------------------------------------------------------
--
-- Table structure for table `user`
--
CREATE TABLE `user` (
	`id` int(11) NOT NULL,
	`name` varchar(128) NOT NULL,
	`gender` varchar(128) NOT NULL,
	`email` varchar(128) NOT NULL,
	`image` varchar(128) NOT NULL,
	`passsword` varchar(256) NOT NULL,
	`role_id` int(11) NOT NULL,
	`is_active` int(1) NOT NULL,
	`date_created` int(11) NOT NULL,
	`status` varchar(128) NOT NULL,
	`birthdate` date NOT NULL,
	`city` varchar(128) NOT NULL,
	`bio` varchar(128) NOT NULL,
	`work` varchar(128) NOT NULL,
	`instansi` varchar(128) NOT NULL,
	`sertif` varchar(500) NOT NULL,
	`verified` int(1) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = latin1;
--
-- Dumping data for table `user`
--
INSERT INTO `user` (
		`id`,
		`name`,
		`gender`,
		`email`,
		`image`,
		`passsword`,
		`role_id`,
		`is_active`,
		`date_created`,
		`status`,
		`birthdate`,
		`city`,
		`bio`,
		`work`,
		`instansi`,
		`sertif`,
		`verified`
	)
VALUES (
		91,
		'zalfaridzi',
		'Male',
		'jaki@gmail.com',
		'Zaki_Al_Faridzi_Formal_Photo1.jpg',
		'$2y$10$VPWRjJtMRr1FLWpVAC91QuIgLOKATtll33owfV52VSJztS0Zt6Udy',
		1,
		1,
		1579687251,
		'offline-dot',
		'0000-00-00',
		'',
		'',
		'',
		'',
		'',
		0
	),
	(
		94,
		'Lareina Langley',
		'Female',
		'zack.ridzi@gmail.com',
		'default.png',
		'$2y$10$e/AUDwc6WYpgnZYlyCJCsu8xtykPN4XEQJHun9x6lyAT6ppM0rbbO',
		2,
		1,
		1617354021,
		'offline-dot',
		'0000-00-00',
		'',
		'Hello World!',
		'',
		'',
		'',
		0
	),
	(
		95,
		'Sydnee House',
		'Male',
		'xitcfdhnpxttzaifpw@twzhhq.com',
		'default.png',
		'$2y$10$agYqGrCqvbMMsjyaaRY46eQzrKRsRvsuwHZPePLg/3T6VlOiWPHQ6',
		3,
		1,
		1617354269,
		'offline-dot',
		'0000-00-00',
		'',
		'Hello World!',
		'',
		'',
		'6066de1d266a9.jpg',
		1
	);
--
-- Triggers `user`
--
DELIMITER $$ CREATE TRIGGER `after_penghafal_insert_akun`
AFTER
INSERT ON `user` FOR EACH ROW BEGIN
INSERT INTO follow
SET stat = 2,
	date = new.date_created,
	id_userfollow = new.id,
	id_usertarget = new.id,
	namatarget = new.name,
	biotarget = new.bio,
	imagetarget = new.image;
end $$ DELIMITER;
DELIMITER $$ CREATE TRIGGER `edit_prof_user`
AFTER
UPDATE ON `user` FOR EACH ROW begin IF NEW.name <> OLD.name THEN
insert into trigger_user
set aksi = concat(
		old.name,
		" yang baru melakukan update profile menjadi ",
		new.name
	),
	id = old.id,
	name = old.name,
	email = old.email,
	role_id = old.role_id,
	tglubah = now();
END IF;
end $$ DELIMITER;
-- --------------------------------------------------------
--
-- Table structure for table `user_role`
--
CREATE TABLE `user_role` (
	`id` int(11) NOT NULL,
	`role` varchar(128) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = latin1;
--
-- Dumping data for table `user_role`
--
INSERT INTO `user_role` (`id`, `role`)
VALUES (1, 'Administrator'),
	(2, 'Member'),
	(3, 'Mentor');
-- --------------------------------------------------------
--
-- Table structure for table `user_token`
--
CREATE TABLE `user_token` (
	`id` int(11) NOT NULL,
	`email` varchar(128) NOT NULL,
	`token` varchar(128) NOT NULL,
	`date_created` int(11) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = latin1;
--
-- Dumping data for table `user_token`
--
INSERT INTO `user_token` (`id`, `email`, `token`, `date_created`)
VALUES (
		53,
		'zoqulo@mailinator.com',
		'KwE1Vj2nkeevz0IPN9cmWTxm5UIpC1Q52h6fk07Acpk=',
		1617353929
	);
--
-- Indexes for dumped tables
--
--
-- Indexes for table `anggota`
--
ALTER TABLE `anggota`
ADD PRIMARY KEY (`id_anggota`),
	ADD KEY `id_user` (`id_user`),
	ADD KEY `id_group` (`id_group`);
--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
ADD PRIMARY KEY (`id_comment`);
--
-- Indexes for table `follow`
--
ALTER TABLE `follow`
ADD PRIMARY KEY (`id_follow`);
--
-- Indexes for table `group_comment`
--
ALTER TABLE `group_comment`
ADD PRIMARY KEY (`id_comment`),
	ADD KEY `id_posting` (`id_posting`);
--
-- Indexes for table `group_information`
--
ALTER TABLE `group_information`
ADD PRIMARY KEY (`id`),
	ADD KEY `id_group` (`id_group`),
	ADD KEY `id_user` (`id_user`);
--
-- Indexes for table `group_notif`
--
ALTER TABLE `group_notif`
ADD PRIMARY KEY (`id_notif`);
--
-- Indexes for table `group_postingan`
--
ALTER TABLE `group_postingan`
ADD PRIMARY KEY (`id_posting`),
	ADD KEY `id_group` (`id_group`),
	ADD KEY `id_user` (`id_user`);
--
-- Indexes for table `grup`
--
ALTER TABLE `grup`
ADD PRIMARY KEY (`id`),
	ADD KEY `fkUser` (`owner`);
--
-- Indexes for table `hafalan`
--
ALTER TABLE `hafalan`
ADD PRIMARY KEY (`id`);
--
-- Indexes for table `katmateri`
--
ALTER TABLE `katmateri`
ADD PRIMARY KEY (`id`),
	ADD UNIQUE KEY `suratke` (`suratke`);
--
-- Indexes for table `materi`
--
ALTER TABLE `materi`
ADD PRIMARY KEY (`id`);
--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
ADD PRIMARY KEY (`id_menu`);
--
-- Indexes for table `menu_item`
--
ALTER TABLE `menu_item`
ADD PRIMARY KEY (`id_menu_item`);
--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
ADD PRIMARY KEY (`id_notification`);
--
-- Indexes for table `pesan`
--
ALTER TABLE `pesan`
ADD PRIMARY KEY (`id_pesan`);
--
-- Indexes for table `postgen`
--
ALTER TABLE `postgen`
ADD PRIMARY KEY (`id_posting`),
	ADD KEY `fk_user` (`id_user`);
--
-- Indexes for table `posting`
--
ALTER TABLE `posting`
ADD PRIMARY KEY (`id_posting`),
	ADD KEY `id_user` (`id_user`);
--
-- Indexes for table `report`
--
ALTER TABLE `report`
ADD PRIMARY KEY (`id_report`);
--
-- Indexes for table `suka`
--
ALTER TABLE `suka`
ADD PRIMARY KEY (`id_suka`);
--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
ADD PRIMARY KEY (`id`),
	ADD KEY `fkIDuser` (`id_user`);
--
-- Indexes for table `trigger_user`
--
ALTER TABLE `trigger_user`
ADD PRIMARY KEY (`no`);
--
-- Indexes for table `user`
--
ALTER TABLE `user`
ADD PRIMARY KEY (`id`);
--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
ADD PRIMARY KEY (`id`);
--
-- Indexes for table `user_token`
--
ALTER TABLE `user_token`
ADD PRIMARY KEY (`id`);
--
-- AUTO_INCREMENT for dumped tables
--
--
-- AUTO_INCREMENT for table `anggota`
--
ALTER TABLE `anggota`
MODIFY `id_anggota` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
MODIFY `id_comment` int(11) NOT NULL AUTO_INCREMENT,
	AUTO_INCREMENT = 2;
--
-- AUTO_INCREMENT for table `follow`
--
ALTER TABLE `follow`
MODIFY `id_follow` int(11) NOT NULL AUTO_INCREMENT,
	AUTO_INCREMENT = 9;
--
-- AUTO_INCREMENT for table `group_comment`
--
ALTER TABLE `group_comment`
MODIFY `id_comment` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `group_information`
--
ALTER TABLE `group_information`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `group_notif`
--
ALTER TABLE `group_notif`
MODIFY `id_notif` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `group_postingan`
--
ALTER TABLE `group_postingan`
MODIFY `id_posting` int(11) NOT NULL AUTO_INCREMENT,
	AUTO_INCREMENT = 22;
--
-- AUTO_INCREMENT for table `grup`
--
ALTER TABLE `grup`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
	AUTO_INCREMENT = 26;
--
-- AUTO_INCREMENT for table `hafalan`
--
ALTER TABLE `hafalan`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
	AUTO_INCREMENT = 6;
--
-- AUTO_INCREMENT for table `katmateri`
--
ALTER TABLE `katmateri`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
	AUTO_INCREMENT = 4;
--
-- AUTO_INCREMENT for table `materi`
--
ALTER TABLE `materi`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
	AUTO_INCREMENT = 13;
--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT,
	AUTO_INCREMENT = 3;
--
-- AUTO_INCREMENT for table `menu_item`
--
ALTER TABLE `menu_item`
MODIFY `id_menu_item` int(11) NOT NULL AUTO_INCREMENT,
	AUTO_INCREMENT = 3;
--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
MODIFY `id_notification` int(11) NOT NULL AUTO_INCREMENT,
	AUTO_INCREMENT = 283;
--
-- AUTO_INCREMENT for table `pesan`
--
ALTER TABLE `pesan`
MODIFY `id_pesan` int(11) NOT NULL AUTO_INCREMENT,
	AUTO_INCREMENT = 48;
--
-- AUTO_INCREMENT for table `postgen`
--
ALTER TABLE `postgen`
MODIFY `id_posting` int(11) NOT NULL AUTO_INCREMENT,
	AUTO_INCREMENT = 35;
--
-- AUTO_INCREMENT for table `posting`
--
ALTER TABLE `posting`
MODIFY `id_posting` int(11) NOT NULL AUTO_INCREMENT,
	AUTO_INCREMENT = 228;
--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
MODIFY `id_report` int(11) NOT NULL AUTO_INCREMENT,
	AUTO_INCREMENT = 56;
--
-- AUTO_INCREMENT for table `suka`
--
ALTER TABLE `suka`
MODIFY `id_suka` int(11) NOT NULL AUTO_INCREMENT,
	AUTO_INCREMENT = 185;
--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
	AUTO_INCREMENT = 39;
--
-- AUTO_INCREMENT for table `trigger_user`
--
ALTER TABLE `trigger_user`
MODIFY `no` int(11) NOT NULL AUTO_INCREMENT,
	AUTO_INCREMENT = 60;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
	AUTO_INCREMENT = 96;
--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
	AUTO_INCREMENT = 4;
--
-- AUTO_INCREMENT for table `user_token`
--
ALTER TABLE `user_token`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
	AUTO_INCREMENT = 56;
--
-- Constraints for dumped tables
--
--
-- Constraints for table `anggota`
--
ALTER TABLE `anggota`
ADD CONSTRAINT `fk_id_group` FOREIGN KEY (`id_group`) REFERENCES `grup` (`id`) ON DELETE CASCADE,
	ADD CONSTRAINT `fk_id_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE;
--
-- Constraints for table `group_comment`
--
ALTER TABLE `group_comment`
ADD CONSTRAINT `fk_idposting` FOREIGN KEY (`id_posting`) REFERENCES `group_postingan` (`id_posting`) ON DELETE CASCADE ON UPDATE CASCADE;
--
-- Constraints for table `group_information`
--
ALTER TABLE `group_information`
ADD CONSTRAINT `fkIDGroup` FOREIGN KEY (`id_group`) REFERENCES `grup` (`id`) ON DELETE CASCADE;
--
-- Constraints for table `group_postingan`
--
ALTER TABLE `group_postingan`
ADD CONSTRAINT `fk_idGrup` FOREIGN KEY (`id_group`) REFERENCES `grup` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
	ADD CONSTRAINT `fk_idUser` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
--
-- Constraints for table `grup`
--
ALTER TABLE `grup`
ADD CONSTRAINT `fkUser` FOREIGN KEY (`owner`) REFERENCES `user` (`id`);
--
-- Constraints for table `postgen`
--
ALTER TABLE `postgen`
ADD CONSTRAINT `fk_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE;
--
-- Constraints for table `posting`
--
ALTER TABLE `posting`
ADD CONSTRAINT `fiduser` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE;
DELIMITER $$ --
-- Events
--
CREATE DEFINER = `root` @`localhost` EVENT `backup_tubes_myvoqu` ON SCHEDULE EVERY 1 MINUTE STARTS '2020-04-02 14:53:25' ON COMPLETION NOT PRESERVE ENABLE DO CALL backup_semua_tabel() $$ DELIMITER;
COMMIT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */
;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */
;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */
;
