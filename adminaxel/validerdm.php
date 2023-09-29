<?php
session_start();
require '../conf/login_data.php';

$id_demande = $_GET['demande'];


$req = $loginData->prepare("SELECT * FROM colocation WHERE id_demande = $id_demande");
$req->execute();
$info = $req->fetch();

$valider = 'oui';
$update = $loginData->prepare("UPDATE colocation SET valider = ? WHERE id_demande = $id_demande");
$update->execute(array($valider));
if ($update) {
    $email = $info['email'];
    $pseudo = $info['pseudo'];
    $_SESSION['valide'] = $success;
    header('Location: index.php');
}
