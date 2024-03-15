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

image_personnage.src = 'player.png'; // Assurez-vous que le chemin d'accès est correct
image_door.src = "door.png";
image_bonus.src = "star.png";
image_key.src = "key.png";


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

  // Afficher un message pop-up indiquant que le joueur a récupéré une clé
  alert("Vous venez de récupérer une clé");

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

let timerInterval; // Variable pour stocker l'identifiant du timer

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


  // Démarrer le timer uniquement si c'est le premier mouvement du joueur
  if (moveCount === 1) {
    startTimer();
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

// Dessiner les clés
function drawKeys() {
  for (let i = 0; i < key_game.length; i++) {
    const key = key_game[i];
    // Vérifier si la clé n'a pas été collectée en utilisant son identifiant unique
    if (!inventory.includes(key.id)) {
      context.drawImage(image_key, key.x, key.y, boxSize, boxSize);
    }
  }
}

// Dessiner la porte
function drawDoor() {
  // Vérifier si l'inventaire contient trois clés pour dessiner la porte
  if (inventory.length >= 3) {
    context.drawImage(image_door, door[0].x, door[0].y, boxSize, boxSize);
  }
}

// Dessiner les bonus
function drawBonuses() {
  for (let i = 0; i < mob.length; i++) {
    const bonus = mob[i];
    // Vérifier si le bonus n'a pas été collecté
    if (!collectedBonuses.includes(bonus)) {
      context.drawImage(image_bonus, bonus.x, bonus.y, boxSize, boxSize);
    }
  }
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


// Vérifier si le joueur a gagné (collecté toutes les clés et atteint la porte de sortie)
function checkWinCondition() {
  if (inventory.length >= 3 && PJ[0].x === door[0].x && PJ[0].y === door[0].y) {
    // Afficher le message de fin
    alert("Félicitations ! Vous avez terminé le jeu !");
    window.location.href = "lvl-2.html";
    stopTimer(); // Arrêter le timer lorsque le joueur termine le jeu
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

// Fonction pour démarrer le timer
function startTimer() {
  timerInterval = setInterval(updateTimer, 1000); // Mettre à jour le timer toutes les secondes (1000 ms)
}

// Fonction pour mettre à jour le timer
function updateTimer() {
  secondsElapsed++;
  document.getElementById('timer').innerText = "Temps écoulé: " + secondsElapsed + " secondes";
}

// Fonction pour arrêter le timer
function stopTimer() {
  clearInterval(timerInterval);
}

// Fonction pour collecter un bonus
function collectBonus(collectedBonus) {
  // Vérifier si le bonus a déjà été collecté
  if (collectedBonuses.includes(collectedBonus.id)) {
    // Si oui, afficher un message d'alerte et quitter la fonction
    alert("Vous avez déjà collecté ce bonus !");
    return;
  }

  // Réduire le temps de 10 secondes
  secondsElapsed -= 10;

  // Vérifier si le temps écoulé est négatif
  if (secondsElapsed < 0) {
    secondsElapsed = 0; // Assurer que le temps écoulé ne devienne pas négatif
  }

  // Ajouter le bonus à la liste des bonus collectés
  collectedBonuses.push(collectedBonus.id);

  // Afficher un message pop-up indiquant que le joueur a récupéré un bonus
  alert("Vous avez récupéré un bonus ! Le temps est réduit de 10 secondes.");

  // Mettre à jour l'affichage du temps écoulé
  updateTimer();

  // Redessiner le jeu pour que le bonus disparaisse
  redrawGame();
}