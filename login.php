<?php
session_start();

// Vérifier si l'utilisateur est déjà connecté
if (isset($_SESSION['username'])) {
  // Rediriger vers la page d'accueil si l'utilisateur est déjà connecté
  header("Location: index.php");
  exit(); // Assure que le script s'arrête après la redirection
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="profile.css">
    <link href="https://unpkg.com/boxicons@2.1.0/css/boxicons.min.css" rel="stylesheet">
    <title>Connexion</title>
    <!-- Ajoutez vos styles CSS ici -->
    <style>
    </style>
</head>
<body>
    <div class="container">
        <h1>Connexion</h1>
        <form action="traitement_connexion.php" method="POST">
            <div class="form-group">
                <label for="username">Nom d'utilisateur :</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Mot de passe :</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="btn">Se connecter</button>
            <p>Pas encore inscrit ? <a href="signin.php">Inscrivez-vous</a></p>
        </form>
    </div>
    <div class="user-info">
        <a href="index.php">
            <!-- Utilisation de l'icône de Boxicons -->
            <i class='bx bx-home icon-large'></i>
        </a>
    </div>
</body>
</html>
