<?php

require_once 'dbconnect.php';
$pageTitle = 'MNS Carpool — Connexion';

if(isset($_POST['username']) && $_POST['username'] != '' && isset($_POST['password']) && $_POST['password'] != '') {
   $req = $db->prepare('SELECT * FROM users WHERE username = :username');
   $req->execute([':username' => $_POST['username']]);
   if($user = $req->fetch()) {
      if(password_verify($_POST['password'], $user['password'])) {
         $_SESSION['userId'] = $user['id'];
         $_SESSION['username'] = $user['username'];
         $_SESSION['nom'] = $user['nom'];
         $_SESSION['prenom'] = $user['prenom'];
         $_SESSION['email'] = $user['email'];
         $_SESSION['usergroup'] = $user['usergroup'];
         $_SESSION['userConnected'] = 'xz#2';
         header('Location: index.php');
         exit();
      }
   }
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
   <?php require_once 'includes/header.php'; ?>
   <article class="login-page">
      <section class="login-page__left">
         <h2>Connexion <span class="primary">MNS Carpool</span></h2>
         <form action="login.php" method="post">

            <div class="floating">
               <input type="text" name="username" id="username" required>
               <label for="username">Nom d'utilisateur</label>
            </div>

            <div class="floating">
               <input type="password" name="password" id="password" required>
               <label for="password">Mot de passe</label>
            </div>

            <!-- <input type="submit" value="Se connecter" class="btn btn-primary"> -->
            <button class="anim-btn">Se connecter</button>

            <?php if (isset($_POST['username'])) { ?>
               <section class="login-error">
                  Identifiants incorrect.<br>
                  <a href="passwordreset.php">Mot de passe oublié</a>
               </section>
               
            <?php } ?>
         </form>
      </section>
      <section class="login-page__right">
         <div class="informations">
            <img src="/assets/img/illustration.png" alt="CarPool Illustration">
            <p>Vous n'avez pas encore de compte ?</p>
            <p><strong class="secondary">Inscrivez-vous</strong> pour publier votre première annonce ou participer à un covoiturage!</p>
            <a href="signup.php" class="btn btn-outline-secondary">Créer mon compte</a>
         </div>
      </section>
   </article>
</body>
</html>