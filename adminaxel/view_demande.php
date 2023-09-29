<?php
$rec2 =  $_GET['demande'];
require '../conf/login_data.php';

$req = $loginData->prepare("SELECT * FROM colocation WHERE id_demande = ? ");
$req->execute([$rec2]);
$data = $req->fetch();



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
    <title>Vérification demande</title>
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

            <div class="container mt-5 mb-5 p-0">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-6 mx-2 border morebox">
                        
                        <div class="annonceur">
                            <p>Posté par :<span style="text-transform: capitalize;"> <?= $data['pseudo'] ?></span>
                            </p>
                        </div>
                        <div class="description">
                            <h4>Description :</h4>
                            <p><?= $data['demande'] ?>
                            </p>
                        </div>
                        <div class="d-flex">
                        <?php if ( $data['valider'] === "non") : ?>
                            <div>
                                <a title="Valider l'annonce" class="bg-success text-light px-1 mx-1" style="padding:5%; text-decoration:none; border-radius:5px; display:inline-block" href="validerdm.php?demande=<?= $rec2 ?>">Accepter </a>
                            </div>
                            <div>
                                <a title="Refuser l'annonce" class="bg-danger text-light  px-1 mx-1" style="padding:5%; text-decoration:none; border-radius:5px; display:inline-block" href="refuserdm.php?demande=<?= $rec2 ?>">Refuser</a>
                            </div>
                        <?php endif; ?>
                        <?php if ($data['valider'] === "oui") : ?>
                            <div>
                                <a title="Supprimer l'annonce" class="bg-danger text-light  px-1 mx-1" style="padding:5%; text-decoration:none; border-radius:5px; display:inline-block" href="refuserdm.php?demande=<?= $rec2 ?>">Supprimer
                                </a>
                            </div>
                            <div>
                                <a title="Réviser l'annonce" class="bg-primary text-light  px-1 mx-1" style="padding:5%; text-decoration:none; border-radius:5px; display:inline-block" href="reviserdm.php?demande=<?= $rec2 ?>">Reviser</a>
                            </div>
                            
                            <?php endif; ?>
                        </div>
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