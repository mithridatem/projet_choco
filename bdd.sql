-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 20 juin 2023 à 00:15
-- Version du serveur : 10.4.24-MariaDB
-- Version de PHP : 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `chocoblast`
--

-- --------------------------------------------------------

--
-- Structure de la table `chocoblast`
--

CREATE TABLE `chocoblast` (
  `id_chocoblast` int(11) NOT NULL,
  `slogan_chocoblast` text NOT NULL,
  `date_chocoblast` date NOT NULL,
  `statut_chocoblast` tinyint(1) DEFAULT 0,
  `cible_chocoblast` int(11) NOT NULL,
  `auteur_chocoblast` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

CREATE TABLE `commentaire` (
  `id_commentaire` int(11) NOT NULL,
  `note_commentaire` int(11) DEFAULT NULL,
  `text_commentaire` text NOT NULL,
  `date_commentaire` datetime NOT NULL,
  `statut_commentaire` tinyint(1) DEFAULT 0,
  `id_chocoblast` int(11) NOT NULL,
  `auteur_commentaire` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

CREATE TABLE `roles` (
  `id_roles` int(11) NOT NULL,
  `nom_roles` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id_utilisateur` int(11) NOT NULL,
  `nom_utilisateur` varchar(50) NOT NULL,
  `prenom_utilisateur` varchar(50) NOT NULL,
  `mail_utilisateur` varchar(50) NOT NULL,
  `password_utilisateur` varchar(100) NOT NULL,
  `image_utilisateur` varchar(100) DEFAULT NULL,
  `statut_utilisateur` tinyint(1) DEFAULT 0,
  `id_roles` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `vwauteur`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `vwauteur` (
`id_auteur` int(11)
,`nom_auteur` varchar(50)
,`prenom_auteur` varchar(50)
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `vwcible`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `vwcible` (
`id_cible` int(11)
,`nom_cible` varchar(50)
,`prenom_cible` varchar(50)
);

-- --------------------------------------------------------

--
-- Structure de la vue `vwauteur`
--
DROP TABLE IF EXISTS `vwauteur`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vwauteur`  AS SELECT `utilisateur`.`id_utilisateur` AS `id_auteur`, `utilisateur`.`nom_utilisateur` AS `nom_auteur`, `utilisateur`.`prenom_utilisateur` AS `prenom_auteur` FROM `utilisateur``utilisateur`  ;

-- --------------------------------------------------------

--
-- Structure de la vue `vwcible`
--
DROP TABLE IF EXISTS `vwcible`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vwcible`  AS SELECT `utilisateur`.`id_utilisateur` AS `id_cible`, `utilisateur`.`nom_utilisateur` AS `nom_cible`, `utilisateur`.`prenom_utilisateur` AS `prenom_cible` FROM `utilisateur``utilisateur`  ;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `chocoblast`
--
ALTER TABLE `chocoblast`
  ADD PRIMARY KEY (`id_chocoblast`),
  ADD KEY `fk_chocoblaster_chocoblast` (`auteur_chocoblast`),
  ADD KEY `fk_cibler_chocoblast` (`cible_chocoblast`);

--
-- Index pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD PRIMARY KEY (`id_commentaire`),
  ADD KEY `fk_poster_commentaire` (`auteur_commentaire`),
  ADD KEY `fk_rattacher_commentaire` (`id_chocoblast`);

--
-- Index pour la table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_roles`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id_utilisateur`),
  ADD KEY `fk_posseder_roles` (`id_roles`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `chocoblast`
--
ALTER TABLE `chocoblast`
  MODIFY `id_chocoblast` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `commentaire`
--
ALTER TABLE `commentaire`
  MODIFY `id_commentaire` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `roles`
--
ALTER TABLE `roles`
  MODIFY `id_roles` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id_utilisateur` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `chocoblast`
--
ALTER TABLE `chocoblast`
  ADD CONSTRAINT `fk_chocoblaster_chocoblast` FOREIGN KEY (`auteur_chocoblast`) REFERENCES `utilisateur` (`id_utilisateur`),
  ADD CONSTRAINT `fk_cibler_chocoblast` FOREIGN KEY (`cible_chocoblast`) REFERENCES `utilisateur` (`id_utilisateur`);

--
-- Contraintes pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD CONSTRAINT `fk_poster_commentaire` FOREIGN KEY (`auteur_commentaire`) REFERENCES `utilisateur` (`id_utilisateur`),
  ADD CONSTRAINT `fk_rattacher_commentaire` FOREIGN KEY (`id_chocoblast`) REFERENCES `chocoblast` (`id_chocoblast`);

--
-- Contraintes pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD CONSTRAINT `fk_posseder_roles` FOREIGN KEY (`id_roles`) REFERENCES `roles` (`id_roles`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
