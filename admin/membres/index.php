<?php

require_once '../../dbconnect.php';
require_once '../protect.php';

$req = $db->query('SELECT * FROM users');
$req->execute();
$users = $req->fetchAll();

$page = 'users';
$pageTitle = 'MNS Carpool — Membres';
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
      <div class="flex">
         <h2>Membres</h2>
         <a href="form.php" class="btn btn-secondary"><i class="fa-solid fa-plus fa-fw fa-sm"></i>Nouvel utilisateur</a>
      </div>
      <div class="container-fluid">
         <table>
            <thead>
               <tr>
                  <th>ID</th>
                  <th>Nom</th>
                  <th>Prénom</th>
                  <th>Nom d'utilisateur</th>
                  <th>Email</th>
                  <th>Groupe</th>
                  <th>Actions</th>
               </tr>
            </thead>
            <tbody>
               <?php foreach ($users as $user) { ?>
                  <tr>
                     <td><?= $user['id'] ?></td>
                     <td><?= $user['nom'] ?></td>
                     <td><?= $user['prenom'] ?></td>
                     <td><img src="<?= $user['userImg'] ?>" alt=""><?= $user['username'] ?></td>
                     <td><?= $user['email'] ?></td>
                     <td><?= $user['usergroup'] ?></td>
                     <td>
                        <a href="form.php?id=<?= $user['id'] ?>"><i class="fa-solid fa-edit"></i></a>
                        <a href="delete.php?id=<?= $user['id'] ?>"><i class="fa-solid fa-trash"></a></i>
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
      width: 20px;
      border-radius: 50%;
   }
</style>