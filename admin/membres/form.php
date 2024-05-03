<?php
   require_once '../../dbconnect.php';
   require_once '../protect.php';
   $page = 'users';

   // creation de variable par default si pas de id dans l'url (GET)

   $userID = 0;
   $nom = '';
   $prenom = '';
   $username = '';
   $email = '';
   $usergroup = '';
   $norue = '';
   $adresse = '';
   $codePostal = '';
   $ville = '';

   if(isset($_GET['id']) && $_GET['id'] > 0) {
      // $req = $db->prepare('SELECT * FROM users WHERE id = :id');
      $req = $db->prepare('SELECT * FROM users LEFT JOIN adresses ON users.id = adresses.userID WHERE users.id = :id');
      $req->execute([':id' => $_GET['id']]);
      $user = $req->fetch();
      if($user) {
         $userID = $user['id'];
         $nom = $user['nom'];
         $prenom = $user['prenom'];
         $username = $user['username'];
         $email = $user['email'];
         $usergroup = $user['usergroup'];
         $norue = $user['no'];
         $adresse = $user['adresse'];
         $codePostal = $user['codepostal'];
         $ville = $user['ville'];
      }
   }
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <title><?php if($userID > 0){echo 'MNS Carpool - Modifier membre';} else {echo 'MNS Carpool — Créer membre';} ?></title>
   <link rel="stylesheet" href="/assets/style/style.css">
   <link rel="stylesheet" href="/assets/style/admin.css">
</head>
<body>

   <?php include '../../includes/header.php'; ?>
   
   <main class="dashboard">

      <?php include '../includes/navigation.php'; ?>

      <section class="admin-view">
         <?php if(isset($_GET['id']) && $_GET['id'] > 0) { ?> <!-- editing user -->
            <h2>Modifier l'utilisateur <span class="primary"><?= $username ?></span></h2>
         <?php } else { ?>
            <h2>Créer un nouvel utilisateur</h2> <!-- creating user text -->
         <?php } ?> 

         <div class="container-fluid grid-2">

            <form action="traitement.php" method="post" class="<?php if(!isset($_GET['id'])){echo 'orange';} ?>">
               <h3><i class="fa-solid fa-circle-user"></i> Informations du compte</h3>

               <input type="hidden" name="userID" value="<?= $userID ?>">
               <input type="hidden" name="sent">
               <br>
               <div class="floating">
                  <input type="text" value="<?= $nom ?>" id="nom" name="nom" required>
                  <label for="nom">Nom</label>
               </div>

               <div class="floating">
                  <input type="text" value="<?= $prenom ?>" id="prenom" name="prenom" required>
                  <label for="prenom">Prénom</label>
               </div>

               <div class="floating">
                  <input type="text" value="<?= $username ?>" id="username" name="username" required>
                  <label for="username">Nom d'utilisateur</label>
               </div>

               <div class="floating">
                  <input type="email" value="<?= $email ?>" id="email" name="email" required>
                  <label for="email">Email</label>
               </div>

               <div class="floating">
                  <input type="text" value="" id="password" name="password">
                  <label for="password">Mot de passe</label>
               </div>

               <select name="usergroup" id="usergroup">
                  <option value="0" disabled>Type du compte</option>
                  <option <?php if($usergroup == 'admin') { ?>selected<?php } ?> value="admin">Administrateur</option>
                  <option <?php if($usergroup == 'user') { ?>selected<?php } ?> value="user">Utilisateur</option>
               </select>
               
               <?php if(isset($_GET['id']) && $_GET['id'] > 0 ) { ?>
                  <input type="submit" value="Mettre à jour l'utilisateur" class="btn btn-primary">
                  <?php } else { ?>
                     <input type="submit" value="Créer le nouvel utilisateur" class="btn btn-secondary">
               <?php } ?>
            </form>

            <form action="traitement.php" method="post">

            <input type="hidden" name="adresseUpdated">
            <input type="hidden" name="userID" value="<?= $userID ?>">

               <h3><i class="fa-solid fa-location-dot"></i> Coordonnées</h3>
               <br>
               <div class="grid-3">
                  <div class="floating">
                     <input type="text" id="norue" name="norue" value="<?= $norue ?>" required>
                     <label for="norue">Numéro de rue</label>
                  </div>
                  <div class="floating">
                     <input type="text" id="adresse" name="adresse" value="<?= $adresse ?>" required>
                     <label for="adresse">Adresse</label>
                  </div>
                  <div class="floating">
                     <input type="text" id="codepostal" name="codepostal" value="<?= $codePostal ?>" required>
                     <label for="codepostal">Code postal</label>
                  </div>
               </div>
               <div class="floating">
                  <input type="text" id="ville" name="ville" value="<?= $ville ?>" required>
                  <label for="ville">Ville</label>
               </div>
               <input type="submit" value="Mettre à jour l'adresse" class="btn btn-primary">
            </form>
         </div>
      </section>

   </main>
   
   <script src="https://kit.fontawesome.com/d1a8ed5b5c.js" crossorigin="anonymous"></script>
</body>
</html>