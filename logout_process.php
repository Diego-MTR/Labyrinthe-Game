<?php
session_start(); // Démarre la session PHP

// Détruit toutes les données de la session
session_destroy();

// Redirige l'utilisateur vers la page de connexion après la déconnexion
header("Location: login.php");
exit;
?>
