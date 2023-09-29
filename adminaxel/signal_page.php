<?php
$rec =  $_GET['id'];
$rec2 =  $_GET['annonce'];
require '../conf/login_data.php';
$req = $loginData->prepare("SELECT * FROM annonces WHERE id_annonceurs = $rec AND id_annonces = $rec2 ");
$req->execute();
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
    <title><?= $data['titres'] ?></title>
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

                        <?php
                        /////////////////////////////////////
                        $req2 = $loginData->prepare("SELECT * FROM annonceurs WHERE id_annonceurs = $rec");
                        $req2->execute();
                        $data2 = $req2->fetch();
                        ?>

                        <div class="titre_img">
                            <h4 style="text-transform:capitalize;"><?= $data['titres'] ?></h4>
                            <div class="img_more">
                                <img id="coversupp" class="cover_transition" src="../<?= $data['img_cover'] ?>" alt="photos annonces">
                            </div>
                        </div>
                        <div class="img_supp">
                            <div>
                                <img onclick="clicksupp1();" id="supp1" src="../<?= $data['img_cover'] ?>" alt=" photos
                                    annonces">
                            </div>
                            <div>
                                <img onclick="clicksupp2();" id="supp2" src="../<?= $data['photo_1'] ?>" alt="photos supplémentaires 1">
                            </div>
                            <div>
                                <!-- lier tables -->
                                <img onclick="clicksupp3();" id="supp3" src="../<?= $data['photo_2'] ?>" alt="photos supplémentaires 2">
                            </div>
                            <div>
                                <img onclick="clicksupp4();" id="supp4" src="../<?= $data['photo_3'] ?>" alt="photos supplémentaires 3">
                            </div>
                            <div>
                                <img onclick="clicksupp5();" id="supp5" src="../<?= $data['photo_4'] ?>" alt="photos supplémentaires 4">
                            </div>
                            <div>
                                <img onclick="clicksupp6();" id="supp6" src="../<?= $data['photo_5'] ?>" alt="photos supplémentaires 5">
                            </div>
                            <div>
                                <img onclick="clicksupp7();" id="supp7" src="../<?= $data['photo_6'] ?>" alt="photos supplémentaires 6">
                            </div>
                        </div>
                        <div class="enligne">
                            <span>Mise en ligne le : <?= $data['date_add'] ?></span>
                            <span><i class="fa fa-eye"></i> <?= $data['views'] ?></span>
                            <span>Mise à jour : <?= $data['maj'] ?></span>
                        </div>
                        <div class="prixville table-responsive">
                            <table class="table border">
                                <tr>
                                    <th>Prix</th>
                                    <td><?= number_format($data['prix'], 0, '.', ' ')  ?> FCFA</td>

                                </tr>
                                <tr>
                                    <th>Quartier / ville</th>
                                    <td><?= $data['quartiers'] ?> / <?= $data['villes'] ?></td>
                                </tr>
                            </table>
                        </div>
                        <div class="description">
                            <h4>Description :</h4>
                            <p><?= $data['descriptions'] ?>
                            </p>
                        </div>
                        <div class="annonceur">
                            <p>Posté par :<span style="text-transform: capitalize;"> <?= $data2['pseudo'] ?></span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
    <!--javaSCript
    <script src="plus_details.js"></script>-->
    <script>
        //plus_de_details////
        let coversupp = document.getElementById("coversupp");
        let supp1 = document.getElementById("supp1");
        let supp2 = document.getElementById("supp2");
        let supp3 = document.getElementById("supp3");
        let supp4 = document.getElementById("supp4");
        let supp5 = document.getElementById("supp5");
        let supp6 = document.getElementById("supp6");
        let supp7 = document.getElementById("supp7");
        let change = document.getElementById("change");

        function clicksupp1() {
            coversupp.src = "../<?= $data['img_cover'] ?>";
            coversupp.alt = "photos annonces";
            supp1.style.border = "solid 2px #ec3e0e";
            supp2.style.border = "none";
            supp3.style.border = "none";
            supp4.style.border = "none";
            supp5.style.border = "none";
            supp6.style.border = "none";
            supp7.style.border = "none";
        }

        function clicksupp2() {
            coversupp.src = "../<?= $data['photo_1'] ?>";
            coversupp.alt = "photos supplémentaires 1";
            supp2.style.border = "solid 2px #ec3e0e";
            supp1.style.border = "none";
            supp3.style.border = "none";
            supp4.style.border = "none";
            supp5.style.border = "none";
            supp6.style.border = "none";
            supp7.style.border = "none";
        }

        function clicksupp3() {
            coversupp.src = "../<?= $data['photo_2'] ?>";
            coversupp.alt = "photos supplémentaires 2";
            supp3.style.border = "solid 2px #ec3e0e";
            supp1.style.border = "none";
            supp2.style.border = "none";
            supp4.style.border = "none";
            supp5.style.border = "none";
            supp6.style.border = "none";
            supp7.style.border = "none";
        }

        function clicksupp4() {
            coversupp.src = "../<?= $data['photo_3'] ?>";
            coversupp.alt = "photos supplémentaires 3";
            supp4.style.border = "solid 2px #ec3e0e";
            supp1.style.border = "none";
            supp2.style.border = "none";
            supp3.style.border = "none";
            supp5.style.border = "none";
            supp6.style.border = "none";
            supp7.style.border = "none";
        }

        function clicksupp5() {
            coversupp.src = "../<?= $data['photo_4'] ?>";
            coversupp.alt = "photos supplémentaires 4";
            supp5.style.border = "solid 2px #ec3e0e";
            supp1.style.border = "none";
            supp2.style.border = "none";
            supp3.style.border = "none";
            supp4.style.border = "none";
            supp6.style.border = "none";
            supp7.style.border = "none";
        }

        function clicksupp6() {
            coversupp.src = "../<?= $data['photo_5'] ?>";
            coversupp.alt = "photos supplémentaires 5";
            supp6.style.border = "solid 2px #ec3e0e";
            supp1.style.border = "none";
            supp2.style.border = "none";
            supp3.style.border = "none";
            supp4.style.border = "none";
            supp5.style.border = "none";
            supp7.style.border = "none";
        }

        function clicksupp7() {
            coversupp.src = "../<?= $data['photo_6'] ?>";
            coversupp.alt = "photos supplémentaires 6";
            supp7.style.border = "solid 2px #ec3e0e";
            supp1.style.border = "none";
            supp2.style.border = "none";
            supp3.style.border = "none";
            supp4.style.border = "none";
            supp5.style.border = "none";
            supp6.style.border = "none";
        }
    </script>
</body>

</html>t>
</body>

</html>