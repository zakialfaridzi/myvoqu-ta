-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 09, 2021 at 12:57 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.4.19

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
-- Dumping data for table `anggota`
--

INSERT INTO `anggota` (`id_anggota`, `id_user`, `id_group`) VALUES
(13, 144, 40),
(14, 146, 40),
(15, 151, 41),
(16, 147, 42),
(17, 144, 43),
(18, 147, 43),
(19, 154, 42),
(20, 149, 42);

--
-- Triggers `anggota`
--
DELIMITER $$
CREATE TRIGGER `after_penghafal_join` AFTER INSERT ON `anggota` FOR EACH ROW BEGIN
INSERT INTO group_notif
SET notif='Telah Bergabung',
id_group= new.id_group,
id_user = new.id_user,
date = now();
end
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_penghafal_kick` AFTER DELETE ON `anggota` FOR EACH ROW BEGIN
INSERT INTO group_notif
SET notif='Telah Dikeluarkan',
id_group= old.id_group,
id_user = old.id_user,
date = now();
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `chatall`
--

CREATE TABLE `chatall` (
  `id` int(11) NOT NULL,
  `message` text NOT NULL,
  `from` varchar(128) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `chatall`
--

INSERT INTO `chatall` (`id`, `message`, `from`, `created`, `id_user`) VALUES
(12, 'haii semua', 'Asep Sudasep', '2021-06-07 08:23:10', 144),
(13, 'iya kenapa sep?', 'Surya Nurhalimah', '2021-06-07 08:23:36', 146),
(14, 'hei', 'Ustad Zaki', '2021-06-08 21:42:37', 165);

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
(5, 'test :roll: :roll:', '1618296007', 262, 114, 124),
(8, 'Merdu Sekali Pak Surya', '1623074562', 297, 144, 146),
(9, 'Merdeka!!', '1623074585', 296, 144, 146),
(10, 'Semangat Pak Asepp!!', '1623074616', 294, 144, 146),
(11, 'Subhannallah', '1623074639', 299, 144, 147),
(12, 'Wah Pak Nurdin memang berbakat! :cheese:', '1623074700', 298, 144, 147),
(13, 'Terimakasih pak Asep :red:', '1623074780', 297, 146, 146),
(14, 'Allahuakbar!!', '1623074827', 296, 146, 146),
(15, 'Wah suaranya bikin saya minder Pak', '1623074894', 292, 146, 144),
(16, 'Tiasa ngabimbing putra abdi pak?', '1623074938', 291, 146, 144),
(17, 'salah fokus ka sajadahna saee pisann :)', '1623074996', 290, 146, 144),
(18, 'Saee pisann', '1623075038', 299, 146, 147),
(19, 'wah tiasa ngabentuk kapal kitu, berbakat Pak  :cheese:', '1623075093', 298, 146, 147),
(20, 'Haturnuhun sadayana! :red: :-)', '1623075155', 299, 147, 147),
(21, 'Barade didamelkeun?', '1623075208', 298, 147, 147),
(22, 'Lanjutkan pak!', '1623075254', 292, 147, 144),
(23, 'Estetik mun ceuk barudak ayenamah :lol:', '1623075306', 290, 147, 144),
(24, 'Tarikan ah suarana, merdu ulah dilaun laun', '1623075400', 297, 147, 146),
(25, 'Wariskeun kang suantena ka abdi', '1623075606', 292, 154, 144),
(26, 'bismillah  :-)', '1623236093', 304, 150, 145);

--
-- Triggers `comment`
--
DELIMITER $$
CREATE TRIGGER `after_penghafal_delete_comment` AFTER DELETE ON `comment` FOR EACH ROW BEGIN
INSERT INTO backup_tubes.backup_comment_delete
SET aksi='Hapus Komentar',
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
(13, '0', 138),
(19, '50000', 144),
(20, '0', 145),
(21, '0', 146),
(22, '0', 147),
(23, '0', 148),
(24, '0', 149),
(25, '0', 150),
(26, '0', 151),
(27, '0', 152),
(28, '0', 153),
(29, '0', 154),
(30, '50000', 155),
(31, '0', 156),
(32, '0', 157),
(33, '0', 158),
(34, '0', 159),
(35, '0', 160),
(36, '0', 161),
(37, '0', 162),
(38, '0', 163),
(39, '0', 164),
(40, '0', 165);

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
(50, 2, '1618314853', 129, 129, 'Muhammad Abizard', 'Hello World!', '6075a3c8b2c47.jpg'),
(51, 2, '1618319213', 129, 114, 'Fydhia Helmi Ramadhan', 'Hello Myvoqu!', '6075504d4bb97.png'),
(52, 2, '1618314853', 130, 130, 'Ustad Abi', 'Hello World!', 'default_male.png'),
(53, 2, '1618314853', 131, 131, 'ADMIN - Zaki', 'Hello World!', 't128olv9kli61.png'),
(54, 2, '1618382009', 132, 132, 'Muhammad Abizard', 'Hello World!', 'default_male.png'),
(55, 2, '1618382086', 133, 133, 'Muhammad Abizardaa', 'Hello World!', 'default_male.png'),
(56, 2, '1618314853', 134, 134, 'Muhammad Haitsam', 'Hello World!', '6075a3c8b2c47.jpg'),
(57, 1, '1618396759', 134, 129, 'Muhammad Abizard', 'Hello World!', '6075a3c8b2c47.jpg'),
(58, 2, '1618314853', 135, 135, 'Ustad Haitsam', 'Hello World!', 'default_male.png'),
(59, 2, '1618314853', 136, 136, 'Muhammad Abizard', 'Hello World!', '6075a3c8b2c47.jpg'),
(60, 2, '1618314853', 137, 137, 'Ustad Haitsam', 'Hello World!', 'default_male.png'),
(61, 2, '1618314853', 138, 138, 'ADMIN - ABI', 'Hello World!', 'v.png'),
(62, 2, '1621314609', 139, 139, 'Ustad Mori', 'Hello World!', 'default_male.png'),
(63, 2, '1618314853', 140, 140, 'Muhammad Abizardx', 'Hello World!', '6075a3c8b2c47.jpg'),
(64, 2, '1622362432', 141, 141, 'Ustad Abel', 'Hello World!', 'default_male.png'),
(65, 1, '1622366761', 141, 129, 'Muhammad Abizard', 'Hello World!', '6075a3c8b2c47.jpg'),
(66, 2, '1622987385', 142, 142, 'Ustad Ais', 'Hello World!', 'default_male.png'),
(67, 2, '1622989159', 143, 143, 'Asep Sudasep', 'Hello World!', 'default_male.png'),
(68, 2, '1622989228', 144, 144, 'Asep Sudasep', 'Hello World!', 'default_male.png'),
(69, 2, '1622989284', 145, 145, 'Endar Parisian', 'Hello World!', 'default_female.png'),
(70, 2, '1622989334', 146, 146, 'Surya Nurhalimah', 'Hello World!', 'default_male.png'),
(71, 2, '1622989391', 147, 147, 'Nurdin Bagus', 'Hello World!', 'default_male.png'),
(72, 2, '1622989430', 148, 148, 'Bambang Sibambang', 'Hello World!', 'default_male.png'),
(73, 2, '1622989477', 149, 149, 'Abizzy Al Tareq', 'Hello World!', 'default_male.png'),
(74, 2, '1622989504', 150, 150, 'Surinem', 'Hello World!', 'default_female.png'),
(75, 2, '1622989521', 151, 151, 'Dea', 'Hello World!', 'default_female.png'),
(76, 2, '1622989558', 152, 152, 'Sheva', 'Hello World!', 'default_female.png'),
(77, 2, '1622989581', 153, 153, 'Tera', 'Hello World!', 'default_female.png'),
(78, 2, '1622989608', 154, 154, 'Sobaqam', 'Hello World!', 'default_male.png'),
(79, 2, '1622989789', 155, 155, 'Naam', 'Hello World!', 'default_male.png'),
(80, 2, '1622989808', 156, 156, 'Hayfa', 'Hello World!', 'default_female.png'),
(81, 2, '1622989831', 157, 157, 'Outemu', 'Hello World!', 'default_male.png'),
(82, 2, '1622989900', 158, 158, 'Gofar', 'Hello World!', 'default_male.png'),
(83, 2, '1622989931', 159, 159, 'Qori', 'Hello World!', 'default_male.png'),
(84, 2, '1622989960', 160, 160, 'Kailh', 'Hello World!', 'default_male.png'),
(85, 2, '1622990006', 161, 161, 'Artisan', 'Hello World!', 'default_female.png'),
(86, 2, '1622990043', 162, 162, 'Hipyo', 'Hello World!', 'default_female.png'),
(87, 2, '1622990095', 163, 163, 'Avilla', 'Hello World!', 'default_female.png'),
(88, 2, '1622990138', 164, 164, 'Himalaya', 'Hello World!', 'default_female.png'),
(89, 2, '1622990210', 165, 165, 'Ustad Zaki', 'Hello World!', 'default_male.png'),
(90, 1, '1623074547', 144, 146, 'Surya Nurhalimah', 'Hello World!', 'default_male.png'),
(91, 1, '1623074628', 144, 147, 'Nurdin Bagus', 'Hello World!', 'default_male.png'),
(92, 1, '1623074850', 146, 144, 'Asep Sudasep', 'Hello World!', 'default_male.png'),
(93, 1, '1623075002', 146, 147, 'Nurdin Bagus', 'Hello World!', 'default_male.png'),
(94, 1, '1623075046', 146, 148, 'Bambang Sibambang', 'Hello World!', 'default_male.png'),
(95, 1, '1623075180', 147, 144, 'Asep Sudasep', 'Hello World!', 'default_male.png'),
(96, 1, '1623075590', 154, 144, 'Asep Sudasep', 'Hello World!', 'default_male.png'),
(97, 1, '1623075578', 154, 146, 'Surya Nurhalimah', 'Hello World!', 'default_male.png'),
(98, 1, '1623075580', 154, 147, 'Nurdin Bagus', 'Hello World!', 'default_male.png'),
(99, 1, '1623228442', 155, 144, 'Asep Sudasep', 'Hello World!', 'default_male.png'),
(100, 1, '1623228449', 155, 146, 'Surya Nurhalimah', 'Hello World!', 'default_male.png'),
(101, 1, '1623228459', 155, 147, 'Nurdin Bagus', 'Hello World!', 'default_male.png'),
(102, 1, '1623232346', 162, 150, 'Surinem', 'Hello World!', 'default_female.png'),
(103, 1, '1623232348', 162, 145, 'Endar Parisian', 'Hello World!', 'default_female.png'),
(104, 1, '1623232746', 165, 144, 'Asep Sudasep', 'Hello World!', 'default_male.png'),
(105, 1, '1623232752', 165, 149, 'Abizzy Al Tareq', 'Hello World!', 'default_male.png'),
(106, 1, '1623232797', 165, 146, 'Surya Nurhalimah', 'Hello World!', 'default_male.png'),
(107, 1, '1623232828', 165, 154, 'Sobaqam', 'Hello World!', 'default_male.png'),
(108, 1, '1623232908', 165, 148, 'Bambang Sibambang', 'Hello World!', 'default_male.png'),
(109, 1, '1623235627', 161, 145, 'Endar Parisian', 'Hello World!', 'default_female.png'),
(110, 1, '1623235797', 145, 161, 'Artisan', 'Hello World!', 'default_female.png'),
(111, 1, '1623235829', 145, 162, 'Hipyo', 'Hello World!', 'default_female.png'),
(112, 1, '1623235863', 145, 150, 'Surinem', 'Hello World!', 'default_female.png'),
(113, 1, '1623236069', 150, 145, 'Endar Parisian', 'Hello World!', 'default_female.png');

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
SET notif='Mengumumkan informasi baru',
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
(15, 'Posted on Timeline', 30, 123, '2021-04-13 14:14:45'),
(16, 'Joined This Group', 32, 129, '2021-04-23 20:03:12'),
(17, 'Joined This Group', 32, 134, '2021-04-23 20:03:13'),
(18, 'Kicked From This Group', 32, 134, '2021-05-18 12:03:35'),
(19, 'Joined This Group', 33, 129, '2021-05-30 16:31:35'),
(20, 'Kicked From This Group', 32, 129, '2021-06-06 21:16:11'),
(21, 'Kicked From This Group', 33, 129, '2021-06-06 21:16:11'),
(22, 'Joined This Group', 40, 144, '2021-06-08 03:19:19'),
(23, 'Joined This Group', 40, 146, '2021-06-09 01:13:42'),
(24, 'Posted on Timeline', 40, 144, '2021-06-09 01:47:24'),
(25, 'Posted on Timeline', 40, 144, '2021-06-09 01:49:22'),
(26, 'Telah Bergabung', 41, 151, '2021-06-09 05:58:32'),
(27, 'Telah Bergabung', 42, 147, '2021-06-09 06:04:04'),
(28, 'Telah Bergabung', 43, 144, '2021-06-09 15:48:56'),
(29, 'Telah Bergabung', 43, 147, '2021-06-09 15:50:31'),
(30, 'Telah Bergabung', 42, 154, '2021-06-09 17:13:49'),
(31, 'Telah Bergabung', 42, 149, '2021-06-09 17:14:21');

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
  `date_post` datetime NOT NULL DEFAULT current_timestamp(),
  `tugas` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `group_postingan`
--

INSERT INTO `group_postingan` (`id_posting`, `caption`, `id_group`, `id_user`, `filename`, `html`, `date_post`, `tugas`) VALUES
(24, 'surah al-mulk', 40, 144, '60bfbb3cb6ca0.mp4', '<div class=\"video-wrapper\"><video class=\"post-video\" controls><source src=http://localhost/myvoqu/assets_user/file_upload/60bfbb3cb6ca0.mp4 type=\"video/mp4\"></video></div>', '2021-06-09 01:47:24', NULL),
(25, 'Setoran surah Al-Kahf ayat 1-3', 40, 144, '60bfbbb27814b.mp4', '<div class=\"video-wrapper\"><video class=\"post-video\" controls><source src=http://localhost/myvoqu/assets_user/file_upload/60bfbbb27814b.mp4 type=\"video/mp4\"></video></div>', '2021-06-09 01:49:22', 7);

--
-- Triggers `group_postingan`
--
DELIMITER $$
CREATE TRIGGER `after_anggota_posting` AFTER INSERT ON `group_postingan` FOR EACH ROW BEGIN
INSERT INTO group_notif
SET notif='Baru saja memposting',
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
(40, 'HOTS 323', 'grup ikhwan', '60c093a0ccf7c.png', 165),
(41, 'Hots 254', 'Grup Ukhti', 'default.png', 161),
(42, 'HOTS 192', 'Grup Akhi HOTS 192', '60c093f6dc725.jpg', 165),
(43, 'Grup Hafalan HOTS 1', 'Grup hafalan HOTS bersama Ustad Naam', 'default.png', 155);

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

--
-- Dumping data for table `infaq`
--

INSERT INTO `infaq` (`id_infaq`, `rating`, `nominal`, `tanggal_infaq`, `id_user_infaq`, `id_mentor`) VALUES
(9, 5, '10000', '2021-04-21', 134, 130),
(10, 5, '50000', '2021-06-07', 144, 155);

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
(354, 'Mulai Mengikuti Anda.', '1618314853', 0, 130, 130),
(355, 'like on your post', '', 272, 129, 0),
(356, 'like on your post', '', 273, 129, 0),
(357, 'comment on your post: \" :P\"', '1618341925', 273, 129, 129),
(358, 'delete comment on your post: \" :P\"', '1618341925', 273, 129, 129),
(359, 'Mulai Mengikuti Anda.', '1618314853', 0, 131, 131),
(360, 'like on your post', '', 274, 129, 0),
(361, 'Mulai Mengikuti Anda.', '1618382009', 0, 132, 132),
(362, 'Mulai Mengikuti Anda.', '1618382086', 0, 133, 133),
(363, 'unlike on your post', '1618383625', 274, 129, 0),
(364, 'unlike on your post', '1618383628', 274, 129, 0),
(365, 'like on your post', '', 275, 129, 0),
(366, 'like on your post', '', 276, 129, 0),
(367, 'like on your post', '', 277, 129, 0),
(368, 'like on your post', '', 278, 129, 0),
(369, 'like on your post', '', 279, 129, 0),
(370, 'like on your post', '', 280, 129, 0),
(371, 'like on your post', '', 281, 129, 0),
(372, 'Mulai Mengikuti Anda.', '1618314853', 0, 134, 134),
(373, 'Mulai Mengikuti Anda.', '1618396759', 0, 134, 129),
(374, 'like on your post', '', 282, 129, 0),
(375, 'like on your post', '', 283, 129, 0),
(376, 'like on your post', '', 284, 129, 0),
(377, 'comment on your post: \" :wow: :wow:\"', '1618424941', 284, 129, 129),
(378, 'unlike on your post', '1618424945', 284, 129, 0),
(379, 'unlike on your post', '1618424947', 284, 129, 0),
(380, 'delete comment on your post: \" :wow: :wow:\"', '1618424941', 284, 129, 129),
(381, 'like on your post', '', 285, 129, 0),
(382, 'Mulai Mengikuti Anda.', '1618314853', 0, 135, 135),
(383, 'Mulai Mengikuti Anda.', '1618314853', 0, 136, 136),
(384, 'Mulai Mengikuti Anda.', '1618314853', 0, 137, 137),
(385, 'like on your post', '', 286, 134, 0),
(386, 'Mulai Mengikuti Anda.', '1618314853', 0, 138, 138),
(387, 'Mulai Mengikuti Anda.', '1621314609', 0, 139, 139),
(388, 'like on your post', '', 287, 129, 0),
(389, 'Mulai Mengikuti Anda.', '1618314853', 0, 140, 140),
(390, 'Mulai Mengikuti Anda.', '1622362432', 0, 141, 141),
(391, 'Mulai Mengikuti Anda.', '1622366761', 0, 141, 129),
(392, 'like on your post', '', 288, 141, 0),
(393, 'like on your post', '', 289, 141, 0),
(394, 'Mulai Mengikuti Anda.', '1622987385', 0, 142, 142),
(395, 'Mulai Mengikuti Anda.', '1622989159', 0, 143, 143),
(396, 'Mulai Mengikuti Anda.', '1622989228', 0, 144, 144),
(397, 'Mulai Mengikuti Anda.', '1622989284', 0, 145, 145),
(398, 'Mulai Mengikuti Anda.', '1622989334', 0, 146, 146),
(399, 'Mulai Mengikuti Anda.', '1622989391', 0, 147, 147),
(400, 'Mulai Mengikuti Anda.', '1622989430', 0, 148, 148),
(401, 'Mulai Mengikuti Anda.', '1622989477', 0, 149, 149),
(402, 'Mulai Mengikuti Anda.', '1622989504', 0, 150, 150),
(403, 'Mulai Mengikuti Anda.', '1622989521', 0, 151, 151),
(404, 'Mulai Mengikuti Anda.', '1622989558', 0, 152, 152),
(405, 'Mulai Mengikuti Anda.', '1622989581', 0, 153, 153),
(406, 'Mulai Mengikuti Anda.', '1622989608', 0, 154, 154),
(407, 'Mulai Mengikuti Anda.', '1622989789', 0, 155, 155),
(408, 'Mulai Mengikuti Anda.', '1622989808', 0, 156, 156),
(409, 'Mulai Mengikuti Anda.', '1622989831', 0, 157, 157),
(410, 'Mulai Mengikuti Anda.', '1622989900', 0, 158, 158),
(411, 'Mulai Mengikuti Anda.', '1622989931', 0, 159, 159),
(412, 'Mulai Mengikuti Anda.', '1622989960', 0, 160, 160),
(413, 'Mulai Mengikuti Anda.', '1622990006', 0, 161, 161),
(414, 'Mulai Mengikuti Anda.', '1622990043', 0, 162, 162),
(415, 'Mulai Mengikuti Anda.', '1622990095', 0, 163, 163),
(416, 'Mulai Mengikuti Anda.', '1622990138', 0, 164, 164),
(417, 'Mulai Mengikuti Anda.', '1622990210', 0, 165, 165),
(418, 'like on your post', '', 290, 144, 0),
(419, 'like on your post', '', 291, 144, 0),
(420, 'like on your post', '', 292, 144, 0),
(421, 'like on your post', '', 293, 144, 0),
(422, 'like on your post', '', 294, 146, 0),
(423, 'like on your post', '', 295, 146, 0),
(424, 'like on your post', '', 296, 146, 0),
(425, 'like on your post', '', 297, 146, 0),
(426, 'like on your post', '', 298, 147, 0),
(427, 'like on your post', '', 299, 147, 0),
(428, 'Mulai Mengikuti Anda.', '1623074547', 0, 144, 146),
(429, 'comment on your post: \"Merdu Sekali Pak Surya\"', '1623074562', 297, 144, 146),
(430, 'like on your post', '1623074564', 297, 144, 146),
(431, 'like on your post', '1623074578', 296, 144, 146),
(432, 'comment on your post: \"Merdeka!!\"', '1623074585', 296, 144, 146),
(433, 'comment on your post: \"Semangat Pak Asepp!!\"', '1623074616', 294, 144, 146),
(434, 'like on your post', '1623074618', 294, 144, 146),
(435, 'Mulai Mengikuti Anda.', '1623074628', 0, 144, 147),
(436, 'comment on your post: \"Subhannallah\"', '1623074639', 299, 144, 147),
(437, 'like on your post', '1623074642', 299, 144, 147),
(438, 'like on your post', '1623074657', 298, 144, 147),
(439, 'comment on your post: \"Wah Pak Nurdin memang berbakat! :cheese:\"', '1623074700', 298, 144, 147),
(440, 'comment on your post: \"Terimakasih pak Asep :red:\"', '1623074780', 297, 146, 146),
(441, 'unlike on your post', '1623074782', 297, 146, 0),
(442, 'comment on your post: \"Allahuakbar!!\"', '1623074827', 296, 146, 146),
(443, 'unlike on your post', '1623074830', 296, 146, 0),
(444, 'Mulai Mengikuti Anda.', '1623074850', 0, 146, 144),
(445, 'comment on your post: \"Wah suaranya bikin saya minder Pak\"', '1623074894', 292, 146, 144),
(446, 'like on your post', '1623074896', 292, 146, 144),
(447, 'like on your post', '1623074910', 291, 146, 144),
(448, 'comment on your post: \"Tiasa ngabimbing putra abdi pak?\"', '1623074938', 291, 146, 144),
(449, 'like on your post', '1623074964', 290, 146, 144),
(450, 'comment on your post: \"salah fokus ka sajadahna saee pisann :)\"', '1623074996', 290, 146, 144),
(451, 'Mulai Mengikuti Anda.', '1623075002', 0, 146, 147),
(452, 'like on your post', '1623075011', 299, 146, 147),
(453, 'comment on your post: \"Saee pisann\"', '1623075038', 299, 146, 147),
(454, 'Mulai Mengikuti Anda.', '1623075046', 0, 146, 148),
(455, 'comment on your post: \"wah tiasa ngabentuk kapal kitu, berbakat Pak  :cheese:\"', '1623075093', 298, 146, 147),
(456, 'like on your post', '1623075100', 298, 146, 147),
(457, 'comment on your post: \"Haturnuhun sadayana! :red: :-)\"', '1623075155', 299, 147, 147),
(458, 'unlike on your post', '1623075159', 299, 147, 0),
(459, 'Mulai Mengikuti Anda.', '1623075180', 0, 147, 144),
(460, 'comment on your post: \"Barade didamelkeun?\"', '1623075208', 298, 147, 147),
(461, 'unlike on your post', '1623075211', 298, 147, 0),
(462, 'comment on your post: \"Lanjutkan pak!\"', '1623075254', 292, 147, 144),
(463, 'like on your post', '1623075256', 292, 147, 144),
(464, 'comment on your post: \"Estetik mun ceuk barudak ayenamah :lol:\"', '1623075306', 290, 147, 144),
(465, 'like on your post', '1623075309', 290, 147, 144),
(466, 'like on your post', '1623075325', 297, 147, 146),
(467, 'comment on your post: \"Tarikan ah suarana, merdu ulah dilaun laun\"', '1623075400', 297, 147, 146),
(468, 'Mulai Mengikuti Anda.', '1623075576', 0, 154, 144),
(469, 'Mulai Mengikuti Anda.', '1623075578', 0, 154, 146),
(470, 'Mulai Mengikuti Anda.', '1623075580', 0, 154, 147),
(471, 'comment on your post: \"Wariskeun kang suantena ka abdi\"', '1623075606', 292, 154, 144),
(472, 'Mulai Mengikuti Anda.', '1623228442', 0, 155, 144),
(473, 'Mulai Mengikuti Anda.', '1623228449', 0, 155, 146),
(474, 'Mulai Mengikuti Anda.', '1623228459', 0, 155, 147),
(475, 'Menyukai postingan anda', '', 302, 162, 0),
(476, 'Mulai Mengikuti Anda.', '1623232346', 0, 162, 150),
(477, 'Mulai Mengikuti Anda.', '1623232348', 0, 162, 145),
(478, 'Tidak menyukai postingan anda', '1623232511', 302, 162, 0),
(479, 'Mulai Mengikuti Anda.', '1623232746', 0, 165, 144),
(480, 'Mulai Mengikuti Anda.', '1623232752', 0, 165, 149),
(481, 'Mulai Mengikuti Anda.', '1623232797', 0, 165, 146),
(482, 'Mulai Mengikuti Anda.', '1623232828', 0, 165, 154),
(483, 'Mulai Mengikuti Anda.', '1623232908', 0, 165, 148),
(484, 'Menyukai postingan anda', '', 303, 161, 0),
(485, 'Mulai Mengikuti Anda.', '1623235627', 0, 161, 145),
(486, 'Tidak menyukai postingan anda', '1623235645', 303, 161, 0),
(487, 'Mulai Mengikuti Anda.', '1623235797', 0, 145, 161),
(488, 'Mulai Mengikuti Anda.', '1623235829', 0, 145, 162),
(489, 'Mulai Mengikuti Anda.', '1623235863', 0, 145, 150),
(490, 'Menyukai postingan anda', '', 304, 145, 0),
(491, 'Tidak menyukai postingan anda', '1623235947', 304, 145, 0),
(492, 'Mulai Mengikuti Anda.', '1623236069', 0, 150, 145),
(493, 'Menyukai postingan anda', '1623236079', 304, 150, 145),
(494, 'comment on your post: \"bismillah  :-)\"', '1623236093', 304, 150, 145);

-- --------------------------------------------------------

--
-- Table structure for table `pengumuman`
--

CREATE TABLE `pengumuman` (
  `id` int(11) NOT NULL,
  `isi_pengumuman` text NOT NULL,
  `datepost` varchar(500) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengumuman`
--

INSERT INTO `pengumuman` (`id`, `isi_pengumuman`, `datepost`, `id_user`) VALUES
(12, 'Jangan lupa baca AlQuran guys!', '1622991104', 131),
(13, 'Kita harus selalu sholat 5 waktu guys!', '1622990827', 131),
(14, 'Jangan lupa beramal ya!', '1622990834', 131),
(16, 'Jangan lupa berbuat baik ya guys!', '1622990878', 131),
(17, 'Kita adalah hamba allah', '1622990893', 131),
(18, 'Myvoqu punya fitur baru loh, ayo di cari sendirii hehe', '1622990924', 131),
(19, 'Admin baru saja unggah materi islami baru lohh', '1622990993', 131),
(20, 'Kepada penghafal yang kasar akan di non aktivasi ya akunnya', '1622991027', 131),
(21, 'Kepada penghafal yang mengunggah hal yang tidak patut, akan di hapus ya unggahannya!', '1622991060', 131),
(22, 'PERINGATAN - Admin akan mengawasi pengguna yang mengganggu ya!', '1622991093', 131);

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
(49, 124, 114, 'hallo juga helmi :-P :-P', 1618295962, 'belum', ''),
(50, 144, 146, 'kang surya sehat?', 1623075689, 'belum', ''),
(51, 144, 147, 'Kang Nurdin, Ngadamel kaligrafi sabarahanya?', 1623075731, 'belum', ''),
(52, 147, 144, 'Mangga Pak Asep, saiklashna :)', 1623075765, 'belum', ''),
(53, 146, 144, 'Alhamdulillah, sawalerna kumaha damang?', 1623075808, 'belum', ''),
(54, 146, 147, 'Kaligrafina sae pisann, hoyong ah ngadamel', 1623075849, 'belum', ''),
(55, 147, 146, 'Mangga kang, bade anu kumaha?', 1623075880, 'belum', ''),
(56, 144, 146, 'Damang kang, bade masihan info minggu payun aya pangaosan di bumi abdi kang,  tong hilap sumpingnya!', 1623076012, 'belum', ''),
(57, 144, 147, 'Ngadamel 1 kang, haturnuhunnya', 1623076046, 'belum', ''),
(58, 146, 144, 'Alhamdulillah, muhun insya allah sumping, pangaosan naon kang?', 1623076093, 'belum', '');

--
-- Triggers `pesan`
--
DELIMITER $$
CREATE TRIGGER `after_penghafal_delete_pesan` AFTER DELETE ON `pesan` FOR EACH ROW BEGIN
INSERT INTO backup_tubes.backup_pesan_delete
SET aksi='Hapus Pesan',
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
(76, 'Materinya bagus banget nih', '60bcdeb09da30.jpg', '<img src=http://localhost/myvoqu/assets_user/file_upload/60bcdeb09da30.jpg alt=\"post-image\"class=\"img-responsive post-image\"  style=\"border-radius: 5px 5px 5px 5px;\"/>', '1622990512', 131),
(77, 'Bacaan yang cukup ngena, silahkan dibaca', '60bcdecb1c3f8.jpg', '<img src=http://localhost/myvoqu/assets_user/file_upload/60bcdecb1c3f8.jpg alt=\"post-image\"class=\"img-responsive post-image\"  style=\"border-radius: 5px 5px 5px 5px;\"/>', '1622990539', 131),
(78, 'Ngajinya keren banget, silahkan di cek ya', '60bcdeee947f1.mkv', '<video class=\"post-video\" controls width=\"500\" height=\"500\"><source src=http://localhost/myvoqu/assets_user/file_upload/60bcdeee947f1.mkv type=\"video/mp4\"></video>', '1622990574', 131),
(79, 'Bacaan Al Fatihah yang sangat merdu', '60bcdf10b6afb.mkv', '<video class=\"post-video\" controls width=\"500\" height=\"500\"><source src=http://localhost/myvoqu/assets_user/file_upload/60bcdf10b6afb.mkv type=\"video/mp4\"></video>', '1622990608', 131),
(80, 'Suaranya merdu sekali, silahkan pelajari ya', '60bcdf3023887.mp4', '<video class=\"post-video\" controls width=\"500\" height=\"500\"><source src=http://localhost/myvoqu/assets_user/file_upload/60bcdf3023887.mp4 type=\"video/mp4\"></video>', '1622990640', 131),
(81, 'Selamat idul adha kawan kawan', '60bcdf4324b15.jpg', '<img src=http://localhost/myvoqu/assets_user/file_upload/60bcdf4324b15.jpg alt=\"post-image\"class=\"img-responsive post-image\"  style=\"border-radius: 5px 5px 5px 5px;\"/>', '1622990659', 131),
(82, 'Selamat tahun baru Hijriah teman-teman.', '60bcdf5ea8dd3.jpg', '<img src=http://localhost/myvoqu/assets_user/file_upload/60bcdf5ea8dd3.jpg alt=\"post-image\"class=\"img-responsive post-image\"  style=\"border-radius: 5px 5px 5px 5px;\"/>', '1622990686', 131),
(83, 'Kata-katanya sangat mendalam teman teman', '60bcdf713192f.jpg', '<img src=http://localhost/myvoqu/assets_user/file_upload/60bcdf713192f.jpg alt=\"post-image\"class=\"img-responsive post-image\"  style=\"border-radius: 5px 5px 5px 5px;\"/>', '1622990705', 131),
(84, 'Imam ini bacaannya sangat merdu', '60bcdf9200475.mp4', '<video class=\"post-video\" controls width=\"500\" height=\"500\"><source src=http://localhost/myvoqu/assets_user/file_upload/60bcdf9200475.mp4 type=\"video/mp4\"></video>', '1622990738', 131),
(85, 'Kita harus rajin ibadah ya guys!', '60bcdfaf3b111.jpg', '<img src=http://localhost/myvoqu/assets_user/file_upload/60bcdfaf3b111.jpg alt=\"post-image\"class=\"img-responsive post-image\"  style=\"border-radius: 5px 5px 5px 5px;\"/>', '1622990767', 131);

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
(302, 'bagus banget ya', 162, '', '60c08f5002a23.png', '<img src=http://localhost/myvoqu/assets_user/file_upload/60c08f5002a23.png alt=\"post-image\"class=\"img-responsive post-image\" style=\"height: 350px;\" />', '1623232336'),
(303, 'Suaranya bagus sekali ya', 161, '', '60c09c2355eca.mp4', '<div class=\"video-wrapper\"><video class=\"post-video\" controls  width=\"500\" height=\"500\"><source src=http://localhost/myvoqu/assets_user/file_upload/60c09c2355eca.mp4 type=\"video/mp4\"></video></div>', '1623235619'),
(304, 'Aku mau bisa merdu seperti dia', 145, '', '60c09d644a8cc.mkv', '<div class=\"video-wrapper\"><video class=\"post-video\" controls  width=\"500\" height=\"500\"><source src=http://localhost/myvoqu/assets_user/file_upload/60c09d644a8cc.mkv type=\"video/mp4\"></video></div>', '1623235940');

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
(131, 0, '', 302, 162),
(132, 0, '', 303, 161),
(133, 0, '', 304, 145);

-- --------------------------------------------------------

--
-- Table structure for table `report_hafalan`
--

CREATE TABLE `report_hafalan` (
  `id_hafalan` int(11) NOT NULL,
  `id_tugas` int(11) NOT NULL DEFAULT 0,
  `id_user` int(11) NOT NULL DEFAULT 0,
  `id_group` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `report_hafalan`
--

INSERT INTO `report_hafalan` (`id_hafalan`, `id_tugas`, `id_user`, `id_group`, `created_at`) VALUES
(8, 7, 144, 40, '2021-06-08 18:49:22');

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
(273, 1, '1623232511', 302, 162, 0),
(274, 1, '1623235645', 303, 161, 0),
(275, 1, '1623235947', 304, 145, 0),
(276, 1, '1623236079', 304, 150, 145);

--
-- Triggers `suka`
--
DELIMITER $$
CREATE TRIGGER `after_penghafal_insert_like` AFTER INSERT ON `suka` FOR EACH ROW BEGIN
INSERT INTO notification
SET notif='Menyukai postingan anda',
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
SET notif='Tidak menyukai postingan anda',
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
  `datepost` varchar(500) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `task_name`, `state`, `datepost`, `id_user`) VALUES
(56, 'xa', 0, '', 138),
(62, 'sidang TA', 0, '1622443539', 138),
(63, 'Cek-cek data pengguna', 0, '1622991172', 131),
(64, 'Jangan lupa backup seluruh database', 0, '1622991183', 131),
(65, 'Cek unggahan yang mengganggu', 0, '1622991194', 131),
(66, 'Hapus unggahan yang memiliki banyak laporan', 0, '1622991204', 131),
(67, 'Jangan lupa unggah materi umum!', 0, '1622991220', 131),
(68, 'Jangan lupa buat pengumuman untuk penghafal dan mentor', 0, '1622991247', 131),
(69, 'Jangan lupa cek seluruh data aplikasi', 0, '1622991304', 131),
(70, 'Ekspor data akun penghafal ke excel', 0, '1622991341', 131),
(71, 'Ekspor data unggahan ke bentuk print', 0, '1622991402', 131),
(72, 'Buat pengumuman ke penghafal/mentor kalau ada fitur baru', 0, '1622991396', 131);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_topup_dompet`
--

CREATE TABLE `transaksi_topup_dompet` (
  `order_id` char(12) NOT NULL,
  `name` varchar(250) NOT NULL,
  `gross_amount` int(11) NOT NULL,
  `payment_type` varchar(13) NOT NULL,
  `transaction_time` varchar(19) NOT NULL,
  `bank` varchar(10) DEFAULT NULL,
  `va_number` varchar(30) DEFAULT NULL,
  `pdf_url` text DEFAULT NULL,
  `status_code` char(3) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksi_topup_dompet`
--

INSERT INTO `transaksi_topup_dompet` (`order_id`, `name`, `gross_amount`, `payment_type`, `transaction_time`, `bank`, `va_number`, `pdf_url`, `status_code`, `id_user`) VALUES
('1170345276', 'Top Up Wallet', 100000, 'bank_transfer', '2021-06-07 15:19:27', 'bca', '46612162567', 'https://app.sandbox.midtrans.com/snap/v1/transactions/713962a6-7e08-4821-ae98-cd19f1bbc4ad/pdf', '201', 144),
('140189594', 'Top Up Wallet', 50000, 'echannel', '2021-06-07 15:18:51', NULL, NULL, 'https://app.sandbox.midtrans.com/snap/v1/transactions/51b07919-8f86-41e8-a62e-9654d212266c/pdf', '201', 144);

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
(112, 126, '', '', 0, 'Ada yang baru delete posting', '2021-04-13 16:02:29'),
(113, 129, '', '', 0, 'Ada yang baru delete posting', '2021-04-14 01:16:19'),
(114, 129, '', '', 0, 'Ada yang baru delete posting', '2021-04-14 13:16:56'),
(115, 129, '', '', 0, 'Ada yang baru delete posting', '2021-04-14 14:00:46'),
(116, 129, '', '', 0, 'Ada yang baru delete posting', '2021-04-14 14:01:07'),
(117, 129, '', '', 0, 'Ada yang baru delete posting', '2021-04-14 14:02:00'),
(118, 129, '', '', 0, 'Ada yang baru delete posting', '2021-04-14 14:03:55'),
(119, 129, '', '', 0, 'Ada yang baru delete posting', '2021-04-14 14:04:36'),
(120, 129, '', '', 0, 'Ada yang baru delete posting', '2021-04-14 14:04:53'),
(121, 129, '', '', 0, 'Ada yang baru delete posting', '2021-04-14 14:09:57'),
(122, 129, '', '', 0, 'Ada yang baru delete posting', '2021-04-14 16:10:30'),
(123, 130, 'Muhammad Abizard', 'm.abizard1123@gmail.com', 3, 'Muhammad Abizard yang baru melakukan update profile menjadi Ustad Abi', '2021-04-14 17:31:37'),
(124, 129, 'background chat all', '', 0, 'Ada yang baru delete posting', '2021-04-14 23:32:27'),
(125, 129, 'testing', '', 0, 'Ada yang baru delete posting', '2021-04-15 00:29:53'),
(126, 129, '', '', 0, 'Ada yang baru delete posting', '2021-04-15 01:29:12'),
(127, 131, 'Muhammad Abizard', 'jaki@gmail.com', 1, 'Muhammad Abizard yang baru melakukan update profile menjadi Zaki Al Faridzi', '2021-04-20 13:44:38'),
(128, 131, 'Zaki Al Faridzi', 'jaki@gmail.com', 1, 'Zaki Al Faridzi yang baru melakukan update profile menjadi Zaki', '2021-04-20 20:30:06'),
(129, 131, 'Zaki', 'jaki@gmail.com', 1, 'Zaki yang baru melakukan update profile menjadi Zaki AF', '2021-04-20 20:30:32'),
(130, 131, 'Zaki AF', 'jaki@gmail.com', 1, 'Zaki AF yang baru melakukan update profile menjadi Zaki Al Faridzi', '2021-04-20 20:31:32'),
(131, 131, 'Zaki Al Faridzi', 'jaki@gmail.com', 1, 'Zaki Al Faridzi yang baru melakukan update profile menjadi Zaki Al Faridz', '2021-04-20 20:31:41'),
(132, 131, 'Zaki Al Faridz', 'jaki@gmail.com', 1, 'Zaki Al Faridz yang baru melakukan update profile menjadi Zaki Al Faridzasd', '2021-04-20 20:32:04'),
(133, 131, 'Zaki Al Faridzasd', 'jaki@gmail.com', 1, 'Zaki Al Faridzasd yang baru melakukan update profile menjadi Zaki Al ', '2021-04-20 20:32:48'),
(134, 129, 'Al Muzzammil', '', 0, 'Ada yang baru delete posting', '2021-04-20 20:59:48'),
(135, 131, 'Zaki Al ', 'jaki@gmail.com', 1, 'Zaki Al  yang baru melakukan update profile menjadi Zaki Al Faridzi', '2021-04-21 21:06:47'),
(136, 131, 'Zaki Al Faridzi', 'jaki@gmail.com', 1, 'Zaki Al Faridzi yang baru melakukan update profile menjadi Zaki Al Faridzii', '2021-04-22 11:24:37'),
(137, 134, 'yuk belajar ngaji bersama ustad', '', 0, 'Ada yang baru delete posting', '2021-05-05 22:28:14'),
(138, 131, 'Zaki Al Faridzii', 'jaki@gmail.com', 1, 'Zaki Al Faridzii yang baru melakukan update profile menjadi Zaki Al Faridzi', '2021-05-18 12:32:11'),
(139, 131, 'Zaki Al Faridzi', 'jaki@gmail.com', 1, 'Zaki Al Faridzi yang baru melakukan update profile menjadi Zaki Al ', '2021-05-27 19:39:07'),
(140, 131, 'Zaki Al ', 'jaki@gmail.com', 1, 'Zaki Al  yang baru melakukan update profile menjadi Zaki Al Faridzi', '2021-05-27 19:39:26'),
(141, 131, 'Zaki Al Faridzi', 'jaki@gmail.com', 1, 'Zaki Al Faridzi yang baru melakukan update profile menjadi ADMIN - Zaki', '2021-05-29 21:32:15'),
(142, 141, 'keeb', '', 0, 'Ada yang baru delete posting', '2021-05-30 16:47:32'),
(143, 131, 'ADMIN - Zaki', 'jaki@gmail.com', 1, 'ADMIN - Zaki yang baru melakukan update profile menjadi ADMIN - Zakii', '2021-06-06 20:34:54'),
(144, 141, 'tesk', '', 0, 'Ada yang baru delete posting', '2021-06-06 21:16:20'),
(145, 131, 'ADMIN - Zakii', 'jaki@gmail.com', 1, 'ADMIN - Zakii yang baru melakukan update profile menjadi ADMIN - Zaki', '2021-06-06 21:57:09'),
(146, 144, 'Yuk Baca Al Quran', '', 0, 'Ada yang baru delete posting', '2021-06-09 16:24:51'),
(147, 144, 'yuk tunggu apalagi? Ngaji bareng aku deh', '', 0, 'Ada yang baru delete posting', '2021-06-09 16:24:51'),
(148, 144, 'Al Muzammil 17 by Me, hehehe', '', 0, 'Ada yang baru delete posting', '2021-06-09 16:24:51'),
(149, 144, '[OOT] Background Aplikasi MyVoQu Mantep ya', '', 0, 'Ada yang baru delete posting', '2021-06-09 16:24:51'),
(150, 146, 'Subhanallah, asyik nya membaca Al Quran !!', '', 0, 'Ada yang baru delete posting', '2021-06-09 16:24:51'),
(151, 146, 'Anak kecil aja udah jago baca Al Quran!', '', 0, 'Ada yang baru delete posting', '2021-06-09 16:24:51'),
(152, 146, 'Free Palestine', '', 0, 'Ada yang baru delete posting', '2021-06-09 16:24:51'),
(153, 146, 'Al Muzammil - 9', '', 0, 'Ada yang baru delete posting', '2021-06-09 16:24:51'),
(154, 147, 'kaligrafi buatan nurdin memang bagus!', '', 0, 'Ada yang baru delete posting', '2021-06-09 16:24:51'),
(155, 147, '', '', 0, 'Ada yang baru delete posting', '2021-06-09 16:24:51');

-- --------------------------------------------------------

--
-- Table structure for table `tugas_hafalan`
--

CREATE TABLE `tugas_hafalan` (
  `id_tugas` int(11) NOT NULL,
  `id_group` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama_surah` varchar(100) NOT NULL DEFAULT '0',
  `from_ayat` varchar(100) NOT NULL DEFAULT '0',
  `to_ayat` varchar(100) DEFAULT '0',
  `Catatan` varchar(100) DEFAULT '0',
  `deadline` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tugas_hafalan`
--

INSERT INTO `tugas_hafalan` (`id_tugas`, `id_group`, `id_user`, `nama_surah`, `from_ayat`, `to_ayat`, `Catatan`, `deadline`, `created_at`) VALUES
(7, 40, 165, 'Al-Kahf', '1', '3', 'Hafalkan ya', NULL, '2021-06-08 04:15:46');

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
(131, 'ADMIN - Zaki', 'Male', 'jaki@gmail.com', 't128olv9kli61.png', '$2y$10$xP4idTclGpLn6GTn6zGkQOs26IwtkyEm6xvR4cwPjyqdC1cvxVYZW', 1, 1, 1618314853, 'offline-dot', '0000-00-00', '', 'Hello World!', '', NULL, '', 0),
(138, 'ADMIN - ABI', 'Male', 'abi@gmail.com', 'v.png', '$2y$10$xP4idTclGpLn6GTn6zGkQOs26IwtkyEm6xvR4cwPjyqdC1cvxVYZW', 1, 1, 1618314853, 'offline-dot', '0000-00-00', '', 'Hello World!', '', NULL, '', 0),
(144, 'Asep Sudasep', 'Male', 'asep@gmail.com', 'default_male.png', '$2y$10$xP4idTclGpLn6GTn6zGkQOs26IwtkyEm6xvR4cwPjyqdC1cvxVYZW', 2, 1, 1622989228, 'online-dot', '0000-00-00', '', 'Hello World!', '', NULL, '', 0),
(145, 'Endar Parisian', 'Female', 'endar@gmail.com', 'default_female.png', '$2y$10$oogXwOXrzoc4KCq7vE2kA.yNzPQUpKulqF9L2kR4YBWhbcGZX06iq', 2, 1, 1622989284, 'offline-dot', '0000-00-00', '', 'Hello World!', '', NULL, '', 0),
(146, 'Surya Nurhalimah', 'Male', 'surya@gmail.com', 'default_male.png', '$2y$10$xP4idTclGpLn6GTn6zGkQOs26IwtkyEm6xvR4cwPjyqdC1cvxVYZW', 2, 1, 1622989334, 'offline-dot', '0000-00-00', '', 'Hello World!', '', NULL, '', 0),
(147, 'Nurdin Bagus', 'Male', 'nurdin@gmail.com', 'default_male.png', '$2y$10$HMvOlhQToVs4TWLOUvbdsOiKS7QwppWm.jNriv8DdA5QYzarmHFXO', 2, 1, 1622989391, 'offline-dot', '0000-00-00', '', 'Hello World!', '', NULL, '', 0),
(148, 'Bambang Sibambang', 'Male', 'bambang@gmail.com', 'default_male.png', '$2y$10$3SjuioySLZzEFsaB5/6.HerOCVae7xXsIMfdMkKKlTPusdJM/cAQW', 2, 1, 1622989430, '', '0000-00-00', '', 'Hello World!', '', NULL, '', 0),
(149, 'Abizzy Al Tareq', 'Male', 'abizzy@gmail.com', 'default_male.png', '$2y$10$qBt7p6bai3KftmNlxjkMEe40gANj5M05JBYau.XAuXGJNcdXHDZy.', 2, 1, 1622989477, '', '0000-00-00', '', 'Hello World!', '', NULL, '', 0),
(150, 'Surinem', 'Female', 'surinem@gmail.com', 'default_female.png', '$2y$10$lOgCUUE8OKxSqYsX2XKNBOKkK8FDvBGNtJUV9AKQZQFyTcuWdFAw2', 2, 1, 1622989504, 'offline-dot', '0000-00-00', '', 'Hello World!', '', NULL, '', 0),
(151, 'Dea', 'Female', 'dea@gmail.com', 'default_female.png', '$2y$10$bQEIInl51NElKcoSBwEbL.rCcrZNjncL8VR9IMHDtn17tQMdvYgBS', 2, 2, 1622989521, '', '0000-00-00', '', 'Hello World!', '', NULL, '', 0),
(152, 'Sheva', 'Female', 'sheva@gmail.com', 'default_female.png', '$2y$10$xjiTC3KBjsCrxRZeAUOTge3KfpCPW7NUOxSEwSEc8ZjRFtkZPViHS', 2, 2, 1622989558, '', '0000-00-00', '', 'Hello World!', '', NULL, '', 0),
(153, 'Tera', 'Female', 'tera@gmail.com', 'default_female.png', '$2y$10$zZKe6FGdQjtFvYup7WrgkeLHvqmRdPEQUb9WHqerWOxi.u84f1Om.', 2, 2, 1622989581, '', '0000-00-00', '', 'Hello World!', '', NULL, '', 0),
(154, 'Sobaqam', 'Male', 'sobaqam@gmail.com', 'default_male.png', '$2y$10$muO67UKiiyb2eb9taxHrJuZC2Az6Je2Dt/vu84EehnBD/T9UCam22', 2, 1, 1622989608, 'offline-dot', '0000-00-00', '', 'Hello World!', '', NULL, '', 0),
(155, 'Naam', 'Male', 'naam@gmail.com', 'default_male.png', '$2y$10$Xzd7UjTDftjL/awxNFipruAvvDhHRF1/IDoygBnGTrGgyJL66uWb2', 3, 0, 1622989789, 'offline-dot', '0000-00-00', '', 'Hello World!', '', NULL, 'Webinar Kumparan - Zaki Al Faridzi_6701184045.jpg', 0),
(156, 'Hayfa', 'Female', 'hayfa@gmail.com', 'default_female.png', '$2y$10$cuiseINQrQ.rB/Rb5FBX9OK1rOWiMydxVNPIPa8aHQRSb4eJE20oq', 3, 0, 1622989808, '', '0000-00-00', '', 'Hello World!', '', NULL, 'Waketuplak Bedah PA_Zaki Al Faridzi_6701184045.png', 0),
(157, 'Outemu', 'Male', 'outemu@gmail.com', 'default_male.png', '$2y$10$4VVUwAOovLOZSXZRrCYP1eKC/qsXu8Glw1HfjFUklTjv1/i0s73BC', 3, 0, 1622989831, '', '0000-00-00', '', 'Hello World!', '', NULL, 'Webinar Kumparan - Zaki Al Faridzi_6701184045.jpg', 0),
(158, 'Gofar', 'Male', 'gofar@gmail.com', 'default_male.png', '$2y$10$qHYoYWrei4mQpKQjo3ibpuceqUSsZWze9VKXu/9OSTqdwSqFEU3Ry', 3, 0, 1622989900, '', '0000-00-00', '', 'Hello World!', '', NULL, 'Sesi5_Webinar MTO FRI - Zaki Al Faridzi_6701184045.jpg', 0),
(159, 'Qori', 'Male', 'qori@gmail.com', 'default_male.png', '$2y$10$bcW3p8iSFaCzceu1yUci0eKF/sE34Bc/RK12fcRz6YZXdYe9P2LYa', 3, 2, 1622989931, 'offline-dot', '0000-00-00', '', 'Hello World!', '', NULL, 'Sesi3_Webinar MTO FRI - Zaki Al Faridzi_6701184045.png', 0),
(160, 'Kailh', 'Male', 'kailh@gmail.com', 'default_male.png', '$2y$10$QbAJbH5pBfk.nxPxxglglehQjT4WhAYeGpTQK38DIvp58yeiiWSV.', 3, 0, 1622989960, '', '0000-00-00', '', 'Hello World!', '', NULL, 'Peserta Bedah PA_Zaki Al Faridzi_6701184045.png', 0),
(161, 'Artisan', 'Female', 'artisan@gmail.com', 'default_female.png', '$2y$10$7RjYCGM5va9xJsvV4dfwbuVK9zcOZ5ST8QZJKmH8RYXGmJA4v3ukq', 3, 1, 1622990006, 'offline-dot', '0000-00-00', '', 'Hello World!', '', 'FITTELU', 'Sesi1_Webinar MTO FRI - Zaki Al Faridzi_6701184045.jpg', 1),
(162, 'Hipyo', 'Female', 'hipyo@gmail.com', 'default_female.png', '$2y$10$opcnZCSZgDsLvCfPMi950.fusqk.pyGeCGa9Jtd4S2vbjysOn/jgy', 3, 1, 1622990043, 'offline-dot', '0000-00-00', '', 'Hello World!', '', 'HOTS', 'Sesi2Webinar MTO FRI - Zaki Al Faridzi_6701184045.jpg', 1),
(163, 'Avilla', 'Female', 'avilla@gmail.com', 'default_female.png', '$2y$10$j4Jenlp4YZAgNQcUCtEwZ.8te1I8mcWCnU8u5GNrBbhgYD3o2yROe', 3, 2, 1622990095, '', '0000-00-00', '', 'Hello World!', '', NULL, 'Peserta Bedah PA_Zaki Al Faridzi_6701184045.png', 0),
(164, 'Himalaya', 'Female', 'himalaya@gmail.com', 'default_female.png', '$2y$10$8RryDm8w0uOl/Hk0542eAeoqWugjzMvPPQzRNeKVyiXwFvPSG5vya', 3, 0, 1622990138, '', '0000-00-00', '', 'Hello World!', '', NULL, 'Sesi2Webinar MTO FRI - Zaki Al Faridzi_6701184045.jpg', 0),
(165, 'Ustad Zaki', 'Male', 'zack.ridzi@gmail.com', 'default_male.png', '$2y$10$iThs4gPo8DLHzIH67y8/lu7096Zdmu0VIpbRI5/YhQix4GM85ATqO', 3, 1, 1622990210, 'offline-dot', '0000-00-00', '', 'Hello World!', '', 'HOTS', 'Webinar Kumparan - Zaki Al Faridzi_6701184045.jpg', 1);

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
(74, 'superadmin@mail.com', 'Z4k+A6Ko3MisXoZMztx1ssPnptOwXGZW4qT/bzNrj3k=', 1618298702),
(77, 'm.abizard1123@gmail.com', 'jpb88k/RPx7u9xAAukWePJgkhuqjG6LE/IYL1jNclM0=', 1618382009),
(78, 'm.abizard1123@gmail.com', '/8onNSjGtNylZ2nho0H3Iwc7Rdc03Zzd3DuzPplVvqY=', 1618382086),
(79, 'abizard@student.telkomuniversity.ac.id', 't06Wm7ivs5P45B8Qy+B6JA8mQsO0eDaGvPGi7IXUcQA=', 1618421907),
(80, 'abizard@student.telkomuniversity.ac.id', 'gDX1oiNtGLezYnx5JmqEp4Sb1hdf8vSfET4v5zIYXPo=', 1618421935),
(81, 'm.abizard1123@gmail.com', 'g9AJDOQ4PNb77U/UGeqRxpjFSfV583DERh/zspC0BAk=', 1618904919),
(82, 'haitsam@gmail.com', '2b0hrpL2lzrGKen64ssBteR4ec6XNQ67JguXdzxd7bA=', 1618926411),
(83, 'haitsam@gmail.com', 'JRZWEPrUN7dleTn1ewy0X6r9TvvrhdHRphaMa/sU3LY=', 1618926591),
(84, 'haitsam@gmail.com', 'iMklxMRWJgoc446cpvLTA83yLe7jjJ6n+1QQvLU5iDY=', 1618926723),
(85, 'haitsam@gmail.com', 'fzH3q0Dhr+KBtiWTjHUragS+eP7V127ZHep9GAknegc=', 1619182701),
(86, 'mori@gmail.com', '9HoaK73T7Y5yp1OZHq1GlDebVp5F2BbzLogJUhnYkJU=', 1621314624),
(87, 'abel@gmail.com', 'Sxa9H/OaU5K1GY7sKEmminDTJueSPcrph88UWTTJAf4=', 1622362507),
(88, 'abel@gmail.com', '77/vaoZWO5Z7j/DO3RMxm9ucMU98RxChUeajR/bBeWc=', 1622362518),
(89, 'abel@gmail.com', '+Z+qMYV1SOOTdhRo6HlYt9p9WKGVFosJ8DtpLhG9Y9k=', 1622727248),
(90, 'ais@gmail.com', '6d3GT5+NTWI/lSoVoLrd8sPi5VfvFuunWhQKegT24RQ=', 1622987400),
(91, 'ais@gmail.com', 'qTxVVa8FeL3MxdcI1h9GwBrZ4p/3y5XyCnhyPusmylA=', 1622987460),
(92, 'ais@gmail.com', 'j45eD8pnUNTsSne0E/dS37CS8YMvfrG7ZAilZRkso4k=', 1622987506),
(93, 'ais@gmail.com', 'gIdKUPU9foXq0o9UIGy8vuk8iUbjxo4XYPepqthirHI=', 1622987594),
(94, 'ais@gmail.com', '3ySBmuOKg+XzVpb7BvutfCanTxJDWA6XSKQ24oyCbYk=', 1622987853),
(95, 'ais@gmail.com', 'FNO9i7VXusaapPfFVuLiGsgJn4NwNXB3FHjEWnfpKEo=', 1622987948),
(96, 'asep@gmail.com', 'cSeLBFdfM/YHiqyUWN266YAPvqEP26YnbfKFrlddi2I=', 1622989159),
(97, 'asep@gmail.com', 'B0Vzo2zoW/d3Lrynwcbre7/lQZh210HkM8FgNCZhHOI=', 1622989228),
(98, 'endar@gmail.com', 'Iz6GthTUEfH9AzsNdFLyuOfncPzKvY5kPeW+L2f9Oh4=', 1622989284),
(99, 'surya@gmail.com', '6a6QZv3BEvcZyz7FfqBGWSjahnZzZ+1294oWQdBrEkg=', 1622989334),
(100, 'nurdin@gmail.com', '3eT9CMvgqrrbFP9vhWWW/+MmNuE1KMw3o76N+A32Kgw=', 1622989391),
(101, 'bambang@gmail.com', 'iLeLtPyrN/RGQvVhCsEDb9v3AtiQUk2LIeku5jl3dlM=', 1622989430),
(102, 'abizzy@gmail.com', 'mRsLrYcvWu77cLZ/qEkUo3hkLLB5hOvTTsbKi3MyHcI=', 1622989477),
(103, 'surinem@gmail.com', 'cEex8CMk6VfodKgwTanFguGk+/WrP3ZbXhr54aHPO0U=', 1622989504),
(104, 'dea@gmail.com', 'ujpmwpJA8FVudrr37LYsKcSti/l73Xn2QWh+CQAgI8E=', 1622989521),
(105, 'sheva@gmail.com', 'VQdxQbQPA3eIF6uRuZxF/7ofAej5la1YJOtrs7YBcqs=', 1622989558),
(106, 'tera@gmail.com', 'S5iKXX9C33sva9o+XruAPKDIpC6hChVGIywesX8RhPw=', 1622989581),
(109, 'hipyo@gmail.com', '/f28EsV3jvuGpEKTEFtUhDDmfccmAIiBZr4rK6hGwdU=', 1623232070),
(110, 'artisan@gmail.com', 'LyZH7z7QI+tY+PS22NXL/aDpBGDd1mKGUimXdbH6viE=', 1623233091);

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
-- Indexes for table `chatall`
--
ALTER TABLE `chatall`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_chat` (`id_user`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id_comment`);

--
-- Indexes for table `dompet`
--
ALTER TABLE `dompet`
  ADD PRIMARY KEY (`id_dompet`),
  ADD KEY `fk_user_dompet` (`id_user`);

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
  ADD KEY `id_user` (`id_user`),
  ADD KEY `FK3_gp_tugas` (`tugas`);

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
-- Indexes for table `pengumuman`
--
ALTER TABLE `pengumuman`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_ADMINPENGUMUMAN` (`id_user`);

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
  ADD PRIMARY KEY (`id_report`),
  ADD KEY `FKIDUSER-REPORT` (`id_user`),
  ADD KEY `FKIDPOSTING-REPORT` (`id_posting`);

--
-- Indexes for table `report_hafalan`
--
ALTER TABLE `report_hafalan`
  ADD PRIMARY KEY (`id_hafalan`) USING BTREE,
  ADD KEY `FK1_report_idTugas` (`id_tugas`),
  ADD KEY `FK2_report_idUser` (`id_user`),
  ADD KEY `FK3_report_idGroup` (`id_group`);

--
-- Indexes for table `suka`
--
ALTER TABLE `suka`
  ADD PRIMARY KEY (`id_suka`),
  ADD KEY `FKIDPOSTING-SUKA` (`id_posting`),
  ADD KEY `FKIDUSER-SUKA` (`id`),
  ADD KEY `FKIDUSERTUJUAN-SUKA` (`id_tujuan`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_ADMINTASK` (`id_user`);

--
-- Indexes for table `transaksi_topup_dompet`
--
ALTER TABLE `transaksi_topup_dompet`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `fk_user_topup` (`id_user`);

--
-- Indexes for table `trigger_user`
--
ALTER TABLE `trigger_user`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `tugas_hafalan`
--
ALTER TABLE `tugas_hafalan`
  ADD PRIMARY KEY (`id_tugas`) USING BTREE,
  ADD KEY `FK1_idgroup` (`id_group`),
  ADD KEY `FK2_idUser` (`id_user`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FKUROLE-USER` (`role_id`);

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
  MODIFY `id_anggota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `chatall`
--
ALTER TABLE `chatall`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id_comment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `dompet`
--
ALTER TABLE `dompet`
  MODIFY `id_dompet` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `follow`
--
ALTER TABLE `follow`
  MODIFY `id_follow` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

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
  MODIFY `id_notif` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `group_postingan`
--
ALTER TABLE `group_postingan`
  MODIFY `id_posting` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `grup`
--
ALTER TABLE `grup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `hafalan`
--
ALTER TABLE `hafalan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `infaq`
--
ALTER TABLE `infaq`
  MODIFY `id_infaq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
  MODIFY `id_notification` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=495;

--
-- AUTO_INCREMENT for table `pengumuman`
--
ALTER TABLE `pengumuman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `pesan`
--
ALTER TABLE `pesan`
  MODIFY `id_pesan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `postgen`
--
ALTER TABLE `postgen`
  MODIFY `id_posting` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `posting`
--
ALTER TABLE `posting`
  MODIFY `id_posting` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=305;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `id_report` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=134;

--
-- AUTO_INCREMENT for table `report_hafalan`
--
ALTER TABLE `report_hafalan`
  MODIFY `id_hafalan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `suka`
--
ALTER TABLE `suka`
  MODIFY `id_suka` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=277;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `trigger_user`
--
ALTER TABLE `trigger_user`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=156;

--
-- AUTO_INCREMENT for table `tugas_hafalan`
--
ALTER TABLE `tugas_hafalan`
  MODIFY `id_tugas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=166;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_token`
--
ALTER TABLE `user_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

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
-- Constraints for table `chatall`
--
ALTER TABLE `chatall`
  ADD CONSTRAINT `fk_user_chat` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `dompet`
--
ALTER TABLE `dompet`
  ADD CONSTRAINT `fk_user_dompet` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `FK3_gp_tugas` FOREIGN KEY (`tugas`) REFERENCES `tugas_hafalan` (`id_tugas`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_idGrup` FOREIGN KEY (`id_group`) REFERENCES `grup` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_idUser` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `grup`
--
ALTER TABLE `grup`
  ADD CONSTRAINT `fkUser` FOREIGN KEY (`owner`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pengumuman`
--
ALTER TABLE `pengumuman`
  ADD CONSTRAINT `FK_ADMINPENGUMUMAN` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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

--
-- Constraints for table `report`
--
ALTER TABLE `report`
  ADD CONSTRAINT `FKIDPOSTING-REPORT` FOREIGN KEY (`id_posting`) REFERENCES `posting` (`id_posting`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FKIDUSER-REPORT` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `report_hafalan`
--
ALTER TABLE `report_hafalan`
  ADD CONSTRAINT `FK1_report_idTugas` FOREIGN KEY (`id_tugas`) REFERENCES `tugas_hafalan` (`id_tugas`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK2_report_idUser` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK3_report_idGroup` FOREIGN KEY (`id_group`) REFERENCES `grup` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `suka`
--
ALTER TABLE `suka`
  ADD CONSTRAINT `FKIDPOSTING-SUKA` FOREIGN KEY (`id_posting`) REFERENCES `posting` (`id_posting`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FKIDUSER-SUKA` FOREIGN KEY (`id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `FK_ADMINTASK` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaksi_topup_dompet`
--
ALTER TABLE `transaksi_topup_dompet`
  ADD CONSTRAINT `fk_user_topup` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tugas_hafalan`
--
ALTER TABLE `tugas_hafalan`
  ADD CONSTRAINT `FK1_idgroup` FOREIGN KEY (`id_group`) REFERENCES `grup` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK2_idUser` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FKUROLE-USER` FOREIGN KEY (`role_id`) REFERENCES `user_role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
