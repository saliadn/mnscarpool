<?php
   require_once '../../dbconnect.php';
   require_once '../protect.php';
   $page = 'annonces';

   // creation de variable par default si pas de id dans l'url (GET)

   $userID = 0;
   $nom = "";
   $prenom = "";
   $username = "";
   $email = '';
   $usergroup = '';

   if(isset($_GET['id']) && $_GET['id'] > 0) {
      $req = $db->prepare('SELECT * FROM annonces WHERE id = :id');
      $req->execute([':id' => $_GET['id']]);
      $user = $req->fetch();
      if($user) {
         $userID = $user['id'];
         $nom = $user['nom'];
         $prenom = $user['prenom'];
         $username = $user['username'];
         $email = $user['email'];
         $usergroup = $user['usergroup'];
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

         <div class="container-fluid">

            <form action="traitement.php" method="post" class="<?php if(!isset($_GET['id'])){echo 'orange';} ?>">
               <h3><i class="fa-solid fa-circle-user"></i> Informations du compte</h3>

               <input type="hidden" name="userID" value="<?= $userID ?>">
               <input type="hidden" name="sent">
               
               <label for="nom">Nom</label>
               <input type="text" value="<?= $nom ?>" id="nom" name="nom">

               <label for="prenom">Prénom</label>
               <input type="text" value="<?= $prenom ?>" id="prenom" name="prenom">

               <label for="username">Nom d'utilisateur</label>
               <input type="text" value="<?= $username ?>" id="username" name="username">

               <label for="email">Email</label>
               <input type="email" value="<?= $email ?>" id="email" name="email">

               <label for="password">Mot de passe</label>
               <input type="text" value="" id="password" name="password">

               <label for="usergroup">Type du compte</label>
               <select name="usergroup" id="usergroup">
                  <option <?php if($usergroup == 'admin') { ?>selected<?php } ?> value="admin">Administrateur</option>
                  <option <?php if($usergroup == 'user') { ?>selected<?php } ?> value="user">Utilisateur</option>
               </select>
               <?php if(isset($_GET['id']) && $_GET['id'] > 0 ) { ?>
                  <input type="submit" value="Mettre à jour l'utilisateur" class="btn btn-primary">
                  <?php } else { ?>
                     <input type="submit" value="Créer le nouvel utilisateur" class="btn btn-secondary">
               <?php } ?>
            </form>
         </div>
      </section>

   </main>
   
   <script src="https://kit.fontawesome.com/d1a8ed5b5c.js" crossorigin="anonymous"></script>
</body>
</html>