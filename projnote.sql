-- phpMyAdmin SQL Dump
-- version 4.6.2
-- https://www.phpmyadmin.net/
--
-- Client :  localhost
-- Généré le :  Sam 16 Décembre 2017 à 12:44
-- Version du serveur :  5.7.11
-- Version de PHP :  7.0.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `projnote`
--

-- --------------------------------------------------------

--
-- Structure de la table `listetache`
--

CREATE TABLE `listeTache` (
  `listeId` int(9) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `isPrivate` int(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `listetache`
--

INSERT INTO `listeTache` (`listeId`, `nom`, `isPrivate`) VALUES
(1, 'Liste de course publique', 0),
(2, 'Liste de chose a faire poublique', 0),
(31, 'La liste de moi', 1);

-- --------------------------------------------------------

--
-- Structure de la table `note`
--

CREATE TABLE `note` (
  `id` int(9) NOT NULL,
  `message` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `valid` int(1) NOT NULL,
  `listId` int(9) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `note`
--

INSERT INTO `note` (`id`, `message`, `date`, `valid`, `listId`) VALUES
(1, 'Acheter des carrotes', '16/12/2017', 0, 1),
(2, 'Acheter du lait', '16/12/2017', 0, 1),
(3, 'Acheter une note', '16/12/2017', 0, 1),
(4, 'Manger du php', '16/12/2017', 0, 1),
(5, 'Acheter un cadeau pour l&#39;ocÃ©an', '16/12/2017', 0, 2),
(6, 'Desintaller snapchat', '16/12/2017', 0, 2),
(8, 'Acheter une tasse', '16/12/2017', 0, 1),
(9, 'Sortir Maurice', '16/12/2017', 0, 1),
(10, 'On mange pas nous ?', '16/12/2017', 0, 1),
(11, 'Changer le fond d&#39;Ã©cran du site', '16/12/2017', 0, 1),
(12, 'Faire une note en plus pour afficher le systeme de pagination', '16/12/2017', 0, 1),
(13, 'Faire une note en plus pour afficher le systeme de pagination 2', '16/12/2017', 0, 1),
(14, 'Faire une note en plus pour afficher le systeme de pagination 3', '16/12/2017', 0, 1),
(15, 'Ca marche :) ', '16/12/2017', 0, 1),
(29, 'Mangez-moi', '16/12/2017', 0, 31),
(30, 'Codez-moi', '16/12/2017', 0, 31);

-- --------------------------------------------------------

--
-- Structure de la table `userListe`
--

CREATE TABLE `userListe` (
  `idUser` int(9) NOT NULL,
  `idListe` int(9) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `userListe`
--

INSERT INTO `userListe` (`idUser`, `idListe`) VALUES
(1, 31);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `login`, `password`) VALUES
(1, 'moi', '$2y$10$jaso53s236KpqB1yfjCfW.uQp6LDtHEc4N3h4vU/wEXxvfybOupLO'),
(2, 'okok', '$2y$10$wXu.EOQQ4B3Bxmh222MnAOXY/KgUiuio29v9vaP1XNMeu002VGYti');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `listetache`
--
ALTER TABLE `listeTache`
  ADD PRIMARY KEY (`listeId`);

--
-- Index pour la table `note`
--
ALTER TABLE `note`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `listetache`
--
ALTER TABLE `listeTache`
  MODIFY `listeId` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT pour la table `note`
--
ALTER TABLE `note`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
