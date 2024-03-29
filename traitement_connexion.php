<?php
session_start();
// Inclure le fichier de connexion à la base de données
include 'connexion.php';

// Définir les variables pour le message d'erreur
$error_message = "";

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer le nom d'utilisateur depuis le formulaire
    $username = $_POST["username"];

    // Récupérer le mot de passe depuis le formulaire
    $password = $_POST["password"];

    // Requête préparée pour sélectionner l'utilisateur par son nom d'utilisateur
    $sql_select_user = $conn->prepare("SELECT id, password, level_name, xp FROM users WHERE username = ?");
    $sql_select_user->bind_param("s", $username);
    $sql_select_user->execute();
    $result_select_user = $sql_select_user->get_result();

    if ($result_select_user->num_rows == 1) {
        // L'utilisateur existe, récupérer les informations
        $row = $result_select_user->fetch_assoc();
        $hashed_password = $row['password'];
        $level_name = $row['level_name'];
        $xp = $row['xp'];
        
        // Vérifier si le mot de passe correspond au hachage stocké
        if (password_verify($password, $hashed_password)) {
            // Le mot de passe est correct, définir les variables de session
            $_SESSION['username'] = $username;
            $_SESSION['level_name'] = $level_name;
            $_SESSION['xp'] = $xp;
            
            // Rediriger vers la page index.php
            header("Location: index.php");
            exit(); // Assure que le script s'arrête après la redirection
        } else {
            // Le mot de passe est incorrect, définir le message d'erreur
            $error_message = "Nom d'utilisateur ou mot de passe incorrect.";
        }
    } else {
        // L'utilisateur n'existe pas, définir le message d'erreur
        $error_message = "Nom d'utilisateur ou mot de passe incorrect.";
    }
    $sql_select_user->close(); // Fermer la requête préparée
} else {
    // Rediriger vers la page de connexion si le formulaire n'a pas été soumis
    header("Location: login.php");
    exit();
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
    <h1>Connexion échouée</h1>
    <div class="container">
        <h2>Erreur de Connexion</h2>
        <p class="error-message"><?php echo $error_message; ?></p>
        <p>Veuillez vérifier votre nom d'utilisateur et votre mot de passe, puis réessayez.</p>
        <p><a href="login.php">Retour à la page de connexion</a></p>
    </div>
</body>
</html>
