<?php
session_start(); // Démarre la session PHP
if (!isset($_SESSION['username'])) {
    // Si l'utilisateur n'est pas connecté, redirigez-le vers la page de connexion
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Labyrinthe Game</title>
    <link href="https://unpkg.com/boxicons@2.1.0/css/boxicons.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #222; /* Couleur de fond de la page */
            color: #fff; /* Couleur du texte */
            margin: 0;
            padding: 0;
        }

        .container {
            text-align: center;
            margin-top: 100px; /* Espacement du haut */
        }

        h1 {
            font-size: 36px;
            margin-bottom: 20px;
        }

        p {
            font-size: 18px;
            margin-bottom: 30px;
        }

        /* Style pour le lien de déconnexion */
        .logout-button {
            padding: 10px 20px;
            font-size: 18px;
            background-color: #ff4444; /* Couleur de fond du bouton (rouge) */
            color: #fff; /* Couleur du texte du bouton */
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            text-decoration: none; /* Supprime le soulignement du lien */
        }

        /* Style pour le lien de déconnexion au survol */
        .logout-button:hover {
            background-color: #cc0000; /* Couleur de fond du bouton (rouge foncé) au survol */
        }
        /* Styles pour l'icône et le texte de connexion */
.user-info {
  position: fixed;
  top: 10px;
  right: 10px;
  display: flex;
  align-items: center;
  
  .user-name {
      font-size: 14px;
      margin: 0;
      display: none;
    }
    
    /* Styles pour agrandir l'icône */
    .icon-large {
        font-size: 40px; /* Ajustez la taille de l'icône selon vos préférences */
    }
    
/* Définition du style des liens */
a {
  color:#007bff;
  text-decoration: none; /* Supprimez le soulignement par défaut */
}

/* Définition du style des liens au survol */
a:hover {
    color: #00b324;
}
}

</style>
</head>
<body>
    <div class="container">
        <h1>Informations du compte :</h1>
        <p>Connecté en tant que : <?php echo $_SESSION['username']; ?></p>
        <a class="logout-button" href="logout_process.php">Déconnexion</a>
        <!-- Autres informations du compte -->
          <!-- Ajout de l'élément pour l'icône et le texte de connexion -->
  <div class="user-info">
    <a href="index.html">
      <!-- Utilisation de l'icône de Boxicons -->
      <i class='bx bx-home icon-large'></i>
    </a>
  </div>

    </div>
</body>
</html>
