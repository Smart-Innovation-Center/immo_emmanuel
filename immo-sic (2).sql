-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 22 fév. 2022 à 14:39
-- Version du serveur :  5.7.31
-- Version de PHP : 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `immo-sic`
--

-- --------------------------------------------------------

--
-- Structure de la table `agences`
--

DROP TABLE IF EXISTS `agences`;
CREATE TABLE IF NOT EXISTS `agences` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_modification` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `date_suppression` datetime DEFAULT NULL,
  `date_creation` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `structure_id_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_B46015DDAA95C5C1` (`structure_id_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `agences`
--

INSERT INTO `agences` (`id`, `libelle`, `email`, `contact`, `adresse`, `date_modification`, `date_suppression`, `date_creation`, `structure_id_id`) VALUES
(2, 'Agence1', 'agence@mail.com', '020202020202', '7, rue de la garenne - 93200 Saint-Denis', '2021-11-22 10:03:43', NULL, '2021-11-22 10:03:43', 5),
(6, 'Koko Agence 1', 'kok_agence@gmail.com', '1478596321', 'YAMOUSSOKRO', '2022-01-05 16:43:45', NULL, '2022-01-05 16:43:45', 9),
(8, 'KO', 'ko@gmail.com', '0748028796', 'ko', '2022-01-06 12:21:57', NULL, '2022-01-06 12:21:57', 9),
(9, 'ABEU', 'ab_beu@yahoo.fr', '15963578', 'COCODY ABIDJAN ANGRE STAR 14', '2022-01-06 12:39:58', NULL, '2022-01-06 12:39:58', 9),
(10, 'LOLO', 'lo@gmail.com', '010203045050', 'Man', '2022-01-07 15:23:18', NULL, '2022-01-07 15:23:18', 9),
(11, 'Agence test', 'test@gmail.com', '0456891456', 'Makono', '2022-01-17 15:21:37', NULL, '2022-01-17 15:21:37', 9),
(12, 'IL', 'il@mail.com', '14151617181920', 'MAKONO', '2022-01-25 09:27:47', NULL, '2022-01-25 09:27:47', 9);

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `img` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `count_by_cat` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `img`, `count_by_cat`) VALUES
(1, 'Studio Appartements', 'studio appartements', 'categories-1.jpg', NULL),
(2, 'Luxury Houses', 'luxury houses', 'categories-2.jpg', NULL),
(3, 'Cozy Houses', 'cozy houses', 'categories-3.jpg', NULL),
(4, 'With Swimming Pool', 'with swimming pool', 'categories-4.jpg', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`id`, `name`, `slug`) VALUES
(1, 'Bla Bla car', 'bla bla car'),
(2, 'Blo Blo Cor', 'blo blo cor');

-- --------------------------------------------------------

--
-- Structure de la table `city`
--

DROP TABLE IF EXISTS `city`;
CREATE TABLE IF NOT EXISTS `city` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `city`
--

INSERT INTO `city` (`id`, `title`, `name`, `slug`, `meta_title`, `meta_description`) VALUES
(1, 'Miami Luxury Real Estate', 'Miami', 'miami', 'Miami Luxury Real Estate', NULL),
(2, 'West Palm Beach, FL Apartments', 'Palm Beach', 'palm-beach', 'West Palm Beach, FL Apartments', NULL),
(3, 'Tampa Real Estate', 'Tampa', 'tampa', 'Tampa Real Estate', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `currency`
--

DROP TABLE IF EXISTS `currency`;
CREATE TABLE IF NOT EXISTS `currency` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `currency_title` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `symbol_left` varchar(12) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `symbol_right` varchar(12) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `currency`
--

INSERT INTO `currency` (`id`, `currency_title`, `code`, `symbol_left`, `symbol_right`) VALUES
(1, 'US Dollar', 'USD', '$', ''),
(2, 'Euro', 'EUR', '', '€'),
(3, 'Pound Sterling', 'GBP', '£', ''),
(4, 'Hong Kong Dollar', 'HKD', 'HK$', ''),
(5, 'Russian Ruble', 'RUB', '₽', ''),
(6, 'Belarusian ruble', 'BYN', '', 'Br');

-- --------------------------------------------------------

--
-- Structure de la table `deal_type`
--

DROP TABLE IF EXISTS `deal_type`;
CREATE TABLE IF NOT EXISTS `deal_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `deal_type`
--

INSERT INTO `deal_type` (`id`, `name`, `slug`) VALUES
(1, 'Rent', 'rent'),
(2, 'Sale', 'sale');

-- --------------------------------------------------------

--
-- Structure de la table `district`
--

DROP TABLE IF EXISTS `district`;
CREATE TABLE IF NOT EXISTS `district` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `city_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_31C154878BAC62AF` (`city_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `district`
--

INSERT INTO `district` (`id`, `city_id`, `name`, `slug`) VALUES
(1, 3, 'South Tampa', 'south-tampa');

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20200328162849', '2021-11-12 13:18:14', 2456),
('DoctrineMigrations\\Version20200705110619', '2021-11-12 13:18:16', 102),
('DoctrineMigrations\\Version20210104185420', '2021-11-12 13:18:16', 41),
('DoctrineMigrations\\Version20210106154655', '2021-11-12 13:18:16', 26),
('DoctrineMigrations\\Version20210106191712', '2021-11-12 13:18:16', 1),
('DoctrineMigrations\\Version20210106234742', '2021-11-12 13:18:16', 6),
('DoctrineMigrations\\Version20210107000119', '2021-11-12 13:18:16', 26),
('DoctrineMigrations\\Version20210215083338', '2021-11-12 13:18:16', 0),
('DoctrineMigrations\\Version20210215173522', '2021-11-12 13:18:16', 0),
('DoctrineMigrations\\Version20210815075052', '2021-11-12 13:18:16', 115),
('DoctrineMigrations\\Version20210817062054', '2021-11-12 13:18:16', 141),
('DoctrineMigrations\\Version20211116105737', '2021-11-16 12:57:19', 157),
('DoctrineMigrations\\Version20211116140643', '2021-11-16 14:07:43', 70),
('DoctrineMigrations\\Version20211117095144', '2021-11-17 09:51:57', 133),
('DoctrineMigrations\\Version20211117101240', '2021-11-17 10:12:50', 158),
('DoctrineMigrations\\Version20211117133849', '2021-11-17 13:39:00', 150),
('DoctrineMigrations\\Version20211117143653', '2021-11-17 14:37:06', 180),
('DoctrineMigrations\\Version20211117144054', '2021-11-17 14:41:04', 215),
('DoctrineMigrations\\Version20211117161819', '2021-11-17 16:18:29', 176),
('DoctrineMigrations\\Version20211117161937', '2021-11-17 16:19:44', 162),
('DoctrineMigrations\\Version20211118103717', '2021-11-18 10:37:39', 156),
('DoctrineMigrations\\Version20211118132744', '2021-11-18 13:32:44', 38),
('DoctrineMigrations\\Version20211118143041', '2021-11-18 14:30:54', 139),
('DoctrineMigrations\\Version20211118172528', '2021-11-18 17:25:42', 203),
('DoctrineMigrations\\Version20211122094700', '2021-11-22 09:47:17', 200),
('DoctrineMigrations\\Version20211122114103', '2021-11-22 11:41:17', 532),
('DoctrineMigrations\\Version20211122165332', '2021-11-22 16:53:50', 267),
('DoctrineMigrations\\Version20211123090415', '2021-11-23 09:04:26', 156),
('DoctrineMigrations\\Version20211123090922', '2021-11-23 09:09:37', 103),
('DoctrineMigrations\\Version20211123091643', '2021-11-23 09:16:54', 104),
('DoctrineMigrations\\Version20211123092713', '2021-11-23 09:27:28', 157),
('DoctrineMigrations\\Version20211124103114', '2021-11-24 10:31:27', 230),
('DoctrineMigrations\\Version20211124120659', '2021-11-24 12:07:10', 129),
('DoctrineMigrations\\Version20211130122751', '2021-11-30 12:28:02', 407),
('DoctrineMigrations\\Version20211130153553', '2021-11-30 15:36:05', 86),
('DoctrineMigrations\\Version20211202150331', '2021-12-02 15:03:46', 334),
('DoctrineMigrations\\Version20211203113152', '2021-12-03 11:32:06', 202),
('DoctrineMigrations\\Version20211207161119', '2021-12-07 16:11:43', 464),
('DoctrineMigrations\\Version20211207162009', '2021-12-07 16:20:24', 178),
('DoctrineMigrations\\Version20211208101921', '2021-12-08 10:19:33', 218),
('DoctrineMigrations\\Version20211208102444', '2021-12-08 10:24:56', 147),
('DoctrineMigrations\\Version20211208111334', '2021-12-08 11:13:50', 109),
('DoctrineMigrations\\Version20211208122350', '2021-12-08 12:24:03', 140),
('DoctrineMigrations\\Version20211208133043', '2021-12-08 13:30:57', 197),
('DoctrineMigrations\\Version20211208133528', '2021-12-08 13:35:40', 275),
('DoctrineMigrations\\Version20211208133736', '2021-12-08 13:37:45', 330),
('DoctrineMigrations\\Version20211208135540', '2021-12-08 14:43:19', 265),
('DoctrineMigrations\\Version20211208144350', '2021-12-08 14:43:56', 189),
('DoctrineMigrations\\Version20211213145220', '2021-12-15 01:44:05', 197),
('DoctrineMigrations\\Version20211213154104', '2021-12-15 01:44:05', 106),
('DoctrineMigrations\\Version20211213154355', '2021-12-15 01:44:06', 11),
('DoctrineMigrations\\Version20211215015710', '2021-12-15 02:01:35', 252),
('DoctrineMigrations\\Version20220114121744', '2022-01-14 12:18:45', 337);

-- --------------------------------------------------------

--
-- Structure de la table `exterior_type`
--

DROP TABLE IF EXISTS `exterior_type`;
CREATE TABLE IF NOT EXISTS `exterior_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `feature`
--

DROP TABLE IF EXISTS `feature`;
CREATE TABLE IF NOT EXISTS `feature` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` longtext COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `feature`
--

INSERT INTO `feature` (`id`, `name`, `icon`) VALUES
(1, 'Air conditioning', NULL),
(2, 'Balcony', NULL),
(3, 'Elevator', NULL),
(4, 'Fire Alarm', NULL),
(5, 'First Floor Entry', NULL),
(6, 'High Impact Doors', NULL),
(7, 'Patio', NULL),
(8, 'Secure parking', '<i class=\"fas fa-parking\"></i>');

-- --------------------------------------------------------

--
-- Structure de la table `location`
--

DROP TABLE IF EXISTS `location`;
CREATE TABLE IF NOT EXISTS `location` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bien_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date_debut` date NOT NULL,
  `date_fin` date NOT NULL,
  `libelle` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `loyer` int(11) NOT NULL,
  `caution` int(11) NOT NULL,
  `avance` int(11) DEFAULT NULL,
  `recorder_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_5E9E89CBBD95B80F` (`bien_id`),
  KEY `IDX_5E9E89CBA76ED395` (`user_id`),
  KEY `IDX_5E9E89CB77549ADA` (`recorder_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `location`
--

INSERT INTO `location` (`id`, `bien_id`, `user_id`, `date_debut`, `date_fin`, `libelle`, `loyer`, `caution`, `avance`, `recorder_id`) VALUES
(1, 1, 20, '2022-01-17', '2022-02-17', 'Monsieur Emmanuel loue le bien', 12000, 72000, 50000, 19),
(2, 1, 25, '2022-01-26', '2022-02-26', 'RAS', 14717, 1477, 14587, 19);

-- --------------------------------------------------------

--
-- Structure de la table `menu`
--

DROP TABLE IF EXISTS `menu`;
CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort_order` smallint(6) DEFAULT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nofollow` tinyint(1) DEFAULT NULL,
  `new_tab` tinyint(1) DEFAULT NULL,
  `locale` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `url_locale_unique_key` (`url`,`locale`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `menu`
--

INSERT INTO `menu` (`id`, `title`, `sort_order`, `url`, `nofollow`, `new_tab`, `locale`) VALUES
(1, 'Homepage', NULL, '/', NULL, NULL, 'en'),
(2, 'About Us', NULL, '/info/about-us', NULL, NULL, 'en'),
(3, 'Contact', NULL, '/info/contact', NULL, NULL, 'en'),
(4, 'Начало', NULL, '/', NULL, NULL, 'bg'),
(5, 'За нас', NULL, '/info/about-us', NULL, NULL, 'bg'),
(6, 'Контакти', NULL, '/info/contact', NULL, NULL, 'bg');

-- --------------------------------------------------------

--
-- Structure de la table `metro`
--

DROP TABLE IF EXISTS `metro`;
CREATE TABLE IF NOT EXISTS `metro` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `city_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_3884E4E18BAC62AF` (`city_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `metro`
--

INSERT INTO `metro` (`id`, `city_id`, `name`, `slug`) VALUES
(1, 1, 'Government Center', 'government-center'),
(2, 1, 'Allapattah', 'allapattah'),
(3, 1, 'Brickell', 'brickell'),
(4, 1, 'Culmer', 'culmer');

-- --------------------------------------------------------

--
-- Structure de la table `neighborhood`
--

DROP TABLE IF EXISTS `neighborhood`;
CREATE TABLE IF NOT EXISTS `neighborhood` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `city_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_FEF1E9EE8BAC62AF` (`city_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `neighborhood`
--

INSERT INTO `neighborhood` (`id`, `city_id`, `name`, `slug`) VALUES
(1, 1, 'South Beach', 'south-beach'),
(2, 1, 'Downtown', 'downtown'),
(3, 3, 'Ballast Point', 'ballast-point'),
(4, 3, 'Culbreath Isles', 'culbreath-isles');

-- --------------------------------------------------------

--
-- Structure de la table `page`
--

DROP TABLE IF EXISTS `page`;
CREATE TABLE IF NOT EXISTS `page` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci,
  `show_in_menu` tinyint(1) NOT NULL,
  `add_contact_form` tinyint(1) NOT NULL,
  `contact_email_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `locale` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'en',
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug_locale_unique_key` (`slug`,`locale`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `page`
--

INSERT INTO `page` (`id`, `title`, `description`, `slug`, `content`, `show_in_menu`, `add_contact_form`, `contact_email_address`, `locale`) VALUES
(1, 'About Us', 'About Us Page', 'about-us', '<h3>Why Choose Us</h3>\r\n                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit,\r\n                sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.\r\n                Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris\r\n                nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in\r\n                reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>\r\n                <h3>Our Properties</h3>\r\n                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit,\r\n                sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.\r\n                Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris\r\n                nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in\r\n                reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>\r\n                <h3>legal notice</h3>\r\n                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit,\r\n                sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.\r\n                Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris\r\n                nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in\r\n                reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>', 1, 0, NULL, 'en'),
(2, 'Contact', 'Contact Us', 'contact', NULL, 1, 1, 'example@domain.com', 'en'),
(3, 'За нас', 'Страница за нас', 'about-us', '<h3>Защо да изберете нас?</h3>\r\n                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit,\r\n                sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.\r\n                Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris\r\n                nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in\r\n                reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>\r\n                <h3>Нашите имоти</h3>\r\n                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit,\r\n                sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.\r\n                Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris\r\n                nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in\r\n                reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>\r\n                <h3>Правно съгласие</h3>\r\n                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit,\r\n                sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.\r\n                Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris\r\n                nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in\r\n                reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>', 1, 0, NULL, 'bg'),
(4, 'Контакти', 'Страница контакти', 'contact', NULL, 1, 1, 'example@domain.com', 'bg');

-- --------------------------------------------------------

--
-- Structure de la table `parking_type`
--

DROP TABLE IF EXISTS `parking_type`;
CREATE TABLE IF NOT EXISTS `parking_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `photo`
--

DROP TABLE IF EXISTS `photo`;
CREATE TABLE IF NOT EXISTS `photo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `property_id` int(11) DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort_order` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_14B78418549213EC` (`property_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `photo`
--

INSERT INTO `photo` (`id`, `property_id`, `photo`, `sort_order`) VALUES
(1, 1, 'demo/1.jpeg', 1),
(2, 2, 'demo/2.jpeg', 2),
(3, 3, 'demo/3.jpeg', 1),
(4, 4, 'demo/4.jpeg', 2),
(5, 5, 'demo/5.jpeg', 1),
(6, 6, 'demo/6.jpeg', 2),
(7, 7, 'demo/7.jpeg', 1),
(8, 8, 'demo/2.jpeg', 2),
(9, 9, 'demo/8.jpeg', 1),
(10, 10, 'demo/9.jpeg', 2),
(11, 11, 'demo/4.jpeg', 3),
(12, 12, 'demo/10.jpeg', 1);

-- --------------------------------------------------------

--
-- Structure de la table `prisede_rdv`
--

DROP TABLE IF EXISTS `prisede_rdv`;
CREATE TABLE IF NOT EXISTS `prisede_rdv` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_rdv` datetime NOT NULL,
  `contact_visiteur` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prenoms` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_D2D31865444F97DD` (`phone`),
  UNIQUE KEY `UNIQ_D2D31865A1CF58F3` (`date_rdv`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `prisede_rdv`
--

INSERT INTO `prisede_rdv` (`id`, `fullname`, `phone`, `date_rdv`, `contact_visiteur`, `nom`, `prenoms`, `email`) VALUES
(1, 'ABEU KPIDI FREDERIC', '25 0749517916', '2021-12-17 00:00:00', NULL, NULL, NULL, 'abeufrederic@gmail.com'),
(2, 'YAPO ETIENNE OHOUEU', '0632257765', '2021-12-23 00:00:00', NULL, NULL, NULL, 'abeufrederic@gmail.com'),
(3, 'ABEU KPIDI FREDERIC', '22549517916', '2021-12-30 00:00:00', NULL, NULL, NULL, 'abeufrederic@gmail.com'),
(4, 'ABEU KPIDI FREDERIC', '225 0749517916', '2021-12-18 08:00:00', NULL, NULL, NULL, 'abeufrederic@gmail.com'),
(5, 'faissal benmoussa', '0625216497', '2021-12-18 16:30:00', NULL, NULL, NULL, 'nguetiaabenankabecca@gmail.com'),
(6, 'ABEU', '+22549517916', '2022-06-20 09:00:00', NULL, NULL, NULL, 'ab_beu@yahoo.fr');

-- --------------------------------------------------------

--
-- Structure de la table `profile`
--

DROP TABLE IF EXISTS `profile`;
CREATE TABLE IF NOT EXISTS `profile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `full_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8157AA0FA76ED395` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `property`
--

DROP TABLE IF EXISTS `property`;
CREATE TABLE IF NOT EXISTS `property` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author_id` int(11) NOT NULL,
  `deal_type_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `neighborhood_id` int(11) DEFAULT NULL,
  `metro_station_id` int(11) DEFAULT NULL,
  `district_id` int(11) DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bathrooms_number` smallint(6) DEFAULT NULL,
  `bedrooms_number` smallint(6) DEFAULT NULL,
  `max_guests` smallint(6) DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `latitude` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longitude` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `show_map` tinyint(1) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `price_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `available_now` tinyint(1) DEFAULT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `priority_number` int(11) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `elementary_school` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `area` int(11) NOT NULL,
  `garage` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `school_district` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `high_school` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `middlle_school` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` int(11) NOT NULL,
  `img` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `img_slide` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `in_slide` tinyint(1) DEFAULT NULL,
  `statut_property_id` int(11) DEFAULT NULL,
  `type_property_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_8BF21CDEF675F31B` (`author_id`),
  KEY `IDX_8BF21CDE2156041B` (`deal_type_id`),
  KEY `IDX_8BF21CDE8BAC62AF` (`city_id`),
  KEY `IDX_8BF21CDE803BB24B` (`neighborhood_id`),
  KEY `IDX_8BF21CDEF7D58AAA` (`metro_station_id`),
  KEY `IDX_8BF21CDEB08FA272` (`district_id`),
  KEY `IDX_8BF21CDE12469DE2` (`category_id`),
  KEY `IDX_8BF21CDE2D3B6045` (`statut_property_id`),
  KEY `IDX_8BF21CDE1F8BC47D` (`type_property_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `property`
--

INSERT INTO `property` (`id`, `author_id`, `deal_type_id`, `city_id`, `neighborhood_id`, `metro_station_id`, `district_id`, `slug`, `bathrooms_number`, `bedrooms_number`, `max_guests`, `address`, `latitude`, `longitude`, `show_map`, `price`, `price_type`, `available_now`, `state`, `priority_number`, `created_at`, `updated_at`, `elementary_school`, `area`, `garage`, `school_district`, `high_school`, `middlle_school`, `category_id`, `img`, `img_slide`, `in_slide`, `statut_property_id`, `type_property_id`) VALUES
(1, 1, 2, 3, 4, 3, 1, 'Building: 123 on the Park', NULL, 5, NULL, '4935 New Providence Ave, Tampa, FL', '27.932255', '-82.533187', 1, 4300, 'sq. foot', NULL, 'published', 0, '2021-11-12 13:18:18', '2021-11-12 13:18:18', '', 0, '', '', '', '', 1, 'index-1.jpg', 'slide-1.jpg', 1, 1, 1),
(2, 20, 1, 2, 4, 4, 1, 'stylish-two-level-penthouse-in-palm-beach', NULL, 2, 5, '101 Worth Ave, Palm Beach, FL 33480', '26.701320', '-80.033688', 1, 2000, 'mo', NULL, 'published', 0, '2021-11-12 13:18:18', '2021-11-12 13:18:18', '', 100, '', '', '', '', 2, 'index-2.jpg', 'slide-2.jpg', 1, 1, NULL),
(3, 20, 1, 1, 1, 4, NULL, 'bright-and-cheerful-alcove-studio', NULL, NULL, 4, '1451 Ocean Dr, Miami Beach, FL 33139', '25.785107', '-80.129460', 1, 200, 'day', NULL, 'published', 0, '2021-11-12 13:18:18', '2021-11-12 13:18:18', '', 0, '', '', '', '', 3, 'index-11.jpg', 'slide-3.jpg', 1, 1, NULL),
(4, 11, 1, 1, 1, 3, NULL, 'modern-one-bedroom-apartment-in-miami', NULL, 1, 2, '1451 Ocean Dr, Miami Beach, FL 33139', '25.785107', '-80.129460', 1, 250, 'day', NULL, 'published', 0, '2021-11-12 13:18:18', '2021-11-12 13:18:18', '', 0, '', '', '', '', 4, 'index-4.jpg', NULL, 0, 1, 1),
(5, 11, 1, 2, 1, 1, NULL, 'bright-fully-furnished-1-bedroom-flat-on-the-2nd-floor', NULL, 1, 3, '300 S Ocean Blvd, Palm Beach, FL', '26.705007', '-80.033574', 1, 180, 'day', NULL, 'published', 0, '2021-11-12 13:18:18', '2021-11-12 13:18:18', '', 0, '', '', '', '', 1, 'index-5.jpg', NULL, 0, 3, NULL),
(6, 2, 2, 1, 2, 1, NULL, 'interesting-two-bedroom-apartment-for-sale', NULL, 2, NULL, '111 NE 2nd Ave, Miami, FL 33132', '25.775565', '-80.190125', 1, 190000, NULL, 0, 'published', 0, '2021-11-12 13:18:18', '2021-11-19 11:18:40', '', 0, '', '', '', '', 2, 'index-6.jpg', NULL, 0, 3, NULL),
(7, 2, 1, 3, 3, 1, NULL, 'furnished-renovated-2-bedroom-2-bathroom-flat', NULL, 2, 6, '5411 Bayshore Blvd, Tampa, FL 33611', '27.885095', '-82.486153', 1, 2200, 'mo', NULL, 'published', 0, '2021-11-12 13:18:18', '2021-11-12 13:18:18', '', 2000, '', '', '', '', 3, 'index-7.jpg', NULL, 0, 3, NULL),
(8, 2, 1, 3, 3, 1, NULL, 'furnished-renovated-2-bedroom-2-bathroom-flat', NULL, 2, 6, '5411 Bayshore Blvd, Tampa, FL 33611', '27.885095', '-82.486153', 1, 2200, 'mo', NULL, 'published', 0, '2021-11-12 13:18:18', '2021-11-12 13:18:18', '', 0, '', '', '', '', 3, 'index-7.jpg', NULL, 0, 3, NULL),
(9, 2, 2, 1, 1, 3, NULL, 'hjdgq', 4, NULL, NULL, 'gdrxgfchvj', NULL, NULL, 0, NULL, NULL, 0, 'published', 0, '2021-12-03 11:25:31', '2021-12-03 11:25:31', '', 0, '', '', '', '', 4, 'index-8.jpg', NULL, 0, 2, NULL),
(10, 1, 1, 2, 3, 1, NULL, 'bright-fully-furnished-1-bedroom-flat-on-the-2nd-floor', NULL, 1, 3, '300 S Ocean Blvd, Palm Beach, FL', '26.705007', '-80.033574', 1, 180, 'day', NULL, 'published', 0, '2021-11-12 13:18:18', '2021-11-12 13:18:18', '', 0, '', '', '', '', 1, 'index-5.jpg', NULL, 0, 4, NULL),
(11, 8, 1, 2, 3, 2, NULL, 'stylish-two-level-penthouse-in-palm-beach', NULL, 2, 5, '101 Worth Ave, Palm Beach, FL 33480', '26.701320', '-80.033688', 1, 2000, 'mo', NULL, 'published', 0, '2021-11-12 13:18:18', '2021-11-12 13:18:18', '', 0, '', '', '', '', 2, 'index-2.jpg', NULL, 0, 1, NULL),
(12, 8, 1, 2, 3, 1, NULL, 'stylish-two-level-penthouse-in-palm-beach', NULL, 2, 5, '101 Worth Ave, Palm Beach, FL 33480', '26.701320', '-80.033688', 1, 2000, 'mo', NULL, 'published', 0, '2021-11-12 13:18:18', '2021-11-12 13:18:18', '', 1000, '', '', '', '', 2, 'index-2.jpg', NULL, 0, 3, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `property_description`
--

DROP TABLE IF EXISTS `property_description`;
CREATE TABLE IF NOT EXISTS `property_description` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `property_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci,
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_D2818010549213EC` (`property_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `property_description`
--

INSERT INTO `property_description` (`id`, `property_id`, `title`, `content`, `meta_title`, `meta_description`) VALUES
(1, 1, 'Beautiful villa for sale in Tampa', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit,\r\n                sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.\r\n                Ut enim ad minim veniam, quis nostrud exercitation ullamco\r\n                laboris nisi ut aliquip ex ea commodo consequat.\r\n                Duis aute irure dolor in reprehenderit in voluptate\r\n                velit esse cillum dolore eu fugiat nulla pariatur.\r\n                Excepteur sint occaecat cupidatat non proident, sunt in culpa qui\r\n                officia deserunt mollit anim id est laborum.</p>\r\n                <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem\r\n                accusantium doloremque laudantium, totam rem aperiam,\r\n                eaque ipsa quae ab illo inventore veritatis et quasi\r\n                architecto beatae vitae dicta sunt explicabo.\r\n                Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut\r\n                odit aut fugit, sed quia consequuntur magni dolores eos qui\r\n                ratione voluptatem sequi nesciunt. Neque porro quisquam est,\r\n                qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit,\r\n                sed quia non numquam eius modi tempora incidunt ut labore et dolore\r\n                magnam aliquam quaerat voluptatem. Ut enim ad minima veniam,\r\n                quis nostrum exercitationem ullam corporis suscipit laboriosam,\r\n                nisi ut aliquid ex ea commodi consequatur.</p>', NULL, 'Beautiful villa for sale in Tampa'),
(2, 2, 'Stylish two-level penthouse in Palm Beach', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit,\r\n                sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.\r\n                Ut enim ad minim veniam, quis nostrud exercitation ullamco\r\n                laboris nisi ut aliquip ex ea commodo consequat.\r\n                Duis aute irure dolor in reprehenderit in voluptate\r\n                velit esse cillum dolore eu fugiat nulla pariatur.\r\n                Excepteur sint occaecat cupidatat non proident, sunt in culpa qui\r\n                officia deserunt mollit anim id est laborum.</p>\r\n                <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem\r\n                accusantium doloremque laudantium, totam rem aperiam,\r\n                eaque ipsa quae ab illo inventore veritatis et quasi\r\n                architecto beatae vitae dicta sunt explicabo.\r\n                Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut\r\n                odit aut fugit, sed quia consequuntur magni dolores eos qui\r\n                ratione voluptatem sequi nesciunt. Neque porro quisquam est,\r\n                qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit,\r\n                sed quia non numquam eius modi tempora incidunt ut labore et dolore\r\n                magnam aliquam quaerat voluptatem. Ut enim ad minima veniam,\r\n                quis nostrum exercitationem ullam corporis suscipit laboriosam,\r\n                nisi ut aliquid ex ea commodi consequatur.</p>', NULL, 'Stylish two-level penthouse in Palm Beach'),
(3, 3, 'Bright and Cheerful alcove studio', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit,\r\n                sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.\r\n                Ut enim ad minim veniam, quis nostrud exercitation ullamco\r\n                laboris nisi ut aliquip ex ea commodo consequat.\r\n                Duis aute irure dolor in reprehenderit in voluptate\r\n                velit esse cillum dolore eu fugiat nulla pariatur.\r\n                Excepteur sint occaecat cupidatat non proident, sunt in culpa qui\r\n                officia deserunt mollit anim id est laborum.</p>\r\n                <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem\r\n                accusantium doloremque laudantium, totam rem aperiam,\r\n                eaque ipsa quae ab illo inventore veritatis et quasi\r\n                architecto beatae vitae dicta sunt explicabo.\r\n                Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut\r\n                odit aut fugit, sed quia consequuntur magni dolores eos qui\r\n                ratione voluptatem sequi nesciunt. Neque porro quisquam est,\r\n                qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit,\r\n                sed quia non numquam eius modi tempora incidunt ut labore et dolore\r\n                magnam aliquam quaerat voluptatem. Ut enim ad minima veniam,\r\n                quis nostrum exercitationem ullam corporis suscipit laboriosam,\r\n                nisi ut aliquid ex ea commodi consequatur.</p>', NULL, 'Bright and Cheerful alcove studio'),
(4, 4, 'Modern one-bedroom apartment in Miami', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit,\r\n                sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.\r\n                Ut enim ad minim veniam, quis nostrud exercitation ullamco\r\n                laboris nisi ut aliquip ex ea commodo consequat.\r\n                Duis aute irure dolor in reprehenderit in voluptate\r\n                velit esse cillum dolore eu fugiat nulla pariatur.\r\n                Excepteur sint occaecat cupidatat non proident, sunt in culpa qui\r\n                officia deserunt mollit anim id est laborum.</p>\r\n                <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem\r\n                accusantium doloremque laudantium, totam rem aperiam,\r\n                eaque ipsa quae ab illo inventore veritatis et quasi\r\n                architecto beatae vitae dicta sunt explicabo.\r\n                Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut\r\n                odit aut fugit, sed quia consequuntur magni dolores eos qui\r\n                ratione voluptatem sequi nesciunt. Neque porro quisquam est,\r\n                qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit,\r\n                sed quia non numquam eius modi tempora incidunt ut labore et dolore\r\n                magnam aliquam quaerat voluptatem. Ut enim ad minima veniam,\r\n                quis nostrum exercitationem ullam corporis suscipit laboriosam,\r\n                nisi ut aliquid ex ea commodi consequatur.</p>', NULL, 'Modern one-bedroom apartment in Miami'),
(5, 5, 'Bright fully furnished 1-bedroom flat on the 2nd floor', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit,\r\n                sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.\r\n                Ut enim ad minim veniam, quis nostrud exercitation ullamco\r\n                laboris nisi ut aliquip ex ea commodo consequat.\r\n                Duis aute irure dolor in reprehenderit in voluptate\r\n                velit esse cillum dolore eu fugiat nulla pariatur.\r\n                Excepteur sint occaecat cupidatat non proident, sunt in culpa qui\r\n                officia deserunt mollit anim id est laborum.</p>\r\n                <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem\r\n                accusantium doloremque laudantium, totam rem aperiam,\r\n                eaque ipsa quae ab illo inventore veritatis et quasi\r\n                architecto beatae vitae dicta sunt explicabo.\r\n                Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut\r\n                odit aut fugit, sed quia consequuntur magni dolores eos qui\r\n                ratione voluptatem sequi nesciunt. Neque porro quisquam est,\r\n                qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit,\r\n                sed quia non numquam eius modi tempora incidunt ut labore et dolore\r\n                magnam aliquam quaerat voluptatem. Ut enim ad minima veniam,\r\n                quis nostrum exercitationem ullam corporis suscipit laboriosam,\r\n                nisi ut aliquid ex ea commodi consequatur.</p>', NULL, 'Bright fully furnished 1-bedroom flat on the 2nd floor'),
(6, 6, 'Interesting two-bedroom apartment for sale', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit,\r\n                sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.\r\n                Ut enim ad minim veniam, quis nostrud exercitation ullamco\r\n                laboris nisi ut aliquip ex ea commodo consequat.\r\n                Duis aute irure dolor in reprehenderit in voluptate\r\n                velit esse cillum dolore eu fugiat nulla pariatur.\r\n                Excepteur sint occaecat cupidatat non proident, sunt in culpa qui\r\n                officia deserunt mollit anim id est laborum.</p>\r\n                <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem\r\n                accusantium doloremque laudantium, totam rem aperiam,\r\n                eaque ipsa quae ab illo inventore veritatis et quasi\r\n                architecto beatae vitae dicta sunt explicabo.\r\n                Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut\r\n                odit aut fugit, sed quia consequuntur magni dolores eos qui\r\n                ratione voluptatem sequi nesciunt. Neque porro quisquam est,\r\n                qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit,\r\n                sed quia non numquam eius modi tempora incidunt ut labore et dolore\r\n                magnam aliquam quaerat voluptatem. Ut enim ad minima veniam,\r\n                quis nostrum exercitationem ullam corporis suscipit laboriosam,\r\n                nisi ut aliquid ex ea commodi consequatur.</p>', NULL, 'Interesting two-bedroom apartment for sale'),
(7, 7, 'Furnished renovated 2-bedroom 2-bathroom flat', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit,\r\n                sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.\r\n                Ut enim ad minim veniam, quis nostrud exercitation ullamco\r\n                laboris nisi ut aliquip ex ea commodo consequat.\r\n                Duis aute irure dolor in reprehenderit in voluptate\r\n                velit esse cillum dolore eu fugiat nulla pariatur.\r\n                Excepteur sint occaecat cupidatat non proident, sunt in culpa qui\r\n                officia deserunt mollit anim id est laborum.</p>\r\n                <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem\r\n                accusantium doloremque laudantium, totam rem aperiam,\r\n                eaque ipsa quae ab illo inventore veritatis et quasi\r\n                architecto beatae vitae dicta sunt explicabo.\r\n                Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut\r\n                odit aut fugit, sed quia consequuntur magni dolores eos qui\r\n                ratione voluptatem sequi nesciunt. Neque porro quisquam est,\r\n                qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit,\r\n                sed quia non numquam eius modi tempora incidunt ut labore et dolore\r\n                magnam aliquam quaerat voluptatem. Ut enim ad minima veniam,\r\n                quis nostrum exercitationem ullam corporis suscipit laboriosam,\r\n                nisi ut aliquid ex ea commodi consequatur.</p>', NULL, 'Furnished renovated 2-bedroom 2-bathroom flat'),
(9, 9, 'hjdgq', '<p>vhuyhtwhtxfjycgkvhlbjmknljhgfdswgdxhfgcjvkb</p>', 'gcghjk', 'hyfffffhgjk'),
(10, 8, 'Furnished renovated 2-bedroom 2-bathroom flat', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit,\r\n                sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.\r\n                Ut enim ad minim veniam, quis nostrud exercitation ullamco\r\n                laboris nisi ut aliquip ex ea commodo consequat.\r\n                Duis aute irure dolor in reprehenderit in voluptate\r\n                velit esse cillum dolore eu fugiat nulla pariatur.\r\n                Excepteur sint occaecat cupidatat non proident, sunt in culpa qui\r\n                officia deserunt mollit anim id est laborum.</p>\r\n                <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem\r\n                accusantium doloremque laudantium, totam rem aperiam,\r\n                eaque ipsa quae ab illo inventore veritatis et quasi\r\n                architecto beatae vitae dicta sunt explicabo.\r\n                Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut\r\n                odit aut fugit, sed quia consequuntur magni dolores eos qui\r\n                ratione voluptatem sequi nesciunt. Neque porro quisquam est,\r\n                qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit,\r\n                sed quia non numquam eius modi tempora incidunt ut labore et dolore\r\n                magnam aliquam quaerat voluptatem. Ut enim ad minima veniam,\r\n                quis nostrum exercitationem ullam corporis suscipit laboriosam,\r\n                nisi ut aliquid ex ea commodi consequatur.</p>', NULL, 'Furnished renovated 2-bedroom 2-bathroom flat'),
(11, 10, 'Bright Fully Furnished 1 Bedroom Flat on the 2nd', 'Bla bla bla bla', 'Bla bLa bla', 'Bla Bal bal'),
(12, 11, 'Stylish two level penthouse in palm beach', 'Stylish two level penthouse in palm beach', 'Stylish two level penthouse in palm beach', 'Stylish two level penthouse in palm beach'),
(13, 12, 'Stylish two level penthouse in palm beach', 'Stylish two level penthouse in palm beach', 'Stylish two level penthouse in palm beach', 'Stylish two level penthouse in palm beach');

-- --------------------------------------------------------

--
-- Structure de la table `property_feature`
--

DROP TABLE IF EXISTS `property_feature`;
CREATE TABLE IF NOT EXISTS `property_feature` (
  `property_id` int(11) NOT NULL,
  `feature_id` int(11) NOT NULL,
  PRIMARY KEY (`property_id`,`feature_id`),
  KEY `IDX_461A3F1E549213EC` (`property_id`),
  KEY `IDX_461A3F1E60E4B879` (`feature_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `rdv`
--

DROP TABLE IF EXISTS `rdv`;
CREATE TABLE IF NOT EXISTS `rdv` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bien_id` int(11) NOT NULL,
  `utilisateur_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `heure` time NOT NULL,
  `is_effect` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_10C31F86BD95B80F` (`bien_id`),
  KEY `IDX_10C31F86FB88E14F` (`utilisateur_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `roof_type`
--

DROP TABLE IF EXISTS `roof_type`;
CREATE TABLE IF NOT EXISTS `roof_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `setting_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `setting_value` longtext COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_E545A0C59F9752E0` (`setting_name`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `settings`
--

INSERT INTO `settings` (`id`, `setting_name`, `setting_value`) VALUES
(4, 'name', 'Site name'),
(5, 'title', 'Popular Listing'),
(6, 'meta_title', 'Site Title'),
(7, 'meta_description', 'Site Description'),
(8, 'custom_code', ''),
(9, 'custom_footer_text', 'All Rights Reserved.'),
(10, 'items_per_page', '6'),
(11, 'ymaps_key', ''),
(12, 'map_center', '27.188534, -81.128735'),
(13, 'map_zoom', '7'),
(14, 'currency_id', '1'),
(15, 'header_image', ''),
(16, 'logo_image', ''),
(17, 'fixed_top_navbar', '0'),
(18, 'show_similar_properties', '0'),
(19, 'show_filter_by_city', '1'),
(20, 'show_filter_by_deal_type', '1'),
(21, 'show_filter_by_category', '1'),
(22, 'show_filter_by_features', '0'),
(23, 'show_filter_by_bedrooms', '0'),
(24, 'show_filter_by_guests', '0'),
(25, 'show_language_selector', '1');

-- --------------------------------------------------------

--
-- Structure de la table `slide`
--

DROP TABLE IF EXISTS `slide`;
CREATE TABLE IF NOT EXISTS `slide` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `img` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `title_principal` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `slide`
--

INSERT INTO `slide` (`id`, `img`, `price`, `title_principal`, `description`) VALUES
(1, 'slide-3.jpg', 239, 'Modera Loft', 'Make Modera Loft your home and reside in historic Jersey City style.'),
(2, 'slide-1.jpg', 309, '1530-2 Liberty Ave 4', 'This is a 3 bedroom, 2.0 bathroom multi family home. It is located at 1530 Liberty Ave Hillside.'),
(3, 'slide-2.jpg', 216, '53 Rachel Ct 53', 'A renovated apartment for rent by owner. 2 bedroom, 2 full bath living and dining room');

-- --------------------------------------------------------

--
-- Structure de la table `statut_property`
--

DROP TABLE IF EXISTS `statut_property`;
CREATE TABLE IF NOT EXISTS `statut_property` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `statut_property`
--

INSERT INTO `statut_property` (`id`, `libelle`) VALUES
(1, 'Terrain vacant'),
(2, 'Commercial(e)'),
(3, 'résidentiel(le)'),
(4, 'Maisons'),
(5, 'Condos'),
(6, 'Maisons de ville'),
(7, 'Saisies');

-- --------------------------------------------------------

--
-- Structure de la table `structures`
--

DROP TABLE IF EXISTS `structures`;
CREATE TABLE IF NOT EXISTS `structures` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `site_web` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_creation` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `date_modification` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  `date_suppression` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  `numero_registe_de_commerce` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_5BBEC55AA4D60759` (`libelle`),
  UNIQUE KEY `UNIQ_5BBEC55A4C62E638` (`contact`),
  UNIQUE KEY `UNIQ_5BBEC55AE7927C74` (`email`),
  UNIQUE KEY `UNIQ_5BBEC55AE1540971` (`site_web`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `structures`
--

INSERT INTO `structures` (`id`, `libelle`, `adresse`, `contact`, `email`, `site_web`, `date_creation`, `date_modification`, `date_suppression`, `numero_registe_de_commerce`) VALUES
(5, 'Structure test', 'adresse 1', '123456789', 'structure@gmail.com', 'siteweb.com', '2021-11-22 10:00:03', '2021-11-22 10:00:03', NULL, '15-81478'),
(9, 'KOKO EXPERTISE', 'KOKO/BOUAKE', '022566666666', 'kokoexpertise@gmail.com', 'kokoexpert.ci', '2022-01-05 16:43:45', '2022-01-05 16:43:45', NULL, '20025973007MOTO');

-- --------------------------------------------------------

--
-- Structure de la table `transfer`
--

DROP TABLE IF EXISTS `transfer`;
CREATE TABLE IF NOT EXISTS `transfer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `transferred_object_id` int(11) NOT NULL,
  `origin` int(11) NOT NULL,
  `destination` int(11) NOT NULL,
  `etat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_tranfer_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_4034A3C0CFFF8730` (`type_tranfer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `transfer`
--

INSERT INTO `transfer` (`id`, `transferred_object_id`, `origin`, `destination`, `etat`, `type_tranfer_id`) VALUES
(1, 1, 4, 11, 'EN ATTENTE', 1),
(2, 8, 9, 5, 'VALIDE', 4),
(3, 11, 2, 12, 'ANNULE', 10);

-- --------------------------------------------------------

--
-- Structure de la table `type_property`
--

DROP TABLE IF EXISTS `type_property`;
CREATE TABLE IF NOT EXISTS `type_property` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `couleur_menu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fontawesome` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_460D3B22A4D60759` (`libelle`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `type_property`
--

INSERT INTO `type_property` (`id`, `libelle`, `couleur_menu`, `fontawesome`) VALUES
(1, 'Terrain', '#b22c07', 'fa fa-chart-area'),
(2, 'Appartement', '#404fea', 'fa fa-building');

-- --------------------------------------------------------

--
-- Structure de la table `type_transfer`
--

DROP TABLE IF EXISTS `type_transfer`;
CREATE TABLE IF NOT EXISTS `type_transfer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `couleur` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `type_transfer`
--

INSERT INTO `type_transfer` (`id`, `libelle`, `description`, `couleur`, `slug`) VALUES
(1, 'Propriétaire transfère un bien à un autre Propriétaire', 'Ce type de transfèrement intervient quand un propriétaire décide de transférer un bien à un un autre propriétaire', '#0075bf', 'Propriétaire =>Bien => Propriétaire'),
(2, 'Propriétaire transfère un bien à une Agence', 'Ce type de transfèrement intervient quand un propriétaire décide de transférer un bien à une agence', '#a36f00', 'Propriétaire => Bien => Agence'),
(3, 'Propriétaire transfère un bien à une Structure', 'Ce type de transfèrement intervient quand un propriétaire décide de transférer un bien à une structure', '#07cdd7', 'Propriétaire => Bien => Structure'),
(4, 'Structure transfère une agence à une autre Structure', 'Ce type de transfèrement intervient quand une structure veut transférer une agence à une autre structure', '#0075bf', 'Structure => Agence => Structure'),
(5, 'Structure transfère un propriétaire à une Structure', 'Structure transfère un propriétaire à une Structure', 'green', 'Structure => Propriétaire => Structure'),
(6, 'Structure transfère un bien à une Structure', 'Structure transfère bien à une Structure', 'orange', 'Structure => Bien => Structure'),
(7, 'Structure transfère un bien à un Propriétaire', 'Structure transfère un bien à Propriétaire', '#ff0e10', 'Structure => Bien => Propriétaire'),
(8, 'Structure transfère un propriétaire à une Agence', 'Structure transfère un propriétaire à une Agence', '#2f0e10', 'Structure => Propriétaire => Agence'),
(9, 'Structure transfère un bien à une Agence', 'Structure transfère un bien à une Agence', '#00ac98', 'Structure => Bien => Agence'),
(10, 'Agence transfère bien à une Agence', 'Agence transfère bien à une Agence', 'pink', 'Agence => Bien => Agence'),
(11, 'Agence transfère propriétaire à Agence', 'Agence transfère propriétaire à Agence', '#0057fb', 'Agence => Propriétaire => Agence'),
(12, 'Agence transfère bien à un Propriétaire', 'Agence transfère bien à un Propriétaire', '#472f5d', 'Agence => Bien => Propriétaire');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `confirmation_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `agence_id_id` int(11) DEFAULT NULL,
  `is_verified` tinyint(1) NOT NULL,
  `atcif` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_1483A5E9F85E0677` (`username`),
  UNIQUE KEY `UNIQ_1483A5E9E7927C74` (`email`),
  KEY `IDX_1483A5E9D1F6E7C3` (`agence_id_id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `roles`, `confirmation_token`, `password_requested_at`, `agence_id_id`, `is_verified`, `atcif`) VALUES
(1, 'admin', 'admin@admin.com', '$2y$13$n9FoLXv7PZqATZhMq1Xe3uNhthf8NHrBDU0qwe80IHL5OReW10IdG', '[\"ROLE_ADMIN\"]', NULL, NULL, 2, 0, 1),
(2, 'user', 'user@user.com', '$2y$13$4askyul99BYgUIpSSUS..uWk6p175T27ePju7T/O7kGiEXvU3HCRO', '[\"ROLE_USER\"]', NULL, NULL, 2, 0, 1),
(4, 'mode', 'abeufrederic@gmail.com', '$2y$13$n9FoLXv7PZqATZhMq1Xe3uNhthf8NHrBDU0qwe80IHL5OReW10IdG', '[\"ROLE_PROPRIETAIRE\"]', NULL, NULL, 2, 0, 1),
(8, 'mode2', 'nguetiaabenankabecca@gmail.com', '$2y$13$dmO8WlPoO9khBAtIADHsNu0qMhfvOu9E5noiX7N7KzF/BPAHhU4G2', '[\"ROLE_PROPRIETAIRE\"]', NULL, NULL, 6, 0, 0),
(11, 'abeufrederic@gmail.com', 'ab_be@yahoo.fr', '$2y$13$sWY9S.0s.oAGmwBhfzMnvOHfvhdiAPQt8rxRrQB1SrUuheLvFGtNa', '[\"ROLE_PROPRIETAIRE\"]', NULL, NULL, 9, 0, 0),
(12, 'Structure1', 'strcture@gmail.com', '$2y$13$gqlmdd42AoyPz0BVLfUlkuxXtTTg6m2cP.fUe9FLQAsWeOsyRhlhu', '[\"ROLE_STRUCTURE\"]', NULL, NULL, 8, 0, 0),
(16, 'Malachie', 'malachie@gmail.com', '$2y$13$tVXKO/y9AY2vSZu0ZFuPsOlCWy37RGtoaMs3bn9jIyExIYnZRwQU2', '[\"ROLE_STRUCTURE\"]', NULL, NULL, 6, 0, 1),
(17, 'Michée', 'michee@gmail.com', '$2y$13$SLPqsBuTHCAXKY77zycAS.2usuKZzhLIbzDDAakeJryU7naPsBUu6', '[\"ROLE_STRUCTURE\"]', NULL, NULL, 6, 0, 1),
(19, 'koko', 'koko@gmail.com', '$2y$13$SQX4gWLU.0evQ9GzuxILKel7S9wMe1LTEXlJN3skZfuwhd.VzqPDq', '[\"ROLE_STRUCTURE\"]', NULL, NULL, 6, 0, 1),
(20, 'Emmanuel', 'emm@gmail.com', '$2y$13$Nh8Cz9Qww5JIq81NbeFc5OhG2yvMzEYuDuZSxs1MZTjJpiVe6BoIe', '[\"ROLE_PROPRIETAIRE\"]', NULL, NULL, 6, 0, 0),
(25, 'Jean Baptise', 'jean@gmail.com', '$2y$13$twLnyXYtotO7Uwy1yySbW.0pnRILYzTjMhMBqbslHaciVqdf8fEWa', '[\"ROLE_LOCATAIRE\"]', NULL, NULL, 8, 0, 0),
(26, 'test', 'test@gmail.com', '$2y$13$./i67iA/lq20JqKxt3A9L..SINmPVryNME2ckdTAdvTVKMDcK1nL2', '[\"ROLE_STRUCTURE\"]', NULL, NULL, 12, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `vente`
--

DROP TABLE IF EXISTS `vente`;
CREATE TABLE IF NOT EXISTS `vente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bien_id` int(11) NOT NULL,
  `prix_vente` int(11) NOT NULL,
  `dossier` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_vente` date NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_888A2A4CBD95B80F` (`bien_id`),
  KEY `IDX_888A2A4CA76ED395` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `view_type`
--

DROP TABLE IF EXISTS `view_type`;
CREATE TABLE IF NOT EXISTS `view_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `agences`
--
ALTER TABLE `agences`
  ADD CONSTRAINT `FK_B46015DDAA95C5C1` FOREIGN KEY (`structure_id_id`) REFERENCES `structures` (`id`);

--
-- Contraintes pour la table `district`
--
ALTER TABLE `district`
  ADD CONSTRAINT `IDX_31C154878BAC62AF` FOREIGN KEY (`city_id`) REFERENCES `city` (`id`);

--
-- Contraintes pour la table `location`
--
ALTER TABLE `location`
  ADD CONSTRAINT `FK_5E9E89CB77549ADA` FOREIGN KEY (`recorder_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `FK_5E9E89CBA76ED395` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `FK_5E9E89CBBD95B80F` FOREIGN KEY (`bien_id`) REFERENCES `property` (`id`);

--
-- Contraintes pour la table `metro`
--
ALTER TABLE `metro`
  ADD CONSTRAINT `IDX_3884E4E18BAC62AF` FOREIGN KEY (`city_id`) REFERENCES `city` (`id`);

--
-- Contraintes pour la table `neighborhood`
--
ALTER TABLE `neighborhood`
  ADD CONSTRAINT `IDX_FEF1E9EE8BAC62AF` FOREIGN KEY (`city_id`) REFERENCES `city` (`id`);

--
-- Contraintes pour la table `photo`
--
ALTER TABLE `photo`
  ADD CONSTRAINT `IDX_14B78418549213EC` FOREIGN KEY (`property_id`) REFERENCES `property` (`id`);

--
-- Contraintes pour la table `profile`
--
ALTER TABLE `profile`
  ADD CONSTRAINT `FK_8157AA0FA76ED395` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `property`
--
ALTER TABLE `property`
  ADD CONSTRAINT `FK_8BF21CDE12469DE2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `FK_8BF21CDE1F8BC47D` FOREIGN KEY (`type_property_id`) REFERENCES `type_property` (`id`),
  ADD CONSTRAINT `FK_8BF21CDE2D3B6045` FOREIGN KEY (`statut_property_id`) REFERENCES `statut_property` (`id`),
  ADD CONSTRAINT `IDX_8BF21CDE2156041B` FOREIGN KEY (`deal_type_id`) REFERENCES `deal_type` (`id`),
  ADD CONSTRAINT `IDX_8BF21CDE803BB24B` FOREIGN KEY (`neighborhood_id`) REFERENCES `neighborhood` (`id`),
  ADD CONSTRAINT `IDX_8BF21CDE8BAC62AF` FOREIGN KEY (`city_id`) REFERENCES `city` (`id`),
  ADD CONSTRAINT `IDX_8BF21CDEB08FA272` FOREIGN KEY (`district_id`) REFERENCES `district` (`id`),
  ADD CONSTRAINT `IDX_8BF21CDEF675F31B` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `IDX_8BF21CDEF7D58AAA` FOREIGN KEY (`metro_station_id`) REFERENCES `metro` (`id`);

--
-- Contraintes pour la table `property_description`
--
ALTER TABLE `property_description`
  ADD CONSTRAINT `FK_D2818010549213EC` FOREIGN KEY (`property_id`) REFERENCES `property` (`id`);

--
-- Contraintes pour la table `property_feature`
--
ALTER TABLE `property_feature`
  ADD CONSTRAINT `IDX_461A3F1E549213EC` FOREIGN KEY (`property_id`) REFERENCES `property` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `IDX_461A3F1E60E4B879` FOREIGN KEY (`feature_id`) REFERENCES `feature` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `rdv`
--
ALTER TABLE `rdv`
  ADD CONSTRAINT `FK_10C31F86BD95B80F` FOREIGN KEY (`bien_id`) REFERENCES `property` (`id`),
  ADD CONSTRAINT `FK_10C31F86FB88E14F` FOREIGN KEY (`utilisateur_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `transfer`
--
ALTER TABLE `transfer`
  ADD CONSTRAINT `FK_4034A3C0CFFF8730` FOREIGN KEY (`type_tranfer_id`) REFERENCES `type_transfer` (`id`);

--
-- Contraintes pour la table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `FK_1483A5E9D1F6E7C3` FOREIGN KEY (`agence_id_id`) REFERENCES `agences` (`id`);

--
-- Contraintes pour la table `vente`
--
ALTER TABLE `vente`
  ADD CONSTRAINT `FK_888A2A4CA76ED395` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `FK_888A2A4CBD95B80F` FOREIGN KEY (`bien_id`) REFERENCES `property` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
