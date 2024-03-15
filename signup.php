<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Création de compte</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="profile.css">
  <link href="https://unpkg.com/boxicons@2.1.0/css/boxicons.min.css" rel="stylesheet">
</head>

<body>
  <h1>Créer un compte</h1>
  <form id="signupForm" method="post">
    <div class="form-group">
      <label for="username">Nom d'utilisateur :</label>
      <input type="text" id="username" name="username" required>
    </div>
    <div class="form-group">
      <label for="password">Mot de passe :</label>
      <div class="password-input-container">
        <input type="password" id="password" name="password" required>
        <span class="toggle-password" onclick="togglePasswordVisibility()">
        </span>
      </div>
    </div>
    <button type="submit" name="FormulaireSend">Créer un compte</button>
    <p>Vous avez un compte ? <a href="login.php">Se Connecter</a>.</p>
  </form>

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
  require_once "connexion.php";

  if (isset($_POST["FormulaireSend"])) {
    // Récupération des données du formulaire
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Connexion à la base de données
    $db = Connexion::connect();
    if ($db) {
      // Vérification si l'utilisateur existe déjà
      $stmt = $db->prepare("SELECT COUNT(*) AS count FROM user WHERE username = :username");
      $stmt->bindParam(':username', $username);
      $stmt->execute();
      $result = $stmt->fetch(PDO::FETCH_ASSOC);
      if ($result['count'] > 0) {
        echo "Cet utilisateur existe déjà.";
        exit; // Arrête le script si l'utilisateur existe déjà
      }

      // Hachage du mot de passe
      $hashed_password = password_hash($password, PASSWORD_DEFAULT);

      // Insérer l'utilisateur dans la base de données
      $stmt = $db->prepare("INSERT INTO user (username, password) VALUES (:username, :password)");
      $stmt->bindParam(':username', $username);
      $stmt->bindParam(':password', $hashed_password);
      if ($stmt->execute()) {
        echo "Utilisateur enregistré avec succès!";
      } else {
        echo "Échec de l'enregistrement de l'utilisateur.";
      }
    } else {
      echo "Échec de la connexion à la base de données.";
    }
  }
  ?>

  <!-- Ajout de l'élément pour l'icône et le texte de connexion -->
  <div class="user-info">
    <a href="index.html">
      <!-- Utilisation de l'icône de Boxicons -->
      <i class='bx bx-home icon-large'></i>
    </a>
    <p class="user-name" id="user-display">Connecté en tant que : <span id="username"></span></p>
  </div>

  <script>
    function togglePasswordVisibility() {
      var passwordInput = document.getElementById("password");

      if (passwordInput.type === "password") {
        passwordInput.type = "text";
      } else {
        passwordInput.type = "password";
      }
    }

    // Fonction pour afficher le nom d'utilisateur après la connexion
    function showUsername(username) {
      document.querySelector('.user-name').style.display = 'block';
      document.getElementById('username').textContent = username;
    }
  </script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
</body>

</html>
