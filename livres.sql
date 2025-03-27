-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 27 mars 2025 à 14:02
-- Version du serveur : 8.3.0
-- Version de PHP : 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `livres`
--

-- --------------------------------------------------------

--
-- Structure de la table `books`
--

DROP TABLE IF EXISTS `books`;
CREATE TABLE IF NOT EXISTS `books` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `author` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `isbn` varchar(13) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `publisher` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `publish_date` date DEFAULT NULL,
  `rating` decimal(3,2) DEFAULT NULL,
  `image_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `isbn` (`isbn`)
) ENGINE=MyISAM AUTO_INCREMENT=119 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `books`
--

INSERT INTO `books` (`id`, `title`, `author`, `isbn`, `price`, `description`, `publisher`, `publish_date`, `rating`, `image_url`) VALUES
(26, 'Fahrenheit 451', 'Ray Bradbury', '9781451673319', 15.00, 'Dans un futur où les livres sont interdits, un pompier se révolte.', 'Ballantine Books', '1953-10-19', 2.00, 'https://fr.web.img6.acsta.net/pictures/18/05/04/16/47/5013189.jpg'),
(25, 'L\'Inconnu du Nord-Express', 'Patricia Highsmith', '9782253154620', 12.99, 'Un thriller sur un échange d\'assassinats entre deux inconnus.', 'Éditions de l\'Olivier', '1950-01-01', 3.00, 'https://fr.web.img5.acsta.net/medias/nmedia/18/35/34/70/18387371.jpg'),
(24, 'Les Misérables', 'Victor Hugo', '9780451419439', 14.99, 'L\'histoire de la lutte de Jean Valjean contre l\'injustice sociale.', 'A. Lacroix, Verboeckhoven & Cie', '1862-04-03', 2.00, 'https://fr.web.img5.acsta.net/medias/nmedia/18/91/00/76/20364091.jpg'),
(23, 'Le Gène égoïste', 'Richard Dawkins', '9780199291151', 18.00, 'Une exploration de l\'évolution selon la perspective du gène.', 'Oxford University Press', '1976-10-01', 3.16, 'https://m.media-amazon.com/images/I/71O1HTMoOEL.jpg'),
(22, 'Sapiens : Une brève histoire de l\'humanité', 'Yuval Noah Harari', '9780099590088', 22.50, 'L\'histoire de l\'humanité depuis l\'émergence des Homo sapiens.', 'Harvill Secker', '2011-01-01', 0.58, 'https://m.media-amazon.com/images/I/61SaNiLLX-L._AC_UF1000,1000_QL80_.jpg'),
(21, 'Les Origines du Totalitarisme', 'Hannah Arendt', '9782253122049', 25.00, 'Une analyse approfondie des régimes totalitaires du XXe siècle.', 'Fayard', '1951-09-01', 3.42, 'https://m.media-amazon.com/images/I/71tCCrQ-hqL._AC_UF1000,1000_QL80_.jpg'),
(20, 'L\'Art de la Guerre', 'Sun Tzu', '9782290339363', 10.00, 'Un traité stratégique sur la guerre et la tactique.', 'L\'Harmattan', '0000-00-00', 0.35, 'https://m.media-amazon.com/images/I/51Gh8ocJLAL._AC_UF1000,1000_QL80_.jpg'),
(19, 'Harry Potter à l\'école des sorciers', 'J.K. Rowling', '9780747532699', 18.00, 'Un jeune sorcier découvre son destin dans un monde magique.', 'Bloomsbury', '1997-06-26', 1.49, 'https://www.dvdfr.com/images/dvd/covers/200x280/5e4c71c50695ab456039e5d70c7bc14d/77105/3d-harry_potter_1_se_bis.0.jpg'),
(18, 'L\'Étranger', 'Albert Camus', '9782070360025', 8.49, 'Un homme indifférent à la vie et à la mort dans une société absurde.', 'Éditions Gallimard', '1942-02-01', 1.40, NULL),
(17, '1984', 'George Orwell', '9780451524935', 10.00, 'Dans une société totalitaire, Winston lutte contre la surveillance constante.', 'Secker & Warburg', '1949-06-08', 3.00, 'https://example.com/images/1984.jpg'),
(16, 'Le Parfum', 'Patrick Süskind', '9782253152343', 13.50, 'Un homme qui utilise des odeurs pour manipuler le monde autour de lui.', 'Éditions du Seuil', '1985-03-01', 3.43, NULL),
(100, 'To Kill a Mockingbird', 'Harper Lee', '9780061120084', 7.99, NULL, NULL, NULL, 4.56, 'https://m.media-amazon.com/images/I/71FxgtFKcQL._AC_UF1000,1000_QL80_.jpg'),
(15, 'La Peste', 'Albert Camus', '9782070377030', 9.99, 'Une ville confrontée à une épidémie mortelle et à l\'absurdité de la condition humaine.', 'Éditions Gallimard', '1947-06-10', 2.51, NULL),
(14, 'Moby Dick', 'Herman Melville', '9780142437247', 14.99, 'La quête obsessionnelle du capitaine Ahab pour capturer la baleine blanche.', 'Richard Bentley', '1851-10-18', 3.86, 'https://www.glenat.com/sites/default/files/images/livres/couv/9782749307145-T.jpg'),
(13, 'Don Quichotte', 'Miguel de Cervantes', '9780142437230', 10.50, 'Les aventures d\'un chevalier délirant et de son écuyer.', 'Francisco de Robles', '1605-01-16', 1.78, NULL),
(12, 'Le Comte de Monte-Cristo', 'Alexandre Dumas', '9782081423793', 12.50, 'L\'histoire d\'Edmond Dantès, victime d\'une trahison.', 'Furne', '1844-08-28', 2.32, NULL),
(11, 'L\'Alchimiste', 'Paulo Coelho', '9780061122415', 15.00, 'Un jeune berger poursuit son rêve en traversant le désert.', 'HarperOne', '1988-11-15', 1.26, NULL),
(10, 'Le Seigneur des Anneaux', 'J.R.R. Tolkien', '9780261102385', 25.00, 'Un récit épique de la lutte contre le mal.', 'Allen & Unwin', '1954-07-29', 4.32, 'https://example.com/images/lotr.jpg'),
(27, 'Le Procès', 'Franz Kafka', '9782070366621', 13.99, 'Un homme accusé sans raison et soumis à une procédure judiciaire absurde.', 'Schocken Books', '1925-06-01', 2.83, 'https://fr.web.img6.acsta.net/pictures/22/12/14/08/54/2821801.jpg'),
(28, 'La Bible', 'Collectif', '9782750902142', 19.00, 'Le texte sacré des chrétiens, comprenant l\'Ancien et le Nouveau Testament.', 'Le Cerf', '0000-00-00', 1.20, NULL),
(29, 'La Métamorphose', 'Franz Kafka', '9782070367437', 7.00, 'Un homme se transforme en insecte et fait face à l\'étrangeté de son existence.', 'Verlag Die Schmiede', '1915-12-01', 2.50, NULL),
(30, 'L\'Histoire de l\'Art', 'E.H. Gombrich', '9780714832470', 30.00, 'Une introduction complète à l\'histoire de l\'art, depuis la préhistoire jusqu\'à nos jours.', 'Phaidon Press', '1950-01-01', 3.92, 'https://www.lalibrairiedesecoles.com/wp-content/uploads/2014/05/9782385510312_CV_HARE_HD.jpg'),
(31, 'Le Drapeau', 'André Malraux', '9782070369653', 11.50, 'Un roman qui explore la guerre et la résistance durant la guerre civile espagnole.', 'Gallimard', '1943-10-01', 2.07, NULL),
(32, 'Le Nom de la Rose', 'Umberto Eco', '9782070723358', 17.00, 'Un mystère médiéval où un moine détective cherche à résoudre une série de meurtres.', 'Bompiani', '1980-11-01', 3.62, NULL),
(34, 'Middlesex', 'Jeffrey Eugenides', '9780349120850', 19.50, 'L\'histoire d\'un hermaphrodite à travers les générations de sa famille.', 'Farrar, Straus and Giroux', '2002-09-04', 3.44, NULL),
(35, 'Le Temps des secrets', 'Marcel Pagnol', '9782264032490', 10.99, 'L\'enfance de l\'auteur dans la Provence du début du XXe siècle.', 'Éditions Calmann-Lévy', '1959-01-01', 1.64, NULL),
(36, 'L\'Amant', 'Marguerite Duras', '9782253009530', 12.00, 'Un récit autobiographique de l\'amour interdit d\'une jeune fille en Indochine.', 'Éditions de Minuit', '1984-10-01', 2.89, 'https://media.hachette.fr/fit-in/780x1280/imgArticle/GRASSETFASQUELLE/2000/9782246458517-T.jpg?source=web'),
(37, 'L\'Homme qui rit', 'Victor Hugo', '9782253003101', 13.00, 'Un roman sur les souffrances d\'un homme défiguré par le destin.', 'A. Lacroix, Verboeckhoven & Cie', '1869-10-01', 4.51, NULL),
(38, 'La Tête contre les murs', 'Georges Simenon', '9782253012417', 9.99, 'Un homme emprisonné dans ses propres pensées et l\'enfermement de la folie.', 'Éditions Gallimard', '1938-09-01', 3.88, NULL),
(39, 'Autant en emporte le vent', 'Margaret Mitchell', '9782264057950', 15.99, 'Une histoire d\'amour épique et de survie pendant la guerre civile américaine.', 'Macmillan', '1936-06-30', 0.87, 'https://fr.web.img2.acsta.net/medias/00/01/99/000199_af.jpg'),
(40, 'L\'Assommoir', 'Émile Zola', '9782070366751', 11.50, 'Un roman naturaliste sur la misère de la classe ouvrière à Paris.', 'Ch. Delagrave', '1877-08-01', 2.73, NULL),
(41, 'Le Rouge et le Noir', 'Stendhal', '9780140440067', 12.99, 'Les aventures et l\'ascension sociale d\'un jeune homme ambitieux.', 'Fasquelle', '1830-11-01', 1.02, 'https://m.media-amazon.com/images/I/71eCRmiGMwL._AC_UF1000,1000_QL80_.jpg'),
(42, 'Les Souffrances du Jeune Werther', 'Johann Wolfgang von Goethe', '9780140443037', 9.00, 'Un jeune homme éperdument amoureux qui finit par se suicider.', 'Cotta', '1774-12-01', 1.93, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `order_id` int NOT NULL AUTO_INCREMENT,
  `client_name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `order_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `payment_status` enum('pending','completed') COLLATE utf8mb4_general_ci DEFAULT 'pending',
  `status` varchar(20) COLLATE utf8mb4_general_ci DEFAULT 'En attente',
  PRIMARY KEY (`order_id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `orders`
--

INSERT INTO `orders` (`order_id`, `client_name`, `total`, `order_date`, `payment_status`, `status`) VALUES
(1, 'Jean Dupont', 49.99, '2025-03-27 09:37:11', 'pending', 'Livré'),
(2, 'mathis', 100.50, '2025-03-26 23:00:00', 'pending', 'Livré'),
(3, 'mathis', 100.50, '2025-03-26 23:00:00', 'pending', 'Livré'),
(4, 'duv', 100.50, '2025-03-26 23:00:00', 'pending', 'Livré'),
(5, 'siu', 100.50, '2025-03-26 23:00:00', 'pending', 'Livré'),
(6, 'alex', 100.50, '2025-03-26 23:00:00', 'pending', 'Livré'),
(7, 'alexandre', 14.99, '2025-03-26 23:00:00', 'pending', 'En attente'),
(8, 'theo', 14.99, '2025-03-26 23:00:00', 'pending', 'En attente'),
(9, 'zino', 29.98, '2025-03-26 23:00:00', 'pending', 'En attente'),
(10, 'moi', 29.98, '2025-03-26 23:00:00', 'pending', 'En attente'),
(11, 'ici', 29.98, '2025-03-26 23:00:00', 'pending', 'En attente'),
(12, 'maumau', 12.99, '2025-03-26 23:00:00', 'pending', 'En attente'),
(13, 'cylian', 15.00, '2025-03-26 23:00:00', 'pending', 'En attente'),
(14, 'iii', 13.00, '2025-03-26 23:00:00', 'pending', 'En attente'),
(15, 'user1', 13.00, '2025-03-26 23:00:00', 'pending', 'Livré'),
(16, 'user1', 27.98, '2025-03-26 23:00:00', 'pending', 'Livré'),
(17, 'user1', 27.50, '2025-03-26 23:00:00', 'pending', 'Livré'),
(18, 'user1', 39.99, '2025-03-26 23:00:00', 'pending', 'Livré'),
(19, 'user1', 25.99, '2025-03-26 23:00:00', 'pending', 'En attente'),
(20, 'user1', 12.99, '2025-03-26 23:00:00', 'pending', 'En attente');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `role` enum('user','admin') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'user',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`) VALUES
(1, 'user1', 'u@u.fr', 'user1', 'user'),
(2, 'user2', 'user2@example.com', '$2y$10$uZGvv88WKhfAgyO3sb7h5.bAo1sTp4Ob8p3v6DdchUJtGJXa0dZiC', 'user'),
(3, 'admin', 'admin@example.com', 'adminpassword', 'admin'),
(4, 'mathis', 'm@m.fr', '$2y$10$SKDhfQePBNDMoO2BLgvS0uDLKLbqg22Rzj2r4sycklf6aSOiG02kW', 'user'),
(5, 'Titi', 't@t.fr', '$2y$10$s0co12YdgS9aMl9OBUasSuKru1lEZ2tOohuEN3OK9o7w/MXC7u.QO', 'admin'),
(6, 'Nath', 'n@n.fr', '$2y$10$cAhVW9n8ivie7MmYhVgF9uXJX50sv5xawRNotvItpqhZTvKN/ki4W', 'user');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
