--
-- Base de données :  `gsbformations`
--
DROP DATABASE IF EXISTS `gsbformations`;
CREATE DATABASE `gsbformations` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `gsbformations`;

-- --------------------------------------------------------

--
-- Structure de la table `categorieorganisateur`
--

CREATE TABLE `categorieorganisateur` (
  `id` int(11) NOT NULL,
  `libelle` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `categorieorganisateur`
--

INSERT INTO `categorieorganisateur` (`id`, `libelle`) VALUES
(1, 'association'),
(2, 'organisation publique'),
(3, 'CHU'),
(4, 'organisme de formation privé');

-- --------------------------------------------------------

--
-- Structure de la table `fonctionnalite`
--

CREATE TABLE `fonctionnalite` (
  `id` int(11) NOT NULL,
  `intitule` varchar(200) NOT NULL,
  `path_script` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `fonctionnalite`
--

INSERT INTO `fonctionnalite` (`id`, `intitule`, `path_script`) VALUES
(1, 'Gérer les formations', NULL),
(2, 'Consulter liste inscription aux formations avec critères eventuels', NULL),
(3, 'Gérer les organisateurs', NULL),
(4, 'Valider demande annulation', NULL),
(5, 'Consulter listes formations proposées', NULL),
(6, 'Annuler inscription', NULL),
(7, 'S\'inscrire aux formations', NULL),
(8, 'Consulter les formations auxquelles je suis inscrit', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `formation`
--

CREATE TABLE `formation` (
  `id` int(11) NOT NULL,
  `intitule` varchar(200) NOT NULL,
  `date_debut` date NOT NULL,
  `duree` smallint(6) NOT NULL,
  `lieu` varchar(300) DEFAULT NULL,
  `nombre_places` int(11) NOT NULL,
  `id_organisateur` int(11) NOT NULL,
  `id_type_formation` int(11) NOT NULL,
  `id_secteur_formation` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `formation`
--

INSERT INTO `formation` (`id`, `intitule`, `date_debut`, `duree`, `lieu`, `nombre_places`, `id_organisateur`, `id_type_formation`, `id_secteur_formation`) VALUES
(1, '8eme journée de vaccinologie', '2020-10-14', 4, 'Ecole du Val de Grâce Amphithéâtre Rouvillois\r\n1, place Alphonse Laveran\r\n75005 Paris', 95, 2, 4, 36),
(2, 'Journée des sciences et de la médecine du sport 2017', '2020-10-21', 2, 'Centre du congrès le Bellevue\r\nPlace Bellevue\r\n64200 Biarritz France', 43, 3, 4, 22),
(3, 'Préparer et réussir ses présentations Commerciales', '2020-11-16', 2, 'Centre de congrès le Bellevue\r\nPlace Bellevue\r\n64200 Biarritz France', 8, 6, 8, 2),
(4, 'Gagner du temps et de l\'efficacité dans ses communications', '2020-11-23', 2, 'Siège Social GSB', 8, 7, 8, 1),
(5, 'La publicité pour le médicament : nouveaux enjeux et nouvelles organisations', '2017-06-22', 2, 'Faculté des Sciences pharmaceutiques et biologiques\r\n4 avenue de l\'Observatiore\r\n75006 Paris', 15, 8, 9, 37),
(6, '6e Edition du Colloque Douleurs et Démences', '2020-11-26', 2, 'FIAP Jean Monnet\r\n30 rue Cabanis\r\n75014 Paris', 8, 9, 2, 38),
(7, 'La maladie cœliaque ou intolérence au gluten', '2020-12-01', 2, 'Faculté de médecine Pierre et Marie Curie\r\nAmphithéâtre E\r\n105 boulevard de l\'Hôpital \r\n75013 Paris', 15, 10, 2, 5),
(8, 'La maladie cœliaque ou intolérance au gluten', '2020-12-07', 2, 'Faculté de médecine\r\nAmphithéâtre n°1\r\n27 Boulevard Jean Moulin\r\n13000 Marseille', 1, 10, 2, 5),
(9, 'Alerte aux allergies ', '2020-12-14', 2, 'Siège social GSB ', 100, 8, 8, 5);

-- --------------------------------------------------------

--
-- Structure de la table `habilitation`
--

CREATE TABLE `habilitation` (
  `id_fonctionnalite` int(11) NOT NULL,
  `id_role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `inscription`
--

CREATE TABLE `inscription` (
  `id_formation` int(11) NOT NULL,
  `matricule_visiteur` char(4) NOT NULL,
  `statut` enum('acceptée','en attente','annulation demandée','annulation acceptée','annulation refusée') NOT NULL,
  `date_inscription` date NOT NULL,
  `objet_annulation` varchar(500) DEFAULT NULL,
  `date_annulation` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `inscription`
--

INSERT INTO `inscription` (`id_formation`, `matricule_visiteur`, `statut`, `date_inscription`, `objet_annulation`, `date_annulation`) VALUES
(1, 'b420', 'acceptée', '0000-00-00', NULL, NULL),
(1, 'j847', 'acceptée', '0000-00-00', NULL, NULL),
(2, 'j847', 'acceptée', '0000-00-00', NULL, NULL),
(3, 'j847', 'acceptée', '0000-00-00', NULL, NULL),
(4, 'b420', 'acceptée', '0000-00-00', NULL, NULL),
(8, 'r289', 'acceptée', '0000-00-00', NULL, NULL),
(9, 'b420', 'acceptée', '0000-00-00', NULL, NULL),
(9, 'h759', 'acceptée', '0000-00-00', NULL, NULL),
(9, 'r289', 'acceptée', '0000-00-00', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `organisateur`
--

CREATE TABLE `organisateur` (
  `id` int(11) NOT NULL,
  `nom` varchar(200) NOT NULL,
  `adresse` varchar(200) NOT NULL,
  `cp` int(11) NOT NULL,
  `ville` varchar(200) NOT NULL,
  `url_organisateur` varchar(200) DEFAULT NULL,
  `id_categorie` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `organisateur`
--

INSERT INTO `organisateur` (`id`, `nom`, `adresse`, `cp`, `ville`, `url_organisateur`, `id_categorie`) VALUES
(2, 'CIC Cochin Pasteur', '27 rue du Faubourg St Jaques', 75679, 'Paris', 'http://www.cicvaccinologie.com', 4),
(3, 'SAFSU', '40 rue du Palais de Justice', 64120, 'St Palais', 'http://www.safsu.fr', 4),
(6, 'CEGOS', '19 rue René Jacques', 92798, 'Issy Les Moulineaux', 'http://www.cegos.fr', 4),
(7, 'DEMOS', '20 rue de l\'Arcade', 75008, 'Paris', 'http://www.demos.fr', 2),
(8, 'Université Paris Descartes', '4 Avenue de l\'Observatoire', 75010, 'Paris', 'http://www.scfc.parisdescartes.fr', 4),
(9, 'LE CLEF', '9 bis Boulevard Jean Jaurès', 92100, 'Boulogne-Billancourt', 'http://www.le-clef.fr', 4),
(10, 'AFDIAG', '15 rue d\'Hauteville', 75020, 'Paris', 'http://www.afdiag.fr', 4);

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `intitule` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `role`
--

INSERT INTO `role` (`id`, `intitule`) VALUES
(1, 'Ressources humaines'),
(2, 'Visiteur médical');

-- --------------------------------------------------------

--
-- Structure de la table `secteurformation`
--

CREATE TABLE `secteurformation` (
  `id` int(50) NOT NULL,
  `libelle` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `secteurformation`
--

INSERT INTO `secteurformation` (`id`, `libelle`) VALUES
(1, 'Développement personnel'),
(2, 'Technique de vente'),
(3, 'Communication'),
(4, 'Bureautique'),
(5, 'Allergologie'),
(6, 'Anatomie et cytologie pathologiques'),
(7, 'Anesthésie - réanimation'),
(8, 'Biologie médicale'),
(9, 'Cardiologie et maladie vasculaires'),
(10, 'Chirurgie générale'),
(11, 'Chirurgie infantile'),
(12, 'Chirurgie maxillo-faciale et stomatologie'),
(13, 'Chirurgie orthopédique et traumatologie'),
(14, 'Chirurgie plastique reconstructrice et esthétique'),
(15, 'Chirurgie thoraxique et cardio-vasculaire'),
(16, 'Chirurgie viscérale et digestive'),
(17, 'Dermathologie et vénérologie'),
(18, 'Endocrinologie et métabolisme'),
(19, 'Gastro-entérologie et hépatologie'),
(20, 'Gynécologie-obstétrique'),
(21, 'Hématologie'),
(22, 'Médecine du sport'),
(23, 'Médecine générale'),
(24, 'Médecine interne'),
(25, 'Médecine nucléaire'),
(26, 'Médecine physique et de réadaptation'),
(27, 'Neurologie'),
(28, 'Oncologie'),
(29, 'Ophtalmologie'),
(30, 'Oto-rhino-laryngologie'),
(31, 'Pédiatrie'),
(32, 'Pneumologie'),
(33, 'Psychiatrie'),
(34, 'Radiodiagnostic et imagerie médicale'),
(35, 'Rhumathologie'),
(36, 'Immunologie'),
(37, 'Pharmacologie'),
(38, 'Gériatrie');

-- --------------------------------------------------------

--
-- Structure de la table `typeformation`
--

CREATE TABLE `typeformation` (
  `id` int(11) NOT NULL,
  `libelle` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `typeformation`
--

INSERT INTO `typeformation` (`id`, `libelle`) VALUES
(1, 'Stages'),
(2, 'Colloque'),
(3, 'Séminaire'),
(4, 'Journée thématique'),
(5, 'Journée d etude'),
(6, 'Symposiums'),
(7, 'Congrès'),
(8, 'Formation'),
(9, 'Conférence');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `matricule` char(4) NOT NULL,
  `nom` char(30) DEFAULT NULL,
  `prenom` char(30) DEFAULT NULL,
  `login` char(20) DEFAULT NULL,
  `mdp` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `id_role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`matricule`, `nom`, `prenom`, `login`, `mdp`, `email`, `id_role`) VALUES
('b316', 'Collet', 'Manon', 'mcollet', '123', 'mcollet@gsb.com', 1),
('b420', 'Lapointe', 'Marie', 'mlapointe', '123', 'mlapointe@gsb.com', 2),
('c435', 'Debelle', 'Michel', 'mdebelle', '123', 'mdebelle@gsb.com', 2),
('d309', 'Durieux', 'Justine', 'jdurieux', '123', 'jdurieux@gsb.com', 2),
('d742', 'Duncombe', 'Claude', 'cduncombe', '123', 'cduncombe@gsb.com', 2),
('d93', 'Finck', 'Jacques', 'jfinck', '123', 'jfinck@gsb.com', 2),
('e638', 'Bioret', 'Luc', 'lbioret', '123', 'lbioret@gsb.com', 2),
('f188', 'Debroise', 'Michel', 'mdebroise', '123', 'mdebroise@gsb.com', 2),
('h651', 'Bunisset', 'Denise', 'dbunisset', '123', 'dbunisset@gsb.com', 2),
('h759', 'Villechalane', 'Louis', 'lvillachane', '123', 'lvillachane@gsb.com', 2),
('i181', 'Debelle', 'Jeanne', 'jdebelle', '123', 'jdebelle@gsb.com', 2),
('j847', 'Raquin', 'Mélanie', 'mraquin', '123', 'mraquin@gsb.com', 2),
('k379', 'Desnost', 'Pierre', 'pdesnost', '123', 'pdesnost@gsb.com', 2),
('l222', 'De', 'Eric', 'ede', '123', 'ede@gsb.com', 2),
('m73', 'Daburon', 'Francine', 'fdaburon', '123', 'fdaburon@gsb.com', 2),
('m833', 'Cottin', 'Vincent', 'vcottin', '123', 'vcottin@gsb.com', 2),
('o256', 'Rousseau', 'Alex', 'arousseau', '123', 'arousseau@gsb.com', 1),
('p284', 'Andre', 'David', 'dandre', '123', 'dandre@gsb.com', 2),
('p923', 'Bonnot', 'Paul', 'pbonnot', '123', 'pbonnot@gsb.com', 2),
('r164', 'Cacheux', 'Bernard', 'bcacheux', '123', 'bcacheux@gsb.com', 2),
('r289', 'Bedos', 'Christian', 'cbedos', '123', 'cbedos@gsb.com', 2),
('u806', 'cajet', 'Corentin', 'ccorentin', '123', 'ccorentin@gsb.com', 1),
('v471', 'Bentot', 'Pascal', 'pbentot', '123', 'pbentot@gsb.com', 2),
('v634', 'Desmarquest', 'Nathalie', 'ndesmarquest', '123', 'ndesmarquest@gsb.com', 2),
('w622', 'Chaize', 'Henri', 'hchaize', '123', 'hchaize@gsb.com', 2),
('x239', 'Bunisset', 'Franck', 'fbunisset', '123', 'fbunisset@gsb.com', 2),
('x827', 'Clepkens', 'Christophe', 'cclepkens', '123', 'cclepkens@gsb.com', 2),
('y971', 'Durant', 'Pierre', 'pdurant', '123', 'pdurant@gsb.com', 2),
('z154', 'Prevost', 'Severine', 'sprevost', '123', 'sprevost@gsb.com', 1),
('z846', 'Tharaud', 'Pascale', 'ptharaud', '123', 'ptharaud@gsb.com', 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categorieorganisateur`
--
ALTER TABLE `categorieorganisateur`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `fonctionnalite`
--
ALTER TABLE `fonctionnalite`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `path_script` (`path_script`);

--
-- Index pour la table `formation`
--
ALTER TABLE `formation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_Formation_id_organisateur` (`id_organisateur`),
  ADD KEY `IDX_Formation_id_type_formation` (`id_type_formation`),
  ADD KEY `IDX_Formation_id_secteur_formation` (`id_secteur_formation`);

--
-- Index pour la table `habilitation`
--
ALTER TABLE `habilitation`
  ADD PRIMARY KEY (`id_fonctionnalite`,`id_role`),
  ADD KEY `IDX_Habilitation_id_role` (`id_role`);

--
-- Index pour la table `inscription`
--
ALTER TABLE `inscription`
  ADD PRIMARY KEY (`id_formation`,`matricule_visiteur`),
  ADD KEY `IDX_Inscription_matricule_visiteur` (`matricule_visiteur`);

--
-- Index pour la table `organisateur`
--
ALTER TABLE `organisateur`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_Organisateur_id_categorie` (`id_categorie`);

--
-- Index pour la table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `secteurformation`
--
ALTER TABLE `secteurformation`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `typeformation`
--
ALTER TABLE `typeformation`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`matricule`),
  ADD KEY `IDX_Utilisateur_id_role` (`id_role`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categorieorganisateur`
--
ALTER TABLE `categorieorganisateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `fonctionnalite`
--
ALTER TABLE `fonctionnalite`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `formation`
--
ALTER TABLE `formation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `organisateur`
--
ALTER TABLE `organisateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `secteurformation`
--
ALTER TABLE `secteurformation`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT pour la table `typeformation`
--
ALTER TABLE `typeformation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `formation`
--
ALTER TABLE `formation`
  ADD CONSTRAINT `FK_Formation_id_secteur_formation` FOREIGN KEY (`id_secteur_formation`) REFERENCES `secteurformation` (`id`),
  ADD CONSTRAINT `FK_Formation_id_type_formation` FOREIGN KEY (`id_type_formation`) REFERENCES `typeformation` (`id`),
  ADD CONSTRAINT `FK_Formation_id_organisateur` FOREIGN KEY (`id_organisateur`) REFERENCES `organisateur` (`id`);

--
-- Contraintes pour la table `habilitation`
--
ALTER TABLE `habilitation`
  ADD CONSTRAINT `FK_Habilitation_id_fonctionnalite` FOREIGN KEY (`id_fonctionnalite`) REFERENCES `fonctionnalite` (`id`),
  ADD CONSTRAINT `FK_Habilitation_id_role` FOREIGN KEY (`id_role`) REFERENCES `role` (`id`);

--
-- Contraintes pour la table `inscription`
--
ALTER TABLE `inscription`
  ADD CONSTRAINT `FK_Inscription_id_formation` FOREIGN KEY (`id_formation`) REFERENCES `formation` (`id`),
  ADD CONSTRAINT `FK_Inscription_matricule_visiteur` FOREIGN KEY (`matricule_visiteur`) REFERENCES `utilisateur` (`matricule`);

--
-- Contraintes pour la table `organisateur`
--
ALTER TABLE `organisateur`
  ADD CONSTRAINT `FK_Organisateur_id_categorie` FOREIGN KEY (`id_categorie`) REFERENCES `categorieorganisateur` (`id`);

--
-- Contraintes pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD CONSTRAINT `FK_Utilisateur_id_role` FOREIGN KEY (`id_role`) REFERENCES `role` (`id`);
COMMIT;
