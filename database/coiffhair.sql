-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : mer. 23 août 2023 à 07:39
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
-- Base de données : `coiffhair`
--

-- --------------------------------------------------------

--
-- Structure de la table `pros`
--

CREATE TABLE `pros` (
  `id_pro` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `boss` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `likes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `pros`
--

INSERT INTO `pros` (`id_pro`, `name`, `boss`, `email`, `password`, `likes`) VALUES
(1, 'Faudra Tif\'Hair', 'Jean-Pascal Ciseaux', 'faudratifhair@gmail.com', 'fedf9ad5e8838644186bb0279875c93e', 1137),
(2, 'Tête en l\'Hair', 'Jean-Christophe Brosse', 'teteenlhair@gmail.com', 'cdbf7273108864d0c3a48d6845d3bcb0', 70),
(3, 'Coiff\'Hair', 'Jean-Michel Rasoir', 'coiffhair@contact.fr', '9d61a05ad187be371dca245f416d3536', 99),
(4, 'Imagin\'Hair', 'Pierre-Louis Peigne', 'imaginhair@contact.fr', '775e3a7bf42c6770575b3bba09d1581b', 1),
(5, 'Evolu\'tif', 'Marie-Sarah Frange', 'evolutif@gmail.fr', '28e838211c4aafdb1722063a51488ea7', 42);

-- --------------------------------------------------------

--
-- Structure de la table `rendez_vous`
--

CREATE TABLE `rendez_vous` (
  `id_rendez_vous` int(11) NOT NULL,
  `date_rendez_vous` date NOT NULL,
  `heure_rendez_vous` time NOT NULL,
  `id_user` int(11) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `id_pro` int(11) NOT NULL,
  `details_rendez_vous` text NOT NULL,
  `rappel` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `rendez_vous`
--

INSERT INTO `rendez_vous` (`id_rendez_vous`, `date_rendez_vous`, `heure_rendez_vous`, `id_user`, `last_name`, `first_name`, `id_pro`, `details_rendez_vous`, `rappel`) VALUES
(11, '2023-05-17', '20:00:00', 1, '', '', 0, 'Test de la prise de rendez-vous', 0),
(12, '2023-06-15', '12:00:00', 1, '', '', 0, 'Date d\'anniversaire de Monsieur Guillaume Delanchy', 0),
(14, '2023-05-27', '21:10:00', 27, '', '', 0, 'Test test test', 0),
(27, '2023-07-09', '10:00:00', 23, '', '', 0, 'Hi there', 0),
(28, '2023-07-09', '11:00:00', 23, '', '', 0, 'UwU', 0),
(63, '2023-07-16', '14:00:00', 37, '', '', 0, 'Coucou petite perruche :) ', 0),
(75, '2023-07-20', '11:00:00', 1, '', '', 0, 'De gustibus non disputandum', 0),
(76, '2023-07-20', '10:30:00', 1, '', '', 0, 'De gustibus non disputandum', 0),
(80, '2023-07-21', '12:00:00', 39, '', '', 0, 'yolo', 1),
(105, '2023-07-25', '13:30:00', 16, '', '', 2, 'Repetitio est mater studiorum', 1),
(109, '2023-07-30', '11:00:00', 24, '', '', 0, 'Salus populi suprema lex', 0),
(112, '2023-07-31', '17:00:00', 41, '', '', 0, 'Actori incumbit onus probandi', 0),
(113, '2023-07-27', '14:00:00', 41, '', '', 0, 'Salus populi suprema lex', 1),
(115, '2023-08-16', '15:30:00', 33, 'constantin', 'vincent', 1, 'Oui alors écoute moi, après il faut s\'intégrer tout ça dans les environnements et il y a de bonnes règles, de bonnes rules car l\'aboutissement de l\'instinct, c\'est l\'amour ! Il y a un an, je t\'aurais parlé de mes muscles.', 0),
(116, '2023-08-16', '16:30:00', 24, 'herbeck', 'léa', 1, '“Les cacahuètes c\'est doux et salé, fort et tendre, comme une femme. Les cacahuètes c\'est le mouvement perpétuel à la portée de l\'homme.”', 0),
(117, '2023-08-16', '17:00:00', 39, 'Grantot', 'Jacky', 2, 'Quand t\'es con, tu sais pas que t\'es con puisque t\'es con... Alors que quand t\'es pas con, tu sais que parfois t\'es con.', 0),
(122, '2023-08-17', '11:30:00', 33, 'Constantin', 'Vincent', 1, 'Je suis fasciné par l\'air. Si on enlevait l\'air du ciel, tous les oiseaux tomberaient par terre... Et les avions aussi... En même temps, l\'air, tu ne peux pas le toucher... Ça existe et ça n\'existe pas... Ça nourrit l\'homme sans qu\'il ait faim... It\'s magic... L\'air, c\'est beau, en même temps, tu ne peux pas le voir, c\'est doux et tu ne peux pas le toucher... L\'air, c\'est un peu comme un cerveau.', 1),
(125, '2023-08-17', '14:00:00', 42, 'Mobile', 'Mobile', 2, 'Il faut que tu crois encore plus ce que tu crois, et quand tu commences à croire ce que tu crois, y a personne au monde qui peut te bouger !&quot;', 0),
(126, '2023-08-31', '15:00:00', 42, 'Mobile', 'Mobile', 3, 'Les plantes par exemple, qui n\'ont pas de mains, et pas d\'oreilles,elles sentent les choses, les vibrations , elles sont plus aware que les autres species.', 0),
(127, '2023-10-15', '09:00:00', 42, 'Mobile', 'Mobile', 2, 'Quand je demande une question, tu sais à qui je demande ? Moi.', 0),
(128, '2023-08-18', '09:30:00', 33, 'Constantin', 'Vincent', 1, 'Si tu téléphones à une voyante et qu\'elle ne décroche pas avant que ça sonne, raccroche.', 0),
(129, '2023-08-21', '10:00:00', 33, 'Constantin', 'Vincent', 1, 'La plus belle religion qu\'on puisse avoir, c\'est de rentrer en soi-même et de digérer l\'essence de la vie, se digérer soi-même et produire à partir de ça sa propre religion: l\'instinct. Et l\'aboutissement de l\'instinct, c\'est l\'amour! Il faut apprendre à aimer. S\'aimer d\'abord soi-même pour pouvoir aimer les autres.', 0),
(131, '2023-08-21', '13:30:00', 24, 'Herbeck', 'Léa', 1, 'Une noisette, j\'la casse entre mes fesses tu vois...', 1),
(133, '2023-08-22', '12:00:00', 33, 'Constantin', 'Vincent', 1, 'jbfouaehfojbncjdzboiuzf', 0);

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
  `secret_code` varchar(100) NOT NULL,
  `nb_conn` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `gender`, `last_name`, `first_name`, `pseudo`, `email`, `password`, `secret_code`, `nb_conn`) VALUES
(1, 'M', 'moi', 'moi', 'moi', 'moi@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '', 0),
(2, '', '', '', 'toi', 'toi@gmail.com', '01cfcd4f6b8770febfb40cb906715822', '', 0),
(3, '', '', '', 'nous', 'nous@gmail.com', '3e0101ecf0d8427cf14f3f6dc2f0282d', '', 0),
(4, '', '', '', 'lol', 'lol@gmail.com', '9cdfb439c7876e703e307864c9167a15', '', 0),
(5, '', 'Delanchy', 'Guillaume', 'guillaume', 'guillaume@gmail.com', '3f242b15d8fb9136232dfcfd734ce02b', '', 0),
(6, 'F', 'Champenois', 'Philip', 'philip', 'philip@gmail.com', '1fcd0c19c4837188809fb7dcda214849', '', 0),
(7, '', '', '', 'JB', 'jb@gmail.com', 'a9aedc6c39f654e55275ad8e65e316b3', '', 0),
(9, '', 'Lachery', 'Quentin', 'lukyss', 'quentin@gmail.com', '1b68f1ff30fc20296018fa14066b38ee', '', 0),
(16, 'M', 'Lepagnol', 'Arthur', 'arthur', 'arthur.lepagnol@gmail.com', 'ab664f63c186e43eb51f33c5f1a7e116', 'X6ztDqQopaeblDMbgnQSKSDlAeOlRQ', 0),
(24, 'F', 'Herbeck', 'Léa', 'léa', 'herbecklea@gmail.com', 'caefd401ef847d47211327c8c87f97e7', '', 11),
(30, '', '', '', 'jean-michel', 'jm@gmail.com', '19c6754b1a7081962992a0db22808225', '', 0),
(31, '', '', '', 'jean-pierre', 'jp@gmail.com', '86fccf789005073a29f4f52fa1a32d87', '', 0),
(32, '', '', '', 'jean-eudes', 'je@gmail.com', '9cd9b1f20950c8aa95ebe316dd028d67', '', 0),
(33, 'M', 'Constantin', 'Vincent', 'kezouze', 'vincent-c51@hotmail.fr', '17c4520f6cfd1ab53d8745e84681eb49', 'fNhuRTDen3B1PilCHaBzFgmolyqiO6', 75),
(34, '', 'Rosenfeld', 'Alexandre', 'アレ ッちゃん', 'rosenfeld-alexandre@gmail.com', '66ed93c6e89d59c2d05fff33f2647ea1', '', 0),
(35, 'M', 'tartempion', 'michel', 'enculé', 'tartempion@hotmail.fr', 'a925576942e94b2ef57a066101b48876', '', 0),
(36, 'O', 'Woke', 'ewok', 'didyouassumemygender?', 'woke@gmail.com', '2cadc60f102c1dd749224079e7e87b51', '', 0),
(37, 'F', 'Gillaux', 'Claire', 'clairaux', 'gillaux.claire@gmail.fr', 'e8008e06909d08bccc344f7e56b1461b', '', 0),
(38, 'F', 'Sylvie', 'Constantin', 'Godin', 'sylvie@gmail.com', 'e39a4b0485738b1d5707b5ee264b249b', '', 0),
(39, 'M', 'Grantot', 'Jacky', 'zigloule', 'zigloule@gmail.com', 'df393fba3977a564ccbfbfdd4f5b85c3', '', 3),
(40, 'M', 'hacker', 'man', 'hackerman', 'hakerman@gmail.com', 'c13d23675b7a621212c3a6bb07e0e8df', '', 1),
(41, 'F', 'Deneuve', 'Catherine', 'cath', 'cath@gmail.com', '28b3612c40584d65cfc5a51af2627c04', '', 0),
(42, 'K', 'Mobile', 'Mobile', 'mobile', 'mobile@gmail.com', '532c28d5412dd75bf975fb951c740a30', '', 5);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `pros`
--
ALTER TABLE `pros`
  ADD PRIMARY KEY (`id_pro`);

--
-- Index pour la table `rendez_vous`
--
ALTER TABLE `rendez_vous`
  ADD PRIMARY KEY (`id_rendez_vous`),
  ADD KEY `id_pro` (`id_pro`),
  ADD KEY `id_user` (`id_user`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `pros`
--
ALTER TABLE `pros`
  MODIFY `id_pro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `rendez_vous`
--
ALTER TABLE `rendez_vous`
  MODIFY `id_rendez_vous` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=134;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
