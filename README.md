
## LAB 6 — Architecture en Couches (Controller / Service / DAO)

#### Cours : Ingénierie Logicielle Web avec PHP 7 : Architecture Multicouche et Accès aux Données Sécurisé


###  🎯 Objectif

Ce laboratoire a pour but de :

Appliquer une architecture en couches (Controller / Service / DAO)

Mettre en place des règles métier

Utiliser des DTO pour transporter les données

Gérer les erreurs avec des exceptions personnalisées

###  🏗️ Architecture

Le projet est structuré en plusieurs couches :
`````
project\
  src\
    Exception\
      BusinessException.php
    Dto\
      FiliereCreateDTO.php
      EtudiantCreateDTO.php
      EtudiantUpdateDTO.php
    Service\
      FiliereService.php
      EtudiantService.php
    Controller\
      Response.php
      AppController.php
    Container\
      AppFactory.php
    Dao\
      EtudiantDao.php         
  test\
    test_lab4.php
``````


### 🧪 Fonctionnalités testées

✅ Création d’une filière

Code obligatoire

Libellé obligatoire

Code max 16 caractères

Code transformé en majuscules

✅ Création d’un étudiant

CNE valide

Email valide

Filière existante

❌ Suppression d’une filière interdite

Impossible si des étudiants sont rattachés.

<img width="1366" height="606" alt="image" src="https://github.com/user-attachments/assets/3a1edb5e-f70f-42ed-a290-5cfd9caf0856" />


### ▶️ Exécution

Lancer Apache (XAMPP), puis ouvrir :

http://localhost/lab6/test/test_lab4.php
