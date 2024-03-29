<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page de défaite</title>
    <style>
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #222; 
    color: white;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.container {
    text-align: center;
}

h1 {
    color: #dc3545;
    font-size: 36px;
}

p {
    font-size: 20px;
    margin-bottom: 20px;
}

button {
    background-color: #dc3545;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    font-size: 18px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

button a {
    color: white;
    text-decoration: none;
}

button:hover {
    background-color: #c82333;
}

.fa {
    margin-right: 5px;
}

.icon {
    font-size: 24px;
    vertical-align: middle;
}

    </style>
</head>
<body>
    <div class="container">
        <h1>Oh non ! Vous avez perdu !</h1>
        <p>Dommage, vous n'avez pas réussi à sortir à temps. Réessayez !</p>
        <!-- Vous pouvez ajouter ici un lien vers la page d'accueil ou une autre page -->
        <button>
            <a href="lobby.php">Retour au lobby</a>
        </button>
    </div>
</body>
</html>
