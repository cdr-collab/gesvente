-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 23, 2025 at 06:01 PM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel_auth`
--

-- --------------------------------------------------------

--
-- Table structure for table `achats`
--

DROP TABLE IF EXISTS `achats`;
CREATE TABLE IF NOT EXISTS `achats` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `produit_id` bigint(20) UNSIGNED NOT NULL,
  `fournisseur_id` bigint(20) UNSIGNED NOT NULL,
  `quantite_achat` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `achats_produit_id_foreign` (`produit_id`),
  KEY `achats_fournisseur_id_foreign` (`fournisseur_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `achats`
--

INSERT INTO `achats` (`id`, `produit_id`, `fournisseur_id`, `quantite_achat`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 200, '2025-09-27 21:06:40', '2025-09-27 21:06:40'),
(2, 4, 1, 50, '2025-09-27 21:07:50', '2025-09-27 21:07:50'),
(3, 18, 2, 120, '2025-09-27 21:08:31', '2025-09-27 21:08:31'),
(4, 2, 3, 140, '2025-09-27 21:09:10', '2025-09-27 21:09:10'),
(6, 22, 6, 170, '2025-09-27 21:11:49', '2025-09-27 21:11:49');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nom_categorie` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categories_nom_categorie_unique` (`nom_categorie`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `nom_categorie`, `description`, `created_at`, `updated_at`) VALUES
(4, 'Boulangerie', 'Pain, Croissant, Brioche', '2025-09-26 08:09:55', '2025-09-26 08:09:55'),
(5, 'Viande et Poisson', 'Poulet, Steak, Filet', '2025-09-26 08:10:54', '2025-09-26 08:10:54'),
(6, 'Produits laitiers', 'Lait, Fromage, Yaourt', '2025-09-26 08:11:50', '2025-09-26 08:11:50'),
(7, 'Fruits et Légumes', 'Pommes, Bananes, Tomates ...', '2025-09-26 08:12:42', '2025-09-26 08:12:59'),
(8, 'Epicerie', 'Riz, Pates, Huiles, Sucre ...', '2025-09-26 08:14:05', '2025-09-26 08:14:05'),
(9, 'Snacks et Boissons', 'Chocolat, Chips, Bouteille d\'eau, Coca-Cola ...', '2025-09-26 08:15:59', '2025-09-26 08:15:59'),
(10, 'Produits d\'entretiens et Hygiéne', 'Liquide vaisselle, Savon, Dentifrice ...', '2025-09-26 08:16:55', '2025-09-26 09:05:07');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

DROP TABLE IF EXISTS `clients`;
CREATE TABLE IF NOT EXISTS `clients` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nom_client` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `clients_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `nom_client`, `adresse`, `telephone`, `email`, `created_at`, `updated_at`) VALUES
(1, 'GERVAIS DUBOIS', '10 Rue de Seine, 75001 Paris', '+33 1 42 85 79 23', 'gervaisdubois@yahoo.fr', '2025-09-26 09:37:39', '2025-09-26 10:18:31'),
(2, 'Marc Henry Maxim', '25 Avenue Victor Hugo, 69006 Lyon', '+33 1 56 74 32 98', 'maxim228@gmail.com', '2025-09-26 09:39:33', '2025-09-26 09:39:33'),
(3, 'SAMUEL HERBERT THOMAS', '7 Boulevard Saint-Michel, 75005 Paris', '+33 2 35 67 12 45', 'samuelthomas@gmail.com', '2025-09-26 09:41:04', '2025-09-26 09:41:04'),
(4, 'LILIANE HENRIETTE', '18 Rue Nationale, 59800 Lille', '+33 2 99 85 74 36', 'lilianehenriette@gmail.com', '2025-09-26 09:50:25', '2025-09-26 09:50:25'),
(5, 'JEAN PHILIPPE ANTOINE', '42 Rue des Carmes, 31000 Toulouse', '+33 3 20 58 96 41', 'jpantoine@yahoo', '2025-09-26 10:11:38', '2025-09-26 10:11:38'),
(6, 'XAVIER JULIEN', '56 Avenue Montaigne, 75008 Paris', '+33 3 88 52 47 19', 'xavierjulien@yahoo.fr', '2025-09-26 10:14:01', '2025-09-26 10:14:01'),
(7, 'BERNADETTE SIMONNE', '14 Rue des Fleurs, 06000 Nice', '+33 4 72 15 89 67', 'bernadettesimmonne@gmail.com', '2025-09-26 10:15:49', '2025-09-26 10:15:49'),
(8, 'DENISE SOPHIE', '82 Boulevard de Stras, 76000 Rouen', '+33 4 91 26 35 80', 'denisesophie@gmail.com', '2025-09-26 10:17:46', '2025-09-26 10:19:00'),
(9, 'JEAN MARC HONORE', '120 Rue de Metz, 57000 Metz', '+33 5 56 84 23 71', 'jmhonore@yahoo.fr', '2025-09-26 10:24:41', '2025-09-26 10:24:41'),
(10, 'JUDITH SEVERINE', '33 Rue de la Liberté, 21000 Dijon', '+33 5 62 41 58 92', 'severinejudith@gmail.com', '2025-09-26 10:30:06', '2025-09-26 10:30:06');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fournisseurs`
--

DROP TABLE IF EXISTS `fournisseurs`;
CREATE TABLE IF NOT EXISTS `fournisseurs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nom_fournisseur` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fournisseurs`
--

INSERT INTO `fournisseurs` (`id`, `nom_fournisseur`, `adresse`, `telephone`, `email`, `created_at`, `updated_at`) VALUES
(1, 'Chicken One', '63 Rue Pasteur, 80000 Amiens', '+33 1 60 72 49 85', 'chick@gmail.com', '2025-09-27 20:37:01', '2025-09-27 20:37:01'),
(2, 'ChocoGood', '27 Rue Saint-Pierre, 14000 Caen', '+33 9 55 22 14 78', 'chocogood@chocogood.com', '2025-09-27 20:40:49', '2025-09-27 20:40:49'),
(3, 'Boulagerie Rotative', '19 Avenue de la Gare, 87000 Limoges', '+33 9 87 65 43 21', 'rotative@yahoo.com', '2025-09-27 20:43:42', '2025-09-27 20:43:42'),
(4, 'BonFruit', '44 Rue des Capucins, 13100 Aix-en-Provence', '+33 9 70 12 34 56', 'bonfruit@fruitstropicaux.com', '2025-09-27 20:48:10', '2025-09-27 20:48:10'),
(6, 'MEYLI', '8 Rue de la Barre, 69002 Lyon', '+33 7 94 12 35 64', 'meyli@gmail.com', '2025-09-27 20:54:23', '2025-09-27 20:54:23'),
(7, 'Coca-Cola', '12 Rue du Faubourg Antoine, 75012 Paris', '+33 7 82 56 47 30', 'cola@mycoca.com', '2025-09-27 21:00:06', '2025-09-27 21:00:06');

-- --------------------------------------------------------

--
-- Table structure for table `fournisseur_produit`
--

DROP TABLE IF EXISTS `fournisseur_produit`;
CREATE TABLE IF NOT EXISTS `fournisseur_produit` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `fournisseur_id` bigint(20) UNSIGNED NOT NULL,
  `produit_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fournisseur_produit_fournisseur_id_foreign` (`fournisseur_id`),
  KEY `fournisseur_produit_produit_id_foreign` (`produit_id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fournisseur_produit`
--

INSERT INTO `fournisseur_produit` (`id`, `fournisseur_id`, `produit_id`, `created_at`, `updated_at`) VALUES
(1, 1, 4, NULL, NULL),
(2, 2, 18, NULL, NULL),
(3, 3, 1, NULL, NULL),
(4, 3, 2, NULL, NULL),
(5, 4, 10, NULL, NULL),
(6, 4, 11, NULL, NULL),
(7, 2, 19, NULL, NULL),
(9, 6, 23, NULL, NULL),
(10, 6, 24, NULL, NULL),
(11, 6, 25, NULL, NULL),
(12, 7, 20, NULL, NULL),
(13, 7, 21, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2025_09_19_110400_create_categories_table', 1),
(6, '2025_09_19_135243_produits_table', 1),
(7, '2025_09_19_150514_create_fournisseurs_table', 1),
(8, '2025_09_19_151547_fournisseur_produit_table', 1),
(9, '2025_09_22_084904_create_clients_table', 1),
(10, '2025_09_22_124814_create_ventes_table', 1),
(11, '2025_09_22_214457_create_achats_table', 1),
(12, '2025_09_27_123649_vente_produit_table', 2),
(13, '2025_09_27_124600_ventes_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `produits`
--

DROP TABLE IF EXISTS `produits`;
CREATE TABLE IF NOT EXISTS `produits` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nom_produit` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prix_unitaire` decimal(12,2) NOT NULL,
  `quantite_stock` int(11) DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `categorie_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `produits_categorie_id_foreign` (`categorie_id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `produits`
--

INSERT INTO `produits` (`id`, `nom_produit`, `prix_unitaire`, `quantite_stock`, `description`, `categorie_id`, `created_at`, `updated_at`) VALUES
(1, 'Pain baguette', '1.50', 378, 'Pain chaud et nourissant', 4, '2025-09-26 08:20:09', '2025-10-23 16:48:51'),
(2, 'Croissant', '1.20', 417, 'Appetissant', 4, '2025-09-26 08:21:24', '2025-10-01 12:01:19'),
(3, 'Brioche', '3.00', 112, 'Meilleur Qualité', 4, '2025-09-26 08:22:18', '2025-09-28 14:48:12'),
(4, 'Poulet entier (1,2 kg)', '8.00', 112, 'De chez chiken choice', 5, '2025-09-26 08:24:49', '2025-10-01 11:59:34'),
(5, 'Steak haché (500 g)', '6.00', 119, 'De chez Xavier', 5, '2025-09-26 08:27:16', '2025-09-28 14:50:16'),
(6, 'Filet de saumon (200 g)', '7.00', 207, 'De chez Mathilde', 5, '2025-09-26 08:28:41', '2025-10-01 11:59:34'),
(7, 'Lait (1 L)', '1.20', 170, 'De chez Cowmilk', 6, '2025-09-26 08:31:21', '2025-10-01 12:01:19'),
(8, 'Fromage (emmental 250 g)', '3.00', 129, 'De chez Emmental', 6, '2025-09-26 08:33:09', '2025-09-30 08:29:47'),
(9, 'Yaourts (pack de 4)', '2.20', 210, 'Tami Yaourt de Qualité', 6, '2025-09-26 08:35:07', '2025-09-29 20:32:19'),
(10, 'Pommes (1 kg)', '2.50', 173, 'Du Jardin Fruits Tropicaux', 7, '2025-09-26 08:37:29', '2025-10-01 12:01:58'),
(11, 'Bananes (1 kg)', '2.40', 152, 'Energetics Fruits', 7, '2025-09-26 08:39:14', '2025-10-23 16:48:51'),
(12, 'Tomates (1 kg)', '3.50', 186, 'Tomato Légumes pour Tous', 7, '2025-09-26 08:41:48', '2025-10-01 11:59:34'),
(13, 'Pommes de terre (1 kg)', '2.00', 210, 'Pommes délice', 7, '2025-09-26 08:46:36', '2025-10-23 16:48:51'),
(14, 'Riz (1 kg)', '2.50', 496, 'Riz mémé cassé', 8, '2025-09-26 08:49:38', '2025-09-30 11:50:26'),
(15, 'Pates (500 g)', '1.20', 687, 'Pate Italia', 8, '2025-09-26 08:50:56', '2025-10-01 11:59:34'),
(16, 'Huile de tournesol (1 L)', '2.50', 299, 'Bonne huile de qualité', 8, '2025-09-26 08:52:39', '2025-09-28 14:49:00'),
(17, 'Sucre (1 kg)', '1.60', 217, 'Sucre Tatie de qualité', 8, '2025-09-26 08:54:11', '2025-09-30 11:55:27'),
(18, 'Chocolat tablette (100 g)', '2.50', 658, 'Bon chocolat nutritif', 9, '2025-09-26 08:56:53', '2025-09-30 11:55:27'),
(19, 'Chips (200 g)', '2.00', 597, 'Chips delice de qualité', 9, '2025-09-26 08:58:52', '2025-09-27 12:22:43'),
(20, 'Bouteille d\'eau (1,5 L)', '0.60', 990, 'Eau minérale potable', 9, '2025-09-26 09:00:37', '2025-10-01 12:00:28'),
(21, 'Coca-Cola (1,5 L)', '2.00', 698, 'Coca-cola boisson energetique', 9, '2025-09-26 09:02:25', '2025-10-01 12:00:28'),
(22, 'Lessive (3 L)', '11.00', 460, 'Produits indispensable pour la lessive', 10, '2025-09-26 09:06:41', '2025-09-27 21:11:49'),
(23, 'Liquide vaisselle (500 ml)', '2.30', 419, 'Meilleur produit de vaisselle', 10, '2025-09-26 09:08:08', '2025-09-27 13:57:19'),
(24, 'Savon (pack de 4)', '3.00', 498, 'Savon pour la douche', 10, '2025-09-26 09:09:41', '2025-09-27 13:57:19'),
(25, 'Dentifrice (75 ml)', '3.50', 179, 'Avoir des dents toujours propre', 10, '2025-09-26 09:11:48', '2025-09-28 14:45:43');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('administrateur','vendeur') COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@example.com', NULL, '$2y$10$rktD5zelwxNAEJSyuDo/1usBMNifPtrVSK5MXWgSymCIFjXSo0RlO', 'administrateur', NULL, '2025-09-25 16:14:35', '2025-09-25 16:14:35'),
(2, 'Alex', 'alex@gmail.com', NULL, '$2y$10$85qFfpg1MR9tAxrEpcWFYubIRZvNdjfHEhTEdINyYJ/zyGvXSgonS', 'vendeur', NULL, '2025-09-25 16:18:07', '2025-09-25 16:18:07');

-- --------------------------------------------------------

--
-- Table structure for table `ventes`
--

DROP TABLE IF EXISTS `ventes`;
CREATE TABLE IF NOT EXISTS `ventes` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `montant_total` decimal(12,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ventes_client_id_foreign` (`client_id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ventes`
--

INSERT INTO `ventes` (`id`, `client_id`, `montant_total`, `created_at`, `updated_at`) VALUES
(4, 7, '11.80', '2025-09-27 13:54:40', '2025-09-27 13:54:40'),
(2, 6, '11.00', '2025-09-27 12:22:43', '2025-09-27 12:22:43'),
(3, 8, '7.70', '2025-09-27 12:34:32', '2025-09-27 13:35:39'),
(5, 5, '13.10', '2025-09-27 13:57:19', '2025-09-27 13:57:19'),
(6, 10, '18.40', '2025-09-27 14:01:26', '2025-09-27 14:27:05'),
(8, 7, '23.50', '2025-09-27 15:51:43', '2025-09-27 15:51:43'),
(9, 2, '8.40', '2025-09-28 14:43:13', '2025-09-28 14:43:13'),
(10, 4, '8.20', '2025-09-28 14:44:39', '2025-09-28 14:44:39'),
(11, 9, '14.10', '2025-09-28 14:45:43', '2025-09-28 14:45:43'),
(12, 6, '22.80', '2025-09-28 14:46:35', '2025-09-28 14:46:35'),
(13, 7, '24.00', '2025-09-28 14:48:12', '2025-09-28 14:48:12'),
(14, 10, '26.50', '2025-09-28 14:49:00', '2025-09-28 14:49:00'),
(15, 3, '9.60', '2025-09-28 14:50:16', '2025-09-28 14:50:16'),
(16, 5, '31.70', '2025-09-28 14:51:11', '2025-09-28 14:51:11'),
(17, 3, '9.90', '2025-09-29 20:32:19', '2025-09-29 20:32:19'),
(18, 4, '19.90', '2025-09-30 08:28:55', '2025-09-30 08:29:47'),
(19, 7, '34.20', '2025-09-30 11:49:25', '2025-09-30 11:50:26'),
(20, 8, '20.60', '2025-09-30 11:54:44', '2025-09-30 11:55:27'),
(21, 2, '32.60', '2025-10-01 11:59:34', '2025-10-01 11:59:34'),
(22, 1, '5.80', '2025-10-01 12:00:28', '2025-10-01 12:00:28'),
(23, 9, '15.60', '2025-10-01 12:01:19', '2025-10-01 12:01:19'),
(24, 4, '26.90', '2025-10-01 12:01:58', '2025-10-01 12:01:58'),
(25, 1, '7.80', '2025-10-23 16:48:19', '2025-10-23 16:48:51');

-- --------------------------------------------------------

--
-- Table structure for table `vente_produit`
--

DROP TABLE IF EXISTS `vente_produit`;
CREATE TABLE IF NOT EXISTS `vente_produit` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `vente_id` bigint(20) UNSIGNED NOT NULL,
  `produit_id` bigint(20) UNSIGNED NOT NULL,
  `quantite` int(10) UNSIGNED NOT NULL,
  `prix_unitaire` decimal(12,2) NOT NULL,
  `sous_total` decimal(12,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `vente_produit_vente_id_foreign` (`vente_id`),
  KEY `vente_produit_produit_id_foreign` (`produit_id`)
) ENGINE=MyISAM AUTO_INCREMENT=100 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vente_produit`
--

INSERT INTO `vente_produit` (`id`, `vente_id`, `produit_id`, `quantite`, `prix_unitaire`, `sous_total`, `created_at`, `updated_at`) VALUES
(17, 1, 14, 2, '2.50', '5.00', '2025-09-27 13:23:33', '2025-09-27 13:23:33'),
(16, 1, 12, 2, '3.50', '7.00', '2025-09-27 13:23:33', '2025-09-27 13:23:33'),
(15, 1, 1, 1, '1.50', '1.50', '2025-09-27 13:23:33', '2025-09-27 13:23:33'),
(4, 2, 14, 2, '2.50', '5.00', '2025-09-27 12:22:43', '2025-09-27 12:22:43'),
(5, 2, 19, 3, '2.00', '6.00', '2025-09-27 12:22:43', '2025-09-27 12:22:43'),
(21, 3, 18, 2, '2.50', '5.00', '2025-09-27 13:35:39', '2025-09-27 13:35:39'),
(20, 3, 1, 1, '1.50', '1.50', '2025-09-27 13:35:39', '2025-09-27 13:35:39'),
(19, 3, 7, 1, '1.20', '1.20', '2025-09-27 13:35:39', '2025-09-27 13:35:39'),
(18, 1, 17, 1, '1.60', '1.60', '2025-09-27 13:23:33', '2025-09-27 13:23:33'),
(22, 4, 9, 4, '2.20', '8.80', '2025-09-27 13:54:40', '2025-09-27 13:54:40'),
(23, 4, 1, 2, '1.50', '3.00', '2025-09-27 13:54:40', '2025-09-27 13:54:40'),
(24, 5, 23, 1, '2.30', '2.30', '2025-09-27 13:57:19', '2025-09-27 13:57:19'),
(25, 5, 24, 2, '3.00', '6.00', '2025-09-27 13:57:19', '2025-09-27 13:57:19'),
(26, 5, 2, 4, '1.20', '4.80', '2025-09-27 13:57:19', '2025-09-27 13:57:19'),
(37, 7, 11, 1, '2.40', '2.40', '2025-09-27 15:10:14', '2025-09-27 15:10:14'),
(36, 6, 18, 4, '2.50', '10.00', '2025-09-27 14:27:05', '2025-09-27 14:27:05'),
(35, 6, 2, 6, '1.20', '7.20', '2025-09-27 14:27:05', '2025-09-27 14:27:05'),
(34, 6, 7, 1, '1.20', '1.20', '2025-09-27 14:27:05', '2025-09-27 14:27:05'),
(38, 8, 10, 3, '2.50', '7.50', '2025-09-27 15:51:43', '2025-09-27 15:51:43'),
(39, 8, 4, 2, '8.00', '16.00', '2025-09-27 15:51:43', '2025-09-27 15:51:43'),
(40, 9, 11, 2, '2.40', '4.80', '2025-09-28 14:43:13', '2025-09-28 14:43:13'),
(41, 9, 15, 1, '1.20', '1.20', '2025-09-28 14:43:13', '2025-09-28 14:43:13'),
(42, 9, 7, 2, '1.20', '2.40', '2025-09-28 14:43:13', '2025-09-28 14:43:13'),
(43, 10, 1, 4, '1.50', '6.00', '2025-09-28 14:44:39', '2025-09-28 14:44:39'),
(44, 10, 9, 1, '2.20', '2.20', '2025-09-28 14:44:39', '2025-09-28 14:44:39'),
(45, 11, 2, 3, '1.20', '3.60', '2025-09-28 14:45:43', '2025-09-28 14:45:43'),
(46, 11, 25, 1, '3.50', '3.50', '2025-09-28 14:45:43', '2025-09-28 14:45:43'),
(47, 11, 12, 2, '3.50', '7.00', '2025-09-28 14:45:43', '2025-09-28 14:45:43'),
(48, 12, 20, 2, '0.60', '1.20', '2025-09-28 14:46:35', '2025-09-28 14:46:35'),
(49, 12, 9, 3, '2.20', '6.60', '2025-09-28 14:46:35', '2025-09-28 14:46:35'),
(50, 12, 8, 5, '3.00', '15.00', '2025-09-28 14:46:35', '2025-09-28 14:46:35'),
(51, 13, 3, 8, '3.00', '24.00', '2025-09-28 14:48:12', '2025-09-28 14:48:12'),
(52, 14, 4, 3, '8.00', '24.00', '2025-09-28 14:49:00', '2025-09-28 14:49:00'),
(53, 14, 16, 1, '2.50', '2.50', '2025-09-28 14:49:00', '2025-09-28 14:49:00'),
(54, 15, 5, 1, '6.00', '6.00', '2025-09-28 14:50:16', '2025-09-28 14:50:16'),
(55, 15, 15, 3, '1.20', '3.60', '2025-09-28 14:50:16', '2025-09-28 14:50:16'),
(56, 16, 11, 8, '2.40', '19.20', '2025-09-28 14:51:11', '2025-09-28 14:51:11'),
(57, 16, 10, 5, '2.50', '12.50', '2025-09-28 14:51:11', '2025-09-28 14:51:11'),
(58, 17, 9, 2, '2.20', '4.40', '2025-09-29 20:32:19', '2025-09-29 20:32:19'),
(59, 17, 10, 1, '2.50', '2.50', '2025-09-29 20:32:19', '2025-09-29 20:32:19'),
(60, 17, 20, 3, '0.60', '1.80', '2025-09-29 20:32:19', '2025-09-29 20:32:19'),
(61, 17, 7, 1, '1.20', '1.20', '2025-09-29 20:32:19', '2025-09-29 20:32:19'),
(67, 18, 8, 1, '3.00', '3.00', '2025-09-30 08:29:47', '2025-09-30 08:29:47'),
(66, 18, 6, 1, '7.00', '7.00', '2025-09-30 08:29:47', '2025-09-30 08:29:47'),
(65, 18, 10, 3, '2.50', '7.50', '2025-09-30 08:29:47', '2025-09-30 08:29:47'),
(68, 18, 2, 2, '1.20', '2.40', '2025-09-30 08:29:47', '2025-09-30 08:29:47'),
(76, 19, 1, 4, '1.50', '6.00', '2025-09-30 11:50:26', '2025-09-30 11:50:26'),
(75, 19, 15, 6, '1.20', '7.20', '2025-09-30 11:50:26', '2025-09-30 11:50:26'),
(74, 19, 4, 2, '8.00', '16.00', '2025-09-30 11:50:26', '2025-09-30 11:50:26'),
(73, 19, 14, 2, '2.50', '5.00', '2025-09-30 11:50:26', '2025-09-30 11:50:26'),
(82, 20, 17, 2, '1.60', '3.20', '2025-09-30 11:55:27', '2025-09-30 11:55:27'),
(81, 20, 7, 2, '1.20', '2.40', '2025-09-30 11:55:27', '2025-09-30 11:55:27'),
(80, 20, 1, 5, '1.50', '7.50', '2025-09-30 11:55:27', '2025-09-30 11:55:27'),
(83, 20, 18, 3, '2.50', '7.50', '2025-09-30 11:55:27', '2025-09-30 11:55:27'),
(84, 21, 12, 2, '3.50', '7.00', '2025-10-01 11:59:34', '2025-10-01 11:59:34'),
(85, 21, 4, 1, '8.00', '8.00', '2025-10-01 11:59:34', '2025-10-01 11:59:34'),
(86, 21, 15, 3, '1.20', '3.60', '2025-10-01 11:59:34', '2025-10-01 11:59:34'),
(87, 21, 6, 2, '7.00', '14.00', '2025-10-01 11:59:34', '2025-10-01 11:59:34'),
(88, 22, 21, 2, '2.00', '4.00', '2025-10-01 12:00:28', '2025-10-01 12:00:28'),
(89, 22, 20, 3, '0.60', '1.80', '2025-10-01 12:00:28', '2025-10-01 12:00:28'),
(90, 23, 2, 5, '1.20', '6.00', '2025-10-01 12:01:19', '2025-10-01 12:01:19'),
(91, 23, 7, 3, '1.20', '3.60', '2025-10-01 12:01:19', '2025-10-01 12:01:19'),
(92, 23, 1, 4, '1.50', '6.00', '2025-10-01 12:01:19', '2025-10-01 12:01:19'),
(93, 24, 10, 5, '2.50', '12.50', '2025-10-01 12:01:58', '2025-10-01 12:01:58'),
(94, 24, 11, 6, '2.40', '14.40', '2025-10-01 12:01:58', '2025-10-01 12:01:58'),
(99, 25, 1, 2, '1.50', '3.00', '2025-10-23 16:48:51', '2025-10-23 16:48:51'),
(98, 25, 11, 2, '2.40', '4.80', '2025-10-23 16:48:51', '2025-10-23 16:48:51');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
