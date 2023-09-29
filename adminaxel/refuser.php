<?php
session_start();
require '../sendmail.php';
require '../conf/login_data.php';

$id_annonce = $_GET['annonce'];
$id_annonceurs = $_GET['id'];


$req = $loginData->prepare("SELECT * FROM annonceurs WHERE id_annonceurs = ?");
$req->execute(array($id_annonceurs));
$info = $req->fetch();

$delete = $loginData->prepare("DELETE FROM `annonces` WHERE `annonces`.`id_annonces` = $id_annonce");
$delete->execute();

if ($delete) {


    $email = $info['email'];
    $pseudo = $info['pseudo'];

    refus_annonce();

    $_SESSION['refus_annonce'] = $success;
    header('Location: annonces.php');
} else {
    $_SESSION['echec_refus'] = $echec;
    header('Location: annonces.php');
}
