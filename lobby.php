<?php
// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "labyrinthe";

$conn = new mysqli($servername, $username, $password, $dbname);

// Vérification de la connexion
if ($conn->connect_error) {
    die("La connexion a échoué : " . $conn->connect_error);
}

// Vérification de la session utilisateur
session_start();

// Si l'utilisateur n'est pas connecté, redirigez-le vers la page de connexion
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

// Récupération du niveau de l'utilisateur depuis la base de données
$username = $_SESSION['username'];
$sql = "SELECT level_name FROM users WHERE username='$username'";
$result = $conn->query($sql);

// Vérifier si la requête a retourné des résultats
if ($result->num_rows > 0) {
    // Récupération de la ligne de résultat
    $row = $result->fetch_assoc();
    $userLevel = $row['level_name'];
} else {
    // Gérer le cas où aucun résultat n'est retourné
    // Par exemple, définir une valeur par défaut pour $userLevel
    $userLevel = "Niveau par défaut";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Labyrinthe Game</title>
    <link rel="stylesheet" href="lobby.css">
    <link href="https://unpkg.com/boxicons@2.1.0/css/boxicons.min.css" rel="stylesheet">

</head>

<body>

<div class="user-info">
    <a href="index.php">
        <i class='bx bx-home icon-large'></i>
    </a>
</div>

<div class="container">
        <h4>Votre progression :</h4>
        <div class="info" id="userInfo">
        <p><?php echo $_SESSION['level_name']; ?></p>
        <p>Expérience : <?php echo $_SESSION['xp']; ?></p>
        </div>
    </div>


<h1>Sélection du niveau :</h1>
<div class="gallery">
    <?php
    // Récupération des niveaux depuis la base de données
    $sql = "SELECT * FROM levels";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Affichage des cartes de niveau
        while ($row = $result->fetch_assoc()) {
            $levelName = $row['level_name'];
            $levelId = $row['id_level'];
            // Vérification si le niveau est accessible pour l'utilisateur
            if ($userLevel == $levelName || $userLevel >= $levelName) {
                echo "<div class='card'>";
                echo "<a href='lvl-$levelId.html'>";
                echo "<img src='background$levelId.jpg' alt='Image $levelId'>";
                echo "<div class='card-content'>";
                echo "<h3>$levelName</h3>";
                echo "</a>";
                echo "</div>";
                echo "</div>";
            } else {
                // Si le niveau n'est pas accessible, afficher un cadenas
                echo "<div class='card'>";
                echo "<img src='background$levelId.jpg' alt='Image $levelId'>";
                echo "<img src='lock_icon.png'>";
                echo "<div class='card-content'>";
                echo "<h3>$levelName</h3>";
                echo "</div>";
                echo "<i class='lock-icon bx bx-lock-alt'></i>";
                echo "</div>";
            }
        }
    } else {
        echo "Aucun niveau disponible.";
    }
    ?>
</div>

</body>
<style>
    .container{
        margin-left:50px;
    }

</style>
</html>

<?php
// Fermer la connexion à la base de données
$conn->close();
?>
