<img width = auto height = auto src = labyrinthe.png>

**README - Projet de Création de Jeu Web - Labyrinthe Game**

---

### Description du Projet

Ce projet consiste en la création d'un jeu web interactif, mettant en scène un labyrinthe complexe situé dans des cavernes mystérieuses. L'objectif principal est de proposer aux joueurs une expérience immersive et divertissante tout en mettant en œuvre des fonctionnalités telles qu'une authentification utilisateur, un système de progression, et un tableau des meilleurs scores.

### Choix du Jeu de Labyrinthe

Le choix d'un jeu de labyrinthe, en particulier dans le contexte des cavernes, présente plusieurs avantages :

1. **Défi et Engagement**: Les labyrinthes offrent un défi intellectuel captivant pour les joueurs. Naviguer à travers des passages complexes et trouver la sortie stimule l'esprit de résolution de problèmes et maintient l'engagement.
   
2. **Thème Immersif**: Les cavernes offrent un cadre mystérieux et intrigant, invitant les joueurs à explorer et à découvrir ce qui se cache dans les profondeurs. Cela crée une ambiance immersive pour le jeu.

3. **Variété de Conception**: Les labyrinthes permettent une grande variété dans la conception des niveaux. Chaque niveau peut offrir une expérience unique, avec des défis différents et des éléments de gameplay variés.

### Charte Graphique

La charte graphique du projet est basée sur un thème sombre, inspiré des profondeurs des cavernes. Voici quelques éléments de conception qui justifient ce choix :

- **Palette de Couleurs**: Des tons sombres et profonds, comme le noir, le gris foncé et des nuances de brun, créent une atmosphère mystérieuse et immersive évoquant l'environnement des cavernes.
  
- **Textures et Effets**: Des textures rocheuses et des effets d'ombre sont utilisés pour recréer l'aspect rugueux et complexe des parois de la caverne. Cela renforce le sentiment d'exploration et d'aventure.


### Base de Données

Une base de données est mise en place pour gérer l'authentification des utilisateurs et leur progression dans le jeu, ainsi que pour maintenir un système de meilleurs scores. Voici comment elle est utilisée :

- **Authentification Utilisateur**: Les informations d'identification des utilisateurs sont stockées de manière sécurisée dans la base de données, permettant aux joueurs de se connecter et d'accéder à leur profil personnel.
  
- **Progression de l'Utilisateur**: Les données de progression, telles que les niveaux complétés et les réalisations débloquées, sont enregistrées dans la base de données pour chaque utilisateur. Cela permet de suivre la progression individuelle de chaque joueur.
  
- **Sauvegarde des Meilleurs Scores**: Les scores les plus élevés sont enregistrés dans la base de données et seront affichés dans un tableau des meilleurs scores. Cela encourage la compétition entre les joueurs et ajoute une dimension supplémentaire au jeu.


# Instructions pour le jeu du labyrinthe

Bienvenue dans le jeu du labyrinthe ! Ce README vous guidera à travers les étapes nécessaires pour installer et exécuter le jeu sur votre environnement local.

## 1. Exporter le code source

Tout d'abord, assurez-vous d'avoir le code source du jeu. Vous pouvez le télécharger à partir du dépôt Git ou l'extraire à partir de l'archive que vous avez.

## 2. Installer WampServer

Assurez-vous d'avoir installé WampServer sur votre système. WampServer est une plateforme de développement Web sous Windows qui vous permet d'exécuter localement des applications Web PHP.

Vous pouvez télécharger WampServer à partir de [wampserver.com](http://www.wampserver.com/).

Suivez les instructions d'installation fournies sur le site Web de WampServer.

## 3. Se connecter à phpMyAdmin

Une fois WampServer installé et en cours d'exécution, vous pouvez accéder à phpMyAdmin pour créer une base de données pour le jeu.

- Ouvrez votre navigateur Web.
- Accédez à l'URL suivante : [http://localhost/phpmyadmin/](http://localhost/phpmyadmin/)
- Connectez-vous avec les informations suivantes :
  - Nom d'utilisateur : `root`
  - Mot de passe : (laissez le champ vide par défaut)

## 4. Créer une base de données

Après vous être connecté à phpMyAdmin, suivez ces étapes pour créer une nouvelle base de données pour le jeu :

1. Cliquez sur l'onglet "Bases de données" dans le menu supérieur.
2. Dans le champ "Créer une base de données", saisissez le nom `labyrinthe`.
3. Cliquez sur le bouton "Créer".

## 5. Importer le schéma de base de données

Une fois la base de données créée, importez le schéma de base de données fourni avec le jeu. Vous devriez avoir un fichier SQL nommé `labyrinthe.sql`.

1. Dans phpMyAdmin, sélectionnez la base de données `labyrinthe` que vous venez de créer.
2. Cliquez sur l'onglet "Importer" dans le menu supérieur.
3. Sélectionnez le fichier `labyrinthe.sql` à partir de votre système de fichiers.
4. Cliquez sur le bouton "Exécuter" pour importer les tables et les données dans la base de données.

## 6. Exécuter le jeu

Après avoir suivi les étapes ci-dessus, vous êtes prêt à exécuter le jeu !

- Placez le code source du jeu dans le répertoire approprié de votre serveur Web local. Habituellement, il s'agit du répertoire `www` dans le répertoire d'installation de WampServer.
- Accédez à l'URL de votre jeu à partir de votre navigateur Web. Par exemple : [http://localhost/dossier/index.php](http://localhost/dossier/index.php)

Vous devriez maintenant être en mesure de jouer au jeu du labyrinthe sur votre propre environnement local !

---

Assurez-vous de personnaliser les chemins et les détails spécifiques à votre jeu dans les instructions ci-dessus.


