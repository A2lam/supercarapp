-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u2
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Jeu 11 Janvier 2018 à 01:24
-- Version du serveur :  10.0.26-MariaDB-0+deb8u1
-- Version de PHP :  5.6.30-0+deb8u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `supercarapp`
--

-- --------------------------------------------------------

--
-- Structure de la table `address`
--

CREATE TABLE IF NOT EXISTS `address` (
`id` int(11) NOT NULL,
  `addressStreetNb` int(11) DEFAULT NULL,
  `addressStreetName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `addressComplement` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `addressZipCode` int(11) NOT NULL,
  `addressTown` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `addressCountry` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `address`
--

INSERT INTO `address` (`id`, `addressStreetNb`, `addressStreetName`, `addressComplement`, `addressZipCode`, `addressTown`, `addressCountry`) VALUES
(1, 13, 'Rue de la Grange aux Cerfs', NULL, 91700, 'Sainte-Geneviève-des-Bois', 'France'),
(2, 108, 'Rue des vignes', NULL, 13100, 'Marseille', 'France'),
(3, 128, 'Route de Corbeille', NULL, 91700, 'Sainte-Geneviève-des-Bois', 'France'),
(5, 3, 'Cheminement Francis Poulenc', NULL, 31100, 'Toulouse', 'France'),
(6, 13, 'Rue de la Grange aux Cerfs', NULL, 91700, 'Sainte-Geneviève-des-Bois', 'France');

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `admin`
--

INSERT INTO `admin` (`id`, `user_id`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `bonus`
--

CREATE TABLE IF NOT EXISTS `bonus` (
`id` int(11) NOT NULL,
  `seller_id` int(11) NOT NULL,
  `currency_id` int(11) NOT NULL,
  `bonusTotalBonus` int(11) NOT NULL,
  `exerciseMonth` date NOT NULL,
  `adminAdd` int(11) NOT NULL,
  `dateAdd` datetime NOT NULL,
  `userUpdate` int(11) DEFAULT NULL,
  `dateUpdate` datetime DEFAULT NULL,
  `isActive` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `brand`
--

CREATE TABLE IF NOT EXISTS `brand` (
`id` int(11) NOT NULL,
  `brandName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `adminAdd` int(11) NOT NULL,
  `dateAdd` datetime NOT NULL,
  `userUpdate` int(11) DEFAULT NULL,
  `dateUpdate` datetime DEFAULT NULL,
  `isActive` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `brand`
--

INSERT INTO `brand` (`id`, `brandName`, `adminAdd`, `dateAdd`, `userUpdate`, `dateUpdate`, `isActive`) VALUES
(1, 'Ford', 1, '2018-01-11 00:53:40', NULL, NULL, 1),
(2, 'Renault', 1, '2018-01-11 00:53:54', NULL, NULL, 1),
(3, 'Toyota', 1, '2018-01-11 00:54:06', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Structure de la table `car`
--

CREATE TABLE IF NOT EXISTS `car` (
`id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `model_id` int(11) NOT NULL,
  `image_id` int(11) DEFAULT NULL,
  `currency_id` int(11) NOT NULL,
  `storehouse_id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `color` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `energy` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `co2` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `gearBox` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `weight` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `power` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `maxSpeed` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `year` int(11) NOT NULL,
  `isSold` tinyint(1) NOT NULL,
  `adminAdd` int(11) NOT NULL,
  `dateAdd` datetime NOT NULL,
  `userUpdate` int(11) DEFAULT NULL,
  `dateUpdate` datetime DEFAULT NULL,
  `isActive` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `car`
--

INSERT INTO `car` (`id`, `category_id`, `model_id`, `image_id`, `currency_id`, `storehouse_id`, `customer_id`, `color`, `price`, `energy`, `co2`, `gearBox`, `weight`, `power`, `maxSpeed`, `year`, `isSold`, `adminAdd`, `dateAdd`, `userUpdate`, `dateUpdate`, `isActive`) VALUES
(1, 1, 1, 2, 1, 1, NULL, 'Blanche et Bleu', 250000, 'SP 98', '130 g/km', 'Manuelle à 7 rapports', '1250 kg', '500 ch', '200 km/h', 2015, 0, 1, '2018-01-11 01:09:09', NULL, NULL, 1),
(2, 1, 1, 3, 1, 1, NULL, 'Noire mat', 250000, 'SP 98', '130 g/km', 'Manuelle à 7 rapports', '1250 kg', '500 ch', '200 km/h', 2015, 0, 1, '2018-01-11 01:09:44', NULL, NULL, 1),
(3, 1, 1, 4, 1, 1, NULL, 'Rouge', 250000, 'SP 98', '130 g/km', 'Manuelle à 7 rapports', '1250 kg', '500 ch', '200 km/h', 2016, 0, 1, '2018-01-11 01:10:20', NULL, NULL, 1),
(4, 1, 1, 5, 1, 3, NULL, 'Blanche et Bleu', 250000, 'SP 98', '130 g/km', 'Manuelle à 7 rapports', '1250 kg', '500 ch', '200 km/h', 2015, 0, 1, '2018-01-11 01:11:08', NULL, NULL, 1),
(5, 1, 1, 6, 1, 3, NULL, 'Rouge', 250000, 'SP 98', '130 g/km', 'Automatique', '1250 kg', '500 ch', '200 km/h', 2016, 1, 1, '2018-01-11 01:11:51', NULL, NULL, 1),
(6, 2, 3, 7, 1, 1, NULL, 'Bleu', 19000, 'Diesel', '50 g/km', 'Automatique', '1000 kg', '220 ch', '175 km/h', 2012, 0, 1, '2018-01-11 01:13:10', NULL, NULL, 1),
(7, 2, 3, 8, 1, 1, NULL, 'Blanche', 19000, 'Diesel', '50 g/km', 'Automatique', '1000 kg', '220 ch', '175 km/h', 2012, 0, 1, '2018-01-11 01:14:18', NULL, NULL, 1),
(8, 2, 3, 9, 1, 3, NULL, 'Blanche', 19000, 'Diesel', '50 g/km', 'Automatique', '1000 kg', '220 ch', '175 km/h', 2012, 0, 1, '2018-01-11 01:15:14', NULL, NULL, 1),
(9, 3, 2, 10, 1, 1, NULL, 'Blanche', 15000, 'Diesel', '100 g/km', 'Manuelle à 5 rapports', '1500 kg', '220 ch', '175 km/h', 2014, 0, 1, '2018-01-11 01:16:19', NULL, NULL, 1),
(10, 3, 2, 11, 1, 1, NULL, 'Blanche', 15000, 'Diesel', '100 g/km', 'Manuelle à 5 rapports', '1500 kg', '220 ch', '175 km/h', 2014, 0, 1, '2018-01-11 01:16:55', 1, '2018-01-11 01:18:03', 1),
(11, 3, 2, 12, 1, 1, NULL, 'Blanche', 15000, 'Diesel', '100 g/km', 'Manuelle à 5 rapports', '1500 kg', '220 ch', '175 km/h', 2015, 0, 1, '2018-01-11 01:17:30', NULL, NULL, 1),
(12, 3, 2, 13, 1, 3, NULL, 'Blanche', 15000, 'Diesel', '100 g/km', 'Manuelle à 5 rapports', '1500 kg', '220 ch', '175 km/h', 2015, 0, 1, '2018-01-11 01:18:52', NULL, NULL, 1),
(13, 3, 3, 14, 1, 3, NULL, 'Blanche', 15000, 'Diesel', '100 g/km', 'Manuelle à 5 rapports', '1500 kg', '220 ch', '175 km/h', 2015, 0, 1, '2018-01-11 01:19:38', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
`id` int(11) NOT NULL,
  `categoryName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `adminAdd` int(11) NOT NULL,
  `dateAdd` datetime NOT NULL,
  `userUpdate` int(11) DEFAULT NULL,
  `dateUpdate` datetime DEFAULT NULL,
  `isActive` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `category`
--

INSERT INTO `category` (`id`, `categoryName`, `adminAdd`, `dateAdd`, `userUpdate`, `dateUpdate`, `isActive`) VALUES
(1, 'Sportive', 1, '2018-01-11 00:52:05', NULL, NULL, 1),
(2, 'Hybride', 1, '2018-01-11 00:52:20', NULL, NULL, 1),
(3, 'Utilitaire', 1, '2018-01-11 00:52:31', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Structure de la table `currency`
--

CREATE TABLE IF NOT EXISTS `currency` (
`id` int(11) NOT NULL,
  `currencyName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `currencySymbol` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `adminAdd` int(11) NOT NULL,
  `dateAdd` datetime NOT NULL,
  `userUpdate` int(11) DEFAULT NULL,
  `dateUpdate` datetime DEFAULT NULL,
  `isActive` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `currency`
--

INSERT INTO `currency` (`id`, `currencyName`, `currencySymbol`, `adminAdd`, `dateAdd`, `userUpdate`, `dateUpdate`, `isActive`) VALUES
(1, 'Euro', '€', 1, '2018-01-11 00:56:14', NULL, NULL, 1),
(2, 'Dollar', '$', 1, '2018-01-11 00:56:25', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Structure de la table `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
`id` int(11) NOT NULL,
  `address_id` int(11) DEFAULT NULL,
  `customerName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `customerLastname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `customerBday` datetime NOT NULL,
  `customerEmail` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `customerNum` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `adminAdd` int(11) NOT NULL,
  `dateAdd` datetime NOT NULL,
  `userUpdate` int(11) DEFAULT NULL,
  `dateUpdate` datetime DEFAULT NULL,
  `isActive` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `customer`
--

INSERT INTO `customer` (`id`, `address_id`, `customerName`, `customerLastname`, `customerBday`, `customerEmail`, `customerNum`, `adminAdd`, `dateAdd`, `userUpdate`, `dateUpdate`, `isActive`) VALUES
(1, 6, 'HADJI', 'Mohamed Allam', '2013-01-20 00:00:00', 'mohamedallam31@hotmail.com', '669181106', 1, '2018-01-11 01:21:35', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Structure de la table `image`
--

CREATE TABLE IF NOT EXISTS `image` (
`id` int(11) NOT NULL,
  `imageExtension` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `imageAlt` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `image`
--

INSERT INTO `image` (`id`, `imageExtension`, `imageAlt`) VALUES
(1, NULL, NULL),
(2, NULL, NULL),
(3, NULL, NULL),
(4, NULL, NULL),
(5, NULL, NULL),
(6, NULL, NULL),
(7, NULL, NULL),
(8, NULL, NULL),
(9, NULL, NULL),
(10, NULL, NULL),
(11, NULL, NULL),
(12, NULL, NULL),
(13, NULL, NULL),
(14, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `manager`
--

CREATE TABLE IF NOT EXISTS `manager` (
`id` int(11) NOT NULL,
  `storehouse_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `model`
--

CREATE TABLE IF NOT EXISTS `model` (
`id` int(11) NOT NULL,
  `brand_id` int(11) DEFAULT NULL,
  `modelName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `modelAlertValue` int(11) NOT NULL,
  `adminAdd` int(11) NOT NULL,
  `dateAdd` datetime NOT NULL,
  `userUpdate` int(11) DEFAULT NULL,
  `dateUpdate` datetime DEFAULT NULL,
  `isActive` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `model`
--

INSERT INTO `model` (`id`, `brand_id`, `modelName`, `modelAlertValue`, `adminAdd`, `dateAdd`, `userUpdate`, `dateUpdate`, `isActive`) VALUES
(1, 1, 'Mustang Shelby', 5, 1, '2018-01-11 00:55:13', NULL, NULL, 1),
(2, 2, 'Espace', 5, 1, '2018-01-11 00:55:29', NULL, NULL, 1),
(3, 3, 'Yaris', 5, 1, '2018-01-11 00:55:45', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Structure de la table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
`id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `model_id` int(11) NOT NULL,
  `storehouse_id` int(11) NOT NULL,
  `ordersQuantity` int(11) NOT NULL,
  `ordersDetails` longtext COLLATE utf8_unicode_ci NOT NULL,
  `isReceived` tinyint(1) NOT NULL,
  `adminAdd` int(11) NOT NULL,
  `dateAdd` datetime NOT NULL,
  `userUpdate` int(11) DEFAULT NULL,
  `dateUpdate` datetime DEFAULT NULL,
  `isActive` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `orders`
--

INSERT INTO `orders` (`id`, `supplier_id`, `category_id`, `model_id`, `storehouse_id`, `ordersQuantity`, `ordersDetails`, `isReceived`, `adminAdd`, `dateAdd`, `userUpdate`, `dateUpdate`, `isActive`) VALUES
(1, 1, 1, 1, 1, 3, 'Commande de 3 Shelby pour l''entrepot de Ste-Gene', 1, 1, '2018-01-11 01:01:15', NULL, NULL, 1),
(2, 1, 1, 1, 3, 5, 'Commande de 5 Shelby pour l''entrepôt de Toulouse', 1, 1, '2018-01-11 01:01:51', NULL, NULL, 1),
(3, 1, 2, 3, 1, 5, 'Commande 5 Yaris entrepôt de Sainte-Gene', 1, 1, '2018-01-11 01:03:43', NULL, NULL, 1),
(4, 1, 2, 3, 1, 4, '4 Yaris pour Toulouse', 1, 1, '2018-01-11 01:04:36', NULL, NULL, 1),
(5, 1, 2, 3, 3, 5, 'Rectification commande yaris pour Toulouse', 1, 1, '2018-01-11 01:05:52', NULL, NULL, 1),
(6, 1, 3, 2, 1, 10, 'Commande de 10 Espace pour Sainte-Gene', 1, 1, '2018-01-11 01:06:36', NULL, NULL, 1),
(7, 1, 3, 2, 3, 10, 'Commande 10 Espace pour Tlse', 1, 1, '2018-01-11 01:07:10', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Structure de la table `sale`
--

CREATE TABLE IF NOT EXISTS `sale` (
`id` int(11) NOT NULL,
  `car_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `adminAdd` int(11) NOT NULL,
  `dateAdd` datetime NOT NULL,
  `userUpdate` int(11) DEFAULT NULL,
  `dateUpdate` datetime DEFAULT NULL,
  `isActive` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `sale`
--

INSERT INTO `sale` (`id`, `car_id`, `customer_id`, `adminAdd`, `dateAdd`, `userUpdate`, `dateUpdate`, `isActive`) VALUES
(1, 5, 1, 1, '2018-01-11 01:21:36', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Structure de la table `seller`
--

CREATE TABLE IF NOT EXISTS `seller` (
`id` int(11) NOT NULL,
  `storehouse_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `sellerNbSales` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
`id` int(11) NOT NULL,
  `settingsName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `settingsTitle` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `settingsValue` int(11) NOT NULL,
  `adminAdd` int(11) NOT NULL,
  `dateAdd` datetime NOT NULL,
  `userUpdate` int(11) DEFAULT NULL,
  `dateUpdate` datetime DEFAULT NULL,
  `isActive` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `stock`
--

CREATE TABLE IF NOT EXISTS `stock` (
`id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `model_id` int(11) NOT NULL,
  `storehouse_id` int(11) NOT NULL,
  `stockQuantity` int(11) NOT NULL,
  `adminAdd` int(11) NOT NULL,
  `dateAdd` datetime NOT NULL,
  `userUpdate` int(11) DEFAULT NULL,
  `dateUpdate` datetime DEFAULT NULL,
  `isActive` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `stock`
--

INSERT INTO `stock` (`id`, `category_id`, `model_id`, `storehouse_id`, `stockQuantity`, `adminAdd`, `dateAdd`, `userUpdate`, `dateUpdate`, `isActive`) VALUES
(1, 1, 1, 3, 4, 1, '2018-01-11 01:02:27', NULL, NULL, 1),
(2, 1, 1, 1, 3, 1, '2018-01-11 01:02:44', NULL, NULL, 1),
(3, 2, 3, 1, 9, 1, '2018-01-11 01:04:51', 1, '2018-01-11 01:05:05', 1),
(4, 2, 3, 3, 5, 1, '2018-01-11 01:05:57', NULL, NULL, 1),
(5, 3, 2, 1, 10, 1, '2018-01-11 01:06:38', NULL, NULL, 1),
(6, 3, 2, 3, 10, 1, '2018-01-11 01:07:12', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Structure de la table `storehouse`
--

CREATE TABLE IF NOT EXISTS `storehouse` (
`id` int(11) NOT NULL,
  `address_id` int(11) NOT NULL,
  `manager_id` int(11) DEFAULT NULL,
  `storehouseName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `adminAdd` int(11) NOT NULL,
  `dateAdd` datetime NOT NULL,
  `userUpdate` int(11) DEFAULT NULL,
  `dateUpdate` datetime DEFAULT NULL,
  `isActive` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `storehouse`
--

INSERT INTO `storehouse` (`id`, `address_id`, `manager_id`, `storehouseName`, `adminAdd`, `dateAdd`, `userUpdate`, `dateUpdate`, `isActive`) VALUES
(1, 3, NULL, 'Sainte-Gene Entrepot', 1, '2018-01-11 00:58:10', NULL, NULL, 1),
(3, 5, NULL, 'Tlse', 1, '2018-01-11 01:00:06', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Structure de la table `supplier`
--

CREATE TABLE IF NOT EXISTS `supplier` (
`id` int(11) NOT NULL,
  `address_id` int(11) DEFAULT NULL,
  `supplierName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `adminAdd` int(11) NOT NULL,
  `dateAdd` datetime NOT NULL,
  `userUpdate` int(11) DEFAULT NULL,
  `dateUpdate` datetime DEFAULT NULL,
  `isActive` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `supplier`
--

INSERT INTO `supplier` (`id`, `address_id`, `supplierName`, `adminAdd`, `dateAdd`, `userUpdate`, `dateUpdate`, `isActive`) VALUES
(1, 2, 'AutoMaster', 1, '2018-01-11 00:57:13', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
`id` int(11) NOT NULL,
  `image_id` int(11) DEFAULT NULL,
  `address_id` int(11) DEFAULT NULL,
  `username` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `username_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `email_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `confirmation_token` varchar(180) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `usrName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `userLastname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `userBday` date NOT NULL,
  `userNum` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `adminAdd` int(11) NOT NULL,
  `dateAdd` datetime NOT NULL,
  `userUpdate` int(11) DEFAULT NULL,
  `dateUpdate` datetime DEFAULT NULL,
  `isActive` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id`, `image_id`, `address_id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `confirmation_token`, `password_requested_at`, `roles`, `usrName`, `userLastname`, `userBday`, `userNum`, `adminAdd`, `dateAdd`, `userUpdate`, `dateUpdate`, `isActive`) VALUES
(1, 1, 1, 'A2lam', 'a2lam', 'hadjimohamedallam@gmail.com', 'hadjimohamedallam@gmail.com', 1, 'uOTrDN.9ld92f/IdallaMYhQy36vS.zLOvwq3MTJYyg', '2motM9xll3Vnre3SuXFa/D2VnHlk8zdZMTvU6sqpaFYc7cJny4Drd7k6hHvSbI3qJ93Q8A1wbtNG5EE8pyGyZg==', '2018-01-10 15:45:37', NULL, NULL, 'a:1:{i:0;s:10:"ROLE_ADMIN";}', 'HADJI', 'Mohamed Allam', '2012-01-20', '669181106', 1, '2017-12-22 17:06:11', NULL, NULL, 1);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `address`
--
ALTER TABLE `address`
 ADD PRIMARY KEY (`id`);

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `UNIQ_880E0D76A76ED395` (`user_id`);

--
-- Index pour la table `bonus`
--
ALTER TABLE `bonus`
 ADD PRIMARY KEY (`id`), ADD KEY `IDX_9F987F7A8DE820D9` (`seller_id`), ADD KEY `IDX_9F987F7A38248176` (`currency_id`);

--
-- Index pour la table `brand`
--
ALTER TABLE `brand`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `UNIQ_1C52F958D631DDB3` (`brandName`);

--
-- Index pour la table `car`
--
ALTER TABLE `car`
 ADD PRIMARY KEY (`id`), ADD KEY `IDX_773DE69D12469DE2` (`category_id`), ADD KEY `IDX_773DE69D7975B7E7` (`model_id`), ADD KEY `IDX_773DE69D3DA5256D` (`image_id`), ADD KEY `IDX_773DE69D38248176` (`currency_id`), ADD KEY `IDX_773DE69D6F7858F` (`storehouse_id`), ADD KEY `IDX_773DE69D9395C3F3` (`customer_id`);

--
-- Index pour la table `category`
--
ALTER TABLE `category`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `UNIQ_64C19C196B86598` (`categoryName`);

--
-- Index pour la table `currency`
--
ALTER TABLE `currency`
 ADD PRIMARY KEY (`id`);

--
-- Index pour la table `customer`
--
ALTER TABLE `customer`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `UNIQ_81398E09F5B7AF75` (`address_id`);

--
-- Index pour la table `image`
--
ALTER TABLE `image`
 ADD PRIMARY KEY (`id`);

--
-- Index pour la table `manager`
--
ALTER TABLE `manager`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `UNIQ_FA2425B96F7858F` (`storehouse_id`), ADD UNIQUE KEY `UNIQ_FA2425B9A76ED395` (`user_id`);

--
-- Index pour la table `model`
--
ALTER TABLE `model`
 ADD PRIMARY KEY (`id`), ADD KEY `IDX_D79572D944F5D008` (`brand_id`);

--
-- Index pour la table `orders`
--
ALTER TABLE `orders`
 ADD PRIMARY KEY (`id`), ADD KEY `IDX_E52FFDEE2ADD6D8C` (`supplier_id`), ADD KEY `IDX_E52FFDEE12469DE2` (`category_id`), ADD KEY `IDX_E52FFDEE7975B7E7` (`model_id`), ADD KEY `IDX_E52FFDEE6F7858F` (`storehouse_id`);

--
-- Index pour la table `sale`
--
ALTER TABLE `sale`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `UNIQ_E54BC005C3C6F69F` (`car_id`), ADD KEY `IDX_E54BC0059395C3F3` (`customer_id`);

--
-- Index pour la table `seller`
--
ALTER TABLE `seller`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `UNIQ_FB1AD3FCA76ED395` (`user_id`), ADD KEY `IDX_FB1AD3FC6F7858F` (`storehouse_id`);

--
-- Index pour la table `settings`
--
ALTER TABLE `settings`
 ADD PRIMARY KEY (`id`);

--
-- Index pour la table `stock`
--
ALTER TABLE `stock`
 ADD PRIMARY KEY (`id`), ADD KEY `IDX_4B36566012469DE2` (`category_id`), ADD KEY `IDX_4B3656607975B7E7` (`model_id`), ADD KEY `IDX_4B3656606F7858F` (`storehouse_id`);

--
-- Index pour la table `storehouse`
--
ALTER TABLE `storehouse`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `UNIQ_D849E748A5AFC965` (`storehouseName`), ADD UNIQUE KEY `UNIQ_D849E748F5B7AF75` (`address_id`), ADD UNIQUE KEY `UNIQ_D849E748783E3463` (`manager_id`);

--
-- Index pour la table `supplier`
--
ALTER TABLE `supplier`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `UNIQ_9B2A6C7EF5B7AF75` (`address_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `UNIQ_8D93D64992FC23A8` (`username_canonical`), ADD UNIQUE KEY `UNIQ_8D93D649A0D96FBF` (`email_canonical`), ADD UNIQUE KEY `UNIQ_8D93D649C05FB297` (`confirmation_token`), ADD UNIQUE KEY `UNIQ_8D93D6493DA5256D` (`image_id`), ADD UNIQUE KEY `UNIQ_8D93D649F5B7AF75` (`address_id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `address`
--
ALTER TABLE `address`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `bonus`
--
ALTER TABLE `bonus`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `brand`
--
ALTER TABLE `brand`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `car`
--
ALTER TABLE `car`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT pour la table `category`
--
ALTER TABLE `category`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `currency`
--
ALTER TABLE `currency`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `customer`
--
ALTER TABLE `customer`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `image`
--
ALTER TABLE `image`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT pour la table `manager`
--
ALTER TABLE `manager`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `model`
--
ALTER TABLE `model`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `orders`
--
ALTER TABLE `orders`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT pour la table `sale`
--
ALTER TABLE `sale`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `seller`
--
ALTER TABLE `seller`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `settings`
--
ALTER TABLE `settings`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `stock`
--
ALTER TABLE `stock`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `storehouse`
--
ALTER TABLE `storehouse`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `supplier`
--
ALTER TABLE `supplier`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `admin`
--
ALTER TABLE `admin`
ADD CONSTRAINT `FK_880E0D76A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `bonus`
--
ALTER TABLE `bonus`
ADD CONSTRAINT `FK_9F987F7A38248176` FOREIGN KEY (`currency_id`) REFERENCES `currency` (`id`),
ADD CONSTRAINT `FK_9F987F7A8DE820D9` FOREIGN KEY (`seller_id`) REFERENCES `seller` (`id`);

--
-- Contraintes pour la table `car`
--
ALTER TABLE `car`
ADD CONSTRAINT `FK_773DE69D12469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`),
ADD CONSTRAINT `FK_773DE69D38248176` FOREIGN KEY (`currency_id`) REFERENCES `currency` (`id`),
ADD CONSTRAINT `FK_773DE69D3DA5256D` FOREIGN KEY (`image_id`) REFERENCES `image` (`id`),
ADD CONSTRAINT `FK_773DE69D6F7858F` FOREIGN KEY (`storehouse_id`) REFERENCES `storehouse` (`id`),
ADD CONSTRAINT `FK_773DE69D7975B7E7` FOREIGN KEY (`model_id`) REFERENCES `model` (`id`),
ADD CONSTRAINT `FK_773DE69D9395C3F3` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`);

--
-- Contraintes pour la table `customer`
--
ALTER TABLE `customer`
ADD CONSTRAINT `FK_81398E09F5B7AF75` FOREIGN KEY (`address_id`) REFERENCES `address` (`id`);

--
-- Contraintes pour la table `manager`
--
ALTER TABLE `manager`
ADD CONSTRAINT `FK_FA2425B96F7858F` FOREIGN KEY (`storehouse_id`) REFERENCES `storehouse` (`id`),
ADD CONSTRAINT `FK_FA2425B9A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `model`
--
ALTER TABLE `model`
ADD CONSTRAINT `FK_D79572D944F5D008` FOREIGN KEY (`brand_id`) REFERENCES `brand` (`id`);

--
-- Contraintes pour la table `orders`
--
ALTER TABLE `orders`
ADD CONSTRAINT `FK_E52FFDEE12469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`),
ADD CONSTRAINT `FK_E52FFDEE2ADD6D8C` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`id`),
ADD CONSTRAINT `FK_E52FFDEE6F7858F` FOREIGN KEY (`storehouse_id`) REFERENCES `storehouse` (`id`),
ADD CONSTRAINT `FK_E52FFDEE7975B7E7` FOREIGN KEY (`model_id`) REFERENCES `model` (`id`);

--
-- Contraintes pour la table `sale`
--
ALTER TABLE `sale`
ADD CONSTRAINT `FK_E54BC0059395C3F3` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`),
ADD CONSTRAINT `FK_E54BC005C3C6F69F` FOREIGN KEY (`car_id`) REFERENCES `car` (`id`);

--
-- Contraintes pour la table `seller`
--
ALTER TABLE `seller`
ADD CONSTRAINT `FK_FB1AD3FC6F7858F` FOREIGN KEY (`storehouse_id`) REFERENCES `storehouse` (`id`),
ADD CONSTRAINT `FK_FB1AD3FCA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `stock`
--
ALTER TABLE `stock`
ADD CONSTRAINT `FK_4B36566012469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`),
ADD CONSTRAINT `FK_4B3656606F7858F` FOREIGN KEY (`storehouse_id`) REFERENCES `storehouse` (`id`),
ADD CONSTRAINT `FK_4B3656607975B7E7` FOREIGN KEY (`model_id`) REFERENCES `model` (`id`);

--
-- Contraintes pour la table `storehouse`
--
ALTER TABLE `storehouse`
ADD CONSTRAINT `FK_D849E748783E3463` FOREIGN KEY (`manager_id`) REFERENCES `manager` (`id`),
ADD CONSTRAINT `FK_D849E748F5B7AF75` FOREIGN KEY (`address_id`) REFERENCES `address` (`id`);

--
-- Contraintes pour la table `supplier`
--
ALTER TABLE `supplier`
ADD CONSTRAINT `FK_9B2A6C7EF5B7AF75` FOREIGN KEY (`address_id`) REFERENCES `address` (`id`);

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
ADD CONSTRAINT `FK_8D93D6493DA5256D` FOREIGN KEY (`image_id`) REFERENCES `image` (`id`),
ADD CONSTRAINT `FK_8D93D649F5B7AF75` FOREIGN KEY (`address_id`) REFERENCES `address` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
