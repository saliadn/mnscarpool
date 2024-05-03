<?php

require_once '../dbconnect.php';
require_once 'protect.php';
$page = 'dashboard';
$pageTitle = 'MNS Carpool — Dashboard';

$req = $db->query('SELECT count(*) AS total FROM users');
$req->execute();
$row = $req->fetch();
$userCount = $row['total'];
$req = $db->query('SELECT count(*) AS total FROM annonces');
$req->execute();
$row = $req->fetch();
$annoncesCount = $row['total'];

?>

<!DOCTYPE html>
<html lang="fr">
<head>
   <meta charset="UTF-8">
   <title><?= $pageTitle ?></title>
   <link rel="stylesheet" href="/assets/style/style.css">
   <link rel="stylesheet" href="/assets/style/admin.css">
</head>
<body>
   
   <?php include '../includes/header.php'; ?>

   <main class="dashboard">

      <?php include 'includes/navigation.php'; ?>

      <section class="admin-view">
         <h2> Dashboard</h2>
         <div class="container-fluid grid-3">
            <div class="card">
               <h4>Utilisateurs inscris</h4>
               <h2><?= $userCount ?></h2>
               <div class="icon bg-primary">
                  <i class="fa-solid fa-circle-user primary"></i>
               </div>
            </div>
            <div class="card">
               <h4>Annonces en ligne</h4>
               <h2><?= $annoncesCount ?></h2>
               <div class="icon bg-secondary">
                  <i class="fa-solid fa-car secondary"></i>
               </div>
            </div>
            <div class="card">
               <h4>Covoiturages effectués</h4>
               <h2><?= $annoncesCount ?></h2>
               <div class="icon bg-primary">
                  <i class="fa-solid fa-check primary"></i>
               </div>
            </div>
         </div>
      </section>
   </main>

   <script src="https://kit.fontawesome.com/d1a8ed5b5c.js" crossorigin="anonymous"></script>
</body>
</html>