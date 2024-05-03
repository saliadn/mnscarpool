<?php
require_once 'dbconnect.php';
$pageTitle = 'MNS Carpool — Accueil';

$req = $db->query('SELECT * FROM annonces RIGHT JOIN users ON annonces.user_id = users.id ORDER BY annonces.id DESC LIMIT 5');
$annonces = $req->fetchAll();
// var_dump($annonces); exit;

?>

<!DOCTYPE html>
<html lang="fr">
<head>
   <meta charset="UTF-8">
   <link rel="stylesheet" href="assets/style/style.css">
   <title><?= $pageTitle ?></title>
</head>
<body>
   <?php include_once 'includes/header.php'; ?>
   <header class="hero"></header>
   <div class="container">
      <?php if(isset($_SESSION['userConnected'])) { ?>
         <h2 class="center">Bienvenue sur MNS Carpool <span class="primary"><?= $_SESSION['prenom']; ?> ! 👋</span> Comment allez-vous aujourd'hui ?</h2>
      <?php } else { ?>
         <h2 class="center">Bienvenue, inscrivez-vous ou connectez-vous pour profitez pleinement de <span class="secondary">MNS Carpool !</span></h2>
      <?php } ?>
   </div>
   <div class="container grid-3">
      <div class="card">
         <h3>C'est gratuit ! 👋</h3>
         <hr>
         <p>Covoiturez gratuitement pour vous rendre dans les établissements de Metz Numeric School sans aucune comission.</p>
         <a href="annonces.php" class="btn btn-primary"><i class="fa-solid fa-car"></i>Voir les annonces</a>
      </div>
      <div class="card">
         <h3>Commencez dès-maintenant ! 😎</h3>
         <hr>
         <p>Vous avez une voiture et vous souhaitez proposer du covoiturage ?</p>
         <p>Publiez une annonce dès maintenant !</p>
         <a href="#" class="btn btn-primary"><i class="fa-solid fa-plus"></i>Publier une annonce</a>
      </div>
      <div class="card">
         <h3>Contactez-nous 👍🏼</h3>
         <hr>
         <p>Un problème, une suggestion ?</p>
         <p>N'hésitez pas à nous contacter, nous vous répondrons dans les prochaines 48h.</p>
         <a href="#" class="btn btn-secondary"><i class="fa-solid fa-paper-plane"></i>Nous contacter</a>
      </div>
   </div>
   <div class="container center">
      <h2>Voiçi les <span class="secondary">5 dernières</span> annonces publiées sur MNS Carpool</h2>
   </div>
   <div class="container">
      <div class="liste-annonces">
         <?php foreach ($annonces as $annonce) {
            $heureDepart = date_create($annonce['heure_depart']);    
         ?>
            <div class="annonce">
               <div>
                  <img src="<?= $annonce['userImg'] ?>" alt="Photo de profil de <?= $annonce['username'] ?>" class="profilePicture">
                  <div>
                     <h4>Proposé par</h4>
                     <p><i class="fa-solid fa-circle-user"></i> <?= $annonce['nom'] . ' ' . $annonce['prenom'] ?></p>
                  </div>
               </div>
               <div>
                  <h4>Adresse de depart</i></h4>
                  <span class="primary"><i class="fa-solid fa-car"></i> <?= $annonce['adresse_depart'] ?></span>
               </div>
               <div>
                  <h4>Destination</h4>
                  <span class="secondary"><i class="fa-solid fa-location-dot"></i> <?= $annonce['adresse_dest'] ?></span>
               </div>
               <div>
                  <h4>Heure de départ</h4>
                  <p><i class="fa-solid fa-clock"></i> <?= date_format($heureDepart, 'H:i') ?></p>
               </div>
               <a href="etrepassager.php?id=<?= $annonce[0] ?>" class="btn btn-primary" style="text-align: center;">Je veux être passager</a>
            </div>
         <?php } ?>
      </div>
   </div>
   <script src="https://kit.fontawesome.com/d1a8ed5b5c.js" crossorigin="anonymous"></script>
</body>
</html>