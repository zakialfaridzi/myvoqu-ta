-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 31, 2021 at 04:41 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `myvoqu-fixed`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `backup_pesan_comment_like` ()  BEGIN

TRUNCATE TABLE backup_tubes.backup_comment;
INSERT INTO backup_tubes.backup_comment(select id_comment, comment, date,id_posting, id, id_tujuan, now() tanggal_backup from tubes.comment);

TRUNCATE TABLE backup_tubes.backup_suka;
INSERT INTO backup_tubes.backup_suka(select id_suka, status, date, id_posting, id, id_tujuan, now() tanggal_backup from tubes.suka);

TRUNCATE TABLE backup_tubes.backup_pesan;
INSERT INTO backup_tubes.backup_pesan(select id_pesan, id_pengirim, id_penerima, pesan, date, sudah_dibaca, image, now() tanggal_backup from tubes.pesan);

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `chartinstansi` ()  begin
select instansi, count(instansi) as total from user where role_id=3 and verified=1 group by instansi;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `chartpost` ()  begin
select user.name, count(*) as total from posting join user on posting.id_user = user.id group by id_user;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `chartroleid` ()  begin
select role_id, count(role_id) as total from user group by role_id;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `chartuser` ()  begin
select gender, count(*) as total from user where role_id = 2 group by gender;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `detailpost` (`id` INT)  begin
select *, count(r.report) as cr from posting p join user u on p.id_user=u.id join report r on r.id_posting = p.id_posting where p.id_posting = id;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `profileAdmin` ()  begin
select * from user where role_id = 1;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `tampilgrup` ()  begin
select * from grup;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `tampilmentor` ()  begin
select * from user where role_id="3";
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `tampilpenghafal` ()  BEGIN
select * from user WHERE role_id = 2;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `tampilpost` ()  begin
select * from posting join user u on id_user=u.id;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `tampilpostgen` ()  begin
select * from postgen;
end$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `anggota`
--

CREATE TABLE `anggota` (
  `id_anggota` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_group` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `anggota`
--

INSERT INTO `anggota` (`id_anggota`, `id_user`, `id_group`) VALUES
(66, 80, 24),
(67, 81, 24);

--
-- Triggers `anggota`
--
DELIMITER $$
CREATE TRIGGER `after_penghafal_join` AFTER INSERT ON `anggota` FOR EACH ROW BEGIN
INSERT INTO group_notif
SET notif='Joined This Group',
id_group= new.id_group,
id_user = new.id_user,
date = now();
end
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_penghafal_kick` AFTER DELETE ON `anggota` FOR EACH ROW BEGIN
INSERT INTO group_notif
SET notif='Kicked From This Group',
id_group= old.id_group,
id_user = old.id_user,
date = now();
end
$$
DELIMITER ;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id_comment`, `comment`, `date`, `id_posting`, `id`, `id_tujuan`) VALUES
(110, ' :-)', '1586633198', 284, 53, 52),
(111, ' :-)', '1586636155', 286, 52, 52),
(112, ' :-)', '1586636226', 285, 52, 53),
(115, ' :-)', '1586686470', 197, 81, 80),
(116, ' :smirk:', '1586686509', 197, 81, 80),
(117, ' %-P', '1586686695', 197, 81, 80),
(118, 'weew', '1123', 123, 123, 123),
(119, ' :wow:', '1586687077', 197, 80, 80),
(120, ' :lol:', '1586687132', 197, 81, 80),
(121, 'MABAR', '1586759377', 198, 74, 81);

--
-- Triggers `comment`
--
DELIMITER $$
CREATE TRIGGER `after_penghafal_delete_comment` AFTER DELETE ON `comment` FOR EACH ROW BEGIN
INSERT INTO backup_tubes.backup_comment_delete
SET aksi='Delete Comment',
Comment = old.comment,
id_posting= old.id_posting,
id_user = old.id,
date = now();

INSERT INTO notification
SET notif=concat('delete comment on your post: "', old.comment, '"'),
id_posting= old.id_posting,
id = old.id,
date = old.date,
id_tujuan = old.id_tujuan;

end
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_penghafal_insert` AFTER INSERT ON `comment` FOR EACH ROW BEGIN
INSERT INTO notification
SET notif=concat('comment on your post: "', new.comment, '"'),
id_posting= new.id_posting,
id = new.id,
date = new.date,
id_tujuan = new.id_tujuan;
end
$$
DELIMITER ;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `follow`
--

INSERT INTO `follow` (`id_follow`, `stat`, `date`, `id_userfollow`, `id_usertarget`, `namatarget`, `biotarget`, `imagetarget`) VALUES
(152, 2, '1586685825', 80, 80, 'ersa', 'Hello World!', 'default.png'),
(153, 2, '1586685919', 81, 81, 'fanny', 'Hello World!', 'default.png'),
(155, 2, '1586708436', 82, 82, 'matt', 'Hello World!', 'default.png'),
(161, 2, '1586711840', 83, 83, 'rintani', 'Hello World!', 'default.png'),
(162, 1, '1586712025', 83, 82, 'matt', 'Hello World!', 'default.png'),
(163, 2, '1586713846', 81, 82, 'matt', 'Hello World!', 'default.png'),
(164, 2, '1586752244', 84, 84, 'Rintani', 'Hello World!', 'default.png'),
(165, 2, '1586761845', 81, 84, 'Rintani', 'Hello World!', 'default.png'),
(166, 2, '1586782172', 85, 85, 'Muhammad Abizard Al Thareq', 'Hello World!', 'default.png'),
(167, 1, '1586789123', 82, 85, 'Muhammad Abizard Al Thareq', 'Hello World!', 'default.png');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `group_information`
--

INSERT INTO `group_information` (`id`, `info`, `id_group`, `id_user`, `date_post`) VALUES
(8, 'Untuk besok kita kerja bakti\r\n\r\n#AYOBERSIH', 24, 74, '2020-04-13 15:57:01');

--
-- Triggers `group_information`
--
DELIMITER $$
CREATE TRIGGER `after_mentor_post_info` AFTER INSERT ON `group_information` FOR EACH ROW BEGIN
INSERT INTO group_notif
SET notif='Announce Information',
id_group= new.id_group,
id_user = new.id_user,
date = now();
end
$$
DELIMITER ;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `group_notif`
--

INSERT INTO `group_notif` (`id_notif`, `notif`, `id_group`, `id_user`, `date`) VALUES
(4, 'Announce Information', 24, 74, '2020-04-13 15:57:01'),
(5, 'Joined This Group', 24, 81, '2020-04-13 15:57:16'),
(6, 'Joined This Group', 25, 85, '2020-04-13 22:24:02');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Triggers `group_postingan`
--
DELIMITER $$
CREATE TRIGGER `after_anggota_posting` AFTER INSERT ON `group_postingan` FOR EACH ROW BEGIN
INSERT INTO group_notif
SET notif='Posted on Timeline',
id_group= new.id_group,
id_user = new.id_user,
date = now();
end
$$
DELIMITER ;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `grup`
--

INSERT INTO `grup` (`id`, `nama`, `deskripsi`, `image`, `owner`) VALUES
(24, 'MyVoqu MSU', 'Mentoring TELYU', '', 74);

-- --------------------------------------------------------

--
-- Table structure for table `hafalan`
--

CREATE TABLE `hafalan` (
  `id` int(11) NOT NULL,
  `judul` varchar(200) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_group` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hafalan`
--

INSERT INTO `hafalan` (`id`, `judul`, `id_user`, `id_group`) VALUES
(1, 'Hafalan 1', 0, 0),
(2, 'hafalan 2', 0, 0),
(3, 'hafalan 3', 0, 0),
(4, 'hafalan 4', 0, 0),
(5, 'hafalan 5', 0, 0);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `katmateri`
--

INSERT INTO `katmateri` (`id`, `nama`, `arti`, `ayat`, `suratke`) VALUES
(1, 'Al-Fatihah', 'Pembukaan', 7, 1),
(2, 'Al Ikhlas', 'keikhlasan', 4, 112);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `materi`
--

INSERT INTO `materi` (`id`, `nama`, `id_surat`, `id_user`, `filename`, `html`, `date_post`) VALUES
(1, 'Ayat 1', 1, 0, '', '', '2020-04-13 01:25:21'),
(2, 'Ayat 2', 1, 0, '', '', '2020-04-13 01:25:21'),
(3, 'Ayat 3', 2, 0, '', '', '2020-04-13 01:25:21'),
(4, 'Ayat 4', 2, 0, '', '', '2020-04-13 01:25:21'),
(5, 'Ayat 5', 2, 0, '', '', '2020-04-13 01:25:21'),
(6, 'Ayat 6', 2, 0, '', '', '2020-04-13 01:25:21'),
(7, 'Ayat 7', 1, 0, '', '', '2020-04-13 01:25:21'),
(8, 'Ayat 8', 1, 0, '', '', '2020-04-13 01:25:21'),
(9, 'Ayat 9', 1, 0, '', '', '2020-04-13 01:25:21'),
(10, 'Ayat 10', 2, 0, '', '', '2020-04-13 01:25:21'),
(11, 'Ayat 11', 2, 0, '', '', '2020-04-13 01:25:21'),
(12, 'Ayat 12', 0, 0, '', '', '2020-04-13 01:25:21');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id_menu` int(11) NOT NULL,
  `title_menu` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id_menu`, `title_menu`) VALUES
(1, 'User Controller'),
(2, 'ada');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu_item`
--

INSERT INTO `menu_item` (`id_menu_item`, `icon`, `name_menu_item`, `link`, `id_menu`) VALUES
(1, 'fas fa-fw fa-cog', 'User Feed', 'menu1', 1),
(2, 'fas fa-fw fa-cog', 'asdas', 'menu2', 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`id_notification`, `notif`, `date`, `id_posting`, `id`, `id_tujuan`) VALUES
(242, 'comment on your post.', '1586687077', 197, 80, 80),
(243, 'comment on your post.', '1586687132', 197, 81, 80),
(245, 'like on your post', '', 198, 81, 0),
(246, 'comment on your post.', '1586759377', 198, 74, 81),
(247, 'like on your post', '', 199, 81, 0),
(248, 'like on your post', '', 200, 81, 0),
(249, 'like on your post', '', 201, 81, 0),
(250, 'like on your post', '', 202, 81, 0),
(251, 'like on your post', '', 203, 81, 0),
(252, 'like on your post', '', 204, 81, 0),
(253, 'like on your post', '', 205, 81, 0),
(254, 'like on your post', '', 206, 81, 0),
(255, 'like on your post', '', 207, 85, 0),
(256, 'like on your post', '', 208, 85, 0),
(257, 'like on your post', '', 209, 85, 0),
(258, 'like on your post', '', 210, 85, 0),
(259, 'like on your post', '', 211, 85, 0),
(260, 'like on your post', '', 212, 85, 0),
(261, 'like on your post', '', 213, 85, 0),
(262, 'like on your post', '', 214, 85, 0),
(263, 'like on your post', '', 215, 85, 0),
(264, 'like on your post', '', 216, 85, 0),
(265, 'like on your post', '', 217, 85, 0),
(266, 'like on your post', '', 218, 85, 0),
(267, 'like on your post', '', 219, 85, 0),
(268, 'like on your post', '', 220, 85, 0),
(269, 'like on your post', '', 221, 85, 0),
(270, 'like on your post', '', 222, 82, 0);

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
  `sudah_dibaca` enum('sudah','belum','','') NOT NULL,
  `image` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pesan`
--

INSERT INTO `pesan` (`id_pesan`, `id_pengirim`, `id_penerima`, `pesan`, `date`, `sudah_dibaca`, `image`) VALUES
(44, 52, 53, ' :-)', 1586639914, 'belum', ''),
(45, 78, 49, 'hi ersa aku zaki suka kamu', 1586685677, 'belum', ''),
(46, 49, 78, 'anjayy', 1586685728, 'belum', ''),
(47, 49, 78, 'aku dah punya bopip', 1586685741, 'belum', '');

--
-- Triggers `pesan`
--
DELIMITER $$
CREATE TRIGGER `after_penghafal_delete_pesan` AFTER DELETE ON `pesan` FOR EACH ROW BEGIN
INSERT INTO backup_tubes.backup_pesan_delete
SET aksi='Delete Pesan',
pesan = old.pesan,
id_pengirim = old.id_pengirim,
id_penerima = old.id_penerima,
date = old.date,
tanggal_backup = now();
end
$$
DELIMITER ;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `postgen`
--

INSERT INTO `postgen` (`id_posting`, `caption`, `fileName`, `html`, `date_post`, `id_user`) VALUES
(25, 'Ali bin Abi Thalib', '6046e7e4e0332.jpg', '<img src=http://localhost/myvoqu/assets_user/file_upload/6046e7e4e0332.jpg alt=\"post-image\"class=\"img-responsive post-image\" style=\"height: 300px;\" />', '1615259620', 41),
(26, 'Placeat quis omnis ', '60648298928e4.png', '<img src=http://localhost/myvoqu/assets_user/file_upload/60648298928e4.png alt=\"post-image\"class=\"img-responsive post-image\" style=\"height: 300px;\" />', '1617199768', 41);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posting`
--

INSERT INTO `posting` (`id_posting`, `caption`, `id_user`, `name`, `fileName`, `html`, `date_post`) VALUES
(220, 'waw', 85, '', '5e9469e66093a.jpg', '<img src=http://localhost/tubes-ci/assets_user/file_upload/5e9469e66093a.jpg alt=\"post-image\"class=\"img-responsive post-image\" style=\"height: 350px;\" />', '1586784742'),
(221, 'wiw', 85, '', '5e9469fb930dc.mp4', '<div class=\"video-wrapper\"><video class=\"post-video\" controls><source src=http://localhost/tubes-ci/assets_user/file_upload/5e9469fb930dc.mp4 type=\"video/mp4\"></video></div>', '1586784763'),
(222, 'adasdas', 82, '', '5e947b5ba78a8.jpg', '<img src=http://localhost/tubes-ci/assets_user/file_upload/5e947b5ba78a8.jpg alt=\"post-image\"class=\"img-responsive post-image\" style=\"height: 500px;\" />', '1586789211');

--
-- Triggers `posting`
--
DELIMITER $$
CREATE TRIGGER `after_penghafal_insert_post` AFTER INSERT ON `posting` FOR EACH ROW BEGIN
INSERT INTO suka
SET status=2,
id_posting= new.id_posting,
id = new.id_user,
date = '';
INSERT INTO report
SET report=0,
id_posting= new.id_posting,
id_user = new.id_user,
date = '';
end
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `delete_posting` BEFORE DELETE ON `posting` FOR EACH ROW begin
insert into trigger_user
set aksi = "Ada yang baru delete posting",
id = old.id_user,
name = old.caption,
tglubah = now();
end
$$
DELIMITER ;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `report`
--

INSERT INTO `report` (`id_report`, `report`, `date`, `id_posting`, `id_user`) VALUES
(1, 0, '', 248, 46),
(2, 0, '', 249, 46),
(3, 0, '', 250, 46),
(4, 0, '', 251, 46),
(5, 0, '', 253, 46),
(6, 0, '', 254, 46),
(7, 0, '', 255, 46),
(8, 0, '', 256, 46),
(10, 1, '1584374351', 256, 44),
(11, 0, '', 257, 46),
(12, 1, '1584399557', 256, 47),
(13, 0, '', 258, 46),
(14, 1, '1584400432', 254, 45),
(15, 0, '', 259, 47),
(16, 1, '1584435450', 259, 46),
(17, 0, '', 184, 49),
(18, 0, '', 185, 49),
(19, 0, '', 186, 74),
(20, 0, '', 187, 74),
(21, 0, '', 188, 74),
(22, 0, '', 189, 75),
(23, 0, '', 195, 78),
(24, 0, '', 196, 78),
(25, 0, '', 197, 80),
(26, 0, '', 198, 81),
(27, 0, '', 199, 81),
(28, 0, '', 200, 81),
(29, 0, '', 201, 81),
(30, 0, '', 202, 81),
(31, 0, '', 203, 81),
(32, 0, '', 204, 81),
(33, 0, '', 205, 81),
(34, 0, '', 206, 81),
(35, 0, '', 207, 85),
(36, 0, '', 208, 85),
(37, 0, '', 209, 85),
(38, 0, '', 210, 85),
(39, 0, '', 211, 85),
(40, 0, '', 212, 85),
(41, 0, '', 213, 85),
(42, 0, '', 214, 85),
(43, 0, '', 215, 85),
(44, 0, '', 216, 85),
(45, 0, '', 217, 85),
(46, 0, '', 218, 85),
(47, 0, '', 219, 85),
(48, 0, '', 220, 85),
(49, 0, '', 221, 85),
(50, 0, '', 222, 82);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `suka`
--

INSERT INTO `suka` (`id_suka`, `status`, `date`, `id_posting`, `id`, `id_tujuan`) VALUES
(145, 2, '', 284, 52, 52),
(146, 2, '1586633191', 284, 53, 52),
(147, 2, '', 285, 53, 53),
(148, 2, '1586636152', 286, 52, 52),
(149, 1, '1586636222', 285, 52, 53),
(150, 1, '1586636273', 286, 53, 52),
(151, 2, '', 195, 78, 0),
(152, 2, '1586685413', 196, 78, 0),
(153, 2, '', 197, 80, 0),
(154, 1, '1586686473', 197, 81, 80),
(155, 2, '', 198, 81, 0),
(156, 2, '', 199, 81, 0),
(157, 2, '', 200, 81, 0),
(158, 2, '', 201, 81, 0),
(159, 2, '', 202, 81, 0),
(160, 2, '', 203, 81, 0),
(161, 2, '', 204, 81, 0),
(162, 2, '', 205, 81, 0),
(163, 2, '', 206, 81, 0),
(164, 2, '', 207, 85, 0),
(165, 2, '', 208, 85, 0),
(166, 2, '', 209, 85, 0),
(167, 2, '', 210, 85, 0),
(168, 2, '', 211, 85, 0),
(169, 2, '', 212, 85, 0),
(170, 2, '', 213, 85, 0),
(171, 2, '', 214, 85, 0),
(172, 2, '', 215, 85, 0),
(173, 2, '', 216, 85, 0),
(174, 2, '', 217, 85, 0),
(175, 2, '', 218, 85, 0),
(176, 2, '', 219, 85, 0),
(177, 2, '', 220, 85, 0),
(178, 2, '', 221, 85, 0),
(179, 2, '', 222, 82, 0);

--
-- Triggers `suka`
--
DELIMITER $$
CREATE TRIGGER `after_penghafal_insert_like` AFTER INSERT ON `suka` FOR EACH ROW BEGIN
INSERT INTO notification
SET notif='like on your post',
id_posting= new.id_posting,
id = new.id,
date = new.date,
id_tujuan = new.id_tujuan;
end
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_penghafal_update_like` AFTER UPDATE ON `suka` FOR EACH ROW BEGIN
INSERT INTO notification
SET notif='unlike on your post',
id_posting= new.id_posting,
id = new.id,
date = new.date,
id_tujuan = new.id_tujuan;
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `task_name` varchar(150) NOT NULL,
  `state` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `task_name`, `state`, `id_user`) VALUES
(23, 'cek akun penghafal', 0, 0),
(24, 'cek postingan yang banyak reportnya', 0, 0),
(26, 'TA', 0, 0),
(32, 'daily checkin', 0, 0),
(33, 'refactor kodingan', 1, 0),
(34, 'desform', 1, 0),
(35, 'Beatae hic velit cup', 1, 0);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trigger_user`
--

INSERT INTO `trigger_user` (`no`, `id`, `name`, `email`, `role_id`, `aksi`, `tglubah`) VALUES
(3, 74, 'Rahmat', 'rahmatibrahim141@gmail.com', 3, 'Rahmat melakukan logout', '2020-04-12 16:44:03'),
(4, 78, 'fanny', 'fanny@mail.com', 2, 'fanny melakukan login', '2020-04-12 16:46:54'),
(5, 49, 'ersa', 'greennam13@gmail.com', 2, 'ersa melakukan login', '2020-04-12 17:01:51'),
(6, 80, 'ersa', 'ersa@gmail.com', 2, 'Ada yang baru registrasi bernama ersa', '2020-04-12 17:03:45'),
(7, 81, 'fanny', 'fanny@gmail.com', 2, 'Ada yang baru registrasi bernama fanny', '2020-04-12 17:05:19'),
(8, 80, 'ersa', 'ersa@gmail.com', 2, 'ersa melakukan login', '2020-04-12 17:05:44'),
(9, 81, 'fanny', 'fanny@gmail.com', 2, 'fanny melakukan login', '2020-04-12 17:05:54'),
(10, 80, 'ersa', 'ersa@gmail.com', 2, 'ersa melakukan logout', '2020-04-12 17:38:11'),
(11, 81, 'fanny', 'fanny@gmail.com', 2, 'fanny melakukan logout', '2020-04-12 17:41:12'),
(12, 74, 'Rahmat', 'rahmatibrahim141@gmail.com', 3, 'Rahmat melakukan login', '2020-04-12 17:41:19'),
(13, 74, 'Rahmat', 'rahmatibrahim141@gmail.com', 3, 'Rahmat melakukan login', '2020-04-12 17:43:20'),
(14, 74, 'Rahmat', 'rahmatibrahim141@gmail.com', 3, 'Rahmat melakukan login', '2020-04-12 17:43:28'),
(15, 74, 'Rahmat', 'rahmatibrahim141@gmail.com', 3, 'Rahmat melakukan login', '2020-04-12 17:43:48'),
(16, 81, 'fanny', 'fanny@gmail.com', 2, 'fanny melakukan login', '2020-04-12 17:44:32'),
(17, 81, 'fanny', 'fanny@gmail.com', 2, 'fanny melakukan login', '2020-04-12 23:15:38'),
(18, 81, 'fanny', 'fanny@gmail.com', 2, 'fanny melakukan logout', '2020-04-12 23:20:20'),
(19, 82, 'matt', 'matt@mail.com', 2, 'Ada yang baru registrasi bernama matt', '2020-04-12 23:20:36'),
(20, 82, 'matt', 'matt@mail.com', 2, 'matt melakukan login', '2020-04-12 23:21:04'),
(21, 82, 'matt', 'matt@mail.com', 2, 'matt melakukan logout', '2020-04-12 23:24:39'),
(22, 81, 'fanny', 'fanny@gmail.com', 2, 'fanny melakukan login', '2020-04-12 23:24:47'),
(23, 74, 'Rahmat', 'rahmatibrahim141@gmail.com', 3, 'Rahmat melakukan login', '2020-04-12 23:43:09'),
(24, 81, 'fanny', 'fanny@gmail.com', 2, 'fanny melakukan logout', '2020-04-13 00:16:47'),
(25, 83, 'rintani', 'rin@mail.com', 2, 'Ada yang baru registrasi bernama rintani', '2020-04-13 00:17:20'),
(26, 83, 'rintani', 'rin@mail.com', 2, 'rintani melakukan login', '2020-04-13 00:18:18'),
(27, 83, 'rintani', 'rin@mail.com', 2, 'rintani melakukan logout', '2020-04-13 00:20:32'),
(28, 81, 'fanny', 'fanny@gmail.com', 2, 'fanny melakukan login', '2020-04-13 00:20:39'),
(29, 81, 'R6', '', 0, 'Ada yang baru delete posting', '2020-04-13 14:23:58'),
(30, 81, 'wew', '', 0, 'Ada yang baru delete posting', '2020-04-13 14:25:34'),
(31, 81, 'test', '', 0, 'Ada yang baru delete posting', '2020-04-13 14:26:20'),
(32, 81, 'waww', '', 0, 'Ada yang baru delete posting', '2020-04-13 14:28:12'),
(33, 80, 'ukhti', '', 0, 'Ada yang baru delete posting', '2020-04-13 14:29:11'),
(34, 81, 'weqe', '', 0, 'Ada yang baru delete posting', '2020-04-13 14:29:11'),
(35, 81, 'MAT', '', 0, 'Ada yang baru delete posting', '2020-04-13 14:38:32'),
(36, 81, 'twewse', '', 0, 'Ada yang baru delete posting', '2020-04-13 16:37:36'),
(37, 85, 'yummy', '', 0, 'Ada yang baru delete posting', '2020-04-13 20:03:50'),
(38, 85, 'aaa', '', 0, 'Ada yang baru delete posting', '2020-04-13 20:04:09'),
(39, 85, 'aa', '', 0, 'Ada yang baru delete posting', '2020-04-13 20:15:24'),
(40, 85, 'aa', '', 0, 'Ada yang baru delete posting', '2020-04-13 20:17:08'),
(41, 85, 'aa', '', 0, 'Ada yang baru delete posting', '2020-04-13 20:18:29'),
(42, 85, 'asaa', '', 0, 'Ada yang baru delete posting', '2020-04-13 20:19:17'),
(43, 85, 'aa', '', 0, 'Ada yang baru delete posting', '2020-04-13 20:20:51'),
(44, 85, '', '', 0, 'Ada yang baru delete posting', '2020-04-13 20:21:50'),
(45, 85, 'asdad', '', 0, 'Ada yang baru delete posting', '2020-04-13 20:29:56'),
(46, 85, '', '', 0, 'Ada yang baru delete posting', '2020-04-13 20:30:12'),
(47, 81, 'QURAN', '', 0, 'Ada yang baru delete posting', '2020-04-13 20:30:40'),
(48, 81, 'wew', '', 0, 'Ada yang baru delete posting', '2020-04-13 20:30:40'),
(49, 85, 'nadiem', '', 0, 'Ada yang baru delete posting', '2020-04-13 20:31:58'),
(50, 85, 'aaa', '', 0, 'Ada yang baru delete posting', '2020-04-13 20:32:09'),
(51, 41, 'Jeki', 'jaki@gmail.com', 1, 'Jeki yang baru melakukan update profile menjadi Jaki', '2021-03-09 09:52:16'),
(52, 85, 'yummy', '', 0, 'Ada yang baru delete posting', '2021-03-09 10:40:10');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `gender`, `email`, `image`, `passsword`, `role_id`, `is_active`, `date_created`, `status`, `birthdate`, `city`, `bio`, `work`, `instansi`, `sertif`, `verified`) VALUES
(41, 'Jaki', 'Male', 'jaki@gmail.com', 'Zaki_Al_Faridzi_Formal_Photo.jpg', '$2y$10$VPWRjJtMRr1FLWpVAC91QuIgLOKATtll33owfV52VSJztS0Zt6Udy', 1, 1, 1579687251, 'offline-dot', '0000-00-00', '', '', '', '', '', 0),
(65, 'zakialf', 'Male', 'zalfaridzi9@gmail.com', 'default.png', '$2y$10$vQ0mQ6jFL2XXCHIdFXlAaeiV/H0w..DDVRA4skipgBHZ6kcX2yrQ6', 3, 1, 1583292406, 'offline-dot', '0000-00-00', '', 'Hello World!', '', 'NU', '5e5f1ff6af8ae.jpg', 1),
(74, 'Rahmat', 'Male', 'rahmatibrahim141@gmail.com', 'default.png', '$2y$10$oxVDkKT8z2tVBv3jqF6UNeRNBPNNHHTJlkp7ahB1978W2iVmCFe1e', 3, 2, 1584434428, 'online-dot', '0000-00-00', '', 'Hello World!', '', 'Instansi', '5e708cfc4fc36.png', 1),
(77, 'enjang', 'Male', 'enjang@mail.com', 'default.png', '$2y$10$rJdGHDuFv7tknXFZgBDGmOGRkNgE6SNoscXsaSBrWM8yaoAOoQcvW', 3, 1, 1585032852, 'offline-dot', '0000-00-00', '', 'Hello World!', '', 'NU', '5e79ae9451f58.jpg', 1),
(79, 'Kipli', 'Male', 'kipli@mail.com', 'default.png', '$2y$10$bQ0yeWos60h4ghzbabUi2uu5qjrpvkieUO1fmhOg1E5XVqohrejs.', 3, 1, 1585034822, '', '0000-00-00', '', 'Hello World!', '', 'MUI', '5e79b64623bf8.jpg', 1),
(80, 'ersa', 'Female', 'ersa@gmail.com', 'default.png', '$2y$10$gsLzDx0Dlbd/qFFEeMsOjeAwodTv6WsunmTTco4vF9T3YYoF8C.4.', 2, 1, 1586685825, 'offline-dot', '0000-00-00', '', 'Hello World!', '', '', '', 0),
(81, 'fanny', 'Female', 'fanny@gmail.com', 'default.png', '$2y$10$OOMAeqVfV2xJqmk7lxr8hOx.XZ5cMaFZ6Wjp/UotK.QQyhiQ0pIRa', 2, 1, 1586685919, 'offline-dot', '0000-00-00', '', 'Hello World!', '', '', '', 0),
(82, 'matt', 'Male', 'matt@mail.com', '5e9482dd5a109.jpg', '$2y$10$7VKM2pCSf5csFCECGLb7ReCbfcETY7GBqb2Rv3g0laSJI9vTS7miu', 2, 1, 1586708436, 'offline-dot', '0000-00-00', '', 'Hello World!', '', '', '', 0),
(85, 'Muhammad Abizard Al Thareq', 'Male', 'm.abizard1123@gmail.com', 'default.png', '$2y$10$AUVpDR593bbdsQz7vOcuWuXIRmuhfLdqO7pi3SjAMKS185xbLHKpy', 2, 1, 1586782172, 'offline-dot', '0000-00-00', '', 'Hello World!', '', '', '', 0);

--
-- Triggers `user`
--
DELIMITER $$
CREATE TRIGGER `after_penghafal_insert_akun` AFTER INSERT ON `user` FOR EACH ROW BEGIN
INSERT INTO follow
SET stat= 2,
date = new.date_created,
id_userfollow = new.id,
id_usertarget = new.id,
namatarget = new.name,
biotarget = new.bio,
imagetarget = new.image;
end
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `edit_prof_user` AFTER UPDATE ON `user` FOR EACH ROW begin
IF NEW.name <> OLD.name 
THEN  
  insert into trigger_user
set aksi = concat(old.name, " yang baru melakukan update profile menjadi ", new.name),
id = old.id,
name = old.name,
email = old.email,
role_id = old.role_id,
tglubah = now();
END IF;
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'Administrator'),
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_token`
--

INSERT INTO `user_token` (`id`, `email`, `token`, `date_created`) VALUES
(4, 'abizardoalvaredo1123@gmail.com', 'vMZIFYgueNWblnZRR5kkSa3RvD+teFVE961NgQXFwfc=', 1579686476),
(5, 'abizardoalvaredo1123@gmail.com', 'VhPct5b5ivphF/pgRwhGou5J72aNtK9myihJj2pNdlg=', 1579686602),
(8, 'novauliyana@gmail.com', 'FE3jM0RUMUmfCD+lbwrZKOgV/Bvx+peH5vjvx08o4iE=', 1583200749),
(9, 'greenam13@gmail.com', 'msjeyn0n+elvlNUimo9hgrS5wbzjsG/yUV3/RxvmlKw=', 1583200925),
(12, 'abizardo1123@gmail.com', 'Ottwk+sGQXs/epHpm+6pTEBTmgxJs5KA+1Yl84LKKl8=', 1583226245),
(21, 'zalfaridzi9@gmail.com', '37xMNyrlg7E0F0aEGZ0JEeraWdy4LgUFgcxjl9f6qkI=', 1583288340),
(22, 'zalfaridzi9@gmail.com', '8y0lc8Hn4FRBiWRkJKzadlFMn+drss0yhUpWuVALL1k=', 1583288635),
(23, 'maaa@gmail.com', '9HksqKiis9Ugsy2NNSlbCfsk4Eke2MpCFdDs+xCcCyY=', 1583289180),
(24, 'zzz@gmail.com', 'do80jETgWUj9tAlqhUbFZrOjGt98BFPFATS6qhUkXQk=', 1583289983),
(25, 'adassa@gmail.com', 'G+bzsgQRj7E0gHVnq47nSNYPt84qP0cNPSXcd170ugU=', 1583290680),
(26, 'zalfaridzi9@gmail.com', '1FVbzdwUGLuE5+wUY6j0hLP3iplPQ5tvKitWi2JYuAA=', 1583292313),
(27, 'zalfaridzi9@gmail.com', 'U/LUkBjRATFOtnWsU+9OxerrmJAhy+BAY3r8yTsR3fQ=', 1583292406),
(28, 'aaa@gmail.com', 'Z9sDJydllkn7RC/+0RLAfdkfdB5Q6uwcY7fOxLHxuqM=', 1583293185),
(29, 'zack.ridzi@gmail.com', 'DR3U+XCbhnHRAv4iKfsV5+m3L/8qqOQXK0dsvgnivKM=', 1583293248),
(30, 'zack.ridzi@gmail.com', 'ecjZEZNeiXqERtiVrbGmcrsPDVtOFcBeegDtSsCqo5E=', 1583293335),
(31, 'zack.ridzi@gmail.com', 'pzFxof1TyMrRK2hDXFkFyj3Eutd048zz6cYXlnOcyDU=', 1583293405),
(32, 'qwe@gmail.com', 'oiIP+nOc6Ea2SDpmRNsMxFLjwFW0k+GpawF8hCFGxMg=', 1583293560),
(33, 'www@gmail.com', 'f8RPKyj90bB8L8JvrBIeQ5go+GAojXyajctuldcBZog=', 1583293677),
(34, 'qqqwww@gmail.com', 'FI0iL5OduMRJtGiiinjuaFo6xsrcv1Fp1NUrLSkCJ3A=', 1583293851),
(37, 'rahmatibrahim141@gmail.com', 'KAn4DapdMOzQg0m6kXigrkTKh6vbBfVAX9qGATBtWq4=', 1584434428),
(38, 'rahmat@mail.com', 'hp3rM+hNge2yF+KpyxBXDU4xpJyfbBbhDuA83n2zz/M=', 1584435790),
(39, 'enjang@mail.com', 'F4C3+EBe+iR7rxvM8rDnZExXsX4yyaJdjKDcYWMHb5c=', 1585031693),
(40, 'enjang@mail.com', 'T4guFlfy9a1LEyILKXxKD+swvUrPZXM+Rt24lu888X0=', 1585032852),
(41, 'fanny@mail.com', '+oK1moiBP14bWrJ1sXE5zgdBpKp/qIk3NnzGOyewNc0=', 1585032906),
(42, 'kipli@mail.com', '8NJCohxvVzUt5TgF7KyfRn0kXYDGLVURipGbNpKQ8yk=', 1585034822),
(43, 'ersa@gmail.com', 'E1sIboh/q+YjMbXhb849WCt6TUwVd3G1fgzgWMQSiac=', 1586685825),
(44, 'fanny@gmail.com', 'CxR7Ofcm9xjrEKJhK6qBQWXRIXgfChFXCs7P0I9j2ec=', 1586685919),
(45, 'matt@mail.com', '/rr/QZqjlLjuLZf7ixD1wvIVoPBlrbapSQTLvoTwNF0=', 1586708436),
(46, 'rin@mail.com', 'AIrNB1ZgUuUrkSoytBOLHdRGTkQqu/VS/6B9T4hmC+0=', 1586711840),
(47, 'rin@mail.com', 'A5Eu3n3GGhY9vcjLEAIGsLlATlM1Sn8ZntNXAPeOCk4=', 1586752244);

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
  MODIFY `id_anggota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id_comment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- AUTO_INCREMENT for table `follow`
--
ALTER TABLE `follow`
  MODIFY `id_follow` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=168;

--
-- AUTO_INCREMENT for table `group_comment`
--
ALTER TABLE `group_comment`
  MODIFY `id_comment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `group_information`
--
ALTER TABLE `group_information`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `group_notif`
--
ALTER TABLE `group_notif`
  MODIFY `id_notif` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `group_postingan`
--
ALTER TABLE `group_postingan`
  MODIFY `id_posting` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `grup`
--
ALTER TABLE `grup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `hafalan`
--
ALTER TABLE `hafalan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `katmateri`
--
ALTER TABLE `katmateri`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `materi`
--
ALTER TABLE `materi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `menu_item`
--
ALTER TABLE `menu_item`
  MODIFY `id_menu_item` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id_notification` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=271;

--
-- AUTO_INCREMENT for table `pesan`
--
ALTER TABLE `pesan`
  MODIFY `id_pesan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `postgen`
--
ALTER TABLE `postgen`
  MODIFY `id_posting` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `posting`
--
ALTER TABLE `posting`
  MODIFY `id_posting` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=223;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `id_report` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `suka`
--
ALTER TABLE `suka`
  MODIFY `id_suka` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=180;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `trigger_user`
--
ALTER TABLE `trigger_user`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_token`
--
ALTER TABLE `user_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

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
  ADD CONSTRAINT `fk_idposting` FOREIGN KEY (`id_posting`) REFERENCES `group_postingan` (`id_posting`) ON DELETE CASCADE;

--
-- Constraints for table `group_information`
--
ALTER TABLE `group_information`
  ADD CONSTRAINT `fkIDGroup` FOREIGN KEY (`id_group`) REFERENCES `grup` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `group_postingan`
--
ALTER TABLE `group_postingan`
  ADD CONSTRAINT `fk_idGrup` FOREIGN KEY (`id_group`) REFERENCES `grup` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_idUser` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE;

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

DELIMITER $$
--
-- Events
--
CREATE DEFINER=`root`@`localhost` EVENT `backup_tubes` ON SCHEDULE EVERY 1 MINUTE STARTS '2020-04-13 11:23:30' ON COMPLETION NOT PRESERVE ENABLE DO CALL backup_pesan_comment_like()$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
