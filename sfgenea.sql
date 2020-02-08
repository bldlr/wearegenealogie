-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  sam. 08 fév. 2020 à 12:52
-- Version du serveur :  10.4.6-MariaDB
-- Version de PHP :  7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `sfgenea`
--

-- --------------------------------------------------------

--
-- Structure de la table `migration_versions`
--

CREATE TABLE `migration_versions` (
  `version` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `executed_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migration_versions`
--

INSERT INTO `migration_versions` (`version`, `executed_at`) VALUES
('20200106204321', '2020-01-06 20:43:31'),
('20200106205304', '2020-01-06 20:53:09'),
('20200106205515', '2020-01-06 20:55:19'),
('20200106205719', '2020-01-06 20:57:23'),
('20200106205956', '2020-01-06 20:59:59'),
('20200106210449', '2020-01-06 21:04:55'),
('20200106210651', '2020-01-06 21:06:55'),
('20200106210921', '2020-01-06 21:09:26'),
('20200106211244', '2020-01-06 21:12:50'),
('20200106215452', '2020-01-06 21:54:55'),
('20200106215542', '2020-01-06 21:55:47');

-- --------------------------------------------------------

--
-- Structure de la table `parents`
--

CREATE TABLE `parents` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `mere_id` int(11) DEFAULT NULL,
  `pere_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `parents`
--

INSERT INTO `parents` (`id`, `user_id`, `mere_id`, `pere_id`) VALUES
(1, 13, 25, 24),
(2, 9, 25, 24),
(3, 2, 25, 24),
(4, 18, 25, 24),
(5, 22, 25, 24),
(6, 23, 25, 24),
(7, 15, 14, 13),
(8, 16, 14, 13),
(9, 17, 14, 13),
(10, 11, 10, 9),
(11, 12, 10, 9),
(12, 3, 2, 1),
(13, 4, 2, 1),
(14, 5, 2, 1),
(15, 6, 2, 1),
(16, 20, 19, 18),
(17, 21, 19, 18),
(18, 27, 16, 26),
(37, 24, 31, 30),
(39, 32, 31, 30),
(40, 33, 31, 30),
(41, 30, 35, 34),
(42, 34, 37, 36);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `lieu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sexe` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `nom`, `prenom`, `date`, `lieu`, `sexe`) VALUES
(1, 'duval', 'olivier', '1971-04-14', 'fresnay sur sarthe', 'm'),
(2, 'lord', 'hedwige', '1977-07-22', 'versailles', 'f'),
(3, 'duval', 'oliviane', '2003-06-26', 'versailles', 'f'),
(4, 'duval', 'juliette', '2005-08-22', 'versailles', 'f'),
(5, 'duval', 'marie', '2006-10-20', 'versailles', 'f'),
(6, 'duval', 'louis', '2008-12-26', 'versailles', 'm'),
(9, 'lord', 'julien', '1975-06-04', 'paris', 'm'),
(10, 'bartos', 'dorota', '1976-10-18', 'szczecinek', 'f'),
(11, 'lord', 'emilie', '2006-11-06', 'szczecinek', 'f'),
(12, 'lord', 'victor', '2009-10-28', 'le chesnay', 'm'),
(13, 'lord', 'matthieu', '1973-12-01', 'paris', 'm'),
(14, 'zdunkiewicz', 'aneta', '1972-05-25', 'wroclaw', 'f'),
(15, 'lord', 'adrien', '1997-04-13', 'wroclaw', 'm'),
(16, 'lord', 'isabelle', '1999-03-22', 'le chesnay', 'f'),
(17, 'lord', 'marie', '2000-06-26', 'le chesnay', 'f'),
(18, 'lord', 'charles', '1980-04-06', 'versailles', 'm'),
(19, 'payet', 'julie', '1985-05-29', 'chartres', 'f'),
(20, 'lord', 'jules', '2012-08-18', 'chartres', 'm'),
(21, 'lord', 'jeanne', '2015-09-06', 'chartres', 'f'),
(22, 'lord', 'nicolas', '1984-04-24', 'versailles', 'm'),
(23, 'lord', 'barthelemy', '1989-02-17', 'versailles', 'm'),
(24, 'lord', 'jacques', '1937-01-11', 'nantes', 'm'),
(25, 'woycicka', 'hanna', '1945-11-13', 'starachowice', 'f'),
(26, 'da silva', 'pedro', '1996-04-12', 'portugal', 'm'),
(27, 'da silva', 'mya', '2019-12-18', 'rambouillet', 'f'),
(30, 'Lord', 'Guy', '1909-08-25', 'Gennevilliers', 'm'),
(31, 'Pinel', 'Marie-Louise', '1909-08-25', 'Sainte Etienne de Montluc', 'f'),
(32, 'Lord', 'Annick', '1940-11-13', 'Nantes', 'f'),
(33, 'Lord', 'Madeleine', '1944-09-23', 'Nantes', 'f'),
(34, 'Lord', 'André', '1880-10-10', 'Nantes', 'm'),
(35, 'Laurent', 'Marie', '1873-09-21', 'Ile-aux-Moines', 'f'),
(36, 'Lord', 'Jean-Baptiste', '1851-06-24', 'Nantes', 'm'),
(37, 'Lanoë', 'Valérie', '1858-02-18', 'Nantes', 'f');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `migration_versions`
--
ALTER TABLE `migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `parents`
--
ALTER TABLE `parents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_FD501D6A39DEC40E` (`mere_id`),
  ADD KEY `IDX_FD501D6A3FD73900` (`pere_id`),
  ADD KEY `IDX_FD501D6AA76ED395` (`user_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `parents`
--
ALTER TABLE `parents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `parents`
--
ALTER TABLE `parents`
  ADD CONSTRAINT `FK_FD501D6A39DEC40E` FOREIGN KEY (`mere_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_FD501D6A3FD73900` FOREIGN KEY (`pere_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_FD501D6AA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
