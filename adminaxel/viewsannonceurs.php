<?php
$rec =  $_GET['id'];
require '../conf/login_data.php';

$req = $loginData->prepare("SELECT * FROM annonces WHERE id_annonceurs = $rec ");
$req->execute();
$data = $req->fetch();

$req1 = $loginData->prepare("SELECT * FROM annonces WHERE id_annonceurs = $rec ");
$req1->execute();
$data1 = $req1->rowCount();

$req2 = $loginData->prepare("SELECT * FROM annonceurs WHERE id_annonceurs = $rec ");
$req2->execute();
$data2 = $req2->fetch();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--fontawesome 4-->
    <script src="https://kit.fontawesome.com/727be77922.js" crossorigin="anonymous"></script>
    <script src="cdn/font-awesome4/fonts/FontAwesome.otf"></script>
    <link rel="stylesheet" href="cdn/font-awesome4/css/font-awesome.css">
    <!--fontawesome 6-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--bootstrap
    <link href="cdn/bootstrap5/css/bootstrap.css" rel="stylesheet">
-->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<!--sweetalert-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <!--font google -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500&family=Open+Sans:wght@300;400&display=swap" rel="stylesheet">
    <!-- title bar icon -->
    <link rel="shortcut icon" type="imge/x-icon" href="img/title-bar-icon.png">
    <link rel="stylesheet" href="style.css">
    <title>Fiche de <?= $data2['pseudo'] ?></title>
</head>

<body>

    <div class="container-fluid-xs container-xxl pd">
        <div class="row">
            <?php
            include "menu.php";

            if (!isset($_SESSION['id_admin'])) {
                header('Location: connexion.php');
            }
            ?>

            <div class="container">
                <div class="row">
                    <div class="col">
                    <h2  class="text-center">Fiche de renseignement</h2>
                    <ul>
                        <li>PSEUDO : <?= $data2['pseudo'] ?></li>
                        <li>E-MAIL : <?= $data2['email'] ?></li>
                        <li>TEL : <?= $data2['tel'] ?></li>
                        <li>COMPTE VERIFIE : <?= $data2['verifie'] ?></li>
                        <li>DATE INSCRIPTION : <?= $data2['date_inscription'] ?></li>
                        <li>NOMBRE D'ANNONCE : <?= $data1 ?></li>
                    </ul>
                    </div>
            </div>
                       
            </div>
        </div>
    </div>
    <!--javascript bootstrap-->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    
</body>

</html>
</body>

</html>