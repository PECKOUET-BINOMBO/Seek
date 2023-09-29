<?php
session_start();
$pseudo = $_SESSION['pseudo'];
$email = $_SESSION['email'];
$tel = $_SESSION['tel'];
$id_annonceurs = $_SESSION['id'];
require 'conf/login_data.php';
$user = $loginData->prepare('SELECT * FROM annonceurs WHERE id_annonceurs = ?');
$user->execute([$id_annonceurs]);
$req = $user->fetch();
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--bootstrap
    <link href="cdn/bootstrap5/css/bootstrap.css" rel="stylesheet">
-->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!--sweetalert-->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!--font google -->
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500&family=Open+Sans:wght@300;400&display=swap"
        rel="stylesheet"> <!-- title bar icon -->
    <link rel="shortcut icon" type="imge/x-icon" href="img/title-bar-icon.png">
    <link rel="stylesheet" href="style.css">
    <title>Mon compte</title>
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
    .navbar-light .navbar-nav .mon_compte_link {
        color: #ec3e0e;
    }
    </style>

    <div class="container-fluid-xs container-xxl pd">
        <div class="row back">
            <?php include "header_contact.php" ?>
            <?php include "logo_menu.php" ?>
            <div class="container box-compte mt-5">
                
                <form class="forms col-sm-12 col-md-6 col-lg-5 col-xl-4">
                <h3 class="mb-3 text-center">Mon profil</h3>
                <p class="text-center">Vérifier ou modifier vos informations. </p>
                    <div class="form-group row">
                        <label for="pseud" class="col-sm-5 col-form-label">Pseudo :</label>
                        <div>
                            <input style="color:grey;  text-transform: capitalize;" disabled type=" text"
                            value="<?= $pseudo?>" class="form-control" id="pseudo  " aria-describedby="emailHelp"
                            name="pseudo" placeholder="pseudo ">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="emailHelp" class="col-sm-5 col-form-label">Adresse-Email :</label>
                        <div>
                            <input style="color:grey" disabled value=" <?= $email ?>" type=" email" class="form-control"
                            id="emailHelp  " aria-describedby="emailHelp" name="email" placeholder="E-mail">
                            <small id="emailHelp" class="form-text text-muted">Ne partager jamais votre e-mail avec
                            quelqu'un d'autre.</small>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="tel" class="col-sm-5 col-form-label">N° Téléphone :</label>
                        <div>
                            <input style="color:grey" disabled value="<?= $tel ?>" type="tel" class="form-control"
                            id="tel  " aria-describedby="emailHelp" name="tel" placeholder="Téléphone">
                        </div>
                    </div>
                    <div class="form-group my-3">
                        <div>
                            <a href="edition_profil.php?id=<?=$id_annonceurs?>">
                                <button style=" color: #fff; text-decoration:none;" type="button"
                                class="btn btn-primary mb-5">Modifier</button>
                            </a>
                            <a href="delete_compte.php?id=<?=$id_annonceurs?>" onclick="return confirmDelete();">
                                <button style=" color: #fff; text-decoration:none;" type="button" name="submit"
                                class="btn btn-danger mb-5">Supprimer mon
                                compte </button>
                            </a>
                        </div>
                    </div>
                </form>
            </div>



        </div>
    </div>
    <!--javascript bootstrap
    <script src=" cdn/bootstrap5/js/bootstrap.js"></script>
-->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <!--javaSCript-->
    <script src="main.js"></script>
    <script src="//code.tidio.co/soutospimq4pk32r0mcxjjhtoqnjc0de.js" async></script>
</body>

</html>