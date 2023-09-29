<?php
session_start();
require 'conf/login_data.php';
require 'sendmail.php';

$rec =  $_GET['id'];
$rec2 =  $_GET['annonce']; 

$statut = "en cours";
      $validation = "oui";
      date_default_timezone_set('Africa/Dakar');
      $date_add = strtotime(date('d-m-Y H:i:s'));
      $update_date_expire = strtotime(date('d-m-Y H:i:s', strtotime('+1 month')));
      
     $req =$loginData->prepare("UPDATE annonces SET statuts= ?, valider = ?, date_expire = ? WHERE id_annonces = $rec2");
     $req->execute(array($statut, $validation, $update_date_expire));

     $email = $info['email'];
     $pseudo = $info['pseudo'];
     
     renouvellement();
     // // //////mettre alerte de réussite ici//////////////
        $_SESSION['renouvellement'] =  'Votre annonce a été renouvelée avec success.';
        header('Location: mes_annonces.php');


