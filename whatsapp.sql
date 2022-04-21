-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 21 avr. 2022 à 09:17
-- Version du serveur : 10.4.22-MariaDB
-- Version de PHP : 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `whatsapp`
--

-- --------------------------------------------------------

--
-- Structure de la table `amis`
--

CREATE TABLE `amis` (
  `id` int(11) NOT NULL,
  `idRecipient` int(11) DEFAULT NULL,
  `idSpeaker` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `discussions`
--

CREATE TABLE `discussions` (
  `id` int(11) NOT NULL,
  `idLastMessage` int(11) DEFAULT NULL,
  `idAmis` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `messageimportants`
--

CREATE TABLE `messageimportants` (
  `id` int(11) NOT NULL,
  `idSpeaker` int(11) DEFAULT NULL,
  `idMessage` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `hour` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `state` int(11) NOT NULL,
  `idRecipient` int(11) DEFAULT NULL,
  `idSpeaker` int(11) DEFAULT NULL,
  `idDiscussion` int(11) DEFAULT NULL,
  `readMsg` int(11) NOT NULL,
  `messageMsg` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `deleteSpeaker` int(11) NOT NULL,
  `deleteRecipient` int(11) NOT NULL,
  `deleteEverybody` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`id`, `date`, `hour`, `state`, `idRecipient`, `idSpeaker`, `idDiscussion`, `readMsg`, `messageMsg`, `deleteSpeaker`, `deleteRecipient`, `deleteEverybody`) VALUES
(1, '0000-00-00', '0000-00-00', 0, NULL, NULL, NULL, 1, '', 0, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `statuts`
--

CREATE TABLE `statuts` (
  `id` int(11) NOT NULL,
  `idRecipient` int(11) DEFAULT NULL,
  `idSpeaker` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `phoneNumber` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `theme` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `actu` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `state` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nbAlert` int(11) NOT NULL,
  `profilPicture` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `actif` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `amis`
--
ALTER TABLE `amis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_9FE2E76194EED01F` (`idRecipient`),
  ADD KEY `IDX_9FE2E7616B3CB093` (`idSpeaker`);

--
-- Index pour la table `discussions`
--
ALTER TABLE `discussions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_8B716B634A6993C2` (`idLastMessage`),
  ADD KEY `IDX_8B716B63EC1FB9FF` (`idAmis`);

--
-- Index pour la table `messageimportants`
--
ALTER TABLE `messageimportants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_D3B628A56B3CB093` (`idSpeaker`),
  ADD KEY `IDX_D3B628A5A6045B8D` (`idMessage`);

--
-- Index pour la table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_DB021E9694EED01F` (`idRecipient`),
  ADD KEY `IDX_DB021E966B3CB093` (`idSpeaker`),
  ADD KEY `IDX_DB021E96424DE7E5` (`idDiscussion`);

--
-- Index pour la table `statuts`
--
ALTER TABLE `statuts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_403505E694EED01F` (`idRecipient`),
  ADD KEY `IDX_403505E66B3CB093` (`idSpeaker`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `search_idx` (`phoneNumber`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `amis`
--
ALTER TABLE `amis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `discussions`
--
ALTER TABLE `discussions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `messageimportants`
--
ALTER TABLE `messageimportants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT pour la table `statuts`
--
ALTER TABLE `statuts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `amis`
--
ALTER TABLE `amis`
  ADD CONSTRAINT `FK_9FE2E7616B3CB093` FOREIGN KEY (`idSpeaker`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `FK_9FE2E76194EED01F` FOREIGN KEY (`idRecipient`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `discussions`
--
ALTER TABLE `discussions`
  ADD CONSTRAINT `FK_8B716B634A6993C2` FOREIGN KEY (`idLastMessage`) REFERENCES `messages` (`id`),
  ADD CONSTRAINT `FK_8B716B63EC1FB9FF` FOREIGN KEY (`idAmis`) REFERENCES `amis` (`id`);

--
-- Contraintes pour la table `messageimportants`
--
ALTER TABLE `messageimportants`
  ADD CONSTRAINT `FK_D3B628A56B3CB093` FOREIGN KEY (`idSpeaker`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `FK_D3B628A5A6045B8D` FOREIGN KEY (`idMessage`) REFERENCES `messages` (`id`);

--
-- Contraintes pour la table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `FK_DB021E96424DE7E5` FOREIGN KEY (`idDiscussion`) REFERENCES `discussions` (`id`),
  ADD CONSTRAINT `FK_DB021E966B3CB093` FOREIGN KEY (`idSpeaker`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `FK_DB021E9694EED01F` FOREIGN KEY (`idRecipient`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `statuts`
--
ALTER TABLE `statuts`
  ADD CONSTRAINT `FK_403505E66B3CB093` FOREIGN KEY (`idSpeaker`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `FK_403505E694EED01F` FOREIGN KEY (`idRecipient`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
