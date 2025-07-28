-- Utiliser la base principale
USE skillswipe;

-- Création de faux comptes étudiants
INSERT INTO User (ID, Name, Email, Password, User_type)
VALUES 
(101, 'Lucas Moreau', 'lucas.moreau@example.com', 'hashedpassword123!', 'etudiant'),
(102, 'Sophie Lefèvre', 'sophie.lefevre@example.com', 'hashedpassword123!', 'etudiant'),
(103, 'Yanis Belkacem', 'yanis.belkacem@example.com', 'hashedpassword123!', 'etudiant'),
(104, 'Emma Dubois', 'emma.dubois@example.com', 'hashedpassword123!', 'etudiant'),
(105, 'Mehdi Karim', 'mehdi.karim@example.com', 'hashedpassword123!', 'etudiant'),
(106, 'Julie Tran', 'julie.tran@example.com', 'hashedpassword123!', 'etudiant'),
(107, 'Léo Martin', 'leo.martin@example.com', 'hashedpassword123!', 'etudiant'),
(108, 'Sarah Cohen', 'sarah.cohen@example.com', 'hashedpassword123!', 'etudiant');
(109, 'Massinissa Ider', 'massinissa.ider@example.com', 'hashedpassword123!', 'etudiant');

-- Ajout des lignes dans la table Student
INSERT INTO Student (ID) VALUES
(101), (102), (103), (104), (105), (106), (107), (108);

-- Ajout des compétences (si elles n'existent pas)
INSERT IGNORE INTO Skill (Name) VALUES 
('HTML'), ('CSS'), ('JAVASCRIPT'), ('PHP'), ('REACT'), ('SQL'), ('NODEJS'), ('FIGMA');

-- Association des compétences aux utilisateurs
INSERT INTO User_Skill (UserID, SkillID)
SELECT 101, ID FROM Skill WHERE Name = 'HTML';
INSERT INTO User_Skill (UserID, SkillID)
SELECT 101, ID FROM Skill WHERE Name = 'CSS';
INSERT INTO User_Skill (UserID, SkillID)
SELECT 102, ID FROM Skill WHERE Name = 'PHP';
INSERT INTO User_Skill (UserID, SkillID)
SELECT 103, ID FROM Skill WHERE Name = 'JAVASCRIPT';
INSERT INTO User_Skill (UserID, SkillID)
SELECT 104, ID FROM Skill WHERE Name = 'REACT';
INSERT INTO User_Skill (UserID, SkillID)
SELECT 105, ID FROM Skill WHERE Name = 'SQL';
INSERT INTO User_Skill (UserID, SkillID)
SELECT 106, ID FROM Skill WHERE Name = 'NODEJS';
INSERT INTO User_Skill (UserID, SkillID)
SELECT 107, ID FROM Skill WHERE Name = 'FIGMA';
INSERT INTO User_Skill (UserID, SkillID)
SELECT 108, ID FROM Skill WHERE Name = 'HTML';

-- Base des vecteurs
USE skillswipe_matching;

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