<?php
session_start();

// Vérifier si l'utilisateur est connecté et si ses informations sont disponibles dans la session
if (isset($_SESSION['username']) && isset($_SESSION['level_name']) && isset($_SESSION['xp'])) {
    // Construire un tableau avec les informations utilisateur
    $userInfo = array(
        "username" => $_SESSION['username'],
        "level_name" => $_SESSION['level_name'],
        "xp" => $_SESSION['xp']
    );
    // Renvoyer les informations utilisateur au format JSON
    echo json_encode($userInfo);
} else {
    // Si les informations utilisateur ne sont pas disponibles, renvoyer une réponse vide
    echo json_encode(array());
}
?>
