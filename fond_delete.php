<?php
session_start();
$id_annonceurs = $_SESSION['id'];
require 'conf/login_data.php';




 $req = $loginData->prepare("DELETE FROM annonces WHERE id_annonceurs = $id_annonceurs
 ORDER BY id_annonces DESC LIMIT 1");
 $req->execute();

 if($req){
    // //////mettre alerte de fonds insuffisants ici//////////////
  $_SESSION['add_e'] =  'Fonds insuffisants. Veuillez recharger votre compte.';
  header('Location: wallet.php');

 }
  
 



?>
