<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Victoire !</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            background-color: #222;
            color: green;
            margin: 0;
            padding: 50px;
        }
        h1 {
            color: green;
        }
        p {
            font-size: 18px;
        }
        #redirectMessage {
            font-weight: bold;
            margin-top: 20px;
        }

    </style>
</head>
<body>
    <h1>Victoire !</h1>
    <p>Vous allez être redirigé vers le lobby dans quelques instants.</p>
    <p id="redirectMessage"></p>

    <script>
        // Redirection vers lobby.php après 10 secondes
        setTimeout(function() {
            window.location.href = 'lobby.php';
        }, 5000); // 5 secondes en millisecondes

        // Affichage du message de redirection
        var redirectMessage = document.getElementById('redirectMessage');
        var countdown = 5; // Secondes restantes avant redirection
        setInterval(function() {
            countdown--;
            redirectMessage.innerText = "Redirection dans " + countdown + " secondes...";
        }, 1000); // Mettre à jour toutes les secondes
    </script>
</body>
</html>
