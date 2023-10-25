<?php
session_start();
require "sendmail.php";
$rec2 =  $_GET['annonce']; 
require 'conf/login_data.php';




$req = $loginData->prepare("DELETE FROM `annonces` WHERE id_annonces = $rec2");
$req->execute();



 if($req){
   $_SESSION['delete_a'] = "Annonce supprimé" ;
    header("Location: mes_annonces.php");
 }
