<?php
session_start();
require 'conf/login_data.php';
$tec =  isset($_SESSION['id']) ? $_SESSION['id'] : NULL;

$publi = $loginData->prepare('SELECT * FROM annonces WHERE id_annonceurs = ? ORDER BY id_annonces DESC');
$publi->execute(array($tec));
$count = $publi->rowCount();




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
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500&family=Open+Sans:wght@300;400&display=swap" rel="stylesheet"> <!-- title bar icon -->
    <link rel="shortcut icon" type="imge/x-icon" href="img/title-bar-icon.png">
    <link rel="stylesheet" href="style.css">
    <title>Mes annonces</title>
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-PCJ85GX6GK"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-PCJ85GX6GK');
    </script>
</head>

<body>
    <style>
        .navbar-light .navbar-nav .mes_annonces_link {
            color: #ec3e0e;
        }

        .flip-card {
            background-color: transparent;
            width: 190px;
            height: 254px;
            perspective: 1000px;
            font-family: sans-serif;
            overflow: hidden;
        }

        .title {
            font-size: 1.5em;
            font-weight: 900;
            text-align: center;
            margin: 0;
        }

        .flip-card-inner {
            position: relative;
            width: 100%;
            height: 100%;
            text-align: center;
            transition: transform 0.8s;
            transform-style: preserve-3d;
        }

        .flip-card:hover .flip-card-inner {
            transform: rotateY(180deg);
        }

        .flip-card-front,
        .flip-card-back {
            box-shadow: 0 8px 14px 0 rgba(0, 0, 0, 0.2);
            position: absolute;
            display: flex;
            flex-direction: column;
            justify-content: center;
            width: 100%;
            height: 100%;
            -webkit-backface-visibility: hidden;
            backface-visibility: hidden;
            border: 1px solid coral;
            border-radius: 1rem;
        }

        .flip-card-front {
            background: linear-gradient(120deg, bisque 60%, rgb(255, 231, 222) 88%,
                    rgb(255, 211, 195) 40%, rgba(255, 127, 80, 0.603) 48%);
            color: coral;
        }

        .flip-card-back {
            background: linear-gradient(120deg, rgb(255, 174, 145) 30%, coral 88%,
                    bisque 40%, rgb(255, 185, 160) 78%);
            color: white;
            transform: rotateY(180deg);
        }

        .img_mes {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
            border-radius: 1rem;
        }
    </style>


    <div class="container-fluid-xs container-xxl" style="padding-right: var(--bs-gutter-x, 0rem); overflow:hidden;">
        <div class="row">
            <?php include "header_contact.php" ?>
            <?php include "logo_menu.php" ?>
            <div class="container box-mes_annonces mt-5 mb-5 p-0">
                <div class="row px-2">
                    <?php if (isset($_SESSION['delete_a'])) : ?>
                        <script>
                        swal({
            //title: 'Annonce  envoyée ',
            text: ' <?= $_SESSION['delete_a'] ?>',
            icon: 'success',
            buttons: 'Ok',
          }).then((result) => {
            if (result) {
            }
          });
          var swalText = document.querySelector('.swal-text');
  if (swalText) {
    swalText.style.textAlign = 'center';
  }
        </script>
                        <!-- <p class="alert alert-success text-center m-0"><?= $_SESSION['delete_a'] ?></p> -->
                    <?php unset($_SESSION['delete_a']);
                    endif; ?>
                    <?php if (isset($_SESSION['add_a'])) : ?>
                        <script>
                            swal({
                                //title: 'Annonce  envoyée ',
                                text: '<?= $_SESSION['add_a'] ?>',
                                icon: 'success',
                                buttons: 'Ok',
                            }).then((result) => {
                                if (result) {}
                            });
                            var swalText = document.querySelector('.swal-text');
                            if (swalText) {
                                swalText.style.textAlign = 'center';
                            }
                        </script>
                    <?php unset($_SESSION['add_a']);
                    endif; ?>
                    <h3 class="col-12 mb-4">Mes annonces</h3>
                    <p class="col-12">Retrouvez l'ensemble de vos annonces postées, vous pouvez
                        les
                        visualiser, les
                        modifier ou les supprimer.

                    </p>
                    <?php if (!empty($_SESSION['update'])) : ?>
                        <script>
                        swal({
            //title: 'Annonce  envoyée ',
            text: ' <?= $_SESSION['update'] ?>',
            icon: 'success',
            buttons: 'Ok',
          }).then((result) => {
            if (result) {
            }
          });
          var swalText = document.querySelector('.swal-text');
  if (swalText) {
    swalText.style.textAlign = 'center';
  }
        </script>
                        <!-- <p class="alert alert-success text-center ">
                            <?= $_SESSION['update'] ?>
                        </p> -->
                    <?php unset($_SESSION['update']);
                    endif ?>

                    <?php if (!empty($_SESSION['renouvellement'])) : ?>
                        <script>
                        swal({
            //title: 'Annonce  envoyée ',
            text: ' <?= $_SESSION['renouvellement'] ?>',
            icon: 'success',
            buttons: 'Ok',
          }).then((result) => {
            if (result) {
            }
          });
          var swalText = document.querySelector('.swal-text');
  if (swalText) {
    swalText.style.textAlign = 'center';
  }
        </script>
                        <!-- <p class="alert alert-success text-center ">
                            <?= $_SESSION['renouvellement'] ?>
                        </p> -->
                    <?php unset($_SESSION['renouvellement']);
                    endif ?>

                    <?php if (!empty($_SESSION['echec_renouvellement'])) : ?>
                        <p class="alert alert-danger text-center ">
                            <?= $_SESSION['echec_renouvellement'] ?>
                        </p>
                    <?php unset($_SESSION['echec_renouvellement']);
                    endif ?>



                    <?php

                    if (isset($_SESSION['id'])) : ?>
                        <!--si connecte-->

                        <?php
                        if ($count == 0) { ?>

                            <div class="delete_padding mx-auto my-5" style="width: 98%;">
                                <p class="alert alert-success text-center fw-bolder "> Aucune annonce ajoutée.</p>
                            </div>
                            <?php } else {
                            while ($res = $publi->fetch(PDO::FETCH_ASSOC)) : ?>
                                <div class="flip-card my-2">
                                    <div class="flip-card-inner">
                                        <div class="flip-card-front">
                                            <img src="<?= $res['img_cover'] ?>" alt="cover" class="img_mes">
                                        </div>
                                        <div class="flip-card-back">
                                            <div>
                                                <a class="bg-primary text-light text-center px-1 mx-1" style="text-decoration:none; border-radius:5px; display:inline-block" href="view.php?id=<?= $res['id_annonceurs'] ?>&annonce=<?= $res['id_annonces'] ?>" title="Voire l'annonce"><i class="fa fa-eye"></i> </a>
                                                <a title="Modifier l'annonce" class="bg-secondary text-light px-1 mx-1" style="text-decoration:none; border-radius:5px; display:inline-block" href="update.php?id=<?= $res['id_annonceurs'] ?>&annonce=<?= $res['id_annonces'] ?>"><i class="fa fa-pencil"></i> </a>
                                                <a href="delete_annonce.php?id=<?= $res['id_annonceurs'] ?>&id_annonces=<?= $res['id_annonces'] ?>"  title="Supprimer l'annonce" class="px-1 mx-1 bg-danger text-light" style="text-decoration:none; border-radius:5px; display:inline-block" ><i class="fa fa-trash"></i>
                                                </a>
                                                <?php if ($res['statuts'] === "expiré") : ?>
                                                    <a title="Renouveler l'annonce" class="bg-success text-light  px-1 mx-1" style="text-decoration:none; border-radius:5px; display:inline-block" href="renouvellement.php?id=<?= $res['id_annonceurs'] ?>&annonce=<?= $res['id_annonces'] ?>"><i class="fa fa-cart-arrow-down bg-success text-light"></i>
                                                    </a>
                                                <?php endif; ?>

                                            </div>
                                        </div>
                                    </div>

                                </div>
                    <?php endwhile;
                        }





                    endif; ?>
                </div>
            </div>
        </div>
        <?php include "partials/progres/progres.php" ?>

    </div>
    <!--javascript bootstrap
    <script src="cdn/bootstrap5/js/bootstrap.js"></script>
-->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <!--javaSCript-->
    <script src="main.js"></script>
    <script src="//code.tidio.co/soutospimq4pk32r0mcxjjhtoqnjc0de.js" async></script>
</body>

</html>