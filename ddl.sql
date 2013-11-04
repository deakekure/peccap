-- phpMyAdmin SQL Dump
-- version 4.0.6deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 05, 2013 at 02:31 AM
-- Server version: 5.5.34-0ubuntu0.13.10.1
-- PHP Version: 5.5.3-1ubuntu2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `peccap`
--

-- --------------------------------------------------------

--
-- Table structure for table `peccap_annual_period`
--

CREATE TABLE IF NOT EXISTS `peccap_annual_period` (
  `year` int(11) NOT NULL,
  `current` int(11) NOT NULL,
  PRIMARY KEY (`year`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `peccap_annual_period`
--

INSERT INTO `peccap_annual_period` (`year`, `current`) VALUES
(2005, 0),
(2006, 0),
(2007, 0),
(2008, 0),
(2009, 0),
(2010, 0),
(2011, 0),
(2012, 0),
(2013, 1);

-- --------------------------------------------------------

--
-- Table structure for table `peccap_expenditure`
--

CREATE TABLE IF NOT EXISTS `peccap_expenditure` (
  `domain_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `category_id` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `territory_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `annual_period` int(11) NOT NULL,
  `expenditure_total` double NOT NULL,
  PRIMARY KEY (`domain_id`,`category_id`,`territory_id`,`annual_period`),
  KEY `IDX_69F6CFC9115F0EE5` (`domain_id`),
  KEY `IDX_69F6CFC912469DE2` (`category_id`),
  KEY `IDX_69F6CFC973F74AD4` (`territory_id`),
  KEY `IDX_69F6CFC9620B0F8D` (`annual_period`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `peccap_expenditure_category`
--

CREATE TABLE IF NOT EXISTS `peccap_expenditure_category` (
  `id` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `order_number` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `peccap_expenditure_category`
--

INSERT INTO `peccap_expenditure_category` (`id`, `description`, `order_number`) VALUES
('barangjasa', 'Belanja Barang Jasa', 2),
('lain', 'Belanja Lainnya', 4),
('modal', 'Belanja Modal', 3),
('pegawai', 'Belanja Pegawai', 1);

-- --------------------------------------------------------

--
-- Table structure for table `peccap_expenditure_domain`
--

CREATE TABLE IF NOT EXISTS `peccap_expenditure_domain` (
  `id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `order_number` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `peccap_expenditure_domain`
--

INSERT INTO `peccap_expenditure_domain` (`id`, `name`, `order_number`) VALUES
('agama', 'Agama', 1),
('budpar', 'Pariwisata dan Budaya', 7),
('ekonomi', 'Ekonomi', 2),
('infrastruktur', 'Infrastruktur', 3),
('kamtib', 'Ketertiban dan Keamanan', 5),
('kesehatan', 'Kesehatan', 4),
('lingkunganhidup', 'Lingkungan Hidup', 6),
('pelayananumum', 'Pelayanan Umum', 8),
('pendidikan', 'Pendidikan', 9),
('perlindungansosial', 'Perlindungan Sosial', 10),
('pertanian', 'Pertanian', 11),
('perumahan', 'Perumahan', 12);

-- --------------------------------------------------------

--
-- Table structure for table `peccap_income`
--

CREATE TABLE IF NOT EXISTS `peccap_income` (
  `source_name` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `annual_period` int(11) NOT NULL,
  `territory_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `income_total` double NOT NULL,
  PRIMARY KEY (`source_name`,`annual_period`,`territory_id`),
  KEY `IDX_4A28300E5FA9FB05` (`source_name`),
  KEY `IDX_4A28300E620B0F8D` (`annual_period`),
  KEY `IDX_4A28300E73F74AD4` (`territory_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `peccap_income_source`
--

CREATE TABLE IF NOT EXISTS `peccap_income_source` (
  `name` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `order_number` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `peccap_income_source`
--

INSERT INTO `peccap_income_source` (`name`, `description`, `order_number`) VALUES
('dak', 'Dana Alokasi Khusus (DAK)', 4),
('dau', 'Dana Alokasi Umum (DAU)', 3),
('dbhpajak', 'Dana Bagi Hasil Pajak', 1),
('dbhsda', 'Dana Bagi Hasil SDA', 2),
('lain', 'Sumber Pendapatan Lain', 6),
('pad', 'Pendapatan Asli Daerah', 5);

-- --------------------------------------------------------

--
-- Table structure for table `peccap_population`
--

CREATE TABLE IF NOT EXISTS `peccap_population` (
  `territory_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `annual_period` int(11) NOT NULL,
  `population_number` int(11) NOT NULL,
  PRIMARY KEY (`territory_id`,`annual_period`),
  KEY `IDX_616898473F74AD4` (`territory_id`),
  KEY `IDX_6168984620B0F8D` (`annual_period`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `peccap_report_template`
--

CREATE TABLE IF NOT EXISTS `peccap_report_template` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `owner_id` int(11) DEFAULT NULL,
  `template_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shared` int(11) NOT NULL,
  `sharing_note` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_8F3F9E6E7E3C61F9` (`owner_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `peccap_report_template_annual_period`
--

CREATE TABLE IF NOT EXISTS `peccap_report_template_annual_period` (
  `template_id` int(11) NOT NULL,
  `annual_period` int(11) NOT NULL,
  PRIMARY KEY (`template_id`,`annual_period`),
  KEY `IDX_E632725B5DA0FB8` (`template_id`),
  KEY `IDX_E632725B620B0F8D` (`annual_period`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `peccap_report_template_category`
--

CREATE TABLE IF NOT EXISTS `peccap_report_template_category` (
  `template_id` int(11) NOT NULL,
  `category_id` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`template_id`,`category_id`),
  KEY `IDX_37EAD3E25DA0FB8` (`template_id`),
  KEY `IDX_37EAD3E212469DE2` (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `peccap_report_template_domain`
--

CREATE TABLE IF NOT EXISTS `peccap_report_template_domain` (
  `template_id` int(11) NOT NULL,
  `domain_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`template_id`,`domain_id`),
  KEY `IDX_343430395DA0FB8` (`template_id`),
  KEY `IDX_34343039115F0EE5` (`domain_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `peccap_report_template_source`
--

CREATE TABLE IF NOT EXISTS `peccap_report_template_source` (
  `template_id` int(11) NOT NULL,
  `source_id` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`template_id`,`source_id`),
  KEY `IDX_CC1751415DA0FB8` (`template_id`),
  KEY `IDX_CC175141953C1C61` (`source_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `peccap_report_template_territory`
--

CREATE TABLE IF NOT EXISTS `peccap_report_template_territory` (
  `template_id` int(11) NOT NULL,
  `territory_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`template_id`,`territory_id`),
  KEY `IDX_4B22EEDE5DA0FB8` (`template_id`),
  KEY `IDX_4B22EEDE73F74AD4` (`territory_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `peccap_role`
--

CREATE TABLE IF NOT EXISTS `peccap_role` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_736C71EE5E237E06` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `peccap_role`
--

INSERT INTO `peccap_role` (`id`, `name`) VALUES
(1, 'Administrator'),
(2, 'Developer');

-- --------------------------------------------------------

--
-- Table structure for table `peccap_territory`
--

CREATE TABLE IF NOT EXISTS `peccap_territory` (
  `id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parent_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_B569DDF5E237E06` (`name`),
  KEY `IDX_B569DDF727ACA70` (`parent_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `peccap_territory`
--

INSERT INTO `peccap_territory` (`id`, `parent_id`, `name`, `type`) VALUES
('11', NULL, 'Aceh', 1),
('11.01', '11', 'Kabupaten Aceh Selatan', 2),
('11.02', '11', 'Kabupaten Aceh Tenggara', 2),
('11.03', '11', 'Kabupaten Aceh Timur', 2),
('11.04', '11', 'Kabupaten Aceh Tengah', 2),
('11.05', '11', 'Kabupaten Aceh Barat', 2),
('11.06', '11', 'Kabupaten Aceh Besar', 2),
('11.07', '11', 'Kabupaten Pidie', 2),
('11.08', '11', 'Kabupaten Aceh Utara', 2),
('11.09', '11', 'Kabupaten Simeulue', 2),
('11.10', '11', 'Kabupaten Aceh Singkil', 2),
('11.11', '11', 'Kabupaten Bireun', 2),
('11.12', '11', 'Kabupaten Aceh Barat Daya', 2),
('11.13', '11', 'Kabupaten Gayo Lues', 2),
('11.14', '11', 'Kabupaten Aceh Jaya', 2),
('11.15', '11', 'Kabupaten Nagan Raya', 2),
('11.16', '11', 'Kabupaten Aceh Tamiang', 2),
('11.17', '11', 'Kabupaten Bener Meriah', 2),
('11.18', '11', 'Kabupaten Pidie Jaya', 2),
('11.71', '11', 'Kota Banda Aceh', 2),
('11.72', '11', 'Kota Sabang', 2),
('11.73', '11', 'Kota Lhokseumawe', 2),
('11.74', '11', 'Kota Langsa', 2),
('11.75', '11', 'Kota Subulussalam', 2);

-- --------------------------------------------------------

--
-- Table structure for table `peccap_user`
--

CREATE TABLE IF NOT EXISTS `peccap_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `login_user_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `login_password` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_A9962DCD443C183A` (`login_user_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `peccap_user`
--

INSERT INTO `peccap_user` (`id`, `full_name`, `login_user_name`, `login_password`) VALUES
(1, 'Administrator', 'administrator', '200ceb26807d6bf99fd6f4f0d1ca54d4'),
(2, 'Developer', 'developer', '5e8edd851d2fdfbd7415232c67367cc3');

-- --------------------------------------------------------

--
-- Table structure for table `peccap_user_role_map`
--

CREATE TABLE IF NOT EXISTS `peccap_user_role_map` (
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `active_status` int(11) NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime DEFAULT NULL,
  PRIMARY KEY (`user_id`,`role_id`),
  KEY `IDX_90FFFB11A76ED395` (`user_id`),
  KEY `IDX_90FFFB11D60322AC` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `peccap_user_role_map`
--

INSERT INTO `peccap_user_role_map` (`user_id`, `role_id`, `active_status`, `start_date`, `end_date`) VALUES
(1, 1, 1, '2013-01-01 00:00:00', NULL),
(2, 1, 1, '2013-01-01 00:00:00', NULL),
(2, 2, 1, '2013-01-01 00:00:00', NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `peccap_expenditure`
--
ALTER TABLE `peccap_expenditure`
  ADD CONSTRAINT `FK_69F6CFC9115F0EE5` FOREIGN KEY (`domain_id`) REFERENCES `peccap_expenditure_domain` (`id`),
  ADD CONSTRAINT `FK_69F6CFC912469DE2` FOREIGN KEY (`category_id`) REFERENCES `peccap_expenditure_category` (`id`),
  ADD CONSTRAINT `FK_69F6CFC9620B0F8D` FOREIGN KEY (`annual_period`) REFERENCES `peccap_annual_period` (`year`),
  ADD CONSTRAINT `FK_69F6CFC973F74AD4` FOREIGN KEY (`territory_id`) REFERENCES `peccap_territory` (`id`);

--
-- Constraints for table `peccap_income`
--
ALTER TABLE `peccap_income`
  ADD CONSTRAINT `FK_4A28300E5FA9FB05` FOREIGN KEY (`source_name`) REFERENCES `peccap_income_source` (`name`),
  ADD CONSTRAINT `FK_4A28300E620B0F8D` FOREIGN KEY (`annual_period`) REFERENCES `peccap_annual_period` (`year`),
  ADD CONSTRAINT `FK_4A28300E73F74AD4` FOREIGN KEY (`territory_id`) REFERENCES `peccap_territory` (`id`);

--
-- Constraints for table `peccap_population`
--
ALTER TABLE `peccap_population`
  ADD CONSTRAINT `FK_6168984620B0F8D` FOREIGN KEY (`annual_period`) REFERENCES `peccap_annual_period` (`year`),
  ADD CONSTRAINT `FK_616898473F74AD4` FOREIGN KEY (`territory_id`) REFERENCES `peccap_territory` (`id`);

--
-- Constraints for table `peccap_report_template`
--
ALTER TABLE `peccap_report_template`
  ADD CONSTRAINT `FK_8F3F9E6E7E3C61F9` FOREIGN KEY (`owner_id`) REFERENCES `peccap_user` (`id`);

--
-- Constraints for table `peccap_report_template_annual_period`
--
ALTER TABLE `peccap_report_template_annual_period`
  ADD CONSTRAINT `FK_E632725B5DA0FB8` FOREIGN KEY (`template_id`) REFERENCES `peccap_report_template` (`id`),
  ADD CONSTRAINT `FK_E632725B620B0F8D` FOREIGN KEY (`annual_period`) REFERENCES `peccap_annual_period` (`year`);

--
-- Constraints for table `peccap_report_template_category`
--
ALTER TABLE `peccap_report_template_category`
  ADD CONSTRAINT `FK_37EAD3E212469DE2` FOREIGN KEY (`category_id`) REFERENCES `peccap_expenditure_category` (`id`),
  ADD CONSTRAINT `FK_37EAD3E25DA0FB8` FOREIGN KEY (`template_id`) REFERENCES `peccap_report_template` (`id`);

--
-- Constraints for table `peccap_report_template_domain`
--
ALTER TABLE `peccap_report_template_domain`
  ADD CONSTRAINT `FK_34343039115F0EE5` FOREIGN KEY (`domain_id`) REFERENCES `peccap_expenditure_domain` (`id`),
  ADD CONSTRAINT `FK_343430395DA0FB8` FOREIGN KEY (`template_id`) REFERENCES `peccap_report_template` (`id`);

--
-- Constraints for table `peccap_report_template_source`
--
ALTER TABLE `peccap_report_template_source`
  ADD CONSTRAINT `FK_CC1751415DA0FB8` FOREIGN KEY (`template_id`) REFERENCES `peccap_report_template` (`id`),
  ADD CONSTRAINT `FK_CC175141953C1C61` FOREIGN KEY (`source_id`) REFERENCES `peccap_income_source` (`name`);

--
-- Constraints for table `peccap_report_template_territory`
--
ALTER TABLE `peccap_report_template_territory`
  ADD CONSTRAINT `FK_4B22EEDE5DA0FB8` FOREIGN KEY (`template_id`) REFERENCES `peccap_report_template` (`id`),
  ADD CONSTRAINT `FK_4B22EEDE73F74AD4` FOREIGN KEY (`territory_id`) REFERENCES `peccap_territory` (`id`);

--
-- Constraints for table `peccap_territory`
--
ALTER TABLE `peccap_territory`
  ADD CONSTRAINT `FK_B569DDF727ACA70` FOREIGN KEY (`parent_id`) REFERENCES `peccap_territory` (`id`);

--
-- Constraints for table `peccap_user_role_map`
--
ALTER TABLE `peccap_user_role_map`
  ADD CONSTRAINT `FK_90FFFB11A76ED395` FOREIGN KEY (`user_id`) REFERENCES `peccap_user` (`id`),
  ADD CONSTRAINT `FK_90FFFB11D60322AC` FOREIGN KEY (`role_id`) REFERENCES `peccap_role` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;