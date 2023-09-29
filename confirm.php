<?php
session_start();
require 'sendmail.php';
if ($_GET['me'] &&  $_GET['token']) {

    $id = $_GET['me'];
    $token = $_GET['token'];

    require 'conf/login_data.php';

    $req = $loginData->prepare('SELECT * FROM `annonceurs` WHERE `id_annonceurs` = ? AND `token` = ?');
    $req->execute(array($id, $token));
    $user = $req->fetch();
    if ($req) {
        if ($id == $user['id_annonceurs'] and $token == $user['token']) {
            $yes = 'oui';
            // $email = $user['email'];
            // $pseudo = $user['pseudo'];
            $update = $loginData->prepare("UPDATE annonceurs SET verifie= ?, token = NULL WHERE id_annonceurs = $id");
            $update->execute(array($yes));
                // compteadd();
            $_SESSION['compteActive'] = "Votre compte est activé, connectez-vous et ajoutez une annonce.";
            header('Location: connexion.php');
        } else {
            $_SESSION['compteInvalide'] = "Ce compte n'existe pas ou a déjà été activé";
            header('Location: inscription.php');
        }
    }
}
