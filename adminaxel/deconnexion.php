<?php
session_start();
if (!isset($_SESSION['id_admin'])) {
    header('Location: connexion.php');
    exit();
}
unset($_SESSION['id_admin']);
header('Location: connexion.php');
