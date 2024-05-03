<?php

require_once '../../dbconnect.php';
require_once '../protect.php';

// ajouter html special chars dans les autre forms

if(isset($_GET['id']) && $_GET['id'] > 0) {
   $req = $db->prepare('DELETE FROM annonces WHERE annonceID = :id');
   $req->execute([':id' => $_GET['id']]);
}

header('Location: index.php');