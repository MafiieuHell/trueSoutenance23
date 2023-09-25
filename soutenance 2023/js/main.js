'use strict';

// On déclare en haut de page nos variables globales (celles accessibles dans tout
// le code y compris les fonctions)

let canvas; // Objet pointant vers l'élément 'canvas'
let ctx; // Objet pointant vers le 'context2d'


// On défini les propriétés de notre jeu
let game = {
  width: 800, // Largeur de la zone de jeu
  height: 600, // Hauteur de la zone de jeu
  color: '#2bc38a', // Couleur de la zone de jeu,
  isGameOver: false, // Etat de la partie
  isPaused: false, // Etat de pause de la partie
};

// On défini les propriétés de notre balle
let ball = {
  x: 0, // Position horizontale
  y: 0, // Position verticale
  radius: 5, // Rayon
  directionY: -1, // Direction verticale
  directionX: 0, // Direction horizontale
  speed: 5, // Vitesse
  color: '#FF0000', // Couleur
};

// On défini les propriétés de la raquette du joueur
let player = {
  x: 0, // Position horizontale
  y: 0, // Position verticale
  width: 100, // Largeur
  height: 25, // Hauteur
  left: false, // Input gauche
  right: false, // Input droit
  speed: 5, // Vitesse
  color: '#FF0000', // Couleur
};

// On définit les propriétés de nos objets briques dans un tableau
let bricks = [{
    x: 200, // Position horizontale
    y: 300, // Position verticale
    width: 50, // Largeur
    height: 25, // Hauteur
    color: '#009688', // Couleur
  },
  {
    x: 250, // Position horizontale
    y: 300, // Position verticale
    width: 50, // Largeur
    height: 25, // Hauteur
    color: '#ffeb3b', // Couleur
  },
  {
    x: 300, // Position horizontale
    y: 300, // Position verticale
    width: 50, // Largeur
    height: 25, // Hauteur
    color: '#ff5722', // Couleur
  }
];

// Dès que le DOM est chargé on commence en appellant la fonction initGame
window.addEventListener('load', initGame);


// Initialisation du jeu
function initGame() {
  // Récupération du canvas et du context2d
  canvas = document.querySelector('canvas');
  ctx = canvas.getContext('2d');

  // On ajoute des écouteurs d'événements clavier
  window.addEventListener('keydown', onKeyDown);
  window.addEventListener('keyup', onKeyUp);

  // On donne une position de départ à la balle et à la raquette
  initialPositioning();

  // Lancement de la "boucle de jeu"
  requestAnimationFrame(gameLoop);
}

// Boucle de jeu (éxécutée à chaque 'frame' ~ 60 fois par seconde)
function gameLoop() {
  if (game.isGameOver || game.isPaused) {
    // Si la partie est terminée ou en pause, on sort de la fonction
    return;
  }
  // On efface tout le contenu du canvas
  ctx.clearRect(0, 0, game.width, game.height);

  // On dessine la zone de jeu
  drawGameZone();
  // On déplace la balle
  moveBall();
  //On déplace la raquette du joueur
  movePlayer();
  // On dessine la ball
  drawBall();
  // On dessine la raquette du joueur
  drawPlayer();
  // On dessine la brique
  drawBricks();
  // On detecte les collisions entre la balle et le joueur
  detectBallPlayerCollision();
  // On detecte les collisions entre la balle et la brique
  detectBallBricksCollision();


  // On relance la "boucle de jeu"
  requestAnimationFrame(gameLoop);
}

// On donne une position de départ à nos objets (balle et raquette)
function initialPositioning() {
  // On centre la raquette horizontalement dans la zone de jeu
  player.x = game.width / 2 - player.width / 2;
  // On place la raquette verticalement au bas de l'écran
  player.y = game.height - player.height;

  // On centre la balle horizontalement dans la zone de jeu
  ball.x = game.width / 2;
  // On place la balle verticalement juste au dessus de la raquette
  ball.y = player.y - ball.radius;
}

// On déplace la balle et on rebondit sur les bords
function moveBall() {
  // Déplacement
  ball.x += ball.directionX * ball.speed;
  ball.y += ball.directionY * ball.speed;

  // Rebond horizontal
  if (ball.x - ball.radius <= 0 || ball.x + ball.radius >= game.width) {
    ball.directionX *= -1;
  }
  // Rebond vertical
  if (ball.y - ball.radius <= 0) {
    ball.directionY *= -1;
  }
  // Fin de partie (la balle touche le bas de la zone de jeu)
  if (ball.y + ball.radius >= game.height) {
    gameOver();
  }
}

// On déplace la raquette du joueur si elle ne dépasse pas de la zone de jeu
function movePlayer() {
  // On déclare la variable qui contiendra la future position
  let futurPosition;

  if (player.left) {
    // Si l'input gauche est activé
    // On calcule la future position de la raquette
    futurPosition = player.x - player.speed;

    if (futurPosition > 0) {
      // Si la future position ne dépasse pas du bord gauche
      // On déplace la raquette
      player.x = futurPosition;
    } else {
      // Sinon (la future position dépasse du bord gauche)
      // On 'snap' la raquette au bord gauche de la zone de jeu
      player.x = 0;
    }
  }

  if (player.right) {
    // Si l'input droit est activé
    // On calcule la future position de la raquette
    futurPosition = player.x + player.speed;

    if (futurPosition + player.width < game.width) {
      // Si la future position (+ la largeur de la raquette) ne dépasse pas du bord droit
      // On déplace la raquette
      player.x = futurPosition;
    } else {
      // Sinon (la future position dépasse du bord droit)
      // On 'snap' la raquette au bord droit de la zone de jeu
      player.x = game.width - player.width;
    }
  }
}

// On dessine la zone de jeu
function drawGameZone() {
  ctx.fillStyle = game.color;
  ctx.fillRect(0, 0, game.width, game.height);
}

// On dessine la balle
function drawBall() {
  ctx.fillStyle = ball.color;
  ctx.beginPath();
  ctx.arc(ball.x, ball.y, ball.radius, 0, 2 * Math.PI);
  ctx.fill();
}

// On dessine la raquette du joueur
function drawPlayer() {
  ctx.fillStyle = player.color;
  ctx.fillRect(player.x, player.y, player.width, player.height);
}

// On dessine les briques
function drawBricks() {
  for (let i = 0; i < bricks.length; i++) {
    // On dessine la brique
    ctx.fillStyle = bricks[i].color;
    ctx.fillRect(bricks[i].x, bricks[i].y, bricks[i].width, bricks[i].height);
  }
}

// On écoute les appuis de touches gauche, droite et espace
// et on modifie la valeur de l'input correspondant à 'true' ou bien on bascule la pause
function onKeyDown(evt) {
  if (evt.code === 'ArrowLeft') {
    player.left = true;
  }
  if (evt.code === 'ArrowRight') {
    player.right = true;
  }
  if (evt.code === 'Space') {
    togglePause();
  }
}

// On écoute les relachements de touches gauche et droite
// et on modifie la valeur de l'input correspondant à 'false'
function onKeyUp(evt) {
  if (evt.code === 'ArrowLeft') {
    player.left = false;
  }
  if (evt.code === 'ArrowRight') {
    player.right = false;
  }
}

// On detecte une éventuelle collision entre la balle et le joueur
// et on fait rebondir la balle si il y a collision
function detectBallPlayerCollision() {
  if (detectBallCollision(player)) {
    // Si il y a collision...
    // On calcule le centre horizontale de la raquette du joueur
    let playerCenter = player.x + player.width / 2;
    // Puis on calcule la nouvelle direction horizontale de la balle par rapport
    // à la zone de collision sur la raquette, sous forme numérique allant de -1 à 1
    let zone = (ball.x - playerCenter) / (player.width / 2);
    // On inverse la direction verticale de la balle
    ball.directionY *= -1;
    // On modifie la direction horizontale de la balle
    ball.directionX = zone;
  }
}

// On detecte une éventuelle collision entre la balle et une des briques
// on fait rebondir la balle si il y a collision
// et on détruit la brique collisionnée
function detectBallBricksCollision() {
  for (let i = 0; i < bricks.length; i++) {
    let brick = bricks[i];
    if (detectBallCollision(brick)) {
      // Si il y a collision...
      // On inverse la direction verticale de la balle
      ball.directionY *= -1;
      // Et on supprime la brique du tableau
      bricks.splice(i, 1);
    }
  }
}

// On detecte une éventuelle collision entre la balle et la cible
function detectBallCollision(target) {
  if (ball.x - ball.radius < target.x + target.width &&
    ball.x + ball.radius > target.x &&
    ball.y - ball.radius < target.y + target.height &&
    ball.y + ball.radius > target.y) {
    // Si il y a collision...
    // On retourne 'true'
    return (true);
  }
  // Sinon on retourne 'false'
  return (false);
}

// On bascule la pause
function togglePause() {
  if (!game.isPaused) {
    // Si le jeu n'est pas en pause
    // On passe isPaused à true
    game.isPaused = true;
    // On dessine le texte 'Pause'
    ctx.font = 'bold 45px Verdana';
    ctx.fillStyle = '0xFF0000';
    let textWidth = ctx.measureText('Pause').width;
    let textHeight = 24;
    ctx.fillText('Pause', game.width / 2 - textWidth / 2, game.height / 2 - textHeight / 2);
  } else {
    // Sinon
    // On passe isPaused à false
    game.isPaused = false;
    // On relance la "boucle de jeu"
    requestAnimationFrame(gameLoop);
  }
}

//On termine la partie
function gameOver() {
  // On change l'état de la partie
  game.isGameOver = true;
  // On dessine le texte 'Game Over' sur l'écran
  ctx.font = 'bold 45px Verdana';
  ctx.fillStyle = '#FF0000';
  let textWidth = ctx.measureText('Game Over').width;
  let textHeight = 24;
  ctx.fillText('Game Over', game.width / 2 - textWidth / 2, game.height / 2 - textHeight / 2);
}