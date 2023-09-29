<?php
require '../conf/login_data.php';

$publi = $loginData->prepare('SELECT * FROM colocation ');
$publi->execute();
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
    <!--bootstrap-->
    <link href="../cdn/bootstrap5/css/bootstrap.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!--sweetalert-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <!--font google -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500&family=Open+Sans:wght@300;400&display=swap" rel="stylesheet">
    <!-- title bar icon -->
    <link rel="shortcut icon" type="imge/x-icon" href="img/icon.png">
    <link rel="stylesheet" href="style.css">
    <title>Tableau de bord</title>
</head>

<body>
    <style>
        .navbar-light .navbar-nav .dash_link {
            color: #ec3e0e;
        }
    </style>

    <div class="container-fluid-xs container-xxl pd">
        <div class="row">
            <?php
            include "menu.php";
            if (!isset($_SESSION['id_admin'])) {
                header('Location: connexion.php');
            }
            ?>
            <div class="container mt-5 mb-5 p-0">

            <h2 class="text-center">Listes des demandes</h2>
                        <div class="table-responsive w-75 m-auto">
                            <table class="table">
                                <thead class="table-success">
                                    <tr>
                                        <th>DESCRIPTIONS</th>
                                        <th>ACTIONS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($res = $publi->fetch(PDO::FETCH_ASSOC)) : ?>
                                        <tr>
                                            
                                                <td class="">
                                                    <?= $res['demande'] ?>
                                                </td>
                                            
                                                <td class="">
                                                <?php if ($res['valider'] == 'oui') : ?>
                                                    <a title="Supprimer l'annonce" class="bg-danger text-light  px-1 mx-1" style="padding:5%; text-decoration:none; border-radius:5px; display:inline-block" href="refuserdm.php?demande=<?=$res['id_demande'] ?>">Supprimer
                                </a>
                                                <?php endif; ?>
                                                <?php if ($res['valider'] == 'non') : ?>
                                                    <a title="Valider l'annonce" class="bg-success text-light px-1 mx-1" style="padding:5%; text-decoration:none; border-radius:5px; display:inline-block" href="validerdm.php?demande=<?= $res['id_demande'] ?>">Accepter </a>
                                                <?php endif; ?>
                                                </td>
                                           
                                        </tr>
                                    <?php endwhile; ?>
 
                                </tbody>
                            </table>
                        </div>
        </div>
        </div>
    </div>
    <!--javascript bootstrap-->
    <script src="cdn/bootstrap5/js/bootstrap.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <!--javaSCript-->
    <script src="main.js"></script>
</body>

</html>