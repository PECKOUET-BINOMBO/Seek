<?php
session_start();
$rec =  $_GET['id'];
$rec2 =  $_GET['annonce'];
require 'conf/login_data.php';
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
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!--font google -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500&family=Open+Sans:wght@300;400&display=swap" rel="stylesheet">
    <!-- title bar icon -->
    <link rel="shortcut icon" type="imge/x-icon" href="img/title-bar-icon.png">
    <link rel="stylesheet" href="style.css">
    <title><?= $data['titres'] ?></title>
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

    <div class="container-fluid-xs container-xxl" style="padding-right: var(--bs-gutter-x, 0rem); overflow:hidden;">
        <div class="row">
            <?php include "header_contact.php" ?>
            <?php include "logo_menu.php" ?>


            <div class="container mt-5 mb-5 p-0">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-6 mx-2 border morebox">
                        <!-- <div>
                            <a href="mes_annonces.php"><button
                                    style="color: #fff;font-weight: 700;font-size:14px; text-decoration:none"
                                    class="prev btn btn-warning my-4 px-4  " type="button">Retour</button></a>
                        </div> -->
                        <?php
                        /////////////////////////////////////
                        $req2 = $loginData->prepare("SELECT * FROM annonceurs WHERE id_annonceurs = $rec");
                        $req2->execute();
                        $data2 = $req2->fetch();
                        /////////////////////////////////////
                        // $req3 = $loginData->prepare("SELECT * FROM photos_supplementaires WHERE id_annonces = $rec2");
                        // $req3->execute();
                        // $data3 = $req3->fetch();
                        ?>

                        <div class="titre_img">
                            <h4 style="text-transform:capitalize;"><?= $data['titres'] ?></h4>
                            <div class="img_more">
                                <img id="coversupp" class="cover_transition" src="<?= $data['img_cover'] ?>" alt="photos annonces">
                            </div>
                        </div>
                        <!-- lier tables -->
                        <div class="img_supp">
                            <?php if ($data['img_cover'] == 'photos_supplementaires/') : ?>

                                <?php
                            else : { ?>
                                    <div>
                                        <!-- lier tables -->
                                        <img onclick="clicksupp1();" id="supp1" src="<?= $data['img_cover'] ?>" alt="photos
                                    annonces">
                                    </div>
                            <?php
                                }

                            endif; ?>
                            <?php if ($data['photo_1'] == 'photos_supplementaires/') : ?>

                                <?php
                            else : { ?>
                                    <div>
                                        <!-- lier tables -->
                                        <img onclick="clicksupp2();" id="supp2" src="<?= $data['photo_1'] ?>" alt="photos supplémentaires 1">
                                    </div>
                            <?php
                                }

                            endif; ?>
                            <?php if ($data['photo_2'] == 'photos_supplementaires/') : ?>

                                <?php
                            else : { ?>
                                    <div>
                                        <!-- lier tables -->
                                        <img onclick="clicksupp3();" id="supp3" src="<?= $data['photo_2'] ?>" alt="photos supplémentaires 2">
                                    </div>
                            <?php
                                }

                            endif; ?>
                            <?php if ($data['photo_3'] == 'photos_supplementaires/') : ?>

                                <?php
                            else : { ?>
                                    <div>
                                        <!-- lier tables -->
                                        <img onclick="clicksupp4();" id="supp4" src="<?= $data['photo_3'] ?>" alt="photos supplémentaires 3">
                                    </div>
                            <?php
                                }

                            endif; ?>
                            <?php if ($data['photo_4'] == 'photos_supplementaires/') : ?>

                                <?php
                            else : { ?>
                                    <div>
                                        <!-- lier tables -->
                                        <img onclick="clicksupp5();" id="supp5" src="<?= $data['photo_4'] ?>" alt="photos supplémentaires 4">
                                    </div>
                            <?php
                                }

                            endif; ?>
                            <?php if ($data['photo_5'] == 'photos_supplementaires/') : ?>

                                <?php
                            else : { ?>
                                    <div>
                                        <!-- lier tables -->
                                        <img onclick="clicksupp6();" id="supp6" src="<?= $data['photo_5'] ?>" alt="photos supplémentaires 5">
                                    </div>
                            <?php
                                }

                            endif; ?>
                            <?php if ($data['photo_6'] == 'photos_supplementaires/') : ?>

                                <?php
                            else : { ?>
                                    <div>
                                        <!-- lier tables -->
                                        <img onclick="clicksupp7();" id="supp7" src="<?= $data['photo_6'] ?>" alt="photos supplémentaires 6">
                                    </div>
                            <?php
                                }

                            endif; ?>

                        </div>
                        <div class="enligne">
                            <span>Ajouté le : <?= date("d-m-Y", $data['date_add']) ?></span>
                            <span><i class="fa fa-eye"></i> <?= $data['views'] ?></span>
                            <span>MAJ : <?= $data['maj'] ?></span>
                        </div>
                        <div class="prixville table-responsive">
                            <table class="table border">
                                <tr>
                                    <th>Prix</th>
                                    <td class="text-success fw-bolder"><?= number_format($data['prix'], 0, '.', ' ')  ?> FCFA / <?= $data['periode'] ?></td>

                                </tr>
                                <tr>
                                    <th>Quartier / ville</th>
                                    <td><?= $data['quartiers'] ?> / <?= $data['villes'] ?></td>
                                </tr>
                                <tr>
                                    <th>Statut</th>
                                    <?php

                                    if ($data['etat'] == 'Disponible') { ?>
                                        <td class="fw-bolder text-success et">Disponible</td>
                                    <?php
                                    } elseif ($data['etat'] == 'Bientôt disponible') { ?>
                                        <td class="fw-bolder text-warning et">Bientôt disponible</td>
                                    <?php
                                    } else { ?>
                                        <td class="fw-bolder text-danger et">Occupé</td>
                                    <?php
                                    }


                                    ?>
                                </tr>
                            </table>

                        </div>
                        <div class="description">
                            <h4>Description :</h4>
                            <p><?= $data['descriptions'] ?>
                            </p>
                        </div>
                        <?php if ($_SESSION['id'] == $rec) : ?>
                            <div>
                                <button class="btn btn-secondary text-center px-1 mx-1">
                                    <a class="link-light" style="text-decoration:none; border-radius:5px; display:inline-block" href="update.php?id=<?= $rec ?>&annonce=<?= $rec2 ?>" title="Modifier l'annonce">Modifier</a>
                                </button>
                                <button class="btn btn-danger  text-center px-1 mx-1">
                                    <a class="link-light" style="text-decoration:none; border-radius:5px; display:inline-block" href="delete_annonce.php?id=<?= $rec ?>&annonce=<?= $rec2 ?>" onclick="return confirmDelete2();" title="Voire l'annonce">Supprimer</a>
                                </button>
                                <?php if ($data['statuts'] === "expiré") : ?>
                                    <button class="btn btn-success text-center px-1 mx-1">
                                        <a title="Renouveler l'annonce" class="text-light" style="text-decoration:none; border-radius:5px; display:inline-block" href="renouvellement.php?id=<?= $rec ?>&annonce=<?= $rec2 ?>">Renouveler
                                        </a>
                                    </button>

                                <?php endif; ?>
                            </div>
                        <?php endif; ?>

                    </div>
                </div>
            </div>

            <?php include "footer.php" ?>
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
            coversupp.src = "<?= $data['img_cover'] ?>";
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
            coversupp.src = "<?= $data['photo_1'] ?>";
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
            coversupp.src = "<?= $data['photo_2'] ?>";
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
            coversupp.src = "<?= $data['photo_3'] ?>";
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
            coversupp.src = "<?= $data['photo_4'] ?>";
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
            coversupp.src = "<?= $data['photo_5'] ?>";
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
            coversupp.src = "<?= $data['photo_6'] ?>";
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
    <!-- changement auto -->


    <?php
    if (!empty($data['img_cover']) && !empty($data['photo_1']) && !empty($data['photo_2'])) { ?>

        <script>
            let images1 = [
                "<?= $data['img_cover'] ?>",
                "<?= $data['photo_1'] ?>",
                "<?= $data['photo_2'] ?>"
            ];

            let iun = 0;

            function changeImage() {
                coversupp.src = images1[iun];
                supp1.style.border = "none";
                supp2.style.border = "none";
                supp3.style.border = "none";
                switch (iun) {
                    case 0:
                        supp1.style.border = "solid 2px #ec3e0e";
                        coversupp.alt = "photos couverture";
                        break;
                    case 1:
                        supp2.style.border = "solid 2px #ec3e0e";
                        coversupp.alt = "photos supplémentaires 1";
                        break;
                    case 2:
                        supp3.style.border = "solid 2px #ec3e0e";
                        coversupp.alt = "photos supplémentaires 2";
                        break;
                }
                iun++;
                if (iun == images1.length) {
                    iun = 0;
                }
            }

            setInterval(changeImage, 2500);
        </script>

    <?php }
    if (!empty($data['img_cover']) && !empty($data['photo_1']) && !empty($data['photo_2']) && !empty($data['photo_3'])) { ?>

        <script>
            let images2 = [
                "<?= $data['img_cover'] ?>",
                "<?= $data['photo_1'] ?>",
                "<?= $data['photo_2'] ?>",
                "<?= $data['photo_3'] ?>"
            ];

            let ideux = 0;

            function changeImage() {
                coversupp.src = images2[ideux];
                supp1.style.border = "none";
                supp2.style.border = "none";
                supp3.style.border = "none";
                supp4.style.border = "none";
                switch (ideux) {
                    case 0:
                        supp1.style.border = "solid 2px #ec3e0e";
                        coversupp.alt = "photos couverture";
                        break;
                    case 1:
                        supp2.style.border = "solid 2px #ec3e0e";
                        coversupp.alt = "photos supplémentaires 1";
                        break;
                    case 2:
                        supp3.style.border = "solid 2px #ec3e0e";
                        coversupp.alt = "photos supplémentaires 2";
                        break;
                    case 3:
                        supp4.style.border = "solid 2px #ec3e0e";
                        coversupp.alt = "photos supplémentaires 3";
                        break;
                }
                ideux++;
                if (ideux == images2.length) {
                    ideux = 0;
                }
            }

            setInterval(changeImage, 2500);
        </script>

    <?php }
    if (!empty($data['img_cover']) && !empty($data['photo_1']) && !empty($data['photo_2']) && !empty($data['photo_3']) && !empty($data['photo_4'])) { ?>

        <script>
            let images3 = [
                "<?= $data['img_cover'] ?>",
                "<?= $data['photo_1'] ?>",
                "<?= $data['photo_2'] ?>",
                "<?= $data['photo_3'] ?>",
                "<?= $data['photo_4'] ?>"
            ];

            let itrois = 0;

            function changeImage() {
                coversupp.src = images3[itrois];
                supp1.style.border = "none";
                supp2.style.border = "none";
                supp3.style.border = "none";
                supp4.style.border = "none";
                supp5.style.border = "none";
                switch (itrois) {
                    case 0:
                        supp1.style.border = "solid 2px #ec3e0e";
                        coversupp.alt = "photos couverture";
                        break;
                    case 1:
                        supp2.style.border = "solid 2px #ec3e0e";
                        coversupp.alt = "photos supplémentaires 1";
                        break;
                    case 2:
                        supp3.style.border = "solid 2px #ec3e0e";
                        coversupp.alt = "photos supplémentaires 2";
                        break;
                    case 3:
                        supp4.style.border = "solid 2px #ec3e0e";
                        coversupp.alt = "photos supplémentaires 3";
                        break;
                    case 4:
                        supp5.style.border = "solid 2px #ec3e0e";
                        coversupp.alt = "photos supplémentaires 4";
                        break;
                }
                itrois++;
                if (itrois == images3.length) {
                    itrois = 0;
                }
            }

            setInterval(changeImage, 2500);
        </script>

    <?php }
    if (!empty($data['img_cover']) && !empty($data['photo_1']) && !empty($data['photo_2']) && !empty($data['photo_3']) && !empty($data['photo_4']) && !empty($data['photo_5'])) { ?>

        <script>
            let images4 = [
                "<?= $data['img_cover'] ?>",
                "<?= $data['photo_1'] ?>",
                "<?= $data['photo_2'] ?>",
                "<?= $data['photo_3'] ?>",
                "<?= $data['photo_4'] ?>",
                "<?= $data['photo_5'] ?>"
            ];

            let iquatre = 0;

            function changeImage() {
                coversupp.src = images4[iquatre];
                supp1.style.border = "none";
                supp2.style.border = "none";
                supp3.style.border = "none";
                supp4.style.border = "none";
                supp5.style.border = "none";
                supp6.style.border = "none";
                switch (iquatre) {
                    case 0:
                        supp1.style.border = "solid 2px #ec3e0e";
                        coversupp.alt = "photos couverture";
                        break;
                    case 1:
                        supp2.style.border = "solid 2px #ec3e0e";
                        coversupp.alt = "photos supplémentaires 1";
                        break;
                    case 2:
                        supp3.style.border = "solid 2px #ec3e0e";
                        coversupp.alt = "photos supplémentaires 2";
                        break;
                    case 3:
                        supp4.style.border = "solid 2px #ec3e0e";
                        coversupp.alt = "photos supplémentaires 3";
                        break;
                    case 4:
                        supp5.style.border = "solid 2px #ec3e0e";
                        coversupp.alt = "photos supplémentaires 4";
                        break;
                    case 5:
                        supp6.style.border = "solid 2px #ec3e0e";
                        coversupp.alt = "photos supplémentaires 5";
                        break;
                }
                iquatre++;
                if (iquatre == images4.length) {
                    iquatre = 0;
                }
            }

            setInterval(changeImage, 2500);
        </script>

    <?php }
    if (!empty($data['img_cover']) && !empty($data['photo_1']) && !empty($data['photo_2']) && !empty($data['photo_3']) && !empty($data['photo_4']) && !empty($data['photo_5']) && !empty($data['photo_6'])) { ?>

        <script>
            let images = [
                "<?= $data['img_cover'] ?>",
                "<?= $data['photo_1'] ?>",
                "<?= $data['photo_2'] ?>",
                "<?= $data['photo_3'] ?>",
                "<?= $data['photo_4'] ?>",
                "<?= $data['photo_5'] ?>",
                "<?= $data['photo_6'] ?>"
            ];

            let i = 0;

            function changeImage() {
                coversupp.src = images[i];
                supp1.style.border = "none";
                supp2.style.border = "none";
                supp3.style.border = "none";
                supp4.style.border = "none";
                supp5.style.border = "none";
                supp6.style.border = "none";
                supp7.style.border = "none";
                switch (i) {
                    case 0:
                        supp1.style.border = "solid 2px #ec3e0e";
                        coversupp.alt = "photos couverture";
                        break;
                    case 1:
                        supp2.style.border = "solid 2px #ec3e0e";
                        coversupp.alt = "photos supplémentaires 1";
                        break;
                    case 2:
                        supp3.style.border = "solid 2px #ec3e0e";
                        coversupp.alt = "photos supplémentaires 2";
                        break;
                    case 3:
                        supp4.style.border = "solid 2px #ec3e0e";
                        coversupp.alt = "photos supplémentaires 3";
                        break;
                    case 4:
                        supp5.style.border = "solid 2px #ec3e0e";
                        coversupp.alt = "photos supplémentaires 4";
                        break;
                    case 5:
                        supp6.style.border = "solid 2px #ec3e0e";
                        coversupp.alt = "photos supplémentaires 5";
                        break;
                    case 6:
                        supp7.style.border = "solid 2px #ec3e0e";
                        coversupp.alt = "photos supplémentaires 6";
                        break;
                }
                i++;
                if (i == images.length) {
                    i = 0;
                }
            }

            setInterval(changeImage, 2500);
        </script>

    <?php }

    ?>
    <script src="//code.tidio.co/soutospimq4pk32r0mcxjjhtoqnjc0de.js" async></script>
    <script src="main.js"></script>
</body>

</html>
</body>

</html>