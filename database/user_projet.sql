-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : ven. 21 juil. 2023 à 16:01
-- Version du serveur : 5.7.39
-- Version de PHP : 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `user_projet`
--

-- --------------------------------------------------------

--
-- Structure de la table `rendez_vous`
--

CREATE TABLE `rendez_vous` (
  `id_rendez_vous` int(11) NOT NULL,
  `date_rendez_vous` date NOT NULL,
  `heure_rendez_vous` time NOT NULL,
  `id_user` int(11) NOT NULL,
  `details_rendez_vous` text NOT NULL,
  `rappel` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `rendez_vous`
--

INSERT INTO `rendez_vous` (`id_rendez_vous`, `date_rendez_vous`, `heure_rendez_vous`, `id_user`, `details_rendez_vous`, `rappel`) VALUES
(11, '2023-05-17', '20:00:00', 1, 'Test de la prise de rendez-vous', 0),
(12, '2023-06-15', '12:00:00', 1, "Date d\'anniversaire de Monsieur Guillaume Delanchy", 0),
(14, '2023-05-27', '21:10:00', 27, 'Test test test', 0),
(27, '2023-07-09', '10:00:00', 23, 'Hi there', 0),
(28, '2023-07-09', '11:00:00', 23, 'UwU', 0),
(63, '2023-07-16', '14:00:00', 37, 'Coucou petite perruche :) ', 0),
(75, '2023-07-20', '11:00:00', 1, 'De gustibus non disputandum', 0),
(76, '2023-07-20', '10:30:00', 1, 'De gustibus non disputandum', 0),
(80, '2023-07-21', '12:00:00', 39, 'yolo', 1),
(82, '2023-07-24', '09:00:00', 24, 'Ad impossibilia nemo obligatur', 1),
(92, '2023-07-30', '14:30:00', 33, 'Ego te intus et in cute novi', 0);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `gender` char(1) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `pseudo` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `secret_code` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `gender`, `last_name`, `first_name`, `pseudo`, `email`, `password`, `secret_code`) VALUES
(1, 'M', 'moi', 'moi', 'moi', 'moi@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', ''),
(2, '', '', '', 'toi', 'toi@gmail.com', '01cfcd4f6b8770febfb40cb906715822', ''),
(3, '', '', '', 'nous', 'nous@gmail.com', '3e0101ecf0d8427cf14f3f6dc2f0282d', ''),
(4, '', '', '', 'lol', 'lol@gmail.com', '9cdfb439c7876e703e307864c9167a15', ''),
(5, '', 'Delanchy', 'Guillaume', 'guillaume', 'guillaume@gmail.com', '3f242b15d8fb9136232dfcfd734ce02b', ''),
(6, 'F', 'Champenois', 'Philip', 'philip', 'philip@gmail.com', '1fcd0c19c4837188809fb7dcda214849', ''),
(7, '', '', '', 'JB', 'jb@gmail.com', 'a9aedc6c39f654e55275ad8e65e316b3', ''),
(9, '', 'Lachery', 'Quentin', 'lukyss', 'quentin@gmail.com', '1b68f1ff30fc20296018fa14066b38ee', ''),
(16, '', 'Lepagnol', 'Arthur', 'arthur', 'arthur@gmail.com', 'ab664f63c186e43eb51f33c5f1a7e116', 'X6ztDqQopaeblDMbgnQSKSDlAeOlRQ'),
(24, 'F', 'Herbeck', 'Léa', 'léa', 'herbecklea@gmail.com', 'caefd401ef847d47211327c8c87f97e7', ''),
(30, '', '', '', 'jean-michel', 'jm@gmail.com', '19c6754b1a7081962992a0db22808225', ''),
(31, '', '', '', 'jean-pierre', 'jp@gmail.com', '86fccf789005073a29f4f52fa1a32d87', ''),
(32, '', '', '', 'jean-eudes', 'je@gmail.com', '9cd9b1f20950c8aa95ebe316dd028d67', ''),
(33, 'M', 'Constantin', 'Vincent', 'kezouze', 'vincent-c51@hotmail.fr', '17c4520f6cfd1ab53d8745e84681eb49', 'fNhuRTDen3B1PilCHaBzFgmolyqiO6'),
(34, '', 'Rosenfeld', 'Alexandre', 'アレ ッちゃん', 'rosenfeld-alexandre@gmail.com', '66ed93c6e89d59c2d05fff33f2647ea1', ''),
(35, 'M', 'tartempion', 'michel', 'enculé', 'tartempion@hotmail.fr', 'a925576942e94b2ef57a066101b48876', ''),
(36, 'O', 'Woke', 'ewok', 'didyouassumemygender?', 'woke@gmail.com', '2cadc60f102c1dd749224079e7e87b51', ''),
(37, 'F', 'Gillaux', 'Claire', 'clairaux', 'gillaux.claire@gmail.fr', 'e8008e06909d08bccc344f7e56b1461b', ''),
(38, 'F', 'Sylvie', 'Constantin', 'Godin', 'sylvie@gmail.com', 'e39a4b0485738b1d5707b5ee264b249b', ''),
(39, 'M', 'Grantot', 'Jacky', 'zigloule', 'zigloule@gmail.com', 'df393fba3977a564ccbfbfdd4f5b85c3', '');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `rendez_vous`
--
ALTER TABLE `rendez_vous`
  ADD PRIMARY KEY (`id_rendez_vous`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `rendez_vous`
--
ALTER TABLE `rendez_vous`
  MODIFY `id_rendez_vous` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
