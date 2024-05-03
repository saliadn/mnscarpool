<?php
   require_once 'dbconnect.php';
   $pageTitle = 'MNS Carpool — Annonces';

   if(!isset($_SESSION['userConnected']) && $_SESSION['userConnected'] != "xz#2") {
      header('Location: login.php');
   }
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <link rel="stylesheet" href="assets/style/style.css">
   <title><?= $pageTitle ?></title>
</head>
<body>
   <?php include_once 'includes/header.php'; ?>

   <div class="container grid-2">
      <div class="center">
         <h2>Faire du covoiturage n'a jamais été aussi simple.</h2>
         <img src="/assets/img/illustration.png" alt="">
         <p>Publiez votre annonce dès maitenant !</p>
      </div>
      <div>
         
      </div>
   </div>

   <script src="https://kit.fontawesome.com/d1a8ed5b5c.js" crossorigin="anonymous"></script>
</body>
</html>

<style scoped>
   .container img {
      width: 70%;
   }
   .container div:first-child {
      background: white;
      padding: 15px;
      border-radius: 10px;
   }
</style>