-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  ven. 02 avr. 2021 à 17:40
-- Version du serveur :  5.7.26
-- Version de PHP :  7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `blog_p5`
--

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `last_update` datetime NOT NULL,
  `post_id` int(11) NOT NULL,
  `publish` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `comment`
--

INSERT INTO `comment` (`id`, `description`, `user_id`, `last_update`, `post_id`, `publish`) VALUES
(1, 'Test commentaire', 1, '2020-09-04 17:31:27', 1, 1),
(2, 'En effet je trouve que GitHub est très bien pensé mais je reste fidèle à Bitbucket qui peut facilement se coupler à JIRA.', 3, '2020-09-15 11:29:07', 2, 1),
(3, 'test', 5, '2020-09-15 13:21:13', 2, 1),
(4, 'commentaire test', 5, '2020-09-16 09:18:51', 2, 0),
(5, 'jejkfhjhe fjhejkfh jkzeh jkf', 5, '2020-09-16 09:19:18', 2, 0),
(6, 'ret\'(\'(', 2, '2020-09-16 09:22:38', 3, 0),
(7, 'zdzdzdz', 2, '2020-09-16 09:36:50', 3, 0),
(8, 'ffffffffffffffffffffffffffffff ', 2, '2020-09-16 09:37:17', 2, 0),
(9, 'fzefzerfzefzef', 2, '2020-09-16 09:37:51', 2, 0),
(10, 'fzefzefzefz', 2, '2020-09-16 09:37:59', 2, 0),
(11, 'Vraiment null ce post ', 2, '2020-09-16 09:41:15', 3, 0),
(12, 'ajout d\'un cimùmantaire', 2, '2020-09-18 09:14:55', 3, 1),
(13, 'La mise en place de ce framework est assez simple en revanche il faut un certain temps avant de commencer à maîtriser l\'intégralité de ce dernier.', 8, '2020-09-18 09:33:32', 7, 1),
(14, 'Je préfère utiliser BitBucket !!! plus simple et plus &quot;user friendly !!&quot;', 8, '2020-09-18 09:34:44', 2, 1),
(15, 'Tout à fait d\'accord Github c\'est Génial !!!!', 6, '2020-09-18 09:35:18', 2, 1),
(16, 'Est-il-possible de rédiger un article qui comparerait Github à Bitbucket svp ???', 7, '2020-09-18 09:36:19', 2, 1),
(17, 'test commentaire', 6, '2020-09-18 11:11:17', 2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `post`
--

DROP TABLE IF EXISTS `post`;
CREATE TABLE IF NOT EXISTS `post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `hat` text NOT NULL,
  `content` text NOT NULL,
  `last_update` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `post`
--

INSERT INTO `post` (`id`, `title`, `hat`, `content`, `last_update`, `user_id`) VALUES
(1, 'Création d\'un Blog Post', 'Dans le cadre de ma formation chez OpenClassRooms la création d\'un Blog fait partie des projets que j\'ai à réaliser pour obtenir mon diplôme de Développeur d\'application PHP / Symfony.', 'Le projet numéro 5 de la formation D.A (développeur d\'application) PHP / Symfony consiste à développer un blog.\r\n\r\nContexte : \r\nÇa y est, vous avez sauté le pas ! Le monde du développement web avec PHP est à portée de main et vous avez besoin de visibilité pour pouvoir convaincre vos futurs employeurs/clients en un seul regard. Vous êtes développeur PHP, il est donc temps de montrer vos talents au travers d’un blog à vos couleurs\r\n\r\nLes livrables attendus :\r\n- Un lien vers l’ensemble du projet (fichiers PHP/HTML/JS/CSS…) sur un repository GitHub\r\n- Les instructions pour installer le projet (dans un fichier README à la racine du projet)\r\n- Les schémas UML (au format PNG ou JPG dans un dossier nommé “diagrammes” à la racine du projet)\r\n   - diagrammes de cas d’utilisation\r\n   - diagramme de classes\r\n   - diagrammes de séquence\r\n- Les issues sur le repository GitHub que vous aurez créé\r\n- Un lien vers la dernière analyse SymfonyInsight ou Codacy (ou vers le projet public sur la plateforme)', '2020-09-04 16:07:54', 1),
(2, 'Utilisation de GitHub', 'Dans le cadre de mon projet 5 chez OpenClassRooms j\'ai du me familiariser avec GitHub. Je l\'ai utiliser pour créer mon repository, créer mes issues, et travailler avec ds pullrequest afin d\'organiser au mieux mon projet. ', 'L\'utilisation de GitHub est un réel plus lorsque l\'on développe. Cela permet de gérer tout son code de façon très professionnelle. On peut travailler sur plusieurs branches  et appliquer la feature ou le fix une fois terminé et testé sur la branche Master (merge). \r\nLes issues permettent de segmenter le code d\'une application à réaliser et donc d\'organiser son développement. Une estimation en temps pour chaque segment est un réel plus car cela permet de se faire une idée  assez précise du temps que l\'on va mettre pour développer une application.\r\nChaque issue peut être rattachée à plusieurs pull request. En prenant soin d\'utiliser les #id des issues dans les commit, les pull request sont rattachées directement aux issues.\r\nde nombreux autres avantages sont encore à découvrir sur GitHub ... Je vous laisse jeter un coup d\'oeuil ...\r\n', '2020-09-15 11:27:01', 1),
(3, 't\'&quot;t\'t', '&quot;\'t&quot;\'t', '\'t&quot;\'t\'(y-uè-u', '2020-09-16 09:22:24', 2),
(5, 'HTML5 / CSS3', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable.', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.\r\n\r\nThere are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.', '2020-09-18 09:28:07', 1),
(6, 'Nouveau Post UML', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable.', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.\r\n\r\nThere are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.', '2020-09-18 09:28:38', 1),
(7, 'Framework Symfony 4', 'A la découverte de Symfony 4 - Symfony 5', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.\r\n\r\nThere are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.\r\n\r\nThere are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.', '2020-09-18 09:29:37', 1),
(8, 'Mon prermier', 'test', 'test ', '2020-09-18 11:14:26', 6);

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

DROP TABLE IF EXISTS `role`;
CREATE TABLE IF NOT EXISTS `role` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `description` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `role`
--

INSERT INTO `role` (`id`, `description`, `slug`) VALUES
(1, 'Administrator', 'admin'),
(2, 'Member', 'member'),
(3, 'Author', 'author');

-- --------------------------------------------------------

--
-- Structure de la table `role_user`
--

DROP TABLE IF EXISTS `role_user`;
CREATE TABLE IF NOT EXISTS `role_user` (
  `user_id` int(10) NOT NULL,
  `role_id` int(10) NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `role_user`
--

INSERT INTO `role_user` (`user_id`, `role_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(2, 2),
(3, 2),
(4, 2),
(4, 3),
(5, 2),
(6, 2),
(6, 3),
(7, 2),
(8, 2),
(9, 2);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `salutation` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `salutation`, `firstname`, `lastname`, `mail`, `password`, `enabled`) VALUES
(1, 'M.', 'Steeve', 'Sanchez', 'sanchez.steeve@gmail.com', '$2y$10$H/NE2d77F4D7Yjimy2qIJe.rMWIIXTrad9LQsJbOtWpASdYPNE7n6', 1),
(2, 'Mme', 'Laura', 'Neel', 'laura@test.fr', '$2y$10$rQ67JlSX6gmzpDSacLkj0O1YyspbXz.1E.MbBjTRSaqoLvB49y6tO', 1),
(3, 'M.', 'Marc', 'Dumond', 'marc@test.fr', '$2y$10$PpFhtCOP7I1z1GT/hIHnneYWeRdDulzB/k.PA1l7Gxs6W0vR67iui', 1),
(4, 'M.', 'Hicham', 'Lhachimi', 'l.chachimi@test.fr', '$2y$10$IHF3jeqHGr0Sj16osQvzpe8.wtEpWFAvg5iyTeXrvxSnO8KMB2IvG', 1),
(5, 'M.', 'tr', 'ueudfzeug', 'toto@test.fr', '$2y$10$MgKOGZOHR6uVZwJatg8gZOrDjVIhoiO9fKCXOHLkGsi47k.BuUaJW', 0),
(6, 'M.', 'Denis', 'Marchand', 'user1@test.fr', '$2y$10$g7lArbpBo0Xd9HxT9mCjnu2ntBkub4AcPvthgRdYItiWy7Ac1gdJq', 1),
(7, 'Mme', 'Isabelle', 'Dujardin', 'user2@test.fr', '$2y$10$XsQ.da2oRTTg5a8.Mmh4buP1LIEHSEyFMyTlUhDug44bKU/s1tGFe', 1),
(8, 'M.', 'Mohamed', 'Beckouche', 'author1@test.fr', '$2y$10$Is5H18QfcSkF5ZiBL2GNwuNSk1tpoSppeiF5VQXtJT.tKH7pkYX/O', 1),
(9, 'M.', 'test', 'test', 'test@test.fr', '$2y$10$hzoLnWSldxnyUBqf30F6..Z4FI/H50mUuw1YqU7hRnnTklkUaJ1Ta', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
