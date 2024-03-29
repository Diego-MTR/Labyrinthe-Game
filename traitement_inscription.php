<?php
session_start();
// Inclure le fichier de connexion à la base de données
include 'connexion.php';

// Vérifier si le formulaire d'inscription a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les valeurs du formulaire
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Hasher le mot de passe
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Vérifier si l'utilisateur existe déjà
    $sql_check_user = "SELECT id FROM users WHERE username = '$username'";
    $result_check_user = $conn->query($sql_check_user);
    if ($result_check_user->num_rows > 0) {
        // L'utilisateur existe déjà, afficher un message d'erreur
        $error_message = "Ce nom d'utilisateur est déjà pris.";
    } else {
        // Récupérer le niveau initial de la table levels
        $level_name_initial = 'Niveau 1'; // Vous pouvez définir le niveau initial ici
        
        // Insérer les informations de l'utilisateur dans la table users
        $sql_insert_user = "INSERT INTO users (username, password, level_name, xp) VALUES ('$username', '$hashed_password', '$level_name_initial', 0)";
        if ($conn->query($sql_insert_user) === TRUE) {
            // Récupérer l'ID de l'utilisateur nouvellement inséré
            $user_id = $conn->insert_id;
            
            // Définir le niveau initial de l'utilisateur dans la table progress
            $sql_insert_progress = "INSERT INTO progress (id_user, id_level) VALUES ('$user_id', 1)";
            if ($conn->query($sql_insert_progress) === TRUE) {
                // Afficher un message de succès
                header("Location: login.php");
            } else {
                // Afficher un message d'erreur en cas d'échec de l'insertion dans la table progress
                echo "Erreur : " . $sql_insert_progress . "<br>" . $conn->error;
            }
        } else {
            // Afficher un message d'erreur en cas d'échec de l'insertion dans la table users
            echo "Erreur : " . $sql_insert_user . "<br>" . $conn->error;
        }
    }
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Erreur de Connexion</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #222; /* Couleur de fond de la page */
            margin: 0;
            padding: 0;
        }
        h1 {
        text-align: center;
        margin-top: 50px;
        color: white;
        }
        .container {
            max-width: 400px;
            margin: 100px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .error-message {
            color: #ff0000;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <h1>Inscription échouée</h1>
    <div class="container">
        <h2>Erreur lors de l'inscription</h2>
        <p class="error-message"><?php echo $error_message; ?></p>
        <p><a href="signin.php">Retour à la page d'inscription</a></p>
    </div>
</body>
</html>
