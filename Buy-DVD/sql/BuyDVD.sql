-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le :  lun. 09 avr. 2018 à 19:46
-- Version du serveur :  5.6.35
-- Version de PHP :  7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `BuyDVD`
--

-- --------------------------------------------------------

--
-- Structure de la table `categorymoovie`
--

CREATE TABLE `categorymoovie` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `categorymoovie`
--

INSERT INTO `categorymoovie` (`id`, `name`, `image`) VALUES
(1, 'Comédie', 'bannierecommedie.jpg'),
(2, 'Romance', 'romancebanniere.jpg'),
(3, 'Policier/Drama', 'bannierepolice.jpg'),
(4, 'Action/Aventure', 'banniereaction.png'),
(5, 'Fantastique', 'bannierefantastique.png'),
(6, 'Dessin Animé', 'bannieredisney.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `categoryserie`
--

CREATE TABLE `categoryserie` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `categoryserie`
--

INSERT INTO `categoryserie` (`id`, `name`, `image`) VALUES
(1, 'Comédie', 'bannierecommedie.jpg'),
(2, 'Romance', 'romancebanniere.jpg'),
(3, 'Policier/Dramas', 'bannierepolice.jpg'),
(4, 'Action/Aventure', 'banniereaction.png'),
(5, 'Fantastique', 'bannierefantastique.png'),
(6, 'Dessin Animé', 'bannieredisney.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

CREATE TABLE `commentaire` (
  `id` int(11) NOT NULL,
  `speudo` varchar(255) NOT NULL,
  `objet` varchar(255) NOT NULL,
  `avis` text NOT NULL,
  `created_at` date NOT NULL,
  `is_published` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `commentaire`
--

INSERT INTO `commentaire` (`id`, `speudo`, `objet`, `avis`, `created_at`, `is_published`) VALUES
(1, 'Agathe', 'Très bon produit', 'Coffret de 10 étuis avec chacun 3 ou 4 DVD à l\'intérieur. 5 200 et quelques minutes de Friends à fond c\'est toop !! ', '2018-02-06', 1),
(2, 'Ferwann Grenoble', 'Génial !', 'Quand on ne connait absolument pas, on ne regrette pas du tout son achat ! On les aimes à la fin et on veut continuer de les suivre !', '2018-03-20', 1),
(3, 'Emilie', 'Super', 'Livraison dans les temps , colis soigné', '2018-03-04', 1),
(4, 'Virginie', 'super', 'j ai acheté ce dvd la semaine derniere j adore en +le prix etait en baisse', '2018-03-22', 1),
(5, 'Serge', 'super', 'je suis satisfait de cette achat', '2018-03-15', 1),
(6, 'Laxou', 'J\'ai adoré', 'Cette série m\'a happé et impossible de l\'oublier', '2018-03-05', 1),
(7, 'BRIGITTE', 'Super', 'Très satisfaite, bonne accueil', '2018-03-20', 1),
(8, 'Julie C', 'Nouvelle interprétation', 'Bien emballé et entrentenu. Le DVD est arrivé en bonne santé. La série est très bonne, cette version moderne de l\'histoire de Sherlock Holmes est délicieuse et legère.', '2018-03-07', 1),
(9, 'Tinemosco', 'intelligent...', 'Un atout : Lucy liu...Idée originale de faire de Watson une femme... quant à Sherlock le jeu de l\'acteur me fait penser un peu à lie to me... intrigues passionnantes, rapports complexes... tout pour capter l\'attention. bien vu.', '2018-03-21', 1),
(10, 'JDKSGN', 'histoire genial', 'je suis satisfait de mon achat', '2018-03-11', 1),
(22, 'Sonia', 'Top, Génial', 'Série top. Hâte que la saison 2 débarque en DVD afin de savoir ce qu\'il va arriver à Barry Allen', '2018-03-22', 1),
(29, 'Jodemetz', 'Etonnant', 'Je connais l\'ancienne série de Flash et j\'ai toujours un peu peur de ce que cela va donner. Mai je suis agréablement surprise et reprendre l\'ancien acteur de la 1ère série comme père du nouveau Flash !!! Chapeau !!!!!!! J\'adore.', '2018-03-22', 1),
(30, 'sabrina176', 'Epoustouflant', 'Une série époustouflante! Tout est réuni : suspense, humour, amitié... Vivement la saison 2', '2018-03-22', 1);

-- --------------------------------------------------------

--
-- Structure de la table `commentaire_produitserie`
--

CREATE TABLE `commentaire_produitserie` (
  `id` int(11) NOT NULL,
  `commentaire_id` int(11) NOT NULL,
  `dvd_serie_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `commentaire_produitserie`
--

INSERT INTO `commentaire_produitserie` (`id`, `commentaire_id`, `dvd_serie_id`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 3, 1),
(4, 4, 3),
(5, 5, 3),
(6, 6, 4),
(7, 7, 5),
(8, 8, 6),
(9, 9, 6),
(14, 29, 11),
(15, 22, 11),
(16, 30, 6),
(18, 32, 10);

-- --------------------------------------------------------

--
-- Structure de la table `dvdmoovie`
--

CREATE TABLE `dvdmoovie` (
  `id` int(11) NOT NULL,
  `is_published` tinyint(1) NOT NULL,
  `created_at` date NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `summary` longtext NOT NULL,
  `prix` text NOT NULL,
  `prix2` varchar(255) NOT NULL,
  `realisateur` text NOT NULL,
  `acteur` text NOT NULL,
  `language_subtitle` text NOT NULL,
  `content` text NOT NULL,
  `format` varchar(255) NOT NULL,
  `editeur` varchar(255) NOT NULL,
  `public` varchar(255) NOT NULL,
  `type_color` varchar(255) NOT NULL,
  `stereo` varchar(255) NOT NULL,
  `qualite` varchar(255) NOT NULL,
  `imageOne` varchar(255) NOT NULL,
  `imageTwo` varchar(255) NOT NULL,
  `imageThree` varchar(255) NOT NULL,
  `imageFoor` varchar(255) NOT NULL,
  `imageFive` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `dvdmoovie`
--

INSERT INTO `dvdmoovie` (`id`, `is_published`, `created_at`, `title`, `image`, `summary`, `prix`, `prix2`, `realisateur`, `acteur`, `language_subtitle`, `content`, `format`, `editeur`, `public`, `type_color`, `stereo`, `qualite`, `imageOne`, `imageTwo`, `imageThree`, `imageFoor`, `imageFive`) VALUES
(1, 1, '2018-09-24', 'Qu\'est-ce qu\'on a fait au bon Dieu ?', '213dda6d8b70872c77cfafe2a1c8abe8.png', 'Claude et Marie Verneuil, issus de la grande bourgeoisie catholique provinciale sont des parents plutôt \"vieille France\". Mais ils se sont toujours obligés à faire preuve d\'ouverture d\'esprit...Les pilules furent cependant bien difficiles à avaler quand leur première fille épousa un musulman, leur seconde un juif et leur troisième un chinois. Leurs espoirs de voir enfin l\'une d\'elles se marier à l\'église se cristallisent donc sur la cadette, qui, alléluia, vient de rencontrer un bon catholique.', '12€92\r\n', '3€', 'Philippe De Chauveron', 'Christian Clavier <br>\r\nChantal Lauby <br>\r\nAry Abittan <br>\r\nFrédéric Chau <br>\r\nMedi Sadoun <br>\r\nFrédérique Bel <br>\r\nNoom Diawara\r\nJulia Piaton', 'Français/Anglais', 'Contenue du dvd', 'DVD Zone 2', 'Warner Home Video', 'Tous public', 'color', 'stéreo', 'pal ', 'annime2.png', 'annime1.png', 'dragon.png', 'monstre.png', 'thor.png'),
(2, 1, '2017-08-09', 'À bras ouverts', 'annime2.png', 'Figure de la scène littéraire et médiatique française, Jean-Etienne Fougerole est un intellectuel humaniste marié à une riche héritière déconnectée des réalités. Alors que Fougerole fait la promotion dans un débat télévisé de son nouveau roman «A bras ouverts», invitant les plus aisés à accueillir chez eux les personnes dans le besoin, son opposant le met au défi d\'appliquer ce qu\'il préconise dans son ouvrage. Coincé et piqué au vif, Fougerole prend au mot son adversaire et accepte le challenge pour ne pas perdre la face. Mais dès le soir-même, on sonne à la porte de sa somptueuse maison de Marnes-la-coquette… Les convictions des Fougerole vont être mises à rude épreuve !', '10€', '8€', 'Philippe De Chauveron', 'Christian Clavier <br>\r\nAry Abittan <br>\r\nElsa Zylberstein <br>\r\nCyril Lecomte <br>\r\nMirela Nicolau <br>\r\nNanou Garcia <br>\r\nOscar Berthe', 'Français', 'Dvd du film (88min)', 'Blu Ray', 'Warner Home Video', 'Tous public', 'color', 'stereo ', 'pal', 'annime1.png', 'thor.png', 'dragon.png', 'ironman.png', 'monstre.png'),
(4, 1, '2017-12-26', 'Overdrive', 'overdrive.png', 'Les frères Andrew et Garrett Foster sont des pilotes d\'exception, mais aussi des voleurs d\'exception. Leur spécialité : voler les voitures les plus chères au monde. A Marseille, ils parviennent à dérober une sublime Bugatti 1937, joyau de l’exceptionnelle collection de Jacomo Morier, parrain de la Mafia locale.  Ce dernier décide alors d’utiliser leur talent à son profit contre son ennemi juré, Max Klemp. Mais s’ils acceptent de rentrer dans ce jeu, c’est qu’ils ont en réalité conçu un coup d’une audace inégalée.', '16€99', '13€30', 'Antonio Negret', 'Scott Eastwood <br>\r\nFreddie Thorp <br>\r\nAna De Armas <br>\r\nSimon Abkarian <br>\r\nClemens Schick <br>\r\nGaia Weiss <br>', 'Français/Anglais', 'Dvd du film (79min)', 'Blu Ray', 'TF1', 'Tous public', 'color', 'stereo', 'pal', 'ironman.png', 'thor.png', 'harrypotter.png', 'starwar.png', 'chasseurdesorcier.png'),
(5, 1, '2017-12-23', 'La Belle et la Bête', 'romance1.png', 'Fin du XVIIIè siècle, dans un petit village français. Belle, jeune fille rêveuse et passionnée de littérature, vit avec son père, un vieil inventeur farfelu. S\'étant perdu une nuit dans la fôret, ce dernier se réfugie au château de la Bête, qui le jette au cachot. Ne pouvant supporter de voir son père emprisonné, Belle accepte alors de prendre sa place, ignorant que sous le masque du monstre se cache un Prince Charmant tremblant d\'amour pour elle, mais victime d\'une terrible malédiction.', '15€', '8€', 'Bill Condon', 'Emma Watson <br>\r\nKevin Kline <br>\r\nLuke Evans <br>\r\nDan Stevens <br>\r\nAudra McDonald <br>\r\nEmma Thompson <br>\r\nEwan McGregor\r\nJosh Gad\r\nStanley Tucci', 'Anglais/Français', 'Dvd du film (129min)', 'DVD Zone 2', 'Walt Disney Records', 'Tous public', 'color', 'stereo', 'pal', 'romance1.png', 'annime2.png', 'annime1.png', 'annime.png', 'ironman.png'),
(6, 1, '2017-05-25', 'La La Land', 'romance2.png', 'Au cœur de Los Angeles, une actrice en devenir prénommée Mia sert des cafés entre deux auditions. \r\nDe son côté, Sebastian, passionné de jazz, joue du piano dans des clubs miteux pour assurer sa subsistance. \r\nTous deux sont bien loin de la vie rêvée à laquelle ils aspirent…\r\nLe destin va réunir ces doux rêveurs, mais leur coup de foudre résistera-t-il aux tentations, aux déceptions, et à la vie trépidante d’Hollywood ?', '10€', '6€59', 'Damien Chazelle', 'Ryan Gosling <br>\r\nEmma Stone <br>\r\nJohn Legend <br>\r\nJ.K. Simmons <br>\r\nRosemarie DeWitt <br>\r\nFinn Wittrock <br>\r\nCallie Hernandez <br>\r\nSonoya Mizuno', 'Français/Anglais', 'Dvd du film (128min)', 'DVD Zone 2', 'M6 Interactions', 'Tous public', 'color', 'stereo', 'pal', 'annime1.png', 'romance1.png', 'romance2.png', 'annime2.png', 'dragon.png'),
(7, 1, '2014-06-04', 'Sherlock Holmes', 'policier1.png', 'En 1891 à Londres, le brillant détective Sherlock Holmes (Robert Downey Jr) n\'a pas eu de mystère à se mettre sous la dent depuis trois mois et s\'ennuie prodigieusement, d\'autant que le Dr. Watson (Jude Law), son ami, médecin et compagnon d\'aventures, est sur le point de se ranger avec la belle Mary (Kelly Reilly). Alors que la mélancolie le guette, l\'affaire du très malfaisant Lord Blackwood (Mark Strong), assassin de jeunes filles et adepte de magie noire, revenu d\'entre les morts pour semer la terreur, va le remettre en selle. ', '5€95', '5€27', 'Guy Ritchie', 'Robert Downey Jr <br>\r\nJude Law\r\n', 'Français/Anglais', 'Dvd du film', 'Blu Ray', 'Wbs', 'Tous public', 'color', 'stereo', 'pal', 'policier2.png', 'overdrive.png', 'ironman.png', 'thor.png', 'policier1.png'),
(9, 1, '2014-06-04', 'Sherlock Holmes 2 : Jeu d\'ombres', 'policier2.png', 'Sherlock Holmes affronte le professeur Moriarty, son double maléfique, dans cette gigantesque partie d\'échecs aux multiples péripéties. Action, humour et grand spectacle figurent au menu de cette suite réussie des aventures du célèbre détective anglais, signée en 2012 par Guy Ritchie, réalisateur du précédent opus.', '10€', '6€', 'Guy Ritchie', 'Robert Downey Jr <br>\r\nJude Law', 'Français/Anglais', 'Dvd du film', 'Blu Ray', 'Wbs', 'Tous public', 'color', 'stéreo', 'pal', 'policier2.png', 'policier1.png', 'thor.png', 'ironman.png', 'dragon.png'),
(11, 1, '2008-09-20', 'Iron Man ', 'ironman.png', 'Tony Stark, inventeur de génie, vendeur d\'armes et playboy milliardaire, est kidnappé en Aghanistan. Forcé par ses ravisseurs de fabriquer une arme redoutable, il construit en secret une armure high-tech révolutionnaire qu\'il utilise pour s\'échapper. Comprenant la puissance de cette armure, il décide de l\'améliorer et de l\'utiliser pour faire régner la justice et protéger les innocents.', '10€', '', 'Jon Favreau', 'Robert Downey Jr <br>\r\nTerrence Howard <br>\r\nJeff Bridges <br>\r\nGwyneth Paltrow <br>\r\nLeslie Bibb <br>\r\nShaun Toub', 'Français/Anglais', 'Dvd du film', 'DVD Zone 2', 'Marvel', 'Tous public', 'color', 'stereo', 'pal', 'thor.png', 'starwar.png', 'chasseurdesorcier.png', 'overdrive.png', 'romance2.png'),
(12, 1, '2013-12-04', 'Thor', 'thor.png', 'Au royaume d’Asgard, Thor est un guerrier aussi puissant qu’arrogant dont les actes téméraires déclenchent une guerre ancestrale. Banni et envoyé sur Terre, par son père Odin, il est condamné à vivre parmi les humains. Mais lorsque les forces du mal de son royaume s’apprêtent à se déchaîner sur la Terre, Thor va apprendre à se comporter en véritable héros…', '10€', '7€', 'Kenneth Branagh', 'Chris Hemsworth <br>\r\nNatalie Portman <br> \r\nAnthony Hopkins <br>\r\nTom Hiddleston <br>\r\nKat Dennings <br>\r\nStellan Skarsgard <br>\r\nClark Gregg <br>\r\nIdris Elba', 'Français/Anglais', 'Dvd du film', 'dvd zone 2', 'Marvel', 'Tous public', 'color', 'stereo', 'pal', 'ironman.png', 'starwar.png', 'overdrive.png', 'harrypotter.png', 'dragon.png'),
(13, 1, '0000-00-00', 'Harry Potter ', 'harrypotter.png', 'Le pouvoir de Voldemort s\'étend. Celui-ci contrôle maintenant le Ministère de la Magie et Poudlard. Harry, Ron et Hermione décident de terminer le travail commencé par Dumbledore, et de retrouver les derniers Horcruxes pour vaincre le Seigneur des Ténèbres. Mais il reste bien peu d\'espoir aux trois sorciers, qui doivent réussir à tout prix.', '14€99', '', 'David Yates', 'Daniel Radcliffe <br>\r\nEmma Watson <br>\r\nRupert Grint <br>\r\nBonnie Wright <br>\r\nAlan Rickman <br>\r\nHelena Bonham Carter <br>\r\nRalph Fiennes <br>\r\nBill Nighy', 'Français/Anglais', 'Dvd du film', 'dvd zone 2', '', 'Tous public', 'color', 'stereo', 'pal', 'chasseurdesorcier.png', 'ironman.png', 'starwar.png', 'overdrive.png', 'thor.png'),
(14, 1, '2016-03-02', 'Le Dernier chasseur de sorcières', 'chasseurdesorcier.png', 'Notre monde actuel repose sur un pacte fragile régissant la paix entre humains et sorcières. Ces dernières sont autorisées à vivre secrètement parmi nous tant qu’elles n’ont pas recours à la magie noire. Kaulder, membre de la confrérie de la hache et de la croix qui garantit ce pacte, chasse les sorcières insoumises depuis plus de 800 ans. Mais lorsque l’un des membres de son groupe est assassiné, la guerre est sur le point d’éclater et de faire des rues de New York un véritable champ de bataille.', '10€', '4€09', 'Breck Eisner', 'Diesel <br>\r\nVin Diesel <br>\r\nLeslie <br>\r\nRose Leslie <br>\r\nWood <br>\r\nElijah Wood <br>\r\nOlafur Darri Olafsson <br>\r\nJoseph Gilgun <br>\r\nRena Owen <br>\r\nJulie Engelbrecht <br>\r\nMichael Caine', 'Français/Anglais', 'Dvd du film', 'DVD zone 2', 'M6 Vidéo', 'Tous public', 'color', 'stereo', 'pal', 'overdrive.png', 'harrypotter.png', 'thor.png', 'ironman.png', 'starwar.png'),
(15, 1, '2017-09-21', 'Chasseur de monstres', 'monstre.png', 'Les hommes et les monstres vivaient ensemble en paix jusqu\'au jour où ils se font chasser par les hommes. Lors d\'une guerre civile, les monstres n\'auront pour choix que de se réfugier chez les hommes... Pourraient-ils cohabiter à nouveau?\r\n', '17€', '4€49', 'Raman Hui\r\n', 'Boran Jing <br>\r\nWu Jiang <br>\r\nBaihe Bai\r\n', 'Français/Anglais', 'Dvd du film', 'DVD Zone 2', 'Factoris Films', 'Tous public', 'color', 'stereo', 'pal', 'dragon.png', 'monstre.png', 'annime.png', 'annime1.png', 'thor.png'),
(16, 1, '2014-11-05', 'Dragons 2', 'dragon.png', 'Tandis qu’Astrid, Rustik et le reste de la bande se défient durant des courses sportives de dragons devenues populaires sur l’île, notre duo désormais inséparable parcourt les cieux, à la découverte de territoires inconnus et de nouveaux mondes. Au cours de l’une de leurs aventures, ils découvrent une grotte secrète qui abrite des centaines de dragons sauvages, dont le mystérieux Dragon Rider. Les deux amis se retrouvent alors au centre d’une lutte visant à maintenir la paix. Harold et Krokmou vont se battre pour défendre leurs valeurs et préserver le destin des hommes et des dragons.', '10€', '0€90', 'Dean DeBlois <br>\r\nChris Sanders', 'Jay Baruchel <br>\r\nCate Blanchett <br>\r\nGerard Butler <br>\r\nCraig Ferguson', 'Français/Anglais', 'Dvd du film', 'DVD zone 2', 'Dream Catcher', 'Tous public', 'color', 'stereo', 'pal', 'monstre.png', 'dragon.png', 'annime.png', 'ironman.png', 'thor.png'),
(17, 1, '0000-00-00', 'Peter et Elliott le dragon', 'annime.png', 'Depuis de longues années, M. Meacham, un vieux sculpteur sur bois, régale les enfants du coin avec ses histoires sur un féroce dragon qui vivrait au plus profond de la forêt voisine. Pour sa fille Grace, garde forestière de son état, tout ceci n’est que contes à dormir debout… jusqu’au jour où elle fait connaissance avec Peter. Ce mystérieux petit garçon de 10 ans - qui dit n’avoir ni famille ni foyer - assure qu’il vit dans les bois avec un dragon géant baptisé Elliott. Et la description qu’il en fait correspond étonnamment à celui dont parle son père… Avec l’aide de la jeune Natalie - la fille de Jack, le propriétaire de la scierie -, Grace va tout mettre en oeuvre pour découvrir qui est vraiment Peter, d’où il vient, et percer le secret de son incroyable histoire…', '10€', '6€64', 'David Lowery', 'Bryce Dallas Howard <br>\r\nRobert Redford <br>\r\nOakes Fegley <br>\r\nOona Laurence <br>\r\nWes Bentley <br>\r\nKarl Urban <br>\r\nIsiah Jr. Whitlock <br>\r\nEsmée Myers', 'Français/Anglais', 'Dvd du film', 'DVD zone 2', 'Walt Disney Records', 'Tous public', 'color', 'stereo', 'pal', 'monstre.png', 'dragon.png', 'annime.png', 'thor.png', 'starwar.png');

-- --------------------------------------------------------

--
-- Structure de la table `dvdmoovie_category`
--

CREATE TABLE `dvdmoovie_category` (
  `id` int(11) NOT NULL,
  `dvdmoovie_id` int(11) NOT NULL,
  `categorymoovie_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `dvdmoovie_category`
--

INSERT INTO `dvdmoovie_category` (`id`, `dvdmoovie_id`, `categorymoovie_id`) VALUES
(2, 2, 1),
(3, 5, 2),
(4, 6, 2),
(5, 7, 3),
(6, 8, 3),
(7, 9, 3),
(8, 10, 4),
(9, 11, 4),
(10, 4, 4),
(11, 12, 5),
(12, 13, 5),
(13, 14, 5),
(14, 15, 6),
(15, 16, 6),
(16, 17, 6),
(17, 14, 4),
(18, 11, 5),
(19, 13, 4),
(20, 12, 4),
(21, 7, 4),
(22, 9, 4),
(30, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `dvdserie_category`
--

CREATE TABLE `dvdserie_category` (
  `id` int(11) NOT NULL,
  `dvd_serie_id` int(11) NOT NULL,
  `categoryserie_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `dvdserie_category`
--

INSERT INTO `dvdserie_category` (`id`, `dvd_serie_id`, `categoryserie_id`) VALUES
(2, 2, 1),
(3, 3, 2),
(5, 5, 3),
(6, 6, 3),
(7, 7, 3),
(8, 8, 3),
(9, 9, 4),
(10, 10, 4),
(11, 11, 4),
(12, 12, 4),
(15, 14, 5),
(16, 15, 5),
(17, 9, 5),
(18, 10, 5),
(19, 11, 5),
(20, 16, 6),
(21, 17, 6),
(22, 4, 2),
(23, 4, 3),
(24, 3, 5),
(25, 13, 3),
(26, 13, 5),
(28, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `dvd_serie`
--

CREATE TABLE `dvd_serie` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `summary` longtext NOT NULL,
  `prix` varchar(255) NOT NULL,
  `prix2` varchar(255) NOT NULL,
  `realisateur` text NOT NULL,
  `language_subtitle` varchar(255) NOT NULL,
  `acteur` text NOT NULL,
  `content` varchar(255) NOT NULL,
  `created_at` date NOT NULL,
  `is_published` tinyint(1) NOT NULL,
  `format` varchar(255) NOT NULL,
  `editeur` varchar(255) NOT NULL,
  `qualite` varchar(255) NOT NULL,
  `type_color` varchar(255) NOT NULL,
  `stereo` varchar(255) NOT NULL,
  `public` varchar(255) NOT NULL,
  `imageOne` varchar(255) NOT NULL,
  `imageTwo` varchar(255) NOT NULL,
  `imageThree` varchar(255) NOT NULL,
  `imageFoor` varchar(255) NOT NULL,
  `imageFive` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `dvd_serie`
--

INSERT INTO `dvd_serie` (`id`, `title`, `image`, `summary`, `prix`, `prix2`, `realisateur`, `language_subtitle`, `acteur`, `content`, `created_at`, `is_published`, `format`, `editeur`, `qualite`, `type_color`, `stereo`, `public`, `imageOne`, `imageTwo`, `imageThree`, `imageFoor`, `imageFive`) VALUES
(1, 'Friends : Saisons 1 à 10', 'friends1.png', 'Les péripéties de 6 jeunes newyorkais liés par une profonde amitié. Entre amour, travail, famille, ils partagent leurs bonheurs et leurs soucis au Central Perk, leur café favori...', '47€99', '17€69', 'Kevin S. Bright <br>\r\nMarta Kauffman <br>\r\nDavid Krane', 'Français, Anglais, Espagnol, Allemand, Japonais et Portugais. ', 'Jennifer Aniston <br>\r\nCourteney Cox <br>\r\nLisa Kudrow <br>\r\nMatthew Perry <br>\r\nMatt Le Blanc <br>\r\nDavid Schwimmer \r\n', 'L\'intégralité des épisodes des 10 Saisons.\r\n', '2006-02-08', 1, 'DVD Zone 2', '', 'Pal', 'Couleur ', 'Stéreo ', 'Tous public', 'friends1.jpg', 'friends2.jpg', 'friends3.jpg', 'friends4.jpg', 'friends5.jpg'),
(2, 'The Big Bang Theory : Saison 5', 'bigbang.png', 'Leonard et Sheldon pourraient vous dire tout ce que vous voudriez savoir à propos de la physique quantique. Mais ils seraient bien incapables de vous expliquer quoi que ce soit sur la vie \"réelle\", le quotidien ou les relations humaines... Mais tout va changer avec l\'arrivée de la superbe Penny, leur voisine. Ce petit bout de femme, actrice à ses heures et serveuse pour le beurre, va devenir leur professeur de vie !\r\n\r\n', '30€', '10€48', 'Chuck Lorre <br>\r\nBill Prady', 'Anglais/Français', 'Jim Parsons <br>\r\nJohnny Galecki <br>\r\nKaley Cuoco <br>\r\nSimon Helberg <br>\r\nKunal Nayyar <br>\r\nMelissa Rauch <br>\r\nMayim Bialik', 'L\'intégralité des 24 épisodes de la Saison 5.', '2013-06-19', 1, 'DVD Zone 2', 'Wbs', 'Pal', 'Couleur', 'Stéréo', 'Tous public', 'bigbang1.jpg', 'bigbang2.jpg', 'bigbang3.jpg', 'bigbang4.jpg', 'bigbang5.jpg'),
(3, 'Vampire Diarie : Saison 1', 'vampirediarie.png', 'Quatre mois après le tragique accident de voiture qui a tué leurs parents, Elena Gilbert, 17 ans, et son frère Jeremy, 15 ans, essaient encore de s\'adapter à cette nouvelle réalité. Belle et populaire, l\'adolescente poursuit ses études au Mystic Falls High en s\'efforçant de masquer son chagrin. Elena est immédiatement fascinée par Stefan et Damon Salvatore, deux frères que tout oppose. Elle ne tarde pas à découvrir qu\'ils sont en fait des vampires...\r\n\r\n', '29€99', '11€07', 'Kevin Williamson', 'Français/Anglais', 'Paul Wesley <br>\r\nIan Somerhalder <br>\r\nCandice King <br>\r\nNina Dobrev <br>\r\nKat Graham <br>\r\nSteven R. McQueen <br>\r\nZach Roerig <br>\r\nMatthew Davis <br>', 'Intégrale de la saison 1', '2010-08-31', 1, 'DVD Zone 2', 'Warner Bros', 'Pal', 'Couleur', 'Stéréo', 'Accord parental souhaité', 'vampire1.jpg', 'vampire2.jpg', 'vampire3.jpg', 'vampire4.jpg', 'vampire5.jpg'),
(4, 'Beauty and The Beast: Saison 1', 'beautyandthebeast.png', 'En 2003, la jeune Catherine et sa mère sont attaquées par un homme. Si Catherine parvient à avoir la vie sauve grâce à l\'aide d\'une créature étrange, sa mère meurt cette nuit-là. Neuf ans plus tard, elle est devenue détective et reste déterminée à retrouver le responsable. Lors d\'une enquête, elle suit la piste d\'un certain Vincent Keller, décédé en 2002 en Afghanistan. Elle découvre que ce dernier n\'est pas mort, qu\'il vit depuis 10 ans en totale réclusion et surtout le reconnaît comme celui lui ayant sauvé la vie. Il s\'avère que, sous l\'effet de la colère, Vincent se transforme en une bête enragée et incontrôlable. Catherine accepte de protéger son identité et son secret s\'il l\'aide à découvrir le meurtrier de sa mère. Tous deux entament alors une relation complexe et extrêmement dangereuse...', '25€', '15€', 'Jennifer Levin', 'Français/Anglais', 'Nina Lisandrello <br>\r\nAustin Basis <br>\r\nJay Ryan <br>\r\nKristin Kreuk', 'L\'intégrale de la saison 1', '2014-04-02', 1, 'DVD Zone 2', 'Paramount', 'Pal', 'couleur', 'stéréo', 'Tous publics', 'beauty1.jpg', 'beauty2.jpg', 'beauty3.jpg', 'beauty4.jpg', 'beauty5.jpg'),
(5, 'Scorpion: Saison 1', 'scorpion.png', 'Walter O\'Brien, surnommé \"Scorpion\", un homme possédant le 4ème Q.I. le plus élevé du monde, a recruté quelques-uns des plus grands génies de la planète pour fonder une société chargée de résoudre des crises urgentes et d\'ampleur considérable, de celles que même la CIA ne parvient pas à régler seule. Inadaptés socialement, ils apprennent ensemble à vivre en communauté, à dépasser leurs peurs, leurs phobies et à vaincre leur solitude...', '25€', '15€50', 'Nick Santora', 'Français/Anglais', 'Elyes Gabel <br> \r\nKatharine Mcphee <br>\r\nEddie Kaye Thomas <br>\r\nRobert Patrick <br>\r\nAri Stidham <br>\r\nJadyn Wong ', 'L\'intégrale de la saison 1', '2016-03-02', 1, 'DVD Zone 2', 'Cbs Video Non Musicale', 'Pal', 'couleur', 'stéreo', 'tous publics', 'scorpion1.jpg', 'scorpion2.jpg', 'scorpion3.jpg', 'scorpion4.jpg', 'scorpion5.jpg'),
(6, 'Elementary: Saison 1', 'elementary.png', 'Une version moderne des aventures de Sherlock Holmes dans le New York contemporain.Renvoyé de Londres en raison de son addiction à l\'alcool, Sherlock s\'installe à Manhattan où son richissime paternel l\'oblige à cohabiter avec son pire cauchemar : une personne sobre chargée de veiller sur lui. Ancienne chirurgienne promise à un bel avenir, Joan Watson a perdu un patient et sa licence trois ans plus tôt. Ce nouvel emploi est pour elle une nouvelle façon d\'aider les autres, et surtout une pénitence qu\'elle s\'impose. Quand Sherlock devient consultant pour la police new-yorkaise, Watson n\'a d\'autre choix que suivre son irascible \"client\" lors de ses investigations. Très vite, ils réalisent l\'un et l\'autre les avantages que peut leur apporter un tel partenariat.', '25€', '17€80', 'Robert Doherty', 'Français/Anglais', 'Jonny Lee Miller <br>\r\nLucy Liu <br>\r\nAidan Quinn\r\n', 'L\'intégrale de la saison 1 : 24 épisodes de 42 minutes.', '2014-04-02', 1, 'DVD Zone 2', 'Paramount\r\n', 'Pal', 'couleur', 'stéreo ', 'tous public', 'elementary1.jpg', 'elementary2.jpg', 'elementary3.jpg', 'elementary4.jpg', 'elementary5.jpg'),
(7, 'Ncis: Saison 6', 'ncis.png', 'À la tête de cette équipe du NCIS, qui opère en dehors de la chaîne de commandement militaire, l\'agent Special Leroy Jethro Gibbs (Mark Harmon), un enquêteur qualifié dont les qualités sont d\'être intelligent, solide et prêt à contourner les règles pour faire le travail. Travaillant sous les ordres de Gibbs, on retrouve l\'agent Anthony DiNozzo (Michael Weatherly), l\'agent Abby Sciuto (Pauley Perrette) et le Dr Donald \"Ducky\" Mallard (David McCallum). De meutre en espionnage anti-terrorisme et sous-marins volés, ces agents spéciaux parcourent la planète pour enquêter sur tous les crimes ayant un lien avec Marine ou le Corps de la Marine.', '28€99', '17€64', 'Donald P. Bellisario <br>\r\nDon McGill', 'Français/Anglais', 'Mark Harmon <br> \r\nSean Murray <br> \r\nEmily Wickersham <br> \r\nPauley Perrette <br> ', 'L\'intégrale de la saison 6 : ', '2010-06-30', 1, 'DVD Zone 2', 'Paramount', 'Pal', 'couleur', 'stéreo', 'tous public', 'ncis1.jpg', 'ncis2.jpg', 'ncis3.jpg', 'ncis4.jpg', 'ncis5.jpg'),
(8, 'Quantico: Saison 1', 'quantico2.png', 'De jeunes recrues du FBI se battent de toutes leurs forces sur le camp d\'entraînement de Quantico en Virginie, entre tests d\'endurance physique, cours de tir et maîtrise de l\'art de l\'enquête et de l\'interrogatoire. Ils ont 50% de chances d\'échouer, la compétition fait rage. 9 mois plus tard, l\'un d\'entre eux est suspecté d\'avoir commis la plus grosse attaque terroriste sur le sol Américain depuis le 11 Septembre 2001...', '30€', '14€33', 'Joshua Safran', 'Français/Anglais', 'Yasmine Elmasri <br> \r\nJake McLaughlin <br> \r\nPriyanka Chopra <br> \r\nJoshua Hopkins <br> \r\nJohanna Braddy <br> \r\nAunjanue Ellis <br> \r\nAnabelle Acosta <br> \r\nGraham Rogers <br> \r\nTate Ellington', 'L\'intégrale de la saison 1.', '2016-11-09', 1, 'DVD Zone 2', 'Abc S A R L', 'Pal ', 'couleur', 'stéreo', 'tous publics ', 'quantico1.jpg', 'quantico2.jpg', 'quantico3.jpg', 'quantico4.jpg', 'quantico5.jpg'),
(9, 'Arrow: Saison 3', 'arrow.png', 'Les nouvelles aventures de Green Arrow/Oliver Queen, combattant ultra efficace issu de l\'univers de DC Comics et surtout archer au talent fou, qui appartient notamment à la Justice League. Disparu en mer avec son père et sa petite amie, il est retrouvé vivant 5 ans plus tard sur une île près des côtes Chinoises. Mais il a changé : il est fort, courageux et déterminé à débarrasser Starling City de ses malfrats...', '25€', '11€90', 'Andrew Kreisberg', 'Français/Anglais', 'Stephen Amell <br> \r\nRick Gonzalez <br> \r\nJuliana Harkavy <br> \r\nKatie Cassidy <br>  \r\nWilla Holland <br> \r\nEmily Bett Rickards <br> \r\nColton Haynes <br> \r\nDavid Ramsey <br> \r\nSusanna Thompson <br> \r\nPaul Blackthorne', 'L\'intégrale de la saison 3.', '2015-12-02', 1, 'DVD Zone 2', 'Warner', 'pal', 'couleur', 'stéreo', 'tous public', 'arrow1.jpg', 'arrow2.jpg', 'arrow3.jpg', 'arrow4.jpg', 'arrow5.jpg'),
(10, 'DC Legend of Tommorrow: Saison 1', 'legend.png', 'Après avoir vu le futur, Rip Hunter, un Maître du temps du 22ème siècle, décide - contre l\'avis de son Conseil - de stopper le tyran immortel qui fera basculer le monde dans le chaos. Pour accomplir sa mission, il constitue une équipe d\'élite qui l\'aidera à traquer le méchant à travers le temps et arrêter sa montée au pouvoir. The A.T.O.M., Captain Cold, Heat Wave, White Canary, Firestorm, Hawkgirl et Hawkman saisissent cette opportunité de prendre en mains leur destinée. Parviendront-il à sauver l\'Humanité et marquer l\'Histoire en devenant les légendes de demain ?\r\n\r\n', '29€99', '21€90', 'Dermott Downs <br> \r\nMichael Grossman <br> \r\nKevin Tancharoen', 'Français/Anglais', 'Victor Garber <br> \r\nBrandon Routh <br> \r\nArthur Darvill <br> \r\nCaity Lotz <br> \r\n', 'L\'intégrale de la saison 1.', '2017-03-08', 1, 'DVD Zone 2', 'Warner Home Video', 'pal', 'couleur', 'stéreo ', 'Accord parental souhaité', 'legende1.jpg', 'flash4.png', 'legende3.jpg', 'legende4.jpg', 'legende5.jpg'),
(11, 'The Flash: Saison 1', 'theflash.png', 'Barry Allen est un jeune scientifique qui travaille pour la police de Central City. Témoin enfant du meurtre de sa mère par une entité mystérieuse, il croit aux phénomènes paranormaux et cherche le moyen de le prouver pour faire innocenter son père emprisonné. Touché par un éclair provoqué par l\'explosion de l\'accélérateur de particules dans les laboratoires de Harrison Wells, Barry va sombrer dans le coma pendant neuf mois. À son réveil, il découvre qu\'il peut courir à une vitesse surhumaine et peut guérir de façon accélérée. Il va réaliser par la suite qu\'il n\'est pas le seul à avoir obtenu des facultés extraordinaires et surhumaines.', '30€', '5€90', 'Greg Berlanti <br> \r\nAndrew Kreisberg', 'Français/Anglais', 'Grant Gustin <br> \r\nCandice Patton <br> \r\nRick Cosnett <br> \r\nDanielle Panabaker <br> \r\nTom Cavanagh', 'L\'intégrale de la saison 1.', '2015-11-10', 1, 'DVD Zone 2', 'Warner Home Video', 'pal', 'couleur', 'stéreo', 'tous publics', 'flash1.jpg', 'flash2.jpg', 'flash4.png', 'arrow2.jpg', 'flash5.jpg'),
(12, 'The Musketeers: Saison 1', 'musketeers.png', 'Dans la France du XVIIe siècle, les aventures d\'Athos, Porthos, Aramis et d\'Artagnan, quatre frères mousquetaires du Roi, sous les ordres du capitaine Tréville, déjouent les complots organisés par le cardinal de Richelieu, le comte de Rochefort et la mystérieuse Milady de Winter...Inspirée du roman éponyme d\'Alexandre Dumas.\r\n\r\n', '14€69', '9€19', 'Adrian Hodges', 'Français/Anglais', 'Luke Pasqualino <br> \r\nHoward Charles <br> \r\nSantiago Cabrera <br> \r\nTom Burke <br> \r\nPeter Capaldi', 'L\'intégrale de la saison 1.', '2015-07-11', 1, 'DVD Zone 2', 'France Télévisions Distribution', 'pal', 'couleur', 'stéreo', 'tous public ', 'musketeer1.jpg', 'musketeer2.jpg', 'musketeer3.jpg', 'musketeer4.jpg', 'musketeer5.jpg'),
(13, 'Sleepy Hollow: Saison 1', 'sleepyhollow.png', 'Ichabod Crane se réveille après un sommeil de près de deux siècles et demi. Il a traversé le temps avec un mystère qui date de l\'époque des Pères Fondateurs de l\'Amérique. Coincé à notre époque contemporaine, où la technologie a pris place et les moeurs ont évolué, celui-ci trouve une alliée inattendue en la personne d\'Abbie Mills, lieutenant de police à Sleepy Hollow. Tous les deux ont un rôle à jouer dans les évènements qui se préparent, et une apocalypse à éviter.', '19€26', '3€40', 'Alex Kurtzman', 'Français/Anglais', 'Tom Mison <br> \r\nNicole Beharie <br> \r\nOrlando Jones <br> \r\nJohn Noble', 'L\'intégrale de la saison 1.', '2014-11-05', 1, 'DVD Zone 2', 'France Télévisions Distribution', 'pal', 'couleur', 'stéreo', 'Accord parental souhaité', 'hollow1.jpg', 'hollow2.jpg', 'hollow3.jpg', 'hollow4.jpg', 'hollow5.jpg'),
(14, 'The Magicians : saison 1', 'magician.png', 'Bientôt diplômé, Quentin Coldwater a du mal à se projeter dans son avenir en laissant de côté la magie qui le passionne depuis sa tendre enfance. A sa grande surprise, le jeune homme est admis à Brakebills, une école secrète qui forme les futurs magiciens. Il y fait la connaissance d\'Alice, Penny, Margo et Eliot , avec lesquels il entretient des relations tantôt complices et souvent conflictuelles. Ensemble, ils vont pourtant devoir faire face à de grands dangers, des forces maléfiques venus de contrées insoupçonnées. Pendant ce temps, Julia, la meilleure amie de Quentin, qui a échoué aux tests d\'admission de Brakebills, suit son propre chemin. Un chemin obscur et dangereux qui pourait la mener à sa perte...\r\n', '25€', '19€', 'Sera Gamble <br> \r\nJohn McNamara\r\n', 'Français/Anglais', 'Stella Maeve <br> \r\nJason Ralph <br> \r\nOlivia Taylor Dudley <br> \r\nHale Appleman <br> \r\nArjun Gupta <br> \r\nSummer Bishil', 'L\'intégrale de la saison 1.', '2017-01-03', 1, 'DVD Zone 2', 'Universal', 'pal', 'couleur', 'stéreo', 'Accord parental souhaité', 'magisian1.jpg', 'hollow2.jpg', 'hollow1.jpg', 'beauty1.jpg', 'beauty5.jpg'),
(15, 'The Originals: Saison 1', 'originals.png', 'Le vampire originel Klaus fait son retour au Vieux Carré, un quartier français de la Nouvelle Orléans. Dans cette ville qu’il a aidé à construire quelques siècles plus tôt, il y retrouve son ancien protégé, le diabolique et charismatique Marcel. Dans l’espoir d’aider son jeune frère à trouver la rédemption, Elijah est contraint de s’allier avec des ennemis de Marcel...Spin-off de Vampire Diaries centré autour du personnage de Klaus.', '20€90', '5€50', 'Chris Grismer <br> \r\nBrad Turner <br> \r\nJesse Warn <br> \r\nMichael A. Allowitz', 'Français/Anglais', 'Joseph Morgan <br> \r\nDaniel Gillies <br> \r\nPhoebe Tonkin <br> \r\nLeah Pipes <br> \r\nDanielle Campbell', 'L\'intégrale de la saison 1.', '2015-04-08', 1, 'DVD Zone 2', 'Warner Home Video', 'pal', 'couleur', 'stéreo', 'Accord parental souhaité', 'originols1.jpg', 'originols2.jpg', 'originols3.jpg', 'originols4.jpg', 'originols5.jpg'),
(16, 'Scooby Doo: Mystères associés: Saison 2', 'scoobydoo.png', 'Dans la petite ville de Crystal Cove, Fred, Véra, Daphné, Sammy et Scooby-Doo forment un groupe de détectives chargés de résoudre les plus grands mystères de la ville plus hantée de la terre. Le mystérieux Mr. E égrène de nombreux indices sur les énigmes que cachent les lieux que les cinq amis se font un malin plaisir de découvrir.', '19€99', '17€34', 'Brandon Vietti', 'Français et Anglais', 'Genre Animation', 'Intégrale de la Saison 2', '2013-10-02', 1, 'DVD Zone 2', 'Wbs', 'pal', 'couleur', 'stéreo', 'tous public ', 'annime1.jpg', 'annime2.jpg', 'annime3.jpg', 'annime4.jpg', 'annime5.jpg'),
(17, 'Dragons : Cavaliers de Beurk', 'dragons.png', 'Solitaire mais très intelligent, Harold est un jeune viking mais pas n\'importe lequel : il est le premier à avoir apprivoisé un dragon. Avec l\'aide de ses amis Astrid, Stoïc, Rustic, Varek et les autres, il a pour but de maintenir l\'alliance entre les dragons et les vikings.\r\n\r\n', '19€99', '25€', 'Dean DeBlois', 'Français/Anglais', 'Genre annimation', 'Les 20 épisodes de la Saison 1\r\n- Les dragons de la 1ère partie -L\'évolution de Mille-Tonnerre\r\n- Dragons version \"Heavy Metal\" - Les Dragons de la 2ème partie\r\n- L\'évolution de Murmure Mortel', '2014-06-11', 1, 'DVD Zone 2', 'Dreamworks', 'pal', 'couleur', 'stéreo', 'tous public', 'annime1.jpg', 'annime2.jpg', 'annime3.jpg', 'annime4.jpg', 'annime5.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `is_admin` tinyint(4) DEFAULT NULL,
  `lastname` varchar(100) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `image`, `is_admin`, `lastname`, `firstname`, `email`, `password`) VALUES
(41, 'user.jpg', 1, 'Admin', 'Laure', 'Admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3'),
(42, 'paysage.jpg', 0, 'PasAdmin', 'User', 'PasAdmin@gmail.com', 'ae4e268a31b839566f62b259fb3fd9bc');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categorymoovie`
--
ALTER TABLE `categorymoovie`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `categoryserie`
--
ALTER TABLE `categoryserie`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `commentaire_produitserie`
--
ALTER TABLE `commentaire_produitserie`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `dvdmoovie`
--
ALTER TABLE `dvdmoovie`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `dvdmoovie_category`
--
ALTER TABLE `dvdmoovie_category`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `dvdserie_category`
--
ALTER TABLE `dvdserie_category`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `dvd_serie`
--
ALTER TABLE `dvd_serie`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categorymoovie`
--
ALTER TABLE `categorymoovie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `categoryserie`
--
ALTER TABLE `categoryserie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `commentaire`
--
ALTER TABLE `commentaire`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT pour la table `commentaire_produitserie`
--
ALTER TABLE `commentaire_produitserie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT pour la table `dvdmoovie`
--
ALTER TABLE `dvdmoovie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT pour la table `dvdmoovie_category`
--
ALTER TABLE `dvdmoovie_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT pour la table `dvdserie_category`
--
ALTER TABLE `dvdserie_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT pour la table `dvd_serie`
--
ALTER TABLE `dvd_serie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
