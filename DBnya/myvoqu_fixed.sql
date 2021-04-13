-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 13, 2021 at 03:50 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `myvoqu_fixed`
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `backup_semua_table` ()  begin

truncate table backup_tbs.user_token;
INSERT INTO backup_tbs.user_token(id, backup_date, email, token, date_created)
(SELECT id, now(), email, token, date_created FROM myvoqu_fixed.user_token);

truncate table backup_tbs.user_role;
INSERT INTO backup_tbs.user_role(id, backup_date, role)
(SELECT id, now(), role FROM myvoqu_fixed.user_role);

truncate table backup_tbs.suka;
INSERT INTO backup_tbs.suka(id_suka, backup_date, status, date, id_posting, id, id_tujuan)
(SELECT id_suka, now(), status, date, id_posting, id, id_tujuan FROM myvoqu_fixed.suka);

truncate table backup_tbs.report;
INSERT INTO backup_tbs.report(id_report, backup_date, report, date, id_posting, id_user)
(SELECT id_report, now(), report, date, id_posting, id_user FROM myvoqu_fixed.report);

truncate table backup_tbs.posting;
INSERT INTO backup_tbs.posting(id_posting, backup_date, caption, id_user, name, fileName, html, date_post)
(SELECT id_posting, now(), caption, id_user, name, fileName, html, date_post FROM myvoqu_fixed.posting);

truncate table backup_tbs.postgen;
INSERT INTO backup_tbs.postgen(id_posting, backup_date, caption, fileName, html, date_post, id_user)
(SELECT id_posting, now(), caption, fileName, html, date_post, id_user FROM myvoqu_fixed.postgen);

truncate table backup_tbs.pesan;
INSERT INTO backup_tbs.pesan(id_pesan, backup_date, id_pengirim, id_penerima, pesan, date, sudah_dibaca, image)
(SELECT id_pesan, now(), id_pengirim, id_penerima, pesan, date, sudah_dibaca, image FROM myvoqu_fixed.pesan);

truncate table backup_tbs.notification;
INSERT INTO backup_tbs.notification(id_notification, backup_date, notif, date, id_posting, id, id_tujuan)
(SELECT id_notification, now(), notif, date, id_posting, id, id_tujuan FROM myvoqu_fixed.notification);

truncate table backup_tbs.menu_item;
INSERT INTO backup_tbs.menu_item(id_menu_item, backup_date, icon, name_menu_item, link, id_menu)
(SELECT id_menu_item, now(), icon, name_menu_item, link, id_menu FROM myvoqu_fixed.menu_item);

truncate table backup_tbs.menu;
INSERT INTO backup_tbs.menu(id_menu, backup_date, title_menu)
(SELECT id_menu, now(), title_menu FROM myvoqu_fixed.menu);

truncate table backup_tbs.materi;
INSERT INTO backup_tbs.materi(id, backup_date, nama, id_surat, id_user, nama_mentor, filename, html, date_post)
(SELECT id, now(), nama, id_surat, id_user, nama_mentor, filename, html, date_post FROM myvoqu_fixed.materi);

truncate table backup_tbs.katmateri;
INSERT INTO backup_tbs.katmateri(id, backup_date, nama, arti, ayat, suratke)
(SELECT id, now(), nama, arti, ayat, suratke FROM myvoqu_fixed.katmateri);

truncate table backup_tbs.hafalan;
INSERT INTO backup_tbs.hafalan(id, backup_date, judul, id_user, id_group)
(SELECT id, now(), judul, id_user, id_group FROM myvoqu_fixed.hafalan);

truncate table backup_tbs.grup;
INSERT INTO backup_tbs.grup(id, backup_date, nama, deskripsi, image, owner)
(SELECT id, now(), nama, deskripsi, image, owner FROM myvoqu_fixed.grup);

truncate table backup_tbs.group_postingan;
INSERT INTO backup_tbs.group_postingan(id_posting, backup_date, caption, id_group, id_user, filename, html, date_post)
(SELECT id_posting, now(), caption, id_group, id_user, filename, html, date_post FROM myvoqu_fixed.group_postingan);

truncate table backup_tbs.group_notif;
INSERT INTO backup_tbs.group_notif(id_notif, backup_date, notif, id_group, id_user, date)
(SELECT id_notif, now(), notif, id_group, id_user, date FROM myvoqu_fixed.group_notif);

truncate table backup_tbs.group_comment;
INSERT INTO backup_tbs.group_comment(id_comment, backup_date, comment, id_posting, date, id_user)
(SELECT id_comment, now(), comment, id_posting, date, id_user FROM myvoqu_fixed.group_comment);

truncate table backup_tbs.group_information;
INSERT INTO backup_tbs.group_information(id, backup_date, info, id_group, id_user, date_post)
(SELECT id, now(), info, id_group, id_user, date_post FROM myvoqu_fixed.group_information);

truncate table backup_tbs.follow;
INSERT INTO backup_tbs.follow(id_follow, backup_date, stat, date, id_userfollow, id_usertarget, namatarget, biotarget, imagetarget)
(SELECT id_follow, now(), stat, date, id_userfollow, id_usertarget, namatarget, biotarget, imagetarget FROM myvoqu_fixed.follow);

truncate table backup_tbs.comment;
INSERT INTO backup_tbs.comment(id_comment, backup_date, comment, date, id_posting, id, id_tujuan)
(SELECT id_comment, now(), comment, date, id_posting, id, id_tujuan FROM myvoqu_fixed.comment);

truncate table backup_tbs.anggota;
INSERT INTO backup_tbs.anggota(id_anggota, backup_date, id_user, id_group)
(SELECT id_anggota, now(), id_user, id_group FROM myvoqu_fixed.anggota);

truncate table backup_tbs.user;
INSERT INTO backup_tbs.user(id, backup_date, name, gender, email, image, passsword, role_id, is_active, date_created, status, birthdate, city, bio, work, instansi, sertif, verified)
(SELECT id, now(), name, gender, email, image, passsword, role_id, is_active, date_created, status, birthdate, city, bio, work, instansi, sertif, verified FROM myvoqu_fixed.user);

end$$

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
(2, 'mantap', '1618282121', 231, 114, 114),
(3, 'Mantap', '1618289250', 234, 114, 117),
(5, 'test :roll: :roll:', '1618296007', 262, 114, 124);

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
-- Table structure for table `dompet`
--

CREATE TABLE `dompet` (
  `id_dompet` int(11) NOT NULL,
  `saldo` varchar(250) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dompet`
--

INSERT INTO `dompet` (`id_dompet`, `saldo`, `id_user`) VALUES
(2, '0', 129),
(3, '0', 130);

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
(1, 2, '1579687251', 89, 89, 'zalfaridzi', '', 'default.png'),
(2, 2, '1579687251', 90, 90, 'zalfaridzi', '', 'default.png'),
(3, 2, '1579687251', 91, 91, 'ADMIN - Zaki Al Faridzi', '', '731d9997-cc5d-4ffc-b1da-1ec8a7fe3198.jpg'),
(4, 2, '1617353653', 92, 92, 'Karyn Bender', 'Hello World!', 'default.png'),
(5, 2, '1617353929', 93, 93, 'Hedy Hale', 'Hello World!', 'default.png'),
(6, 2, '1617354021', 94, 94, 'Lareina Langley', 'Hello World!', 'default.png'),
(7, 2, '1617354269', 95, 95, 'Sydnee House', 'Hello World!', 'default.png'),
(8, 1, '1617354409', 95, 94, 'Lareina Langley', 'Hello World!', 'default.png'),
(9, 2, '1617354269', 96, 96, 'x', 'Hello World!', 'default.png'),
(10, 2, '1617355792', 97, 97, 'Sydney Harrington', 'Hello World!', 'default.png'),
(11, 2, '1617385297', 98, 98, 'Kim Houston', 'Hello World!', 'default.png'),
(12, 2, '1617456250', 99, 99, 'Sharon Calhoun', 'Hello World!', 'default.png'),
(13, 2, '1617466861', 100, 100, 'Jolene Owens', 'Hello World!', 'default.png'),
(14, 2, '1617934489', 101, 101, 'Galvin Winters', 'Hello World!', 'default.png'),
(15, 2, '1617934489', 102, 102, 'Cavin', 'Hello World!', 'default.png'),
(16, 1, '1617934603', 101, 102, 'Cavin', 'Hello World!', 'default.png'),
(17, 2, '1617936851', 103, 103, 'Lev Middleton', 'Hello World!', 'default.png'),
(18, 2, '1617936978', 104, 104, 'Lester Wilkins', 'Hello World!', 'default.png'),
(19, 2, '1617934489', 105, 105, 'Cavinz', 'Hello World!', 'default.png'),
(20, 2, '1617949310', 106, 106, 'Britanni Nixon', 'Hello World!', 'default.png'),
(21, 2, '1618034113', 107, 107, 'a', 'Hello World!', 'default.png'),
(22, 2, '1618116257', 108, 108, 'Kenneth Chapman', 'Hello World!', 'default.png'),
(23, 2, '1618116292', 109, 109, 'Uta Morales', 'Hello World!', 'default.png'),
(24, 2, '1579687251', 110, 110, 'zaki al faridzisx', '', 'dota_stars_wallpaper2.jpg'),
(25, 2, '1579687251', 111, 111, 'zaki al faridzix', '', 'dota_stars_wallpaper2.jpg'),
(26, 2, '1579687251', 112, 112, 'ADMIN - Abi', '', '677864.png'),
(27, 2, '1579687251', 113, 113, 'ADMIN - Helmi', '', '1-04-1068x601.jpg'),
(28, 2, '1618281554', 114, 114, 'Fydhia Helmi Ramadhan', 'Hello Myvoqu!', '6075504d4bb97.png'),
(29, 2, '1618281650', 115, 115, 'Shakilla Fara', 'Hello guys!', 'default_female.png'),
(30, 2, '1618281650', 116, 116, 'Endar Pariswara', 'Hello World!', 'default_female.png'),
(31, 2, '1618281554', 117, 117, 'Ilham Nur Ramadhan', 'Hello World!', 'default_male.png'),
(32, 2, '1618281796', 118, 118, 'Rahmat Ibrahim', 'Hello World!', 'default_male.png'),
(33, 2, '1618281796', 119, 119, 'Bagus Rogo Sukmo', 'Hello World!', 'default_male.png'),
(34, 2, '1618281796', 120, 120, 'Suci Ramadhani', 'Hello World!', 'default_female.png'),
(35, 2, '1618281796', 121, 121, 'Atikah Khairunnisa', 'Hello World!', 'default_female.png'),
(36, 1, '1618285014', 116, 115, 'Shakilla Fara', 'Hello guys!', 'default_female.png'),
(37, 1, '1618289022', 114, 117, 'Ilham Nur Ramadhan', 'Hello World!', 'default_male.png'),
(38, 1, '1618290083', 117, 114, 'Fydhia Helmi Ramadhan', 'Hello Myvoqu!', '6075504d4bb97.png'),
(39, 2, '1618281554', 122, 122, 'Ilham Nur Ramadhan', 'Hello World!', 'default_male.png'),
(40, 2, '1618281554', 123, 123, 'Ilham Nur Ramadhan', 'Hello Myvoqu!', 'default_male.png'),
(41, 1, '1618291263', 123, 114, 'Fydhia Helmi Ramadhan', 'Hello Myvoqu!', '6075504d4bb97.png'),
(42, 2, '1618295098', 124, 124, 'Muhammad Abizard', 'Saya adalah mahasiswa Telkom University', '60753aa2eab37.jpg'),
(43, 1, '1618295813', 124, 114, 'Fydhia Helmi Ramadhan', 'Hello Myvoqu!', '6075504d4bb97.png'),
(44, 1, '1618295979', 114, 124, 'Muhammad Abizard', 'Saya adalah mahasiswa Telkom University', '60753aa2eab37.jpg'),
(45, 2, '1618296488', 125, 125, 'Ustad Hanif', 'Hello World!', 'default_male.png'),
(46, 1, '1618297462', 114, 123, 'Ilham Nur Ramadhan', 'Hello Myvoqu!', 'default_male.png'),
(47, 2, '1618298702', 126, 126, 'Muhammad Abizard', 'Hello World!', 'default_female.png'),
(48, 2, '1618306081', 127, 127, 'Muhammad Abizard', 'Hello World!', 'default_male.png'),
(49, 2, '1618306081', 128, 128, 'Ustad Abizard', 'Hello World!', 'default_male.png'),
(50, 2, '1618314853', 129, 129, 'Muhammad Abizard', 'Hello World!', 'default_male.png'),
(51, 2, '1618319213', 129, 114, 'Fydhia Helmi Ramadhan', 'Hello Myvoqu!', '6075504d4bb97.png'),
(52, 2, '1618314853', 130, 130, 'Muhammad Abizard', 'Hello World!', 'default_male.png');

--
-- Triggers `follow`
--
DELIMITER $$
CREATE TRIGGER `after_penghafal_follow` AFTER INSERT ON `follow` FOR EACH ROW BEGIN
INSERT INTO notification
SET notif='Mulai Mengikuti Anda.',
id_posting= 0,
id = new.id_userfollow,
date = new.date,
id_tujuan = new.id_usertarget;
end
$$
DELIMITER ;

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
(1, 'Joined This Group', 26, 102, '2021-04-09 10:01:21'),
(2, 'Joined This Group', 26, 101, '2021-04-09 10:01:24'),
(3, 'Joined This Group', 28, 102, '2021-04-09 21:14:08'),
(4, 'Kicked From This Group', 26, 101, '2021-04-11 01:24:25'),
(5, 'Joined This Group', 29, 114, '2021-04-13 11:25:28'),
(6, 'Joined This Group', 29, 117, '2021-04-13 11:25:30'),
(7, 'Kicked From This Group', 29, 117, '2021-04-13 12:17:30'),
(8, 'Joined This Group', 29, 123, '2021-04-13 12:24:21'),
(9, 'Joined This Group', 30, 114, '2021-04-13 13:41:48'),
(10, 'Kicked From This Group', 30, 114, '2021-04-13 13:41:59'),
(11, 'Joined This Group', 30, 114, '2021-04-13 13:42:06'),
(12, 'Posted on Timeline', 30, 114, '2021-04-13 13:42:22'),
(13, 'Announce Information', 30, 118, '2021-04-13 13:43:09'),
(14, 'Joined This Group', 30, 123, '2021-04-13 14:11:00'),
(15, 'Posted on Timeline', 30, 123, '2021-04-13 14:14:45');

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

-- --------------------------------------------------------

--
-- Table structure for table `infaq`
--

CREATE TABLE `infaq` (
  `id_infaq` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `nominal` varchar(250) NOT NULL,
  `tanggal_infaq` date NOT NULL DEFAULT current_timestamp(),
  `id_user_infaq` int(11) NOT NULL,
  `id_mentor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(4, 'Al-Fatihah', 'Pembukaan', 7, 1),
(5, 'Al Annas', 'Manusia', 4, 113);

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
(13, 'Pembacaan ayat satu', 4, 118, '6075133bcfd57.mp4', '<div class=\"video-wrapper\"><video class=\"post-video\" controls><source src= http://localhost/myvoqu/assets_user/file_upload/6075133bcfd57.mp4 type=\"video/mp4\"></video></div>', '2021-04-13 10:42:51'),
(14, 'Pembacaan ayat dua', 4, 118, '607513fb41087.mp4', '<div class=\"video-wrapper\"><video class=\"post-video\" controls><source src= http://localhost/myvoqu/assets_user/file_upload/607513fb41087.mp4 type=\"video/mp4\"></video></div>', '2021-04-13 10:47:51'),
(15, 'Pembacaan ayat tiga', 4, 118, '60751ef29ca55.mp4', '<div class=\"video-wrapper\"><video class=\"post-video\" controls><source src= http://localhost/myvoqu/assets_user/file_upload/60751ef29ca55.mp4 type=\"video/mp4\"></video></div>', '2021-04-13 11:32:50'),
(16, 'Ayat 1 An Nas', 5, 118, '60753dcc2965e.mp4', '<div class=\"video-wrapper\"><video class=\"post-video\" controls><source src= http://localhost/myvoqu/assets_user/file_upload/60753dcc2965e.mp4 type=\"video/mp4\"></video></div>', '2021-04-13 13:44:28');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id_menu` int(11) NOT NULL,
  `title_menu` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(276, 'like on your post', '', 226, 94, 0),
(277, 'comment on your post: \" ;-) ;-)\"', '1617354191', 226, 94, 94),
(278, 'delete comment on your post: \" ;-) ;-)\"', '1617354191', 226, 94, 94),
(279, 'unlike on your post', '1617354197', 226, 94, 0),
(280, 'unlike on your post', '1617354200', 226, 94, 0),
(281, 'unlike on your post', '1617354203', 226, 94, 0),
(282, 'like on your post', '', 227, 95, 0),
(283, 'like on your post', '', 228, 94, 0),
(284, 'like on your post', '', 229, 97, 0),
(285, 'like on your post', '', 230, 102, 0),
(286, 'like on your post', '', 231, 114, 0),
(287, 'comment on your post: \"mantap\"', '1618282121', 231, 114, 114),
(288, 'like on your post', '', 232, 116, 0),
(289, 'unlike on your post', '1618284998', 232, 116, 0),
(290, 'unlike on your post', '1618285000', 232, 116, 0),
(291, 'Mulai Mengikuti Anda.', '1618285014', 0, 116, 115),
(292, 'like on your post', '', 233, 118, 0),
(293, 'Mulai Mengikuti Anda.', '1618289022', 0, 114, 117),
(294, 'like on your post', '', 234, 117, 0),
(295, 'like on your post', '1618289239', 234, 114, 117),
(296, 'unlike on your post', '1618289242', 234, 114, 0),
(297, 'comment on your post: \"Mantap\"', '1618289250', 234, 114, 117),
(298, 'like on your post', '', 235, 114, 0),
(299, 'like on your post', '', 236, 114, 0),
(300, 'like on your post', '', 237, 114, 0),
(301, 'like on your post', '', 238, 114, 0),
(302, 'like on your post', '', 239, 114, 0),
(303, 'like on your post', '', 240, 114, 0),
(304, 'like on your post', '', 241, 114, 0),
(305, 'like on your post', '', 242, 114, 0),
(306, 'like on your post', '', 243, 114, 0),
(307, 'like on your post', '', 244, 114, 0),
(308, 'Mulai Mengikuti Anda.', '1618290083', 0, 117, 114),
(309, 'Mulai Mengikuti Anda.', '1618281554', 0, 122, 122),
(310, 'Mulai Mengikuti Anda.', '1618281554', 0, 123, 123),
(311, 'Mulai Mengikuti Anda.', '1618291263', 0, 123, 114),
(312, 'like on your post', '', 246, 123, 0),
(313, 'like on your post', '', 247, 119, 0),
(314, 'like on your post', '', 248, 119, 0),
(315, 'like on your post', '', 249, 119, 0),
(316, 'like on your post', '', 250, 119, 0),
(317, 'like on your post', '', 251, 114, 0),
(318, 'like on your post', '', 252, 114, 0),
(319, 'like on your post', '', 253, 114, 0),
(320, 'like on your post', '', 254, 114, 0),
(321, 'like on your post', '', 255, 114, 0),
(322, 'like on your post', '', 256, 114, 0),
(323, 'like on your post', '', 257, 114, 0),
(324, 'like on your post', '', 258, 114, 0),
(325, 'like on your post', '', 259, 114, 0),
(326, 'like on your post', '', 260, 114, 0),
(327, 'Mulai Mengikuti Anda.', '1618295098', 0, 124, 124),
(328, 'like on your post', '', 261, 124, 0),
(329, 'like on your post', '', 262, 124, 0),
(330, 'unlike on your post', '1618295760', 262, 124, 0),
(331, 'unlike on your post', '1618295766', 262, 124, 0),
(332, 'comment on your post: \"bagus nih :lol: :lol:\"', '1618295782', 262, 124, 124),
(333, 'delete comment on your post: \"bagus nih :lol: :lol:\"', '1618295782', 262, 124, 124),
(334, 'Mulai Mengikuti Anda.', '1618295813', 0, 124, 114),
(335, 'Mulai Mengikuti Anda.', '1618295830', 0, 114, 124),
(336, 'like on your post', '1618296000', 262, 114, 124),
(337, 'comment on your post: \"test :roll: :roll:\"', '1618296007', 262, 114, 124),
(338, 'Mulai Mengikuti Anda.', '1618296488', 0, 125, 125),
(339, 'like on your post', '', 263, 125, 0),
(340, 'Mulai Mengikuti Anda.', '1618297462', 0, 114, 123),
(341, 'like on your post', '', 264, 114, 0),
(342, 'like on your post', '', 265, 114, 0),
(343, 'like on your post', '', 266, 114, 0),
(344, 'like on your post', '', 267, 114, 0),
(345, 'like on your post', '', 268, 123, 0),
(346, 'like on your post', '', 269, 114, 0),
(347, 'Mulai Mengikuti Anda.', '1618298702', 0, 126, 126),
(348, 'like on your post', '', 270, 126, 0),
(349, 'like on your post', '', 271, 126, 0),
(350, 'Mulai Mengikuti Anda.', '1618306081', 0, 127, 127),
(351, 'Mulai Mengikuti Anda.', '1618306081', 0, 128, 128),
(352, 'Mulai Mengikuti Anda.', '1618314853', 0, 129, 129),
(353, 'Mulai Mengikuti Anda.', '1618319188', 0, 129, 114),
(354, 'Mulai Mengikuti Anda.', '1618314853', 0, 130, 130);

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
(48, 114, 124, 'hallo abizard  :-) :-)', 1618295943, 'belum', ''),
(49, 124, 114, 'hallo juga helmi :-P :-P', 1618295962, 'belum', '');

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
(54, 0, '', 226, 94),
(55, 0, '', 227, 95),
(56, 0, '', 228, 94),
(57, 0, '', 229, 97),
(58, 0, '', 230, 102),
(59, 0, '', 231, 114),
(60, 0, '', 232, 116),
(61, 0, '', 233, 118),
(62, 0, '', 234, 117),
(63, 0, '', 235, 114),
(64, 0, '', 236, 114),
(65, 0, '', 237, 114),
(66, 0, '', 238, 114),
(67, 0, '', 239, 114),
(68, 0, '', 240, 114),
(69, 0, '', 241, 114),
(70, 0, '', 242, 114),
(71, 0, '', 243, 114),
(72, 0, '', 244, 114),
(73, 1, '1618290086', 244, 117),
(74, 0, '', 246, 123),
(75, 0, '', 247, 119),
(76, 0, '', 248, 119),
(77, 0, '', 249, 119),
(78, 0, '', 250, 119),
(79, 0, '', 251, 114),
(80, 0, '', 252, 114),
(81, 0, '', 253, 114),
(82, 0, '', 254, 114),
(83, 0, '', 255, 114),
(84, 0, '', 256, 114),
(85, 0, '', 257, 114),
(86, 0, '', 258, 114),
(87, 0, '', 259, 114),
(88, 0, '', 260, 114),
(89, 0, '', 261, 124),
(90, 0, '', 262, 124),
(91, 1, '1618295845', 262, 114),
(92, 0, '', 263, 125),
(93, 0, '', 264, 114),
(94, 0, '', 265, 114),
(95, 0, '', 266, 114),
(96, 0, '', 267, 114),
(97, 0, '', 268, 123),
(98, 0, '', 269, 114),
(99, 0, '', 270, 126),
(100, 0, '', 271, 126);

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
(183, 1, '1617354203', 226, 94, 0),
(184, 2, '', 227, 95, 0),
(185, 2, '', 228, 94, 0),
(186, 2, '', 229, 97, 0),
(187, 2, '', 230, 102, 0),
(188, 2, '', 231, 114, 0),
(189, 2, '1618285000', 232, 116, 0),
(190, 2, '', 233, 118, 0),
(191, 2, '', 234, 117, 0),
(192, 2, '1618289242', 234, 114, 0),
(193, 2, '', 235, 114, 0),
(194, 2, '', 236, 114, 0),
(195, 2, '', 237, 114, 0),
(196, 2, '', 238, 114, 0),
(197, 2, '', 239, 114, 0),
(198, 2, '', 240, 114, 0),
(199, 2, '', 241, 114, 0),
(200, 2, '', 242, 114, 0),
(201, 2, '', 243, 114, 0),
(202, 2, '', 244, 114, 0),
(203, 2, '', 246, 123, 0),
(204, 2, '', 247, 119, 0),
(205, 2, '', 248, 119, 0),
(206, 2, '', 249, 119, 0),
(207, 2, '', 250, 119, 0),
(208, 2, '', 251, 114, 0),
(209, 2, '', 252, 114, 0),
(210, 2, '', 253, 114, 0),
(211, 2, '', 254, 114, 0),
(212, 2, '', 255, 114, 0),
(213, 2, '', 256, 114, 0),
(214, 2, '', 257, 114, 0),
(215, 2, '', 258, 114, 0),
(216, 2, '', 259, 114, 0),
(217, 2, '', 260, 114, 0),
(218, 2, '', 261, 124, 0),
(219, 2, '1618295766', 262, 124, 0),
(220, 1, '1618296000', 262, 114, 124),
(221, 2, '', 263, 125, 0),
(222, 2, '', 264, 114, 0),
(223, 2, '', 265, 114, 0),
(224, 2, '', 266, 114, 0),
(225, 2, '', 267, 114, 0),
(226, 2, '', 268, 123, 0),
(227, 2, '', 269, 114, 0),
(228, 2, '', 270, 126, 0),
(229, 2, '', 271, 126, 0);

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
(45, 'Cek data-data penghafal hari ini', 1, 0),
(46, 'Verifikasi mentor yang baru', 0, 0),
(47, 'Unggah materi umum', 1, 0),
(48, 'Lakukan Aktivasi Penghafal', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_topup_wallet`
--

CREATE TABLE `transaksi_topup_wallet` (
  `id_transaksi` int(11) NOT NULL,
  `nominal` varchar(250) NOT NULL,
  `bukti_bayar` varchar(250) NOT NULL,
  `tanggal_transaksi` date NOT NULL DEFAULT current_timestamp(),
  `id_dompet` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksi_topup_wallet`
--

INSERT INTO `transaksi_topup_wallet` (`id_transaksi`, `nominal`, `bukti_bayar`, `tanggal_transaksi`, `id_dompet`) VALUES
(1, '100000', '6075939d0f15d.jpg', '2021-04-13', 2),
(2, '500000', '60759721243b4.jpg', '2021-04-13', 2);

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
(60, 94, 'Proident quis id qu', '', 0, 'Ada yang baru delete posting', '2021-04-02 16:31:23'),
(61, 91, 'zalfaridzi', 'jaki@gmail.com', 1, 'zalfaridzi yang baru melakukan update profile menjadi Zaki Al Faridzi', '2021-04-09 09:17:53'),
(62, 91, 'Zaki Al Faridzi', 'jaki@gmail.com', 1, 'Zaki Al Faridzi yang baru melakukan update profile menjadi zalfaridzi', '2021-04-09 23:37:52'),
(63, 91, 'zalfaridzi', 'jaki@gmail.com', 1, 'zalfaridzi yang baru melakukan update profile menjadi zalfaridzix', '2021-04-11 00:21:31'),
(64, 91, 'zalfaridzix', 'jaki@gmail.com', 1, 'zalfaridzix yang baru melakukan update profile menjadi zalfaridzi', '2021-04-11 01:23:52'),
(65, 97, 'mario', '', 0, 'Ada yang baru delete posting', '2021-04-11 01:24:39'),
(66, 91, 'zalfaridzi', 'jaki@gmail.com', 1, 'zalfaridzi yang baru melakukan update profile menjadi zakialfaridzi', '2021-04-11 12:00:23'),
(67, 91, 'zakialfaridzi', 'jaki@gmail.com', 1, 'zakialfaridzi yang baru melakukan update profile menjadi zaki al faridzi', '2021-04-11 12:00:35'),
(68, 91, 'zaki al faridzi', 'jaki@gmail.com', 1, 'zaki al faridzi yang baru melakukan update profile menjadi zaki al faridzis', '2021-04-11 12:27:14'),
(69, 91, 'zaki al faridzis', 'jaki@gmail.com', 1, 'zaki al faridzis yang baru melakukan update profile menjadi zaki al faridzisx', '2021-04-11 13:44:24'),
(70, 91, 'zaki al faridzisx', 'jaki@gmail.com', 1, 'zaki al faridzisx yang baru melakukan update profile menjadi zaki al faridzisxg', '2021-04-11 13:44:31'),
(71, 91, 'zaki al faridzisxg', 'jaki@gmail.com', 1, 'zaki al faridzisxg yang baru melakukan update profile menjadi zaki al faridzi', '2021-04-11 13:57:29'),
(72, 111, 'zaki al faridzix', 'jakix@gmail.com', 1, 'zaki al faridzix yang baru melakukan update profile menjadi ADMIN - Matt', '2021-04-11 15:03:46'),
(73, 91, 'zaki al faridzi', 'jaki@gmail.com', 1, 'zaki al faridzi yang baru melakukan update profile menjadi ADMIN - Zaki', '2021-04-11 15:05:18'),
(74, 91, 'ADMIN - Zaki', 'jaki@gmail.com', 1, 'ADMIN - Zaki yang baru melakukan update profile menjadi ADMIN - Zakixasdas', '2021-04-12 01:05:21'),
(75, 91, 'ADMIN - Zakixasdas', 'jaki@gmail.com', 1, 'ADMIN - Zakixasdas yang baru melakukan update profile menjadi ADMIN - Zaki', '2021-04-12 01:12:50'),
(76, 102, 'asda', '', 0, 'Ada yang baru delete posting', '2021-04-12 01:31:53'),
(77, 91, 'ADMIN - Zaki', 'jaki@gmail.com', 1, 'ADMIN - Zaki yang baru melakukan update profile menjadi ADMIN - Zakix', '2021-04-12 20:23:30'),
(78, 91, 'ADMIN - Zakix', 'jaki@gmail.com', 1, 'ADMIN - Zakix yang baru melakukan update profile menjadi ADMIN - Zaki', '2021-04-12 20:23:49'),
(79, 114, 'mari mengaji di bulan puasa', '', 0, 'Ada yang baru delete posting', '2021-04-13 10:27:21'),
(80, 116, 'Mari mengaji kawan', '', 0, 'Ada yang baru delete posting', '2021-04-13 11:42:28'),
(81, 118, 'Yuk ngaji bersama taqy malik', '', 0, 'Ada yang baru delete posting', '2021-04-13 11:42:35'),
(82, 114, 'tes', '', 0, 'Ada yang baru delete posting', '2021-04-13 11:48:51'),
(83, 114, 'tes', '', 0, 'Ada yang baru delete posting', '2021-04-13 11:49:22'),
(84, 114, 'tes', '', 0, 'Ada yang baru delete posting', '2021-04-13 11:51:05'),
(85, 114, 'tes', '', 0, 'Ada yang baru delete posting', '2021-04-13 11:53:50'),
(86, 114, 'asdasd', '', 0, 'Ada yang baru delete posting', '2021-04-13 11:54:42'),
(87, 114, 'tes', '', 0, 'Ada yang baru delete posting', '2021-04-13 11:56:39'),
(88, 114, 'tes', '', 0, 'Ada yang baru delete posting', '2021-04-13 11:58:01'),
(89, 117, 'Mari ngaji di bulan puasa', '', 0, 'Ada yang baru delete posting', '2021-04-13 11:58:33'),
(90, 114, 'Mari mengaji', '', 0, 'Ada yang baru delete posting', '2021-04-13 11:59:27'),
(91, 114, 'Ngaji yuk', '', 0, 'Ada yang baru delete posting', '2021-04-13 11:59:49'),
(92, 123, 'Ngaji bersama MyVoQu', '', 0, 'Ada yang baru delete posting', '2021-04-13 12:21:55'),
(93, 119, 'Yuk ngaji bareng Ustad Hannan Attaki', '', 0, 'Ada yang baru delete posting', '2021-04-13 12:27:56'),
(94, 119, 'seru', '', 0, 'Ada yang baru delete posting', '2021-04-13 12:34:05'),
(95, 119, 'Yuk ngaji bareng ustad taqy', '', 0, 'Ada yang baru delete posting', '2021-04-13 12:34:11'),
(96, 119, 'Bagus buat referensi mengaji', '', 0, 'Ada yang baru delete posting', '2021-04-13 12:48:49'),
(97, 114, 'Ngaji yuk', '', 0, 'Ada yang baru delete posting', '2021-04-13 12:55:09'),
(98, 114, 'Yuk ngaji bareng', '', 0, 'Ada yang baru delete posting', '2021-04-13 12:55:29'),
(99, 114, 'tes', '', 0, 'Ada yang baru delete posting', '2021-04-13 12:56:01'),
(100, 114, 'z', '', 0, 'Ada yang baru delete posting', '2021-04-13 12:56:15'),
(101, 114, 'tes', '', 0, 'Ada yang baru delete posting', '2021-04-13 12:59:35'),
(102, 114, 'tes', '', 0, 'Ada yang baru delete posting', '2021-04-13 13:00:07'),
(103, 114, 'adasdas', '', 0, 'Ada yang baru delete posting', '2021-04-13 13:03:37'),
(104, 114, 'adasdas', '', 0, 'Ada yang baru delete posting', '2021-04-13 13:03:43'),
(105, 114, 'bismillah', '', 0, 'Ada yang baru delete posting', '2021-04-13 13:04:26'),
(106, 114, '', '', 0, 'Ada yang baru delete posting', '2021-04-13 13:07:07'),
(107, 114, '', '', 0, 'Ada yang baru delete posting', '2021-04-13 13:08:06'),
(108, 124, 'Surat Al Muazammil 17', '', 0, 'Ada yang baru delete posting', '2021-04-13 13:28:39'),
(109, 124, 'Muhammad Abizard Al Thareq', 'abizard@student.telkomuniversity.ac.id', 2, 'Muhammad Abizard Al Thareq yang baru melakukan update profile menjadi Muhammad Abizard', '2021-04-13 13:31:50'),
(110, 91, 'ADMIN - Zaki', 'jaki@gmail.com', 1, 'ADMIN - Zaki yang baru melakukan update profile menjadi ADMIN - Zaki Al Faridzi', '2021-04-13 13:53:38'),
(111, 114, '', '', 0, 'Ada yang baru delete posting', '2021-04-13 15:00:04'),
(112, 126, '', '', 0, 'Ada yang baru delete posting', '2021-04-13 16:02:29');

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
  `instansi` varchar(128) DEFAULT NULL,
  `sertif` varchar(500) NOT NULL,
  `verified` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `gender`, `email`, `image`, `passsword`, `role_id`, `is_active`, `date_created`, `status`, `birthdate`, `city`, `bio`, `work`, `instansi`, `sertif`, `verified`) VALUES
(129, 'Muhammad Abizard', 'Male', 'abizard@student.telkomuniversity.ac.id', 'default_male.png', '$2y$10$xP4idTclGpLn6GTn6zGkQOs26IwtkyEm6xvR4cwPjyqdC1cvxVYZW', 2, 1, 1618314853, 'online-dot', '0000-00-00', '', 'Hello World!', '', NULL, '', 0),
(130, 'Muhammad Abizard', 'Male', 'abizard@student.telkomuniversity.ac.id', 'default_male.png', '$2y$10$xP4idTclGpLn6GTn6zGkQOs26IwtkyEm6xvR4cwPjyqdC1cvxVYZW', 3, 1, 1618314853, 'online-dot', '0000-00-00', '', 'Hello World!', '', NULL, '', 0);

--
-- Triggers `user`
--
DELIMITER $$
CREATE TRIGGER `after_penghafal_editprofile` AFTER UPDATE ON `user` FOR EACH ROW BEGIN
UPDATE follow
SET namatarget = new.name,
biotarget = new.bio,
imagetarget = new.image
WHERE id_usertarget = new.id;
end
$$
DELIMITER ;
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
CREATE TRIGGER `after_user_register` AFTER INSERT ON `user` FOR EACH ROW BEGIN
INSERT into dompet
SET saldo = 0,
id_user = new.id;
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
(53, 'zoqulo@mailinator.com', 'KwE1Vj2nkeevz0IPN9cmWTxm5UIpC1Q52h6fk07Acpk=', 1617353929),
(56, 'ixztwylglfttdxfeir@twzhhq.online', '5d3FayHp7l125yVyEDADnJjdkhdy33C2CXoW9oEpCrI=', 1617456321),
(58, 'qykobeny@mailinator.com', 'shVEjXzVU8YkMG+Y69kx0HKKNL5aO/P5IOQbsSeTNz4=', 1617934489),
(60, 'muxorojory@mailinator.com', '7POzrDwxZvf7qTOwTolzGqV3O7WKMtQiin2sWz2DBWY=', 1617936984),
(61, 'pykidahu@mailinator.com', 'ynWvo1REKHP/5969p4/t50HZO+IVy7XQXNX7ZbrH0kY=', 1618034013),
(63, 'kwzgjzecpelufjgsuz@kiabws.com', 'GovL1RzLeOKHDASSglIWIIsUS36h9smOXNzbmfihF6Q=', 1618116257),
(64, 'sledgesix6@gmail.com', '6IStnFg/irTKQ+mCzONWiCYGvSTFfWN4DQk5f5buc8o=', 1618116292),
(68, 'fydhia@gmail.com', 'Ofury0ZKsmtFY22hoBWIFheKX7Qw7z4PMxbTJ6rV1NQ=', 1618281554),
(69, 'fara@gmail.com', '3fjzV5GwfHaorWor53dY38DCYxeARNk52RYVmYKaLAg=', 1618281650),
(70, 'rahmat@gmail.com', '/Ol6TjQUaPuL8+9BMWuO4UmGptXtnNh3nTKbF+HCqHc=', 1618281865),
(74, 'superadmin@mail.com', 'Z4k+A6Ko3MisXoZMztx1ssPnptOwXGZW4qT/bzNrj3k=', 1618298702);

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
-- Indexes for table `dompet`
--
ALTER TABLE `dompet`
  ADD PRIMARY KEY (`id_dompet`);

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
-- Indexes for table `infaq`
--
ALTER TABLE `infaq`
  ADD PRIMARY KEY (`id_infaq`);

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
-- Indexes for table `transaksi_topup_wallet`
--
ALTER TABLE `transaksi_topup_wallet`
  ADD PRIMARY KEY (`id_transaksi`);

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
  MODIFY `id_anggota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id_comment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `dompet`
--
ALTER TABLE `dompet`
  MODIFY `id_dompet` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `follow`
--
ALTER TABLE `follow`
  MODIFY `id_follow` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `group_comment`
--
ALTER TABLE `group_comment`
  MODIFY `id_comment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `group_information`
--
ALTER TABLE `group_information`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `group_notif`
--
ALTER TABLE `group_notif`
  MODIFY `id_notif` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `group_postingan`
--
ALTER TABLE `group_postingan`
  MODIFY `id_posting` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `grup`
--
ALTER TABLE `grup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `hafalan`
--
ALTER TABLE `hafalan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `infaq`
--
ALTER TABLE `infaq`
  MODIFY `id_infaq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `katmateri`
--
ALTER TABLE `katmateri`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `materi`
--
ALTER TABLE `materi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

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
  MODIFY `id_notification` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=355;

--
-- AUTO_INCREMENT for table `pesan`
--
ALTER TABLE `pesan`
  MODIFY `id_pesan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `postgen`
--
ALTER TABLE `postgen`
  MODIFY `id_posting` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `posting`
--
ALTER TABLE `posting`
  MODIFY `id_posting` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=272;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `id_report` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `suka`
--
ALTER TABLE `suka`
  MODIFY `id_suka` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=230;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `transaksi_topup_wallet`
--
ALTER TABLE `transaksi_topup_wallet`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `trigger_user`
--
ALTER TABLE `trigger_user`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_token`
--
ALTER TABLE `user_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

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

DELIMITER $$
--
-- Events
--
CREATE DEFINER=`root`@`localhost` EVENT `backup_tubes_myvoqu` ON SCHEDULE EVERY 1 MINUTE STARTS '2020-04-02 14:53:25' ON COMPLETION NOT PRESERVE ENABLE DO CALL backup_semua_tabel()$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
