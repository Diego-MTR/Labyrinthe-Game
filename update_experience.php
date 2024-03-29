<?php
// Démarrez la session PHP
session_start();

// Vérifiez si l'utilisateur est connecté en vérifiant s'il existe une variable de session pour l'username
if (isset($_SESSION['username'])) {
    // L'utilisateur est connecté, récupérez l'username de la session
    $username = $_SESSION['username'];
    
    // Vérifiez si la requête est une requête POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Récupérer les données POST envoyées par l'application JavaScript
        $xp = $_POST['xp']; // Récupérer l'expérience
      
        // Connexion à la base de données
        // Remplacez les valeurs 'localhost', 'nom_utilisateur', 'mot_de_passe' et 'nom_base_de_donnees'
        // par les valeurs appropriées pour votre configuration de base de données
        $conn = new mysqli('localhost', 'root', '', 'labyrinthe');
        
        // Vérifier la connexion
        if ($conn->connect_error) {
            // En cas d'erreur de connexion, envoyer une réponse JSON avec un message d'erreur
            $response = array("success" => false, "error" => "Erreur de connexion à la base de données : " . $conn->connect_error);
            echo json_encode($response);
        } else {
            // Préparer la requête SQL pour mettre à jour l'expérience de l'utilisateur
            $sql = "UPDATE users SET xp = xp + $xp WHERE username = '$username'";
            
            // Exécuter la requête SQL
            if ($conn->query($sql) === TRUE) {
                // Mettre à jour la variable de session avec la nouvelle valeur d'expérience
                $_SESSION['xp'] += $xp; // Ajouter la nouvelle valeur d'expérience à l'ancienne

                // Mettre à jour le niveau de l'utilisateur en fonction de l'expérience
                $level_name = getLevelName($_SESSION['xp']);
                $_SESSION['level_name'] = $level_name;

                // Mettre à jour le niveau de l'utilisateur dans la base de données
                $sql_update_level = "UPDATE users SET level_name = '$level_name' WHERE username = '$username'";
                $conn->query($sql_update_level);

                // Si la mise à jour a réussi, envoyer une réponse JSON avec un message de succès
                $response = array("success" => true, "message" => "L'XP et le niveau ont été mis à jour avec succès pour l'utilisateur $username.");
                echo json_encode($response);
            } else {
                // En cas d'erreur lors de l'exécution de la requête SQL, envoyer une réponse JSON avec un message d'erreur
                $response = array("success" => false, "error" => "Erreur lors de la mise à jour de l'XP : " . $conn->error);
                echo json_encode($response);
            }

            // Fermer la connexion à la base de données
            $conn->close();
        }
    } else {
        // Si la requête n'est pas une requête POST, renvoyer une erreur
        http_response_code(405); // Méthode non autorisée
        echo json_encode(array("success" => false, "error" => "Méthode non autorisée. Seules les requêtes POST sont autorisées."));
    }
} else {
    // Si l'utilisateur n'est pas connecté, renvoyez un message d'erreur JSON
    echo json_encode(array("success" => false, "error" => "L'utilisateur n'est pas connecté."));
}

// Fonction pour obtenir le niveau en fonction de l'expérience
function getLevelName($xp) {
    // Définir les seuils d'expérience pour chaque niveau
    $xpThresholds = array(
        10 => "Niveau 2",
        80 => "Niveau 3",
        130 => "Niveau 4",
        150 => "Niveau 5",
        200 => "Niveau 6"
    );

    // Parcourir les seuils d'expérience pour trouver le niveau correspondant à l'XP de l'utilisateur
    $level_name = "Niveau 1"; // Niveau par défaut
    foreach ($xpThresholds as $threshold => $name) {
        if ($xp >= $threshold) {
            $level_name = $name;
        } else {
            break; // Sortir de la boucle dès qu'on trouve le niveau correspondant
        }
    }
    return $level_name;
}
