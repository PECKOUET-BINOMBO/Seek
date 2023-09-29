<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('Location: connexion.php');
    exit();
}
unset($_SESSION['id']);
$_SESSION['updateprofil'];
header('Location: connexion.php');
