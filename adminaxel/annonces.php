<?php
session_start();
require '../sendmail.php';
require '../conf/login_data.php';
$publi = $loginData->prepare('SELECT * FROM annonceurs');
$publi->execute();
$res = $publi->fetch();
$tec = isset($res['id_annonceurs']) ? $res['id_annonceurs'] : NULL;

//id annoncces
$publi2 = $loginData->prepare('SELECT * FROM annonces WHERE id_annonceurs = ?');
$publi2->execute(array($tec));
$res2 = $publi2->fetch();

//id annoneurs
$req = $loginData->prepare("SELECT * FROM annonces WHERE statuts != 'expiré' AND valider != '...'");
$req->execute();

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
    <title>Annonces</title>
</head>

<body>
    <!-- couleur de l'onglet actif -->
    <style>
        .navbar-light .navbar-nav .annonces1_link {
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
                <?php if (!empty($_SESSION['valide'])) : ?>
                    <p class="alert alert-success text-center "><?= $_SESSION['valide'] ?></p>
                <?php unset($_SESSION['valide']);
                endif ?>

                <?php if (!empty($_SESSION['invalide'])) : ?>
                    <p class="alert alert-success text-center "><?= $_SESSION['invalide'] ?></p>
                <?php unset($_SESSION['invalide']);
                endif ?>

                <?php if (!empty($_SESSION['rejet'])) : ?>
                    <p class="alert alert-success text-center "><?= $_SESSION['rejet'] ?></p>
                <?php unset($_SESSION['rejet']);
                endif ?>

                <?php if (!empty($_SESSION['refus'])) : ?>
                    <p class="alert alert-success text-center "><?= $_SESSION['refus'] ?></p>
                <?php unset($_SESSION['refus']);
                endif ?>


                <?php if (!empty($_SESSION['refus_annonce'])) : ?>
                    <p class="alert alert-success text-center "><?= $_SESSION['refus_annonce'] ?></p>
                <?php unset($_SESSION['refus_annonce']);
                endif ?>

                <?php if (!empty($_SESSION['echec_refus'])) : ?>
                    <p class="alert alert-success text-center "><?= $_SESSION['echec_refus'] ?></p>
                <?php unset($_SESSION['echec_refus']);
                endif ?>

                <div class="table-responsive">

                    <table class="table table-image">
                        <thead class="table-success">
                            <tr>
                                <th>ID</th>
                                <th>Annonceurs</th>
                                <th>Photos</th>
                                <th>Titres</th>
                                <th>statuts</th>
                                <th>Valides</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($annonce = $req->fetch(PDO::FETCH_ASSOC)) : ?>
                                <?php $ida = $annonce['id_annonceurs'];

                                $publi3 = $loginData->prepare('SELECT * FROM annonceurs WHERE id_annonceurs = ?');
                                $publi3->execute(array($ida));
                                $res3 = $publi3->fetch();
                                ?>
                                <tr>
                                    <td><?= $annonce['id_annonces'] ?>
                                    </td>
                                    <td class="img-table"><?= $res3['pseudo'] ?></td>
                                    <td class="img-table"><img src="../<?= $annonce['img_cover'] ?>" alt=""></td>
                                    <td><?= $annonce['titres'] ?></td>
                                    <td><?= $annonce['statuts'] ?></td>
                                    <td><?= $annonce['valider'] ?></td>

                                    <td>
                                        <a class="bg-secondary text-center text-light px-1 mx-1" style="text-decoration:none; border-radius:5px; display:inline-block" href="view_admin.php?id=<?= $annonce['id_annonceurs'] ?>&annonce=<?= $annonce['id_annonces'] ?>" title="Voire l'annonce"><i class="fa fa-eye"></i> </a>

                                        <?php if ($annonce['statuts'] === "en cours de validation..." && $annonce['valider'] === "non") : ?>
                                            <a title="Valider l'annonce" class="bg-success text-light px-1 mx-1" style="text-decoration:none; border-radius:5px; display:inline-block" href="valider.php?id=<?= $annonce['id_annonceurs'] ?>&annonce=<?= $annonce['id_annonces'] ?>"><i class="fa-solid fa-square-check"></i> </a>

                                            <a title="Refuser l'annonce" class="bg-danger text-light  px-1 mx-1" style="text-decoration:none; border-radius:5px; display:inline-block" href="refuser.php?id=<?= $annonce['id_annonceurs'] ?>&annonce=<?= $annonce['id_annonces'] ?>"><i class="fa-solid fa-square-xmark"></i>
                                            </a>
                                        <?php endif; ?>

                                        <?php if ($annonce['statuts'] === "en cours" && $annonce['valider'] === "oui") : ?>
                                            <a title="Supprimer l'annonce" class="bg-danger text-light  px-1 mx-1" style="text-decoration:none; border-radius:5px; display:inline-block" href="refuser.php?id=<?= $res2['id_annonceurs'] ?>&annonce=<?= $annonce['id_annonces'] ?>"><i class="fa fa-trash"></i>
                                            </a>







                                            <a title="Réviser l'annonce" class="bg-primary text-light  px-1 mx-1" style="text-decoration:none; border-radius:5px; display:inline-block" href="reviser.php?id=<?= $res2['id_annonceurs'] ?>&annonce=<?= $annonce['id_annonces'] ?>"><i class="fa-solid fa-gear"></i>

                                            </a> <?php endif; ?>
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