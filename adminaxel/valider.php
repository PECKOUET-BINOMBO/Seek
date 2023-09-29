<?php
session_start();
require '../conf/login_data.php';
require '../sendmail.php';

$id_annonce = $_GET['annonce'];
$id_annonceurs = $_GET['id'];


$req = $loginData->prepare("SELECT * FROM annonceurs WHERE id_annonceurs = $id_annonceurs");
$req->execute();
$info = $req->fetch();

$valider = 'oui';
$statut = 'en cours';
$update = $loginData->prepare("UPDATE annonces SET statuts= ?, valider = ? WHERE id_annonces = $id_annonce");
$update->execute(array($statut, $valider));
if ($update) {
   
    $email = $info['email'];
    $pseudo = $info['pseudo'];
    validation();
    $_SESSION['valide'] = $success;
    header('Location: annonces.php');
} else {
    $_SESSION['invalide'] = $echec;
    header('Location: annonces.php');
}
