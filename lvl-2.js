const canvas = document.querySelector("canvas");
const context = canvas.getContext('2d');

const boxSize = 25; // Ajustement pour l'exemple, ajustez selon la taille de votre canvas

key_game_check = false;

let PJ = [];
let obstacles = [];
let obstacles_immobiles = [];
let key_game = []
let door = []
let finish = []
let mob = []

const map = [
  [5, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 1, 0, 1, 0, 0, 0, 3],
  [1, 1, 1, 0, 1, 1, 1, 0, 1, 0, 1, 1, 0, 0, 0, 1, 1, 0, 1, 1],
  [0, 0, 0, 0, 0, 1, 1, 0, 1, 0, 1, 1, 0, 1, 0, 1, 1, 0, 1, 2],
  [0, 1, 1, 1, 0, 1, 0, 0, 1, 0, 3, 1, 0, 1, 0, 1, 0, 0, 1, 0],
  [1, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1, 0, 0, 1, 0],
  [1, 0, 1, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 1, 1, 0],
  [1, 0, 1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1, 1, 1, 0, 1, 0, 0],
  [0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 1, 0, 1],
  [0, 1, 1, 1, 0, 1, 1, 0, 0, 1, 1, 1, 1, 0, 0, 1, 0, 1, 0, 1],
  [0, 0, 0, 1, 0, 1, 0, 0, 0, 1, 1, 1, 1, 0, 0, 1, 1, 1, 0, 1],
  [0, 1, 1, 1, 0, 1, 0, 1, 1, 1, 0, 0, 1, 1, 0, 0, 0, 0, 0, 0],
  [0, 0, 1, 0, 0, 1, 0, 0, 0, 1, 0, 0, 0, 1, 1, 1, 1, 0, 1, 0],
  [0, 0, 1, 0, 0, 1, 1, 1, 1, 1, 0, 1, 0, 0, 0, 1, 1, 0, 1, 0],
  [0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 0, 0, 1, 0, 0, 1, 1],
  [0, 1, 1, 1, 0, 1, 1, 1, 1, 1, 1, 3, 1, 0, 0, 1, 1, 1, 1, 0],
  [0, 1, 1, 0, 0, 1, 0, 0, 0, 1, 1, 0, 1, 0, 0, 1, 0, 0, 0, 0],
  [0, 1, 1, 0, 1, 1, 1, 1, 0, 1, 1, 0, 1, 1, 1, 1, 1, 1, 1, 1],
  [0, 1, 1, 0, 1, 1, 0, 1, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 1, 0],
  [0, 1, 1, 0, 1, 1, 0, 1, 0, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0],
  [4, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1, 1, 1, 1, 0],
];


canvas.width = map[0].length * boxSize;
canvas.height = map.length * boxSize;

const image_personnage = new Image();
const image_door = new Image();
const image_bonus = new Image();
const image_key = new Image();
const image_door_open = new Image();

image_personnage.src = 'player.png'; // Assurez-vous que le chemin d'accès est correct
image_door.src = "door.png";
image_bonus.src = "star.png";
image_key.src = "key.png";
image_door_open.src = "door.png";


// Dessiner le labyrinthe et attribuer un identifiant unique à chaque clé
// Ajout d'un identifiant unique à chaque clé lors de la création de la carte
function drawMap() {
  for (let i = 0; i < map.length; i++) {
    for (let j = 0; j < map[i].length; j++) {
      switch (map[i][j]) {
        case 1:
          context.fillStyle = 'black'; // couleur des murs
          context.fillRect(j * boxSize, i * boxSize, boxSize, boxSize);
          break;
        case 2:
          door.push({
            x: j * boxSize,
            y: i * boxSize
          });
          break;
        case 3:
          key_game.push({
            id: 'key_' + i + '_' + j, // Utilisation de coordonnées pour créer un identifiant unique
            x: j * boxSize,
            y: i * boxSize
          });
          break;
        case 4:
          PJ.push({
            x: j * boxSize,
            y: i * boxSize
          });
          break;
        case 5:
          mob.push({
            x: j * boxSize,
            y: i * boxSize
          });
          break;
      }
    }
  }
}

function collectKey(collectedKey) {
  // Vérifier si la clé a déjà été collectée
  if (inventory.includes(collectedKey.id)) {
    // Si oui, afficher un message d'alerte et quitter la fonction
    alert("Vous avez déjà collecté cette clé !");
    return;
  }

  // Supprimer la clé du tableau key_game en utilisant son identifiant unique
  key_game = key_game.filter(key => key.id !== collectedKey.id);

  // Ajouter l'identifiant de la clé à l'inventaire du joueur
  inventory.push(collectedKey.id);

  function showAlert(message, duration) {
    alert(message);
    // Attendre le nombre de millisecondes spécifié avant de fermer l'alerte
    setTimeout(function(){
        // Fermer l'alerte
        alert.close();
    }, duration);
}

  // Afficher un message pop-up indiquant que le joueur a récupéré une clé
  showAlert("Vous venez de récupérer une clé", 3000);

  // Mettre à jour l'affichage du nombre de clés collectées
  updateInventoryDisplay();

  // Vérifier si le joueur a trois clés pour ouvrir la porte
  if (inventory.length >= 3) {
    openDoor();
  }

  redrawGame(); // Redessiner le jeu pour que la clé disparaisse
}


let inventory = []; // Inventaire du joueur

let keyIdCounter = 0; // Définir une variable pour générer des identifiants uniques pour les clés

let moveCount = 0; // Déclaration de la variable moveCount

let collectedBonuses = []; // Liste des bonus collectés

let secondsElapsed = 0; // Variable pour compter le nombre de secondes écoulées

function movePlayer(dx, dy) {
  let newX = PJ[0].x + dx;
  let newY = PJ[0].y + dy;

  // Vérifier si le prochain déplacement est à l'intérieur du canvas
  if (newX < 0 || newX >= canvas.width || newY < 0 || newY >= canvas.height) {
    return; // Ne rien faire si le déplacement sort du canvas
  }

  // Vérifier les collisions avec les murs
  if (checkCollision(newX, newY)) {
    return; // Si collision, ne pas effectuer le déplacement
  }

  // Incrémenter moveCount à chaque mouvement
  moveCount++;

  // Mettre à jour l'affichage du nombre de mouvements
  updateMoveCountDisplay();

  // Vérifier si le joueur collecte une clé
  for (let i = 0; i < key_game.length; i++) {
    const key = key_game[i];
    if (newX === key.x && newY === key.y) {
      collectKey(key);
      return; // Sortir de la fonction après avoir trouvé une clé
    }
  }

  // Vérifier si le joueur collecte un bonus
for (let i = 0; i < mob.length; i++) {
  const bonus = mob[i];
  if (newX === bonus.x && newY === bonus.y) {
    collectBonus(bonus);
    return; // Sortir de la fonction après avoir trouvé un bonus
  }
}

  // Mettre à jour la position du joueur
  PJ[0].x = newX;
  PJ[0].y = newY;

  // Redessiner le jeu avec la nouvelle position du joueur
  redrawGame();

  // Vérifier si le joueur a gagné
  checkWinCondition();
}


// Initialisation des obstacles
for (let i = 0; i < map.length; i++) {
  for (let j = 0; j < map[i].length; j++) {
    if (map[i][j] === 1) {
      obstacles.push({
        x: j * boxSize,
        y: i * boxSize
      });
    }
  }
}

// Vérifier les collisions avec les murs
function checkCollision(x, y) {
  for (let i = 0; i < obstacles.length; i++) {
    if (x === obstacles[i].x && y === obstacles[i].y) {
      return true; // Collision détectée
    }
  }
  return false; // Aucune collision
}

// Ouvrir la porte lorsque toutes les clés sont collectées
function openDoor() {
  // Changer l'image de la porte pour une porte ouverte
  context.clearRect(door[0].x, door[0].y, boxSize, boxSize); // Supprimer la porte fermée
  context.drawImage(image_door_open, door[0].x, door[0].y, boxSize, boxSize); // Dessiner la porte ouverte
}

// Dessiner les clés uniquement si elles sont dans le champ de vision du joueur
function drawKeys() {
  for (let i = 0; i < key_game.length; i++) {
    const key = key_game[i];
    // Vérifier si la clé n'a pas été collectée et si elle est dans le champ de vision du joueur
    if (!inventory.includes(key.id) && isInPlayerVision(key.x, key.y)) {
      context.drawImage(image_key, key.x, key.y, boxSize, boxSize);
    }
  }
}

// Dessiner la porte uniquement si elle est dans le champ de vision du joueur
function drawDoor() {
  // Vérifier si l'inventaire contient trois clés pour dessiner la porte
  if (inventory.length >= 3 && isInPlayerVision(door[0].x, door[0].y)) {
    context.drawImage(image_door, door[0].x, door[0].y, boxSize, boxSize);
  }
}

// Dessiner les bonus uniquement s'ils sont dans le champ de vision du joueur
function drawBonuses() {
  for (let i = 0; i < mob.length; i++) {
    const bonus = mob[i];
    // Vérifier si le bonus n'a pas été collecté et s'il est dans le champ de vision du joueur
    if (!collectedBonuses.includes(bonus) && isInPlayerVision(bonus.x, bonus.y)) {
      context.drawImage(image_bonus, bonus.x, bonus.y, boxSize, boxSize);
    }
  }
}

// Fonction pour vérifier si une position est dans le champ de vision du joueur
function isInPlayerVision(x, y) {
  // Calculer la distance entre la position et le joueur
  const distanceX = x - PJ[0].x;
  const distanceY = y - PJ[0].y;
  const distance = Math.sqrt(distanceX * distanceX + distanceY * distanceY);
  // Vérifier si la distance est inférieure au rayon du champ de vision (ici, boxSize * 2)
  return distance < boxSize * 2;
}


// Fonction pour redessiner le jeu avec le masque de vision
function redrawGame() {
  context.clearRect(0, 0, canvas.width, canvas.height);
  drawVisionMask(); // Dessiner le masque de vision
  drawMap();
  drawPlayer();
  drawKeys(); // Dessiner les clés à chaque fois
  drawDoor();
  drawBonuses();
}


// Dessiner le joueur avec un cercle autour
function drawPlayer() {
  // Dessiner le cercle gris
  context.beginPath();
  context.arc(PJ[0].x + boxSize / 2, PJ[0].y + boxSize / 2, boxSize / 2, 0, Math.PI * 2);
  context.fillStyle = 'rgba(128, 128, 128, 0.5)'; // Gris avec opacité
  context.fill();
  context.closePath();

  // Dessiner l'image du joueur par-dessus le cercle
  context.drawImage(image_personnage, PJ[0].x, PJ[0].y, boxSize, boxSize);
}

// Gérer les événements de déplacement du joueur
document.addEventListener('keydown', function (event) {
  switch (event.key) {
    case 'ArrowUp':
      movePlayer(0, -boxSize);
      break;
    case 'ArrowDown':
      movePlayer(0, boxSize);
      break;
    case 'ArrowLeft':
      movePlayer(-boxSize, 0);
      break;
    case 'ArrowRight':
      movePlayer(boxSize, 0);
      break;
  }

  // Mettre à jour l'affichage du nombre de mouvements après chaque mouvement
  updateMoveCountDisplay();
  // Vérifier si le joueur a gagné après chaque mouvement
  checkWinCondition();
});

// Initialisation du jeu
function init() {
  drawMap();
  drawVisionMask(); // Dessiner le masque de vision initial
  drawPlayer();
  updateInventoryDisplay(); // Mettre à jour l'affichage initial du nombre de clés
  updateMoveCountDisplay(); // Mettre à jour l'affichage du nombre de mouvements
}
// Appel de la fonction d'initialisation une fois que les images sont chargées
Promise.all([
  new Promise(resolve => image_personnage.onload = resolve),
  new Promise(resolve => image_door.onload = resolve),
  new Promise(resolve => image_bonus.onload = resolve),
  new Promise(resolve => image_key.onload = resolve)
]).then(init);



// Fonction pour vérifier si le joueur a gagné (collecté toutes les clés et atteint la porte de sortie)
function checkWinCondition() {
  if (inventory.length >= 3 && PJ[0].x === door[0].x && PJ[0].y === door[0].y) {
    // Ajouter l'expérience à l'utilisateur
    let timeRemaining = remainingTime;
    let xpEarned = 0;

    // Déterminer l'XP en fonction du temps restant
    if (timeRemaining > 50) {
      xpEarned = Math.min(30, 60); // Limiter à 60 XP maximum
    } else if (timeRemaining > 30) {
      xpEarned = Math.min(10, 60); // Limiter à 60 XP maximum
    } else if (timeRemaining > 20) {
      xpEarned = Math.min(5, 60); // Limiter à 60 XP maximum
    }

    if (xpEarned > 0) {
      manageExperience(xpEarned);
    }

    // Rediriger l'utilisateur vers la page victoire.php sans afficher de message
    window.location.href = 'victoire.php';
  }
}





// Mettre à jour l'affichage du nombre de clés dans l'inventaire
function updateInventoryDisplay() {
  document.getElementById('inventory').innerText = "Clés: " + inventory.length;
}

// Mettre à jour l'affichage du nombre de mouvements
function updateMoveCountDisplay() {
  document.getElementById('move-count').innerText = "Mouvements: " + moveCount;
}

// Fonction pour dessiner le masque noir sur toute la zone du canvas
function drawVisionMask() {
  context.fillStyle = 'black'; // Noir avec opacité totale
  context.fillRect(0, 0, canvas.width, canvas.height);

  // Dessiner un cercle transparent autour du personnage pour la vision
  context.globalCompositeOperation = 'destination-out'; // Pour créer un effet de masquage
  context.beginPath();
  context.arc(PJ[0].x + boxSize / 2, PJ[0].y + boxSize / 2, boxSize * 2, 0, Math.PI * 2);
  context.fill();
  context.closePath();
  context.globalCompositeOperation = 'source-over'; // Réinitialiser la composition
}


// Fonction pour collecter un bonus
function collectBonus(collectedBonus) {
  // Vérifier si le bonus a déjà été collecté
  if (collectedBonuses.includes(collectedBonus.id)) {
    // Si oui, afficher un message d'alerte et quitter la fonction
    alert("Vous avez déjà collecté ce bonus !");
    return;
  }
  // Ajouter le bonus à la liste des bonus collectés
  collectedBonuses.push(collectedBonus.id);

    // Ajouter du temps au décompte
    remainingTime += 10;

  // Afficher un message pop-up indiquant que le joueur a récupéré un bonus
  alert("Vous avez récupéré un bonus !");

  // Redessiner le jeu pour que le bonus disparaisse
  redrawGame();

    // Mettre à jour le décompte du temps
    updateCountdown();
}




let remainingTime = 80; // Temps restant en secondes

// Fonction pour mettre à jour le décompte du temps
function updateCountdown() {
  document.getElementById('countdown').innerText = "Temps restant: " + remainingTime + " secondes";
  remainingTime--; // Décrémenter le temps restant

  // Vérifier si le temps est écoulé
  if (remainingTime < 0) {
    clearInterval(countdownInterval); // Arrêter le décompte
    // Afficher la page de défaite
    window.location.href = 'défaite.php';
  }
}

// Démarrez le décompte du temps lors du chargement du jeu
const countdownInterval = setInterval(updateCountdown, 1000); // Mettre à jour le décompte chaque seconde

// Fonction pour gérer l'expérience du joueur en fonction du nombre de mouvements
function manageExperience(xpEarned) {
  // Envoi de l'XP à la base de données via une requête AJAX
  const xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function() {
    if (this.readyState === XMLHttpRequest.DONE) {
      if (this.status === 200) {
        // L'XP a été mise à jour avec succès
        console.log("XP mise à jour avec succès");
      } else {
        // Erreur lors de la mise à jour de l'XP
        console.error("Erreur lors de la mise à jour de l'XP");
      }
    }
  };
  
  // Préparation de la requête POST
  xhr.open("POST", "update_experience.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  // Envoi de l'XP à la base de données
  xhr.send("xp=" + xpEarned);
}

// Fonction pour gérer l'expérience du joueur en fonction du nombre de mouvements
function manageExperienceFromMoves(moveCount) {
  let xpEarned = 0;

  // Déterminer l'XP en fonction du nombre de mouvements
  if (moveCount < 150) {
    xpEarned = Math.min(30, 60); // Limiter à 60 XP maximum
  } else if (moveCount < 200) {
    xpEarned = Math.min(60 - xpEarned, 20); // Limiter à 60 XP maximum
  }

  if (xpEarned > 0) {
    // Appeler la fonction pour gérer l'expérience avec l'XP gagnée
    manageExperience(xpEarned);
  }
}
