<?php

session_start();

try {
   $db = new PDO('mysql:host=localhost;dbname=mnscarpool', 'root', 'root');
} catch(PDOException $e) {
   echo 'Erreur bdd : ' . $e;
}