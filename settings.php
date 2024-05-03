<?php

require_once 'dbconnect.php';

if(!isset($_SESSION['userId'])) {
   header('Location: login.php');
}

$pageTitle = 'MNS Carpool — Mon compte';

$req = $db->prepare('SELECT * FROM users WHERE id = :id');
$req->execute([':id' => $_SESSION['userId']]);
$user = $req->fetch();

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <link rel="stylesheet" href="assets/style/style.css">
   <title><?= $pageTitle; ?></title>
</head>
<body>
   <?php include_once 'includes/header.php' ?>
   <div class="container">
      <h2>Paramètres de mon compte</h2>
      <div class="grid-2">
         <form action="settings.php" method="post">
         
            <h3><i class="fa-solid fa-circle-user fa-fw"></i> Mes informations</h3>
            <label for="nom">Nom</label>
            <input type="text" name="username" value="<?= $user['nom']; ?>" id="nom" disabled>
         
            <label for="prenom">Prénom</label>
            <input type="text" name="prenom" value="<?= $user['prenom']; ?>" id="prenom" disabled>

            <label for="username">Nom d'utilisateur</label>
            <input type="text" name="username" value="<?= $user['username']; ?>" id="username" disabled>
            
            <label for="email">Email</label>
            <input type="text" name="email" value="<?= $user['email']; ?>" id="email" disabled>
         
         </form>
         <form action="settings.php" method="post">
            <h3><i class="fa-solid fa-lock fa-fw"></i> Changer de mot de passe</h3>
            <label for="oldpassword">Ancien mot de passe</label>
            <input type="password" name="oldpassword" id="oldpassword">
            <label for="password">Nouveau mot de passe</label>
            <input type="password" name="password" id="password">
            <label for="confirm_password">Confirmez votre nouveau mot de passe</label>
            <input type="password" name="confirm_password" id="confirm_password">
            <input type="submit" value="Mettre à jour mon mot de passe" class="btn btn-primary">
         </form>
         <form action="settings.php" method="post">
            <h3><i class="fa-solid fa-location-dot fa-fw"></i> Mon adresse</h3>
            <div class="grid-3">
               <input type="number" name="no" placeholder="N° de rue">
               <input type="text" name="adresse" placeholder="Adresse">
               <input type="number" name="codepostal" id="codepostal" placeholder="Code postal">
            </div>

            <input type="submit" value="Mettre à jour mon adresse" class="btn btn-primary">
         </form>
      </div>
   </div>
   
   <script src="https://kit.fontawesome.com/d1a8ed5b5c.js" crossorigin="anonymous"></script>
</body>
</html>

