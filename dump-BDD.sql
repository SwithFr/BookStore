# ************************************************************
# Sequel Pro SQL dump
# Version 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Hôte: 127.0.0.1 (MySQL 5.6.21)
# Base de données: library
# Temps de génération: 2015-06-07 16:25:06 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Affichage de la table author_book
# ------------------------------------------------------------

DROP TABLE IF EXISTS `author_book`;

CREATE TABLE `author_book` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `author_id` int(10) NOT NULL,
  `book_id` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `author_book` WRITE;
/*!40000 ALTER TABLE `author_book` DISABLE KEYS */;

INSERT INTO `author_book` (`id`, `author_id`, `book_id`)
VALUES
	(1,16,1),
	(2,16,2),
	(3,19,3),
	(4,19,4),
	(5,19,5),
	(6,13,6);

/*!40000 ALTER TABLE `author_book` ENABLE KEYS */;
UNLOCK TABLES;


# Affichage de la table authors
# ------------------------------------------------------------

DROP TABLE IF EXISTS `authors`;

CREATE TABLE `authors` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL DEFAULT '',
  `last_name` varchar(50) NOT NULL DEFAULT '',
  `img` varchar(255) NOT NULL DEFAULT '',
  `date_birth` date NOT NULL,
  `date_death` date NOT NULL,
  `bio` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `vote` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `authors` WRITE;
/*!40000 ALTER TABLE `authors` DISABLE KEYS */;

INSERT INTO `authors` (`id`, `first_name`, `last_name`, `img`, `date_birth`, `date_death`, `bio`, `created_at`, `updated_at`, `vote`, `user_id`)
VALUES
	(1,'Guillaume','Apollinaire','./assets/img/uploads/authors/1426084379.jpg','1880-08-25','1918-11-09','Né Wilhelm Albert Włodzimierz Aleksander Apolinary Kostrowicki, herb. Wąż. Apollinaire est en réalité — jusqu\'à sa naturalisation en 1916 — le 5e prénom de Guillaume Albert Vladimir Alexandre Apollinaire de Kostrowitzky) est un poète et écrivain français, né sujet polonais de l\'Empire russe. D\'après sa fiche militaire, il est né le 25 août 1880 à Rome et mort pour la France le 9 novembre 1918 à Paris.\r\n\r\nIl est considéré comme l\'un des poètes français les plus importants du début du xxe siècle, auteur de poèmes tels que Zone, La Chanson du mal-aimé, Mai ou encore, ayant fait l\'objet de plusieurs adaptations en chanson au cours du siècle, Le Pont Mirabeau. Son œuvre érotique (dont principalement un roman et de nombreux poèmes) est également passée à la postérité. Il expérimenta un temps la pratique du calligramme (terme de son invention, quoiqu\'il ne soit pas l\'inventeur du genre lui-même, désignant des poèmes écrits en forme de dessins et non de forme classique en vers et strophes). Il fut le chantre de nombreuses avant-gardes artistiques de son temps, notamment du cubisme à la gestation duquel il participa, et poète et théoricien de l\'Esprit nouveau, et sans doute un précurseur majeur du surréalisme dont il a forgé le nom.','2015-05-09 17:32:08','0000-00-00 00:00:00',5,1),
	(2,'Leonid','Andreïev','./assets/img/uploads/authors/1426084704.jpg','1871-08-09','1919-09-12','Très tôt orphelin de père, il devient avocat pour subvenir aux besoins de sa famille. « Trompé » par un de ses clients, il arrête de plaider et se tourne vers la chronique judiciaire (chroniqueur au Messager moscovite à partir de 1897).\r\n\r\nIl se met dès lors à écrire des nouvelles et des pièces de théâtre. Il est lu et joué, connaît le succès, puis sombre dans l’oubli et meurt en 1919 en Finlande près de Terijoki des suites d’un suicide raté quelques années auparavant. Il est enterré au cimetière Volkovo de Saint-Pétersbourg. Leonid Andreïev était également photographe.\r\n\r\nLes œuvres de Leonid Andreïev ont mis beaucoup de temps à nous parvenir, très longtemps cachées dans les archives de l’ex-Union soviétique. On doit leur arrivée en France à Laurent Terzieff qui monta la pièce La Pensée, tirée de la nouvelle éponyme, en 1962, mais ses albums de photographies sont régulièrement réédités.','2015-05-15 21:38:51','0000-00-00 00:00:00',0,1),
	(3,'Achim von','Arnim','./assets/img/uploads/authors/1426085190.jpg','1781-01-26','1831-01-21','Achim von Arnim, né Ludwig Joachim von Arnim le 26 janvier 1781 à Berlin et mort le 21 janvier 1831 à Wiepersdorf près de Jüterbog est un romancier, chroniqueur, dramaturge et poète romantique allemand qui fit partie du Cénacle romantique d\'Heidelberg avec Görres, Creuzer et Clemens Brentano.\r\nAchim von Arnim est issu d\'une famille ancienne de la noblesse prussienne, les Arnim. Il passe son enfance et son adolescence à Berlin et à Zernikow. Il étudie le droit et les sciences naturelles à Halle et Göttingen de 1798 à 1801.\r\nIl commence à écrire dans des journaux de sciences naturelles, puis entreprend un voyage d\'études à travers l\'Europe, jusqu\'en 1804.\r\n\r\nAvec Clemens Brentano, dont il devient l\'ami et le beau-frère par son mariage avec Bettina Brentano il publie Des Knaben Wunderhorn, un recueil de chants populaires (Volkslieder) en trois tomes entre 1806 et 1808. Cette même année, il fonde le journal romantique Zeitung für Einsiedler (« Journal des ermites ») à Heidelberg.\r\n\r\nDe retour à Berlin en 1809, Achim von Arnim collabore aux Berliner Abendblätter (« Feuilles berlinoises du soir ») et crée, le 18 janvier 1810, une formation politique qu\'il appelle Deutsche Tischgesellschaft (« Salon allemand »).\r\n\r\nD\'octobre 1813 à février 1814, il est éditeur du quotidien berlinois Der Preußische Correspondent (« Le Correspondant prussien »). À partir de 1814, Achim von Arnim vit dans sa propriété à Wiepersdorf et contribue à la vie littéraire berlinoise par la production de nombreux articles et nouvelles que publient journaux et almanachs.','2015-05-09 16:29:51','0000-00-00 00:00:00',0,1),
	(4,'Honoré de','Balzac','./assets/img/uploads/authors/1426085504.jpg','1799-05-20','1850-08-18','Honoré de Balzac, né Honoré Balzac à Tours le 20 mai 1799 (1er prairial an VII du calendrier républicain), et mort à Paris le 18 août 1850 (à 51 ans), est un écrivain français. Romancier, dramaturge, critique littéraire, critique d\'art, essayiste, journaliste et imprimeur, il a laissé l\'une des plus imposantes œuvres romanesques de la littérature française, avec plus de quatre-vingt-dix romans et nouvelles parus de 1829 à 1855, réunis sous le titre La Comédie humaine. À cela s\'ajoutent Les Cent Contes drolatiques, ainsi que des romans de jeunesse publiés sous des pseudonymes et quelque vingt-cinq œuvres ébauchées.\r\n\r\nIl est un maître du roman français, dont il a abordé plusieurs genres, du roman philosophique avec Le Chef-d\'œuvre inconnu au roman fantastique avec La Peau de chagrin ou encore au roman poétique avec Le Lys dans la vallée. Il a surtout excellé dans la veine du réalisme, avec notamment Le Père Goriot et Eugénie Grandet, mais il s\'agit d\'un réalisme visionnaire, que transcende la puissance de son imagination créatrice.\r\n\r\nComme il l\'explique dans son Avant-Propos à La Comédie humaine, il a pour projet d\'identifier les « Espèces sociales » de son époque, tout comme Buffon avait identifié les espèces zoologiques. Ayant découvert par ses lectures de Walter Scott que le roman pouvait atteindre à une « valeur philosophique », il veut explorer les différentes classes sociales et les individus qui les composent, afin « d\'écrire l’histoire oubliée par tant d’historiens, celle des mœurs » et « faire concurrence à l\'état civil ».\r\n\r\nL\'auteur décrit la montée du capitalisme et l\'absorption par la bourgeoisie d\'une noblesse incapable de s\'adapter aux réalités nouvelles. Intéressé par les êtres qui ont un destin, il crée des personnages plus grands que nature, au point qu\'on a pu dire que, dans ses romans, « chacun, même les portières, a du génie ».','2015-05-09 16:29:52','0000-00-00 00:00:00',0,1),
	(5,'Léon','Bloy','./assets/img/uploads/authors/1426085683.jpg','1846-07-11','1917-11-03','Il est le deuxième des sept garçons de Jean-Baptiste Bloy, fonctionnaire aux Ponts et Chaussées et franc-maçon, et d\'Anne-Marie Carreau, une ardente catholique.\r\n\r\nSes études au lycée de Périgueux sont médiocres : retiré de l\'établissement en classe de quatrième, il continue sa formation sous la direction de son père, qui l\'oriente vers l\'architecture. Bloy commence à rédiger un journal intime, s\'essaie à la littérature en composant une tragédie, Lucrèce, et s\'éloigne de la religion. En 1864, son père lui trouve un emploi à Paris, il entre comme commis au bureau de l\'architecte principal de la Compagnie ferroviaire d\'Orléans. Médiocre employé, Bloy rêve de devenir peintre et s\'inscrit à l\'École des beaux-arts. Il écrit ses premiers articles, sans toutefois parvenir à les faire publier, et fréquente les milieux du socialisme révolutionnaire et de l\'anticléricalisme.','2015-05-09 16:29:53','0000-00-00 00:00:00',0,1),
	(6,'Tim','Burton','./assets/img/uploads/authors/1426085897.jpg','1958-08-25','0000-00-00','Timothy Walter Burton, dit Tim Burton, est un réalisateur, scénariste et producteur américain né le 25 août 1958 à Burbank en Californie. Maître du fantastique influencé par Edgar Allan Poe, excellent conteur et graphiste d\'exception, il a notamment signé la mise en scène de Beetlejuice, Batman, Edward aux mains d’argent, Batman : Le Défi, Ed Wood, Sleepy Hollow, Big Fish, Charlie et la Chocolaterie, Sweeney Todd : Le Diabolique Barbier de Fleet Street, Alice au pays des merveilles (sa plus grande réussite commerciale et un des succès commerciaux majeurs de l\'histoire du cinéma) ainsi que Dark Shadows. Ses acteurs fétiches sont Johnny Depp, qu\'il a dirigé à huit reprises, et Helena Bonham Carter, son ex-compagne et mère de ses deux enfants avec qui il vit à Belsize Park, un quartier de Londres.\r\n\r\nTim Burton a également produit et rédigé le scénario de L\'Étrange Noël de monsieur Jack, réalisé par Henry Selick puis financé et coréalisé Les Noces funèbres et enfin coécrit, produit et mis en scène Frankenweenie, trois films d’animation utilisant la technique du stop motion et des marionnettes qui évoluent dans des décors réels. Son cinéma se caractérise par un défilé de monstres et de créatures et un mélange d\'humour noir, d\'ironie et de macabre. Restant fidèle à son style, le cinéaste explore plusieurs genres qu\'il enchevêtre par moments : film d\'épouvante, drame intimiste, conte, mélodrame, biographie filmée, film de science-fiction, comédie, film d\'époque, comédie musicale ou encore film d\'action. Ses histoires mettent généralement en scène des personnages marginaux ou des êtres hors-normes, confrontés à la méchanceté du monde réel. On y décèle une grande influence du cinéma fantastique, du cinéma expressionniste allemand ainsi que des films de la Hammer Productions, à la fois pastichés et célébrés.\r\n\r\nTim Burton fait partie des cinéastes qui parviennent à concilier succès critique et commercial. Il a été décoré de l\'insigne de chevalier et d\'officier de l\'ordre national des Arts et des Lettres par Frédéric Mitterrand en mars 2010 et fut le président du jury du 63e Festival de Cannes. Le MoMA de New York et la Cinémathèque française à Paris ont consacré une grande exposition à son œuvre plastique et cinématographique, respectivement en 2009 et 2012. Tim Burton a également été le sujet de plusieurs biographies illustrées, notamment Tim Burton d\'Antoine de Baecque (2006) et Burton par Burton de Mark Salisbury (1999).','2015-05-09 16:29:54','0000-00-00 00:00:00',0,2),
	(7,'Charles','Dickens','./assets/img/uploads/authors/1426086120.jpg','1812-02-07','1870-06-09','Né à Landport, près de Portsmouth, dans le Hampshire, le 7 février 1812 et mort à Gad\'s Hill Place, Higham, Kent, le 9 juin 1870 (à 58 ans), est considéré comme le plus grand romancier de l\'époque victorienne. Dès ses premiers écrits, il est devenu immensément célèbre, sa popularité ne cessant de croître au fil de ses publications.\r\n\r\nL\'expérience marquante de son enfance, que certains considèrent comme la clef de son génie, a été, peu avant l\'incarcération de son père pour dettes à la Marshalsea, son embauche à douze ans chez Warren où il a collé des étiquettes sur des bouteilles de cirage pendant plus d\'une année. Bien qu\'il soit retourné presque trois ans à l\'école, son éducation est restée sommaire et sa grande culture est essentiellement due à ses efforts personnels.\r\n\r\nIl a fondé et publié plusieurs hebdomadaires, composé quinze romans majeurs, cinq livres de moindre envergure (novellas en anglais), des centaines de nouvelles et d\'articles portant sur des sujets littéraires ou de société. Sa passion pour le théâtre l\'a poussé à écrire et mettre en scène des pièces, jouer la comédie et faire des lectures publiques de ses œuvres qui, lors de tournées souvent harassantes, sont vite devenues extrêmement populaires en Grande-Bretagne et aux États-Unis.\r\n\r\nCharles Dickens a été un infatigable défenseur du droit des enfants, de l\'éducation pour tous, de la condition féminine et de nombreuses autres causes, dont celle des prostituées.\r\n\r\nIl est apprécié pour son humour, sa satire des mœurs et des caractères. Ses œuvres ont presque toutes été publiées en feuilletons hebdomadaires ou mensuels, genre inauguré par lui-même en 1836 : ce format est contraignant mais il permet de réagir rapidement, quitte à modifier l\'action et les personnages en cours de route. Les intrigues sont soignées et s\'enrichissent souvent d\'événements contemporains, même si l\'histoire se déroule antérieurement.\r\n\r\nUn chant de Noël (1843) a connu le plus vaste retentissement international, et l\'ensemble de son œuvre a été loué par des écrivains de renom, comme William Makepeace Thackeray, Léon Tolstoï, Gilbert Keith Chesterton ou George Orwell, pour son réalisme, son esprit comique, son art de la caractérisation et l\'acuité de sa satire. Certains, cependant, comme Charlotte Brontë, Virginia Woolf, Oscar Wilde ou Henry James, lui ont reproché de manquer de régularité dans le style, de privilégier la veine sentimentale et de se contenter d\'analyses psychologiques superficielles.\r\n\r\nDickens a été traduit en de nombreuses langues, avec son aval pour les premières versions françaises. Son œuvre, constamment rééditée, connaît toujours de nombreuses adaptations au théâtre, au cinéma, au music-hall, à la radio et à la télévision.','2015-05-09 16:29:55','0000-00-00 00:00:00',0,2),
	(8,'Théophile','Gautier','./assets/img/uploads/authors/1426086212.jpg','1811-08-30','1872-10-23','Né à Tarbes, Théophile Gautier est cependant parisien depuis sa plus jeune enfance. Il fait la connaissance du futur Nerval au Collège Charlemagne et s\'intéresse très jeune à la poésie. En 1829 il rencontre Victor Hugo qu\'il reconnaît pour son maître et participe activement au mouvement romantique comme lors de la fameuse bataille d\'Hernani, le 25 février 1830. Il évoquera avec humour cette période en 1833 dans Les Jeunes-France.\r\n\r\nIl publie en 1831-1832 ses premières poésies qui passent inaperçues mais il se distingue de ses amis romantiques par ses préoccupations formalistes fustigeant les visions moralistes ou utilitaires de la littérature dans la célèbre préface à son roman épistolaire Mademoiselle de Maupin (1835). Il écrit aussi ses premières nouvelles comme La Cafetière (1831), dans une veine fantastique qu\'il approfondira dans d\'autres œuvres (Le Roman de la momie, 1858).\r\n\r\nEn 1836, à la demande de Balzac, il donne des nouvelles et des critiques d\'art au journal La Chronique de Paris. Il collabore ensuite intensément à d\'autres journaux, en particulier La Presse d\'Émile de Girardin : certains de ces textes seront regroupés plus tard en volumes (Les Grotesques, Souvenirs littéraires…). Il publie aussi des poèmes (La Comédie de la Mort, 1838) et s\'essaie au théâtre (Une larme du diable, 1839). En mai 1845, il accomplit un grand voyage au-delà des Pyrénées dont il rapporte un carnet d\'impressions (Voyage en Espagne) et de nouveaux poèmes (España, 1845). D\'autres voyages en Algérie, en Italie, en Grèce, en Égypte, nourriront aussi diverses publications.\r\n\r\nEn 1852, paraît Émaux et Camées, recueil de vers qu\'il enrichit jusqu\'en 1872 et qui fait de son auteur un chef d\'école : Baudelaire dédie Les Fleurs du mal au « poète impeccable » et Théodore de Banville salue le défenseur de « l\'art pour l\'art », précurseur des Parnassiens à la recherche du beau contre les épanchements lyriques des romantiques et valorisant le travail de la forme (« Sculpte, lime, cisèle » écrit Gautier dans son poème L’Art, dernière pièce de Émaux et Camées, édition de 1872).','2015-05-09 16:29:56','0000-00-00 00:00:00',0,1),
	(9,'Johann Wolfgang von','Goethe','./assets/img/uploads/authors/1426086281.jpg','1749-08-28','1832-03-22','Il est l\'auteur d\'une œuvre prolifique aux accents encyclopédiques qui le rattache à deux mouvements littéraires : le Sturm und Drang et le classicisme de Weimar (Weimarer Klassik). En physique, il proposa une théorie de la lumière et en anatomie, il fit la découverte d\'un os de la mâchoire. Il est souvent cité en tant que membre des Illuminés de Bavière (nom d\'ordre : Abaris). Son Divan doit beaucoup à Hafez.\r\n\r\nIl est notamment l\'auteur des Souffrances du jeune Werther (Die Leiden des jungen Werthers), Les Affinités électives (Wahlverwandtschaften), Faust I et II, Les Années d\'apprentissage de Wilhelm Meister (Wilhelm Meisters Lehrjahre) ainsi que de nombreux poèmes dont beaucoup sont si célèbres que des vers en sont entrés comme proverbes dans la langue allemande : Willkommen und Abschied (« Es schlug mein Herz, geschwind zu Pferde / es war getan fast eh gedacht »), Mignon (« kennst du das Land wo die Zitronen blühn… », Connais-tu le pays où fleurissent les citronniers), Le Roi des aulnes (« Wer reitet so spät durch Nacht und Wind / es ist der Vater mit seinem Kind… ») Der König in Thule, etc.','2015-05-09 16:29:57','0000-00-00 00:00:00',0,2),
	(10,'Franz','Hellens','./assets/img/uploads/authors/1426086362.jpg','1881-08-08','1972-01-20','Franz Hellens est le nom de plume de Frédéric Van Ermengem, né le 8 septembre 1881 à Bruxelles et mort le 20 janvier 1972 dans la même ville, un romancier, poète, essayiste et critique d\'art belge.\r\n\r\nFranz Hellens était le fils du bactériologiste Émile van Ermengem (1851-1932). Il vécut à Paris de 1947 à 1971.\r\n\r\nIl est connu comme un des représentants majeurs de la littérature fantastique en Belgique. Mais il fut aussi l\'infatigable animateur des Lettres belges, notamment de la revue d\'abord appelée Signaux de France et de Belgique puis Le Disque vert. C\'est lui qui découvrit Henri Michaux, avant que Jean ','2015-05-09 16:29:58','0000-00-00 00:00:00',0,1),
	(11,'Stephen','King','./assets/img/uploads/authors/1426086433.jpg','1947-09-21','0000-00-00','Il a publié son premier roman en 1974 et est rapidement devenu célèbre pour ses contributions dans le domaine de l\'horreur mais a également écrit des livres relevant d\'autres genres comme le fantastique, la fantasy, la science-fiction et le roman policier. Tout au long de sa carrière, il a écrit et publié plus de cinquante romans, dont sept sous le pseudonyme de Richard Bachman, et environ deux cents nouvelles, dont plus de la moitié sont réunies dans neuf recueils de nouvelles. Depuis son grave accident survenu en 1999, il a ralenti son rythme d\'écriture. Ses livres ont été vendus à plus de 350 millions d\'exemplaires à travers le monde et il a établi de nouveaux records de ventes dans le domaine de l\'édition durant les années 1980, décennie où sa popularité a atteint des sommets.\r\n\r\nLongtemps dédaigné par les critiques littéraires et les universitaires car considéré comme un auteur « populaire », il a acquis plus de considération depuis les années 1990 même si une partie de ces milieux continue de rejeter ses livres. Il a souvent été critiqué pour son style familier, son recours au gore et la longueur jugée excessive de certains de ses romans. À l\'inverse, son sens de la narration, ses personnages vivants et colorés, et sa faculté à jouer avec les peurs des lecteurs ont toujours été salués. Au-delà du caractère horrifique de la plupart de ses livres, il aborde régulièrement les thèmes de l\'enfance et de la condition de l\'écrivain, et brosse un portrait social très réaliste et sans complaisance des États-Unis à la fin du XXe siècle et au début du siècle suivant.\r\n\r\nIl a remporté de nombreux prix littéraires dont treize fois le prix Bram Stoker, sept fois le prix British Fantasy, cinq fois le prix Locus, quatre fois le prix World Fantasy, et une fois le prix Hugo et l\'O. Henry Award. Il a reçu en 2003 la médaille de la National Book Foundation pour sa remarquable contribution à la littérature américaine et, en 2007, l\'association des auteurs de romans policiers américains Mystery Writers of America lui a décerné le titre de « grand maître ». Ses ouvrages ont souvent été adaptés pour le cinéma ou la télévision avec des fortunes diverses, parfois avec sa contribution en tant que scénariste et, à une seule reprise, comme réalisateur.','2015-05-09 16:29:59','0000-00-00 00:00:00',0,2),
	(12,'Alfred','Kubin','./assets/img/uploads/authors/1426086501.jpg','1877-04-10','1959-08-20','Il naît d\'une mère pianiste et d\'un père géomètre. Timide et de faible constitution, Kubin a du mal à se faire des amis parmi les enfants de son âge, les déménagements successifs de sa famille dus au travail du père ne lui rendant pas la vie plus facile, et il passe de longs moments seul à dessiner.\r\n\r\nEn 1887, Kubin fait une première rencontre avec la mort : sa mère, malade de phtisie, meurt brutalement. La vision de son père, fou de chagrin, arpentant en tous sens la maison le cadavre de sa mère entre les bras, le marqua à jamais. Dans Le Meilleur Médecin, Kubin représente la Mort comme une femme vêtue de noir, une médaille autour du cou. Son visage ne comporte aucun trait.\r\n\r\nSon père, se remarie la même année avec la sœur de sa dernière épouse, qui mourut à son tour un an plus tard en donnant naissance à Rosalie, sa deuxième sœur. Son père devient hargneux et violent ; Alfred se replie encore un peu plus sur lui-même. Ses dessins se font un peu plus morbides, terrifiants, incarnation de la haine qu\'il porte au monde extérieur. Il est pris de visions fantastiques qu\'il s\'empresse de mettre en dessin.\r\n\r\nÀ la suite de nombreux échecs scolaires, son père décide en 1891 de l\'envoyer à l\'École des arts appliqués de Salzbourg, mais malgré un début plutôt prometteur, Kubin est renvoyé l\'année suivante en raison de ses mauvais résultats. Le frère de la troisième femme de son père (Irene Kühnel, avec qui il s\'est remarié l\'année précédente), photographe, finit par l\'accepter auprès de lui en tant qu\'apprenti. Mais il se brouille avec tout le monde, passe des soirées à boire, néglige son travail ; en 1896, il part se suicider devant la tombe de sa mère. Mais sa tentative échoue et il est renvoyé de nouveau. Il décide alors de s\'engager dans l\'armée, mais il fait une crise après trois semaines et passe trois mois à l\'hôpital militaire de Graz.\r\n\r\n\r\nLa Tombe d\'Alfred Kubin au cimetière du Wernstein am Inn.\r\nDurant l\'année de 1899, Kubin entre à l\'Akademie der Bildenden Künste München, dans la classe de Nikolaos Gysis mais il ne vient pas souvent en cours et est forcé d\'abandonner ses études. Il découvre également les travaux de Max Klinger, notamment son cycle de gravures Un gant, qui le marquent profondément et provoquent chez lui une sorte de « frénésie créative ». Il réalise durant cette période de très nombreux dessins et commence peu à peu à se faire connaître, en grande partie grâce à Hans von Weber qui lui voue une grande admiration. En 1902, Kubin réalise sa première exposition à Berlin. Il rencontre l\'année suivante Emma Myer, dont il tombe aussitôt amoureux, mais qui meurt presque immédiatement du typhus. Il se remarie deux ans après avec Hedwig Gründler, sœur de l\'écrivain Oscar A. H. Schmitz et s\'installe avec elle à Zwickledt.','2015-05-09 16:30:00','0000-00-00 00:00:00',0,1),
	(13,'Stephenie','Meyer','./assets/img/uploads/authors/1426086564.jpg','1973-12-24','0000-00-00','Stephenie Morgan est née à Hartford de Stephen et Candy Morgan. Elle grandit à Phoenix (Arizona), dans une famille de six enfants ; ses frères et sœurs se prénomment Seth, Emily, Jacob, Paul et Heidi. Elle fréquente la Chaparral High School de Scottsdale en Arizona, puis la Brigham Young University de Provo dans l\'Utah, où elle obtient un diplôme d\'anglais en 1995. Stephenie Morgan, mormone, rencontre son mari Christian Meyer (comptable), surnommé « Pancho », à l\'époque où elle vit en Arizona, et l\'épouse en 1994 à 21 ans. Ils ont trois enfants : Gabe, Seth et Eli. Femme au foyer, elle se met à écrire en racontant l\'un de ses rêves. Avant d\'être romancière, Stephenie Meyer était réceptionniste dans une agence immobilière.','2015-06-07 18:07:44','0000-00-00 00:00:00',100,1),
	(15,'Edgar Allan','Poe','./assets/img/uploads/authors/1426086703.jpg','1809-01-19','1849-10-07','Edgar Allan Poe (Boston, 19 janvier 1809 – Baltimore, 7 octobre 1849) est un poète, romancier, nouvelliste, critique littéraire, dramaturge et éditeur américain, ainsi que l\'une des principales figures du romantisme américain. Connu surtout pour ses contes — genre dont la brièveté lui permet de mettre en valeur sa théorie de l\'effet, suivant laquelle tous les éléments du texte doivent concourir à la réalisation d\'un effet unique— il a donné à la nouvelle ses lettres de noblesse et est considéré comme l’inventeur du roman policier. Nombre de ses récits préfigurent les genres de la science-fiction et du fantastique.\r\n\r\nNé à Boston, Edgar Allan Poe perd ses parents, David Poe Jr. et Elizabeth Arnold, dans sa petite enfance ; il est recueilli par John et Frances Allan de Richmond, en Virginie, où il passe l’essentiel de ses jeunes années, si l’on excepte un séjour en Angleterre et en Écosse, dans une aisance relative. Après un bref passage à l’Université de Virginie et des tentatives de carrière militaire, Poe quitte les Allan. Sa carrière littéraire débute humblement par la publication anonyme d’un recueil de poèmes intitulés Tamerlan et autres poèmes (1827), signés seulement « par un Bostonien ». Poe s’installe à Baltimore, où il vit auprès de sa famille paternelle et abandonne quelque peu la poésie pour la prose. En juillet 1835, il devient rédacteur-assistant au Southern Literary Messenger de Richmond, où il contribue à augmenter les abonnements et commence à développer son propre style de critique littéraire. La même année, à vingt-six ans, il épouse sa cousine germaine Virginia Clemm, alors âgée de 13 ans.\r\n\r\nAprès l’échec de son roman Les Aventures d\'Arthur Gordon Pym, Poe réalise son premier recueil d’histoires, les Contes du Grotesque et de l’Arabesque, en 1839. La même année, il devient rédacteur au Burton\'s Gentleman\'s Magazine, puis au Graham\'s Magazine à Philadelphie. C\'est à Philadelphie que nombre de ses œuvres parmi les plus connues ont été publiées. Dans cette ville, Poe a également projeté la création de son propre journal, The Penn (plus tard rebaptisé The Stylus), qui ne verra jamais le jour. En février 1844, il déménage à New York, où il travaille au Broadway Journal, un magazine dont il devient finalement l’unique propriétaire.','2015-05-09 16:30:03','0000-00-00 00:00:00',0,2),
	(16,'Joanne K.','Rolling','./assets/img/uploads/authors/1426086828.jpg','1965-07-31','0000-00-00','Née le 31 juillet 1965 dans l’agglomération de Yate, dans le Gloucestershire, en Angleterre, est une romancière britannique, connue sous le pseudonyme J. K. Rowling. Elle doit sa notoriété mondiale à la série Harry Potter, dont les tomes traduits en au moins 67 langues ont été vendus à plus de 450 millions d\'exemplaires. Elle a également utilisé les pseudonymes de Kennilworthy Whisp, Newt Scamander (tirés de sa propre œuvre) et Robert Galbraith.\r\n\r\nJeune mère divorcée vivant d’allocations, elle a commencé à écrire Harry Potter à l\'école des sorciers en 1990 et a dû attendre de longues années et l\'aide d\'un agent littéraire, Christopher Little, avant que son livre paraisse en 1997 chez Bloomsbury. Le succès planétaire des six tomes suivants ainsi que des hors-série lui ont permis d\'acquérir une fortune estimée en 2008 par le Sunday Times à 560 millions de livres (environ 590 millions d’euros ou 825 millions de USD, fin 2008) ; et d\'apporter sa contribution à de nombreuses associations caritatives luttant contre la maladie et les inégalités sociales. Elle devient ainsi une philanthrope reconnue en cofondant notamment le Children\'s High Level Group.','2015-05-16 11:49:05','0000-00-00 00:00:00',100,1),
	(17,'John Ronald Reuel','Tolkien','./assets/img/uploads/authors/1426086904.jpg','1892-01-03','1973-09-02','C\'est un écrivain, poète, philologue et professeur d’université anglais, né le 3 janvier 1892 à Bloemfontein et mort le 2 septembre 1973 à Bournemouth. Il est principalement connu pour ses romans Le Hobbit et Le Seigneur des anneaux.\r\n\r\nAprès des études à Birmingham et à Oxford et l’expérience traumatisante de la Première Guerre mondiale, Tolkien devient professeur assistant (reader) de langue anglaise à l’université de Leeds en 1920, puis professeur de vieil anglais à l’université d’Oxford en 1925 et professeur de langue et de littérature anglaises en 1945, toujours à Oxford. Il prend sa retraite en 1959. Durant sa carrière universitaire, il défend l’apprentissage des langues, surtout germaniques, et bouleverse l’étude du poème anglo-saxon Beowulf avec sa conférence Beowulf : Les Monstres et les Critiques (1936). Son essai Du conte de fées (1939) est également considéré comme un texte crucial dans l’étude de ce genre littéraire.\r\n\r\nTolkien commence à écrire pour son plaisir dans les années 1910, élaborant toute une mythologie autour de langues qu’il invente. L’univers ainsi créé, la Terre du Milieu, prend forme au fil des réécritures et compositions. Son ami C. S. Lewis l’encourage dans cette voie, de même que les autres membres de leur cercle littéraire informel, les Inklings. En 1937, la publication du Hobbit fait de Tolkien un auteur pour enfants estimé. Sa suite longtemps attendue, Le Seigneur des anneaux, est d’une tonalité plus sombre. Elle paraît en 1954-1955 et devient un véritable phénomène de société dans les années 1960, notamment sur les campus américains. Tolkien travaille sur sa mythologie jusqu’à sa mort, mais ne parvient pas à donner une forme achevée au Silmarillion. Ce recueil de légendes des premiers âges de la Terre du Milieu est finalement mis en forme et publié à titre posthume en 1977 par son fils et exécuteur littéraire Christopher, en collaboration avec Guy Gavriel Kay. Depuis, Christopher Tolkien publie régulièrement des textes inédits de son père.\r\n\r\nDe nombreux auteurs ont publié des romans de fantasy avant Tolkien, mais le succès majeur remporté par Le Seigneur des anneaux au moment de sa publication en poche aux États-Unis est à l’origine d’une renaissance populaire du genre. Tolkien est ainsi considéré, pour certains, comme le « père » de la fantasy moderne. Son œuvre a eu une influence majeure sur les auteurs ultérieurs de ce genre, en particulier par la rigueur avec laquelle il a construit son monde secondaire.','2015-05-09 16:30:05','0000-00-00 00:00:00',0,2),
	(18,'Jules','Verne','./assets/img/uploads/authors/1426086969.jpg','1828-02-08','1905-03-24','Né le 8 février 1828 à Nantes en France et mort le 24 mars 1905 à Amiens en France, est un écrivain français dont l\'œuvre est, pour la plus grande partie, constituée de romans d\'aventures et de science-fiction (ou d\'anticipation).\r\n\r\nEn 1863 paraît chez l\'éditeur Pierre-Jules Hetzel (1814-1886) son premier roman Cinq semaines en ballon, qui connaît un immense succès bien qui déborde des frontières françaises. Lié à l\'éditeur par un contrat de vingt ans, Jules Verne travaillera en fait pendant quarante ans à ses Voyages extraordinaires, qui compteront 62 romans et 18 nouvelles et paraîtront pour une partie d\'entre eux dans le Magasin d\'éducation et de récréation destiné à la jeunesse. Richement documentés, les romans de Jules Verne se situent aussi bien dans le présent technologique de la deuxième moitié du xixe siècle (Les Enfants du capitaine Grant (1868), Le Tour du monde en quatre-vingts jours (1873), Michel Strogoff (1876), L\'Étoile du sud (1884), etc.) que dans un monde imaginaire (De la Terre à la Lune (1865), Vingt mille lieues sous les mers (1870), Robur le conquérant (1886), etc.)\r\n\r\nL’œuvre de Jules Verne est populaire dans le monde entier et, selon l’Index Translationum, avec un total de 4 702 traductions, il vient au deuxième rang des auteurs les plus traduits en langue étrangère après Agatha Christie. Il est ainsi en 2011 l\'auteur de langue française le plus traduit dans le monde. L\'année 2005 a été déclarée « année Jules Verne », à l\'occasion du centenaire de la mort de l\'auteur.','2015-05-09 16:30:06','0000-00-00 00:00:00',0,2),
	(19,'Victor','Hugo','./assets/img/uploads/authors/1426087115.jpg','1802-02-26','1885-05-22','Né le 26 février 1802 à Besançon et mort le 22 mai 1885 à Paris, est un poète, dramaturge et prosateur romantique considéré comme l’un des plus importants écrivains de langue française. Il est aussi une personnalité politique et un intellectuel engagé qui a joué un rôle majeur dans l’histoire du xixe siècle.\r\n\r\nVictor Hugo occupe une place marquante dans l’histoire des lettres françaises au xixe siècle, dans des genres et des domaines d’une remarquable variété. Il est poète lyrique avec des recueils comme Odes et Ballades (1826), Les Feuilles d\'automne (1831) ou Les Contemplations (1856), mais il est aussi poète engagé contre Napoléon III dans Les Châtiments (1853) ou encore poète épique avec La Légende des siècles (1859 et 1877).\r\n\r\nIl est également un romancier du peuple qui rencontre un grand succès populaire avec notamment Notre-Dame de Paris (1831), et plus encore avec Les Misérables (1862). Au théâtre, il expose sa théorie du drame romantique dans sa préface de Cromwell en 1827 et l’illustre principalement avec Hernani en 1830 et Ruy Blas en 1838, mais aussi Lucrèce Borgia et Le Roi s\'amuse.\r\n\r\nSon œuvre multiple comprend aussi des discours politiques à la Chambre des pairs, à l\'Assemblée constituante et à l\'Assemblée législative, notamment sur la peine de mort, l’école ou l’Europe, des récits de voyages (Le Rhin, 1842, ou Choses vues, posthumes, 1887 et 1890), et une correspondance abondante.\r\n\r\nVictor Hugo a fortement contribué au renouvellement de la poésie et du théâtre ; il a été admiré par ses contemporains et l’est encore, mais il a aussi été contesté par certains auteurs modernes. Il a aussi permis à de nombreuses générations de développer une réflexion sur l’engagement de l’écrivain dans la vie politique et sociale grâce à ses multiples prises de position, qui le condamneront à l’exil pendant les vingt ans du Second Empire.\r\n\r\nSes choix, à la fois moraux et politiques, durant la deuxième partie de sa vie, et son œuvre hors du commun ont fait de lui un personnage emblématique, que la Troisième République a honoré à sa mort le 22 mai 1885 par des funérailles nationales, qui ont accompagné le transfert de sa dépouille au Panthéon de Paris, le 31 mai 1885.','2015-06-07 18:09:58','0000-00-00 00:00:00',100,2),
	(20,'Oscar','Wilde','./assets/img/uploads/authors/1426087178.jpg','1854-10-16','1900-11-30','Oscar Wilde, dont le nom complet est Oscar Fingal O\'Flahertie Wills Wilde, est un écrivain britannique d\'origine irlandaise, né à Dublin le 16 octobre 1854 et mort à Paris le 30 novembre 1900 à l\'âge de 46 ans.\r\n\r\nNé dans la bourgeoisie irlandaise et protestante de Dublin, d’un père ophtalmologiste renommé et d’une mère poétesse, Oscar Wilde se distingue par un parcours scolaire brillant. Nourri de culture classique, couronné de prix au sein du Trinity College de Dublin, il intègre le Magdalene College de l\'université d’Oxford, où il se construit un personnage d’esthète et de dandy, sous l’influence des préraphaélites et des théories de L\'art pour l’art (en) de Walter Pater, John Ruskin ou Whistler. À l’issue de ses études, Wilde s’installe à Londres, où il parvient à s\'insérer dans la bonne société et les cercles cultivés, s’illustrant dans plusieurs genres littéraires.\r\n\r\nS’il publie, conformément aux exigences de l’esthétisme le plus pur, un volume de poésie, il ne néglige pas des activités moins considérées des cercles littéraires, mais plus lucratives : ainsi, il se fait le porte-parole de la nouvelle « Renaissance anglaise dans les arts » dans une série de conférences aux États-Unis et au Canada, puis exerce une prolifique activité de journaliste. Au tournant des années 1890, il précise sa théorie esthétique dans une série de dialogues et d’essais, et explore dans son roman Le Portrait de Dorian Gray (1890) les liens entretenus par la beauté, la décadence et la duplicité. Sa pièce Salomé (1891), rédigée en français à Paris l’année suivante, ne peut être jouée en Angleterre, faute d’avoir obtenu la licence d’autorisation, au motif qu’elle met en scène des personnages bibliques. Confronté une première fois aux rigueurs de la morale victorienne, Wilde enchaîne cependant avec quatre comédies de mœurs, qui font de lui l’un des dramaturges les plus en vue de Londres. Indissociables de son talent littéraire, sa personnalité hors du commun, le mordant de son esprit, le brillant de sa conversation et de ses costumes assuraient sa renommée.\r\n\r\nAu faîte de sa gloire, alors que sa pièce maîtresse L\'Importance d\'être Constant (1895) triomphe à Londres, Oscar Wilde poursuit le père de son amant Alfred Bruce Douglas pour diffamation, après que celui-ci a entrepris de faire scandale de son homosexualité. Après une série de trois procès retentissants, Wilde est condamné pour « grave immoralité » à deux ans de travaux forcés. Ruiné par ses différents procès, condamné à la banqueroute, il écrit en prison De Profundis, une longue lettre adressée à son amant dont la noirceur forme un contraste saisissant avec sa première philosophie du plaisir. Dès sa libération en mai 1897, il quitte définitivement la Grande-Bretagne pour la France. C’est dans ce pays d’accueil qu’il met un point final à son œuvre avec La Ballade de la geôle de Reading (1898), un long poème commémorant l’expérience éprouvante de la vie en prison. Il meurt à Paris en 1900, dans le dénuement à l\'âge de quarante-six ans.','2015-05-16 14:44:39','0000-00-00 00:00:00',0,3);

/*!40000 ALTER TABLE `authors` ENABLE KEYS */;
UNLOCK TABLES;


# Affichage de la table book_library
# ------------------------------------------------------------

DROP TABLE IF EXISTS `book_library`;

CREATE TABLE `book_library` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `book_id` int(11) NOT NULL,
  `library_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `book_library` WRITE;
/*!40000 ALTER TABLE `book_library` DISABLE KEYS */;

INSERT INTO `book_library` (`id`, `book_id`, `library_id`)
VALUES
	(1,1,1),
	(2,2,1),
	(3,4,1),
	(4,5,1),
	(5,6,1);

/*!40000 ALTER TABLE `book_library` ENABLE KEYS */;
UNLOCK TABLES;


# Affichage de la table books
# ------------------------------------------------------------

DROP TABLE IF EXISTS `books`;

CREATE TABLE `books` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '',
  `img` varchar(255) NOT NULL DEFAULT '',
  `summary` text NOT NULL,
  `isbn` varchar(255) DEFAULT '',
  `nbpages` int(10) unsigned NOT NULL,
  `language_id` int(10) unsigned NOT NULL,
  `genre_id` int(10) unsigned NOT NULL,
  `location_id` int(10) unsigned NOT NULL,
  `editor_id` int(10) unsigned NOT NULL,
  `vote` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `books` WRITE;
/*!40000 ALTER TABLE `books` DISABLE KEYS */;

INSERT INTO `books` (`id`, `title`, `img`, `summary`, `isbn`, `nbpages`, `language_id`, `genre_id`, `location_id`, `editor_id`, `vote`)
VALUES
	(1,'Harry potter à l\'école des sorciers','./assets/img/uploads/books/1426090907.jpg','Après la mort tragique de Lily et James Potter, leur fils Harry est recueilli par sa tante Pétunia, la sœur de Lily et son oncle Vernon. Son oncle et sa tante, possédant une haine féroce envers les parents d\'Harry, le maltraitent et laissent leur fils Dudley l\'humilier. Harry ne sait rien sur ses parents. On lui a toujours dit qu’ils étaient morts dans un accident de voiture.\r\n\r\nLe jour de ses onze ans, un demi-géant du nom de Rubeus Hagrid vient le chercher pour l’emmener à Poudlard, une école de sorcellerie, où il est attendu pour la rentrée. Hagrid lui révèle qu’il est un sorcier comme ses parents et que ses parents ont en réalité été tués par l\'un des plus grands mages noirs du monde de la sorcellerie, Voldemort, surnommé Celui-Dont-On-Ne-Doit-Pas-Prononcer-le-Nom. Voldemort a cherché à tuer Harry, mais ce dernier a survécu, en gardant une cicatrice en forme d’éclair sur le front. Harry découvre alors qu\'il est un héros dans le monde des sorciers, car le sort que Voldemort lui a lancé pour le tuer s\'est retourné contre lui et le règne du mage noir s\'est arrêté, grâce à lui. Harry est adulé par la communauté des sorciers.\r\n\r\nHarry entre donc à l\'école de sorciers, Poudlard, où le professeur Albus Dumbledore est directeur. Lors de sa première année à l\'école de sorciers, il devient membre d\'une équipe de quidditch, et permet à son équipe de gagner le premier match de l\'année.\r\n\r\nLa pierre philosophale, qui permet de transformer le métal en or et de produire de l’élixir de vie, est gardée au sein de l\'école. Il devine qu\'un professeur, Severus Rogue, tente de voler la pierre pour le compte de Voldemort, lui permettant ainsi de retrouver ses capacités. Harry tente alors, aidé par ses amis Ron et Hermione, de s\'emparer lui-même de la pierre. Ils déjouent les obstacles qui protègent la pierre. En découvrant le professeur Quirrell déjà dans la salle où se trouve la pierre, il comprend que Severus essayait au contraire d\'empêcher Quirrell de s\'emparer de la pierre. Quirrell dégage son turban qu\'il porte en permanence, révélant un deuxième visage à l\'arrière de son crane : celui de Voldemort. Harry tue Quirrell, Voldemort quitte le corps et s\'enfuit. La pierre philosophale est finalement détruite par Nicolas Flamel son créateur.','2-07-051842-6',306,1,3,1,10,100),
	(2,'Harry Potter et la chambre des secrets','./assets/img/uploads/books/1426090921.jpg','Harry Potter passe l\'été chez les Dursley.\r\n\r\nLe jour de son 12e anniversaire, son oncle Vernon reçoit Mr Mason (un riche promoteur immobilier) et sa femme, avec qui il espère faire des affaires. Pendant leur visite, les Dursley ordonnent à Harry de rester dans sa chambre et de ne pas se faire remarquer.\r\n\r\nMais pendant que les Mason et les Dursley discutent dans le salon, à l\'étage Harry reçoit la visite de Dobby, un elfe de maison. Celui-ci met en garde le jeune sorcier et lui conseille de ne pas retourner à Poudlard, car un dangereux complot s\'y préparerait. Mais Harry choisi d\'ignorer cet avertissement, bien décidé à retourner à l\'école. Dobby lui avoue alors qu\'il a intercepté les lettres qui lui étaient destinées, dans le but de lui faire croire que ses amis l\'avaient oublié pour qu\'il décide de ne pas retourner à Poudlard. Harry se met alors à la poursuite de l\'elfe dans la maison afin de récupérer son courrier. En dernier recours, Dobby utilise la magie et fait tomber le gâteau se trouvant dans la cuisine avant de disparaître.\r\n\r\nAprès son départ, le jeune sorcier reçoit une lettre du Ministère de la Magie lui rappelant que l\'usage de la magie lui est interdit en dehors de Poudlard, et lui indiquant que si un événement similaire se produit, il serait définitivement renvoyé. L\'oncle Vernon de son côté, punit Harry pour avoir désobéi et l\'enferme dans sa chambre en lui interdisant de retourner à Poudlard.\r\n\r\nMais la nuit suivante, alors que le jeune garçon désespère de revoir ses amis, Ron et ses deux frères Fred et George viennent le chercher en voiture volante (ensorcelée par leur père) pour qu\'il passe le reste de l\'été chez eux.\r\n\r\nAprès avoir rejoint la maison des Weasley, Harry se rend avec eux au Chemin de Traverse afin d\'acheter ses affaires scolaires. Pour cela il utilise la Poudre de cheminette, mais à la suite d\'une mauvaise prononciation de la formule il se retrouve par erreur dans l\'Allée des Embrumes. Heureusement il rencontre Hagrid qui l\'aide à retourner au Chemin de Traverse. Là Harry retrouve les Weasley, qui se rendent dans la librairie Fleury et Bott, où Gilderoy Lockhart donne une séance de dédicace. Au cours de celle-ci ce dernier annonce qu\'il est le nouveau professeur de Défense contre les Forces du Mal à Poudlard. Au moment de repartir, Harry et les Weasley tombent nez à nez avec Drago et son père. S\'en suit une altercation entre Arthur Weasley et Lucius Malefoy.','2-07-054129-0',288,1,3,1,10,100),
	(4,'Les Misérables','./assets/img/uploads/books/1433692720.jpg','Dans ce roman, un des plus emblématiques de la littérature française, Victor Hugo décrit la vie de misérables dans Paris et la France provinciale du xixe siècle et s\'attache plus particulièrement aux pas du bagnard Jean Valjean qui n\'est pas sans rappeler le condamné à mort du Dernier Jour d\'un condamné ou Claude Gueux. C\'est un roman historique, social et philosophique dans lequel on retrouve les idéaux du romantisme et ceux de Victor Hugo concernant la nature humaine. L\'auteur lui-même accorde une grande importance à ce roman et écrit en mars 1862, à son éditeur Lacroix : « Ma conviction est que ce livre sera un des principaux sommets, sinon le principal, de mon œuvre». Il a donné lieu à de nombreuses adaptations au cinéma.','978-2211215350',1662,1,2,1,1,100),
	(5,'L\'Homme qui rit','./assets/img/uploads/books/1433692966.jpg','L’Homme qui rit suit les destins croisés de plusieurs personnages. Le premier est Ursus (ours en latin), un vagabond qui s’habille de peaux d’ours et est accompagné d’un loup domestique, Homo (homme en latin). Ursus et Homo voyagent à travers l’Angleterre en traînant une cahute, dont Ursus se sert pour haranguer les foules et vendre des potions.\r\n\r\nLeur chemin croise, en janvier 1690, celui de Gwynplaine, un enfant de dix ans vêtu de haillons qui vient d’être abandonné par un groupe d’hommes pressés d’embarquer sur une ourque qui doit les emmener loin de l’île anglaise. Les hommes sont des Comprachicos (mot de l’invention de Victor Hugo venant de l\'espagnol comprar (acheter) et chicos (enfants) signifiant « acheteurs d’enfants »), spécialisés dans le commerce d\'enfants, qu\'ils achètent ou volent et revendent après les avoir mutilés. Pendant que leur bateau est broyé par les flots et que, voyant la mort venir, les hommes décident de jeter une bouteille dénonçant leur crime à la mer, Gwynplaine, resté sur la berge, doit se battre contre la nuit, la neige et la mort alors qu’il cherche à retourner vers la ville. Il passe devant un gibet où pend le peu qu’il reste du cadavre d’un condamné et découvre, à quelques pas de là, le corps d’une femme sur le sein de laquelle est accroché un bébé encore en vie. Chargé de ce fardeau supplémentaire, l’enfant reprend le chemin vers Portland...','2070418715',838,1,2,1,10,0),
	(6,'Les âmes vagabondes','./assets/img/uploads/books/1433693192.jpg','La Terre est envahie. L\'humanité est en danger. Nos corps restent les mêmes, mais nos esprits sont contrôlés. Melanie Stryder vient d\'être capturée. Elle refuse cependant de laisser place à l\'être qui tente de la posséder. Quelque part, caché dans le désert, se trouve un homme qu\'elle ne peut pas oublier. L\'amour pourra-t-il la sauver ?','2709630265',617,1,3,1,1,0);

/*!40000 ALTER TABLE `books` ENABLE KEYS */;
UNLOCK TABLES;


# Affichage de la table comments
# ------------------------------------------------------------

DROP TABLE IF EXISTS `comments`;

CREATE TABLE `comments` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ref` varchar(10) NOT NULL DEFAULT '',
  `ref_id` int(11) unsigned NOT NULL,
  `comment` text NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `ref_id` (`ref_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;

INSERT INTO `comments` (`id`, `ref`, `ref_id`, `comment`, `user_id`, `date`)
VALUES
	(20,'author',16,'Salut',1,'2015-05-11 19:30:20');

/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;


# Affichage de la table editors
# ------------------------------------------------------------

DROP TABLE IF EXISTS `editors`;

CREATE TABLE `editors` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `website` varchar(255) DEFAULT NULL,
  `img` varchar(255) DEFAULT '',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `history` text,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `editors` WRITE;
/*!40000 ALTER TABLE `editors` DISABLE KEYS */;

INSERT INTO `editors` (`id`, `name`, `website`, `img`, `created_at`, `updated_at`, `history`, `user_id`)
VALUES
	(1,'Hachette','hachette.fr','./assets/img/uploads/editors/editor.jpg','2015-05-16 12:11:49','0000-00-00 00:00:00','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas placerat quam vel urna eleifend, ac gravida neque venenatis. Sed dictum in lectus et lobortis. Cras sit amet auctor ex. Nulla faucibus eu neque eget varius. Suspendisse potenti. Nullam ultrices, justo id molestie vestibulum, eros quam viverra turpis, quis tristique ex urna ac justo. Suspendisse porttitor lectus ut augue auctor interdum. Pellentesque et sodales metus, sed dignissim metus. Duis vel ligula at leo dapibus vestibulum. Suspendisse eleifend semper libero a iaculis. In ultrices in elit id accumsan.',1),
	(4,'Editis','editis.fr','./assets/img/uploads/editors/editor.jpg','2015-05-16 12:11:50','0000-00-00 00:00:00','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas placerat quam vel urna eleifend, ac gravida neque venenatis. Sed dictum in lectus et lobortis. Cras sit amet auctor ex. Nulla faucibus eu neque eget varius. Suspendisse potenti. Nullam ultrices, justo id molestie vestibulum, eros quam viverra turpis, quis tristique ex urna ac justo. Suspendisse porttitor lectus ut augue auctor interdum. Pellentesque et sodales metus, sed dignissim metus. Duis vel ligula at leo dapibus vestibulum. Suspendisse eleifend semper libero a iaculis. In ultrices in elit id accumsan.',1),
	(5,'Bayard','bayard.fr','./assets/img/uploads/editors/editor.jpg','2015-05-16 12:11:51','0000-00-00 00:00:00','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas placerat quam vel urna eleifend, ac gravida neque venenatis. Sed dictum in lectus et lobortis. Cras sit amet auctor ex. Nulla faucibus eu neque eget varius. Suspendisse potenti. Nullam ultrices, justo id molestie vestibulum, eros quam viverra turpis, quis tristique ex urna ac justo. Suspendisse porttitor lectus ut augue auctor interdum. Pellentesque et sodales metus, sed dignissim metus. Duis vel ligula at leo dapibus vestibulum. Suspendisse eleifend semper libero a iaculis. In ultrices in elit id accumsan.',1),
	(6,'France Loisir','france-loisir.fr','./assets/img/uploads/editors/editor.jpg','2015-05-16 12:11:52','0000-00-00 00:00:00','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas placerat quam vel urna eleifend, ac gravida neque venenatis. Sed dictum in lectus et lobortis. Cras sit amet auctor ex. Nulla faucibus eu neque eget varius. Suspendisse potenti. Nullam ultrices, justo id molestie vestibulum, eros quam viverra turpis, quis tristique ex urna ac justo. Suspendisse porttitor lectus ut augue auctor interdum. Pellentesque et sodales metus, sed dignissim metus. Duis vel ligula at leo dapibus vestibulum. Suspendisse eleifend semper libero a iaculis. In ultrices in elit id accumsan.',1),
	(7,'Atlas','atlas.fr','./assets/img/uploads/editors/editor.jpg','2015-05-16 12:11:53','0000-00-00 00:00:00','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas placerat quam vel urna eleifend, ac gravida neque venenatis. Sed dictum in lectus et lobortis. Cras sit amet auctor ex. Nulla faucibus eu neque eget varius. Suspendisse potenti. Nullam ultrices, justo id molestie vestibulum, eros quam viverra turpis, quis tristique ex urna ac justo. Suspendisse porttitor lectus ut augue auctor interdum. Pellentesque et sodales metus, sed dignissim metus. Duis vel ligula at leo dapibus vestibulum. Suspendisse eleifend semper libero a iaculis. In ultrices in elit id accumsan.',2),
	(8,'Martinère','atlas.fr','./assets/img/uploads/editors/editor.jpg','2015-05-16 12:11:54','0000-00-00 00:00:00','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas placerat quam vel urna eleifend, ac gravida neque venenatis. Sed dictum in lectus et lobortis. Cras sit amet auctor ex. Nulla faucibus eu neque eget varius. Suspendisse potenti. Nullam ultrices, justo id molestie vestibulum, eros quam viverra turpis, quis tristique ex urna ac justo. Suspendisse porttitor lectus ut augue auctor interdum. Pellentesque et sodales metus, sed dignissim metus. Duis vel ligula at leo dapibus vestibulum. Suspendisse eleifend semper libero a iaculis. In ultrices in elit id accumsan.',1),
	(9,'Flammarion','atlas.fr','./assets/img/uploads/editors/editor.jpg','2015-05-16 12:11:55','0000-00-00 00:00:00','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas placerat quam vel urna eleifend, ac gravida neque venenatis. Sed dictum in lectus et lobortis. Cras sit amet auctor ex. Nulla faucibus eu neque eget varius. Suspendisse potenti. Nullam ultrices, justo id molestie vestibulum, eros quam viverra turpis, quis tristique ex urna ac justo. Suspendisse porttitor lectus ut augue auctor interdum. Pellentesque et sodales metus, sed dignissim metus. Duis vel ligula at leo dapibus vestibulum. Suspendisse eleifend semper libero a iaculis. In ultrices in elit id accumsan.',1),
	(10,'Gallimard','http://www.gallimard.fr','./assets/img/uploads/editors/1431770474.jpg','2015-05-16 12:11:56','0000-00-00 00:00:00','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas placerat quam vel urna eleifend, ac gravida neque venenatis. Sed dictum in lectus et lobortis. Cras sit amet auctor ex. Nulla faucibus eu neque eget varius. Suspendisse potenti. Nullam ultrices, justo id molestie vestibulum, eros quam viverra turpis, quis tristique ex urna ac justo. Suspendisse porttitor lectus ut augue auctor interdum. Pellentesque et sodales metus, sed dignissim metus. Duis vel ligula at leo dapibus vestibulum. Suspendisse eleifend semper libero a iaculis. In ultrices in elit id accumsan.',1);

/*!40000 ALTER TABLE `editors` ENABLE KEYS */;
UNLOCK TABLES;


# Affichage de la table genres
# ------------------------------------------------------------

DROP TABLE IF EXISTS `genres`;

CREATE TABLE `genres` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `genres` WRITE;
/*!40000 ALTER TABLE `genres` DISABLE KEYS */;

INSERT INTO `genres` (`id`, `name`, `created_at`, `updated_at`)
VALUES
	(1,'Poésie','2015-03-09 17:20:14','0000-00-00 00:00:00'),
	(2,'Roman','2015-03-09 17:20:22','0000-00-00 00:00:00'),
	(3,'Fantastique','2015-03-09 17:20:35','0000-00-00 00:00:00'),
	(4,'Policier','2015-03-09 17:20:51','0000-00-00 00:00:00'),
	(5,'Thriller','2015-03-09 17:20:55','0000-00-00 00:00:00'),
	(6,'Horreur','2015-03-09 17:20:59','0000-00-00 00:00:00'),
	(7,'Philosophie','2015-06-07 18:21:27','0000-00-00 00:00:00'),
	(8,'Théâtre','2015-06-07 18:23:04','0000-00-00 00:00:00'),
	(9,'Essai','2015-06-07 18:23:19','0000-00-00 00:00:00'),
	(10,'BD','2015-06-07 18:23:29','0000-00-00 00:00:00'),
	(11,'Avanture','2015-06-07 18:23:41','0000-00-00 00:00:00'),
	(12,'Manga','2015-06-07 18:23:52','0000-00-00 00:00:00'),
	(13,'Nouvelle','2015-06-07 18:24:19','0000-00-00 00:00:00'),
	(14,'Biographie','2015-06-07 18:24:26','0000-00-00 00:00:00'),
	(15,'Conte','2015-06-07 18:24:34','0000-00-00 00:00:00'),
	(16,'Recette','2015-06-07 18:24:39','0000-00-00 00:00:00');

/*!40000 ALTER TABLE `genres` ENABLE KEYS */;
UNLOCK TABLES;


# Affichage de la table languages
# ------------------------------------------------------------

DROP TABLE IF EXISTS `languages`;

CREATE TABLE `languages` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(5) NOT NULL DEFAULT '',
  `name` varchar(20) NOT NULL DEFAULT '',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `languages` WRITE;
/*!40000 ALTER TABLE `languages` DISABLE KEYS */;

INSERT INTO `languages` (`id`, `code`, `name`, `created_at`, `updated_at`)
VALUES
	(1,'fr','Français','2015-03-06 17:02:51','0000-00-00 00:00:00'),
	(3,'en','Anglais','2015-03-09 17:01:33','0000-00-00 00:00:00'),
	(4,'es','Espagnol','2015-03-09 17:01:41','0000-00-00 00:00:00'),
	(5,'de','Allemand','2015-03-09 17:02:45','0000-00-00 00:00:00'),
	(6,'elf','Elfique','2015-03-09 17:03:09','0000-00-00 00:00:00'),
	(7,'flg','Fourchelangue','2015-03-09 17:03:36','0000-00-00 00:00:00');

/*!40000 ALTER TABLE `languages` ENABLE KEYS */;
UNLOCK TABLES;


# Affichage de la table libraries
# ------------------------------------------------------------

DROP TABLE IF EXISTS `libraries`;

CREATE TABLE `libraries` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `address` varchar(255) NOT NULL DEFAULT '',
  `tel` varchar(20) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  `user_id` int(11) NOT NULL,
  `private` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `libraries` WRITE;
/*!40000 ALTER TABLE `libraries` DISABLE KEYS */;

INSERT INTO `libraries` (`id`, `name`, `address`, `tel`, `email`, `user_id`, `private`)
VALUES
	(1,'Ma première bibliothèque','23 rue de la République 6700 Givors','06 83 21 30 08','biblio1@test.fr',1,0);

/*!40000 ALTER TABLE `libraries` ENABLE KEYS */;
UNLOCK TABLES;


# Affichage de la table location_library
# ------------------------------------------------------------

DROP TABLE IF EXISTS `location_library`;

CREATE TABLE `location_library` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `location_id` int(11) NOT NULL,
  `library_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `location_library` WRITE;
/*!40000 ALTER TABLE `location_library` DISABLE KEYS */;

INSERT INTO `location_library` (`id`, `location_id`, `library_id`)
VALUES
	(1,1,1),
	(2,2,1),
	(3,3,1),
	(5,4,1),
	(7,6,1),
	(8,5,1),
	(9,6,1),
	(10,7,1),
	(11,8,1);

/*!40000 ALTER TABLE `location_library` ENABLE KEYS */;
UNLOCK TABLES;


# Affichage de la table locations
# ------------------------------------------------------------

DROP TABLE IF EXISTS `locations`;

CREATE TABLE `locations` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `locations` WRITE;
/*!40000 ALTER TABLE `locations` DISABLE KEYS */;

INSERT INTO `locations` (`id`, `name`, `created_at`, `updated_at`)
VALUES
	(1,'1er étage','2015-05-17 15:33:16','0000-00-00 00:00:00'),
	(2,'2ème étage ','2015-03-09 17:05:52','0000-00-00 00:00:00'),
	(3,'3ème étage','2015-03-09 17:05:53','0000-00-00 00:00:00'),
	(4,'4ème étage','2015-05-10 16:09:21','0000-00-00 00:00:00');

/*!40000 ALTER TABLE `locations` ENABLE KEYS */;
UNLOCK TABLES;


# Affichage de la table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `login` varchar(100) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  `password` varchar(255) NOT NULL DEFAULT '',
  `role` varchar(10) NOT NULL DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `avatar` varchar(255) NOT NULL DEFAULT '',
  `comment_count` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `login`, `email`, `password`, `role`, `created_at`, `updated_at`, `avatar`, `comment_count`)
VALUES
	(1,'Jarvis','qzd@qzd.fr','e666b7a011e9d5ece0a6cbc3125c1e0e2bda21a5','user','2015-05-28 19:03:50','0000-00-00 00:00:00','',2);

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;


# Affichage de la table votes
# ------------------------------------------------------------

DROP TABLE IF EXISTS `votes`;

CREATE TABLE `votes` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ref` varchar(20) NOT NULL DEFAULT '',
  `ref_id` int(11) NOT NULL,
  `value` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `votes` WRITE;
/*!40000 ALTER TABLE `votes` DISABLE KEYS */;

INSERT INTO `votes` (`id`, `ref`, `ref_id`, `value`, `user_id`)
VALUES
	(1,'books',1,1,0),
	(2,'books',2,1,0),
	(3,'authors',1,1,2),
	(6,'authors',1,1,1),
	(7,'authors',1,1,3),
	(8,'books',1,1,1),
	(9,'books',2,1,1),
	(10,'authors',16,1,1),
	(13,'authors',16,1,2),
	(14,'books',1,1,2),
	(15,'books',4,1,1),
	(16,'authors',13,1,1),
	(17,'authors',19,1,1);

/*!40000 ALTER TABLE `votes` ENABLE KEYS */;
UNLOCK TABLES;


# Affichage de la table watch_later
# ------------------------------------------------------------

DROP TABLE IF EXISTS `watch_later`;

CREATE TABLE `watch_later` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `book_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `watch_later` WRITE;
/*!40000 ALTER TABLE `watch_later` DISABLE KEYS */;

INSERT INTO `watch_later` (`id`, `book_id`, `user_id`)
VALUES
	(7,1,1);

/*!40000 ALTER TABLE `watch_later` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
