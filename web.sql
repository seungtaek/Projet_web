-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Mer 25 Avril 2018 à 12:03
-- Version du serveur :  5.7.14
-- Version de PHP :  5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `web`
--

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

CREATE TABLE `commentaire` (
  `id` int(11) NOT NULL,
  `id_auteur` int(11) NOT NULL,
  `contenu` text NOT NULL,
  `id_question` int(11) NOT NULL,
  `date` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `commentaire`
--

INSERT INTO `commentaire` (`id`, `id_auteur`, `contenu`, `id_question`, `date`) VALUES
(1, 2, 'Ceci est un commentaire de tommy', 3, '2018-02-25 23:00:00'),
(6, 1, 'Ceci est un commentaire rtin5', 3, '2018-02-24 23:00:00'),
(15, 1, 'Ceci est un nouveau commentaire', 6, '2018-04-23 06:03:16');

-- --------------------------------------------------------

--
-- Structure de la table `ips`
--

CREATE TABLE `ips` (
  `ip` varchar(15) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `ips`
--

INSERT INTO `ips` (`ip`, `status`) VALUES
('127.0.0.2', 0);

-- --------------------------------------------------------

--
-- Structure de la table `question`
--

CREATE TABLE `question` (
  `id` int(11) NOT NULL,
  `titre` text NOT NULL,
  `contenu` text NOT NULL,
  `date` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `question`
--

INSERT INTO `question` (`id`, `titre`, `contenu`, `date`) VALUES
(4, 'Un sujet interessant ', 'Bon ben ici c\'est le contenu de malade2', '2018-02-23 23:00:00'),
(3, 'Un sujet interessant2520   ', ' Bon ben ici c\'est le contenu de malade!! ', '2018-02-23 23:00:00'),
(5, 'titre', 'contenu', '2018-04-20 16:06:16'),
(6, 'Nouveau titre', 'Nouveau contenu', '2018-04-23 06:02:43');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `pseudo` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `admin` int(11) NOT NULL DEFAULT '0',
  `last_ip` varchar(15) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `mail`, `pseudo`, `password`, `admin`, `last_ip`) VALUES
(1, 'martin.lechemia@gmail.com', 'Pr0xy', 'martin13', 1, '127.0.0.1'),
(2, 'tommy@ynov.com', 'Tommydu13', 'tommy13', 0, '127.0.0.1');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ips`
--
ALTER TABLE `ips`
  ADD UNIQUE KEY `ip` (`ip`);

--
-- Index pour la table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `commentaire`
--
ALTER TABLE `commentaire`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT pour la table `question`
--
ALTER TABLE `question`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
