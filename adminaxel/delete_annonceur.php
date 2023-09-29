<?php
session_start();
require '../sendmail.php';
$id_annonceurs = $_GET['id'];
require '../conf/login_data.php';
$req = $loginData->prepare('SELECT * FROM annonceurs WHERE id_annonceurs = ?');
$req->execute(array($id_annonceurs));
$info = $req->fetch();
$email = $info['email'];
$pseudo = $info['pseudo'];
delete_annonceur();

$req = $loginData->prepare("DELETE FROM `annonceurs` WHERE `annonceurs`.`id_annonceurs` = $id_annonceurs;
");
$req->execute();
$req2 = $loginData->prepare("DELETE FROM `annonces` WHERE `annonces`.`id_annonceurs` = $id_annonceurs");
$req2->execute();

//unset($_SESSION['id']);

if ($req && $req2) {
   $_SESSION['delete_compte'] = $success;
   header("Location: annonceurs.php");
} else {
   $_SESSION['echec_delete_compte'] = $echec;
   header('Location: annonceurs.php');
}
