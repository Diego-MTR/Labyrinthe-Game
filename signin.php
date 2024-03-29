<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="profile.css">
    <link href="https://unpkg.com/boxicons@2.1.0/css/boxicons.min.css" rel="stylesheet">
    <title>Inscription</title>
</head>
<body>
    <div class="container">
        <h1>Inscription</h1>
        <form id="registrationForm" action="traitement_inscription.php" method="POST">
            <div class="form-group">
                <label for="username">Nom d'utilisateur :</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Mot de passe :</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="btn">S'inscrire</button>
            <p>Déjà inscrit ? <a href="login.php">Connectez-vous</a></p>
        </form>
    </div>

    <div class="user-info">
        <a href="index.php">
            <!-- Utilisation de l'icône de Boxicons -->
            <i class='bx bx-home icon-large'></i>
        </a>
    </div>

    <script>
        // Fonction pour afficher la boîte de dialogue après soumission du formulaire
        document.getElementById("registrationForm").addEventListener("submit", function(event) {
            event.preventDefault(); // Empêche le formulaire de se soumettre normalement

            // Afficher la boîte de dialogue de confirmation
            if (confirm("Êtes-vous sûr de vouloir vous inscrire ?")) {
                // Si l'utilisateur clique sur "OK", soumettre le formulaire
                this.submit();
            } else {
                // Sinon, ne rien faire
                return false;
            }
        });
    </script>
</body>
</html>
