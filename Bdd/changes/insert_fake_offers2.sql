-- Sélectionner la bonne base
USE skillswipe;

-- Types de contrat
INSERT INTO Contract (ID, Name) VALUES 
(1, 'alternance'),
(2, 'stage'),
(3, 'CDI'),
(4, 'freelance')
ON DUPLICATE KEY UPDATE Name = VALUES(Name);

-- Modes de travail
INSERT INTO Work_Mode (ID, Name) VALUES 
(1, 'hybride'),
(2, 'présentiel'),
(3, 'remote')
ON DUPLICATE KEY UPDATE Name = VALUES(Name);

-- Descriptions de poste (hors informatique)
INSERT INTO Job_Description (ID, Description) VALUES 
(101, 'Stage en réception hôtelière 4 étoiles, accueil client, gestion réservations.'),
(102, 'CDI Assistant marketing digital dans le secteur cosmétique.'),
(103, 'Alternance Comptabilité, gestion facturation et logiciels comptables.'),
(104, 'Freelance en rédaction SEO pour un média culturel en ligne.'),
(105, 'Stage assistant ressources humaines, participation aux entretiens.'),
(106, 'CDI Infirmier en clinique privée.'),
(107, 'Stage communication interne dans un groupe industriel.'),
(108, 'Alternance Gestionnaire paie et administration RH.'),
(109, 'CDI Chef de rang en restauration haut de gamme.'),
(110, 'Freelance traducteur anglais/français pour contenu marketing.')
ON DUPLICATE KEY UPDATE Description = VALUES(Description);

-- Nouvelle industrie : Services
INSERT INTO Industry (ID, Name)
VALUES (2, 'Services')
ON DUPLICATE KEY UPDATE Name = VALUES(Name);

-- Entreprises dans d’autres secteurs
INSERT INTO Company (ID, Name, Email, Phone_number, Address, Size, Website, Industry_ID)
VALUES 
(20, 'Hôtel Lumière', 'contact@lumierehotel.fr', '0101010101', '12 avenue de la Paix, Lyon', 45, 'https://lumierehotel.fr', 2),
(21, 'BeautyCorp', 'hr@beautycorp.com', '0202020202', '15 rue des Cosmétiques, Paris', 120, 'https://beautycorp.com', 2),
(22, 'ComptaFlex', 'jobs@comptaflex.fr', '0303030303', '88 rue des Comptables, Marseille', 30, 'https://comptaflex.fr', 2),
(23, 'HumanKey', 'recrutement@humankey.fr', '0404040404', '101 rue RH, Lille', 75, 'https://humankey.fr', 2),
(24, 'MediSanté', 'emploi@medisante.fr', '0505050505', '66 boulevard Santé, Toulouse', 200, 'https://medisante.fr', 2)
ON DUPLICATE KEY UPDATE Email = VALUES(Email), Name = VALUES(Name);

-- Recruteurs
INSERT INTO User (ID, Name, Email, Password, User_type)
VALUES 
(601, 'Lumière RH', 'contact@lumierehotel.fr', 'hashedpassword123!', 'recruteur'),
(602, 'BeautyCorp RH', 'hr@beautycorp.com', 'hashedpassword123!', 'recruteur'),
(603, 'ComptaFlex RH', 'jobs@comptaflex.fr', 'hashedpassword123!', 'recruteur'),
(604, 'HumanKey RH', 'recrutement@humankey.fr', 'hashedpassword123!', 'recruteur'),
(605, 'MediSanté RH', 'emploi@medisante.fr', 'hashedpassword123!', 'recruteur')
ON DUPLICATE KEY UPDATE Email = VALUES(Email);

-- Associer recruteurs aux entreprises
INSERT INTO Recruiter (ID, Company_ID)
VALUES 
(601, 20),
(602, 21),
(603, 22),
(604, 23),
(605, 24)
ON DUPLICATE KEY UPDATE Company_ID = VALUES(Company_ID);

-- Offres hors informatique
INSERT INTO Job_Offer (ID, Title, Job_Description_ID, Contract_ID, Work_Mode_ID, Company_ID, Recruiter_ID)
VALUES
(301, 'Stage Réception Hôtel 4*', 101, 2, 2, 20, 601),
(302, 'Assistant Marketing Cosmétique', 102, 3, 1, 21, 602),
(303, 'Alternance Comptable Junior', 103, 1, 2, 22, 603),
(304, 'Rédacteur SEO Freelance', 104, 4, 3, 23, 604),
(305, 'Stage Assistant RH', 105, 2, 1, 23, 604),
(306, 'Infirmier CDI en Clinique', 106, 3, 2, 24, 605),
(307, 'Stage Communication Interne', 107, 2, 1, 21, 602),
(308, 'Alternance Gestion Paie RH', 108, 1, 1, 23, 604),
(309, 'CDI Chef de Rang', 109, 3, 2, 20, 601),
(310, 'Freelance Traducteur Marketing', 110, 4, 3, 21, 602)
ON DUPLICATE KEY UPDATE Title = VALUES(Title);

-- === BASE VECTORIELLE ===
USE skillswipe_matching;

INSERT INTO Offer_Vector (
  Offer_ID, v1, v2, v3, v4, v5, v6, v7, v8, v9, v10, v11, v12, v13, v14,
  v_lang_fr, v_lang_en, v_lang_es
) VALUES
(301, 0.6, 0.4, 0.3, 0.5, 0.4, 0.2, 0.3, 0.4, 0.6, 0.2, 0, 0, 0, 0.2, 1, 0, 0),
(302, 0.7, 0.5, 0.4, 0.6, 0.5, 0.4, 0.3, 0.5, 0.7, 0.3, 0, 0, 0, 0.3, 1, 0, 0),
(303, 0.6, 0.6, 0.3, 0.5, 0.5, 0.3, 0.4, 0.3, 0.6, 0.2, 0, 0, 0, 0.2, 1, 0, 0),
(304, 0.5, 0.3, 0.4, 0.5, 0.4, 0.3, 0.3, 0.4, 0.5, 0.2, 0, 0, 0, 0.3, 1, 0, 0),
(305, 0.6, 0.4, 0.3, 0.4, 0.4, 0.2, 0.4, 0.3, 0.6, 0.3, 0, 0, 0, 0.3, 1, 0, 0),
(306, 0.7, 0.6, 0.5, 0.6, 0.6, 0.4, 0.5, 0.4, 0.8, 0.4, 0, 0, 0, 0.4, 1, 0, 0),
(307, 0.6, 0.4, 0.3, 0.5, 0.5, 0.3, 0.4, 0.4, 0.6, 0.3, 0, 0, 0, 0.2, 1, 0, 0),
(308, 0.6, 0.5, 0.4, 0.5, 0.5, 0.4, 0.4, 0.4, 0.7, 0.3, 0, 0, 0, 0.3, 1, 0, 0),
(309, 0.7, 0.5, 0.4, 0.6, 0.5, 0.3, 0.5, 0.4, 0.7, 0.3, 0, 0, 0, 0.2, 1, 0, 0),
(310, 0.6, 0.4, 0.3, 0.5, 0.4, 0.3, 0.3, 0.4, 0.6, 0.3, 0, 0, 0, 0.3, 1, 0, 0)
ON DUPLICATE KEY UPDATE v1 = VALUES(v1);