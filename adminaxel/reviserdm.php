<?php
session_start();
require '../conf/login_data.php';

$id_demande = $_GET['demande'];
$valider = "non";

$req = $loginData->prepare("SELECT * FROM colocation WHERE id_demande = ?");
$req->execute(array($id_demande));
$info = $req->fetch();


$req = $loginData->prepare("UPDATE colocation SET valider = ? WHERE id_demande = $id_demande");
$req->execute([$valider]);
header('Location: index.php');
