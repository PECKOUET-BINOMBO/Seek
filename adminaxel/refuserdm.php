<?php
session_start();
require '../conf/login_data.php';

$id_demande = $_GET['demande'];


$delete = $loginData->prepare("DELETE FROM `colocation` WHERE `id_demande` = $id_demande");
$delete->execute();

if ($delete) {


   
    header('Location: index.php');
} 
