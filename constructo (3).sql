-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 02 fév. 2026 à 08:04
-- Version du serveur : 9.1.0
-- Version de PHP : 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `constructo`
--

-- --------------------------------------------------------

--
-- Structure de la table `chantiers`
--

DROP TABLE IF EXISTS `chantiers`;
CREATE TABLE IF NOT EXISTS `chantiers` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_debut` date DEFAULT NULL,
  `date_fin` date DEFAULT NULL,
  `responsable_id` bigint UNSIGNED NOT NULL,
  `statut` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tarif` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `chantiers_responsable_id_foreign` (`responsable_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `chantiers`
--

INSERT INTO `chantiers` (`id`, `nom`, `adresse`, `date_debut`, `date_fin`, `responsable_id`, `statut`, `tarif`, `created_at`, `updated_at`) VALUES
(1, 'Maison Dupont', '12 Rue des Tilleuls, 55000 Savonnière Devant Bar', '2023-01-15', '2023-07-30', 2, 'En cours', 25000.00, NULL, '2026-01-21 07:06:37'),
(2, 'Rénovation École', '5 Avenue de la République, 55000 Bar-le-Duc', '2023-03-01', '2023-12-15', 2, 'En cours', 150000.00, NULL, NULL),
(3, 'Extension Mairie', 'Place de la Mairie, 55000 Bar-le-Duc', '2023-05-10', '2024-02-28', 2, 'À venir', 80000.00, NULL, NULL),
(4, 'Garage Martin', '8 Rue des Artisans, 55000 Bar-le-Duc', '2022-11-05', '2023-04-30', 2, 'Terminé', 35000.00, NULL, NULL),
(5, 'Immeuble Leroy', '22 Boulevard de la Gare, 55000 Bar-le-Duc', '2023-06-01', '2024-01-31', 2, 'À venir', 120000.00, NULL, NULL),
(6, 'Maison Dupont', '12 Rue des Tilleuls, 55000 Bar-le-Duc', '2023-01-15', '2023-07-30', 2, 'En cours', NULL, NULL, NULL),
(7, 'Rénovation École', '5 Avenue de la République, 55000 Bar-le-Duc', '2023-03-01', '2023-12-15', 2, 'En cours', NULL, NULL, NULL),
(8, 'Extension Mairie', 'Place de la Mairie, 55000 Bar-le-Duc', '2023-05-10', '2024-02-28', 2, 'À venir', NULL, NULL, NULL),
(10, 'Immeuble Leroy', '22 Boulevard de la Gare, 55000 Bar-le-Duc', '2023-06-01', '2024-01-31', 2, 'À venir', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `equipements`
--

DROP TABLE IF EXISTS `equipements`;
CREATE TABLE IF NOT EXISTS `equipements` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantite` int NOT NULL,
  `date_achat` date DEFAULT NULL,
  `etat` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `localisation` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `equipements`
--

INSERT INTO `equipements` (`id`, `nom`, `quantite`, `date_achat`, `etat`, `localisation`, `created_at`, `updated_at`) VALUES
(1, 'Marteau pneumatique', 5, '2022-01-10', 'Bon état', 'Entrepôt A', NULL, NULL),
(2, 'Niveau laser', 3, '2021-11-05', 'Neuf', 'Entrepôt B', NULL, NULL),
(3, 'Bétonnière', 2, '2020-07-20', 'Usé', 'Chantier Dupont', NULL, NULL),
(4, 'Échafaudage', 1, '2019-05-15', 'Bon état', 'Entrepôt C', NULL, NULL),
(5, 'Perceuse visseuse', 8, '2023-02-28', 'Neuf', 'Entrepôt A', NULL, NULL),
(6, 'Truelle', 12, '2021-09-10', 'Bon état', 'Entrepôt B', NULL, NULL),
(7, 'Scie circulaire', 4, '2022-06-18', 'En maintenance', 'Atelier', NULL, NULL),
(8, 'Génératrice', 2, '2020-03-22', 'Bon état', 'Entrepôt C', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `evenements`
--

DROP TABLE IF EXISTS `evenements`;
CREATE TABLE IF NOT EXISTS `evenements` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `date_debut` datetime NOT NULL,
  `date_fin` datetime DEFAULT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `chantier_id` bigint UNSIGNED DEFAULT NULL,
  `statut` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `evenements_user_id_foreign` (`user_id`),
  KEY `evenements_chantier_id_foreign` (`chantier_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `evenements`
--

INSERT INTO `evenements` (`id`, `titre`, `description`, `date_debut`, `date_fin`, `user_id`, `chantier_id`, `statut`, `created_at`, `updated_at`) VALUES
(1, 'Réunion de chantier - Maison Dupont', 'Réunion pour discuter des progrès et des prochaines étapes.', '2023-06-15 09:00:00', '2023-06-15 11:00:00', 2, 1, 'À venir', NULL, NULL),
(2, 'Livraison matériaux - Rénovation École', 'Livraison des matériaux pour la rénovation.', '2023-06-18 08:00:00', '2023-06-18 10:00:00', 2, 2, 'À venir', NULL, NULL),
(3, 'Formation sécurité', 'Formation obligatoire sur la sécurité pour tous les employés.', '2023-06-20 14:00:00', '2023-06-20 16:00:00', 1, NULL, 'À venir', NULL, NULL),
(4, 'Visite client - Garage Martin', 'Visite avec le client pour valider les travaux.', '2023-06-22 10:00:00', '2023-06-22 12:00:00', 2, 4, 'Terminé', NULL, NULL),
(5, 'Maintenance équipement', 'Maintenance préventive des outils et machines.', '2023-06-25 08:30:00', '2023-06-25 12:30:00', 3, NULL, 'À venir', NULL, NULL),
(7, 'Test', 'xfcgvhbjnk', '2026-01-22 10:26:00', '2026-01-22 11:28:00', 2, 1, 'À venir', NULL, '2026-01-22 12:02:19'),
(8, 'Test', 'Test2', '2026-01-22 00:00:00', '2026-01-22 12:00:00', 1, NULL, 'À venir', '2026-01-22 09:52:01', '2026-01-22 09:52:01'),
(9, 'Test', 'liku,jnhgbfv', '2026-01-22 00:00:00', NULL, 4, NULL, 'À venir', '2026-01-22 12:28:14', '2026-01-22 12:28:14'),
(10, 'Test', NULL, '2026-01-30 09:30:00', NULL, 1, NULL, 'À venir', '2026-01-22 13:13:37', '2026-01-22 13:13:37');

-- --------------------------------------------------------

--
-- Structure de la table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
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
-- Structure de la table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_100000_create_password_resets_table', 1),
(2, '2019_08_19_000000_create_failed_jobs_table', 1),
(3, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(4, '2026_01_20_141228_create_roles_table', 1),
(5, '2026_01_20_141241_create_equipements_table', 1),
(6, '2026_01_20_141254_create_chantiers_table', 1),
(7, '2026_01_20_141306_create_devis_table', 1),
(8, '2026_01_20_141321_create_evenements_table', 1),
(9, '2026_01_20_141724_create_users_table', 1);

-- --------------------------------------------------------

--
-- Structure de la table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `roles`
--

INSERT INTO `roles` (`id`, `nom`, `created_at`, `updated_at`) VALUES
(1, 'Administrateur', NULL, NULL),
(2, 'Responsable de chantier', NULL, NULL),
(3, 'Ouvrier', NULL, NULL),
(4, 'Apprenti', NULL, NULL),
(5, 'Intérimaire', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `timesheets`
--

DROP TABLE IF EXISTS `timesheets`;
CREATE TABLE IF NOT EXISTS `timesheets` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED NOT NULL,
  `chantier_id` bigint UNSIGNED NOT NULL,
  `mois` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Ex: Janvier 2024',
  `jour` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Ex: Lundi, Mardi...',
  `date_travail` date NOT NULL,
  `heure_debut` time NOT NULL,
  `heure_fin` time NOT NULL,
  `pause` tinyint(1) DEFAULT '0' COMMENT '1 = pause prise, 0 = pas de pause',
  `heures_supp` decimal(5,2) DEFAULT '0.00' COMMENT 'Heures supplémentaires',
  `zone` tinyint UNSIGNED DEFAULT NULL COMMENT 'Zone de travail (1-4)',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `timesheets_user_id_foreign` (`user_id`),
  KEY `timesheets_chantier_id_foreign` (`chantier_id`),
  KEY `idx_date_user` (`date_travail`,`user_id`),
  KEY `idx_mois` (`mois`)
) ;

--
-- Déchargement des données de la table `timesheets`
--

INSERT INTO `timesheets` (`id`, `user_id`, `chantier_id`, `mois`, `jour`, `date_travail`, `heure_debut`, `heure_fin`, `pause`, `heures_supp`, `zone`, `created_at`, `updated_at`) VALUES
(11, 8, 2, 'January 2026', 'Thursday', '2026-01-29', '08:00:00', '17:00:00', 1, 0.00, 1, '2026-01-29 13:28:12', '2026-01-29 13:28:12');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `nom` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adresse` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mot_de_passe` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL,
  `date_embauche` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_role_id_foreign` (`role_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Adresse de l''utilisateur';

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `nom`, `email`, `telephone`, `adresse`, `mot_de_passe`, `role_id`, `date_embauche`, `created_at`, `updated_at`) VALUES
(8, 'Szlazak', 'eurl.szlazak@hotmail.fr', '0612345678', '123 Rue de la Construction, 55000 Bar-le-Duc', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, '2026-01-28', '2026-01-28 14:13:49', '2026-01-28 14:13:49');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
