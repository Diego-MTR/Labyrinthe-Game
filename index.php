<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Labyrinthe Game</title>
    <link rel="stylesheet" href="index.css">
    <!-- Ajout de la bibliothèque Boxicons -->
    <link href="https://unpkg.com/boxicons@2.1.0/css/boxicons.min.css" rel="stylesheet">
</head>

<body>

    <div class="container">
        <h1>Bienvenue dans Labyrinthe Time !</h1>
        <p>Pourriez-vous vous échapper en un temps record ?</p>
        <div class="rules">
    <h2>Règles du jeu :</h2>
    <ul>
        <li>- Vous devez récupérer <strong class="key">3 clés</strong> pour ouvrir la porte de sortie.</li>
        <li>- Vous devez vous échapper dans le temps imparti.</li>
        <li>- Un <strong class="bonus">bonus</strong> est disponible par niveau offrant des avantages.</li>
    </ul>
</div>

        <button onclick="startGame()">Commencer</button>
    </div>

    <?php if(isset($_SESSION['username'])): ?>
        <div class="container">
            <h1>Vos informations :</h1>
            <div class="info">
                <p>Profil de <?php echo $_SESSION['username']; ?></p>
                <p>Niveau : <?php echo $_SESSION['level_name']; ?></p>
                <p>Expérience : <?php echo $_SESSION['xp']; ?></p>
            </div>
            <!-- Ajoutez un événement onclick directement sur l'élément -->
            <a id="deconnexion" href="logout.php" onclick="return confirm('Êtes-vous sûr de vouloir vous déconnecter ?')">Se déconnecter</a>
        </div>

    <?php else: ?>
        <div class="container">
            <p>Veuillez vous connecter pour afficher vos informations.</p>
        </div>
    <?php endif; ?>


    <div class="user-info">
        <a href="login.php">
            <!-- Utilisation de l'icône de Boxicons -->
            <i class='bx bx-user icon-large'></i>
        </a>
    </div>

    <script>
        function startGame() {
            window.location.href = "lobby.php";
        }

        // Appeler la fonction updateExperience lorsque la page est chargée
        window.onload = function() {
            updateExperience();
        };

        // Fonction pour mettre à jour l'expérience utilisateur
        function updateExperience() {
            // Effectuer une requête AJAX au serveur pour récupérer les informations utilisateur mises à jour
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "get_user_info.php", true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    // Mettre à jour les éléments HTML avec les nouvelles données utilisateur
                    var userInfo = JSON.parse(xhr.responseText);
                    document.getElementById("userInfo").innerHTML = `
                        <p>Connecté en tant que : ${userInfo.username}</p>
                        <p>${userInfo.level_name}</p>
                        <p>${userInfo.xp} points d'expérience</p>
                    `;
                }
            };
            xhr.send();
        }
    </script>

</body>

</html>
