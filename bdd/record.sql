-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : ven. 12 fév. 2021 à 16:20
-- Version du serveur :  5.7.24
-- Version de PHP : 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `record`
--

-- --------------------------------------------------------

--
-- Structure de la table `artist`
--

CREATE TABLE `artist` (
  `artist_id` int(11) NOT NULL,
  `artist_name` varchar(255) DEFAULT NULL,
  `artist_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `artist`
--

INSERT INTO `artist` (`artist_id`, `artist_name`, `artist_url`) VALUES
(1, 'Neil Young', NULL),
(2, 'YES', NULL),
(3, 'Rolling Stones', NULL),
(4, 'Queens of the Stone Age', NULL),
(5, 'Serge Gainsbourg', NULL),
(6, 'AC/DC', NULL),
(7, 'Marillion', NULL),
(8, 'Bob Dylan', NULL),
(9, 'Fleshtones', NULL),
(10, 'The Clash', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `disc`
--

CREATE TABLE `disc` (
  `disc_id` int(11) NOT NULL,
  `disc_title` varchar(255) DEFAULT NULL,
  `disc_year` int(11) DEFAULT NULL,
  `disc_picture` varchar(255) DEFAULT NULL,
  `disc_label` varchar(255) DEFAULT NULL,
  `disc_genre` varchar(255) DEFAULT NULL,
  `disc_price` decimal(6,2) DEFAULT NULL,
  `artist_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `disc`
--

INSERT INTO `disc` (`disc_id`, `disc_title`, `disc_year`, `disc_picture`, `disc_label`, `disc_genre`, `disc_price`, `artist_id`) VALUES
(1, 'Fugazi', 1984, 'Fugazi.jpeg', 'EMI', 'Prog', '14.99', 7),
(2, 'Songs for the Deaf', 2002, 'Songs for the Deaf.jpeg', 'Interscope Records', 'Rock/Stoner', '12.99', 4),
(3, 'Harvest Moon', 1992, 'Harvest Moon.jpeg', 'Reprise Records', 'Rock', '4.20', 1),
(4, 'Initials BB', 1968, 'Initials BB.jpeg', 'Philips', ' Chanson, Pop Rock', '12.99', 5),
(5, 'After the Gold Rush', 1970, 'After the Gold Rush.jpeg', ' Reprise Records', 'Country Rock', '20.00', 1),
(6, 'Broken Arrow', 1996, 'Broken Arrow.jpeg', 'Reprise Records', ' Country Rock, Classic Rock', '15.00', 1),
(7, 'Highway To Hell', 1979, 'Highway To Hell.jpeg', 'Atlantic', 'Hard Rock', '15.00', 6),
(8, 'Drama', 1980, 'Drama.jpeg', 'Atlantic', 'Prog', '15.00', 2),
(9, 'Year of the Horse', 1997, 'Year of the Horse.jpeg', 'Reprise Records', 'Country Rock, Classic Rock', '7.50', 1),
(10, 'Ragged Glory', 1990, 'Ragged Glory.jpeg', 'Reprise Records', 'Country Rock, Grunge', '11.00', 1),
(11, 'Rust Never Sleeps', 1979, 'Rust Never Sleeps.jpeg', 'Reprise Records', 'Classic Rock, Arena Rock', '15.00', 1),
(12, 'Exile on main street', 1972, 'Exile on main street.jpeg', 'Rolling Stones Records', 'Blues Rock, Classic Rock', '33.00', 1),
(13, 'London Calling', 1971, 'London Calling.jpeg', 'CBS', 'Punk, New Wave', '33.00', 10),
(14, 'Beggars Banquet', 1968, 'Beggars Banquet.jpeg', 'Rolling Stones Records', 'Blues Rock, Classic Rock', '33.00', 1),
(15, 'Laboratory of sound', 1995, 'Laboratory of sound.jpeg', 'Rebel Rec.', 'Rock', '33.00', 9),
(20, 'Aux Armes et Caetera', 1975, 'Aux armes Et Caetera.jpg', 'Warner', 'Pop Rock', '22.00', 5),
(21, 'Black in Black', 1934, 'Back in Black.jpg', 'PolyGram', 'Rock', '32.00', 6),
(22, 'Clutching at Straws', 1934, 'Clutching at Straws.jpg', 'PolyGram', 'Prog', '26.00', 7),
(23, 'Confidentiel', 1978, 'Confidentiel.jpg', 'Univers Sale', 'Pop Rock', '37.00', 5),
(24, 'Desire', 1934, 'Desire.jpg', 'PolyGram', 'Rock', '39.00', 8);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `users_mail` varchar(250) NOT NULL,
  `users_nom` varchar(250) NOT NULL,
  `users_prenom` varchar(250) NOT NULL,
  `users_mdp` varchar(250) NOT NULL,
  `users_block` tinyint(1) NOT NULL,
  `users_role` varchar(250) NOT NULL DEFAULT 'User'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`users_mail`, `users_nom`, `users_prenom`, `users_mdp`, `users_block`, `users_role`) VALUES
('caro@afpa.fr', 'POTELLE', 'Caroline', '$2y$10$rj7efI8yc.0EwjzKaD2dK.IfKBVP3mIgDp3Dv1qygxhBfNzzDnqQq', 0, 'Admin'),
('cedric@afpa.fr', 'COUSIN', 'Cédric', '$2y$10$77owIJyIB2v5Du3tSyLM2un0MG4cQy32VWJZS0K3CZ.SMe2k80n1.', 0, 'User'),
('charles@afpa.fr', 'LEGRAND', 'Charles', '$2y$10$o3rWakhZ7qghnTFdoLLmqu6vmPH74x9L.ZmtbCMKagWxHw1cHdAR.', 0, 'User'),
('clement@afpa.fr', 'DUMAS', 'Clément', '$2y$10$ZA28EicdtAeoNB46ssY5v.Fh7W8bMLJSaJ43cTL1YAGyw4YQOD006', 0, 'User');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `artist`
--
ALTER TABLE `artist`
  ADD PRIMARY KEY (`artist_id`);

--
-- Index pour la table `disc`
--
ALTER TABLE `disc`
  ADD PRIMARY KEY (`disc_id`),
  ADD KEY `artist_id` (`artist_id`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`users_mail`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `artist`
--
ALTER TABLE `artist`
  MODIFY `artist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `disc`
--
ALTER TABLE `disc`
  MODIFY `disc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `disc`
--
ALTER TABLE `disc`
  ADD CONSTRAINT `disc_ibfk_1` FOREIGN KEY (`artist_id`) REFERENCES `artist` (`artist_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
