DROP DATABASE IF EXISTS skillswipe_matching; 

CREATE DATABASE IF NOT EXISTS skillswipe_matching;
USE skillswipe_matching;

-- Création des vecteurs de profil pour les utilisateurs
CREATE TABLE User_Vector (
  User_ID     INT PRIMARY KEY,
  p1          FLOAT      NOT NULL DEFAULT 0,  -- Type de contrat
  p2          FLOAT      NOT NULL DEFAULT 0,  -- Mode de travail
  p3          FLOAT      NOT NULL DEFAULT 0,  -- Distance
  p4          FLOAT      NOT NULL DEFAULT 0,  -- Hard skills
  p5          FLOAT      NOT NULL DEFAULT 0,  -- Soft skills
  p6          FLOAT      NOT NULL DEFAULT 0,  -- Expérience
  p7          FLOAT      NOT NULL DEFAULT 0,  -- Secteur / Industrie
  p8          FLOAT      NOT NULL DEFAULT 0,  -- Niveau d’étude
  p9          FLOAT      NOT NULL DEFAULT 0,  -- Disponibilité
  p10         FLOAT      NOT NULL DEFAULT 0,  -- Rémunération cible
  p11         FLOAT      NOT NULL DEFAULT 0,  -- Historique de likes
  p12         FLOAT      NOT NULL DEFAULT 0,  -- Engagement implicite (clic)
  p13         FLOAT      NOT NULL DEFAULT 0,  -- Dwell time (temps passé)
  p14         FLOAT      NOT NULL DEFAULT 0,  -- Poids global du profil
  p_lang_fr   TINYINT(1) NOT NULL DEFAULT 0,  -- Langue préférée : français
  p_lang_en   TINYINT(1) NOT NULL DEFAULT 0,  -- Langue préférée : anglais
  p_lang_es   TINYINT(1) NOT NULL DEFAULT 0   -- Langue préférée : espagnol
);

-- Création des vecteurs de caractéristiques des offres
CREATE TABLE Offer_Vector (
  Offer_ID    INT PRIMARY KEY,
  v1          FLOAT      NOT NULL DEFAULT 0,  -- Type de contrat
  v2          FLOAT      NOT NULL DEFAULT 0,  -- Mode de travail
  v3          FLOAT      NOT NULL DEFAULT 0,  -- Distance
  v4          FLOAT      NOT NULL DEFAULT 0,  -- Hard skills
  v5          FLOAT      NOT NULL DEFAULT 0,  -- Soft skills
  v6          FLOAT      NOT NULL DEFAULT 0,  -- Expérience
  v7          FLOAT      NOT NULL DEFAULT 0,  -- Secteur / Industrie
  v8          FLOAT      NOT NULL DEFAULT 0,  -- Niveau d’étude
  v9          FLOAT      NOT NULL DEFAULT 0,  -- Disponibilité
  v10         FLOAT      NOT NULL DEFAULT 0,  -- Rémunération cible
  v11         FLOAT      NOT NULL DEFAULT 0,  -- Historique de likes
  v12         FLOAT      NOT NULL DEFAULT 0,  -- Engagement implicite (clic)
  v13         FLOAT      NOT NULL DEFAULT 0,  -- Dwell time (temps passé)
  v14         FLOAT      NOT NULL DEFAULT 0,  -- Poids global du profil
  v_lang_fr   TINYINT(1) NOT NULL DEFAULT 0,  -- Offre en français
  v_lang_en   TINYINT(1) NOT NULL DEFAULT 0,  -- Offre en anglais
  v_lang_es   TINYINT(1) NOT NULL DEFAULT 0   -- Offre en espagnol
);