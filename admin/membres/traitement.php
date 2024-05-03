<?php

require_once '../../dbconnect.php';
require_once '../protect.php';

if(isset($_POST['sent'])) {
   $userID = $_POST['userID'];
   $nom = "";
   $prenom = "";
   $username = "";
   $email = '';
   $usergroup = '';
   $password = '';

   if ($userID > 0) {
      $req = $db->prepare('SELECT * FROM users WHERE id = :id');
      $req->execute([':id' => $userID]);
      if($user = $req->fetch()) {
         $userID = $user['id'];
         $nom = $user['nom'];
         $prenom = $user['prenom'];
         $username = $user['username'];
         $email = $user['email'];
         $usergroup = $user['usergroup'];
         $currentPassword = $user['password'];
      }
   }

   if (isset($_POST['nom'])) { $nom = strtoupper($_POST['nom']); }
   if (isset($_POST['prenom'])) { $prenom = ucfirst($_POST['prenom']); }
   if (isset($_POST['username'])) { $username = $_POST['username']; }
   if (isset($_POST['email'])) { $email = $_POST['email']; }
   if (isset($_POST['password']) && $_POST['password'] != '') {
      $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
   } else {
      $password = $currentPassword;
   }
   if (isset($_POST['usergroup'])) { $usergroup = $_POST['usergroup']; }

   if ($userID > 0) { // edit user
      $req = $db->prepare('UPDATE users SET nom = :nom, prenom = :prenom, username = :username, email = :email, password = :password, usergroup = :usergroup WHERE id = :id');
      $req->execute([
         ':id' => $userID,
         ':nom' => $nom,
         ':prenom' => $prenom,
         ':username' => $username,
         ':email' => $email,
         ':password' => $password,
         ':usergroup' => $usergroup
      ]);
   } else { // ajout
      $req = $db->prepare('INSERT INTO users (nom, prenom, username, email, password, usergroup, userImg) VALUES (:nom, :prenom, :username, :email, :password, :usergroup, :userImg)');
      $req->execute([
         ':nom' => $nom,
         ':prenom' => $prenom,
         ':username' => $username,
         ':email' => $email,
         ':password' => $password,
         ':usergroup' => $usergroup,
         ':userImg' => 'https://cdn.landesa.org/wp-content/uploads/default-user-image.png', // image par default
      ]);
   }
}

if(isset($_POST['adresseUpdated'])) {
   $userID = $_POST['userID'];
   $norue = '';
   $adresse = '';
   $codePostal = '';
   $ville = '';

   if($userID > 0) {
      $req = $db->prepare('SELECT * FROM adresses WHERE userID = :id');
      $req->execute([':id' => $userID]);
      if($user = $req->fetch()) {
         $norue = $user['no'];
         $adresse = $user['adresse'];
         $codePostal = $user['codepostal'];
         $ville = $user['ville'];
      }
   }

   if(isset($_POST['norue'])) { $norue = $_POST['norue']; }
   if(isset($_POST['adresse'])) { $adresse = $_POST['adresse']; }
   if(isset($_POST['codepostal'])) { $codePostal = $_POST['codepostal']; }
   if(isset($_POST['ville'])) { $ville = $_POST['ville']; }

   if ($userID > 0) { // edit user
      $req = $db->prepare('UPDATE adresses SET no = :norue, adresse = :adresse, codepostal = :codepostal, ville = :ville WHERE userID = :id');
      $req->execute([
         ':id' => $userID,
         ':norue' => $norue,
         ':adresse' => $adresse,
         ':codepostal' => $codePostal,
         ':ville' => $ville,
      ]);
   } else { // ajout
      $req = $db->prepare('INSERT INTO adresses (no, adresse, codepostal, ville, userID) VALUES (:norue, :adresse, :codepostal, :ville, :userID)');
      $req->execute([
         ':norue' => $norue,
         ':adresse' => $adresse,
         ':codepostal' => $codePostal,
         ':ville' => $ville,
         ':userID' => $userID
      ]);
   }

}

header('Location: index.php');