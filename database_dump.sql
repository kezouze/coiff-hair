-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : mar. 26 sep. 2023 à 13:24
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
-- Structure de la table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `id_pro` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `liked` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Déchargement des données de la table `likes`
--

INSERT INTO `likes` (`id`, `id_pro`, `id_user`, `liked`) VALUES
(90, 1, 33, 0),
(91, 2, 33, 0),
(92, 3, 33, 1),
(93, 14, 33, 1),
(94, 16, 33, 0),
(95, 6, 33, 0),
(96, 1, 46, 1),
(97, 5, 33, 1);

-- --------------------------------------------------------

--
-- Structure de la table `photos`
--

CREATE TABLE `photos` (
  `id_photo` int(11) NOT NULL,
  `id_pro` int(11) NOT NULL,
  `file_access` varchar(100) COLLATE utf8_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Déchargement des données de la table `photos`
--

INSERT INTO `photos` (`id_photo`, `id_pro`, `file_access`) VALUES
(1, 1, '1_20230829090507_64ed98a3996e0.jpg'),
(2, 1, '2_20230829091650_64ed9b62a8a1c.jpg'),
(3, 1, '1_20230906155449_64f884a94eb62.jpg'),
(4, 1, '1_20230907142318_64f9c0b6a405e.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `prestations`
--

CREATE TABLE `prestations` (
  `presta_id` int(11) NOT NULL,
  `presta_name` varchar(50) COLLATE utf8_swedish_ci NOT NULL,
  `presta_descr` varchar(500) COLLATE utf8_swedish_ci NOT NULL,
  `presta_cost` float NOT NULL,
  `id_pro` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Déchargement des données de la table `prestations`
--

INSERT INTO `prestations` (`presta_id`, `presta_name`, `presta_descr`, `presta_cost`, `id_pro`) VALUES
(2, 'Coupe Trendy', 'Une coupe moderne et stylée qui correspond aux dernières tendances de la mode capillaire. Nos coiffeurs expérimentés vous donneront un look frais et tendance.', 500, 1),
(3, 'Coloration Éclatante', 'Transformez votre look avec une coloration professionnelle. Choisissez parmi une variété de teintes pour obtenir une couleur éclatante qui vous fera briller.', 65, 1),
(4, 'Brushing Glamour', 'Pour une soirée spéciale ou une occasion importante, optez pour un brushing glamour. Vos cheveux seront soigneusement coiffés pour un résultat élégant et sophistiqué.', 35, 1),
(5, 'Traitement Capillaire Hydratant', 'Offrez à vos cheveux un soin en profondeur avec notre traitement capillaire hydratant. Il revitalise et nourrit vos cheveux, les laissant doux, lisses et en pleine santé.', 50, 1),
(6, 'Coiffure Mariage', 'Pour le jour le plus spécial de votre vie, confiez-nous votre coiffure de mariage. Nos coiffeurs créent des styles de mariage magnifiques et durables pour vous faire briller le jour J.', 120, 1),
(7, 'Extensions Capillaires', 'Transformez instantanément la longueur et la texture de vos cheveux avec nos extensions capillaires de haute qualité. Obtenez le look dont vous rêvez en un clin d œil.', 80, 2),
(8, 'Coupe Enfant', 'Offrez à vos petits une expérience de coupe agréable et soignée. Nos coiffeurs talentueux savent comment créer des coupes adaptées aux enfants.', 25, 2),
(9, 'Balayage Naturel', 'Obtenez des mèches délicates et un balayage naturel pour éclaircir subtilement votre chevelure. Un choix parfait pour un look lumineux et ensoleillé.', 55, 2);

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
  `likes` int(11) NOT NULL,
  `address` varchar(100) NOT NULL,
  `postal_code` int(5) NOT NULL,
  `city` varchar(100) CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,
  `telephone` varchar(10) NOT NULL,
  `description` text NOT NULL,
  `secret_code` varchar(255) NOT NULL,
  `nb_conn` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `pros`
--

INSERT INTO `pros` (`id_pro`, `name`, `boss`, `email`, `password`, `likes`, `address`, `postal_code`, `city`, `telephone`, `description`, `secret_code`, `nb_conn`) VALUES
(1, 'Faudra Tif\ Hair', 'Jean-Pascal Ciseaux', 'faudratifhair@gmail.com', 'fedf9ad5e8838644186bb0279875c93e', 846, '1 rue du Peigne', 51000, 'Chalons-en-Champagne', '0326272829', 'Bienvenue chez \"Faudra Tif\ Hair\", votre destination capillaire !\r\nL\ endroit où la beauté et la coiffure se rencontrent pour créer des looks époustouflants. Notre salon de coiffure est bien plus qu\ un simple endroit pour prendre soin de vos cheveux, c\ est une expérience de transformation qui vous laissera dubita\ tif !', 'vuojJKYMnz5rn0Ulznm9OaCU3xbxxH', 0),
(2, 'Tête en l\ Hair', 'Jean-Christophe Brosse', 'teteenlhair@gmail.com', 'cdbf7273108864d0c3a48d6845d3bcb0', 88, '2 rue du Peigne', 51100, 'Reims', '0329282726', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '', 0),
(3, 'Atmosph\ Hair', 'Jean-Michel Rasoir', 'coiffhair@contact.fr', 'c3e97dd6e97fb5125688c97f36720cbe', 106, '25 rue de la Beauté', 75001, 'Paris', '0123456789', 'Salon de coiffure de luxe à Paris', '', 0),
(4, 'Imagin\ Hair', 'Pierre-Louis Peigne', 'imaginhair@contact.fr', '775e3a7bf42c6770575b3bba09d1581b', 4, '12 avenue des Coiffeurs', 69002, 'Lyon', '0456789012', 'Expérience de coiffure unique à Lyon', '', 0),
(5, 'Evolu\ tif', 'Marie-Sarah Frange', 'evolutif@gmail.fr', '28e838211c4aafdb1722063a51488ea7', 44, '8 rue des Ciseaux', 31000, 'Toulouse', '0567890123', 'Tendance et style à Toulouse', '', 0),
(6, 'Bol d\ Hair', 'Jean-Eudes Tondeuse', 'boldhair@contact.fr', 'dd844bf91d8b5a38ed7d13f834ec9fbd', 1000000, '42 boulevard de la Coupe', 13008, 'Marseille', '0234567890', 'Marseille Coiffure - Votre beauté notre passion', '', 0),
(7, 'Intui\ Tif', 'Marie-Chantal Brushing', 'intuitif@contact.fr', '2106b31fc0ed06f8f6b7b6163b61cf2b', 3, '17 rue de la Tendance', 44000, 'Nantes', '0345678901', 'Nantes Hair - L\ art de la coiffure', '', 0),
(8, 'Myst\ hair', 'Jean-Philippe Shampoing', 'mysthair@contact.fr', '64ee2c13adf3e4583abb8b97af0fb44b', 4, '5 avenue de la Coiffure', 67000, 'Strasbourg', '0678901234', 'Strasbourg Salon - Votre satisfaction, notre priorité', '', 0),
(14, 'Adult\ hair', 'Jean-Pierre Gel', 'adulthair@contact.fr', '943d3719e0b8fed536c72d88331f5c1c', 2, '33 rue des Brushings', 59000, 'Lille', '0789012345', 'Coiffeur de renom à Lille', '', 0),
(16, 'Hair Marin', 'Jean-Kevin Bigoudi', 'hairmarin@gmail.com', '47a2a020cb27a6424a5e627caa604998', 5, '9 boulevard de la Coloration', 33000, 'Bordeaux', '0890123456', 'Bordeaux Hair Studio - Des looks exceptionnels', '', 0);

-- --------------------------------------------------------

--
-- Structure de la table `rendez_vous`
--

CREATE TABLE `rendez_vous` (
  `id_rendez_vous` int(11) NOT NULL,
  `date_rendez_vous` date NOT NULL,
  `heure_rendez_vous` time NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_pro` int(11) NOT NULL,
  `details_rendez_vous` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `rendez_vous`
--

INSERT INTO `rendez_vous` (`id_rendez_vous`, `date_rendez_vous`, `heure_rendez_vous`, `id_user`, `id_pro`, `details_rendez_vous`) VALUES
(105, '2023-07-25', '13:30:00', 16, 2, 'Repetitio est mater studiorum'),
(117, '2023-09-29', '14:00:00', 39, 1, 'Quand t es con, tu sais pas que t es con puisque t es con... Alors que quand t es pas con, tu sais que parfois t es con.'),
(125, '2023-08-17', '14:00:00', 42, 2, 'Il faut que tu crois encore plus ce que tu crois, et quand tu commences à croire ce que tu crois, y a personne au monde qui peut te bouger !&quot;'),
(126, '2023-08-31', '15:00:00', 42, 3, 'Les plantes par exemple, qui n ont pas de mains, et pas d oreilles,elles sentent les choses, les vibrations , elles sont plus aware que les autres species.'),
(127, '2023-10-15', '09:00:00', 42, 2, 'Quand je demande une question, tu sais à qui je demande ? Moi.'),
(171, '2023-09-04', '12:00:00', 33, 1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam purus augue, pellentesque ut quam a, iaculis sagittis enim. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Pellentesque pretium fermentum magna, vel dapibus lacus posuere et. In in interdum felis. In viverra consequat orci. Nullam euismod in eros id porttitor. Fusce non auctor augue, vestibulum placerat libero. Donec at purus mi. Praesent sit amet enim quis dolor ornare ornare. Nam sapien.'),
(172, '2023-09-05', '09:00:00', 24, 1, 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...&quot;'),
(178, '2023-09-05', '11:00:00', 33, 1, 'Lorem ipsum dolor'),
(183, '2023-09-06', '11:30:00', 33, 1, 'UwU'),
(185, '2023-09-10', '16:00:00', 33, 1, 'jhcjehfuehfjhjcjfghehfohjdkjcke'),
(187, '2023-09-10', '17:00:00', 33, 1, 'huhuhuhuhuhuhuhu'),
(197, '2023-09-11', '10:00:00', 16, 1, 'Moi, Adam et Ève, j y crois plus tu vois, parce que je suis pas un idiot : la pomme, ça peut pas être mauvais, c est plein de pectine...'),
(203, '2023-09-11', '12:00:00', 33, 5, 'S il te plaît La Poste, ne bloque pas mes mails. Je suis en jeune dev sans mauvaises intentions.'),
(205, '2023-09-14', '15:00:00', 33, 1, 'uwuwuwuwu'),
(206, '2023-09-15', '15:30:00', 16, 1, 'Rasez-moi tout ça'),
(207, '2023-09-15', '14:30:00', 24, 1, 'J aime bien les bigoudis'),
(210, '2023-09-14', '17:00:00', 33, 1, 'i'),
(211, '2023-09-15', '18:00:00', 33, 1, 'détails détails détails'),
(212, '2023-09-17', '09:00:00', 33, 1, 'dfgthetgthrthet'),
(213, '2023-09-18', '14:30:00', 33, 1, 'lol'),
(214, '2023-09-20', '14:00:00', 33, 1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.'),
(218, '2023-09-25', '13:30:00', 33, 1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum mollis quam semper nunc pellentesque, nec iaculis tellus pretium. Nulla at tortor velit. Nullam nec turpis non felis rutrum rhoncus ac ac urna. Donec eget leo vitae massa ullamcorper aliquet sed ut diam. Sed et ex sit amet lacus consectetur volutpat id vel metus. Integer sagittis luctus massa ut egestas. Sed ligula libero posuere.'),
(219, '2023-09-20', '15:00:00', 24, 1, 'Mauris at felis non orci facilisis eleifend dolor.'),
(220, '2023-09-20', '16:00:00', 16, 1, 'Nulla lobortis viverra libero. Phasellus molestie.'),
(221, '2023-09-20', '11:30:00', 39, 1, 'Morbi a ornare est. Etiam rhoncus justo sit nulla.'),
(222, '2023-09-29', '17:00:00', 34, 1, 'Morbi dapibus condimentum vulputate. Mauris justo.'),
(224, '2023-09-29', '12:00:00', 16, 1, 'jsboazgflkjcnjehfjanxkljasnckj'),
(226, '2023-09-29', '15:00:00', 24, 1, 'Bonjour'),
(227, '0001-12-25', '10:00:00', 777, 1, 'Il est né le divin enfant !'),
(228, '2023-09-29', '10:30:00', 33, 1, 'Une coupe au bol s il vous plaît');

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
(16, 'M', 'Lepagnol', 'Arthur', 'arthur', 'arthur.lepagnol@gmail.com', 'ab664f63c186e43eb51f33c5f1a7e116', 'X6ztDqQopaeblDMbgnQSKSDlAeOlRQ', 3),
(24, 'F', 'Herbeck', 'Léa', 'léa', 'herbecklea@gmail.com', 'caefd401ef847d47211327c8c87f97e7', '', 25),
(30, '', '', '', 'jean-michel', 'jm@gmail.com', '19c6754b1a7081962992a0db22808225', '', 0),
(31, '', '', '', 'jean-pierre', 'jp@gmail.com', '86fccf789005073a29f4f52fa1a32d87', '', 0),
(32, '', '', '', 'jean-eudes', 'je@gmail.com', '9cd9b1f20950c8aa95ebe316dd028d67', '', 0),
(33, 'M', 'Constantin', 'Vincent', 'kezouze', 'vincent-c51@hotmail.fr', 'a9305e393ac7d072eef0900b88d491de', 'kBrvPdi3LM5e0rCNFLeBlpIlSLP2zi', 233),
(34, 'M', 'Rosenfeld', 'Alexandre', 'アレ ッちゃん', 'rosenfeld-alexandre@gmail.com', 'cc4e0c373679bbe6b7340fdcbf1e9dcd', '', 1),
(35, 'M', 'tartempion', 'michel', 'enculé', 'tartempion@hotmail.fr', 'a925576942e94b2ef57a066101b48876', '', 0),
(36, 'O', 'Woke', 'ewok', 'didyouassumemygender?', 'woke@gmail.com', '2cadc60f102c1dd749224079e7e87b51', '', 0),
(37, 'F', 'Gillaux', 'Claire', 'clairaux', 'gillaux.claire@gmail.fr', 'e8008e06909d08bccc344f7e56b1461b', '', 0),
(38, 'F', 'Sylvie', 'Constantin', 'Godin', 'sylvie@gmail.com', 'e39a4b0485738b1d5707b5ee264b249b', '', 0),
(39, 'M', 'Grantot', 'Jacky', 'zigloule', 'zigloule@gmail.com', 'df393fba3977a564ccbfbfdd4f5b85c3', '', 6),
(40, 'M', 'hacker', 'man', 'hackerman', 'hakerman@gmail.com', 'c13d23675b7a621212c3a6bb07e0e8df', '', 1),
(41, 'F', 'Deneuve', 'Catherine', 'cath', 'cath@gmail.com', '28b3612c40584d65cfc5a51af2627c04', '', 0),
(42, 'K', 'Mobile', 'Mobile', 'mobile', 'mobile@gmail.com', '532c28d5412dd75bf975fb951c740a30', '', 7),
(43, 'F', 'Dupont', 'Élodie', 'Dudie', 'dudie@gmail.com', '12a032ce9179c32a6c7ab397b9d871fa', '', 0),
(45, 'M', 'Constantin', 'Rémi', 'hardflipbox', 'hardflipbox@gmail.com', 'aacb65aabab3b9ccfe7ccfa62661cf85', '', 0),
(46, 'M', 'Jean-Marc', 'Teste', 'jmt', 'jmt@gmail.com', '8815b7196884f2d17ffd001eca8f0d63', '', 1),
(777, 'M', 'Christ', 'Jésus', 'Seigneur', 'seigneur@gmail.com', '8bd5b67121d84eecff7a0f2130509521', '', 777);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`id_photo`),
  ADD KEY `pro_id` (`id_pro`);

--
-- Index pour la table `prestations`
--
ALTER TABLE `prestations`
  ADD PRIMARY KEY (`presta_id`),
  ADD KEY `id_pro` (`id_pro`);

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
-- AUTO_INCREMENT pour la table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT pour la table `photos`
--
ALTER TABLE `photos`
  MODIFY `id_photo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `prestations`
--
ALTER TABLE `prestations`
  MODIFY `presta_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `pros`
--
ALTER TABLE `pros`
  MODIFY `id_pro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `rendez_vous`
--
ALTER TABLE `rendez_vous`
  MODIFY `id_rendez_vous` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=229;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=778;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
