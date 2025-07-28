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

-- Descriptions de poste
INSERT INTO Job_Description (ID, Description) VALUES 
(1, 'Stack : HTML, CSS, JS, PHP, MySQL.'),
(2, 'React front, UI/UX'),
(3, 'Back PHP 8'),
(4, 'React Native'),
(5, 'NodeJS/VueJS')
ON DUPLICATE KEY UPDATE Description = VALUES(Description);

-- Ajouter l'industrie (obligatoire pour la contrainte étrangère)
INSERT INTO Industry (ID, Name)
VALUES (1, 'Informatique')
ON DUPLICATE KEY UPDATE Name = 'Informatique';

-- 1. Créer des entreprises supplémentaires
INSERT INTO Company (ID, Name, Email, Phone_number, Address, Size, Website, Industry_ID)
VALUES 
(6, 'DataPulse', 'rh@datapulse.fr', '0606060606', '18 rue SQL, Paris', 60, 'https://datapulse.fr', 1),
(7, 'Reactify', 'jobs@reactify.fr', '0707070707', '77 avenue UI, Paris', 45, 'https://reactify.fr', 1),
(8, 'BackForce', 'contact@backforce.fr', '0808080808', '10 chemin Backend, Lyon', 80, 'https://backforce.fr', 1),
(9, 'StackNation', 'hr@stacknation.io', '0909090909', '100 boulevard Dev, Paris', 100, 'https://stacknation.io', 1),
(10, 'Webcraft', 'info@webcraft.io', '0111111111', '5 passage Design, Lyon', 35, 'https://webcraft.io', 1);

-- 2. Recruteurs associés
INSERT INTO User (ID, Name, Email, Password, User_type)
VALUES 
(506, 'DataPulse RH', 'rh@datapulse.fr', 'hashedpassword123!', 'recruteur'),
(507, 'Reactify RH', 'jobs@reactify.fr', 'hashedpassword123!', 'recruteur'),
(508, 'BackForce RH', 'contact@backforce.fr', 'hashedpassword123!', 'recruteur'),
(509, 'StackNation RH', 'hr@stacknation.io', 'hashedpassword123!', 'recruteur'),
(510, 'Webcraft RH', 'info@webcraft.io', 'hashedpassword123!', 'recruteur');

INSERT INTO Recruiter (ID, Company_ID)
VALUES 
(506, 6),
(507, 7),
(508, 8),
(509, 9),
(510, 10);

-- 3. Ajouter types de contrats et modes de travail (si pas déjà présents)
INSERT INTO Contract (ID, Name) VALUES 
(4, 'freelance')
ON DUPLICATE KEY UPDATE Name = 'freelance';

-- 4. Ajouter des descriptions de poste
INSERT INTO Job_Description (ID, Description)
VALUES 
(6, 'Stage découverte PHP/MySQL.'),
(7, 'CDI développeur Symfony confirmé.'),
(8, 'Alternance Dev Fullstack Laravel/Vue.'),
(9, 'Freelance front-end mission 3 mois.'),
(10, 'Stage React Native + intégration continue.'),
(11, 'CDI DevOps Junior Docker/Kubernetes.'),
(12, 'CDI Angular + TypeScript.'),
(13, 'Alternance développement d’API REST.'),
(14, 'Stage création outil back Node.js.'),
(15, 'Fullstack Python/Flask & JS.')
ON DUPLICATE KEY UPDATE Description = VALUES(Description);

-- Industrie
INSERT INTO Industry (ID, Name)
VALUES (1, 'Informatique')
ON DUPLICATE KEY UPDATE Name = VALUES(Name);

-- Entreprises
INSERT INTO Company (ID, Name, Email, Phone_number, Address, Size, Website, Industry_ID)
VALUES 
(6, 'DataPulse', 'rh@datapulse.fr', '0606060606', '18 rue SQL, Paris', 60, 'https://datapulse.fr', 1),
(7, 'Reactify', 'jobs@reactify.fr', '0707070707', '77 avenue UI, Paris', 45, 'https://reactify.fr', 1),
(8, 'BackForce', 'contact@backforce.fr', '0808080808', '10 chemin Backend, Lyon', 80, 'https://backforce.fr', 1),
(9, 'StackNation', 'hr@stacknation.io', '0909090909', '100 boulevard Dev, Paris', 100, 'https://stacknation.io', 1),
(10, 'Webcraft', 'info@webcraft.io', '0111111111', '5 passage Design, Lyon', 35, 'https://webcraft.io', 1)
ON DUPLICATE KEY UPDATE Email = VALUES(Email), Name = VALUES(Name);

-- Recruteurs
INSERT INTO User (ID, Name, Email, Password, User_type)
VALUES 
(506, 'DataPulse RH', 'rh@datapulse.fr', 'hashedpassword123!', 'recruteur'),
(507, 'Reactify RH', 'jobs@reactify.fr', 'hashedpassword123!', 'recruteur'),
(508, 'BackForce RH', 'contact@backforce.fr', 'hashedpassword123!', 'recruteur'),
(509, 'StackNation RH', 'hr@stacknation.io', 'hashedpassword123!', 'recruteur'),
(510, 'Webcraft RH', 'info@webcraft.io', 'hashedpassword123!', 'recruteur')
ON DUPLICATE KEY UPDATE Email = VALUES(Email);

-- Lier recruteurs à leur entreprise
INSERT INTO Recruiter (ID, Company_ID)
VALUES 
(506, 6),
(507, 7),
(508, 8),
(509, 9),
(510, 10)
ON DUPLICATE KEY UPDATE Company_ID = VALUES(Company_ID);

-- Offres
INSERT INTO Job_Offer (ID, Title, Job_Description_ID, Contract_ID, Work_Mode_ID, Company_ID, Recruiter_ID)
VALUES
(206, 'Stage Dév Web Junior PHP/MySQL', 6, 2, 1, 6, 506),
(207, 'CDI Dév Symfony Backend', 7, 3, 1, 7, 507),
(208, 'Alternance Fullstack Laravel + Vue', 8, 1, 1, 8, 508),
(209, 'Freelance Front React (3 mois)', 9, 4, 1, 9, 509),
(210, 'Stage React Native + DevOps', 10, 2, 1, 10, 510),
(211, 'CDI DevOps Junior', 11, 3, 1, 6, 506),
(212, 'CDI Front-End Angular', 12, 3, 1, 7, 507),
(213, 'Alternance API REST Symfony', 13, 1, 1, 8, 508),
(214, 'Stage Node.js Express', 14, 2, 1, 9, 509),
(215, 'CDI Fullstack Python + JS', 15, 3, 1, 10, 510)
ON DUPLICATE KEY UPDATE Title = VALUES(Title);

-- === SWITCH BASE VECTORIELLE ===
USE skillswipe_matching;

-- Vecteurs
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
ON DUPLICATE KEY UPDATE v1 = VALUES(v1);
