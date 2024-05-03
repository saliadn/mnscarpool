<?php

if(!isset($_SESSION['userConnected']) || $_SESSION['userConnected'] != 'xz#2' || $_SESSION['usergroup'] != 'admin') {
   header('Location: ../index.php');
} 