<?php
session_start();
$id_annonceurs = $_SESSION['id'];
 

require 'conf/login_data.php';
$req = $loginData->prepare("DELETE FROM `annonceurs` WHERE `annonceurs`.`id_annonceurs` = $id_annonceurs;
");
$req->execute();

$req2 = $loginData->prepare("DELETE FROM `annonces` WHERE `annonces`.`id_annonceurs` = $id_annonceurs");
$req2->execute();


unset($_SESSION['id']);

if($req && $req2){
   $_SESSION['delete_compte'] ="Votre compte a bien été supprimé"; 
    header("Location: inscription.php");
 }



