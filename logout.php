<?php
// Démarrez ou reprenez la session
session_start();

// Détruire toutes les variables de session
$_SESSION = array();

// Détruire la session
session_destroy();

// Rediriger l'utilisateur vers la page de connexion après la déconnexion
header("Location: login.php");
exit();
?>
