function updateLevel() {
    // Effectuer une requête AJAX pour récupérer le niveau de l'utilisateur
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "get_user_level.php", true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // Traiter la réponse et mettre à jour l'affichage du niveau sur la page
            var userLevel = xhr.responseText;
            document.getElementById("userLevel").innerText = userInfo;
        }
    };
    xhr.send();
}

// Appeler la fonction updateLevel toutes les 5 secondes (par exemple)
setInterval(updateLevel, 5000); // Mettre à jour toutes les 5 secondes (5000 millisecondes)

