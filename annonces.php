<?php
   require_once 'dbconnect.php';
   $pageTitle = 'MNS Carpool — Annonces';

   if(!isset($_SESSION['userConnected']) && $_SESSION['userConnected'] != "xz#2") {
      header('Location: login.php');
   }

   $req = $db->query('SELECT * FROM annonces LEFT JOIN users ON annonces.user_id = users.id');
   $annonces = $req->fetchAll();
?>

<!-- <pre> -->
   <!-- <?php print_r($annonces); ?> -->
<!-- </pre> -->

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <link rel="stylesheet" href="assets/style/style.css">
   <title><?= $pageTitle ?></title>
</head>
<body>
   <?php include_once 'includes/header.php'; ?>

   <div class="container">
      <h2><span class="secondary">Annonces</span> de co-voiturage</h2>
   </div>
   <div class="container">
      <div class="liste-annonces">
         <?php foreach ($annonces as $annonce) { ?>
            <div class="annonce">
               <div>
                  <img src="<?= $annonce['userImg'] ?>" alt="Photo de profil de <?= $annonce['username'] ?>" class="profilePicture">
                  <div>
                     <h4>Coivoituré par :</h4>
                     <p><?= $annonce['nom'] . ' ' . $annonce['prenom'] ?></p>
                  </div>
               </div>
               <div>
                  <h4>Adresse de depart :</h4>
                  <span class="primary"><?= $annonce['adresse_depart'] ?></span>
               </div>
               <div>
                  <h4>Destination :</h4>
                  <span class="secondary"><?= $annonce['adresse_dest'] ?></span>
               </div>
               <div>
                  <h4>Heure de départ :</h4>
                  <p><?= $annonce['heure_depart'] ?></p>
               </div>
               <a href="etrepassager.php?id=<?= $annonce[0] ?>" class="btn btn-primary" style="text-align: center;">Je veux être passager</a>
            </div>
         <?php } ?>
      </div>
   </div>

   <script src="https://kit.fontawesome.com/d1a8ed5b5c.js" crossorigin="anonymous"></script>
</body>
</html>