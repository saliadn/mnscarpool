<?php

require_once 'dbconnect.php';
$pageTitle = 'MNS Carpool — Inscription';

// voir regex (https://www.youtube.com/watch?v=zAAXtLo0zuw)
$usernameRegex = "";

if(isset($_POST['submit'])) {
   if(isset($_POST['nom']) && $_POST['nom'] != '' && isset($_POST['prenom']) && $_POST['prenom'] != '') {
      $nom = strtoupper($_POST['nom']);
      $prenom = ucfirst($_POST['prenom']);
      if(isset($_POST['username']) && $_POST['username'] != '') {
         $username = $_POST['username'];
         if(isset($_POST['email']) && $_POST['email'] != '' && $_POST['email'] === $_POST['confirm_email']) {
            $email = $_POST['email'];
            if(isset($_POST['password']) && $_POST['password'] != '' && $_POST['password'] === $_POST['confirm_password']) {
               $hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
               $req = $db->prepare('INSERT INTO users (nom, prenom, username, email, password) VALUES (:nom, :prenom, :username, :email, :password)');
               $req->execute([
                  ':nom' => $nom,
                  ':prenom' => $prenom,
                  ':username' => $username,
                  ':email' => $email,
                  ':password' => $hashedPassword,
               ]);
               $signupSuccess = 'Votre compte a été crée avec succès, vous pouvez désormais <a href="login.php" class="primary">vous connecter</a> avec vos identifiants.';
            } else {
               $errorMessage = '- Les mots de passe ne correspondent pas.';
            }
         } else {
            $errorMessage = '- Les adresses emails ne correspondent pas.';
         }
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
         <h2>Inscription <span class="secondary">MNS Carpool</span></h2>

         <form action="signup.php" method="post">
            <div class="grid-2">
               <div class="floating">
                  <input type="text" name="nom" id="nom" required>
                  <label for="nom">Nom</label>
               </div>
               
               <div class="floating">
                  <input type="text" name="prenom" id="prenom" required>
                  <label for="prenom">Prénom</label>
               </div>
            </div>

            <div class="floating">
               <input type="text" name="username" id="username" minlength=5 required>
               <label for="username">Nom d'utilisateur</label>
            </div>

            <div class="floating">
               <input type="text" name="email" id="email" required>
               <label for="email">Email</label>
            </div>

            <div class="floating">
               <input type="text" name="confirm_email" id="confirm_email" required>
               <label for="confirm_email">Confirmation Email</label>
            </div>

            <div class="floating">
               <input type="password" name="password" id="password" required>
               <label for="password">Mot de passe</label>
            </div>

            <div class="floating">
               <input type="password" name="confirm_password" id="confirm_password" required>
               <label for="confirm_password">Confirmation du mot de passe</label>
            </div>

            <input type="submit" value="Créer mon compte" class="btn btn-secondary" name="submit" required>

            <!-- success message -->
            <?php if(isset($signupSuccess)) { ?> 
               <span class="signup-success"><?= $signupSuccess ?></span>

            <!-- error message -->
            <?php }  if (isset($errorMessage)) { ?>
               <span class="signup-error"><?= $errorMessage ?></span>
            <?php } ?>
         </form>

      </section>
      <section class="login-page__right">
         <div class="informations">
            <img src="/assets/img/illustration.png" alt="CarPool Illustration">
            <p><strong class="primary">Bienvenue !</strong> C'est un plaisir pour nous de vous accueillir sur MNS Carpool.</p>
            <p>Vous avez déjà un compte ?</p>
            <a href="login.php" class="btn btn-outline-primary">Connectez-vous</a>
         </div>
      </section>
   </article>
</body>
</html>