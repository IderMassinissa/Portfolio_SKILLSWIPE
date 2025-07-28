
USE skillswipe;

-- 1. LocalisationINSERT INTO Localisation (ID, Address_Name, Latitude, Longitude, AddressType) VALUES
(1, 'Paris', 48.852969, 2.349903, 'Utilisateur'),
(2, 'Brest', 48.383, -4.5, 'Utilisateur'),
(3, 'Quimper', 48.0, -4.1, 'Utilisateur'),
(4, '42 Rue de Lyon, Marseille', 43.296482, 5.36978, 'Utilisateur'),
(5, '18 Avenue Jean Jaurès, Toulouse', 43.604652, 1.444209, 'Utilisateur'),
(6, '5 Place Bellecour, Lyon', 45.757814, 4.832011, 'Utilisateur'),
(7, '10 Rue du Château, Strasbourg', 48.573405, 7.752111, 'Utilisateur'),
(8, '25 Boulevard Carnot, Lille', 50.62925, 3.057256, 'Utilisateur'),
(9, '3 Rue de l''Université, Dijon', 47.322047, 5.04148, 'Utilisateur'),
(10, '9 Rue Nationale, Tours', 47.394144, 0.68484, 'Utilisateur'),
(11, 'Bagneux', 48.7940862, 2.3012501, 'Utilisateur'),
(12, '7 Rue de la République, Avignon', 43.949317, 4.805528, 'Utilisateur'),
(13, '12 Allée des Tilleuls, Nantes', 47.218371, -1.553621, 'Utilisateur'),
(14, '8 Rue Sainte-Catherine, Bordeaux', 44.837789, -0.57918, 'Utilisateur'),
(15, '15 Avenue de Verdun, Nice', 43.710173, 7.261953, 'Utilisateur'),
(16, 'Place du Capitole, Toulouse', 43.6045, 1.444, 'Utilisateur'),
(17, 'Rue de l''Église, Saint-Malo', 48.649337, -2.025674, 'Utilisateur'),
(18, 'Place Stanislas, Nancy', 48.693722, 6.183409, 'Utilisateur'),
(19, 'Cours Mirabeau, Aix-en-Provence', 43.5263, 5.445429, 'Utilisateur'),
(20, 'Rue de la Barre, Rouen', 49.443231, 1.099971, 'Utilisateur'),
(21, 'Tour Total, Paris La Défense', 48.8919, 2.2419, 'Entreprise'),
(22, 'Capgemini, 11 Rue de Tilsitt, Paris', 48.8738, 2.295, 'Entreprise'),
(23, 'Airbus, Blagnac', 43.6293, 1.373, 'Entreprise'),
(24, 'Dassault Systèmes, Vélizy-Villacoublay', 48.783, 2.2151, 'Entreprise'),
(25, 'Ubisoft, Montreuil', 48.8591, 2.4397, 'Entreprise'),
(26, 'Orange Labs, Lannion', 48.7316, -3.4591, 'Entreprise'),
(27, 'SNCF, Campus R&D, Saint-Denis', 48.9326, 2.3577, 'Entreprise'),
(28, 'LVMH, 22 Av. Montaigne, Paris', 48.8665, 2.3073, 'Entreprise'),
(29, 'BNP Paribas, Bd des Italiens, Paris', 48.871, 2.3375, 'Entreprise'),
(30, 'Renault Technocentre, Guyancourt', 48.7804, 2.0722, 'Entreprise'),
(31, 'École Polytechnique, Palaiseau', 48.7132, 2.209, 'École'),
(32, 'HEC Paris, Jouy-en-Josas', 48.75, 2.1699, 'École'),
(33, 'Université de Strasbourg', 48.5839, 7.7639, 'École'),
(34, 'INSA Lyon, Villeurbanne', 45.784, 4.877, 'École'),
(35, 'Université de Lille', 50.609, 3.1403, 'École'),
(36, 'Université Grenoble Alpes', 45.19, 5.7721, 'École'),
(37, 'Sorbonne Université, Paris', 48.8462, 2.3449, 'École'),
(38, 'Université de Bordeaux', 44.8081, -0.6064, 'École'),
(39, 'EM Lyon Business School, Écully', 45.769, 4.773, 'École'),
(40, 'Université de Rennes 1', 48.1173, -1.6778, 'École'),
(41, 'ESIEA Paris, Ivry-sur-Seine', 48.814397, 2.388317, 'École');

-- 2. Utilisateurs simples

-- A RAJOUTER PLS

-- 3. Recruteurs et étudiants
INSERT INTO User (ID, Name, Email, Password, User_type) VALUES
(506, 'DataPulse RH', 'rh@datapulse.fr', 'hashedpassword123!', 'recruteur'),
(507, 'Reactify RH', 'jobs@reactify.fr', 'hashedpassword123!', 'recruteur'),
(508, 'BackForce RH', 'contact@backforce.fr', 'hashedpassword123!', 'recruteur'),
(509, 'StackNation RH', 'hr@stacknation.io', 'hashedpassword123!', 'recruteur'),
(510, 'Webcraft RH', 'info@webcraft.io', 'hashedpassword123!', 'recruteur'),
(511, 'Esiea RH', 'info@esiea.fr', 'hashedpassword123!', 'recruteur'),
(101, 'Lucas Moreau', 'lucas.moreau@example.com', 'hashedpassword123!', 'etudiant'),
(102, 'Sophie Lefèvre', 'sophie.lefevre@example.com', 'hashedpassword123!', 'etudiant'),
(103, 'Yanis Belkacem', 'yanis.belkacem@example.com', 'hashedpassword123!', 'etudiant'),
(104, 'Emma Dubois', 'emma.dubois@example.com', 'hashedpassword123!', 'etudiant'),
(105, 'Mehdi Karim', 'mehdi.karim@example.com', 'hashedpassword123!', 'etudiant'),
(106, 'Julie Tran', 'julie.tran@example.com', 'hashedpassword123!', 'etudiant'),
(107, 'Léo Martin', 'leo.martin@example.com', 'hashedpassword123!', 'etudiant'),
(108, 'Sarah Cohen', 'sarah.cohen@example.com', 'hashedpassword123!', 'etudiant');

-- 4. Secteurs d’activité
INSERT INTO Industry (ID, Name) VALUES
(1, 'Informatique'),
(2, 'Marketing'),
(3, 'Finance'),
(4, 'Éducation');

-- 5. Entreprises

INSERT INTO Company (Name, User_ID, Address_ID, Size, Website) VALUES
('DataPulse', 506, 36, 60, 'https://datapulse.fr'),
('Reactify', 507, 37, 45, 'https://reactify.fr'),
('BackForce', 508, 38, 80, 'https://backforce.fr'),
('StackNation', 509, 39, 100, 'https://stacknation.io'),
('Webcraft', 510, 40, 35, 'https://webcraft.io'),
('ESIEA', 511, 41, 2000, 'https://esiea.fr');

-- 6. Recruteurs liés
INSERT INTO Recruiter (ID, Company_ID) VALUES
(506, 1),
(509, 2),
(510, 3),
(511, 6);

-- 7. Matching
INSERT INTO Matching (Recruiter_ID, User_ID, Job_Offer_ID, Status) VALUES
(506, 1, NULL, 'active');

-- 8. Messages
INSERT INTO Message (Match_ID, Sender_ID, Receiver_ID, Content) VALUES
(1, 1, 506, 'Bonjour, intéressé par votre profil !'),
(1, 506, 1, 'Merci beaucoup ! Je suis curieux d’en savoir plus.'),
(1, 1, 506, 'jaimerai obtenir plus dinformation sur votre cv !');

INSERT INTO City (ID, Name) VALUES
-- Villes existantes
(1, 'Paris'),
(2, 'Lyon'),
(3, 'Marseille'),
(4, 'Brest'),
(5, 'Quimper'),
(6, 'Strasbourg'),
(7, 'Lille'),
(8, 'Dijon'),
(9, 'Tours'),
(10, 'Bagneux'),
(11, 'Avignon'),
(12, 'Nantes'),
(13, 'Bordeaux'),
(14, 'Nice'),
(15, 'Saint-Malo'),
(16, 'Nancy'),
(17, 'Aix-en-Provence'),
(18, 'Rouen'),
(19, 'La Défense'),
(20, 'Blagnac'),
(21, 'Vélizy-Villacoublay'),
(22, 'Montreuil'),
(23, 'Lannion'),
(24, 'Saint-Denis'),
(25, 'Écully'),
(26, 'Jouy-en-Josas'),
(27, 'Palaiseau'),
(28, 'Ivry-sur-Seine');

INSERT INTO Job_Description (ID, Description) VALUES 
(1, 'Stack : HTML, CSS, JS, PHP, MySQL.'),
(2, 'React front, UI/UX'),
(3, 'Back PHP 8'),
(4, 'React Native'),
(5, 'NodeJS/VueJS'),
(6, 'Développement d’applications web en collaboration avec l’équipe technique.'),
(7, 'Maintenance de systèmes informatiques et support utilisateur.'),
(8, 'Conception de campagnes marketing digitales.'),
(9, 'Analyse de données clients pour optimiser les ventes.'),
(10, 'Stage React Native + intégration continue.'),
(11, 'CDI DevOps Junior Docker/Kubernetes.'),
(12, 'CDI Angular + TypeScript.'),
(13, 'Alternance développement d’API REST.'),
(14, 'Stage création outil back Node.js.'),
(15, 'Fullstack Python/Flask & JS.');

INSERT INTO Contract (ID, Name) VALUES 
(1, 'alternance'),
(2, 'stage'),
(3, 'CDI'),
(4, 'freelance'),
(5, 'CDD');

INSERT INTO Work_Mode (ID, Name) VALUES 
(1, 'hybride'),
(2, 'présentiel'),
(3, 'remote');

INSERT INTO Job_Offer (Title, Job_Description_ID, Contract_ID, Work_Mode_ID, Company_ID, Recruiter_ID) VALUES
('Développeur Web Junior', 1, 1, 3, 1, 510),
('Technicien Support Informatique', 2, 2, 1, 1, 510),
('Assistant Marketing Digital', 3, 3, 2, 2, 509),
('Analyste Données', 4, 1, 3, 2, 506),
('Développeur Front-end React', 1, 4, 2, 3, 510),
('Chef de Projet Marketing', 3, 1, 1, 3, 509);

INSERT INTO Job_Offer (ID, Title, Job_Description_ID, Contract_ID, Work_Mode_ID, Company_ID, Recruiter_ID)
VALUES
(206, 'Stage Dév Web Junior PHP/MySQL', 6, 2, 1, 4, 510),
(207, 'CDI Dév Symfony Backend', 7, 3, 1, 4, 510),
(208, 'Alternance Fullstack Laravel + Vue', 8, 1, 1, 5, 509),
(209, 'Freelance Front React (3 mois)', 9, 4, 1, 5, 506),
(210, 'Stage React Native + DevOps', 10, 2, 1, 1, 506),
(211, 'CDI DevOps Junior', 11, 3, 1, 2, 506),
(212, 'CDI Front-End Angular', 12, 3, 1, 3, 510),
(213, 'Alternance API REST Symfony', 13, 1, 1, 4, 509),
(214, 'Stage Node.js Express', 14, 2, 1, 5, 506),
(215, 'CDI Fullstack Python + JS', 15, 3, 1, 1, 506);


-- Les autres blocs (Job_Description, Contract, Work_Mode, Job_Offer, City, Offer_Vector, User_Vector)
-- sont à compléter sur demande ou suite du message (car tronqués).

USE skillswipe_matching;

-- Ajout des vecteurs pour chaque utilisateur
INSERT INTO User_Vector (
  User_ID, p1, p2, p3, p4, p5, p6, p7, p8, p9, p10, p11, p12, p13, p14,
  p_lang_fr, p_lang_en, p_lang_es
) VALUES
(101, 0.7, 0.5, 0.3, 0.6, 0.5, 0.4, 0.3, 0.5, 0.9, 0.3, 0, 0, 0, 0.2, 1, 0, 0),
(102, 0.7, 0.6, 0.4, 0.5, 0.6, 0.3, 0.3, 0.5, 0.8, 0.3, 0, 0, 0, 0.2, 1, 0, 0),
(103, 0.7, 0.4, 0.5, 0.6, 0.4, 0.4, 0.2, 0.4, 0.9, 0.4, 0, 0, 0, 0.2, 1, 0, 0),
(104, 0.7, 0.5, 0.3, 0.6, 0.6, 0.4, 0.4, 0.5, 0.9, 0.4, 0, 0, 0, 0.3, 1, 0, 0),
(105, 0.6, 0.5, 0.4, 0.5, 0.5, 0.3, 0.3, 0.4, 0.8, 0.3, 0, 0, 0, 0.2, 1, 0, 0),
(106, 0.7, 0.6, 0.2, 0.6, 0.4, 0.4, 0.3, 0.5, 0.7, 0.4, 0, 0, 0, 0.3, 1, 0, 0),
(107, 0.8, 0.5, 0.3, 0.7, 0.6, 0.5, 0.4, 0.6, 0.9, 0.4, 0, 0, 0, 0.4, 1, 0, 0),
(108, 0.6, 0.4, 0.2, 0.5, 0.4, 0.3, 0.2, 0.4, 0.8, 0.3, 0, 0, 0, 0.2, 1, 0, 0);

INSERT INTO Offer_Vector (
  Offer_ID, v1, v2, v3, v4, v5, v6, v7, v8, v9, v10, v11, v12, v13, v14,
  v_lang_fr, v_lang_en, v_lang_es
) VALUES
(206, 0.6, 0.4, 0.2, 0.5, 0.4, 0.3, 0.3, 0.4, 0.7, 0.3, 0, 0, 0, 0.2, 1, 0, 0),
(207, 0.8, 0.6, 0.3, 0.7, 0.5, 0.4, 0.4, 0.5, 0.9, 0.5, 0, 0, 0, 0.4, 1, 0, 0),
(208, 0.7, 0.6, 0.4, 0.6, 0.5, 0.3, 0.4, 0.5, 0.8, 0.3, 0, 0, 0, 0.3, 1, 0, 0),
(209, 0.7, 0.5, 0.3, 0.6, 0.4, 0.3, 0.3, 0.4, 0.7, 0.2, 0, 0, 0, 0.2, 1, 0, 0),
(210, 0.6, 0.5, 0.4, 0.5, 0.5, 0.3, 0.4, 0.4, 0.8, 0.4, 0, 0, 0, 0.3, 1, 0, 0),
(211, 0.8, 0.7, 0.4, 0.6, 0.6, 0.4, 0.5, 0.5, 0.9, 0.4, 0, 0, 0, 0.4, 1, 0, 0),
(212, 0.7, 0.6, 0.3, 0.7, 0.6, 0.4, 0.3, 0.5, 0.8, 0.4, 0, 0, 0, 0.3, 1, 0, 0),
(213, 0.6, 0.5, 0.3, 0.6, 0.4, 0.4, 0.3, 0.4, 0.7, 0.3, 0, 0, 0, 0.3, 1, 0, 0),
(214, 0.6, 0.5, 0.3, 0.5, 0.4, 0.4, 0.2, 0.3, 0.7, 0.3, 0, 0, 0, 0.2, 1, 0, 0),
(215, 0.8, 0.6, 0.4, 0.7, 0.5, 0.4, 0.4, 0.5, 0.9, 0.5, 0, 0, 0, 0.4, 1, 0, 0)