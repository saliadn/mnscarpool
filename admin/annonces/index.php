<?php

require_once '../../dbconnect.php';
require_once '../protect.php';

$req = $db->query('SELECT * FROM annonces LEFT JOIN users ON annonces.userID = users.id');
$req->execute();
$annonces = $req->fetchAll();

$page = 'annonces';
$pageTitle = 'MNS Carpool — Admin Annonces';
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <title><?= $pageTitle ?></title>
   <link rel="stylesheet" href="/assets/style/style.css">
   <link rel="stylesheet" href="/assets/style/admin.css">
</head>
<body>
   <?php include '../../includes/header.php'; ?>

   <main class="dashboard">

   <?php include '../includes/navigation.php'; ?>

   <section class="admin-view">
      <h2>Annonces actuellement en ligne</h2>
      <div class="container-fluid">
         <table>
            <thead>
               <tr>
                  <th>ID</th>
                  <th>Auteur</th>
                  <th>Adresse de départ</th>
                  <th>Destination</th>
                  <th>Heure</th>
                  <th>Actions</th>
               </tr>
            </thead>
            <tbody>
               <?php foreach ($annonces as $annonce) {
               $heure = date_create($annonce['heureDepart']);
               ?>
                  <tr>
                     <td><?= $annonce['annonceID'] ?></td>
                     <td class="img"><img src="<?= $annonce['userImg'] ?>" alt="Profile Picture"><?= $annonce['username'] ?></td>
                     <td><?= $annonce['adresseDepart'] ?></td>
                     <td><?= $annonce['adresseDestination'] ?></td>
                     <td><?= date_format($heure, 'H:i') ?></td>
                     <td>
                        <a href="form.php?id=<?= $annonce['annonceID'] ?>"><i class="fa-solid fa-edit"></i></a>
                        <a href="delete.php?id=<?= $annonce['annonceID'] ?>"><i class="fa-solid fa-trash"></a></i>
                     </td>
                  </tr>
               <?php } ?>
            </tbody>
         </table>
      </div>
   </section>

   </main>

   <script src="https://kit.fontawesome.com/d1a8ed5b5c.js" crossorigin="anonymous"></script>
</body>
</html>

<style scoped>
   td img {
      padding: 0;
      margin: 0;
      width: 20px;
      border-radius: 50%;
   }
   .img {
      display: flex;
      align-items: center;
      justify-content: start;
      gap: .3em;
   }
</style>