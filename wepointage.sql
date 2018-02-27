-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 27, 2018 at 11:07 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `wepointage`
--

-- --------------------------------------------------------

--
-- Table structure for table `atdrecord`
--

CREATE TABLE IF NOT EXISTS `atdrecord` (
  `id_AtdRecord` int(11) NOT NULL AUTO_INCREMENT,
  `SerialId` int(11) NOT NULL,
  `CardNo` varchar(255) NOT NULL,
  `RecDate` varchar(222) NOT NULL,
  `RecTime` varchar(255) NOT NULL,
  `dateb` varchar(222) NOT NULL,
  PRIMARY KEY (`id_AtdRecord`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16843 ;

--
-- Dumping data for table `atdrecord`
--

INSERT INTO `atdrecord` (`id_AtdRecord`, `SerialId`, `CardNo`, `RecDate`, `RecTime`, `dateb`) VALUES
(16828, 2, '1', '2018-02-23', '2:57:47', '2018-02-23 2:57:47'),
(16829, 3, '1', '2018-02-24', '22:19:55', '2018-02-24 22:19:55'),
(16830, 4, '1', '2018-02-24', '22:20:8', '2018-02-24 22:20:8'),
(16831, 5, '2', '2018-02-24', '10:59:39', '2018-02-24 10:59:39'),
(16832, 6, '2', '2018-02-24', '10:59:56', '2018-02-24 10:59:56'),
(16833, 7, '1', '2018-02-24', '11:3:25', '2018-02-24 11:3:25'),
(16834, 8, '2', '2018-02-24', '11:3:27', '2018-02-24 11:3:27'),
(16835, 9, '2', '2018-02-26', '18:3:57', '2018-02-26 18:3:57'),
(16836, 10, '1', '2018-02-26', '18:5:27', '2018-02-26 18:5:27'),
(16837, 11, '2', '2018-02-26', '18:5:31', '2018-02-26 18:5:31'),
(16838, 12, '1', '2018-02-26', '18:6:9', '2018-02-26 18:6:9'),
(16839, 13, '2', '2018-02-26', '18:9:25', '2018-02-26 18:9:25'),
(16840, 14, '1', '2018-02-26', '18:9:27', '2018-02-26 18:9:27'),
(16841, 15, '1', '2018-02-26', '21:11:25', '2018-02-26 21:11:25'),
(16842, 16, '2', '2018-02-26', '21:24:14', '2018-02-26 21:24:14');

-- --------------------------------------------------------

--
-- Table structure for table `groupes_salaries`
--

CREATE TABLE IF NOT EXISTS `groupes_salaries` (
  `id_groupe_salarie` int(11) NOT NULL AUTO_INCREMENT,
  `nom_groupe_salarie` varchar(255) NOT NULL,
  PRIMARY KEY (`id_groupe_salarie`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `groupes_salaries`
--

INSERT INTO `groupes_salaries` (`id_groupe_salarie`, `nom_groupe_salarie`) VALUES
(1, 'Personnel'),
(2, 'CAT2'),
(3, 'CAT3'),
(4, 'CAT4'),
(5, 'CAT5');

-- --------------------------------------------------------

--
-- Table structure for table `jours_feries`
--

CREATE TABLE IF NOT EXISTS `jours_feries` (
  `id_jour_ferie` int(11) NOT NULL AUTO_INCREMENT,
  `nom_jour_ferie` varchar(255) NOT NULL,
  `du_au` varchar(255) NOT NULL,
  PRIMARY KEY (`id_jour_ferie`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE IF NOT EXISTS `permissions` (
  `id_permission` int(11) NOT NULL,
  `groupe_permission` varchar(255) NOT NULL,
  `1_permission` int(11) NOT NULL,
  `2_permission` int(11) NOT NULL,
  `3_permission` int(11) NOT NULL,
  `4_permission` int(11) NOT NULL,
  `5_permission` int(11) NOT NULL,
  `6_permission` int(11) NOT NULL,
  `7_permission` int(11) NOT NULL,
  `8_permission` int(11) NOT NULL,
  `9_permission` int(11) NOT NULL,
  `10_permission` int(11) NOT NULL,
  `11_permission` int(11) NOT NULL,
  `12_permission` int(11) NOT NULL,
  `13_permission` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id_permission`, `groupe_permission`, `1_permission`, `2_permission`, `3_permission`, `4_permission`, `5_permission`, `6_permission`, `7_permission`, `8_permission`, `9_permission`, `10_permission`, `11_permission`, `12_permission`, `13_permission`) VALUES
(1, 'Administrateur', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `salaries`
--

CREATE TABLE IF NOT EXISTS `salaries` (
  `id_salarie` int(11) NOT NULL AUTO_INCREMENT,
  `id_salarie_pointeuse` varchar(255) NOT NULL,
  `id_groupe_salarie` int(11) NOT NULL,
  `nom_salarie` varchar(255) NOT NULL,
  `prenom_salarie` varchar(255) NOT NULL,
  `profession_salarie` varchar(255) NOT NULL,
  PRIMARY KEY (`id_salarie`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=163 ;

--
-- Dumping data for table `salaries`
--

INSERT INTO `salaries` (`id_salarie`, `id_salarie_pointeuse`, `id_groupe_salarie`, `nom_salarie`, `prenom_salarie`, `profession_salarie`) VALUES
(1, '1', 1, 'boukroun', 'mourad', ''),
(162, '2', 1, 'HMIDA', 'kri', '');

-- --------------------------------------------------------

--
-- Table structure for table `utilisateurs`
--

CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo_user` varchar(255) NOT NULL,
  `mail_user` varchar(255) NOT NULL,
  `mdp_user` varchar(255) NOT NULL,
  `nom_user` varchar(255) NOT NULL,
  `prenom_user` varchar(255) NOT NULL,
  `date_creation_user` varchar(255) NOT NULL,
  `picture_user` varchar(255) NOT NULL DEFAULT 'assets/dist/img/default.png',
  `group_user` varchar(255) NOT NULL DEFAULT 'Admin',
  `corbeille_user` int(11) NOT NULL DEFAULT '1',
  UNIQUE KEY `id_user` (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=106 ;

--
-- Dumping data for table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id_user`, `pseudo_user`, `mail_user`, `mdp_user`, `nom_user`, `prenom_user`, `date_creation_user`, `picture_user`, `group_user`, `corbeille_user`) VALUES
(100, 'new.ucef', 'a@a.com', 'e10adc3949ba59abbe56e057f20f883e', 'tes1', 'test2', '01-10-2016', 'assets/dist/img/user2-160x160.jpg', 'Admin', 1),
(101, 'Mourad', 'boukroun@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Boukroun', 'Mourad', '01-10-2016', 'assets/dist/img/default.png', 'Admin', 1),
(102, '', 'directeur@pointage.com', 'e10adc3949ba59abbe56e057f20f883e', 'ESSAYDI', 'Rachid', '', 'assets/dist/img/default.png', 'Admin', 1),
(103, '', 'essayedi-rachid@hotmail.fr', 'e10adc3949ba59abbe56e057f20f883e', 'Directeur', 'ESSAYEDI Rachid', '', 'assets/dist/img/default.png', 'Admin', 1),
(104, '', 'darouich.amine@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Darouich', 'Amin', '', 'assets/dist/img/default.png', 'Admin', 1),
(105, '', 'directeur2@ezzaitoune.com', 'e10adc3949ba59abbe56e057f20f883e', 'MUSTAPHA', 'BELKAS', '', 'assets/dist/img/default.png', 'Admin', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
