<?php
session_start();
require '../sendmail.php';
require '../conf/login_data.php';

$id_annonce = $_GET['annonce'];
$statuts = "en cours de validation...";
$valider = "non";

$req = $loginData->prepare("SELECT * FROM annonces WHERE id_annonces = ?");
$req->execute(array($id_annonce));
$info = $req->fetch();


$req = $loginData->prepare("UPDATE annonces SET statuts = ?, valider = ? WHERE id_annonces = $id_annonce");
$req->execute([$statuts, $valider]);
header('Location: annonces.php');
