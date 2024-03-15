<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Connexion</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="profile.css">
  <link href="https://unpkg.com/boxicons@2.1.0/css/boxicons.min.css" rel="stylesheet">
</head>

<body>
  <h1>Se Connecter</h1>
  <form id="loginForm" method="post">
    <div class="form-group">
      <label for="username">Nom d'utilisateur :</label>
      <input type="text" id="username" name="username" required>
    </div>
    <div class="form-group">
      <label for="password">Mot de passe :</label>
      <input type="password" id="password" name="password" required>
    </div>
    <button type="submit" name="loginSubmit">Se connecter</button>
    <p>Vous n'avez pas de compte ? <a href="signup.php">S'inscrire</a>.</p>
  </form>



  <!-- Ajout de l'élément pour l'icône et le texte de connexion -->
  <div class="user-info">
    <a href="index.html">
      <!-- Utilisation de l'icône de Boxicons -->
      <i class='bx bx-home icon-large'></i>
    </a>
    <p class="user-name" id="user-display">Connecté en tant que : <span id="username"></span></p>
  </div>


  <script>
    function startGame() {
      window.location.href = "lobby.html";
    }

    // Fonction pour afficher le nom d'utilisateur après la connexion
    function showUsername(username) {
      document.querySelector('.user-name').style.display = 'block';
      document.getElementById('username').textContent = username;
    }
  </script>

<?php
session_start(); // Démarre la session PHP

require_once "connexion.php";

if (isset($_POST["loginSubmit"])) {
    // Récupération des données du formulaire
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Connexion à la base de données
    $db = Connexion::connect();
    if ($db) {
        // Vérification si l'utilisateur existe et si le mot de passe est correct
        $stmt = $db->prepare("SELECT * FROM user WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user && password_verify($password, $user['password'])) {
            // Enregistrement des informations de l'utilisateur dans la session
            $_SESSION['username'] = $username;
            $_SESSION['user_id'] = $user['id']; // Supposons que votre table d'utilisateurs contient un champ 'id'
            
            // Redirection vers la page d'informations du compte
            header("Location: logout.php");
            exit;
        } else {
            echo "Nom d'utilisateur ou mot de passe incorrect.";
        }
    } else {
        echo "Échec de la connexion à la base de données.";
    }
}
?>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
</body>

</html>
