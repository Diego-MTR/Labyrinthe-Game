function confirmLogout() {
    // Afficher une boîte de dialogue de confirmation
    if (confirm("Êtes-vous sûr de vouloir vous déconnecter ?")) {
        // Si l'utilisateur clique sur "OK", rediriger vers la page de déconnexion
        window.location.href = "logout.php";
    } else {
        // Si l'utilisateur clique sur "Annuler", ne rien faire
        // Vous pouvez ajouter un message ou une action supplémentaire ici si nécessaire
    }
}
