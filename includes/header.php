<nav class="header">
   <a href="index.php"><img src="assets/img/carpool_logo.png" alt="MNS Carpool Logo" dragable="false"></a>

   <ul class="nav-links">
      <li><a href="index.php">Accueil</a></li>
      <?php if(isset($_SESSION['userConnected']) && $_SESSION['userConnected'] == "xz#2" && $_SESSION['usergroup'] == "admin") { ?>
         <li><a href="newcovoit.php" class="btn btn-outline-primary">Admin feature</a></li>
      <?php } else { ?>
         <li><a href="newcovoit.php" class="btn btn-primary">Publier une annonce</a></li>
      <?php } ?>
      <li><a href="annonces.php">Annonces</a></li>
   </ul>
   <div>
      
   <?php if (isset($_SESSION['userConnected']) && $_SESSION['userConnected'] == 'xz#2') { ?>
      <?php if($_SESSION['usergroup'] == 'admin') { ?>
         <a href="admin/" class="btn btn-secondary"><i class="fa-solid fa-terminal"></i>admin</a>
      <?php } else { ?>
         <a href="settings.php" class="btn btn-secondary"><i class="fa-solid fa-gear"></i>Mon compte</a>
      <?php } ?>
         <a href="disconnect.php" class="btn btn-outline-primary">Se déconnecter</a>
   <?php } else { ?> 
      <a href="login.php" class="btn btn-primary">Se connecter</a>
      <a href="signup.php" class="btn btn-outline-secondary">S'inscrire</a>
   <?php } ?>
   </div>
</nav>