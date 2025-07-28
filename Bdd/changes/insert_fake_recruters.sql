-- Utiliser la base principale
USE skillswipe;

-- S'assurer que l'industrie ID=1 existe
INSERT INTO Industry (ID, Name)
VALUES (1, 'Informatique')
ON DUPLICATE KEY UPDATE Name = VALUES(Name);

-- Créer les entreprises (6 à 10)
INSERT INTO Company (ID, Name, Email, Phone_number, Address, Size, Website, Industry_ID)
VALUES 
(6, 'DataPulse', 'rh@datapulse.fr', '0606060606', '18 rue SQL, Paris', 60, 'https://datapulse.fr', 1),
(7, 'Reactify', 'jobs@reactify.fr', '0707070707', '77 avenue UI, Paris', 45, 'https://reactify.fr', 1),
(8, 'BackForce', 'contact@backforce.fr', '0808080808', '10 chemin Backend, Lyon', 80, 'https://backforce.fr', 1),
(9, 'StackNation', 'hr@stacknation.io', '0909090909', '100 boulevard Dev, Paris', 100, 'https://stacknation.io', 1),
(10, 'Webcraft', 'info@webcraft.io', '0111111111', '5 passage Design, Lyon', 35, 'https://webcraft.io', 1)
ON DUPLICATE KEY UPDATE Name = VALUES(Name);

-- Créer les utilisateurs recruteurs associés (506 à 510)
INSERT INTO User (ID, Name, Email, Password, User_type)
VALUES 
(506, 'DataPulse RH', 'rh@datapulse.fr', 'hashedpassword123!', 'recruteur'),
(507, 'Reactify RH', 'jobs@reactify.fr', 'hashedpassword123!', 'recruteur'),
(508, 'BackForce RH', 'contact@backforce.fr', 'hashedpassword123!', 'recruteur'),
(509, 'StackNation RH', 'hr@stacknation.io', 'hashedpassword123!', 'recruteur'),
(510, 'Webcraft RH', 'info@webcraft.io', 'hashedpassword123!', 'recruteur')
ON DUPLICATE KEY UPDATE Email = VALUES(Email);

-- Associer les recruteurs à leur entreprise
INSERT IGNORE INTO Recruiter (ID, Company_ID)
VALUES 
(506, 6),
(507, 7),
(508, 8),
(509, 9),
(510, 10);