<?php
require 'conf/login_data.php';
require 'time_ago.php';
$types = isset($_GET['type']) ? $_GET['type'] : NULL;
$ville = isset($_GET['ville']) ? $_GET['ville'] : NULL;
$quartier = isset($_GET['quartier']) ? $_GET['quartier'] : NULL;
$min = isset($_GET['min']) ? $_GET['min'] : NULL;
$max = isset($_GET['max']) ? $_GET['max'] : NULL;
$oui = "oui";
?>
<!DOCTYPE html>
<html lang="fr">

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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!--sweetalert-->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!--font google -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500&family=Open+Sans:wght@300;400&display=swap" rel="stylesheet">
    <!-- title bar icon -->
    <link rel="shortcut icon" type="imge/x-icon" href="img/title-bar-icon.png">
    <link rel="stylesheet" href="style.css">
    <title>Offres recherchées</title>
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
        <div class="row scroll">
            <?php include "header_contact.php" ?>
            <?php include "logo_menu.php" ?>

            <div class="row ajust">
                <!-- bg & filtre-->
                <section class="bg-filtre">
                    <h1>Offres recherchées</h1>
                </section>

                <h5 class=" mb-3 py-1 px-3" style="background-color: #0b2239; color:#fff;">Trier par <div class="dropdown">
                    </div>
                    <i onclick="myFunction()" class="fa-solid fa-sort dropbtn"></i>
                    <div id="myDropdown" class="dropdown-content dropdown-content2">
                        <a href="">
                            <form method="POST"> <button style="border:none; background:transparent;" type="submit" name="+r">Plus récentes</button>
                            </form>
                        </a>
                        <a href="">
                            <form method="POST"> <button style="border:none; background:transparent;" type="submit" name="-r">Moins récentes</button>
                            </form>
                        </a>
                        <a href="">
                            <form method="POST"> <button style="border:none; background:transparent;" type="submit" name="+c">Plus chères</button>
                            </form>
                        </a>
                        <a href="">
                            <form method="POST"> <button style="border:none; background:transparent;" type="submit" name="-c">Moins chères</button>
                            </form>
                        </a>
                        <a href="">
                            <form method="POST"> <button style="border:none; background:transparent;" type="submit" name="pj">Par jour</button>
                            </form>
                        </a>
                        <a href="">
                            <form method="POST"> <button style="border:none; background:transparent;" type="submit" name="ps">Par semaine</button>
                            </form>
                        </a>
                        <a href="">
                            <form method="POST"> <button style="border:none; background:transparent;" type="submit" name="pm">Par mois</button>
                            </form>
                        </a>
                    </div>
                </h5>
            </div>
            <div class="row ajust">

                <div class="mycards">

                    <?php

                    ////////////////////////////////type/////////////////////////////
                    if (!empty($types) && empty($min) && empty($max) && empty($ville) && empty($quartier)) {
                        if (isset($_POST['+r'])) {
                            $oui = "oui";
                            $statuts = "en cours";
                            $req = $loginData->prepare("SELECT * FROM annonces WHERE types= ? AND valider = ? AND statuts = ? ORDER BY id_annonces DESC");
                            $req->execute(array($types, $oui, $statuts));
                            $reqcount = $req->rowCount();

                    if ($reqcount <= 0) {
                        $text ="Aucune annonce n'a été trouvée";
                    }else{
                        while ($resultat = $req->fetch(PDO::FETCH_ASSOC)) :

                            $today = $resultat["date_add"];
                            $limit_date = $resultat["date_expire"];
    
                            if ($today < $limit_date) {
                    ?>
                                <a href="plus_de_details.php?id=<?= $resultat['id_annonceurs'] ?>&annonce=<?= $resultat['id_annonces'] ?>" class=" mycard">
                                    <?php if ($resultat['options'] == "urgence") : ?>
                                        <p class="urgence">Urgence <i class="fa-solid fa-bell"></i></p>
                                    <?php endif; ?>
                                    <img src="<?= $resultat['img_cover'] ?>" class=" mycard__image">
                                    <div class="mycard__content">
                                        <p class="titre" style="text-transform:capitalize;"><?= $resultat['titres'] ?></p>
                                        <p class=" localisation"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                            <span class="vq">
                                                <?= $resultat['quartiers'] ?>,
                                                <?= $resultat['villes'] ?>
                                            </span>
                                        </p>
                                        <p class="descr"><?= $resultat['descriptions'] ?></p>
                                    </div>
                                    <div class="mycard__info">
    
                                        <div><span class="text-success fw-bolder"><?= number_format($resultat['prix'], 0, '.', ' ')  ?> FCFA<?= $resultat['periode'] ?></span></div>
                                        <div>Plus de détails</div>
                                    </div>
                                    <div class="mycard__time">
                                        <div>
                                            <i class="fa-solid fa-clock-rotate-left"></i>
                                            <?php echo time_ago($resultat['date_add']) ?>
                                        </div>
                                    </div>
                                </a>
    
                        <?php }
                        endwhile ;
                    } ?>
                    
                    <?php } elseif (isset($_POST['-r'])) {
                            $oui = "oui";
                            $statuts = "en cours";
                            $req = $loginData->prepare("SELECT * FROM annonces WHERE types= ? AND valider = ? AND statuts = ? ORDER BY id_annonces ASC");
                            $req->execute(array($types, $oui, $statuts));
                            $reqcount = $req->rowCount();

                    if ($reqcount <= 0) {
                        $text ="Aucune annonce n'a été trouvée";
                    }else{
                        while ($resultat = $req->fetch(PDO::FETCH_ASSOC)) :

                            $today = $resultat["date_add"];
                            $limit_date = $resultat["date_expire"];
    
                            if ($today < $limit_date) {
                    ?>
                                <a href="plus_de_details.php?id=<?= $resultat['id_annonceurs'] ?>&annonce=<?= $resultat['id_annonces'] ?>" class=" mycard">
                                    <?php if ($resultat['options'] == "urgence") : ?>
                                        <p class="urgence">Urgence <i class="fa-solid fa-bell"></i></p>
                                    <?php endif; ?>
                                    <img src="<?= $resultat['img_cover'] ?>" class=" mycard__image">
                                    <div class="mycard__content">
                                        <p class="titre" style="text-transform:capitalize;"><?= $resultat['titres'] ?></p>
                                        <p class=" localisation"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                            <span class="vq">
                                                <?= $resultat['quartiers'] ?>,
                                                <?= $resultat['villes'] ?>
                                            </span>
                                        </p>
                                        <p class="descr"><?= $resultat['descriptions'] ?></p>
                                    </div>
                                    <div class="mycard__info">
    
                                        <div><span class="text-success fw-bolder"><?= number_format($resultat['prix'], 0, '.', ' ')  ?> FCFA<?= $resultat['periode'] ?></span></div>
                                        <div>Plus de détails</div>
                                    </div>
                                    <div class="mycard__time">
                                        <div>
                                            <i class="fa-solid fa-clock-rotate-left"></i>
                                            <?php echo time_ago($resultat['date_add']) ?>
                                        </div>
                                    </div>
                                </a>
    
                        <?php }
                        endwhile ;
                    } ?>
                    
                    <?php } elseif (isset($_POST['+c'])) {
                            $oui = "oui";
                            $statuts = "en cours";
                            $req = $loginData->prepare("SELECT * FROM annonces WHERE types= ? AND valider = ? AND statuts = ? ORDER BY prix DESC");
                            $req->execute(array($types, $oui, $statuts));
                            $reqcount = $req->rowCount();

                            if ($reqcount <= 0) {
                                $text ="Aucune annonce n'a été trouvée";
                            }else{
                                while ($resultat = $req->fetch(PDO::FETCH_ASSOC)) :
        
                                    $today = $resultat["date_add"];
                                    $limit_date = $resultat["date_expire"];
            
                                    if ($today < $limit_date) {
                            ?>
                                        <a href="plus_de_details.php?id=<?= $resultat['id_annonceurs'] ?>&annonce=<?= $resultat['id_annonces'] ?>" class=" mycard">
                                            <?php if ($resultat['options'] == "urgence") : ?>
                                                <p class="urgence">Urgence <i class="fa-solid fa-bell"></i></p>
                                            <?php endif; ?>
                                            <img src="<?= $resultat['img_cover'] ?>" class=" mycard__image">
                                            <div class="mycard__content">
                                                <p class="titre" style="text-transform:capitalize;"><?= $resultat['titres'] ?></p>
                                                <p class=" localisation"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                                    <span class="vq">
                                                        <?= $resultat['quartiers'] ?>,
                                                        <?= $resultat['villes'] ?>
                                                    </span>
                                                </p>
                                                <p class="descr"><?= $resultat['descriptions'] ?></p>
                                            </div>
                                            <div class="mycard__info">
            
                                                <div><span class="text-success fw-bolder"><?= number_format($resultat['prix'], 0, '.', ' ')  ?> FCFA<?= $resultat['periode'] ?></span></div>
                                                <div>Plus de détails</div>
                                            </div>
                                            <div class="mycard__time">
                                                <div>
                                                    <i class="fa-solid fa-clock-rotate-left"></i>
                                                    <?php echo time_ago($resultat['date_add']) ?>
                                                </div>
                                            </div>
                                        </a>
            
                                <?php }
                                endwhile ;
                            } ?>
                            
                            <?php } elseif (isset($_POST['-c'])) {
                            $oui = "oui";
                            $statuts = "en cours";
                            $req = $loginData->prepare("SELECT * FROM annonces WHERE types= ? AND valider = ? AND statuts = ? ORDER BY prix ASC");
                            $req->execute(array($types, $oui, $statuts));
                            $reqcount = $req->rowCount();

                    if ($reqcount <= 0) {
                        $text ="Aucune annonce n'a été trouvée";
                    }else{
                        while ($resultat = $req->fetch(PDO::FETCH_ASSOC)) :

                            $today = $resultat["date_add"];
                            $limit_date = $resultat["date_expire"];
    
                            if ($today < $limit_date) {
                    ?>
                                <a href="plus_de_details.php?id=<?= $resultat['id_annonceurs'] ?>&annonce=<?= $resultat['id_annonces'] ?>" class=" mycard">
                                    <?php if ($resultat['options'] == "urgence") : ?>
                                        <p class="urgence">Urgence <i class="fa-solid fa-bell"></i></p>
                                    <?php endif; ?>
                                    <img src="<?= $resultat['img_cover'] ?>" class=" mycard__image">
                                    <div class="mycard__content">
                                        <p class="titre" style="text-transform:capitalize;"><?= $resultat['titres'] ?></p>
                                        <p class=" localisation"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                            <span class="vq">
                                                <?= $resultat['quartiers'] ?>,
                                                <?= $resultat['villes'] ?>
                                            </span>
                                        </p>
                                        <p class="descr"><?= $resultat['descriptions'] ?></p>
                                    </div>
                                    <div class="mycard__info">
    
                                        <div><span class="text-success fw-bolder"><?= number_format($resultat['prix'], 0, '.', ' ')  ?> FCFA<?= $resultat['periode'] ?></span></div>
                                        <div>Plus de détails</div>
                                    </div>
                                    <div class="mycard__time">
                                        <div>
                                            <i class="fa-solid fa-clock-rotate-left"></i>
                                            <?php echo time_ago($resultat['date_add']) ?>
                                        </div>
                                    </div>
                                </a>
    
                        <?php }
                        endwhile ;
                    } ?>
                    
                    <?php } elseif (isset($_POST['pj'])) {
                            $oui = "oui";
                            $statuts = "en cours";
                            $req = $loginData->prepare("SELECT * FROM annonces WHERE periode = 'Jour' AND types= ? AND valider = 'oui' AND statuts = 'en cours'");
                            $req->execute(array($types));
                            $reqcount = $req->rowCount();

                    if ($reqcount <= 0) {
                        $text ="Aucune annonce n'a été trouvée";
                    }else{
                        while ($resultat = $req->fetch(PDO::FETCH_ASSOC)) :

                            $today = $resultat["date_add"];
                            $limit_date = $resultat["date_expire"];
    
                            if ($today < $limit_date) {
                    ?>
                                <a href="plus_de_details.php?id=<?= $resultat['id_annonceurs'] ?>&annonce=<?= $resultat['id_annonces'] ?>" class=" mycard">
                                    <?php if ($resultat['options'] == "urgence") : ?>
                                        <p class="urgence">Urgence <i class="fa-solid fa-bell"></i></p>
                                    <?php endif; ?>
                                    <img src="<?= $resultat['img_cover'] ?>" class=" mycard__image">
                                    <div class="mycard__content">
                                        <p class="titre" style="text-transform:capitalize;"><?= $resultat['titres'] ?></p>
                                        <p class=" localisation"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                            <span class="vq">
                                                <?= $resultat['quartiers'] ?>,
                                                <?= $resultat['villes'] ?>
                                            </span>
                                        </p>
                                        <p class="descr"><?= $resultat['descriptions'] ?></p>
                                    </div>
                                    <div class="mycard__info">
    
                                        <div><span class="text-success fw-bolder"><?= number_format($resultat['prix'], 0, '.', ' ')  ?> FCFA<?= $resultat['periode'] ?></span></div>
                                        <div>Plus de détails</div>
                                    </div>
                                    <div class="mycard__time">
                                        <div>
                                            <i class="fa-solid fa-clock-rotate-left"></i>
                                            <?php echo time_ago($resultat['date_add']) ?>
                                        </div>
                                    </div>
                                </a>
    
                        <?php }
                        endwhile ;
                    } ?>
                    
                    
                    
                    <?php } elseif (isset($_POST['ps'])) {
                            $oui = "oui";
                            $statuts = "en cours";
                            $periode = "Semaine";
                            $req = $loginData->prepare("SELECT * FROM annonces WHERE periode = ? AND types= ? AND valider = ? AND statuts = ?");
                            $req->execute(array($periode, $types, $oui, $statuts));
                            $reqcount = $req->rowCount();

                            if ($reqcount <= 0) {
                                $text ="Aucune annonce n'a été trouvée";
                            }else{
                                while ($resultat = $req->fetch(PDO::FETCH_ASSOC)) :
        
                                    $today = $resultat["date_add"];
                                    $limit_date = $resultat["date_expire"];
            
                                    if ($today < $limit_date) {
                            ?>
                                        <a href="plus_de_details.php?id=<?= $resultat['id_annonceurs'] ?>&annonce=<?= $resultat['id_annonces'] ?>" class=" mycard">
                                            <?php if ($resultat['options'] == "urgence") : ?>
                                                <p class="urgence">Urgence <i class="fa-solid fa-bell"></i></p>
                                            <?php endif; ?>
                                            <img src="<?= $resultat['img_cover'] ?>" class=" mycard__image">
                                            <div class="mycard__content">
                                                <p class="titre" style="text-transform:capitalize;"><?= $resultat['titres'] ?></p>
                                                <p class=" localisation"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                                    <span class="vq">
                                                        <?= $resultat['quartiers'] ?>,
                                                        <?= $resultat['villes'] ?>
                                                    </span>
                                                </p>
                                                <p class="descr"><?= $resultat['descriptions'] ?></p>
                                            </div>
                                            <div class="mycard__info">
            
                                                <div><span class="text-success fw-bolder"><?= number_format($resultat['prix'], 0, '.', ' ')  ?> FCFA<?= $resultat['periode'] ?></span></div>
                                                <div>Plus de détails</div>
                                            </div>
                                            <div class="mycard__time">
                                                <div>
                                                    <i class="fa-solid fa-clock-rotate-left"></i>
                                                    <?php echo time_ago($resultat['date_add']) ?>
                                                </div>
                                            </div>
                                        </a>
            
                                <?php }
                                endwhile ;
                            } ?>
                            
                            <?php } elseif (isset($_POST['pm'])) {
                            $oui = "oui";
                            $statuts = "en cours";
                            $periode = "Mois";
                            $req = $loginData->prepare("SELECT * FROM annonces WHERE periode = ? AND types= ? AND valider = ? AND statuts = ?");
                            $req->execute(array($periode, $types, $oui, $statuts));
                            $reqcount = $req->rowCount();

                    if ($reqcount <= 0) {
                        $text ="Aucune annonce n'a été trouvée";
                    }else{
                        while ($resultat = $req->fetch(PDO::FETCH_ASSOC)) :

                            $today = $resultat["date_add"];
                            $limit_date = $resultat["date_expire"];
    
                            if ($today < $limit_date) {
                    ?>
                                <a href="plus_de_details.php?id=<?= $resultat['id_annonceurs'] ?>&annonce=<?= $resultat['id_annonces'] ?>" class=" mycard">
                                    <?php if ($resultat['options'] == "urgence") : ?>
                                        <p class="urgence">Urgence <i class="fa-solid fa-bell"></i></p>
                                    <?php endif; ?>
                                    <img src="<?= $resultat['img_cover'] ?>" class=" mycard__image">
                                    <div class="mycard__content">
                                        <p class="titre" style="text-transform:capitalize;"><?= $resultat['titres'] ?></p>
                                        <p class=" localisation"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                            <span class="vq">
                                                <?= $resultat['quartiers'] ?>,
                                                <?= $resultat['villes'] ?>
                                            </span>
                                        </p>
                                        <p class="descr"><?= $resultat['descriptions'] ?></p>
                                    </div>
                                    <div class="mycard__info">
    
                                        <div><span class="text-success fw-bolder"><?= number_format($resultat['prix'], 0, '.', ' ')  ?> FCFA<?= $resultat['periode'] ?></span></div>
                                        <div>Plus de détails</div>
                                    </div>
                                    <div class="mycard__time">
                                        <div>
                                            <i class="fa-solid fa-clock-rotate-left"></i>
                                            <?php echo time_ago($resultat['date_add']) ?>
                                        </div>
                                    </div>
                                </a>
    
                        <?php }
                        endwhile ;
                    } ?>
                    
                    <?php } else {
                            $statuts = "en cours";
                            $req = $loginData->prepare("SELECT * FROM annonces WHERE types= ? AND valider = ? AND statuts = ?");
                            $req->execute(array($types, $oui, $statuts));
                            
                            while ($resultat = $req->fetch(PDO::FETCH_ASSOC)) :
                                $today = $resultat["date_add"];
                                $limit_date = $resultat["date_expire"];

                                if ($today < $limit_date) {
                            ?>
                                    <a href="plus_de_details.php?id=<?= $resultat['id_annonceurs'] ?>&annonce=<?= $resultat['id_annonces'] ?>" class=" mycard">
                                        <?php if ($resultat['options'] == "urgence") : ?>
                                            <p class="urgence">Urgence <i class="fa-solid fa-bell"></i></p>
                                        <?php endif; ?>
                                        <img src="<?= $resultat['img_cover'] ?>" class=" mycard__image">
                                        <div class="mycard__content">
                                            <p class="titre"><?= $resultat['titres'] ?></p>
                                            <p class="localisation"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                                <span class="vq">
                                                    <?= $resultat['quartiers'] ?>,
                                                    <?= $resultat['villes'] ?>
                                                </span>
                                            </p>
                                            <p class="descr"><?= $resultat['descriptions'] ?></p>
                                        </div>
                                        <div class="mycard__info">

                                            <div><span class="text-success fw-bolder"><?= number_format($resultat['prix'], 0, '.', ' ')  ?> FCFA</span></div>
                                            <div>Plus de détails</div>
                                        </div>
                                        <div class="mycard__time">
                                            <div>
                                                <i class="fa-solid fa-clock-rotate-left"></i>
                                                <?php echo time_ago($resultat['date_add']) ?>
                                            </div>
                                        </div>
                                    </a>
                            <?php }
                            endwhile ?>
                            <?php }
                    }
                    //////////////ville/////////////////////////////////////
                    elseif (!empty($ville) && empty($types) && empty($min) && empty($max) && empty($quartier)) {
                        if (isset($_POST['+r'])) {
                            $oui = "oui";
                            $statuts = "en cours";
                            $req = $loginData->prepare("SELECT * FROM annonces WHERE villes= ? AND valider = ? AND statuts = ? ORDER BY id_annonces DESC");
                            $req->execute(array($ville, $oui, $statuts));
                            $reqcount = $req->rowCount();

                    if ($reqcount <= 0) {
                        $text ="Aucune annonce n'a été trouvée";
                    }else{
                        while ($resultat = $req->fetch(PDO::FETCH_ASSOC)) :

                            $today = $resultat["date_add"];
                            $limit_date = $resultat["date_expire"];
    
                            if ($today < $limit_date) {
                    ?>
                                <a href="plus_de_details.php?id=<?= $resultat['id_annonceurs'] ?>&annonce=<?= $resultat['id_annonces'] ?>" class=" mycard">
                                    <?php if ($resultat['options'] == "urgence") : ?>
                                        <p class="urgence">Urgence <i class="fa-solid fa-bell"></i></p>
                                    <?php endif; ?>
                                    <img src="<?= $resultat['img_cover'] ?>" class=" mycard__image">
                                    <div class="mycard__content">
                                        <p class="titre" style="text-transform:capitalize;"><?= $resultat['titres'] ?></p>
                                        <p class=" localisation"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                            <span class="vq">
                                                <?= $resultat['quartiers'] ?>,
                                                <?= $resultat['villes'] ?>
                                            </span>
                                        </p>
                                        <p class="descr"><?= $resultat['descriptions'] ?></p>
                                    </div>
                                    <div class="mycard__info">
    
                                        <div><span class="text-success fw-bolder"><?= number_format($resultat['prix'], 0, '.', ' ')  ?> FCFA<?= $resultat['periode'] ?></span></div>
                                        <div>Plus de détails</div>
                                    </div>
                                    <div class="mycard__time">
                                        <div>
                                            <i class="fa-solid fa-clock-rotate-left"></i>
                                            <?php echo time_ago($resultat['date_add']) ?>
                                        </div>
                                    </div>
                                </a>
    
                        <?php }
                        endwhile ;
                    } ?>
                    
                    <?php } elseif (isset($_POST['-r'])) {
                            $oui = "oui";
                            $statuts = "en cours";
                            $req = $loginData->prepare("SELECT * FROM annonces WHERE villes= ? AND valider = ? AND statuts = ? ORDER BY id_annonces ASC");
                            $req->execute(array($ville, $oui, $statuts));
                            $reqcount = $req->rowCount();

                            if ($reqcount <= 0) {
                                $text ="Aucune annonce n'a été trouvée";
                            }else{
                                while ($resultat = $req->fetch(PDO::FETCH_ASSOC)) :
        
                                    $today = $resultat["date_add"];
                                    $limit_date = $resultat["date_expire"];
            
                                    if ($today < $limit_date) {
                            ?>
                                        <a href="plus_de_details.php?id=<?= $resultat['id_annonceurs'] ?>&annonce=<?= $resultat['id_annonces'] ?>" class=" mycard">
                                            <?php if ($resultat['options'] == "urgence") : ?>
                                                <p class="urgence">Urgence <i class="fa-solid fa-bell"></i></p>
                                            <?php endif; ?>
                                            <img src="<?= $resultat['img_cover'] ?>" class=" mycard__image">
                                            <div class="mycard__content">
                                                <p class="titre" style="text-transform:capitalize;"><?= $resultat['titres'] ?></p>
                                                <p class=" localisation"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                                    <span class="vq">
                                                        <?= $resultat['quartiers'] ?>,
                                                        <?= $resultat['villes'] ?>
                                                    </span>
                                                </p>
                                                <p class="descr"><?= $resultat['descriptions'] ?></p>
                                            </div>
                                            <div class="mycard__info">
            
                                                <div><span class="text-success fw-bolder"><?= number_format($resultat['prix'], 0, '.', ' ')  ?> FCFA<?= $resultat['periode'] ?></span></div>
                                                <div>Plus de détails</div>
                                            </div>
                                            <div class="mycard__time">
                                                <div>
                                                    <i class="fa-solid fa-clock-rotate-left"></i>
                                                    <?php echo time_ago($resultat['date_add']) ?>
                                                </div>
                                            </div>
                                        </a>
            
                                <?php }
                                endwhile ;
                            } ?>
                            
                            <?php } elseif (isset($_POST['+c'])) {
                            $oui = "oui";
                            $statuts = "en cours";
                            $req = $loginData->prepare("SELECT * FROM annonces WHERE villes= ? AND valider = ? AND statuts = ? ORDER BY prix DESC");
                            $req->execute(array($ville, $oui, $statuts));
                            $reqcount = $req->rowCount();

                    if ($reqcount <= 0) {
                        $text ="Aucune annonce n'a été trouvée";
                    }else{
                        while ($resultat = $req->fetch(PDO::FETCH_ASSOC)) :

                            $today = $resultat["date_add"];
                            $limit_date = $resultat["date_expire"];
    
                            if ($today < $limit_date) {
                    ?>
                                <a href="plus_de_details.php?id=<?= $resultat['id_annonceurs'] ?>&annonce=<?= $resultat['id_annonces'] ?>" class=" mycard">
                                    <?php if ($resultat['options'] == "urgence") : ?>
                                        <p class="urgence">Urgence <i class="fa-solid fa-bell"></i></p>
                                    <?php endif; ?>
                                    <img src="<?= $resultat['img_cover'] ?>" class=" mycard__image">
                                    <div class="mycard__content">
                                        <p class="titre" style="text-transform:capitalize;"><?= $resultat['titres'] ?></p>
                                        <p class=" localisation"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                            <span class="vq">
                                                <?= $resultat['quartiers'] ?>,
                                                <?= $resultat['villes'] ?>
                                            </span>
                                        </p>
                                        <p class="descr"><?= $resultat['descriptions'] ?></p>
                                    </div>
                                    <div class="mycard__info">
    
                                        <div><span class="text-success fw-bolder"><?= number_format($resultat['prix'], 0, '.', ' ')  ?> FCFA<?= $resultat['periode'] ?></span></div>
                                        <div>Plus de détails</div>
                                    </div>
                                    <div class="mycard__time">
                                        <div>
                                            <i class="fa-solid fa-clock-rotate-left"></i>
                                            <?php echo time_ago($resultat['date_add']) ?>
                                        </div>
                                    </div>
                                </a>
    
                        <?php }
                        endwhile ;
                    } ?>
                    
                    <?php } elseif (isset($_POST['-c'])) {
                            $oui = "oui";
                            $statuts = "en cours";
                            $req = $loginData->prepare("SELECT * FROM annonces WHERE villes= ? AND valider = ? AND statuts = ? ORDER BY prix ASC");
                            $req->execute(array($ville, $oui, $statuts));
                            $reqcount = $req->rowCount();

                            if ($reqcount <= 0) {
                                $text ="Aucune annonce n'a été trouvée";
                            }else{
                                while ($resultat = $req->fetch(PDO::FETCH_ASSOC)) :
        
                                    $today = $resultat["date_add"];
                                    $limit_date = $resultat["date_expire"];
            
                                    if ($today < $limit_date) {
                            ?>
                                        <a href="plus_de_details.php?id=<?= $resultat['id_annonceurs'] ?>&annonce=<?= $resultat['id_annonces'] ?>" class=" mycard">
                                            <?php if ($resultat['options'] == "urgence") : ?>
                                                <p class="urgence">Urgence <i class="fa-solid fa-bell"></i></p>
                                            <?php endif; ?>
                                            <img src="<?= $resultat['img_cover'] ?>" class=" mycard__image">
                                            <div class="mycard__content">
                                                <p class="titre" style="text-transform:capitalize;"><?= $resultat['titres'] ?></p>
                                                <p class=" localisation"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                                    <span class="vq">
                                                        <?= $resultat['quartiers'] ?>,
                                                        <?= $resultat['villes'] ?>
                                                    </span>
                                                </p>
                                                <p class="descr"><?= $resultat['descriptions'] ?></p>
                                            </div>
                                            <div class="mycard__info">
            
                                                <div><span class="text-success fw-bolder"><?= number_format($resultat['prix'], 0, '.', ' ')  ?> FCFA<?= $resultat['periode'] ?></span></div>
                                                <div>Plus de détails</div>
                                            </div>
                                            <div class="mycard__time">
                                                <div>
                                                    <i class="fa-solid fa-clock-rotate-left"></i>
                                                    <?php echo time_ago($resultat['date_add']) ?>
                                                </div>
                                            </div>
                                        </a>
            
                                <?php }
                                endwhile ;
                            } ?>
                            
                            <?php } elseif (isset($_POST['pj'])) {
                            $oui = "oui";
                            $statuts = "en cours";
                            $periode = "Jour";
                            $req = $loginData->prepare("SELECT * FROM annonces WHERE periode = ? AND villes= ? AND valider = ? AND statuts = ?");
                            $req->execute(array($periode, $ville, $oui, $statuts));
                            $reqcount = $req->rowCount();

                    if ($reqcount <= 0) {
                        $text ="Aucune annonce n'a été trouvée";
                    }else{
                        while ($resultat = $req->fetch(PDO::FETCH_ASSOC)) :

                            $today = $resultat["date_add"];
                            $limit_date = $resultat["date_expire"];
    
                            if ($today < $limit_date) {
                    ?>
                                <a href="plus_de_details.php?id=<?= $resultat['id_annonceurs'] ?>&annonce=<?= $resultat['id_annonces'] ?>" class=" mycard">
                                    <?php if ($resultat['options'] == "urgence") : ?>
                                        <p class="urgence">Urgence <i class="fa-solid fa-bell"></i></p>
                                    <?php endif; ?>
                                    <img src="<?= $resultat['img_cover'] ?>" class=" mycard__image">
                                    <div class="mycard__content">
                                        <p class="titre" style="text-transform:capitalize;"><?= $resultat['titres'] ?></p>
                                        <p class=" localisation"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                            <span class="vq">
                                                <?= $resultat['quartiers'] ?>,
                                                <?= $resultat['villes'] ?>
                                            </span>
                                        </p>
                                        <p class="descr"><?= $resultat['descriptions'] ?></p>
                                    </div>
                                    <div class="mycard__info">
    
                                        <div><span class="text-success fw-bolder"><?= number_format($resultat['prix'], 0, '.', ' ')  ?> FCFA<?= $resultat['periode'] ?></span></div>
                                        <div>Plus de détails</div>
                                    </div>
                                    <div class="mycard__time">
                                        <div>
                                            <i class="fa-solid fa-clock-rotate-left"></i>
                                            <?php echo time_ago($resultat['date_add']) ?>
                                        </div>
                                    </div>
                                </a>
    
                        <?php }
                        endwhile ;
                    } ?>
                    
                    <?php } elseif (isset($_POST['ps'])) {
                            $oui = "oui";
                            $statuts = "en cours";
                            $periode = "Semaine";
                            $req = $loginData->prepare("SELECT * FROM annonces WHERE periode= ? AND villes= ? AND valider = ? AND statuts = ?");
                            $req->execute(array($periode, $ville, $oui, $statuts));
                            $reqcount = $req->rowCount();

                            if ($reqcount <= 0) {
                                $text ="Aucune annonce n'a été trouvée";
                            }else{
                                while ($resultat = $req->fetch(PDO::FETCH_ASSOC)) :
        
                                    $today = $resultat["date_add"];
                                    $limit_date = $resultat["date_expire"];
            
                                    if ($today < $limit_date) {
                            ?>
                                        <a href="plus_de_details.php?id=<?= $resultat['id_annonceurs'] ?>&annonce=<?= $resultat['id_annonces'] ?>" class=" mycard">
                                            <?php if ($resultat['options'] == "urgence") : ?>
                                                <p class="urgence">Urgence <i class="fa-solid fa-bell"></i></p>
                                            <?php endif; ?>
                                            <img src="<?= $resultat['img_cover'] ?>" class=" mycard__image">
                                            <div class="mycard__content">
                                                <p class="titre" style="text-transform:capitalize;"><?= $resultat['titres'] ?></p>
                                                <p class=" localisation"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                                    <span class="vq">
                                                        <?= $resultat['quartiers'] ?>,
                                                        <?= $resultat['villes'] ?>
                                                    </span>
                                                </p>
                                                <p class="descr"><?= $resultat['descriptions'] ?></p>
                                            </div>
                                            <div class="mycard__info">
            
                                                <div><span class="text-success fw-bolder"><?= number_format($resultat['prix'], 0, '.', ' ')  ?> FCFA<?= $resultat['periode'] ?></span></div>
                                                <div>Plus de détails</div>
                                            </div>
                                            <div class="mycard__time">
                                                <div>
                                                    <i class="fa-solid fa-clock-rotate-left"></i>
                                                    <?php echo time_ago($resultat['date_add']) ?>
                                                </div>
                                            </div>
                                        </a>
            
                                <?php }
                                endwhile ;
                            } ?>
                            
                            <?php } elseif (isset($_POST['pm'])) {
                            $oui = "oui";
                            $statuts = "en cours";
                            $periode = "Mois";
                            $req = $loginData->prepare("SELECT * FROM annonces WHERE periode = ? AND villes= ? AND valider = ? AND statuts = ?");
                            $req->execute(array($periode, $ville, $oui, $statuts));
                            $reqcount = $req->rowCount();

                    if ($reqcount <= 0) {
                        $text ="Aucune annonce n'a été trouvée";
                    }else{
                        while ($resultat = $req->fetch(PDO::FETCH_ASSOC)) :

                            $today = $resultat["date_add"];
                            $limit_date = $resultat["date_expire"];
    
                            if ($today < $limit_date) {
                    ?>
                                <a href="plus_de_details.php?id=<?= $resultat['id_annonceurs'] ?>&annonce=<?= $resultat['id_annonces'] ?>" class=" mycard">
                                    <?php if ($resultat['options'] == "urgence") : ?>
                                        <p class="urgence">Urgence <i class="fa-solid fa-bell"></i></p>
                                    <?php endif; ?>
                                    <img src="<?= $resultat['img_cover'] ?>" class=" mycard__image">
                                    <div class="mycard__content">
                                        <p class="titre" style="text-transform:capitalize;"><?= $resultat['titres'] ?></p>
                                        <p class=" localisation"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                            <span class="vq">
                                                <?= $resultat['quartiers'] ?>,
                                                <?= $resultat['villes'] ?>
                                            </span>
                                        </p>
                                        <p class="descr"><?= $resultat['descriptions'] ?></p>
                                    </div>
                                    <div class="mycard__info">
    
                                        <div><span class="text-success fw-bolder"><?= number_format($resultat['prix'], 0, '.', ' ')  ?> FCFA<?= $resultat['periode'] ?></span></div>
                                        <div>Plus de détails</div>
                                    </div>
                                    <div class="mycard__time">
                                        <div>
                                            <i class="fa-solid fa-clock-rotate-left"></i>
                                            <?php echo time_ago($resultat['date_add']) ?>
                                        </div>
                                    </div>
                                </a>
    
                        <?php }
                        endwhile ;
                    } ?>
                    
                    <?php } else {
                            $statuts = "en cours";
                            $req = $loginData->prepare("SELECT * FROM annonces WHERE villes= ? AND valider = ? AND statuts = ?");
                            $req->execute(array($ville, $oui, $statuts));
                            $reqcount = $req->rowCount();

                            if ($reqcount <= 0) {
                                $text ="Aucune annonce n'a été trouvée";
                            }else{
                                while ($resultat = $req->fetch(PDO::FETCH_ASSOC)) :
        
                                    $today = $resultat["date_add"];
                                    $limit_date = $resultat["date_expire"];
            
                                    if ($today < $limit_date) {
                            ?>
                                        <a href="plus_de_details.php?id=<?= $resultat['id_annonceurs'] ?>&annonce=<?= $resultat['id_annonces'] ?>" class=" mycard">
                                            <?php if ($resultat['options'] == "urgence") : ?>
                                                <p class="urgence">Urgence <i class="fa-solid fa-bell"></i></p>
                                            <?php endif; ?>
                                            <img src="<?= $resultat['img_cover'] ?>" class=" mycard__image">
                                            <div class="mycard__content">
                                                <p class="titre" style="text-transform:capitalize;"><?= $resultat['titres'] ?></p>
                                                <p class=" localisation"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                                    <span class="vq">
                                                        <?= $resultat['quartiers'] ?>,
                                                        <?= $resultat['villes'] ?>
                                                    </span>
                                                </p>
                                                <p class="descr"><?= $resultat['descriptions'] ?></p>
                                            </div>
                                            <div class="mycard__info">
            
                                                <div><span class="text-success fw-bolder"><?= number_format($resultat['prix'], 0, '.', ' ')  ?> FCFA<?= $resultat['periode'] ?></span></div>
                                                <div>Plus de détails</div>
                                            </div>
                                            <div class="mycard__time">
                                                <div>
                                                    <i class="fa-solid fa-clock-rotate-left"></i>
                                                    <?php echo time_ago($resultat['date_add']) ?>
                                                </div>
                                            </div>
                                        </a>
            
                                <?php }
                                endwhile ;
                            } ?>
                            
                            <?php }
                    }
                    //////quartier/////////////////////////////
                    elseif (!empty($quartier) && empty($types) && empty($min) && empty($max) && empty($ville)) {
                        if (isset($_POST['+r'])) {
                            $oui = "oui";
                            $statuts = "en cours";
                            $req = $loginData->prepare("SELECT * FROM annonces WHERE quartiers= ? AND valider = ? AND statuts = ? ORDER BY id_annonces DESC");
                            $req->execute(array($quartier, $oui, $statuts));
                            $reqcount = $req->rowCount();

                    if ($reqcount <= 0) {
                        $text ="Aucune annonce n'a été trouvée";
                    }else{
                        while ($resultat = $req->fetch(PDO::FETCH_ASSOC)) :

                            $today = $resultat["date_add"];
                            $limit_date = $resultat["date_expire"];
    
                            if ($today < $limit_date) {
                    ?>
                                <a href="plus_de_details.php?id=<?= $resultat['id_annonceurs'] ?>&annonce=<?= $resultat['id_annonces'] ?>" class=" mycard">
                                    <?php if ($resultat['options'] == "urgence") : ?>
                                        <p class="urgence">Urgence <i class="fa-solid fa-bell"></i></p>
                                    <?php endif; ?>
                                    <img src="<?= $resultat['img_cover'] ?>" class=" mycard__image">
                                    <div class="mycard__content">
                                        <p class="titre" style="text-transform:capitalize;"><?= $resultat['titres'] ?></p>
                                        <p class=" localisation"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                            <span class="vq">
                                                <?= $resultat['quartiers'] ?>,
                                                <?= $resultat['villes'] ?>
                                            </span>
                                        </p>
                                        <p class="descr"><?= $resultat['descriptions'] ?></p>
                                    </div>
                                    <div class="mycard__info">
    
                                        <div><span class="text-success fw-bolder"><?= number_format($resultat['prix'], 0, '.', ' ')  ?> FCFA<?= $resultat['periode'] ?></span></div>
                                        <div>Plus de détails</div>
                                    </div>
                                    <div class="mycard__time">
                                        <div>
                                            <i class="fa-solid fa-clock-rotate-left"></i>
                                            <?php echo time_ago($resultat['date_add']) ?>
                                        </div>
                                    </div>
                                </a>
    
                        <?php }
                        endwhile ;
                    } ?>
                    
                    <?php } elseif (isset($_POST['-r'])) {
                            $oui = "oui";
                            $statuts = "en cours";
                            $req = $loginData->prepare("SELECT * FROM annonces WHERE quartiers= ? AND valider = ? AND statuts = ? ORDER BY id_annonces ASC");
                            $req->execute(array($quartier, $oui, $statuts));
                            $reqcount = $req->rowCount();

                    if ($reqcount <= 0) {
                        $text ="Aucune annonce n'a été trouvée";
                    }else{
                        while ($resultat = $req->fetch(PDO::FETCH_ASSOC)) :

                            $today = $resultat["date_add"];
                            $limit_date = $resultat["date_expire"];
    
                            if ($today < $limit_date) {
                    ?>
                                <a href="plus_de_details.php?id=<?= $resultat['id_annonceurs'] ?>&annonce=<?= $resultat['id_annonces'] ?>" class=" mycard">
                                    <?php if ($resultat['options'] == "urgence") : ?>
                                        <p class="urgence">Urgence <i class="fa-solid fa-bell"></i></p>
                                    <?php endif; ?>
                                    <img src="<?= $resultat['img_cover'] ?>" class=" mycard__image">
                                    <div class="mycard__content">
                                        <p class="titre" style="text-transform:capitalize;"><?= $resultat['titres'] ?></p>
                                        <p class=" localisation"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                            <span class="vq">
                                                <?= $resultat['quartiers'] ?>,
                                                <?= $resultat['villes'] ?>
                                            </span>
                                        </p>
                                        <p class="descr"><?= $resultat['descriptions'] ?></p>
                                    </div>
                                    <div class="mycard__info">
    
                                        <div><span class="text-success fw-bolder"><?= number_format($resultat['prix'], 0, '.', ' ')  ?> FCFA<?= $resultat['periode'] ?></span></div>
                                        <div>Plus de détails</div>
                                    </div>
                                    <div class="mycard__time">
                                        <div>
                                            <i class="fa-solid fa-clock-rotate-left"></i>
                                            <?php echo time_ago($resultat['date_add']) ?>
                                        </div>
                                    </div>
                                </a>
    
                        <?php }
                        endwhile ;
                    } ?>
                    
                    <?php } elseif (isset($_POST['+c'])) {
                            $oui = "oui";
                            $statuts = "en cours";
                            $req = $loginData->prepare("SELECT * FROM annonces WHERE quartiers= ? AND valider = ? AND statuts = ? ORDER BY prix DESC");
                            $req->execute(array($quartier, $oui, $statuts));
                            $reqcount = $req->rowCount();

                            if ($reqcount <= 0) {
                                $text ="Aucune annonce n'a été trouvée";
                            }else{
                                while ($resultat = $req->fetch(PDO::FETCH_ASSOC)) :
        
                                    $today = $resultat["date_add"];
                                    $limit_date = $resultat["date_expire"];
            
                                    if ($today < $limit_date) {
                            ?>
                                        <a href="plus_de_details.php?id=<?= $resultat['id_annonceurs'] ?>&annonce=<?= $resultat['id_annonces'] ?>" class=" mycard">
                                            <?php if ($resultat['options'] == "urgence") : ?>
                                                <p class="urgence">Urgence <i class="fa-solid fa-bell"></i></p>
                                            <?php endif; ?>
                                            <img src="<?= $resultat['img_cover'] ?>" class=" mycard__image">
                                            <div class="mycard__content">
                                                <p class="titre" style="text-transform:capitalize;"><?= $resultat['titres'] ?></p>
                                                <p class=" localisation"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                                    <span class="vq">
                                                        <?= $resultat['quartiers'] ?>,
                                                        <?= $resultat['villes'] ?>
                                                    </span>
                                                </p>
                                                <p class="descr"><?= $resultat['descriptions'] ?></p>
                                            </div>
                                            <div class="mycard__info">
            
                                                <div><span class="text-success fw-bolder"><?= number_format($resultat['prix'], 0, '.', ' ')  ?> FCFA<?= $resultat['periode'] ?></span></div>
                                                <div>Plus de détails</div>
                                            </div>
                                            <div class="mycard__time">
                                                <div>
                                                    <i class="fa-solid fa-clock-rotate-left"></i>
                                                    <?php echo time_ago($resultat['date_add']) ?>
                                                </div>
                                            </div>
                                        </a>
            
                                <?php }
                                endwhile ;
                            } ?>
                            
                            <?php } elseif (isset($_POST['-c'])) {
                            $oui = "oui";
                            $statuts = "en cours";
                            $req = $loginData->prepare("SELECT * FROM annonces WHERE quartiers= ? AND valider = ? AND statuts = ? ORDER BY prix ASC");
                            $req->execute(array($quartier, $oui, $statuts));
                            $reqcount = $req->rowCount();

                    if ($reqcount <= 0) {
                        $text ="Aucune annonce n'a été trouvée";
                    }else{
                        while ($resultat = $req->fetch(PDO::FETCH_ASSOC)) :

                            $today = $resultat["date_add"];
                            $limit_date = $resultat["date_expire"];
    
                            if ($today < $limit_date) {
                    ?>
                                <a href="plus_de_details.php?id=<?= $resultat['id_annonceurs'] ?>&annonce=<?= $resultat['id_annonces'] ?>" class=" mycard">
                                    <?php if ($resultat['options'] == "urgence") : ?>
                                        <p class="urgence">Urgence <i class="fa-solid fa-bell"></i></p>
                                    <?php endif; ?>
                                    <img src="<?= $resultat['img_cover'] ?>" class=" mycard__image">
                                    <div class="mycard__content">
                                        <p class="titre" style="text-transform:capitalize;"><?= $resultat['titres'] ?></p>
                                        <p class=" localisation"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                            <span class="vq">
                                                <?= $resultat['quartiers'] ?>,
                                                <?= $resultat['villes'] ?>
                                            </span>
                                        </p>
                                        <p class="descr"><?= $resultat['descriptions'] ?></p>
                                    </div>
                                    <div class="mycard__info">
    
                                        <div><span class="text-success fw-bolder"><?= number_format($resultat['prix'], 0, '.', ' ')  ?> FCFA<?= $resultat['periode'] ?></span></div>    
                                        <div>Plus de détails</div>
                                    </div>
                                    <div class="mycard__time">
                                        <div>
                                            <i class="fa-solid fa-clock-rotate-left"></i>
                                            <?php echo time_ago($resultat['date_add']) ?>
                                        </div>
                                    </div>
                                </a>
    
                        <?php }
                        endwhile ;
                    } ?>
                    
                    <?php } elseif (isset($_POST['pj'])) {
                            $oui = "oui";
                            $statuts = "en cours";
                            $periode = "Jour";
                            $req = $loginData->prepare("SELECT * FROM annonces WHERE periode = ?  AND quartiers= ? AND valider = ? AND statuts = ?");
                            $req->execute(array($periode, $quartier, $oui, $statuts));
                            $reqcount = $req->rowCount();

                            if ($reqcount <= 0) {
                                $text ="Aucune annonce n'a été trouvée";
                            }else{
                                while ($resultat = $req->fetch(PDO::FETCH_ASSOC)) :
        
                                    $today = $resultat["date_add"];
                                    $limit_date = $resultat["date_expire"];
            
                                    if ($today < $limit_date) {
                            ?>
                                        <a href="plus_de_details.php?id=<?= $resultat['id_annonceurs'] ?>&annonce=<?= $resultat['id_annonces'] ?>" class=" mycard">
                                            <?php if ($resultat['options'] == "urgence") : ?>
                                                <p class="urgence">Urgence <i class="fa-solid fa-bell"></i></p>
                                            <?php endif; ?>
                                            <img src="<?= $resultat['img_cover'] ?>" class=" mycard__image">
                                            <div class="mycard__content">
                                                <p class="titre" style="text-transform:capitalize;"><?= $resultat['titres'] ?></p>
                                                <p class=" localisation"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                                    <span class="vq">
                                                        <?= $resultat['quartiers'] ?>,
                                                        <?= $resultat['villes'] ?>
                                                    </span>
                                                </p>
                                                <p class="descr"><?= $resultat['descriptions'] ?></p>
                                            </div>
                                            <div class="mycard__info">
            
                                                <div><span class="text-success fw-bolder"><?= number_format($resultat['prix'], 0, '.', ' ')  ?> FCFA<?= $resultat['periode'] ?></span></div>
                                                <div>Plus de détails</div>
                                            </div>
                                            <div class="mycard__time">
                                                <div>
                                                    <i class="fa-solid fa-clock-rotate-left"></i>
                                                    <?php echo time_ago($resultat['date_add']) ?>
                                                </div>
                                            </div>
                                        </a>
            
                                <?php }
                                endwhile ;
                            } ?>
                            
                            <?php } elseif (isset($_POST['ps'])) {
                            $oui = "oui";
                            $statuts = "en cours";
                            $periode = "Semaine";
                            $req = $loginData->prepare("SELECT * FROM annonces WHERE periode = ? AND quartiers= ? AND valider = ? AND statuts = ?");
                            $req->execute(array($periode, $quartier, $oui, $statuts));
                            $reqcount = $req->rowCount();

                    if ($reqcount <= 0) {
                        $text ="Aucune annonce n'a été trouvée";
                    }else{
                        while ($resultat = $req->fetch(PDO::FETCH_ASSOC)) :

                            $today = $resultat["date_add"];
                            $limit_date = $resultat["date_expire"];
    
                            if ($today < $limit_date) {
                    ?>
                                <a href="plus_de_details.php?id=<?= $resultat['id_annonceurs'] ?>&annonce=<?= $resultat['id_annonces'] ?>" class=" mycard">
                                    <?php if ($resultat['options'] == "urgence") : ?>
                                        <p class="urgence">Urgence <i class="fa-solid fa-bell"></i></p>
                                    <?php endif; ?>
                                    <img src="<?= $resultat['img_cover'] ?>" class=" mycard__image">
                                    <div class="mycard__content">
                                        <p class="titre" style="text-transform:capitalize;"><?= $resultat['titres'] ?></p>
                                        <p class=" localisation"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                            <span class="vq">
                                                <?= $resultat['quartiers'] ?>,
                                                <?= $resultat['villes'] ?>
                                            </span>
                                        </p>
                                        <p class="descr"><?= $resultat['descriptions'] ?></p>
                                    </div>
                                    <div class="mycard__info">
    
                                        <div><span class="text-success fw-bolder"><?= number_format($resultat['prix'], 0, '.', ' ')  ?> FCFA<?= $resultat['periode'] ?></span></div>
                                        <div>Plus de détails</div>
                                    </div>
                                    <div class="mycard__time">
                                        <div>
                                            <i class="fa-solid fa-clock-rotate-left"></i>
                                            <?php echo time_ago($resultat['date_add']) ?>
                                        </div>
                                    </div>
                                </a>
    
                        <?php }
                        endwhile ;
                    } ?>
                    
                    <?php } elseif (isset($_POST['pm'])) {
                            $oui = "oui";
                            $statuts = "en cours";
                            $periode = "Mois";
                            $req = $loginData->prepare("SELECT * FROM annonces WHERE periode = ? AND quartier= ? AND valider = ? AND statuts = ?");
                            $req->execute(array($periode, $quartier, $oui, $statuts));
                            $reqcount = $req->rowCount();

                            if ($reqcount <= 0) {
                                $text ="Aucune annonce n'a été trouvée";
                            }else{
                                while ($resultat = $req->fetch(PDO::FETCH_ASSOC)) :
        
                                    $today = $resultat["date_add"];
                                    $limit_date = $resultat["date_expire"];
            
                                    if ($today < $limit_date) {
                            ?>
                                        <a href="plus_de_details.php?id=<?= $resultat['id_annonceurs'] ?>&annonce=<?= $resultat['id_annonces'] ?>" class=" mycard">
                                            <?php if ($resultat['options'] == "urgence") : ?>
                                                <p class="urgence">Urgence <i class="fa-solid fa-bell"></i></p>
                                            <?php endif; ?>
                                            <img src="<?= $resultat['img_cover'] ?>" class=" mycard__image">
                                            <div class="mycard__content">
                                                <p class="titre" style="text-transform:capitalize;"><?= $resultat['titres'] ?></p>
                                                <p class=" localisation"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                                    <span class="vq">
                                                        <?= $resultat['quartiers'] ?>,
                                                        <?= $resultat['villes'] ?>
                                                    </span>
                                                </p>
                                                <p class="descr"><?= $resultat['descriptions'] ?></p>
                                            </div>
                                            <div class="mycard__info">
            
                                                <div><span class="text-success fw-bolder"><?= number_format($resultat['prix'], 0, '.', ' ')  ?> FCFA<?= $resultat['periode'] ?></span></div>
                                                <div>Plus de détails</div>
                                            </div>
                                            <div class="mycard__time">
                                                <div>
                                                    <i class="fa-solid fa-clock-rotate-left"></i>
                                                    <?php echo time_ago($resultat['date_add']) ?>
                                                </div>
                                            </div>
                                        </a>
            
                                <?php }
                                endwhile ;
                            } ?>
                            
                            <?php } else {
                            $statuts = "en cours";
                            $req = $loginData->prepare("SELECT * FROM annonces WHERE quartiers= ? AND valider = ? AND statuts = ?");
                            $req->execute(array($quartier, $oui, $statuts));
                            $reqcount = $req->rowCount();

                    if ($reqcount <= 0) {
                        $text ="Aucune annonce n'a été trouvée";
                    }else{
                        while ($resultat = $req->fetch(PDO::FETCH_ASSOC)) :

                            $today = $resultat["date_add"];
                            $limit_date = $resultat["date_expire"];
    
                            if ($today < $limit_date) {
                    ?>
                                <a href="plus_de_details.php?id=<?= $resultat['id_annonceurs'] ?>&annonce=<?= $resultat['id_annonces'] ?>" class=" mycard">
                                    <?php if ($resultat['options'] == "urgence") : ?>
                                        <p class="urgence">Urgence <i class="fa-solid fa-bell"></i></p>
                                    <?php endif; ?>
                                    <img src="<?= $resultat['img_cover'] ?>" class=" mycard__image">
                                    <div class="mycard__content">
                                        <p class="titre" style="text-transform:capitalize;"><?= $resultat['titres'] ?></p>
                                        <p class=" localisation"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                            <span class="vq">
                                                <?= $resultat['quartiers'] ?>,
                                                <?= $resultat['villes'] ?>
                                            </span>
                                        </p>
                                        <p class="descr"><?= $resultat['descriptions'] ?></p>
                                    </div>
                                    <div class="mycard__info">
    
                                        <div><span class="text-success fw-bolder"><?= number_format($resultat['prix'], 0, '.', ' ')  ?> FCFA<?= $resultat['periode'] ?></span></div>
                                        <div>Plus de détails</div>
                                    </div>
                                    <div class="mycard__time">
                                        <div>
                                            <i class="fa-solid fa-clock-rotate-left"></i>
                                            <?php echo time_ago($resultat['date_add']) ?>
                                        </div>
                                    </div>
                                </a>
    
                        <?php }
                        endwhile ;
                    } ?>
                    
                    <?php }
                    }
                    //////min/////////////////////////////
                    elseif (empty($quartier) && empty($types) && !empty($min) && empty($max) && empty($ville)) {
                        if (isset($_POST['+r'])) {
                            $oui = "oui";
                            $statuts = "en cours";
                            $req = $loginData->prepare("SELECT * FROM annonces WHERE prix >= ? AND valider = ? AND statuts = ? ORDER BY id_annonces DESC");
                            $req->execute(array($min, $oui, $statuts));
                            $reqcount = $req->rowCount();

                    if ($reqcount <= 0) {
                        $text ="Aucune annonce n'a été trouvée";
                    }else{
                        while ($resultat = $req->fetch(PDO::FETCH_ASSOC)) :

                            $today = $resultat["date_add"];
                            $limit_date = $resultat["date_expire"];
    
                            if ($today < $limit_date) {
                    ?>
                                <a href="plus_de_details.php?id=<?= $resultat['id_annonceurs'] ?>&annonce=<?= $resultat['id_annonces'] ?>" class=" mycard">
                                    <?php if ($resultat['options'] == "urgence") : ?>
                                        <p class="urgence">Urgence <i class="fa-solid fa-bell"></i></p>
                                    <?php endif; ?>
                                    <img src="<?= $resultat['img_cover'] ?>" class=" mycard__image">
                                    <div class="mycard__content">
                                        <p class="titre" style="text-transform:capitalize;"><?= $resultat['titres'] ?></p>
                                        <p class=" localisation"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                            <span class="vq">
                                                <?= $resultat['quartiers'] ?>,
                                                <?= $resultat['villes'] ?>
                                            </span>
                                        </p>
                                        <p class="descr"><?= $resultat['descriptions'] ?></p>
                                    </div>
                                    <div class="mycard__info">
    
                                        <div><span class="text-success fw-bolder"><?= number_format($resultat['prix'], 0, '.', ' ')  ?> FCFA<?= $resultat['periode'] ?></span></div>
                                        <div>Plus de détails</div>
                                    </div>
                                    <div class="mycard__time">
                                        <div>
                                            <i class="fa-solid fa-clock-rotate-left"></i>
                                            <?php echo time_ago($resultat['date_add']) ?>
                                        </div>
                                    </div>
                                </a>
    
                        <?php }
                        endwhile ;
                    } ?>
                    
                    <?php } elseif (isset($_POST['-r'])) {
                            $oui = "oui";
                            $statuts = "en cours";
                            $req = $loginData->prepare("SELECT * FROM annonces WHERE prix >= ? AND valider = ? AND statuts = ? ORDER BY id_annonces ASC");
                            $req->execute(array($min, $oui, $statuts));
                            $reqcount = $req->rowCount();

                    if ($reqcount <= 0) {
                        $text ="Aucune annonce n'a été trouvée";
                    }else{
                        while ($resultat = $req->fetch(PDO::FETCH_ASSOC)) :

                            $today = $resultat["date_add"];
                            $limit_date = $resultat["date_expire"];
    
                            if ($today < $limit_date) {
                    ?>
                                <a href="plus_de_details.php?id=<?= $resultat['id_annonceurs'] ?>&annonce=<?= $resultat['id_annonces'] ?>" class=" mycard">
                                    <?php if ($resultat['options'] == "urgence") : ?>
                                        <p class="urgence">Urgence <i class="fa-solid fa-bell"></i></p>
                                    <?php endif; ?>
                                    <img src="<?= $resultat['img_cover'] ?>" class=" mycard__image">
                                    <div class="mycard__content">
                                        <p class="titre" style="text-transform:capitalize;"><?= $resultat['titres'] ?></p>
                                        <p class=" localisation"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                            <span class="vq">
                                                <?= $resultat['quartiers'] ?>,
                                                <?= $resultat['villes'] ?>
                                            </span>
                                        </p>
                                        <p class="descr"><?= $resultat['descriptions'] ?></p>
                                    </div>
                                    <div class="mycard__info">
    
                                        <div><span class="text-success fw-bolder"><?= number_format($resultat['prix'], 0, '.', ' ')  ?> FCFA<?= $resultat['periode'] ?></span></div>
                                        <div>Plus de détails</div>
                                    </div>
                                    <div class="mycard__time">
                                        <div>
                                            <i class="fa-solid fa-clock-rotate-left"></i>
                                            <?php echo time_ago($resultat['date_add']) ?>
                                        </div>
                                    </div>
                                </a>
    
                        <?php }
                        endwhile ;
                    } ?>
                    
                    <?php } elseif (isset($_POST['+c'])) {
                            $oui = "oui";
                            $statuts = "en cours";
                            $req = $loginData->prepare("SELECT * FROM annonces WHERE prix >= ? AND valider = ? AND statuts = ? ORDER BY prix DESC");
                            $req->execute(array($min, $oui, $statuts));
                            $reqcount = $req->rowCount();

                    if ($reqcount <= 0) {
                        $text ="Aucune annonce n'a été trouvée";
                    }else{
                        while ($resultat = $req->fetch(PDO::FETCH_ASSOC)) :

                            $today = $resultat["date_add"];
                            $limit_date = $resultat["date_expire"];
    
                            if ($today < $limit_date) {
                    ?>
                                <a href="plus_de_details.php?id=<?= $resultat['id_annonceurs'] ?>&annonce=<?= $resultat['id_annonces'] ?>" class=" mycard">
                                    <?php if ($resultat['options'] == "urgence") : ?>
                                        <p class="urgence">Urgence <i class="fa-solid fa-bell"></i></p>
                                    <?php endif; ?>
                                    <img src="<?= $resultat['img_cover'] ?>" class=" mycard__image">
                                    <div class="mycard__content">
                                        <p class="titre" style="text-transform:capitalize;"><?= $resultat['titres'] ?></p>
                                        <p class=" localisation"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                            <span class="vq">
                                                <?= $resultat['quartiers'] ?>,
                                                <?= $resultat['villes'] ?>
                                            </span>
                                        </p>
                                        <p class="descr"><?= $resultat['descriptions'] ?></p>
                                    </div>
                                    <div class="mycard__info">
    
                                        <div><span class="text-success fw-bolder"><?= number_format($resultat['prix'], 0, '.', ' ')  ?> FCFA<?= $resultat['periode'] ?></span></div>
                                        <div>Plus de détails</div>
                                    </div>
                                    <div class="mycard__time">
                                        <div>
                                            <i class="fa-solid fa-clock-rotate-left"></i>
                                            <?php echo time_ago($resultat['date_add']) ?>
                                        </div>
                                    </div>
                                </a>
    
                        <?php }
                        endwhile ;
                    } ?>
                    
                    <?php } elseif (isset($_POST['-c'])) {
                            $oui = "oui";
                            $statuts = "en cours";
                            $req = $loginData->prepare("SELECT * FROM annonces WHERE prix >= ? AND valider = ? AND statuts = ? ORDER BY prix ASC");
                            $req->execute(array($min, $oui, $statuts));
                            $reqcount = $req->rowCount();

                    if ($reqcount <= 0) {
                        $text ="Aucune annonce n'a été trouvée";
                    }else{
                        while ($resultat = $req->fetch(PDO::FETCH_ASSOC)) :

                            $today = $resultat["date_add"];
                            $limit_date = $resultat["date_expire"];
    
                            if ($today < $limit_date) {
                    ?>
                                <a href="plus_de_details.php?id=<?= $resultat['id_annonceurs'] ?>&annonce=<?= $resultat['id_annonces'] ?>" class=" mycard">
                                    <?php if ($resultat['options'] == "urgence") : ?>
                                        <p class="urgence">Urgence <i class="fa-solid fa-bell"></i></p>
                                    <?php endif; ?>
                                    <img src="<?= $resultat['img_cover'] ?>" class=" mycard__image">
                                    <div class="mycard__content">
                                        <p class="titre" style="text-transform:capitalize;"><?= $resultat['titres'] ?></p>
                                        <p class=" localisation"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                            <span class="vq">
                                                <?= $resultat['quartiers'] ?>,
                                                <?= $resultat['villes'] ?>
                                            </span>
                                        </p>
                                        <p class="descr"><?= $resultat['descriptions'] ?></p>
                                    </div>
                                    <div class="mycard__info">
    
                                        <div><span class="text-success fw-bolder"><?= number_format($resultat['prix'], 0, '.', ' ')  ?> FCFA<?= $resultat['periode'] ?></span></div>
                                        <div>Plus de détails</div>
                                    </div>
                                    <div class="mycard__time">
                                        <div>
                                            <i class="fa-solid fa-clock-rotate-left"></i>
                                            <?php echo time_ago($resultat['date_add']) ?>
                                        </div>
                                    </div>
                                </a>
    
                        <?php }
                        endwhile ;
                    } ?>
                    
                    <?php } elseif (isset($_POST['pj'])) {
                            $oui = "oui";
                            $statuts = "en cours";
                            $periode = "Jour";
                            $req = $loginData->prepare("SELECT * FROM annonces WHERE periode = ? AND prix >= ? AND valider = ? AND statuts = ?");
                            $req->execute(array($periode, $min, $oui, $statuts));
                           $reqcount = $req->rowCount();

                    if ($reqcount <= 0) {
                        $text ="Aucune annonce n'a été trouvée";
                    }else{
                        while ($resultat = $req->fetch(PDO::FETCH_ASSOC)) :

                            $today = $resultat["date_add"];
                            $limit_date = $resultat["date_expire"];
    
                            if ($today < $limit_date) {
                    ?>
                                <a href="plus_de_details.php?id=<?= $resultat['id_annonceurs'] ?>&annonce=<?= $resultat['id_annonces'] ?>" class=" mycard">
                                    <?php if ($resultat['options'] == "urgence") : ?>
                                        <p class="urgence">Urgence <i class="fa-solid fa-bell"></i></p>
                                    <?php endif; ?>
                                    <img src="<?= $resultat['img_cover'] ?>" class=" mycard__image">
                                    <div class="mycard__content">
                                        <p class="titre" style="text-transform:capitalize;"><?= $resultat['titres'] ?></p>
                                        <p class=" localisation"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                            <span class="vq">
                                                <?= $resultat['quartiers'] ?>,
                                                <?= $resultat['villes'] ?>
                                            </span>
                                        </p>
                                        <p class="descr"><?= $resultat['descriptions'] ?></p>
                                    </div>
                                    <div class="mycard__info">
    
                                        <div><span class="text-success fw-bolder"><?= number_format($resultat['prix'], 0, '.', ' ')  ?> FCFA<?= $resultat['periode'] ?></span></div>
                                        <div>Plus de détails</div>
                                    </div>
                                    <div class="mycard__time">
                                        <div>
                                            <i class="fa-solid fa-clock-rotate-left"></i>
                                            <?php echo time_ago($resultat['date_add']) ?>
                                        </div>
                                    </div>
                                </a>
    
                        <?php }
                        endwhile ;
                    } ?>
                    
                    <?php } elseif (isset($_POST['ps'])) {
                            $oui = "oui";
                            $statuts = "en cours";
                            $periode = "Semaine";
                            $req = $loginData->prepare("SELECT * FROM annonces WHERE periode = ? AND prix >= ? AND valider = ? AND statuts = ?");
                            $req->execute(array($periode, $min, $oui, $statuts));
                           $reqcount = $req->rowCount();

                    if ($reqcount <= 0) {
                        $text ="Aucune annonce n'a été trouvée";
                    }else{
                        while ($resultat = $req->fetch(PDO::FETCH_ASSOC)) :

                            $today = $resultat["date_add"];
                            $limit_date = $resultat["date_expire"];
    
                            if ($today < $limit_date) {
                    ?>
                                <a href="plus_de_details.php?id=<?= $resultat['id_annonceurs'] ?>&annonce=<?= $resultat['id_annonces'] ?>" class=" mycard">
                                    <?php if ($resultat['options'] == "urgence") : ?>
                                        <p class="urgence">Urgence <i class="fa-solid fa-bell"></i></p>
                                    <?php endif; ?>
                                    <img src="<?= $resultat['img_cover'] ?>" class=" mycard__image">
                                    <div class="mycard__content">
                                        <p class="titre" style="text-transform:capitalize;"><?= $resultat['titres'] ?></p>
                                        <p class=" localisation"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                            <span class="vq">
                                                <?= $resultat['quartiers'] ?>,
                                                <?= $resultat['villes'] ?>
                                            </span>
                                        </p>
                                        <p class="descr"><?= $resultat['descriptions'] ?></p>
                                    </div>
                                    <div class="mycard__info">
    
                                        <div><span class="text-success fw-bolder"><?= number_format($resultat['prix'], 0, '.', ' ')  ?> FCFA<?= $resultat['periode'] ?></span></div>
                                        <div>Plus de détails</div>
                                    </div>
                                    <div class="mycard__time">
                                        <div>
                                            <i class="fa-solid fa-clock-rotate-left"></i>
                                            <?php echo time_ago($resultat['date_add']) ?>
                                        </div>
                                    </div>
                                </a>
    
                        <?php }
                        endwhile ;
                    } ?>
                    
                    <?php } elseif (isset($_POST['pm'])) {
                            $oui = "oui";
                            $statuts = "en cours";
                            $periode = "Mois";
                            $req = $loginData->prepare("SELECT * FROM annonces WHERE periode = ? AND prix >= ? AND valider = ? AND statuts = ?");
                            $req->execute(array($periode, $min, $oui, $statuts));
                            $reqcount = $req->rowCount();

                    if ($reqcount <= 0) {
                        $text ="Aucune annonce n'a été trouvée";
                    }else{
                        while ($resultat = $req->fetch(PDO::FETCH_ASSOC)) :

                            $today = $resultat["date_add"];
                            $limit_date = $resultat["date_expire"];
    
                            if ($today < $limit_date) {
                    ?>
                                <a href="plus_de_details.php?id=<?= $resultat['id_annonceurs'] ?>&annonce=<?= $resultat['id_annonces'] ?>" class=" mycard">
                                    <?php if ($resultat['options'] == "urgence") : ?>
                                        <p class="urgence">Urgence <i class="fa-solid fa-bell"></i></p>
                                    <?php endif; ?>
                                    <img src="<?= $resultat['img_cover'] ?>" class=" mycard__image">
                                    <div class="mycard__content">
                                        <p class="titre" style="text-transform:capitalize;"><?= $resultat['titres'] ?></p>
                                        <p class=" localisation"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                            <span class="vq">
                                                <?= $resultat['quartiers'] ?>,
                                                <?= $resultat['villes'] ?>
                                            </span>
                                        </p>
                                        <p class="descr"><?= $resultat['descriptions'] ?></p>
                                    </div>
                                    <div class="mycard__info">
    
                                        <div><span class="text-success fw-bolder"><?= number_format($resultat['prix'], 0, '.', ' ')  ?> FCFA<?= $resultat['periode'] ?></span></div>
                                        <div>Plus de détails</div>
                                    </div>
                                    <div class="mycard__time">
                                        <div>
                                            <i class="fa-solid fa-clock-rotate-left"></i>
                                            <?php echo time_ago($resultat['date_add']) ?>
                                        </div>
                                    </div>
                                </a>
    
                        <?php }
                        endwhile ;
                    } ?>
                    
                    <?php } else {
                            $statuts = "en cours";
                            $req = $loginData->prepare("SELECT * FROM annonces WHERE prix >= ? AND valider = ? AND statuts = ?");
                            $req->execute(array($min, $oui, $statuts));
                            $reqcount = $req->rowCount();

                            if ($reqcount <= 0) {
                                $text ="Aucune annonce n'a été trouvée";
                            }else{
                                while ($resultat = $req->fetch(PDO::FETCH_ASSOC)) :
        
                                    $today = $resultat["date_add"];
                                    $limit_date = $resultat["date_expire"];
            
                                    if ($today < $limit_date) {
                            ?>
                                        <a href="plus_de_details.php?id=<?= $resultat['id_annonceurs'] ?>&annonce=<?= $resultat['id_annonces'] ?>" class=" mycard">
                                            <?php if ($resultat['options'] == "urgence") : ?>
                                                <p class="urgence">Urgence <i class="fa-solid fa-bell"></i></p>
                                            <?php endif; ?>
                                            <img src="<?= $resultat['img_cover'] ?>" class=" mycard__image">
                                            <div class="mycard__content">
                                                <p class="titre" style="text-transform:capitalize;"><?= $resultat['titres'] ?></p>
                                                <p class=" localisation"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                                    <span class="vq">
                                                        <?= $resultat['quartiers'] ?>,
                                                        <?= $resultat['villes'] ?>
                                                    </span>
                                                </p>
                                                <p class="descr"><?= $resultat['descriptions'] ?></p>
                                            </div>
                                            <div class="mycard__info">
            
                                                <div><span class="text-success fw-bolder"><?= number_format($resultat['prix'], 0, '.', ' ')  ?> FCFA<?= $resultat['periode'] ?></span></div>
                                                <div>Plus de détails</div>
                                            </div>
                                            <div class="mycard__time">
                                                <div>
                                                    <i class="fa-solid fa-clock-rotate-left"></i>
                                                    <?php echo time_ago($resultat['date_add']) ?>
                                                </div>
                                            </div>
                                        </a>
            
                                <?php }
                                endwhile ;
                            } ?>
                            
                            <?php }
                    }
                    //////max/////////////////////////////
                    elseif (empty($quartier) && empty($types) && empty($min) && !empty($max) && empty($ville)) {
                        if (isset($_POST['+r'])) {
                            $oui = "oui";
                            $statuts = "en cours";
                            $req = $loginData->prepare("SELECT * FROM annonces WHERE prix <= ? AND valider = ? AND statuts = ? ORDER BY id_annonces DESC");
                            $req->execute(array($max, $oui, $statuts));
                           $reqcount = $req->rowCount();

                    if ($reqcount <= 0) {
                        $text ="Aucune annonce n'a été trouvée";
                    }else{
                        while ($resultat = $req->fetch(PDO::FETCH_ASSOC)) :

                            $today = $resultat["date_add"];
                            $limit_date = $resultat["date_expire"];
    
                            if ($today < $limit_date) {
                    ?>
                                <a href="plus_de_details.php?id=<?= $resultat['id_annonceurs'] ?>&annonce=<?= $resultat['id_annonces'] ?>" class=" mycard">
                                    <?php if ($resultat['options'] == "urgence") : ?>
                                        <p class="urgence">Urgence <i class="fa-solid fa-bell"></i></p>
                                    <?php endif; ?>
                                    <img src="<?= $resultat['img_cover'] ?>" class=" mycard__image">
                                    <div class="mycard__content">
                                        <p class="titre" style="text-transform:capitalize;"><?= $resultat['titres'] ?></p>
                                        <p class=" localisation"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                            <span class="vq">
                                                <?= $resultat['quartiers'] ?>,
                                                <?= $resultat['villes'] ?>
                                            </span>
                                        </p>
                                        <p class="descr"><?= $resultat['descriptions'] ?></p>
                                    </div>
                                    <div class="mycard__info">
    
                                        <div><span class="text-success fw-bolder"><?= number_format($resultat['prix'], 0, '.', ' ')  ?> FCFA<?= $resultat['periode'] ?></span></div>
                                        <div>Plus de détails</div>
                                    </div>
                                    <div class="mycard__time">
                                        <div>
                                            <i class="fa-solid fa-clock-rotate-left"></i>
                                            <?php echo time_ago($resultat['date_add']) ?>
                                        </div>
                                    </div>
                                </a>
    
                        <?php }
                        endwhile ;
                    } ?>
                    
                    <?php } elseif (isset($_POST['-r'])) {
                            $oui = "oui";
                            $statuts = "en cours";
                            $req = $loginData->prepare("SELECT * FROM annonces WHERE prix <= ? AND valider = ? AND statuts = ? ORDER BY id_annonces ASC");
                            $req->execute(array($max, $oui, $statuts));
                           $reqcount = $req->rowCount();

                    if ($reqcount <= 0) {
                        $text ="Aucune annonce n'a été trouvée";
                    }else{
                        while ($resultat = $req->fetch(PDO::FETCH_ASSOC)) :

                            $today = $resultat["date_add"];
                            $limit_date = $resultat["date_expire"];
    
                            if ($today < $limit_date) {
                    ?>
                                <a href="plus_de_details.php?id=<?= $resultat['id_annonceurs'] ?>&annonce=<?= $resultat['id_annonces'] ?>" class=" mycard">
                                    <?php if ($resultat['options'] == "urgence") : ?>
                                        <p class="urgence">Urgence <i class="fa-solid fa-bell"></i></p>
                                    <?php endif; ?>
                                    <img src="<?= $resultat['img_cover'] ?>" class=" mycard__image">
                                    <div class="mycard__content">
                                        <p class="titre" style="text-transform:capitalize;"><?= $resultat['titres'] ?></p>
                                        <p class=" localisation"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                            <span class="vq">
                                                <?= $resultat['quartiers'] ?>,
                                                <?= $resultat['villes'] ?>
                                            </span>
                                        </p>
                                        <p class="descr"><?= $resultat['descriptions'] ?></p>
                                    </div>
                                    <div class="mycard__info">
    
                                        <div><span class="text-success fw-bolder"><?= number_format($resultat['prix'], 0, '.', ' ')  ?> FCFA<?= $resultat['periode'] ?></span></div>
                                        <div>Plus de détails</div>
                                    </div>
                                    <div class="mycard__time">
                                        <div>
                                            <i class="fa-solid fa-clock-rotate-left"></i>
                                            <?php echo time_ago($resultat['date_add']) ?>
                                        </div>
                                    </div>
                                </a>
    
                        <?php }
                        endwhile ;
                    } ?>
                    
                    <?php } elseif (isset($_POST['+c'])) {
                            $oui = "oui";
                            $statuts = "en cours";
                            $req = $loginData->prepare("SELECT * FROM annonces WHERE prix <= ? AND valider = ? AND statuts = ? ORDER BY prix DESC");
                            $req->execute(array($max, $oui, $statuts));
                            $reqcount = $req->rowCount();

                    if ($reqcount <= 0) {
                        $text ="Aucune annonce n'a été trouvée";
                    }else{
                        while ($resultat = $req->fetch(PDO::FETCH_ASSOC)) :

                            $today = $resultat["date_add"];
                            $limit_date = $resultat["date_expire"];
    
                            if ($today < $limit_date) {
                    ?>
                                <a href="plus_de_details.php?id=<?= $resultat['id_annonceurs'] ?>&annonce=<?= $resultat['id_annonces'] ?>" class=" mycard">
                                    <?php if ($resultat['options'] == "urgence") : ?>
                                        <p class="urgence">Urgence <i class="fa-solid fa-bell"></i></p>
                                    <?php endif; ?>
                                    <img src="<?= $resultat['img_cover'] ?>" class=" mycard__image">
                                    <div class="mycard__content">
                                        <p class="titre" style="text-transform:capitalize;"><?= $resultat['titres'] ?></p>
                                        <p class=" localisation"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                            <span class="vq">
                                                <?= $resultat['quartiers'] ?>,
                                                <?= $resultat['villes'] ?>
                                            </span>
                                        </p>
                                        <p class="descr"><?= $resultat['descriptions'] ?></p>
                                    </div>
                                    <div class="mycard__info">
    
                                        <div><span class="text-success fw-bolder"><?= number_format($resultat['prix'], 0, '.', ' ')  ?> FCFA<?= $resultat['periode'] ?></span></div>
                                        <div>Plus de détails</div>
                                    </div>
                                    <div class="mycard__time">
                                        <div>
                                            <i class="fa-solid fa-clock-rotate-left"></i>
                                            <?php echo time_ago($resultat['date_add']) ?>
                                        </div>
                                    </div>
                                </a>
    
                        <?php }
                        endwhile ;
                    } ?>
                    
                    <?php } elseif (isset($_POST['-c'])) {
                            $oui = "oui";
                            $statuts = "en cours";
                            $req = $loginData->prepare("SELECT * FROM annonces WHERE prix <= ? AND valider = ? AND statuts = ? ORDER BY prix ASC");
                            $req->execute(array($max, $oui, $statuts));
                            while ($resultat = $req->fetch(PDO::FETCH_ASSOC)) :
                                $today = $resultat["date_add"];
                                $limit_date = $resultat["date_expire"];

                                if ($today < $limit_date) {
                            ?>
                                    <a href="plus_de_details.php?id=<?= $resultat['id_annonceurs'] ?>&annonce=<?= $resultat['id_annonces'] ?>" class=" mycard">
                                        <?php if ($resultat['options'] == "urgence") : ?>
                                            <p class="urgence">Urgence <i class="fa-solid fa-bell"></i></p>
                                        <?php endif; ?>
                                        <img src="<?= $resultat['img_cover'] ?>" class=" mycard__image">
                                        <div class="mycard__content">
                                            <p class="titre"><?= $resultat['titres'] ?></p>
                                            <p class="localisation"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                                <span class="vq">
                                                    <?= $resultat['quartiers'] ?>,
                                                    <?= $resultat['villes'] ?>
                                                </span>
                                            </p>
                                            <p class="descr"><?= $resultat['descriptions'] ?></p>
                                        </div>
                                        <div class="mycard__info">

                                            <div><span class="text-success fw-bolder"><?= number_format($resultat['prix'], 0, '.', ' ')  ?> FCFA</span></div>
                                            <div>Plus de détails</div>
                                        </div>
                                        <div class="mycard__time">
                                            <div>
                                                <i class="fa-solid fa-clock-rotate-left"></i>
                                                <?php echo time_ago($resultat['date_add']) ?>
                                            </div>
                                        </div>
                                    </a>
                            <?php }
                            endwhile ?>
                            <?php } elseif (isset($_POST['pj'])) {
                            $oui = "oui";
                            $statuts = "en cours";
                            $periode = "Jour";
                            $req = $loginData->prepare("SELECT * FROM annonces WHERE periode = ? AND prix <= ? AND valider = ? AND statuts = ?");
                            $req->execute(array($periode, $max, $oui, $statuts));
                           $reqcount = $req->rowCount();

                    if ($reqcount <= 0) {
                        $text ="Aucune annonce n'a été trouvée";
                    }else{
                        while ($resultat = $req->fetch(PDO::FETCH_ASSOC)) :

                            $today = $resultat["date_add"];
                            $limit_date = $resultat["date_expire"];
    
                            if ($today < $limit_date) {
                    ?>
                                <a href="plus_de_details.php?id=<?= $resultat['id_annonceurs'] ?>&annonce=<?= $resultat['id_annonces'] ?>" class=" mycard">
                                    <?php if ($resultat['options'] == "urgence") : ?>
                                        <p class="urgence">Urgence <i class="fa-solid fa-bell"></i></p>
                                    <?php endif; ?>
                                    <img src="<?= $resultat['img_cover'] ?>" class=" mycard__image">
                                    <div class="mycard__content">
                                        <p class="titre" style="text-transform:capitalize;"><?= $resultat['titres'] ?></p>
                                        <p class=" localisation"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                            <span class="vq">
                                                <?= $resultat['quartiers'] ?>,
                                                <?= $resultat['villes'] ?>
                                            </span>
                                        </p>
                                        <p class="descr"><?= $resultat['descriptions'] ?></p>
                                    </div>
                                    <div class="mycard__info">
    
                                        <div><span class="text-success fw-bolder"><?= number_format($resultat['prix'], 0, '.', ' ')  ?> FCFA<?= $resultat['periode'] ?></span></div>
                                        <div>Plus de détails</div>
                                    </div>
                                    <div class="mycard__time">
                                        <div>
                                            <i class="fa-solid fa-clock-rotate-left"></i>
                                            <?php echo time_ago($resultat['date_add']) ?>
                                        </div>
                                    </div>
                                </a>
    
                        <?php }
                        endwhile ;
                    } ?>
                    
                    <?php } elseif (isset($_POST['ps'])) {
                            $oui = "oui";
                            $statuts = "en cours";
                            $periode = "Semaine";
                            $req = $loginData->prepare("SELECT * FROM annonces WHERE periode = ? AND prix <= ? AND valider = ? AND statuts = ?");
                            $req->execute(array($periode, $max, $oui, $statuts));
                            while ($resultat = $req->fetch(PDO::FETCH_ASSOC)) :
                                $today = $resultat["date_add"];
                                $limit_date = $resultat["date_expire"];

                                if ($today < $limit_date) { ?>
                                    <a href="plus_de_details.php?id=<?= $resultat['id_annonceurs'] ?>&annonce=<?= $resultat['id_annonces'] ?>" class=" mycard">
                                        <?php if ($resultat['options'] == "urgence") : ?>
                                            <p class="urgence">Urgence <i class="fa-solid fa-bell"></i></p>
                                        <?php endif; ?>
                                        <img src="<?= $resultat['img_cover'] ?>" class=" mycard__image">
                                        <div class="mycard__content">
                                            <p class="titre"><?= $resultat['titres'] ?></p>
                                            <p class="localisation"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                                <span class="vq">
                                                    <?= $resultat['quartiers'] ?>,
                                                    <?= $resultat['villes'] ?>
                                                </span>
                                            </p>
                                            <p class="descr"><?= $resultat['descriptions'] ?></p>
                                        </div>
                                        <div class="mycard__info">

                                            <div><span class="text-success fw-bolder"><?= number_format($resultat['prix'], 0, '.', ' ')  ?> FCFA</span></div>
                                            <div>Plus de détails</div>
                                        </div>
                                        <div class="mycard__time">
                                            <div>
                                                <i class="fa-solid fa-clock-rotate-left"></i>
                                                <?php echo time_ago($resultat['date_add']) ?>
                                            </div>
                                        </div>
                                    </a>
                            <?php }
                            endwhile ?>
                            <?php } elseif (isset($_POST['pm'])) {
                            $oui = "oui";
                            $statuts = "en cours";
                            $periode = "Mois";
                            $req = $loginData->prepare("SELECT * FROM annonces WHERE periode = ? AND prix <= ? AND valider = ? AND statuts = ?");
                            $req->execute(array($periode, $max, $oui, $statuts));
                            $reqcount = $req->rowCount();

                    if ($reqcount <= 0) {
                        $text ="Aucune annonce n'a été trouvée";
                    }else{
                        while ($resultat = $req->fetch(PDO::FETCH_ASSOC)) :

                            $today = $resultat["date_add"];
                            $limit_date = $resultat["date_expire"];
    
                            if ($today < $limit_date) {
                    ?>
                                <a href="plus_de_details.php?id=<?= $resultat['id_annonceurs'] ?>&annonce=<?= $resultat['id_annonces'] ?>" class=" mycard">
                                    <?php if ($resultat['options'] == "urgence") : ?>
                                        <p class="urgence">Urgence <i class="fa-solid fa-bell"></i></p>
                                    <?php endif; ?>
                                    <img src="<?= $resultat['img_cover'] ?>" class=" mycard__image">
                                    <div class="mycard__content">
                                        <p class="titre" style="text-transform:capitalize;"><?= $resultat['titres'] ?></p>
                                        <p class=" localisation"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                            <span class="vq">
                                                <?= $resultat['quartiers'] ?>,
                                                <?= $resultat['villes'] ?>
                                            </span>
                                        </p>
                                        <p class="descr"><?= $resultat['descriptions'] ?></p>
                                    </div>
                                    <div class="mycard__info">
    
                                        <div><span class="text-success fw-bolder"><?= number_format($resultat['prix'], 0, '.', ' ')  ?> FCFA<?= $resultat['periode'] ?></span></div>
                                        <div>Plus de détails</div>
                                    </div>
                                    <div class="mycard__time">
                                        <div>
                                            <i class="fa-solid fa-clock-rotate-left"></i>
                                            <?php echo time_ago($resultat['date_add']) ?>
                                        </div>
                                    </div>
                                </a>
    
                        <?php }
                        endwhile ;
                    } ?>
                    
                    <?php } else {
                            $statuts = "en cours";
                            $req = $loginData->prepare("SELECT * FROM annonces WHERE prix <= ? AND valider = ? AND statuts = ? ");
                            $req->execute(array($max, $oui, $statuts));
                           $reqcount = $req->rowCount();

                    if ($reqcount <= 0) {
                        $text ="Aucune annonce n'a été trouvée";
                    }else{
                        while ($resultat = $req->fetch(PDO::FETCH_ASSOC)) :

                            $today = $resultat["date_add"];
                            $limit_date = $resultat["date_expire"];
    
                            if ($today < $limit_date) {
                    ?>
                                <a href="plus_de_details.php?id=<?= $resultat['id_annonceurs'] ?>&annonce=<?= $resultat['id_annonces'] ?>" class=" mycard">
                                    <?php if ($resultat['options'] == "urgence") : ?>
                                        <p class="urgence">Urgence <i class="fa-solid fa-bell"></i></p>
                                    <?php endif; ?>
                                    <img src="<?= $resultat['img_cover'] ?>" class=" mycard__image">
                                    <div class="mycard__content">
                                        <p class="titre" style="text-transform:capitalize;"><?= $resultat['titres'] ?></p>
                                        <p class=" localisation"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                            <span class="vq">
                                                <?= $resultat['quartiers'] ?>,
                                                <?= $resultat['villes'] ?>
                                            </span>
                                        </p>
                                        <p class="descr"><?= $resultat['descriptions'] ?></p>
                                    </div>
                                    <div class="mycard__info">
    
                                        <div><span class="text-success fw-bolder"><?= number_format($resultat['prix'], 0, '.', ' ')  ?> FCFA<?= $resultat['periode'] ?></span></div>
                                        <div>Plus de détails</div>
                                    </div>
                                    <div class="mycard__time">
                                        <div>
                                            <i class="fa-solid fa-clock-rotate-left"></i>
                                            <?php echo time_ago($resultat['date_add']) ?>
                                        </div>
                                    </div>
                                </a>
    
                        <?php }
                        endwhile ;
                    } ?>
                    
                    <?php }
                    }
                    //////type et ville/////////////////////////////
                    elseif (empty($quartier) && !empty($types) && empty($min) && empty($max) && !empty($ville)) {
                        if (isset($_POST['+r'])) {
                            $oui = "oui";
                            $statuts = "en cours";
                            $req = $loginData->prepare("SELECT * FROM annonces WHERE types= ? AND villes = ? AND valider = ? AND statuts = ? ORDER BY id_annonces DESC");
                            $req->execute(array($types, $ville, $oui, $statuts));
                           $reqcount = $req->rowCount();

                    if ($reqcount <= 0) {
                        $text ="Aucune annonce n'a été trouvée";
                    }else{
                        while ($resultat = $req->fetch(PDO::FETCH_ASSOC)) :

                            $today = $resultat["date_add"];
                            $limit_date = $resultat["date_expire"];
    
                            if ($today < $limit_date) {
                    ?>
                                <a href="plus_de_details.php?id=<?= $resultat['id_annonceurs'] ?>&annonce=<?= $resultat['id_annonces'] ?>" class=" mycard">
                                    <?php if ($resultat['options'] == "urgence") : ?>
                                        <p class="urgence">Urgence <i class="fa-solid fa-bell"></i></p>
                                    <?php endif; ?>
                                    <img src="<?= $resultat['img_cover'] ?>" class=" mycard__image">
                                    <div class="mycard__content">
                                        <p class="titre" style="text-transform:capitalize;"><?= $resultat['titres'] ?></p>
                                        <p class=" localisation"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                            <span class="vq">
                                                <?= $resultat['quartiers'] ?>,
                                                <?= $resultat['villes'] ?>
                                            </span>
                                        </p>
                                        <p class="descr"><?= $resultat['descriptions'] ?></p>
                                    </div>
                                    <div class="mycard__info">
    
                                        <div><span class="text-success fw-bolder"><?= number_format($resultat['prix'], 0, '.', ' ')  ?> FCFA<?= $resultat['periode'] ?></span></div>
                                        <div>Plus de détails</div>
                                    </div>
                                    <div class="mycard__time">
                                        <div>
                                            <i class="fa-solid fa-clock-rotate-left"></i>
                                            <?php echo time_ago($resultat['date_add']) ?>
                                        </div>
                                    </div>
                                </a>
    
                        <?php }
                        endwhile ;
                    } ?>
                    
                    <?php } elseif (isset($_POST['-r'])) {
                            $oui = "oui";
                            $statuts = "en cours";
                            $req = $loginData->prepare("SELECT * FROM annonces WHERE types = ? AND villes = ? AND valider = ? AND statuts = ? ORDER BY id_annonces ASC");
                            $req->execute(array($types, $ville, $oui, $statuts));
                           $reqcount = $req->rowCount();

                    if ($reqcount <= 0) {
                        $text ="Aucune annonce n'a été trouvée";
                    }else{
                        while ($resultat = $req->fetch(PDO::FETCH_ASSOC)) :

                            $today = $resultat["date_add"];
                            $limit_date = $resultat["date_expire"];
    
                            if ($today < $limit_date) {
                    ?>
                                <a href="plus_de_details.php?id=<?= $resultat['id_annonceurs'] ?>&annonce=<?= $resultat['id_annonces'] ?>" class=" mycard">
                                    <?php if ($resultat['options'] == "urgence") : ?>
                                        <p class="urgence">Urgence <i class="fa-solid fa-bell"></i></p>
                                    <?php endif; ?>
                                    <img src="<?= $resultat['img_cover'] ?>" class=" mycard__image">
                                    <div class="mycard__content">
                                        <p class="titre" style="text-transform:capitalize;"><?= $resultat['titres'] ?></p>
                                        <p class=" localisation"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                            <span class="vq">
                                                <?= $resultat['quartiers'] ?>,
                                                <?= $resultat['villes'] ?>
                                            </span>
                                        </p>
                                        <p class="descr"><?= $resultat['descriptions'] ?></p>
                                    </div>
                                    <div class="mycard__info">
    
                                        <div><span class="text-success fw-bolder"><?= number_format($resultat['prix'], 0, '.', ' ')  ?> FCFA<?= $resultat['periode'] ?></span></div>
                                        <div>Plus de détails</div>
                                    </div>
                                    <div class="mycard__time">
                                        <div>
                                            <i class="fa-solid fa-clock-rotate-left"></i>
                                            <?php echo time_ago($resultat['date_add']) ?>
                                        </div>
                                    </div>
                                </a>
    
                        <?php }
                        endwhile ;
                    } ?>
                    
                    <?php } elseif (isset($_POST['+c'])) {
                            $oui = "oui";
                            $statuts = "en cours";
                            $req = $loginData->prepare("SELECT * FROM annonces WHERE types= ? AND villes= ? AND valider = ? AND statuts = ? ORDER BY prix DESC");
                            $req->execute(array($types, $ville, $oui, $statuts));
                            $reqcount = $req->rowCount();

                    if ($reqcount <= 0) {
                        $text ="Aucune annonce n'a été trouvée";
                    }else{
                        while ($resultat = $req->fetch(PDO::FETCH_ASSOC)) :

                            $today = $resultat["date_add"];
                            $limit_date = $resultat["date_expire"];
    
                            if ($today < $limit_date) {
                    ?>
                                <a href="plus_de_details.php?id=<?= $resultat['id_annonceurs'] ?>&annonce=<?= $resultat['id_annonces'] ?>" class=" mycard">
                                    <?php if ($resultat['options'] == "urgence") : ?>
                                        <p class="urgence">Urgence <i class="fa-solid fa-bell"></i></p>
                                    <?php endif; ?>
                                    <img src="<?= $resultat['img_cover'] ?>" class=" mycard__image">
                                    <div class="mycard__content">
                                        <p class="titre" style="text-transform:capitalize;"><?= $resultat['titres'] ?></p>
                                        <p class=" localisation"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                            <span class="vq">
                                                <?= $resultat['quartiers'] ?>,
                                                <?= $resultat['villes'] ?>
                                            </span>
                                        </p>
                                        <p class="descr"><?= $resultat['descriptions'] ?></p>
                                    </div>
                                    <div class="mycard__info">
    
                                        <div><span class="text-success fw-bolder"><?= number_format($resultat['prix'], 0, '.', ' ')  ?> FCFA<?= $resultat['periode'] ?></span></div>
                                        <div>Plus de détails</div>
                                    </div>
                                    <div class="mycard__time">
                                        <div>
                                            <i class="fa-solid fa-clock-rotate-left"></i>
                                            <?php echo time_ago($resultat['date_add']) ?>
                                        </div>
                                    </div>
                                </a>
    
                        <?php }
                        endwhile ;
                    } ?>
                    
                    <?php } elseif (isset($_POST['-c'])) {
                            $oui = "oui";
                            $statuts = "en cours";
                            $req = $loginData->prepare("SELECT * FROM annonces WHERE types= ? AND villes = ? AND valider = ? AND statuts = ? ORDER BY prix ASC");
                            $req->execute(array($types, $ville, $oui, $statuts));
                           $reqcount = $req->rowCount();

                    if ($reqcount <= 0) {
                        $text ="Aucune annonce n'a été trouvée";
                    }else{
                        while ($resultat = $req->fetch(PDO::FETCH_ASSOC)) :

                            $today = $resultat["date_add"];
                            $limit_date = $resultat["date_expire"];
    
                            if ($today < $limit_date) {
                    ?>
                                <a href="plus_de_details.php?id=<?= $resultat['id_annonceurs'] ?>&annonce=<?= $resultat['id_annonces'] ?>" class=" mycard">
                                    <?php if ($resultat['options'] == "urgence") : ?>
                                        <p class="urgence">Urgence <i class="fa-solid fa-bell"></i></p>
                                    <?php endif; ?>
                                    <img src="<?= $resultat['img_cover'] ?>" class=" mycard__image">
                                    <div class="mycard__content">
                                        <p class="titre" style="text-transform:capitalize;"><?= $resultat['titres'] ?></p>
                                        <p class=" localisation"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                            <span class="vq">
                                                <?= $resultat['quartiers'] ?>,
                                                <?= $resultat['villes'] ?>
                                            </span>
                                        </p>
                                        <p class="descr"><?= $resultat['descriptions'] ?></p>
                                    </div>
                                    <div class="mycard__info">
    
                                        <div><span class="text-success fw-bolder"><?= number_format($resultat['prix'], 0, '.', ' ')  ?> FCFA<?= $resultat['periode'] ?></span></div>
                                        <div>Plus de détails</div>
                                    </div>
                                    <div class="mycard__time">
                                        <div>
                                            <i class="fa-solid fa-clock-rotate-left"></i>
                                            <?php echo time_ago($resultat['date_add']) ?>
                                        </div>
                                    </div>
                                </a>
    
                        <?php }
                        endwhile ;
                    } ?>
                    
                    <?php } elseif (isset($_POST['pj'])) {
                            $oui = "oui";
                            $statuts = "en cours";
                            $periode = "Jour";
                            $req = $loginData->prepare("SELECT * FROM annonces WHERE periode = ? AND types= ? AND villes = ? AND valider = ? AND statuts = ?");
                            $req->execute(array($periode, $types, $ville, $oui, $statuts));
                            $reqcount = $req->rowCount();

                    if ($reqcount <= 0) {
                        $text ="Aucune annonce n'a été trouvée";
                    }else{
                        while ($resultat = $req->fetch(PDO::FETCH_ASSOC)) :

                            $today = $resultat["date_add"];
                            $limit_date = $resultat["date_expire"];
    
                            if ($today < $limit_date) {
                    ?>
                                <a href="plus_de_details.php?id=<?= $resultat['id_annonceurs'] ?>&annonce=<?= $resultat['id_annonces'] ?>" class=" mycard">
                                    <?php if ($resultat['options'] == "urgence") : ?>
                                        <p class="urgence">Urgence <i class="fa-solid fa-bell"></i></p>
                                    <?php endif; ?>
                                    <img src="<?= $resultat['img_cover'] ?>" class=" mycard__image">
                                    <div class="mycard__content">
                                        <p class="titre" style="text-transform:capitalize;"><?= $resultat['titres'] ?></p>
                                        <p class=" localisation"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                            <span class="vq">
                                                <?= $resultat['quartiers'] ?>,
                                                <?= $resultat['villes'] ?>
                                            </span>
                                        </p>
                                        <p class="descr"><?= $resultat['descriptions'] ?></p>
                                    </div>
                                    <div class="mycard__info">
    
                                        <div><span class="text-success fw-bolder"><?= number_format($resultat['prix'], 0, '.', ' ')  ?> FCFA<?= $resultat['periode'] ?></span></div>
                                        <div>Plus de détails</div>
                                    </div>
                                    <div class="mycard__time">
                                        <div>
                                            <i class="fa-solid fa-clock-rotate-left"></i>
                                            <?php echo time_ago($resultat['date_add']) ?>
                                        </div>
                                    </div>
                                </a>
    
                        <?php }
                        endwhile ;
                    } ?>
                    
                    <?php } elseif (isset($_POST['ps'])) {
                            $oui = "oui";
                            $statuts = "en cours";
                            $periode = "Semaine";
                            $req = $loginData->prepare("SELECT * FROM annonces WHERE periode = ? AND types= ? AND villes = ? AND valider = ? AND statuts = ?");
                            $req->execute(array($periode, $types, $ville, $oui, $statuts));
                           $reqcount = $req->rowCount();

                    if ($reqcount <= 0) {
                        $text ="Aucune annonce n'a été trouvée";
                    }else{
                        while ($resultat = $req->fetch(PDO::FETCH_ASSOC)) :

                            $today = $resultat["date_add"];
                            $limit_date = $resultat["date_expire"];
    
                            if ($today < $limit_date) {
                    ?>
                                <a href="plus_de_details.php?id=<?= $resultat['id_annonceurs'] ?>&annonce=<?= $resultat['id_annonces'] ?>" class=" mycard">
                                    <?php if ($resultat['options'] == "urgence") : ?>
                                        <p class="urgence">Urgence <i class="fa-solid fa-bell"></i></p>
                                    <?php endif; ?>
                                    <img src="<?= $resultat['img_cover'] ?>" class=" mycard__image">
                                    <div class="mycard__content">
                                        <p class="titre" style="text-transform:capitalize;"><?= $resultat['titres'] ?></p>
                                        <p class=" localisation"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                            <span class="vq">
                                                <?= $resultat['quartiers'] ?>,
                                                <?= $resultat['villes'] ?>
                                            </span>
                                        </p>
                                        <p class="descr"><?= $resultat['descriptions'] ?></p>
                                    </div>
                                    <div class="mycard__info">
    
                                        <div><span class="text-success fw-bolder"><?= number_format($resultat['prix'], 0, '.', ' ')  ?> FCFA<?= $resultat['periode'] ?></span></div>
                                        <div>Plus de détails</div>
                                    </div>
                                    <div class="mycard__time">
                                        <div>
                                            <i class="fa-solid fa-clock-rotate-left"></i>
                                            <?php echo time_ago($resultat['date_add']) ?>
                                        </div>
                                    </div>
                                </a>
    
                        <?php }
                        endwhile ;
                    } ?>
                    
                    <?php } elseif (isset($_POST['pm'])) {
                            $oui = "oui";
                            $statuts = "en cours";
                            $periode = "Mois";
                            $req = $loginData->prepare("SELECT * FROM annonces WHERE periode = ? AND types= ? AND villes = ? AND valider = ? AND statuts = ?");
                            $req->execute(array($periode, $types, $ville, $oui, $statuts));
                           $reqcount = $req->rowCount();

                    if ($reqcount <= 0) {
                        $text ="Aucune annonce n'a été trouvée";
                    }else{
                        while ($resultat = $req->fetch(PDO::FETCH_ASSOC)) :

                            $today = $resultat["date_add"];
                            $limit_date = $resultat["date_expire"];
    
                            if ($today < $limit_date) {
                    ?>
                                <a href="plus_de_details.php?id=<?= $resultat['id_annonceurs'] ?>&annonce=<?= $resultat['id_annonces'] ?>" class=" mycard">
                                    <?php if ($resultat['options'] == "urgence") : ?>
                                        <p class="urgence">Urgence <i class="fa-solid fa-bell"></i></p>
                                    <?php endif; ?>
                                    <img src="<?= $resultat['img_cover'] ?>" class=" mycard__image">
                                    <div class="mycard__content">
                                        <p class="titre" style="text-transform:capitalize;"><?= $resultat['titres'] ?></p>
                                        <p class=" localisation"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                            <span class="vq">
                                                <?= $resultat['quartiers'] ?>,
                                                <?= $resultat['villes'] ?>
                                            </span>
                                        </p>
                                        <p class="descr"><?= $resultat['descriptions'] ?></p>
                                    </div>
                                    <div class="mycard__info">
    
                                        <div><span class="text-success fw-bolder"><?= number_format($resultat['prix'], 0, '.', ' ')  ?> FCFA<?= $resultat['periode'] ?></span></div>
                                        <div>Plus de détails</div>
                                    </div>
                                    <div class="mycard__time">
                                        <div>
                                            <i class="fa-solid fa-clock-rotate-left"></i>
                                            <?php echo time_ago($resultat['date_add']) ?>
                                        </div>
                                    </div>
                                </a>
    
                        <?php }
                        endwhile ;
                    } ?>
                    
                    <?php } else {
                            $statuts = "en cours";
                            $req = $loginData->prepare("SELECT * FROM annonces WHERE types= ? AND villes = ? AND valider = ? AND statuts = ? ");
                            $req->execute(array($types, $ville, $oui, $statuts));
                            $reqcount = $req->rowCount();

                    if ($reqcount <= 0) {
                        $text ="Aucune annonce n'a été trouvée";
                    }else{
                        while ($resultat = $req->fetch(PDO::FETCH_ASSOC)) :

                            $today = $resultat["date_add"];
                            $limit_date = $resultat["date_expire"];
    
                            if ($today < $limit_date) {
                    ?>
                                <a href="plus_de_details.php?id=<?= $resultat['id_annonceurs'] ?>&annonce=<?= $resultat['id_annonces'] ?>" class=" mycard">
                                    <?php if ($resultat['options'] == "urgence") : ?>
                                        <p class="urgence">Urgence <i class="fa-solid fa-bell"></i></p>
                                    <?php endif; ?>
                                    <img src="<?= $resultat['img_cover'] ?>" class=" mycard__image">
                                    <div class="mycard__content">
                                        <p class="titre" style="text-transform:capitalize;"><?= $resultat['titres'] ?></p>
                                        <p class=" localisation"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                            <span class="vq">
                                                <?= $resultat['quartiers'] ?>,
                                                <?= $resultat['villes'] ?>
                                            </span>
                                        </p>
                                        <p class="descr"><?= $resultat['descriptions'] ?></p>
                                    </div>
                                    <div class="mycard__info">
    
                                        <div><span class="text-success fw-bolder"><?= number_format($resultat['prix'], 0, '.', ' ')  ?> FCFA<?= $resultat['periode'] ?></span></div>
                                        <div>Plus de détails</div>
                                    </div>
                                    <div class="mycard__time">
                                        <div>
                                            <i class="fa-solid fa-clock-rotate-left"></i>
                                            <?php echo time_ago($resultat['date_add']) ?>
                                        </div>
                                    </div>
                                </a>
    
                        <?php }
                        endwhile ;
                    } ?>
                    
                    <?php }
                    }
                    //////type et quartier/////////////////////////////
                    elseif (!empty($quartier) && !empty($types) && empty($min) && empty($max) && empty($ville)) {
                        if (isset($_POST['+r'])) {
                            $oui = "oui";
                            $statuts = "en cours";
                            $req = $loginData->prepare("SELECT * FROM annonces WHERE types= ? AND quartiers = ? AND valider = ? AND statuts = ? ORDER BY id_annonces DESC");
                            $req->execute(array($types, $quartier, $oui, $statuts));
                           $reqcount = $req->rowCount();

                    if ($reqcount <= 0) {
                        $text ="Aucune annonce n'a été trouvée";
                    }else{
                        while ($resultat = $req->fetch(PDO::FETCH_ASSOC)) :

                            $today = $resultat["date_add"];
                            $limit_date = $resultat["date_expire"];
    
                            if ($today < $limit_date) {
                    ?>
                                <a href="plus_de_details.php?id=<?= $resultat['id_annonceurs'] ?>&annonce=<?= $resultat['id_annonces'] ?>" class=" mycard">
                                    <?php if ($resultat['options'] == "urgence") : ?>
                                        <p class="urgence">Urgence <i class="fa-solid fa-bell"></i></p>
                                    <?php endif; ?>
                                    <img src="<?= $resultat['img_cover'] ?>" class=" mycard__image">
                                    <div class="mycard__content">
                                        <p class="titre" style="text-transform:capitalize;"><?= $resultat['titres'] ?></p>
                                        <p class=" localisation"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                            <span class="vq">
                                                <?= $resultat['quartiers'] ?>,
                                                <?= $resultat['villes'] ?>
                                            </span>
                                        </p>
                                        <p class="descr"><?= $resultat['descriptions'] ?></p>
                                    </div>
                                    <div class="mycard__info">
    
                                        <div><span class="text-success fw-bolder"><?= number_format($resultat['prix'], 0, '.', ' ')  ?> FCFA<?= $resultat['periode'] ?></span></div>
                                        <div>Plus de détails</div>
                                    </div>
                                    <div class="mycard__time">
                                        <div>
                                            <i class="fa-solid fa-clock-rotate-left"></i>
                                            <?php echo time_ago($resultat['date_add']) ?>
                                        </div>
                                    </div>
                                </a>
    
                        <?php }
                        endwhile ;
                    } ?>
                    
                    <?php } elseif (isset($_POST['-r'])) {
                            $oui = "oui";
                            $statuts = "en cours";
                            $req = $loginData->prepare("SELECT * FROM annonces WHERE types = ? AND quartiers = ? AND valider = ? AND statuts = ? ORDER BY id_annonces ASC");
                            $req->execute(array($types, $quartier, $oui, $statuts));
                           $reqcount = $req->rowCount();

                    if ($reqcount <= 0) {
                        $text ="Aucune annonce n'a été trouvée";
                    }else{
                        while ($resultat = $req->fetch(PDO::FETCH_ASSOC)) :

                            $today = $resultat["date_add"];
                            $limit_date = $resultat["date_expire"];
    
                            if ($today < $limit_date) {
                    ?>
                                <a href="plus_de_details.php?id=<?= $resultat['id_annonceurs'] ?>&annonce=<?= $resultat['id_annonces'] ?>" class=" mycard">
                                    <?php if ($resultat['options'] == "urgence") : ?>
                                        <p class="urgence">Urgence <i class="fa-solid fa-bell"></i></p>
                                    <?php endif; ?>
                                    <img src="<?= $resultat['img_cover'] ?>" class=" mycard__image">
                                    <div class="mycard__content">
                                        <p class="titre" style="text-transform:capitalize;"><?= $resultat['titres'] ?></p>
                                        <p class=" localisation"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                            <span class="vq">
                                                <?= $resultat['quartiers'] ?>,
                                                <?= $resultat['villes'] ?>
                                            </span>
                                        </p>
                                        <p class="descr"><?= $resultat['descriptions'] ?></p>
                                    </div>
                                    <div class="mycard__info">
    
                                        <div><span class="text-success fw-bolder"><?= number_format($resultat['prix'], 0, '.', ' ')  ?> FCFA<?= $resultat['periode'] ?></span></div>
                                        <div>Plus de détails</div>
                                    </div>
                                    <div class="mycard__time">
                                        <div>
                                            <i class="fa-solid fa-clock-rotate-left"></i>
                                            <?php echo time_ago($resultat['date_add']) ?>
                                        </div>
                                    </div>
                                </a>
    
                        <?php }
                        endwhile ;
                    } ?>
                    
                    <?php } elseif (isset($_POST['+c'])) {
                            $oui = "oui";
                            $statuts = "en cours";
                            $req = $loginData->prepare("SELECT * FROM annonces WHERE types= ? AND quartiers= ? AND valider = ? AND statuts = ? ORDER BY prix DESC");
                            $req->execute(array($types, $quartier, $oui, $statuts));
                           $reqcount = $req->rowCount();

                    if ($reqcount <= 0) {
                        $text ="Aucune annonce n'a été trouvée";
                    }else{
                        while ($resultat = $req->fetch(PDO::FETCH_ASSOC)) :

                            $today = $resultat["date_add"];
                            $limit_date = $resultat["date_expire"];
    
                            if ($today < $limit_date) {
                    ?>
                                <a href="plus_de_details.php?id=<?= $resultat['id_annonceurs'] ?>&annonce=<?= $resultat['id_annonces'] ?>" class=" mycard">
                                    <?php if ($resultat['options'] == "urgence") : ?>
                                        <p class="urgence">Urgence <i class="fa-solid fa-bell"></i></p>
                                    <?php endif; ?>
                                    <img src="<?= $resultat['img_cover'] ?>" class=" mycard__image">
                                    <div class="mycard__content">
                                        <p class="titre" style="text-transform:capitalize;"><?= $resultat['titres'] ?></p>
                                        <p class=" localisation"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                            <span class="vq">
                                                <?= $resultat['quartiers'] ?>,
                                                <?= $resultat['villes'] ?>
                                            </span>
                                        </p>
                                        <p class="descr"><?= $resultat['descriptions'] ?></p>
                                    </div>
                                    <div class="mycard__info">
    
                                        <div><span class="text-success fw-bolder"><?= number_format($resultat['prix'], 0, '.', ' ')  ?> FCFA<?= $resultat['periode'] ?></span></div>
                                        <div>Plus de détails</div>
                                    </div>
                                    <div class="mycard__time">
                                        <div>
                                            <i class="fa-solid fa-clock-rotate-left"></i>
                                            <?php echo time_ago($resultat['date_add']) ?>
                                        </div>
                                    </div>
                                </a>
    
                        <?php }
                        endwhile ;
                    } ?>
                    
                    <?php } elseif (isset($_POST['-c'])) {
                            $oui = "oui";
                            $statuts = "en cours";
                            $req = $loginData->prepare("SELECT * FROM annonces WHERE types= ? AND quartiers = ? AND valider = ? AND statuts = ? ORDER BY prix ASC");
                            $req->execute(array($types, $quartier, $oui, $statuts));
                           $reqcount = $req->rowCount();

                    if ($reqcount <= 0) {
                        $text ="Aucune annonce n'a été trouvée";
                    }else{
                        while ($resultat = $req->fetch(PDO::FETCH_ASSOC)) :

                            $today = $resultat["date_add"];
                            $limit_date = $resultat["date_expire"];
    
                            if ($today < $limit_date) {
                    ?>
                                <a href="plus_de_details.php?id=<?= $resultat['id_annonceurs'] ?>&annonce=<?= $resultat['id_annonces'] ?>" class=" mycard">
                                    <?php if ($resultat['options'] == "urgence") : ?>
                                        <p class="urgence">Urgence <i class="fa-solid fa-bell"></i></p>
                                    <?php endif; ?>
                                    <img src="<?= $resultat['img_cover'] ?>" class=" mycard__image">
                                    <div class="mycard__content">
                                        <p class="titre" style="text-transform:capitalize;"><?= $resultat['titres'] ?></p>
                                        <p class=" localisation"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                            <span class="vq">
                                                <?= $resultat['quartiers'] ?>,
                                                <?= $resultat['villes'] ?>
                                            </span>
                                        </p>
                                        <p class="descr"><?= $resultat['descriptions'] ?></p>
                                    </div>
                                    <div class="mycard__info">
    
                                        <div><span class="text-success fw-bolder"><?= number_format($resultat['prix'], 0, '.', ' ')  ?> FCFA<?= $resultat['periode'] ?></span></div>
                                        <div>Plus de détails</div>
                                    </div>
                                    <div class="mycard__time">
                                        <div>
                                            <i class="fa-solid fa-clock-rotate-left"></i>
                                            <?php echo time_ago($resultat['date_add']) ?>
                                        </div>
                                    </div>
                                </a>
    
                        <?php }
                        endwhile ;
                    } ?>
                    
                    <?php } elseif (isset($_POST['pj'])) {
                            $oui = "oui";
                            $statuts = "en cours";
                            $periode = "Jour";
                            $req = $loginData->prepare("SELECT * FROM annonces WHERE periode = ? AND types= ? AND quartiers = ? AND valider = ? AND statuts = ?");
                            $req->execute(array($periode, $types, $quartier, $oui, $statuts));
                           $reqcount = $req->rowCount();

                    if ($reqcount <= 0) {
                        $text ="Aucune annonce n'a été trouvée";
                    }else{
                        while ($resultat = $req->fetch(PDO::FETCH_ASSOC)) :

                            $today = $resultat["date_add"];
                            $limit_date = $resultat["date_expire"];
    
                            if ($today < $limit_date) {
                    ?>
                                <a href="plus_de_details.php?id=<?= $resultat['id_annonceurs'] ?>&annonce=<?= $resultat['id_annonces'] ?>" class=" mycard">
                                    <?php if ($resultat['options'] == "urgence") : ?>
                                        <p class="urgence">Urgence <i class="fa-solid fa-bell"></i></p>
                                    <?php endif; ?>
                                    <img src="<?= $resultat['img_cover'] ?>" class=" mycard__image">
                                    <div class="mycard__content">
                                        <p class="titre" style="text-transform:capitalize;"><?= $resultat['titres'] ?></p>
                                        <p class=" localisation"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                            <span class="vq">
                                                <?= $resultat['quartiers'] ?>,
                                                <?= $resultat['villes'] ?>
                                            </span>
                                        </p>
                                        <p class="descr"><?= $resultat['descriptions'] ?></p>
                                    </div>
                                    <div class="mycard__info">
    
                                        <div><span class="text-success fw-bolder"><?= number_format($resultat['prix'], 0, '.', ' ')  ?> FCFA<?= $resultat['periode'] ?></span></div>
                                        <div>Plus de détails</div>
                                    </div>
                                    <div class="mycard__time">
                                        <div>
                                            <i class="fa-solid fa-clock-rotate-left"></i>
                                            <?php echo time_ago($resultat['date_add']) ?>
                                        </div>
                                    </div>
                                </a>
    
                        <?php }
                        endwhile ;
                    } ?>
                    
                    <?php } elseif (isset($_POST['ps'])) {
                            $oui = "oui";
                            $statuts = "en cours";
                            $periode = "Semaine";
                            $req = $loginData->prepare("SELECT * FROM annonces WHERE periode = ? AND types= ? AND quartiers = ? AND valider = ? AND statuts = ?");
                            $req->execute(array($periode, $types, $quartier, $oui, $statuts));
                           $reqcount = $req->rowCount();

                    if ($reqcount <= 0) {
                        $text ="Aucune annonce n'a été trouvée";
                    }else{
                        while ($resultat = $req->fetch(PDO::FETCH_ASSOC)) :

                            $today = $resultat["date_add"];
                            $limit_date = $resultat["date_expire"];
    
                            if ($today < $limit_date) {
                    ?>
                                <a href="plus_de_details.php?id=<?= $resultat['id_annonceurs'] ?>&annonce=<?= $resultat['id_annonces'] ?>" class=" mycard">
                                    <?php if ($resultat['options'] == "urgence") : ?>
                                        <p class="urgence">Urgence <i class="fa-solid fa-bell"></i></p>
                                    <?php endif; ?>
                                    <img src="<?= $resultat['img_cover'] ?>" class=" mycard__image">
                                    <div class="mycard__content">
                                        <p class="titre" style="text-transform:capitalize;"><?= $resultat['titres'] ?></p>
                                        <p class=" localisation"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                            <span class="vq">
                                                <?= $resultat['quartiers'] ?>,
                                                <?= $resultat['villes'] ?>
                                            </span>
                                        </p>
                                        <p class="descr"><?= $resultat['descriptions'] ?></p>
                                    </div>
                                    <div class="mycard__info">
    
                                        <div><span class="text-success fw-bolder"><?= number_format($resultat['prix'], 0, '.', ' ')  ?> FCFA<?= $resultat['periode'] ?></span></div>
                                        <div>Plus de détails</div>
                                    </div>
                                    <div class="mycard__time">
                                        <div>
                                            <i class="fa-solid fa-clock-rotate-left"></i>
                                            <?php echo time_ago($resultat['date_add']) ?>
                                        </div>
                                    </div>
                                </a>
    
                        <?php }
                        endwhile ;
                    } ?>
                    
                    <?php } elseif (isset($_POST['pm'])) {
                            $oui = "oui";
                            $statuts = "en cours";
                            $periode = "Mois";
                            $req = $loginData->prepare("SELECT * FROM annonces WHERE periode = ? AND types= ? AND quartiers = ? AND valider = ? AND statuts = ?");
                            $req->execute(array($periode, $types, $quartier, $oui, $statuts));
                           $reqcount = $req->rowCount();

                    if ($reqcount <= 0) {
                        $text ="Aucune annonce n'a été trouvée";
                    }else{
                        while ($resultat = $req->fetch(PDO::FETCH_ASSOC)) :

                            $today = $resultat["date_add"];
                            $limit_date = $resultat["date_expire"];
    
                            if ($today < $limit_date) {
                    ?>
                                <a href="plus_de_details.php?id=<?= $resultat['id_annonceurs'] ?>&annonce=<?= $resultat['id_annonces'] ?>" class=" mycard">
                                    <?php if ($resultat['options'] == "urgence") : ?>
                                        <p class="urgence">Urgence <i class="fa-solid fa-bell"></i></p>
                                    <?php endif; ?>
                                    <img src="<?= $resultat['img_cover'] ?>" class=" mycard__image">
                                    <div class="mycard__content">
                                        <p class="titre" style="text-transform:capitalize;"><?= $resultat['titres'] ?></p>
                                        <p class=" localisation"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                            <span class="vq">
                                                <?= $resultat['quartiers'] ?>,
                                                <?= $resultat['villes'] ?>
                                            </span>
                                        </p>
                                        <p class="descr"><?= $resultat['descriptions'] ?></p>
                                    </div>
                                    <div class="mycard__info">
    
                                        <div><span class="text-success fw-bolder"><?= number_format($resultat['prix'], 0, '.', ' ')  ?> FCFA<?= $resultat['periode'] ?></span></div>
                                        <div>Plus de détails</div>
                                    </div>
                                    <div class="mycard__time">
                                        <div>
                                            <i class="fa-solid fa-clock-rotate-left"></i>
                                            <?php echo time_ago($resultat['date_add']) ?>
                                        </div>
                                    </div>
                                </a>
    
                        <?php }
                        endwhile ;
                    } ?>
                    
                    <?php } else {
                            $statuts = "en cours";
                            $oui = "oui";
                            $req = $loginData->prepare("SELECT * FROM annonces WHERE types= ? AND quartiers= ? AND valider = ? AND statuts = ? ");
                            $req->execute(array($types, $quartier, $oui, $statuts));
                            $reqcount = $req->rowCount();

                    if ($reqcount <= 0) {
                        $text ="Aucune annonce n'a été trouvée";
                    }else{
                        while ($resultat = $req->fetch(PDO::FETCH_ASSOC)) :

                            $today = $resultat["date_add"];
                            $limit_date = $resultat["date_expire"];
    
                            if ($today < $limit_date) {
                    ?>
                                <a href="plus_de_details.php?id=<?= $resultat['id_annonceurs'] ?>&annonce=<?= $resultat['id_annonces'] ?>" class=" mycard">
                                    <?php if ($resultat['options'] == "urgence") : ?>
                                        <p class="urgence">Urgence <i class="fa-solid fa-bell"></i></p>
                                    <?php endif; ?>
                                    <img src="<?= $resultat['img_cover'] ?>" class=" mycard__image">
                                    <div class="mycard__content">
                                        <p class="titre" style="text-transform:capitalize;"><?= $resultat['titres'] ?></p>
                                        <p class=" localisation"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                            <span class="vq">
                                                <?= $resultat['quartiers'] ?>,
                                                <?= $resultat['villes'] ?>
                                            </span>
                                        </p>
                                        <p class="descr"><?= $resultat['descriptions'] ?></p>
                                    </div>
                                    <div class="mycard__info">
    
                                        <div><span class="text-success fw-bolder"><?= number_format($resultat['prix'], 0, '.', ' ')  ?> FCFA<?= $resultat['periode'] ?></span></div>
                                        <div>Plus de détails</div>
                                    </div>
                                    <div class="mycard__time">
                                        <div>
                                            <i class="fa-solid fa-clock-rotate-left"></i>
                                            <?php echo time_ago($resultat['date_add']) ?>
                                        </div>
                                    </div>
                                </a>
    
                        <?php }
                        endwhile ;
                    } ?>
                    
                    <?php }
                    }
                    //////type et min/////////////////////////////
                    elseif (empty($quartier) && !empty($types) && !empty($min) && empty($max) && empty($ville)) {
                        if (isset($_POST['+r'])) {
                            $oui = "oui";
                            $statuts = "en cours";
                            $req = $loginData->prepare("SELECT * FROM annonces WHERE types= ? AND prix >= ? AND valider = ? AND statuts = ? ORDER BY id_annonces DESC");
                            $req->execute(array($types, $min, $oui, $statuts));
                           $reqcount = $req->rowCount();

                    if ($reqcount <= 0) {
                        $text ="Aucune annonce n'a été trouvée";
                    }else{
                        while ($resultat = $req->fetch(PDO::FETCH_ASSOC)) :

                            $today = $resultat["date_add"];
                            $limit_date = $resultat["date_expire"];
    
                            if ($today < $limit_date) {
                    ?>
                                <a href="plus_de_details.php?id=<?= $resultat['id_annonceurs'] ?>&annonce=<?= $resultat['id_annonces'] ?>" class=" mycard">
                                    <?php if ($resultat['options'] == "urgence") : ?>
                                        <p class="urgence">Urgence <i class="fa-solid fa-bell"></i></p>
                                    <?php endif; ?>
                                    <img src="<?= $resultat['img_cover'] ?>" class=" mycard__image">
                                    <div class="mycard__content">
                                        <p class="titre" style="text-transform:capitalize;"><?= $resultat['titres'] ?></p>
                                        <p class=" localisation"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                            <span class="vq">
                                                <?= $resultat['quartiers'] ?>,
                                                <?= $resultat['villes'] ?>
                                            </span>
                                        </p>
                                        <p class="descr"><?= $resultat['descriptions'] ?></p>
                                    </div>
                                    <div class="mycard__info">
    
                                        <div><span class="text-success fw-bolder"><?= number_format($resultat['prix'], 0, '.', ' ')  ?> FCFA<?= $resultat['periode'] ?></span></div>
                                        <div>Plus de détails</div>
                                    </div>
                                    <div class="mycard__time">
                                        <div>
                                            <i class="fa-solid fa-clock-rotate-left"></i>
                                            <?php echo time_ago($resultat['date_add']) ?>
                                        </div>
                                    </div>
                                </a>
    
                        <?php }
                        endwhile ;
                    } ?>
                    
                    <?php } elseif (isset($_POST['-r'])) {
                            $oui = "oui";
                            $statuts = "en cours";
                            $req = $loginData->prepare("SELECT * FROM annonces WHERE types = ? AND prix >= ? AND valider = ? AND statuts = ? ORDER BY id_annonces ASC");
                            $req->execute(array($types, $min, $oui, $statuts));
                           $reqcount = $req->rowCount();

                    if ($reqcount <= 0) {
                        $text ="Aucune annonce n'a été trouvée";
                    }else{
                        while ($resultat = $req->fetch(PDO::FETCH_ASSOC)) :

                            $today = $resultat["date_add"];
                            $limit_date = $resultat["date_expire"];
    
                            if ($today < $limit_date) {
                    ?>
                                <a href="plus_de_details.php?id=<?= $resultat['id_annonceurs'] ?>&annonce=<?= $resultat['id_annonces'] ?>" class=" mycard">
                                    <?php if ($resultat['options'] == "urgence") : ?>
                                        <p class="urgence">Urgence <i class="fa-solid fa-bell"></i></p>
                                    <?php endif; ?>
                                    <img src="<?= $resultat['img_cover'] ?>" class=" mycard__image">
                                    <div class="mycard__content">
                                        <p class="titre" style="text-transform:capitalize;"><?= $resultat['titres'] ?></p>
                                        <p class=" localisation"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                            <span class="vq">
                                                <?= $resultat['quartiers'] ?>,
                                                <?= $resultat['villes'] ?>
                                            </span>
                                        </p>
                                        <p class="descr"><?= $resultat['descriptions'] ?></p>
                                    </div>
                                    <div class="mycard__info">
    
                                        <div><span class="text-success fw-bolder"><?= number_format($resultat['prix'], 0, '.', ' ')  ?> FCFA<?= $resultat['periode'] ?></span></div>
                                        <div>Plus de détails</div>
                                    </div>
                                    <div class="mycard__time">
                                        <div>
                                            <i class="fa-solid fa-clock-rotate-left"></i>
                                            <?php echo time_ago($resultat['date_add']) ?>
                                        </div>
                                    </div>
                                </a>
    
                        <?php }
                        endwhile ;
                    } ?>
                    
                    <?php } elseif (isset($_POST['+c'])) {
                            $oui = "oui";
                            $statuts = "en cours";
                            $req = $loginData->prepare("SELECT * FROM annonces WHERE types= ? AND prix >= ? AND valider = ? AND statuts = ? ORDER BY prix DESC");
                            $req->execute(array($types, $min, $oui, $statuts));
                           $reqcount = $req->rowCount();

                    if ($reqcount <= 0) {
                        $text ="Aucune annonce n'a été trouvée";
                    }else{
                        while ($resultat = $req->fetch(PDO::FETCH_ASSOC)) :

                            $today = $resultat["date_add"];
                            $limit_date = $resultat["date_expire"];
    
                            if ($today < $limit_date) {
                    ?>
                                <a href="plus_de_details.php?id=<?= $resultat['id_annonceurs'] ?>&annonce=<?= $resultat['id_annonces'] ?>" class=" mycard">
                                    <?php if ($resultat['options'] == "urgence") : ?>
                                        <p class="urgence">Urgence <i class="fa-solid fa-bell"></i></p>
                                    <?php endif; ?>
                                    <img src="<?= $resultat['img_cover'] ?>" class=" mycard__image">
                                    <div class="mycard__content">
                                        <p class="titre" style="text-transform:capitalize;"><?= $resultat['titres'] ?></p>
                                        <p class=" localisation"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                            <span class="vq">
                                                <?= $resultat['quartiers'] ?>,
                                                <?= $resultat['villes'] ?>
                                            </span>
                                        </p>
                                        <p class="descr"><?= $resultat['descriptions'] ?></p>
                                    </div>
                                    <div class="mycard__info">
    
                                        <div><span class="text-success fw-bolder"><?= number_format($resultat['prix'], 0, '.', ' ')  ?> FCFA<?= $resultat['periode'] ?></span></div>
                                        <div>Plus de détails</div>
                                    </div>
                                    <div class="mycard__time">
                                        <div>
                                            <i class="fa-solid fa-clock-rotate-left"></i>
                                            <?php echo time_ago($resultat['date_add']) ?>
                                        </div>
                                    </div>
                                </a>
    
                        <?php }
                        endwhile ;
                    } ?>
                    
                    <?php } elseif (isset($_POST['-c'])) {
                            $oui = "oui";
                            $statuts = "en cours";
                            $req = $loginData->prepare("SELECT * FROM annonces WHERE types= ? AND prix >= ? AND valider = ? AND statuts = ? ORDER BY prix ASC");
                            $req->execute(array($types, $min, $oui, $statuts));
                           $reqcount = $req->rowCount();

                    if ($reqcount <= 0) {
                        $text ="Aucune annonce n'a été trouvée";
                    }else{
                        while ($resultat = $req->fetch(PDO::FETCH_ASSOC)) :

                            $today = $resultat["date_add"];
                            $limit_date = $resultat["date_expire"];
    
                            if ($today < $limit_date) {
                    ?>
                                <a href="plus_de_details.php?id=<?= $resultat['id_annonceurs'] ?>&annonce=<?= $resultat['id_annonces'] ?>" class=" mycard">
                                    <?php if ($resultat['options'] == "urgence") : ?>
                                        <p class="urgence">Urgence <i class="fa-solid fa-bell"></i></p>
                                    <?php endif; ?>
                                    <img src="<?= $resultat['img_cover'] ?>" class=" mycard__image">
                                    <div class="mycard__content">
                                        <p class="titre" style="text-transform:capitalize;"><?= $resultat['titres'] ?></p>
                                        <p class=" localisation"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                            <span class="vq">
                                                <?= $resultat['quartiers'] ?>,
                                                <?= $resultat['villes'] ?>
                                            </span>
                                        </p>
                                        <p class="descr"><?= $resultat['descriptions'] ?></p>
                                    </div>
                                    <div class="mycard__info">
    
                                        <div><span class="text-success fw-bolder"><?= number_format($resultat['prix'], 0, '.', ' ')  ?> FCFA<?= $resultat['periode'] ?></span></div>
                                        <div>Plus de détails</div>
                                    </div>
                                    <div class="mycard__time">
                                        <div>
                                            <i class="fa-solid fa-clock-rotate-left"></i>
                                            <?php echo time_ago($resultat['date_add']) ?>
                                        </div>
                                    </div>
                                </a>
    
                        <?php }
                        endwhile ;
                    } ?>
                    
                    <?php } elseif (isset($_POST['pj'])) {
                            $oui = "oui";
                            $statuts = "en cours";
                            $periode = "Jour";
                            $req = $loginData->prepare("SELECT * FROM annonces WHERE periode = ? AND types= ? AND prix >= ? AND valider = ? AND statuts = ?");
                            $req->execute(array($periode, $types, $min, $oui, $statuts));
                           $reqcount = $req->rowCount();

                    if ($reqcount <= 0) {
                        $text ="Aucune annonce n'a été trouvée";
                    }else{
                        while ($resultat = $req->fetch(PDO::FETCH_ASSOC)) :

                            $today = $resultat["date_add"];
                            $limit_date = $resultat["date_expire"];
    
                            if ($today < $limit_date) {
                    ?>
                                <a href="plus_de_details.php?id=<?= $resultat['id_annonceurs'] ?>&annonce=<?= $resultat['id_annonces'] ?>" class=" mycard">
                                    <?php if ($resultat['options'] == "urgence") : ?>
                                        <p class="urgence">Urgence <i class="fa-solid fa-bell"></i></p>
                                    <?php endif; ?>
                                    <img src="<?= $resultat['img_cover'] ?>" class=" mycard__image">
                                    <div class="mycard__content">
                                        <p class="titre" style="text-transform:capitalize;"><?= $resultat['titres'] ?></p>
                                        <p class=" localisation"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                            <span class="vq">
                                                <?= $resultat['quartiers'] ?>,
                                                <?= $resultat['villes'] ?>
                                            </span>
                                        </p>
                                        <p class="descr"><?= $resultat['descriptions'] ?></p>
                                    </div>
                                    <div class="mycard__info">
    
                                        <div><span class="text-success fw-bolder"><?= number_format($resultat['prix'], 0, '.', ' ')  ?> FCFA<?= $resultat['periode'] ?></span></div>
                                        <div>Plus de détails</div>
                                    </div>
                                    <div class="mycard__time">
                                        <div>
                                            <i class="fa-solid fa-clock-rotate-left"></i>
                                            <?php echo time_ago($resultat['date_add']) ?>
                                        </div>
                                    </div>
                                </a>
    
                        <?php }
                        endwhile ;
                    } ?>
                    
                    <?php } elseif (isset($_POST['ps'])) {
                            $oui = "oui";
                            $statuts = "en cours";
                            $periode = "Semaine";
                            $req = $loginData->prepare("SELECT * FROM annonces WHERE periode = ? AND types= ? AND prix >= ? AND valider = ? AND statuts = ?");
                            $req->execute(array($periode, $types, $min, $oui, $statuts));
                           $reqcount = $req->rowCount();

                    if ($reqcount <= 0) {
                        $text ="Aucune annonce n'a été trouvée";
                    }else{
                        while ($resultat = $req->fetch(PDO::FETCH_ASSOC)) :

                            $today = $resultat["date_add"];
                            $limit_date = $resultat["date_expire"];
    
                            if ($today < $limit_date) {
                    ?>
                                <a href="plus_de_details.php?id=<?= $resultat['id_annonceurs'] ?>&annonce=<?= $resultat['id_annonces'] ?>" class=" mycard">
                                    <?php if ($resultat['options'] == "urgence") : ?>
                                        <p class="urgence">Urgence <i class="fa-solid fa-bell"></i></p>
                                    <?php endif; ?>
                                    <img src="<?= $resultat['img_cover'] ?>" class=" mycard__image">
                                    <div class="mycard__content">
                                        <p class="titre" style="text-transform:capitalize;"><?= $resultat['titres'] ?></p>
                                        <p class=" localisation"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                            <span class="vq">
                                                <?= $resultat['quartiers'] ?>,
                                                <?= $resultat['villes'] ?>
                                            </span>
                                        </p>
                                        <p class="descr"><?= $resultat['descriptions'] ?></p>
                                    </div>
                                    <div class="mycard__info">
    
                                        <div><span class="text-success fw-bolder"><?= number_format($resultat['prix'], 0, '.', ' ')  ?> FCFA<?= $resultat['periode'] ?></span></div>
                                        <div>Plus de détails</div>
                                    </div>
                                    <div class="mycard__time">
                                        <div>
                                            <i class="fa-solid fa-clock-rotate-left"></i>
                                            <?php echo time_ago($resultat['date_add']) ?>
                                        </div>
                                    </div>
                                </a>
    
                        <?php }
                        endwhile ;
                    } ?>
                    
                    <?php } elseif (isset($_POST['pm'])) {
                            $oui = "oui";
                            $statuts = "en cours";
                            $periode = "Mois";
                            $req = $loginData->prepare("SELECT * FROM annonces WHERE periode = ? AND types= ? AND prix >= ? AND valider = ? AND statuts = ?");
                            $req->execute(array($periode, $types, $min, $oui, $statuts));
                           $reqcount = $req->rowCount();

                    if ($reqcount <= 0) {
                        $text ="Aucune annonce n'a été trouvée";
                    }else{
                        while ($resultat = $req->fetch(PDO::FETCH_ASSOC)) :

                            $today = $resultat["date_add"];
                            $limit_date = $resultat["date_expire"];
    
                            if ($today < $limit_date) {
                    ?>
                                <a href="plus_de_details.php?id=<?= $resultat['id_annonceurs'] ?>&annonce=<?= $resultat['id_annonces'] ?>" class=" mycard">
                                    <?php if ($resultat['options'] == "urgence") : ?>
                                        <p class="urgence">Urgence <i class="fa-solid fa-bell"></i></p>
                                    <?php endif; ?>
                                    <img src="<?= $resultat['img_cover'] ?>" class=" mycard__image">
                                    <div class="mycard__content">
                                        <p class="titre" style="text-transform:capitalize;"><?= $resultat['titres'] ?></p>
                                        <p class=" localisation"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                            <span class="vq">
                                                <?= $resultat['quartiers'] ?>,
                                                <?= $resultat['villes'] ?>
                                            </span>
                                        </p>
                                        <p class="descr"><?= $resultat['descriptions'] ?></p>
                                    </div>
                                    <div class="mycard__info">
    
                                        <div><span class="text-success fw-bolder"><?= number_format($resultat['prix'], 0, '.', ' ')  ?> FCFA<?= $resultat['periode'] ?></span></div>
                                        <div>Plus de détails</div>
                                    </div>
                                    <div class="mycard__time">
                                        <div>
                                            <i class="fa-solid fa-clock-rotate-left"></i>
                                            <?php echo time_ago($resultat['date_add']) ?>
                                        </div>
                                    </div>
                                </a>
    
                        <?php }
                        endwhile ;
                    } ?>
                    
                    <?php } else {
                            $statuts = "en cours";
                            $req = $loginData->prepare("SELECT * FROM annonces WHERE types= ? AND prix >= ? AND valider = ? AND statuts = ? ");
                            $req->execute(array($types, $min, $oui, $statuts));
                           $reqcount = $req->rowCount();

                    if ($reqcount <= 0) {
                        $text ="Aucune annonce n'a été trouvée";
                    }else{
                        while ($resultat = $req->fetch(PDO::FETCH_ASSOC)) :

                            $today = $resultat["date_add"];
                            $limit_date = $resultat["date_expire"];
    
                            if ($today < $limit_date) {
                    ?>
                                <a href="plus_de_details.php?id=<?= $resultat['id_annonceurs'] ?>&annonce=<?= $resultat['id_annonces'] ?>" class=" mycard">
                                    <?php if ($resultat['options'] == "urgence") : ?>
                                        <p class="urgence">Urgence <i class="fa-solid fa-bell"></i></p>
                                    <?php endif; ?>
                                    <img src="<?= $resultat['img_cover'] ?>" class=" mycard__image">
                                    <div class="mycard__content">
                                        <p class="titre" style="text-transform:capitalize;"><?= $resultat['titres'] ?></p>
                                        <p class=" localisation"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                            <span class="vq">
                                                <?= $resultat['quartiers'] ?>,
                                                <?= $resultat['villes'] ?>
                                            </span>
                                        </p>
                                        <p class="descr"><?= $resultat['descriptions'] ?></p>
                                    </div>
                                    <div class="mycard__info">
    
                                        <div><span class="text-success fw-bolder"><?= number_format($resultat['prix'], 0, '.', ' ')  ?> FCFA<?= $resultat['periode'] ?></span></div>
                                        <div>Plus de détails</div>
                                    </div>
                                    <div class="mycard__time">
                                        <div>
                                            <i class="fa-solid fa-clock-rotate-left"></i>
                                            <?php echo time_ago($resultat['date_add']) ?>
                                        </div>
                                    </div>
                                </a>
    
                        <?php }
                        endwhile ;
                    } ?>
                    
                    <?php }
                    }
                    //////type et max/////////////////////////////
                    elseif (empty($quartier) && !empty($types) && empty($min) && !empty($max) && empty($ville)) {
                        if (isset($_POST['+r'])) {
                            $oui = "oui";
                            $statuts = "en cours";
                            $req = $loginData->prepare("SELECT * FROM annonces WHERE types= ? AND prix <= ? AND valider = ? AND statuts = ? ORDER BY id_annonces DESC");
                            $req->execute(array($types, $max, $oui, $statuts));
                           $reqcount = $req->rowCount();

                    if ($reqcount <= 0) {
                        $text ="Aucune annonce n'a été trouvée";
                    }else{
                        while ($resultat = $req->fetch(PDO::FETCH_ASSOC)) :

                            $today = $resultat["date_add"];
                            $limit_date = $resultat["date_expire"];
    
                            if ($today < $limit_date) {
                    ?>
                                <a href="plus_de_details.php?id=<?= $resultat['id_annonceurs'] ?>&annonce=<?= $resultat['id_annonces'] ?>" class=" mycard">
                                    <?php if ($resultat['options'] == "urgence") : ?>
                                        <p class="urgence">Urgence <i class="fa-solid fa-bell"></i></p>
                                    <?php endif; ?>
                                    <img src="<?= $resultat['img_cover'] ?>" class=" mycard__image">
                                    <div class="mycard__content">
                                        <p class="titre" style="text-transform:capitalize;"><?= $resultat['titres'] ?></p>
                                        <p class=" localisation"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                            <span class="vq">
                                                <?= $resultat['quartiers'] ?>,
                                                <?= $resultat['villes'] ?>
                                            </span>
                                        </p>
                                        <p class="descr"><?= $resultat['descriptions'] ?></p>
                                    </div>
                                    <div class="mycard__info">
    
                                        <div><span class="text-success fw-bolder"><?= number_format($resultat['prix'], 0, '.', ' ')  ?> FCFA<?= $resultat['periode'] ?></span></div>
                                        <div>Plus de détails</div>
                                    </div>
                                    <div class="mycard__time">
                                        <div>
                                            <i class="fa-solid fa-clock-rotate-left"></i>
                                            <?php echo time_ago($resultat['date_add']) ?>
                                        </div>
                                    </div>
                                </a>
    
                        <?php }
                        endwhile ;
                    } ?>
                    
                    <?php } elseif (isset($_POST['-r'])) {
                            $oui = "oui";
                            $statuts = "en cours";
                            $req = $loginData->prepare("SELECT * FROM annonces WHERE types = ? AND prix <= ? AND valider = ? AND statuts = ? ORDER BY id_annonces ASC");
                            $req->execute(array($types, $max, $oui, $statuts));
                           $reqcount = $req->rowCount();

                    if ($reqcount <= 0) {
                        $text ="Aucune annonce n'a été trouvée";
                    }else{
                        while ($resultat = $req->fetch(PDO::FETCH_ASSOC)) :

                            $today = $resultat["date_add"];
                            $limit_date = $resultat["date_expire"];
    
                            if ($today < $limit_date) {
                    ?>
                                <a href="plus_de_details.php?id=<?= $resultat['id_annonceurs'] ?>&annonce=<?= $resultat['id_annonces'] ?>" class=" mycard">
                                    <?php if ($resultat['options'] == "urgence") : ?>
                                        <p class="urgence">Urgence <i class="fa-solid fa-bell"></i></p>
                                    <?php endif; ?>
                                    <img src="<?= $resultat['img_cover'] ?>" class=" mycard__image">
                                    <div class="mycard__content">
                                        <p class="titre" style="text-transform:capitalize;"><?= $resultat['titres'] ?></p>
                                        <p class=" localisation"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                            <span class="vq">
                                                <?= $resultat['quartiers'] ?>,
                                                <?= $resultat['villes'] ?>
                                            </span>
                                        </p>
                                        <p class="descr"><?= $resultat['descriptions'] ?></p>
                                    </div>
                                    <div class="mycard__info">
    
                                        <div><span class="text-success fw-bolder"><?= number_format($resultat['prix'], 0, '.', ' ')  ?> FCFA<?= $resultat['periode'] ?></span></div>
                                        <div>Plus de détails</div>
                                    </div>
                                    <div class="mycard__time">
                                        <div>
                                            <i class="fa-solid fa-clock-rotate-left"></i>
                                            <?php echo time_ago($resultat['date_add']) ?>
                                        </div>
                                    </div>
                                </a>
    
                        <?php }
                        endwhile ;
                    } ?>
                    
                    <?php } elseif (isset($_POST['+c'])) {
                            $oui = "oui";
                            $statuts = "en cours";
                            $req = $loginData->prepare("SELECT * FROM annonces WHERE types= ? AND prix <= ? AND valider = ? AND statuts = ? ORDER BY prix DESC");
                            $req->execute(array($types, $max, $oui, $statuts));
                           $reqcount = $req->rowCount();

                    if ($reqcount <= 0) {
                        $text ="Aucune annonce n'a été trouvée";
                    }else{
                        while ($resultat = $req->fetch(PDO::FETCH_ASSOC)) :

                            $today = $resultat["date_add"];
                            $limit_date = $resultat["date_expire"];
    
                            if ($today < $limit_date) {
                    ?>
                                <a href="plus_de_details.php?id=<?= $resultat['id_annonceurs'] ?>&annonce=<?= $resultat['id_annonces'] ?>" class=" mycard">
                                    <?php if ($resultat['options'] == "urgence") : ?>
                                        <p class="urgence">Urgence <i class="fa-solid fa-bell"></i></p>
                                    <?php endif; ?>
                                    <img src="<?= $resultat['img_cover'] ?>" class=" mycard__image">
                                    <div class="mycard__content">
                                        <p class="titre" style="text-transform:capitalize;"><?= $resultat['titres'] ?></p>
                                        <p class=" localisation"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                            <span class="vq">
                                                <?= $resultat['quartiers'] ?>,
                                                <?= $resultat['villes'] ?>
                                            </span>
                                        </p>
                                        <p class="descr"><?= $resultat['descriptions'] ?></p>
                                    </div>
                                    <div class="mycard__info">
    
                                        <div><span class="text-success fw-bolder"><?= number_format($resultat['prix'], 0, '.', ' ')  ?> FCFA<?= $resultat['periode'] ?></span></div>
                                        <div>Plus de détails</div>
                                    </div>
                                    <div class="mycard__time">
                                        <div>
                                            <i class="fa-solid fa-clock-rotate-left"></i>
                                            <?php echo time_ago($resultat['date_add']) ?>
                                        </div>
                                    </div>
                                </a>
    
                        <?php }
                        endwhile ;
                    } ?>
                    
                    <?php } elseif (isset($_POST['-c'])) {
                            $oui = "oui";
                            $statuts = "en cours";
                            $req = $loginData->prepare("SELECT * FROM annonces WHERE types= ? AND prix <= ? AND valider = ? AND statuts = ? ORDER BY prix ASC");
                            $req->execute(array($types, $max, $oui, $statuts));
                           $reqcount = $req->rowCount();

                    if ($reqcount <= 0) {
                        $text ="Aucune annonce n'a été trouvée";
                    }else{
                        while ($resultat = $req->fetch(PDO::FETCH_ASSOC)) :

                            $today = $resultat["date_add"];
                            $limit_date = $resultat["date_expire"];
    
                            if ($today < $limit_date) {
                    ?>
                                <a href="plus_de_details.php?id=<?= $resultat['id_annonceurs'] ?>&annonce=<?= $resultat['id_annonces'] ?>" class=" mycard">
                                    <?php if ($resultat['options'] == "urgence") : ?>
                                        <p class="urgence">Urgence <i class="fa-solid fa-bell"></i></p>
                                    <?php endif; ?>
                                    <img src="<?= $resultat['img_cover'] ?>" class=" mycard__image">
                                    <div class="mycard__content">
                                        <p class="titre" style="text-transform:capitalize;"><?= $resultat['titres'] ?></p>
                                        <p class=" localisation"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                            <span class="vq">
                                                <?= $resultat['quartiers'] ?>,
                                                <?= $resultat['villes'] ?>
                                            </span>
                                        </p>
                                        <p class="descr"><?= $resultat['descriptions'] ?></p>
                                    </div>
                                    <div class="mycard__info">
    
                                        <div><span class="text-success fw-bolder"><?= number_format($resultat['prix'], 0, '.', ' ')  ?> FCFA<?= $resultat['periode'] ?></span></div>
                                        <div>Plus de détails</div>
                                    </div>
                                    <div class="mycard__time">
                                        <div>
                                            <i class="fa-solid fa-clock-rotate-left"></i>
                                            <?php echo time_ago($resultat['date_add']) ?>
                                        </div>
                                    </div>
                                </a>
    
                        <?php }
                        endwhile ;
                    } ?>
                    
                    <?php } elseif (isset($_POST['pj'])) {
                            $oui = "oui";
                            $statuts = "en cours";
                            $periode = "Jour";
                            $req = $loginData->prepare("SELECT * FROM annonces WHERE periode = ? AND types= ? AND prix <= ? AND valider = ? AND statuts = ?");
                            $req->execute(array($periode, $types, $max, $oui, $statuts));
                           $reqcount = $req->rowCount();

                    if ($reqcount <= 0) {
                        $text ="Aucune annonce n'a été trouvée";
                    }else{
                        while ($resultat = $req->fetch(PDO::FETCH_ASSOC)) :

                            $today = $resultat["date_add"];
                            $limit_date = $resultat["date_expire"];
    
                            if ($today < $limit_date) {
                    ?>
                                <a href="plus_de_details.php?id=<?= $resultat['id_annonceurs'] ?>&annonce=<?= $resultat['id_annonces'] ?>" class=" mycard">
                                    <?php if ($resultat['options'] == "urgence") : ?>
                                        <p class="urgence">Urgence <i class="fa-solid fa-bell"></i></p>
                                    <?php endif; ?>
                                    <img src="<?= $resultat['img_cover'] ?>" class=" mycard__image">
                                    <div class="mycard__content">
                                        <p class="titre" style="text-transform:capitalize;"><?= $resultat['titres'] ?></p>
                                        <p class=" localisation"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                            <span class="vq">
                                                <?= $resultat['quartiers'] ?>,
                                                <?= $resultat['villes'] ?>
                                            </span>
                                        </p>
                                        <p class="descr"><?= $resultat['descriptions'] ?></p>
                                    </div>
                                    <div class="mycard__info">
    
                                        <div><span class="text-success fw-bolder"><?= number_format($resultat['prix'], 0, '.', ' ')  ?> FCFA<?= $resultat['periode'] ?></span></div>
                                        <div>Plus de détails</div>
                                    </div>
                                    <div class="mycard__time">
                                        <div>
                                            <i class="fa-solid fa-clock-rotate-left"></i>
                                            <?php echo time_ago($resultat['date_add']) ?>
                                        </div>
                                    </div>
                                </a>
    
                        <?php }
                        endwhile ;
                    } ?>
                    
                    <?php } elseif (isset($_POST['ps'])) {
                            $oui = "oui";
                            $statuts = "en cours";
                            $periode = "Semaine";
                            $req = $loginData->prepare("SELECT * FROM annonces WHERE periode = ? AND types= ? AND prix <= ? AND valider = ? AND statuts = ?");
                            $req->execute(array($periode, $types, $max, $oui, $statuts));
                           $reqcount = $req->rowCount();

                    if ($reqcount <= 0) {
                        $text ="Aucune annonce n'a été trouvée";
                    }else{
                        while ($resultat = $req->fetch(PDO::FETCH_ASSOC)) :

                            $today = $resultat["date_add"];
                            $limit_date = $resultat["date_expire"];
    
                            if ($today < $limit_date) {
                    ?>
                                <a href="plus_de_details.php?id=<?= $resultat['id_annonceurs'] ?>&annonce=<?= $resultat['id_annonces'] ?>" class=" mycard">
                                    <?php if ($resultat['options'] == "urgence") : ?>
                                        <p class="urgence">Urgence <i class="fa-solid fa-bell"></i></p>
                                    <?php endif; ?>
                                    <img src="<?= $resultat['img_cover'] ?>" class=" mycard__image">
                                    <div class="mycard__content">
                                        <p class="titre" style="text-transform:capitalize;"><?= $resultat['titres'] ?></p>
                                        <p class=" localisation"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                            <span class="vq">
                                                <?= $resultat['quartiers'] ?>,
                                                <?= $resultat['villes'] ?>
                                            </span>
                                        </p>
                                        <p class="descr"><?= $resultat['descriptions'] ?></p>
                                    </div>
                                    <div class="mycard__info">
    
                                        <div><span class="text-success fw-bolder"><?= number_format($resultat['prix'], 0, '.', ' ')  ?> FCFA<?= $resultat['periode'] ?></span></div>
                                        <div>Plus de détails</div>
                                    </div>
                                    <div class="mycard__time">
                                        <div>
                                            <i class="fa-solid fa-clock-rotate-left"></i>
                                            <?php echo time_ago($resultat['date_add']) ?>
                                        </div>
                                    </div>
                                </a>
    
                        <?php }
                        endwhile ;
                    } ?>
                    
                    <?php } elseif (isset($_POST['pm'])) {
                            $oui = "oui";
                            $statuts = "en cours";
                            $periode = "Mois";
                            $req = $loginData->prepare("SELECT * FROM annonces WHERE periode = ? AND types= ? AND prix <= ? AND valider = ? AND statuts = ?");
                            $req->execute(array($periode, $types, $max, $oui, $statuts));
                           $reqcount = $req->rowCount();

                    if ($reqcount <= 0) {
                        $text ="Aucune annonce n'a été trouvée";
                    }else{
                        while ($resultat = $req->fetch(PDO::FETCH_ASSOC)) :

                            $today = $resultat["date_add"];
                            $limit_date = $resultat["date_expire"];
    
                            if ($today < $limit_date) {
                    ?>
                                <a href="plus_de_details.php?id=<?= $resultat['id_annonceurs'] ?>&annonce=<?= $resultat['id_annonces'] ?>" class=" mycard">
                                    <?php if ($resultat['options'] == "urgence") : ?>
                                        <p class="urgence">Urgence <i class="fa-solid fa-bell"></i></p>
                                    <?php endif; ?>
                                    <img src="<?= $resultat['img_cover'] ?>" class=" mycard__image">
                                    <div class="mycard__content">
                                        <p class="titre" style="text-transform:capitalize;"><?= $resultat['titres'] ?></p>
                                        <p class=" localisation"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                            <span class="vq">
                                                <?= $resultat['quartiers'] ?>,
                                                <?= $resultat['villes'] ?>
                                            </span>
                                        </p>
                                        <p class="descr"><?= $resultat['descriptions'] ?></p>
                                    </div>
                                    <div class="mycard__info">
    
                                        <div><span class="text-success fw-bolder"><?= number_format($resultat['prix'], 0, '.', ' ')  ?> FCFA<?= $resultat['periode'] ?></span></div>
                                        <div>Plus de détails</div>
                                    </div>
                                    <div class="mycard__time">
                                        <div>
                                            <i class="fa-solid fa-clock-rotate-left"></i>
                                            <?php echo time_ago($resultat['date_add']) ?>
                                        </div>
                                    </div>
                                </a>
    
                        <?php }
                        endwhile ;
                    } ?>
                    
                    <?php } else {
                            $statuts = "en cours";
                            $req = $loginData->prepare("SELECT * FROM annonces WHERE types= ? AND prix <= ? AND valider = ? AND statuts = ? ");
                            $req->execute(array($types, $max, $oui, $statuts));
                           $reqcount = $req->rowCount();

                    if ($reqcount <= 0) {
                        $text ="Aucune annonce n'a été trouvée";
                    }else{
                        while ($resultat = $req->fetch(PDO::FETCH_ASSOC)) :

                            $today = $resultat["date_add"];
                            $limit_date = $resultat["date_expire"];
    
                            if ($today < $limit_date) {
                    ?>
                                <a href="plus_de_details.php?id=<?= $resultat['id_annonceurs'] ?>&annonce=<?= $resultat['id_annonces'] ?>" class=" mycard">
                                    <?php if ($resultat['options'] == "urgence") : ?>
                                        <p class="urgence">Urgence <i class="fa-solid fa-bell"></i></p>
                                    <?php endif; ?>
                                    <img src="<?= $resultat['img_cover'] ?>" class=" mycard__image">
                                    <div class="mycard__content">
                                        <p class="titre" style="text-transform:capitalize;"><?= $resultat['titres'] ?></p>
                                        <p class=" localisation"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                            <span class="vq">
                                                <?= $resultat['quartiers'] ?>,
                                                <?= $resultat['villes'] ?>
                                            </span>
                                        </p>
                                        <p class="descr"><?= $resultat['descriptions'] ?></p>
                                    </div>
                                    <div class="mycard__info">
    
                                        <div><span class="text-success fw-bolder"><?= number_format($resultat['prix'], 0, '.', ' ')  ?> FCFA<?= $resultat['periode'] ?></span></div>
                                        <div>Plus de détails</div>
                                    </div>
                                    <div class="mycard__time">
                                        <div>
                                            <i class="fa-solid fa-clock-rotate-left"></i>
                                            <?php echo time_ago($resultat['date_add']) ?>
                                        </div>
                                    </div>
                                </a>
    
                        <?php }
                        endwhile ;
                    } ?>
                    
                    <?php }
                    }
                    //////ville et quartier/////////////////////////////
                    elseif (!empty($quartier) && empty($types) && empty($min) && empty($max) && !empty($ville)) {
                        if (isset($_POST['+r'])) {
                            $oui = "oui";
                            $statuts = "en cours";
                            $req = $loginData->prepare("SELECT * FROM annonces WHERE villes= ? AND quartiers = ? AND valider = ? AND statuts = ? ORDER BY id_annonces DESC");
                            $req->execute(array($ville, $quartier, $oui, $statuts));
                           $reqcount = $req->rowCount();

                    if ($reqcount <= 0) {
                        $text ="Aucune annonce n'a été trouvée";
                    }else{
                        while ($resultat = $req->fetch(PDO::FETCH_ASSOC)) :

                            $today = $resultat["date_add"];
                            $limit_date = $resultat["date_expire"];
    
                            if ($today < $limit_date) {
                    ?>
                                <a href="plus_de_details.php?id=<?= $resultat['id_annonceurs'] ?>&annonce=<?= $resultat['id_annonces'] ?>" class=" mycard">
                                    <?php if ($resultat['options'] == "urgence") : ?>
                                        <p class="urgence">Urgence <i class="fa-solid fa-bell"></i></p>
                                    <?php endif; ?>
                                    <img src="<?= $resultat['img_cover'] ?>" class=" mycard__image">
                                    <div class="mycard__content">
                                        <p class="titre" style="text-transform:capitalize;"><?= $resultat['titres'] ?></p>
                                        <p class=" localisation"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                            <span class="vq">
                                                <?= $resultat['quartiers'] ?>,
                                                <?= $resultat['villes'] ?>
                                            </span>
                                        </p>
                                        <p class="descr"><?= $resultat['descriptions'] ?></p>
                                    </div>
                                    <div class="mycard__info">
    
                                        <div><span class="text-success fw-bolder"><?= number_format($resultat['prix'], 0, '.', ' ')  ?> FCFA<?= $resultat['periode'] ?></span></div>
                                        <div>Plus de détails</div>
                                    </div>
                                    <div class="mycard__time">
                                        <div>
                                            <i class="fa-solid fa-clock-rotate-left"></i>
                                            <?php echo time_ago($resultat['date_add']) ?>
                                        </div>
                                    </div>
                                </a>
    
                        <?php }
                        endwhile ;
                    } ?>
                    
                    <?php } elseif (isset($_POST['-r'])) {
                            $oui = "oui";
                            $statuts = "en cours";
                            $req = $loginData->prepare("SELECT * FROM annonces WHERE villes = ? AND quartiers = ? AND valider = ? AND statuts = ? ORDER BY id_annonces ASC");
                            $req->execute(array($ville, $quartier, $oui, $statuts));
                           $reqcount = $req->rowCount();

                    if ($reqcount <= 0) {
                        $text ="Aucune annonce n'a été trouvée";
                    }else{
                        while ($resultat = $req->fetch(PDO::FETCH_ASSOC)) :

                            $today = $resultat["date_add"];
                            $limit_date = $resultat["date_expire"];
    
                            if ($today < $limit_date) {
                    ?>
                                <a href="plus_de_details.php?id=<?= $resultat['id_annonceurs'] ?>&annonce=<?= $resultat['id_annonces'] ?>" class=" mycard">
                                    <?php if ($resultat['options'] == "urgence") : ?>
                                        <p class="urgence">Urgence <i class="fa-solid fa-bell"></i></p>
                                    <?php endif; ?>
                                    <img src="<?= $resultat['img_cover'] ?>" class=" mycard__image">
                                    <div class="mycard__content">
                                        <p class="titre" style="text-transform:capitalize;"><?= $resultat['titres'] ?></p>
                                        <p class=" localisation"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                            <span class="vq">
                                                <?= $resultat['quartiers'] ?>,
                                                <?= $resultat['villes'] ?>
                                            </span>
                                        </p>
                                        <p class="descr"><?= $resultat['descriptions'] ?></p>
                                    </div>
                                    <div class="mycard__info">
    
                                        <div><span class="text-success fw-bolder"><?= number_format($resultat['prix'], 0, '.', ' ')  ?> FCFA<?= $resultat['periode'] ?></span></div>
                                        <div>Plus de détails</div>
                                    </div>
                                    <div class="mycard__time">
                                        <div>
                                            <i class="fa-solid fa-clock-rotate-left"></i>
                                            <?php echo time_ago($resultat['date_add']) ?>
                                        </div>
                                    </div>
                                </a>
    
                        <?php }
                        endwhile ;
                    } ?>
                    
                    <?php } elseif (isset($_POST['+c'])) {
                            $oui = "oui";
                            $statuts = "en cours";
                            $req = $loginData->prepare("SELECT * FROM annonces WHERE villes= ? AND quartiers= ? AND valider = ? AND statuts = ? ORDER BY prix DESC");
                            $req->execute(array($ville, $quartier, $oui, $statuts));
                           $reqcount = $req->rowCount();

                    if ($reqcount <= 0) {
                        $text ="Aucune annonce n'a été trouvée";
                    }else{
                        while ($resultat = $req->fetch(PDO::FETCH_ASSOC)) :

                            $today = $resultat["date_add"];
                            $limit_date = $resultat["date_expire"];
    
                            if ($today < $limit_date) {
                    ?>
                                <a href="plus_de_details.php?id=<?= $resultat['id_annonceurs'] ?>&annonce=<?= $resultat['id_annonces'] ?>" class=" mycard">
                                    <?php if ($resultat['options'] == "urgence") : ?>
                                        <p class="urgence">Urgence <i class="fa-solid fa-bell"></i></p>
                                    <?php endif; ?>
                                    <img src="<?= $resultat['img_cover'] ?>" class=" mycard__image">
                                    <div class="mycard__content">
                                        <p class="titre" style="text-transform:capitalize;"><?= $resultat['titres'] ?></p>
                                        <p class=" localisation"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                            <span class="vq">
                                                <?= $resultat['quartiers'] ?>,
                                                <?= $resultat['villes'] ?>
                                            </span>
                                        </p>
                                        <p class="descr"><?= $resultat['descriptions'] ?></p>
                                    </div>
                                    <div class="mycard__info">
    
                                        <div><span class="text-success fw-bolder"><?= number_format($resultat['prix'], 0, '.', ' ')  ?> FCFA<?= $resultat['periode'] ?></span></div>
                                        <div>Plus de détails</div>
                                    </div>
                                    <div class="mycard__time">
                                        <div>
                                            <i class="fa-solid fa-clock-rotate-left"></i>
                                            <?php echo time_ago($resultat['date_add']) ?>
                                        </div>
                                    </div>
                                </a>
    
                        <?php }
                        endwhile ;
                    } ?>
                    
                    <?php } elseif (isset($_POST['-c'])) {
                            $oui = "oui";
                            $statuts = "en cours";
                            $req = $loginData->prepare("SELECT * FROM annonces WHERE villes= ? AND quartiers = ? AND valider = ? AND statuts = ? ORDER BY prix ASC");
                            $req->execute(array($ville, $quartier, $oui, $statuts));
                           $reqcount = $req->rowCount();

                    if ($reqcount <= 0) {
                        $text ="Aucune annonce n'a été trouvée";
                    }else{
                        while ($resultat = $req->fetch(PDO::FETCH_ASSOC)) :

                            $today = $resultat["date_add"];
                            $limit_date = $resultat["date_expire"];
    
                            if ($today < $limit_date) {
                    ?>
                                <a href="plus_de_details.php?id=<?= $resultat['id_annonceurs'] ?>&annonce=<?= $resultat['id_annonces'] ?>" class=" mycard">
                                    <?php if ($resultat['options'] == "urgence") : ?>
                                        <p class="urgence">Urgence <i class="fa-solid fa-bell"></i></p>
                                    <?php endif; ?>
                                    <img src="<?= $resultat['img_cover'] ?>" class=" mycard__image">
                                    <div class="mycard__content">
                                        <p class="titre" style="text-transform:capitalize;"><?= $resultat['titres'] ?></p>
                                        <p class=" localisation"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                            <span class="vq">
                                                <?= $resultat['quartiers'] ?>,
                                                <?= $resultat['villes'] ?>
                                            </span>
                                        </p>
                                        <p class="descr"><?= $resultat['descriptions'] ?></p>
                                    </div>
                                    <div class="mycard__info">
    
                                        <div><span class="text-success fw-bolder"><?= number_format($resultat['prix'], 0, '.', ' ')  ?> FCFA<?= $resultat['periode'] ?></span></div>
                                        <div>Plus de détails</div>
                                    </div>
                                    <div class="mycard__time">
                                        <div>
                                            <i class="fa-solid fa-clock-rotate-left"></i>
                                            <?php echo time_ago($resultat['date_add']) ?>
                                        </div>
                                    </div>
                                </a>
    
                        <?php }
                        endwhile ;
                    } ?>
                    
                    <?php } elseif (isset($_POST['pj'])) {
                            $oui = "oui";
                            $statuts = "en cours";
                            $periode = "Jour";
                            $req = $loginData->prepare("SELECT * FROM annonces WHERE periode = ? AND villes= ? AND quartiers = ? AND valider = ? AND statuts = ?");
                            $req->execute(array($periode, $ville, $quartier, $oui, $statuts));
                           $reqcount = $req->rowCount();

                    if ($reqcount <= 0) {
                        $text ="Aucune annonce n'a été trouvée";
                    }else{
                        while ($resultat = $req->fetch(PDO::FETCH_ASSOC)) :

                            $today = $resultat["date_add"];
                            $limit_date = $resultat["date_expire"];
    
                            if ($today < $limit_date) {
                    ?>
                                <a href="plus_de_details.php?id=<?= $resultat['id_annonceurs'] ?>&annonce=<?= $resultat['id_annonces'] ?>" class=" mycard">
                                    <?php if ($resultat['options'] == "urgence") : ?>
                                        <p class="urgence">Urgence <i class="fa-solid fa-bell"></i></p>
                                    <?php endif; ?>
                                    <img src="<?= $resultat['img_cover'] ?>" class=" mycard__image">
                                    <div class="mycard__content">
                                        <p class="titre" style="text-transform:capitalize;"><?= $resultat['titres'] ?></p>
                                        <p class=" localisation"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                            <span class="vq">
                                                <?= $resultat['quartiers'] ?>,
                                                <?= $resultat['villes'] ?>
                                            </span>
                                        </p>
                                        <p class="descr"><?= $resultat['descriptions'] ?></p>
                                    </div>
                                    <div class="mycard__info">
    
                                        <div><span class="text-success fw-bolder"><?= number_format($resultat['prix'], 0, '.', ' ')  ?> FCFA<?= $resultat['periode'] ?></span></div>
                                        <div>Plus de détails</div>
                                    </div>
                                    <div class="mycard__time">
                                        <div>
                                            <i class="fa-solid fa-clock-rotate-left"></i>
                                            <?php echo time_ago($resultat['date_add']) ?>
                                        </div>
                                    </div>
                                </a>
    
                        <?php }
                        endwhile ;
                    } ?>
                    
                    <?php } elseif (isset($_POST['ps'])) {
                            $oui = "oui";
                            $statuts = "en cours";
                            $periode = "Semaine";
                            $req = $loginData->prepare("SELECT * FROM annonces WHERE periode = ? AND villes= ? AND quartiers = ? AND valider = ? AND statuts = ?");
                            $req->execute(array($periode, $ville, $quartier, $oui, $statuts));
                           $reqcount = $req->rowCount();

                    if ($reqcount <= 0) {
                        $text ="Aucune annonce n'a été trouvée";
                    }else{
                        while ($resultat = $req->fetch(PDO::FETCH_ASSOC)) :

                            $today = $resultat["date_add"];
                            $limit_date = $resultat["date_expire"];
    
                            if ($today < $limit_date) {
                    ?>
                                <a href="plus_de_details.php?id=<?= $resultat['id_annonceurs'] ?>&annonce=<?= $resultat['id_annonces'] ?>" class=" mycard">
                                    <?php if ($resultat['options'] == "urgence") : ?>
                                        <p class="urgence">Urgence <i class="fa-solid fa-bell"></i></p>
                                    <?php endif; ?>
                                    <img src="<?= $resultat['img_cover'] ?>" class=" mycard__image">
                                    <div class="mycard__content">
                                        <p class="titre" style="text-transform:capitalize;"><?= $resultat['titres'] ?></p>
                                        <p class=" localisation"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                            <span class="vq">
                                                <?= $resultat['quartiers'] ?>,
                                                <?= $resultat['villes'] ?>
                                            </span>
                                        </p>
                                        <p class="descr"><?= $resultat['descriptions'] ?></p>
                                    </div>
                                    <div class="mycard__info">
    
                                        <div><span class="text-success fw-bolder"><?= number_format($resultat['prix'], 0, '.', ' ')  ?> FCFA<?= $resultat['periode'] ?></span></div>
                                        <div>Plus de détails</div>
                                    </div>
                                    <div class="mycard__time">
                                        <div>
                                            <i class="fa-solid fa-clock-rotate-left"></i>
                                            <?php echo time_ago($resultat['date_add']) ?>
                                        </div>
                                    </div>
                                </a>
    
                        <?php }
                        endwhile ;
                    } ?>
                    
                    <?php } elseif (isset($_POST['pm'])) {
                            $oui = "oui";
                            $statuts = "en cours";
                            $periode = "Mois";
                            $req = $loginData->prepare("SELECT * FROM annonces WHERE periode = ? AND villes= ? AND quartiers = ? AND valider = ? AND statuts = ?");
                            $req->execute(array($periode, $ville, $quartier, $oui, $statuts));
                           $reqcount = $req->rowCount();

                    if ($reqcount <= 0) {
                        $text ="Aucune annonce n'a été trouvée";
                    }else{
                        while ($resultat = $req->fetch(PDO::FETCH_ASSOC)) :

                            $today = $resultat["date_add"];
                            $limit_date = $resultat["date_expire"];
    
                            if ($today < $limit_date) {
                    ?>
                                <a href="plus_de_details.php?id=<?= $resultat['id_annonceurs'] ?>&annonce=<?= $resultat['id_annonces'] ?>" class=" mycard">
                                    <?php if ($resultat['options'] == "urgence") : ?>
                                        <p class="urgence">Urgence <i class="fa-solid fa-bell"></i></p>
                                    <?php endif; ?>
                                    <img src="<?= $resultat['img_cover'] ?>" class=" mycard__image">
                                    <div class="mycard__content">
                                        <p class="titre" style="text-transform:capitalize;"><?= $resultat['titres'] ?></p>
                                        <p class=" localisation"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                            <span class="vq">
                                                <?= $resultat['quartiers'] ?>,
                                                <?= $resultat['villes'] ?>
                                            </span>
                                        </p>
                                        <p class="descr"><?= $resultat['descriptions'] ?></p>
                                    </div>
                                    <div class="mycard__info">
    
                                        <div><span class="text-success fw-bolder"><?= number_format($resultat['prix'], 0, '.', ' ')  ?> FCFA<?= $resultat['periode'] ?></span></div>
                                        <div>Plus de détails</div>
                                    </div>
                                    <div class="mycard__time">
                                        <div>
                                            <i class="fa-solid fa-clock-rotate-left"></i>
                                            <?php echo time_ago($resultat['date_add']) ?>
                                        </div>
                                    </div>
                                </a>
    
                        <?php }
                        endwhile ;
                    } ?>
                    
                    <?php } else {
                            $statuts = "en cours";
                            $req = $loginData->prepare("SELECT * FROM annonces WHERE villes= ? AND quartiers= ? AND valider = ? AND statuts = ? ");
                            $req->execute(array($ville, $quartier, $oui, $statuts));
                           $reqcount = $req->rowCount();

                    if ($reqcount <= 0) {
                        $text ="Aucune annonce n'a été trouvée";
                    }else{
                        while ($resultat = $req->fetch(PDO::FETCH_ASSOC)) :

                            $today = $resultat["date_add"];
                            $limit_date = $resultat["date_expire"];
    
                            if ($today < $limit_date) {
                    ?>
                                <a href="plus_de_details.php?id=<?= $resultat['id_annonceurs'] ?>&annonce=<?= $resultat['id_annonces'] ?>" class=" mycard">
                                    <?php if ($resultat['options'] == "urgence") : ?>
                                        <p class="urgence">Urgence <i class="fa-solid fa-bell"></i></p>
                                    <?php endif; ?>
                                    <img src="<?= $resultat['img_cover'] ?>" class=" mycard__image">
                                    <div class="mycard__content">
                                        <p class="titre" style="text-transform:capitalize;"><?= $resultat['titres'] ?></p>
                                        <p class=" localisation"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                            <span class="vq">
                                                <?= $resultat['quartiers'] ?>,
                                                <?= $resultat['villes'] ?>
                                            </span>
                                        </p>
                                        <p class="descr"><?= $resultat['descriptions'] ?></p>
                                    </div>
                                    <div class="mycard__info">
    
                                        <div><span class="text-success fw-bolder"><?= number_format($resultat['prix'], 0, '.', ' ')  ?> FCFA<?= $resultat['periode'] ?></span></div>
                                        <div>Plus de détails</div>
                                    </div>
                                    <div class="mycard__time">
                                        <div>
                                            <i class="fa-solid fa-clock-rotate-left"></i>
                                            <?php echo time_ago($resultat['date_add']) ?>
                                        </div>
                                    </div>
                                </a>
    
                        <?php }
                        endwhile ;
                    } ?>
                    
                    <?php }
                    }
                    //////ville et min/////////////////////////////
                    elseif (empty($quartier) && empty($types) && !empty($min) && empty($max) && !empty($ville)) {
                        if (isset($_POST['+r'])) {
                            $oui = "oui";
                            $statuts = "en cours";
                            $req = $loginData->prepare("SELECT * FROM annonces WHERE villes= ? AND prix >= ? AND valider = ? AND statuts = ? ORDER BY id_annonces DESC");
                            $req->execute(array($ville, $min, $oui, $statuts));
                          $reqcount = $req->rowCount();

                    if ($reqcount <= 0) {
                        $text ="Aucune annonce n'a été trouvée";
                    }else{
                        while ($resultat = $req->fetch(PDO::FETCH_ASSOC)) :

                            $today = $resultat["date_add"];
                            $limit_date = $resultat["date_expire"];
    
                            if ($today < $limit_date) {
                    ?>
                                <a href="plus_de_details.php?id=<?= $resultat['id_annonceurs'] ?>&annonce=<?= $resultat['id_annonces'] ?>" class=" mycard">
                                    <?php if ($resultat['options'] == "urgence") : ?>
                                        <p class="urgence">Urgence <i class="fa-solid fa-bell"></i></p>
                                    <?php endif; ?>
                                    <img src="<?= $resultat['img_cover'] ?>" class=" mycard__image">
                                    <div class="mycard__content">
                                        <p class="titre" style="text-transform:capitalize;"><?= $resultat['titres'] ?></p>
                                        <p class=" localisation"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                            <span class="vq">
                                                <?= $resultat['quartiers'] ?>,
                                                <?= $resultat['villes'] ?>
                                            </span>
                                        </p>
                                        <p class="descr"><?= $resultat['descriptions'] ?></p>
                                    </div>
                                    <div class="mycard__info">
    
                                        <div><span class="text-success fw-bolder"><?= number_format($resultat['prix'], 0, '.', ' ')  ?> FCFA<?= $resultat['periode'] ?></span></div>
                                        <div>Plus de détails</div>
                                    </div>
                                    <div class="mycard__time">
                                        <div>
                                            <i class="fa-solid fa-clock-rotate-left"></i>
                                            <?php echo time_ago($resultat['date_add']) ?>
                                        </div>
                                    </div>
                                </a>
    
                        <?php }
                        endwhile ;
                    } ?>
                    
                    <?php } elseif (isset($_POST['-r'])) {
                            $oui = "oui";
                            $statuts = "en cours";
                            $req = $loginData->prepare("SELECT * FROM annonces WHERE villes = ? AND prix >= ? AND valider = ? AND statuts = ? ORDER BY id_annonces ASC");
                            $req->execute(array($ville, $min, $oui, $statuts));
                            $reqcount = $req->rowCount();

                    if ($reqcount <= 0) {
                        $text ="Aucune annonce n'a été trouvée";
                    }else{
                        while ($resultat = $req->fetch(PDO::FETCH_ASSOC)) :

                            $today = $resultat["date_add"];
                            $limit_date = $resultat["date_expire"];
    
                            if ($today < $limit_date) {
                    ?>
                                <a href="plus_de_details.php?id=<?= $resultat['id_annonceurs'] ?>&annonce=<?= $resultat['id_annonces'] ?>" class=" mycard">
                                    <?php if ($resultat['options'] == "urgence") : ?>
                                        <p class="urgence">Urgence <i class="fa-solid fa-bell"></i></p>
                                    <?php endif; ?>
                                    <img src="<?= $resultat['img_cover'] ?>" class=" mycard__image">
                                    <div class="mycard__content">
                                        <p class="titre" style="text-transform:capitalize;"><?= $resultat['titres'] ?></p>
                                        <p class=" localisation"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                            <span class="vq">
                                                <?= $resultat['quartiers'] ?>,
                                                <?= $resultat['villes'] ?>
                                            </span>
                                        </p>
                                        <p class="descr"><?= $resultat['descriptions'] ?></p>
                                    </div>
                                    <div class="mycard__info">
    
                                        <div><span class="text-success fw-bolder"><?= number_format($resultat['prix'], 0, '.', ' ')  ?> FCFA<?= $resultat['periode'] ?></span></div>
                                        <div>Plus de détails</div>
                                    </div>
                                    <div class="mycard__time">
                                        <div>
                                            <i class="fa-solid fa-clock-rotate-left"></i>
                                            <?php echo time_ago($resultat['date_add']) ?>
                                        </div>
                                    </div>
                                </a>
    
                        <?php }
                        endwhile ;
                    } ?>
                    
                    <?php } elseif (isset($_POST['+c'])) {
                            $oui = "oui";
                            $statuts = "en cours";
                            $req = $loginData->prepare("SELECT * FROM annonces WHERE villes= ? AND prix >= ? AND valider = ? AND statuts = ? ORDER BY prix DESC");
                            $req->execute(array($ville, $min, $oui, $statuts));
                           $reqcount = $req->rowCount();

                    if ($reqcount <= 0) {
                        $text ="Aucune annonce n'a été trouvée";
                    }else{
                        while ($resultat = $req->fetch(PDO::FETCH_ASSOC)) :

                            $today = $resultat["date_add"];
                            $limit_date = $resultat["date_expire"];
    
                            if ($today < $limit_date) {
                    ?>
                                <a href="plus_de_details.php?id=<?= $resultat['id_annonceurs'] ?>&annonce=<?= $resultat['id_annonces'] ?>" class=" mycard">
                                    <?php if ($resultat['options'] == "urgence") : ?>
                                        <p class="urgence">Urgence <i class="fa-solid fa-bell"></i></p>
                                    <?php endif; ?>
                                    <img src="<?= $resultat['img_cover'] ?>" class=" mycard__image">
                                    <div class="mycard__content">
                                        <p class="titre" style="text-transform:capitalize;"><?= $resultat['titres'] ?></p>
                                        <p class=" localisation"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                            <span class="vq">
                                                <?= $resultat['quartiers'] ?>,
                                                <?= $resultat['villes'] ?>
                                            </span>
                                        </p>
                                        <p class="descr"><?= $resultat['descriptions'] ?></p>
                                    </div>
                                    <div class="mycard__info">
    
                                        <div><span class="text-success fw-bolder"><?= number_format($resultat['prix'], 0, '.', ' ')  ?> FCFA<?= $resultat['periode'] ?></span></div>
                                        <div>Plus de détails</div>
                                    </div>
                                    <div class="mycard__time">
                                        <div>
                                            <i class="fa-solid fa-clock-rotate-left"></i>
                                            <?php echo time_ago($resultat['date_add']) ?>
                                        </div>
                                    </div>
                                </a>
    
                        <?php }
                        endwhile ;
                    } ?>
                    
                    <?php }elseif (isset($_POST['-c'])) {
                            $oui = "oui";
                            $statuts = "en cours";
                            $req = $loginData->prepare("SELECT * FROM annonces WHERE villes= ? AND prix >= ? AND valider = ? AND statuts = ? ORDER BY prix ASC");
                            $req->execute(array($ville, $min, $oui, $statuts));
                           $reqcount = $req->rowCount();

                    if ($reqcount <= 0) {
                        $text ="Aucune annonce n'a été trouvée";
                    }else{
                        while ($resultat = $req->fetch(PDO::FETCH_ASSOC)) :

                            $today = $resultat["date_add"];
                            $limit_date = $resultat["date_expire"];
    
                            if ($today < $limit_date) {
                    ?>
                                <a href="plus_de_details.php?id=<?= $resultat['id_annonceurs'] ?>&annonce=<?= $resultat['id_annonces'] ?>" class=" mycard">
                                    <?php if ($resultat['options'] == "urgence") : ?>
                                        <p class="urgence">Urgence <i class="fa-solid fa-bell"></i></p>
                                    <?php endif; ?>
                                    <img src="<?= $resultat['img_cover'] ?>" class=" mycard__image">
                                    <div class="mycard__content">
                                        <p class="titre" style="text-transform:capitalize;"><?= $resultat['titres'] ?></p>
                                        <p class=" localisation"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                            <span class="vq">
                                                <?= $resultat['quartiers'] ?>,
                                                <?= $resultat['villes'] ?>
                                            </span>
                                        </p>
                                        <p class="descr"><?= $resultat['descriptions'] ?></p>
                                    </div>
                                    <div class="mycard__info">
    
                                        <div><span class="text-success fw-bolder"><?= number_format($resultat['prix'], 0, '.', ' ')  ?> FCFA<?= $resultat['periode'] ?></span></div>
                                        <div>Plus de détails</div>
                                    </div>
                                    <div class="mycard__time">
                                        <div>
                                            <i class="fa-solid fa-clock-rotate-left"></i>
                                            <?php echo time_ago($resultat['date_add']) ?>
                                        </div>
                                    </div>
                                </a>
    
                        <?php }
                        endwhile ;
                    } ?>
                    
                    <?php } elseif (isset($_POST['pj'])) {
                            $oui = "oui";
                            $statuts = "en cours";
                            $periode = "Jour";
                            $req = $loginData->prepare("SELECT * FROM annonces WHERE periode = ? AND villes= ? AND prix >= ? AND valider = ? AND statuts = ?");
                            $req->execute(array($periode, $ville, $min, $oui, $statuts));
                           $reqcount = $req->rowCount();

                    if ($reqcount <= 0) {
                        $text ="Aucune annonce n'a été trouvée";
                    }else{
                        while ($resultat = $req->fetch(PDO::FETCH_ASSOC)) :

                            $today = $resultat["date_add"];
                            $limit_date = $resultat["date_expire"];
    
                            if ($today < $limit_date) {
                    ?>
                                <a href="plus_de_details.php?id=<?= $resultat['id_annonceurs'] ?>&annonce=<?= $resultat['id_annonces'] ?>" class=" mycard">
                                    <?php if ($resultat['options'] == "urgence") : ?>
                                        <p class="urgence">Urgence <i class="fa-solid fa-bell"></i></p>
                                    <?php endif; ?>
                                    <img src="<?= $resultat['img_cover'] ?>" class=" mycard__image">
                                    <div class="mycard__content">
                                        <p class="titre" style="text-transform:capitalize;"><?= $resultat['titres'] ?></p>
                                        <p class=" localisation"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                            <span class="vq">
                                                <?= $resultat['quartiers'] ?>,
                                                <?= $resultat['villes'] ?>
                                            </span>
                                        </p>
                                        <p class="descr"><?= $resultat['descriptions'] ?></p>
                                    </div>
                                    <div class="mycard__info">
    
                                        <div><span class="text-success fw-bolder"><?= number_format($resultat['prix'], 0, '.', ' ')  ?> FCFA<?= $resultat['periode'] ?></span></div>
                                        <div>Plus de détails</div>
                                    </div>
                                    <div class="mycard__time">
                                        <div>
                                            <i class="fa-solid fa-clock-rotate-left"></i>
                                            <?php echo time_ago($resultat['date_add']) ?>
                                        </div>
                                    </div>
                                </a>
    
                        <?php }
                        endwhile ;
                    } ?>
                    
                    <?php } elseif (isset($_POST['ps'])) {
                            $oui = "oui";
                            $statuts = "en cours";
                            $periode = "Semaine";
                            $req = $loginData->prepare("SELECT * FROM annonces WHERE periode = ? AND villes= ? AND prix >= ? AND valider = ? AND statuts = ?");
                            $req->execute(array($periode, $ville, $min, $oui, $statuts));
                           $reqcount = $req->rowCount();

                    if ($reqcount <= 0) {
                        $text ="Aucune annonce n'a été trouvée";
                    }else{
                        while ($resultat = $req->fetch(PDO::FETCH_ASSOC)) :

                            $today = $resultat["date_add"];
                            $limit_date = $resultat["date_expire"];
    
                            if ($today < $limit_date) {
                    ?>
                                <a href="plus_de_details.php?id=<?= $resultat['id_annonceurs'] ?>&annonce=<?= $resultat['id_annonces'] ?>" class=" mycard">
                                    <?php if ($resultat['options'] == "urgence") : ?>
                                        <p class="urgence">Urgence <i class="fa-solid fa-bell"></i></p>
                                    <?php endif; ?>
                                    <img src="<?= $resultat['img_cover'] ?>" class=" mycard__image">
                                    <div class="mycard__content">
                                        <p class="titre" style="text-transform:capitalize;"><?= $resultat['titres'] ?></p>
                                        <p class=" localisation"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                            <span class="vq">
                                                <?= $resultat['quartiers'] ?>,
                                                <?= $resultat['villes'] ?>
                                            </span>
                                        </p>
                                        <p class="descr"><?= $resultat['descriptions'] ?></p>
                                    </div>
                                    <div class="mycard__info">
    
                                        <div><span class="text-success fw-bolder"><?= number_format($resultat['prix'], 0, '.', ' ')  ?> FCFA<?= $resultat['periode'] ?></span></div>
                                        <div>Plus de détails</div>
                                    </div>
                                    <div class="mycard__time">
                                        <div>
                                            <i class="fa-solid fa-clock-rotate-left"></i>
                                            <?php echo time_ago($resultat['date_add']) ?>
                                        </div>
                                    </div>
                                </a>
    
                        <?php }
                        endwhile ;
                    } ?>
                    
                    <?php } elseif (isset($_POST['pm'])) {
                            $oui = "oui";
                            $statuts = "en cours";
                            $periode = "Mois";
                            $req = $loginData->prepare("SELECT * FROM annonces WHERE periode = ? AND villes= ? AND prix >= ? AND valider = ? AND statuts = ?");
                            $req->execute(array($periode, $ville, $min, $oui, $statuts));
                           $reqcount = $req->rowCount();

                    if ($reqcount <= 0) {
                        $text ="Aucune annonce n'a été trouvée";
                    }else{
                        while ($resultat = $req->fetch(PDO::FETCH_ASSOC)) :

                            $today = $resultat["date_add"];
                            $limit_date = $resultat["date_expire"];
    
                            if ($today < $limit_date) {
                    ?>
                                <a href="plus_de_details.php?id=<?= $resultat['id_annonceurs'] ?>&annonce=<?= $resultat['id_annonces'] ?>" class=" mycard">
                                    <?php if ($resultat['options'] == "urgence") : ?>
                                        <p class="urgence">Urgence <i class="fa-solid fa-bell"></i></p>
                                    <?php endif; ?>
                                    <img src="<?= $resultat['img_cover'] ?>" class=" mycard__image">
                                    <div class="mycard__content">
                                        <p class="titre" style="text-transform:capitalize;"><?= $resultat['titres'] ?></p>
                                        <p class=" localisation"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                            <span class="vq">
                                                <?= $resultat['quartiers'] ?>,
                                                <?= $resultat['villes'] ?>
                                            </span>
                                        </p>
                                        <p class="descr"><?= $resultat['descriptions'] ?></p>
                                    </div>
                                    <div class="mycard__info">
    
                                        <div><span class="text-success fw-bolder"><?= number_format($resultat['prix'], 0, '.', ' ')  ?> FCFA<?= $resultat['periode'] ?></span></div>
                                        <div>Plus de détails</div>
                                    </div>
                                    <div class="mycard__time">
                                        <div>
                                            <i class="fa-solid fa-clock-rotate-left"></i>
                                            <?php echo time_ago($resultat['date_add']) ?>
                                        </div>
                                    </div>
                                </a>
    
                        <?php }
                        endwhile ;
                    } ?>
                    
                    <?php } else {
                            $statuts = "en cours";
                            $req = $loginData->prepare("SELECT * FROM annonces WHERE villes= ? AND prix >= ? AND valider = ? AND statuts = ? ");
                            $req->execute(array($ville, $min, $oui, $statuts));
                           $reqcount = $req->rowCount();

                    if ($reqcount <= 0) {
                        $text ="Aucune annonce n'a été trouvée";
                    }else{
                        while ($resultat = $req->fetch(PDO::FETCH_ASSOC)) :

                            $today = $resultat["date_add"];
                            $limit_date = $resultat["date_expire"];
    
                            if ($today < $limit_date) {
                    ?>
                                <a href="plus_de_details.php?id=<?= $resultat['id_annonceurs'] ?>&annonce=<?= $resultat['id_annonces'] ?>" class=" mycard">
                                    <?php if ($resultat['options'] == "urgence") : ?>
                                        <p class="urgence">Urgence <i class="fa-solid fa-bell"></i></p>
                                    <?php endif; ?>
                                    <img src="<?= $resultat['img_cover'] ?>" class=" mycard__image">
                                    <div class="mycard__content">
                                        <p class="titre" style="text-transform:capitalize;"><?= $resultat['titres'] ?></p>
                                        <p class=" localisation"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                            <span class="vq">
                                                <?= $resultat['quartiers'] ?>,
                                                <?= $resultat['villes'] ?>
                                            </span>
                                        </p>
                                        <p class="descr"><?= $resultat['descriptions'] ?></p>
                                    </div>
                                    <div class="mycard__info">
    
                                        <div><span class="text-success fw-bolder"><?= number_format($resultat['prix'], 0, '.', ' ')  ?> FCFA<?= $resultat['periode'] ?></span></div>
                                        <div>Plus de détails</div>
                                    </div>
                                    <div class="mycard__time">
                                        <div>
                                            <i class="fa-solid fa-clock-rotate-left"></i>
                                            <?php echo time_ago($resultat['date_add']) ?>
                                        </div>
                                    </div>
                                </a>
    
                        <?php }
                        endwhile ;
                    } ?>
                    
                    <?php }
                    }
                    //////ville et max/////////////////////////////
                    elseif (empty($quartier) && empty($types) && empty($min) && !empty($max) && !empty($ville)) {
                        if (isset($_POST['+r'])) {
                            $oui = "oui";
                            $statuts = "en cours";
                            $req = $loginData->prepare("SELECT * FROM annonces WHERE villes= ? AND prix <= ? AND valider = ? AND statuts = ? ORDER BY id_annonces DESC");
                            $req->execute(array($ville, $max, $oui, $statuts));
                           $reqcount = $req->rowCount();

                    if ($reqcount <= 0) {
                        $text ="Aucune annonce n'a été trouvée";
                    }else{
                        while ($resultat = $req->fetch(PDO::FETCH_ASSOC)) :

                            $today = $resultat["date_add"];
                            $limit_date = $resultat["date_expire"];
    
                            if ($today < $limit_date) {
                    ?>
                                <a href="plus_de_details.php?id=<?= $resultat['id_annonceurs'] ?>&annonce=<?= $resultat['id_annonces'] ?>" class=" mycard">
                                    <?php if ($resultat['options'] == "urgence") : ?>
                                        <p class="urgence">Urgence <i class="fa-solid fa-bell"></i></p>
                                    <?php endif; ?>
                                    <img src="<?= $resultat['img_cover'] ?>" class=" mycard__image">
                                    <div class="mycard__content">
                                        <p class="titre" style="text-transform:capitalize;"><?= $resultat['titres'] ?></p>
                                        <p class=" localisation"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                            <span class="vq">
                                                <?= $resultat['quartiers'] ?>,
                                                <?= $resultat['villes'] ?>
                                            </span>
                                        </p>
                                        <p class="descr"><?= $resultat['descriptions'] ?></p>
                                    </div>
                                    <div class="mycard__info">
    
                                        <div><span class="text-success fw-bolder"><?= number_format($resultat['prix'], 0, '.', ' ')  ?> FCFA<?= $resultat['periode'] ?></span></div>
                                        <div>Plus de détails</div>
                                    </div>
                                    <div class="mycard__time">
                                        <div>
                                            <i class="fa-solid fa-clock-rotate-left"></i>
                                            <?php echo time_ago($resultat['date_add']) ?>
                                        </div>
                                    </div>
                                </a>
    
                        <?php }
                        endwhile ;
                    } ?>
                    
                    <?php } elseif (isset($_POST['-r'])) {
                            $oui = "oui";
                            $statuts = "en cours";
                            $req = $loginData->prepare("SELECT * FROM annonces WHERE villes = ? AND prix <= ? AND valider = ? AND statuts = ? ORDER BY id_annonces ASC");
                            $req->execute(array($ville, $max, $oui, $statuts));
                           $reqcount = $req->rowCount();

                    if ($reqcount <= 0) {
                        $text ="Aucune annonce n'a été trouvée";
                    }else{
                        while ($resultat = $req->fetch(PDO::FETCH_ASSOC)) :

                            $today = $resultat["date_add"];
                            $limit_date = $resultat["date_expire"];
    
                            if ($today < $limit_date) {
                    ?>
                                <a href="plus_de_details.php?id=<?= $resultat['id_annonceurs'] ?>&annonce=<?= $resultat['id_annonces'] ?>" class=" mycard">
                                    <?php if ($resultat['options'] == "urgence") : ?>
                                        <p class="urgence">Urgence <i class="fa-solid fa-bell"></i></p>
                                    <?php endif; ?>
                                    <img src="<?= $resultat['img_cover'] ?>" class=" mycard__image">
                                    <div class="mycard__content">
                                        <p class="titre" style="text-transform:capitalize;"><?= $resultat['titres'] ?></p>
                                        <p class=" localisation"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                            <span class="vq">
                                                <?= $resultat['quartiers'] ?>,
                                                <?= $resultat['villes'] ?>
                                            </span>
                                        </p>
                                        <p class="descr"><?= $resultat['descriptions'] ?></p>
                                    </div>
                                    <div class="mycard__info">
    
                                        <div><span class="text-success fw-bolder"><?= number_format($resultat['prix'], 0, '.', ' ')  ?> FCFA<?= $resultat['periode'] ?></span></div>
                                        <div>Plus de détails</div>
                                    </div>
                                    <div class="mycard__time">
                                        <div>
                                            <i class="fa-solid fa-clock-rotate-left"></i>
                                            <?php echo time_ago($resultat['date_add']) ?>
                                        </div>
                                    </div>
                                </a>
    
                        <?php }
                        endwhile ;
                    } ?>
                    
                    <?php } elseif (isset($_POST['+c'])) {
                            $oui = "oui";
                            $statuts = "en cours";
                            $req = $loginData->prepare("SELECT * FROM annonces WHERE villes= ? AND prix <= ? AND valider = ? AND statuts = ? ORDER BY prix DESC");
                            $req->execute(array($ville, $max, $oui, $statuts));
                           $reqcount = $req->rowCount();

                    if ($reqcount <= 0) {
                        $text ="Aucune annonce n'a été trouvée";
                    }else{
                        while ($resultat = $req->fetch(PDO::FETCH_ASSOC)) :

                            $today = $resultat["date_add"];
                            $limit_date = $resultat["date_expire"];
    
                            if ($today < $limit_date) {
                    ?>
                                <a href="plus_de_details.php?id=<?= $resultat['id_annonceurs'] ?>&annonce=<?= $resultat['id_annonces'] ?>" class=" mycard">
                                    <?php if ($resultat['options'] == "urgence") : ?>
                                        <p class="urgence">Urgence <i class="fa-solid fa-bell"></i></p>
                                    <?php endif; ?>
                                    <img src="<?= $resultat['img_cover'] ?>" class=" mycard__image">
                                    <div class="mycard__content">
                                        <p class="titre" style="text-transform:capitalize;"><?= $resultat['titres'] ?></p>
                                        <p class=" localisation"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                            <span class="vq">
                                                <?= $resultat['quartiers'] ?>,
                                                <?= $resultat['villes'] ?>
                                            </span>
                                        </p>
                                        <p class="descr"><?= $resultat['descriptions'] ?></p>
                                    </div>
                                    <div class="mycard__info">
    
                                        <div><span class="text-success fw-bolder"><?= number_format($resultat['prix'], 0, '.', ' ')  ?> FCFA<?= $resultat['periode'] ?></span></div>
                                        <div>Plus de détails</div>
                                    </div>
                                    <div class="mycard__time">
                                        <div>
                                            <i class="fa-solid fa-clock-rotate-left"></i>
                                            <?php echo time_ago($resultat['date_add']) ?>
                                        </div>
                                    </div>
                                </a>
    
                        <?php }
                        endwhile ;
                    } ?>
                    
                    <?php } elseif (isset($_POST['-c'])) {
                            $oui = "oui";
                            $statuts = "en cours";
                            $req = $loginData->prepare("SELECT * FROM annonces WHERE villes= ? AND prix <= ? AND valider = ? AND statuts = ? ORDER BY prix ASC");
                            $req->execute(array($ville, $max, $oui, $statuts));
                           $reqcount = $req->rowCount();

                    if ($reqcount <= 0) {
                        $text ="Aucune annonce n'a été trouvée";
                    }else{
                        while ($resultat = $req->fetch(PDO::FETCH_ASSOC)) :

                            $today = $resultat["date_add"];
                            $limit_date = $resultat["date_expire"];
    
                            if ($today < $limit_date) {
                    ?>
                                <a href="plus_de_details.php?id=<?= $resultat['id_annonceurs'] ?>&annonce=<?= $resultat['id_annonces'] ?>" class=" mycard">
                                    <?php if ($resultat['options'] == "urgence") : ?>
                                        <p class="urgence">Urgence <i class="fa-solid fa-bell"></i></p>
                                    <?php endif; ?>
                                    <img src="<?= $resultat['img_cover'] ?>" class=" mycard__image">
                                    <div class="mycard__content">
                                        <p class="titre" style="text-transform:capitalize;"><?= $resultat['titres'] ?></p>
                                        <p class=" localisation"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                            <span class="vq">
                                                <?= $resultat['quartiers'] ?>,
                                                <?= $resultat['villes'] ?>
                                            </span>
                                        </p>
                                        <p class="descr"><?= $resultat['descriptions'] ?></p>
                                    </div>
                                    <div class="mycard__info">
    
                                        <div><span class="text-success fw-bolder"><?= number_format($resultat['prix'], 0, '.', ' ')  ?> FCFA<?= $resultat['periode'] ?></span></div>
                                        <div>Plus de détails</div>
                                    </div>
                                    <div class="mycard__time">
                                        <div>
                                            <i class="fa-solid fa-clock-rotate-left"></i>
                                            <?php echo time_ago($resultat['date_add']) ?>
                                        </div>
                                    </div>
                                </a>
    
                        <?php }
                        endwhile ;
                    } ?>
                    
                    <?php } elseif (isset($_POST['pj'])) {
                            $oui = "oui";
                            $statuts = "en cours";
                            $periode = "Jour";
                            $req = $loginData->prepare("SELECT * FROM annonces WHERE periode = ? AND villes= ? AND prix <= ? AND valider = ? AND statuts = ?");
                            $req->execute(array($periode, $ville, $max, $oui, $statuts));
                           $reqcount = $req->rowCount();

                    if ($reqcount <= 0) {
                        $text ="Aucune annonce n'a été trouvée";
                    }else{
                        while ($resultat = $req->fetch(PDO::FETCH_ASSOC)) :

                            $today = $resultat["date_add"];
                            $limit_date = $resultat["date_expire"];
    
                            if ($today < $limit_date) {
                    ?>
                                <a href="plus_de_details.php?id=<?= $resultat['id_annonceurs'] ?>&annonce=<?= $resultat['id_annonces'] ?>" class=" mycard">
                                    <?php if ($resultat['options'] == "urgence") : ?>
                                        <p class="urgence">Urgence <i class="fa-solid fa-bell"></i></p>
                                    <?php endif; ?>
                                    <img src="<?= $resultat['img_cover'] ?>" class=" mycard__image">
                                    <div class="mycard__content">
                                        <p class="titre" style="text-transform:capitalize;"><?= $resultat['titres'] ?></p>
                                        <p class=" localisation"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                            <span class="vq">
                                                <?= $resultat['quartiers'] ?>,
                                                <?= $resultat['villes'] ?>
                                            </span>
                                        </p>
                                        <p class="descr"><?= $resultat['descriptions'] ?></p>
                                    </div>
                                    <div class="mycard__info">
    
                                        <div><span class="text-success fw-bolder"><?= number_format($resultat['prix'], 0, '.', ' ')  ?> FCFA<?= $resultat['periode'] ?></span></div>
                                        <div>Plus de détails</div>
                                    </div>
                                    <div class="mycard__time">
                                        <div>
                                            <i class="fa-solid fa-clock-rotate-left"></i>
                                            <?php echo time_ago($resultat['date_add']) ?>
                                        </div>
                                    </div>
                                </a>
    
                        <?php }
                        endwhile ;
                    } ?>
                    
                    <?php } elseif (isset($_POST['ps'])) {
                            $oui = "oui";
                            $statuts = "en cours";
                            $periode = "Semaine";
                            $req = $loginData->prepare("SELECT * FROM annonces WHERE periode = ? AND villes= ? AND prix <= ? AND valider = ? AND statuts = ?");
                            $req->execute(array($periode, $ville, $max, $oui, $statuts));
                           $reqcount = $req->rowCount();

                    if ($reqcount <= 0) {
                        $text ="Aucune annonce n'a été trouvée";
                    }else{
                        while ($resultat = $req->fetch(PDO::FETCH_ASSOC)) :

                            $today = $resultat["date_add"];
                            $limit_date = $resultat["date_expire"];
    
                            if ($today < $limit_date) {
                    ?>
                                <a href="plus_de_details.php?id=<?= $resultat['id_annonceurs'] ?>&annonce=<?= $resultat['id_annonces'] ?>" class=" mycard">
                                    <?php if ($resultat['options'] == "urgence") : ?>
                                        <p class="urgence">Urgence <i class="fa-solid fa-bell"></i></p>
                                    <?php endif; ?>
                                    <img src="<?= $resultat['img_cover'] ?>" class=" mycard__image">
                                    <div class="mycard__content">
                                        <p class="titre" style="text-transform:capitalize;"><?= $resultat['titres'] ?></p>
                                        <p class=" localisation"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                            <span class="vq">
                                                <?= $resultat['quartiers'] ?>,
                                                <?= $resultat['villes'] ?>
                                            </span>
                                        </p>
                                        <p class="descr"><?= $resultat['descriptions'] ?></p>
                                    </div>
                                    <div class="mycard__info">
    
                                        <div><span class="text-success fw-bolder"><?= number_format($resultat['prix'], 0, '.', ' ')  ?> FCFA<?= $resultat['periode'] ?></span></div>
                                        <div>Plus de détails</div>
                                    </div>
                                    <div class="mycard__time">
                                        <div>
                                            <i class="fa-solid fa-clock-rotate-left"></i>
                                            <?php echo time_ago($resultat['date_add']) ?>
                                        </div>
                                    </div>
                                </a>
    
                        <?php }
                        endwhile ;
                    } ?>
                    
                    <?php } elseif (isset($_POST['pm'])) {
                            $oui = "oui";
                            $statuts = "en cours";
                            $periode = "Mois";
                            $req = $loginData->prepare("SELECT * FROM annonces WHERE periode = ? AND villes= ? AND prix <= ? AND valider = ? AND statuts = ?");
                            $req->execute(array($periode, $ville, $max, $oui, $statuts));
                           $reqcount = $req->rowCount();

                    if ($reqcount <= 0) {
                        $text ="Aucune annonce n'a été trouvée";
                    }else{
                        while ($resultat = $req->fetch(PDO::FETCH_ASSOC)) :

                            $today = $resultat["date_add"];
                            $limit_date = $resultat["date_expire"];
    
                            if ($today < $limit_date) {
                    ?>
                                <a href="plus_de_details.php?id=<?= $resultat['id_annonceurs'] ?>&annonce=<?= $resultat['id_annonces'] ?>" class=" mycard">
                                    <?php if ($resultat['options'] == "urgence") : ?>
                                        <p class="urgence">Urgence <i class="fa-solid fa-bell"></i></p>
                                    <?php endif; ?>
                                    <img src="<?= $resultat['img_cover'] ?>" class=" mycard__image">
                                    <div class="mycard__content">
                                        <p class="titre" style="text-transform:capitalize;"><?= $resultat['titres'] ?></p>
                                        <p class=" localisation"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                            <span class="vq">
                                                <?= $resultat['quartiers'] ?>,
                                                <?= $resultat['villes'] ?>
                                            </span>
                                        </p>
                                        <p class="descr"><?= $resultat['descriptions'] ?></p>
                                    </div>
                                    <div class="mycard__info">
    
                                        <div><span class="text-success fw-bolder"><?= number_format($resultat['prix'], 0, '.', ' ')  ?> FCFA<?= $resultat['periode'] ?></span></div>
                                        <div>Plus de détails</div>
                                    </div>
                                    <div class="mycard__time">
                                        <div>
                                            <i class="fa-solid fa-clock-rotate-left"></i>
                                            <?php echo time_ago($resultat['date_add']) ?>
                                        </div>
                                    </div>
                                </a>
    
                        <?php }
                        endwhile ;
                    } ?>
                    
                    <?php } else {
                            $statuts = "en cours";
                            $req = $loginData->prepare("SELECT * FROM annonces WHERE villes= ? AND prix <= ? AND valider = ? AND statuts = ? ");
                            $req->execute(array($ville, $max, $oui, $statuts));
                           $reqcount = $req->rowCount();

                    if ($reqcount <= 0) {
                        $text ="Aucune annonce n'a été trouvée";
                    }else{
                        while ($resultat = $req->fetch(PDO::FETCH_ASSOC)) :

                            $today = $resultat["date_add"];
                            $limit_date = $resultat["date_expire"];
    
                            if ($today < $limit_date) {
                    ?>
                                <a href="plus_de_details.php?id=<?= $resultat['id_annonceurs'] ?>&annonce=<?= $resultat['id_annonces'] ?>" class=" mycard">
                                    <?php if ($resultat['options'] == "urgence") : ?>
                                        <p class="urgence">Urgence <i class="fa-solid fa-bell"></i></p>
                                    <?php endif; ?>
                                    <img src="<?= $resultat['img_cover'] ?>" class=" mycard__image">
                                    <div class="mycard__content">
                                        <p class="titre" style="text-transform:capitalize;"><?= $resultat['titres'] ?></p>
                                        <p class=" localisation"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                            <span class="vq">
                                                <?= $resultat['quartiers'] ?>,
                                                <?= $resultat['villes'] ?>
                                            </span>
                                        </p>
                                        <p class="descr"><?= $resultat['descriptions'] ?></p>
                                    </div>
                                    <div class="mycard__info">
    
                                        <div><span class="text-success fw-bolder"><?= number_format($resultat['prix'], 0, '.', ' ')  ?> FCFA<?= $resultat['periode'] ?></span></div>
                                        <div>Plus de détails</div>
                                    </div>
                                    <div class="mycard__time">
                                        <div>
                                            <i class="fa-solid fa-clock-rotate-left"></i>
                                            <?php echo time_ago($resultat['date_add']) ?>
                                        </div>
                                    </div>
                                </a>
    
                        <?php }
                        endwhile ;
                    } ?>
                    
                    <?php }
                    }
                    //////quartier et min/////////////////////////////
                    elseif (!empty($quartier) && empty($types) && !empty($min) && empty($max) && empty($ville)) {
                        if (isset($_POST['+r'])) {
                            $oui = "oui";
                            $statuts = "en cours";
                            $req = $loginData->prepare("SELECT * FROM annonces WHERE quartiers= ? AND prix >= ? AND valider = ? AND statuts = ? ORDER BY id_annonces DESC");
                            $req->execute(array($quartier, $min, $oui, $statuts));
                           $reqcount = $req->rowCount();

                    if ($reqcount <= 0) {
                        $text ="Aucune annonce n'a été trouvée";
                    }else{
                        while ($resultat = $req->fetch(PDO::FETCH_ASSOC)) :

                            $today = $resultat["date_add"];
                            $limit_date = $resultat["date_expire"];
    
                            if ($today < $limit_date) {
                    ?>
                                <a href="plus_de_details.php?id=<?= $resultat['id_annonceurs'] ?>&annonce=<?= $resultat['id_annonces'] ?>" class=" mycard">
                                    <?php if ($resultat['options'] == "urgence") : ?>
                                        <p class="urgence">Urgence <i class="fa-solid fa-bell"></i></p>
                                    <?php endif; ?>
                                    <img src="<?= $resultat['img_cover'] ?>" class=" mycard__image">
                                    <div class="mycard__content">
                                        <p class="titre" style="text-transform:capitalize;"><?= $resultat['titres'] ?></p>
                                        <p class=" localisation"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                            <span class="vq">
                                                <?= $resultat['quartiers'] ?>,
                                                <?= $resultat['villes'] ?>
                                            </span>
                                        </p>
                                        <p class="descr"><?= $resultat['descriptions'] ?></p>
                                    </div>
                                    <div class="mycard__info">
    
                                        <div><span class="text-success fw-bolder"><?= number_format($resultat['prix'], 0, '.', ' ')  ?> FCFA<?= $resultat['periode'] ?></span></div>
                                        <div>Plus de détails</div>
                                    </div>
                                    <div class="mycard__time">
                                        <div>
                                            <i class="fa-solid fa-clock-rotate-left"></i>
                                            <?php echo time_ago($resultat['date_add']) ?>
                                        </div>
                                    </div>
                                </a>
    
                        <?php }
                        endwhile ;
                    } ?>
                    
                    <?php } elseif (isset($_POST['-r'])) {
                            $oui = "oui";
                            $statuts = "en cours";
                            $req = $loginData->prepare("SELECT * FROM annonces WHERE quartiers = ? AND prix >= ? AND valider = ? AND statuts = ? ORDER BY id_annonces ASC");
                            $req->execute(array($quartier, $min, $oui, $statuts));
                           $reqcount = $req->rowCount();

                    if ($reqcount <= 0) {
                        $text ="Aucune annonce n'a été trouvée";
                    }else{
                        while ($resultat = $req->fetch(PDO::FETCH_ASSOC)) :

                            $today = $resultat["date_add"];
                            $limit_date = $resultat["date_expire"];
    
                            if ($today < $limit_date) {
                    ?>
                                <a href="plus_de_details.php?id=<?= $resultat['id_annonceurs'] ?>&annonce=<?= $resultat['id_annonces'] ?>" class=" mycard">
                                    <?php if ($resultat['options'] == "urgence") : ?>
                                        <p class="urgence">Urgence <i class="fa-solid fa-bell"></i></p>
                                    <?php endif; ?>
                                    <img src="<?= $resultat['img_cover'] ?>" class=" mycard__image">
                                    <div class="mycard__content">
                                        <p class="titre" style="text-transform:capitalize;"><?= $resultat['titres'] ?></p>
                                        <p class=" localisation"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                            <span class="vq">
                                                <?= $resultat['quartiers'] ?>,
                                                <?= $resultat['villes'] ?>
                                            </span>
                                        </p>
                                        <p class="descr"><?= $resultat['descriptions'] ?></p>
                                    </div>
                                    <div class="mycard__info">
    
                                        <div><span class="text-success fw-bolder"><?= number_format($resultat['prix'], 0, '.', ' ')  ?> FCFA<?= $resultat['periode'] ?></span></div>
                                        <div>Plus de détails</div>
                                    </div>
                                    <div class="mycard__time">
                                        <div>
                                            <i class="fa-solid fa-clock-rotate-left"></i>
                                            <?php echo time_ago($resultat['date_add']) ?>
                                        </div>
                                    </div>
                                </a>
    
                        <?php }
                        endwhile ;
                    } ?>
                    
                    <?php } elseif (isset($_POST['+c'])) {
                            $oui = "oui";
                            $statuts = "en cours";
                            $req = $loginData->prepare("SELECT * FROM annonces WHERE quartiers= ? AND prix >= ? AND valider = ? AND statuts = ? ORDER BY prix DESC");
                            $req->execute(array($quartier, $min, $oui, $statuts));
                           $reqcount = $req->rowCount();

                    if ($reqcount <= 0) {
                        $text ="Aucune annonce n'a été trouvée";
                    }else{
                        while ($resultat = $req->fetch(PDO::FETCH_ASSOC)) :

                            $today = $resultat["date_add"];
                            $limit_date = $resultat["date_expire"];
    
                            if ($today < $limit_date) {
                    ?>
                                <a href="plus_de_details.php?id=<?= $resultat['id_annonceurs'] ?>&annonce=<?= $resultat['id_annonces'] ?>" class=" mycard">
                                    <?php if ($resultat['options'] == "urgence") : ?>
                                        <p class="urgence">Urgence <i class="fa-solid fa-bell"></i></p>
                                    <?php endif; ?>
                                    <img src="<?= $resultat['img_cover'] ?>" class=" mycard__image">
                                    <div class="mycard__content">
                                        <p class="titre" style="text-transform:capitalize;"><?= $resultat['titres'] ?></p>
                                        <p class=" localisation"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                            <span class="vq">
                                                <?= $resultat['quartiers'] ?>,
                                                <?= $resultat['villes'] ?>
                                            </span>
                                        </p>
                                        <p class="descr"><?= $resultat['descriptions'] ?></p>
                                    </div>
                                    <div class="mycard__info">
    
                                        <div><span class="text-success fw-bolder"><?= number_format($resultat['prix'], 0, '.', ' ')  ?> FCFA<?= $resultat['periode'] ?></span></div>
                                        <div>Plus de détails</div>
                                    </div>
                                    <div class="mycard__time">
                                        <div>
                                            <i class="fa-solid fa-clock-rotate-left"></i>
                                            <?php echo time_ago($resultat['date_add']) ?>
                                        </div>
                                    </div>
                                </a>
    
                        <?php }
                        endwhile ;
                    } ?>
                    
                    <?php } elseif (isset($_POST['-c'])) {
                            $oui = "oui";
                            $statuts = "en cours";
                            $req = $loginData->prepare("SELECT * FROM annonces WHERE quartiers= ? AND prix >= ? AND valider = ? AND statuts = ? ORDER BY prix ASC");
                            $req->execute(array($quartier, $min, $oui, $statuts));
                           $reqcount = $req->rowCount();

                    if ($reqcount <= 0) {
                        $text ="Aucune annonce n'a été trouvée";
                    }else{
                        while ($resultat = $req->fetch(PDO::FETCH_ASSOC)) :

                            $today = $resultat["date_add"];
                            $limit_date = $resultat["date_expire"];
    
                            if ($today < $limit_date) {
                    ?>
                                <a href="plus_de_details.php?id=<?= $resultat['id_annonceurs'] ?>&annonce=<?= $resultat['id_annonces'] ?>" class=" mycard">
                                    <?php if ($resultat['options'] == "urgence") : ?>
                                        <p class="urgence">Urgence <i class="fa-solid fa-bell"></i></p>
                                    <?php endif; ?>
                                    <img src="<?= $resultat['img_cover'] ?>" class=" mycard__image">
                                    <div class="mycard__content">
                                        <p class="titre" style="text-transform:capitalize;"><?= $resultat['titres'] ?></p>
                                        <p class=" localisation"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                            <span class="vq">
                                                <?= $resultat['quartiers'] ?>,
                                                <?= $resultat['villes'] ?>
                                            </span>
                                        </p>
                                        <p class="descr"><?= $resultat['descriptions'] ?></p>
                                    </div>
                                    <div class="mycard__info">
    
                                        <div><span class="text-success fw-bolder"><?= number_format($resultat['prix'], 0, '.', ' ')  ?> FCFA<?= $resultat['periode'] ?></span></div>
                                        <div>Plus de détails</div>
                                    </div>
                                    <div class="mycard__time">
                                        <div>
                                            <i class="fa-solid fa-clock-rotate-left"></i>
                                            <?php echo time_ago($resultat['date_add']) ?>
                                        </div>
                                    </div>
                                </a>
    
                        <?php }
                        endwhile ;
                    } ?>
                    
                    <?php } elseif (isset($_POST['pj'])) {
                            $oui = "oui";
                            $statuts = "en cours";
                            $periode = "Jour";
                            $req = $loginData->prepare("SELECT * FROM annonces WHERE periode = ? AND quartiers= ? AND prix >= ? AND valider = ? AND statuts = ?");
                            $req->execute(array($periode, $quartier, $min, $oui, $statuts));
                           $reqcount = $req->rowCount();

                    if ($reqcount <= 0) {
                        $text ="Aucune annonce n'a été trouvée";
                    }else{
                        while ($resultat = $req->fetch(PDO::FETCH_ASSOC)) :

                            $today = $resultat["date_add"];
                            $limit_date = $resultat["date_expire"];
    
                            if ($today < $limit_date) {
                    ?>
                                <a href="plus_de_details.php?id=<?= $resultat['id_annonceurs'] ?>&annonce=<?= $resultat['id_annonces'] ?>" class=" mycard">
                                    <?php if ($resultat['options'] == "urgence") : ?>
                                        <p class="urgence">Urgence <i class="fa-solid fa-bell"></i></p>
                                    <?php endif; ?>
                                    <img src="<?= $resultat['img_cover'] ?>" class=" mycard__image">
                                    <div class="mycard__content">
                                        <p class="titre" style="text-transform:capitalize;"><?= $resultat['titres'] ?></p>
                                        <p class=" localisation"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                            <span class="vq">
                                                <?= $resultat['quartiers'] ?>,
                                                <?= $resultat['villes'] ?>
                                            </span>
                                        </p>
                                        <p class="descr"><?= $resultat['descriptions'] ?></p>
                                    </div>
                                    <div class="mycard__info">
    
                                        <div><span class="text-success fw-bolder"><?= number_format($resultat['prix'], 0, '.', ' ')  ?> FCFA<?= $resultat['periode'] ?></span></div>
                                        <div>Plus de détails</div>
                                    </div>
                                    <div class="mycard__time">
                                        <div>
                                            <i class="fa-solid fa-clock-rotate-left"></i>
                                            <?php echo time_ago($resultat['date_add']) ?>
                                        </div>
                                    </div>
                                </a>
    
                        <?php }
                        endwhile ;
                    } ?>
                    
                    <?php } elseif (isset($_POST['ps'])) {
                            $oui = "oui";
                            $statuts = "en cours";
                            $periode = "Semaine";
                            $req = $loginData->prepare("SELECT * FROM annonces WHERE periode = ? AND quartiers= ? AND prix >= ? AND valider = ? AND statuts = ?");
                            $req->execute(array($periode, $quartier, $min, $oui, $statuts));
                           $reqcount = $req->rowCount();

                    if ($reqcount <= 0) {
                        $text ="Aucune annonce n'a été trouvée";
                    }else{
                        while ($resultat = $req->fetch(PDO::FETCH_ASSOC)) :

                            $today = $resultat["date_add"];
                            $limit_date = $resultat["date_expire"];
    
                            if ($today < $limit_date) {
                    ?>
                                <a href="plus_de_details.php?id=<?= $resultat['id_annonceurs'] ?>&annonce=<?= $resultat['id_annonces'] ?>" class=" mycard">
                                    <?php if ($resultat['options'] == "urgence") : ?>
                                        <p class="urgence">Urgence <i class="fa-solid fa-bell"></i></p>
                                    <?php endif; ?>
                                    <img src="<?= $resultat['img_cover'] ?>" class=" mycard__image">
                                    <div class="mycard__content">
                                        <p class="titre" style="text-transform:capitalize;"><?= $resultat['titres'] ?></p>
                                        <p class=" localisation"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                            <span class="vq">
                                                <?= $resultat['quartiers'] ?>,
                                                <?= $resultat['villes'] ?>
                                            </span>
                                        </p>
                                        <p class="descr"><?= $resultat['descriptions'] ?></p>
                                    </div>
                                    <div class="mycard__info">
    
                                        <div><span class="text-success fw-bolder"><?= number_format($resultat['prix'], 0, '.', ' ')  ?> FCFA<?= $resultat['periode'] ?></span></div>
                                        <div>Plus de détails</div>
                                    </div>
                                    <div class="mycard__time">
                                        <div>
                                            <i class="fa-solid fa-clock-rotate-left"></i>
                                            <?php echo time_ago($resultat['date_add']) ?>
                                        </div>
                                    </div>
                                </a>
    
                        <?php }
                        endwhile ;
                    } ?>
                    
                    <?php } elseif (isset($_POST['pm'])) {
                            $oui = "oui";
                            $statuts = "en cours";
                            $periode = "Mois";
                            $req = $loginData->prepare("SELECT * FROM annonces WHERE periode = ? AND quartiers= ? AND prix >= ? AND valider = ? AND statuts = ?");
                            $req->execute(array($periode, $quartier, $min, $oui, $statuts));
                           $reqcount = $req->rowCount();

                    if ($reqcount <= 0) {
                        $text ="Aucune annonce n'a été trouvée";
                    }else{
                        while ($resultat = $req->fetch(PDO::FETCH_ASSOC)) :

                            $today = $resultat["date_add"];
                            $limit_date = $resultat["date_expire"];
    
                            if ($today < $limit_date) {
                    ?>
                                <a href="plus_de_details.php?id=<?= $resultat['id_annonceurs'] ?>&annonce=<?= $resultat['id_annonces'] ?>" class=" mycard">
                                    <?php if ($resultat['options'] == "urgence") : ?>
                                        <p class="urgence">Urgence <i class="fa-solid fa-bell"></i></p>
                                    <?php endif; ?>
                                    <img src="<?= $resultat['img_cover'] ?>" class=" mycard__image">
                                    <div class="mycard__content">
                                        <p class="titre" style="text-transform:capitalize;"><?= $resultat['titres'] ?></p>
                                        <p class=" localisation"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                            <span class="vq">
                                                <?= $resultat['quartiers'] ?>,
                                                <?= $resultat['villes'] ?>
                                            </span>
                                        </p>
                                        <p class="descr"><?= $resultat['descriptions'] ?></p>
                                    </div>
                                    <div class="mycard__info">
    
                                        <div><span class="text-success fw-bolder"><?= number_format($resultat['prix'], 0, '.', ' ')  ?> FCFA<?= $resultat['periode'] ?></span></div>
                                        <div>Plus de détails</div>
                                    </div>
                                    <div class="mycard__time">
                                        <div>
                                            <i class="fa-solid fa-clock-rotate-left"></i>
                                            <?php echo time_ago($resultat['date_add']) ?>
                                        </div>
                                    </div>
                                </a>
    
                        <?php }
                        endwhile ;
                    } ?>
                    
                    <?php } else {
                            $statuts = "en cours";
                            $req = $loginData->prepare("SELECT * FROM annonces WHERE quartiers= ? AND prix >= ? AND valider = ? AND statuts = ? ");
                            $req->execute(array($quartier, $min, $oui, $statuts));
                           $reqcount = $req->rowCount();

                    if ($reqcount <= 0) {
                        $text ="Aucune annonce n'a été trouvée";
                    }else{
                        while ($resultat = $req->fetch(PDO::FETCH_ASSOC)) :

                            $today = $resultat["date_add"];
                            $limit_date = $resultat["date_expire"];
    
                            if ($today < $limit_date) {
                    ?>
                                <a href="plus_de_details.php?id=<?= $resultat['id_annonceurs'] ?>&annonce=<?= $resultat['id_annonces'] ?>" class=" mycard">
                                    <?php if ($resultat['options'] == "urgence") : ?>
                                        <p class="urgence">Urgence <i class="fa-solid fa-bell"></i></p>
                                    <?php endif; ?>
                                    <img src="<?= $resultat['img_cover'] ?>" class=" mycard__image">
                                    <div class="mycard__content">
                                        <p class="titre" style="text-transform:capitalize;"><?= $resultat['titres'] ?></p>
                                        <p class=" localisation"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                            <span class="vq">
                                                <?= $resultat['quartiers'] ?>,
                                                <?= $resultat['villes'] ?>
                                            </span>
                                        </p>
                                        <p class="descr"><?= $resultat['descriptions'] ?></p>
                                    </div>
                                    <div class="mycard__info">
    
                                        <div><span class="text-success fw-bolder"><?= number_format($resultat['prix'], 0, '.', ' ')  ?> FCFA<?= $resultat['periode'] ?></span></div>
                                        <div>Plus de détails</div>
                                    </div>
                                    <div class="mycard__time">
                                        <div>
                                            <i class="fa-solid fa-clock-rotate-left"></i>
                                            <?php echo time_ago($resultat['date_add']) ?>
                                        </div>
                                    </div>
                                </a>
    
                        <?php }
                        endwhile ;
                    } ?>
                    
                    <?php }
                    }
                    //////quartier et max/////////////////////////////
                    elseif (!empty($quartier) && empty($types) && empty($min) && !empty($max) && empty($ville)) {
                        if (isset($_POST['+r'])) {
                            $oui = "oui";
                            $statuts = "en cours";
                            $req = $loginData->prepare("SELECT * FROM annonces WHERE quartiers= ? AND prix <= ? AND valider = ? AND statuts = ? ORDER BY id_annonces DESC");
                            $req->execute(array($quartier, $max, $oui, $statuts));
                           $reqcount = $req->rowCount();

                    if ($reqcount <= 0) {
                        $text ="Aucune annonce n'a été trouvée";
                    }else{
                        while ($resultat = $req->fetch(PDO::FETCH_ASSOC)) :

                            $today = $resultat["date_add"];
                            $limit_date = $resultat["date_expire"];
    
                            if ($today < $limit_date) {
                    ?>
                                <a href="plus_de_details.php?id=<?= $resultat['id_annonceurs'] ?>&annonce=<?= $resultat['id_annonces'] ?>" class=" mycard">
                                    <?php if ($resultat['options'] == "urgence") : ?>
                                        <p class="urgence">Urgence <i class="fa-solid fa-bell"></i></p>
                                    <?php endif; ?>
                                    <img src="<?= $resultat['img_cover'] ?>" class=" mycard__image">
                                    <div class="mycard__content">
                                        <p class="titre" style="text-transform:capitalize;"><?= $resultat['titres'] ?></p>
                                        <p class=" localisation"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                            <span class="vq">
                                                <?= $resultat['quartiers'] ?>,
                                                <?= $resultat['villes'] ?>
                                            </span>
                                        </p>
                                        <p class="descr"><?= $resultat['descriptions'] ?></p>
                                    </div>
                                    <div class="mycard__info">
    
                                        <div><span class="text-success fw-bolder"><?= number_format($resultat['prix'], 0, '.', ' ')  ?> FCFA<?= $resultat['periode'] ?></span></div>
                                        <div>Plus de détails</div>
                                    </div>
                                    <div class="mycard__time">
                                        <div>
                                            <i class="fa-solid fa-clock-rotate-left"></i>
                                            <?php echo time_ago($resultat['date_add']) ?>
                                        </div>
                                    </div>
                                </a>
    
                        <?php }
                        endwhile ;
                    } ?>
                    
                    <?php }elseif (isset($_POST['-r'])) {
                            $oui = "oui";
                            $statuts = "en cours";
                            $req = $loginData->prepare("SELECT * FROM annonces WHERE quartiers = ? AND prix <= ? AND valider = ? AND statuts = ? ORDER BY id_annonces ASC");
                            $req->execute(array($quartier, $max, $oui, $statuts));
                           $reqcount = $req->rowCount();

                    if ($reqcount <= 0) {
                        $text ="Aucune annonce n'a été trouvée";
                    }else{
                        while ($resultat = $req->fetch(PDO::FETCH_ASSOC)) :

                            $today = $resultat["date_add"];
                            $limit_date = $resultat["date_expire"];
    
                            if ($today < $limit_date) {
                    ?>
                                <a href="plus_de_details.php?id=<?= $resultat['id_annonceurs'] ?>&annonce=<?= $resultat['id_annonces'] ?>" class=" mycard">
                                    <?php if ($resultat['options'] == "urgence") : ?>
                                        <p class="urgence">Urgence <i class="fa-solid fa-bell"></i></p>
                                    <?php endif; ?>
                                    <img src="<?= $resultat['img_cover'] ?>" class=" mycard__image">
                                    <div class="mycard__content">
                                        <p class="titre" style="text-transform:capitalize;"><?= $resultat['titres'] ?></p>
                                        <p class=" localisation"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                            <span class="vq">
                                                <?= $resultat['quartiers'] ?>,
                                                <?= $resultat['villes'] ?>
                                            </span>
                                        </p>
                                        <p class="descr"><?= $resultat['descriptions'] ?></p>
                                    </div>
                                    <div class="mycard__info">
    
                                        <div><span class="text-success fw-bolder"><?= number_format($resultat['prix'], 0, '.', ' ')  ?> FCFA<?= $resultat['periode'] ?></span></div>
                                        <div>Plus de détails</div>
                                    </div>
                                    <div class="mycard__time">
                                        <div>
                                            <i class="fa-solid fa-clock-rotate-left"></i>
                                            <?php echo time_ago($resultat['date_add']) ?>
                                        </div>
                                    </div>
                                </a>
    
                        <?php }
                        endwhile ;
                    } ?>
                    
                    <?php } elseif (isset($_POST['+c'])) {
                            $oui = "oui";
                            $statuts = "en cours";
                            $req = $loginData->prepare("SELECT * FROM annonces WHERE quartiers= ? AND prix <= ? AND valider = ? AND statuts = ? ORDER BY prix DESC");
                            $req->execute(array($quartier, $max, $oui, $statuts));
                           $reqcount = $req->rowCount();

                    if ($reqcount <= 0) {
                        $text ="Aucune annonce n'a été trouvée";
                    }else{
                        while ($resultat = $req->fetch(PDO::FETCH_ASSOC)) :

                            $today = $resultat["date_add"];
                            $limit_date = $resultat["date_expire"];
    
                            if ($today < $limit_date) {
                    ?>
                                <a href="plus_de_details.php?id=<?= $resultat['id_annonceurs'] ?>&annonce=<?= $resultat['id_annonces'] ?>" class=" mycard">
                                    <?php if ($resultat['options'] == "urgence") : ?>
                                        <p class="urgence">Urgence <i class="fa-solid fa-bell"></i></p>
                                    <?php endif; ?>
                                    <img src="<?= $resultat['img_cover'] ?>" class=" mycard__image">
                                    <div class="mycard__content">
                                        <p class="titre" style="text-transform:capitalize;"><?= $resultat['titres'] ?></p>
                                        <p class=" localisation"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                            <span class="vq">
                                                <?= $resultat['quartiers'] ?>,
                                                <?= $resultat['villes'] ?>
                                            </span>
                                        </p>
                                        <p class="descr"><?= $resultat['descriptions'] ?></p>
                                    </div>
                                    <div class="mycard__info">
    
                                        <div><span class="text-success fw-bolder"><?= number_format($resultat['prix'], 0, '.', ' ')  ?> FCFA<?= $resultat['periode'] ?></span></div>
                                        <div>Plus de détails</div>
                                    </div>
                                    <div class="mycard__time">
                                        <div>
                                            <i class="fa-solid fa-clock-rotate-left"></i>
                                            <?php echo time_ago($resultat['date_add']) ?>
                                        </div>
                                    </div>
                                </a>
    
                        <?php }
                        endwhile ;
                    } ?>
                    
                    <?php } elseif (isset($_POST['-c'])) {
                            $oui = "oui";
                            $statuts = "en cours";
                            $req = $loginData->prepare("SELECT * FROM annonces WHERE quartiers= ? AND prix <= ? AND valider = ? AND statuts = ? ORDER BY prix ASC");
                            $req->execute(array($quartier, $max, $oui, $statuts));
                           $reqcount = $req->rowCount();

                    if ($reqcount <= 0) {
                        $text ="Aucune annonce n'a été trouvée";
                    }else{
                        while ($resultat = $req->fetch(PDO::FETCH_ASSOC)) :

                            $today = $resultat["date_add"];
                            $limit_date = $resultat["date_expire"];
    
                            if ($today < $limit_date) {
                    ?>
                                <a href="plus_de_details.php?id=<?= $resultat['id_annonceurs'] ?>&annonce=<?= $resultat['id_annonces'] ?>" class=" mycard">
                                    <?php if ($resultat['options'] == "urgence") : ?>
                                        <p class="urgence">Urgence <i class="fa-solid fa-bell"></i></p>
                                    <?php endif; ?>
                                    <img src="<?= $resultat['img_cover'] ?>" class=" mycard__image">
                                    <div class="mycard__content">
                                        <p class="titre" style="text-transform:capitalize;"><?= $resultat['titres'] ?></p>
                                        <p class=" localisation"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                            <span class="vq">
                                                <?= $resultat['quartiers'] ?>,
                                                <?= $resultat['villes'] ?>
                                            </span>
                                        </p>
                                        <p class="descr"><?= $resultat['descriptions'] ?></p>
                                    </div>
                                    <div class="mycard__info">
    
                                        <div><span class="text-success fw-bolder"><?= number_format($resultat['prix'], 0, '.', ' ')  ?> FCFA<?= $resultat['periode'] ?></span></div>
                                        <div>Plus de détails</div>
                                    </div>
                                    <div class="mycard__time">
                                        <div>
                                            <i class="fa-solid fa-clock-rotate-left"></i>
                                            <?php echo time_ago($resultat['date_add']) ?>
                                        </div>
                                    </div>
                                </a>
    
                        <?php }
                        endwhile ;
                    } ?>
                    
                    <?php } elseif (isset($_POST['pj'])) {
                            $oui = "oui";
                            $statuts = "en cours";
                            $periode = "Jour";
                            $req = $loginData->prepare("SELECT * FROM annonces WHERE periode = ? AND quartiers= ? AND prix <= ? AND valider = ? AND statuts = ?");
                            $req->execute(array($periode, $quartier, $max, $oui, $statuts));
                           $reqcount = $req->rowCount();

                    if ($reqcount <= 0) {
                        $text ="Aucune annonce n'a été trouvée";
                    }else{
                        while ($resultat = $req->fetch(PDO::FETCH_ASSOC)) :

                            $today = $resultat["date_add"];
                            $limit_date = $resultat["date_expire"];
    
                            if ($today < $limit_date) {
                    ?>
                                <a href="plus_de_details.php?id=<?= $resultat['id_annonceurs'] ?>&annonce=<?= $resultat['id_annonces'] ?>" class=" mycard">
                                    <?php if ($resultat['options'] == "urgence") : ?>
                                        <p class="urgence">Urgence <i class="fa-solid fa-bell"></i></p>
                                    <?php endif; ?>
                                    <img src="<?= $resultat['img_cover'] ?>" class=" mycard__image">
                                    <div class="mycard__content">
                                        <p class="titre" style="text-transform:capitalize;"><?= $resultat['titres'] ?></p>
                                        <p class=" localisation"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                            <span class="vq">
                                                <?= $resultat['quartiers'] ?>,
                                                <?= $resultat['villes'] ?>
                                            </span>
                                        </p>
                                        <p class="descr"><?= $resultat['descriptions'] ?></p>
                                    </div>
                                    <div class="mycard__info">
    
                                        <div><span class="text-success fw-bolder"><?= number_format($resultat['prix'], 0, '.', ' ')  ?> FCFA<?= $resultat['periode'] ?></span></div>
                                        <div>Plus de détails</div>
                                    </div>
                                    <div class="mycard__time">
                                        <div>
                                            <i class="fa-solid fa-clock-rotate-left"></i>
                                            <?php echo time_ago($resultat['date_add']) ?>
                                        </div>
                                    </div>
                                </a>
    
                        <?php }
                        endwhile ;
                    } ?>
                    
                    <?php } elseif (isset($_POST['ps'])) {
                            $oui = "oui";
                            $statuts = "en cours";
                            $periode = "Semaine";
                            $req = $loginData->prepare("SELECT * FROM annonces WHERE periode = ? AND quartiers= ? AND prix <= ? AND valider = ? AND statuts = ?");
                            $req->execute(array($periode, $quartier, $max, $oui, $statuts));
                           $reqcount = $req->rowCount();

                    if ($reqcount <= 0) {
                        $text ="Aucune annonce n'a été trouvée";
                    }else{
                        while ($resultat = $req->fetch(PDO::FETCH_ASSOC)) :

                            $today = $resultat["date_add"];
                            $limit_date = $resultat["date_expire"];
    
                            if ($today < $limit_date) {
                    ?>
                                <a href="plus_de_details.php?id=<?= $resultat['id_annonceurs'] ?>&annonce=<?= $resultat['id_annonces'] ?>" class=" mycard">
                                    <?php if ($resultat['options'] == "urgence") : ?>
                                        <p class="urgence">Urgence <i class="fa-solid fa-bell"></i></p>
                                    <?php endif; ?>
                                    <img src="<?= $resultat['img_cover'] ?>" class=" mycard__image">
                                    <div class="mycard__content">
                                        <p class="titre" style="text-transform:capitalize;"><?= $resultat['titres'] ?></p>
                                        <p class=" localisation"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                            <span class="vq">
                                                <?= $resultat['quartiers'] ?>,
                                                <?= $resultat['villes'] ?>
                                            </span>
                                        </p>
                                        <p class="descr"><?= $resultat['descriptions'] ?></p>
                                    </div>
                                    <div class="mycard__info">
    
                                        <div><span class="text-success fw-bolder"><?= number_format($resultat['prix'], 0, '.', ' ')  ?> FCFA<?= $resultat['periode'] ?></span></div>
                                        <div>Plus de détails</div>
                                    </div>
                                    <div class="mycard__time">
                                        <div>
                                            <i class="fa-solid fa-clock-rotate-left"></i>
                                            <?php echo time_ago($resultat['date_add']) ?>
                                        </div>
                                    </div>
                                </a>
    
                        <?php }
                        endwhile ;
                    } ?>
                    
                    <?php } elseif (isset($_POST['pm'])) {
                            $oui = "oui";
                            $statuts = "en cours";
                            $periode = "Mois";
                            $req = $loginData->prepare("SELECT * FROM annonces WHERE periode = ? AND quartiers= ? AND prix <= ? AND valider = ? AND statuts = ?");
                            $req->execute(array($periode, $quartier, $max, $oui, $statuts));
                           $reqcount = $req->rowCount();

                    if ($reqcount <= 0) {
                        $text ="Aucune annonce n'a été trouvée";
                    }else{
                        while ($resultat = $req->fetch(PDO::FETCH_ASSOC)) :

                            $today = $resultat["date_add"];
                            $limit_date = $resultat["date_expire"];
    
                            if ($today < $limit_date) {
                    ?>
                                <a href="plus_de_details.php?id=<?= $resultat['id_annonceurs'] ?>&annonce=<?= $resultat['id_annonces'] ?>" class=" mycard">
                                    <?php if ($resultat['options'] == "urgence") : ?>
                                        <p class="urgence">Urgence <i class="fa-solid fa-bell"></i></p>
                                    <?php endif; ?>
                                    <img src="<?= $resultat['img_cover'] ?>" class=" mycard__image">
                                    <div class="mycard__content">
                                        <p class="titre" style="text-transform:capitalize;"><?= $resultat['titres'] ?></p>
                                        <p class=" localisation"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                            <span class="vq">
                                                <?= $resultat['quartiers'] ?>,
                                                <?= $resultat['villes'] ?>
                                            </span>
                                        </p>
                                        <p class="descr"><?= $resultat['descriptions'] ?></p>
                                    </div>
                                    <div class="mycard__info">
    
                                        <div><span class="text-success fw-bolder"><?= number_format($resultat['prix'], 0, '.', ' ')  ?> FCFA<?= $resultat['periode'] ?></span></div>
                                        <div>Plus de détails</div>
                                    </div>
                                    <div class="mycard__time">
                                        <div>
                                            <i class="fa-solid fa-clock-rotate-left"></i>
                                            <?php echo time_ago($resultat['date_add']) ?>
                                        </div>
                                    </div>
                                </a>
    
                        <?php }
                        endwhile ;
                    } ?>
                    
                    <?php } else {
                            $statuts = "en cours";
                            $req = $loginData->prepare("SELECT * FROM annonces WHERE quartiers= ? AND prix <= ? AND valider = ? AND statuts = ? ");
                            $req->execute(array($quartier, $max, $oui, $statuts));
                           $reqcount = $req->rowCount();

                    if ($reqcount <= 0) {
                        $text ="Aucune annonce n'a été trouvée";
                    }else{
                        while ($resultat = $req->fetch(PDO::FETCH_ASSOC)) :

                            $today = $resultat["date_add"];
                            $limit_date = $resultat["date_expire"];
    
                            if ($today < $limit_date) {
                    ?>
                                <a href="plus_de_details.php?id=<?= $resultat['id_annonceurs'] ?>&annonce=<?= $resultat['id_annonces'] ?>" class=" mycard">
                                    <?php if ($resultat['options'] == "urgence") : ?>
                                        <p class="urgence">Urgence <i class="fa-solid fa-bell"></i></p>
                                    <?php endif; ?>
                                    <img src="<?= $resultat['img_cover'] ?>" class=" mycard__image">
                                    <div class="mycard__content">
                                        <p class="titre" style="text-transform:capitalize;"><?= $resultat['titres'] ?></p>
                                        <p class=" localisation"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                            <span class="vq">
                                                <?= $resultat['quartiers'] ?>,
                                                <?= $resultat['villes'] ?>
                                            </span>
                                        </p>
                                        <p class="descr"><?= $resultat['descriptions'] ?></p>
                                    </div>
                                    <div class="mycard__info">
    
                                        <div><span class="text-success fw-bolder"><?= number_format($resultat['prix'], 0, '.', ' ')  ?> FCFA<?= $resultat['periode'] ?></span></div>
                                        <div>Plus de détails</div>
                                    </div>
                                    <div class="mycard__time">
                                        <div>
                                            <i class="fa-solid fa-clock-rotate-left"></i>
                                            <?php echo time_ago($resultat['date_add']) ?>
                                        </div>
                                    </div>
                                </a>
    
                        <?php }
                        endwhile ;
                    } ?>
                    
                    <?php }
                    }
                    //////min et max/////////////////////////////
                    elseif (empty($quartier) && empty($types) && !empty($min) && !empty($max) && empty($ville)) {
                        if (isset($_POST['+r'])) {
                            $oui = "oui";
                            $statuts = "en cours";
                            $req = $loginData->prepare("SELECT * FROM annonces WHERE prix BETWEEN $min AND $max AND valider = ? AND statuts = ? ORDER BY id_annonces DESC");
                            $req->execute(array($oui, $statuts));
                           $reqcount = $req->rowCount();

                    if ($reqcount <= 0) {
                        $text ="Aucune annonce n'a été trouvée";
                    }else{
                        while ($resultat = $req->fetch(PDO::FETCH_ASSOC)) :

                            $today = $resultat["date_add"];
                            $limit_date = $resultat["date_expire"];
    
                            if ($today < $limit_date) {
                    ?>
                                <a href="plus_de_details.php?id=<?= $resultat['id_annonceurs'] ?>&annonce=<?= $resultat['id_annonces'] ?>" class=" mycard">
                                    <?php if ($resultat['options'] == "urgence") : ?>
                                        <p class="urgence">Urgence <i class="fa-solid fa-bell"></i></p>
                                    <?php endif; ?>
                                    <img src="<?= $resultat['img_cover'] ?>" class=" mycard__image">
                                    <div class="mycard__content">
                                        <p class="titre" style="text-transform:capitalize;"><?= $resultat['titres'] ?></p>
                                        <p class=" localisation"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                            <span class="vq">
                                                <?= $resultat['quartiers'] ?>,
                                                <?= $resultat['villes'] ?>
                                            </span>
                                        </p>
                                        <p class="descr"><?= $resultat['descriptions'] ?></p>
                                    </div>
                                    <div class="mycard__info">
    
                                        <div><span class="text-success fw-bolder"><?= number_format($resultat['prix'], 0, '.', ' ')  ?> FCFA<?= $resultat['periode'] ?></span></div>
                                        <div>Plus de détails</div>
                                    </div>
                                    <div class="mycard__time">
                                        <div>
                                            <i class="fa-solid fa-clock-rotate-left"></i>
                                            <?php echo time_ago($resultat['date_add']) ?>
                                        </div>
                                    </div>
                                </a>
    
                        <?php }
                        endwhile ;
                    } ?>
                    
                    <?php } elseif (isset($_POST['-r'])) {
                            $oui = "oui";
                            $statuts = "en cours";
                            $req = $loginData->prepare("SELECT * FROM annonces WHERE prix BETWEEN $min AND $max AND valider = ? AND statuts = ? ORDER BY id_annonces ASC");
                            $req->execute(array($oui, $statuts));
                           $reqcount = $req->rowCount();

                    if ($reqcount <= 0) {
                        $text ="Aucune annonce n'a été trouvée";
                    }else{
                        while ($resultat = $req->fetch(PDO::FETCH_ASSOC)) :

                            $today = $resultat["date_add"];
                            $limit_date = $resultat["date_expire"];
    
                            if ($today < $limit_date) {
                    ?>
                                <a href="plus_de_details.php?id=<?= $resultat['id_annonceurs'] ?>&annonce=<?= $resultat['id_annonces'] ?>" class=" mycard">
                                    <?php if ($resultat['options'] == "urgence") : ?>
                                        <p class="urgence">Urgence <i class="fa-solid fa-bell"></i></p>
                                    <?php endif; ?>
                                    <img src="<?= $resultat['img_cover'] ?>" class=" mycard__image">
                                    <div class="mycard__content">
                                        <p class="titre" style="text-transform:capitalize;"><?= $resultat['titres'] ?></p>
                                        <p class=" localisation"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                            <span class="vq">
                                                <?= $resultat['quartiers'] ?>,
                                                <?= $resultat['villes'] ?>
                                            </span>
                                        </p>
                                        <p class="descr"><?= $resultat['descriptions'] ?></p>
                                    </div>
                                    <div class="mycard__info">
    
                                        <div><span class="text-success fw-bolder"><?= number_format($resultat['prix'], 0, '.', ' ')  ?> FCFA<?= $resultat['periode'] ?></span></div>
                                        <div>Plus de détails</div>
                                    </div>
                                    <div class="mycard__time">
                                        <div>
                                            <i class="fa-solid fa-clock-rotate-left"></i>
                                            <?php echo time_ago($resultat['date_add']) ?>
                                        </div>
                                    </div>
                                </a>
    
                        <?php }
                        endwhile ;
                    } ?>
                    
                    <?php } elseif (isset($_POST['+c'])) {
                            $oui = "oui";
                            $statuts = "en cours";
                            $req = $loginData->prepare("SELECT * FROM annonces WHERE prix BETWEEN $min AND $max AND valider = ? AND statuts = ? ORDER BY prix DESC");
                            $req->execute(array($oui, $statuts));
                           $reqcount = $req->rowCount();

                    if ($reqcount <= 0) {
                        $text ="Aucune annonce n'a été trouvée";
                    }else{
                        while ($resultat = $req->fetch(PDO::FETCH_ASSOC)) :

                            $today = $resultat["date_add"];
                            $limit_date = $resultat["date_expire"];
    
                            if ($today < $limit_date) {
                    ?>
                                <a href="plus_de_details.php?id=<?= $resultat['id_annonceurs'] ?>&annonce=<?= $resultat['id_annonces'] ?>" class=" mycard">
                                    <?php if ($resultat['options'] == "urgence") : ?>
                                        <p class="urgence">Urgence <i class="fa-solid fa-bell"></i></p>
                                    <?php endif; ?>
                                    <img src="<?= $resultat['img_cover'] ?>" class=" mycard__image">
                                    <div class="mycard__content">
                                        <p class="titre" style="text-transform:capitalize;"><?= $resultat['titres'] ?></p>
                                        <p class=" localisation"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                            <span class="vq">
                                                <?= $resultat['quartiers'] ?>,
                                                <?= $resultat['villes'] ?>
                                            </span>
                                        </p>
                                        <p class="descr"><?= $resultat['descriptions'] ?></p>
                                    </div>
                                    <div class="mycard__info">
    
                                        <div><span class="text-success fw-bolder"><?= number_format($resultat['prix'], 0, '.', ' ')  ?> FCFA<?= $resultat['periode'] ?></span></div>
                                        <div>Plus de détails</div>
                                    </div>
                                    <div class="mycard__time">
                                        <div>
                                            <i class="fa-solid fa-clock-rotate-left"></i>
                                            <?php echo time_ago($resultat['date_add']) ?>
                                        </div>
                                    </div>
                                </a>
    
                        <?php }
                        endwhile ;
                    } ?>
                    
                    <?php } elseif (isset($_POST['-c'])) {
                            $oui = "oui";
                            $statuts = "en cours";
                            $req = $loginData->prepare("SELECT * FROM annonces WHERE prix BETWEEN $min AND $max AND valider = ? AND statuts = ? ORDER BY prix ASC");
                            $req->execute(array($oui, $statuts));
                           $reqcount = $req->rowCount();

                    if ($reqcount <= 0) {
                        $text ="Aucune annonce n'a été trouvée";
                    }else{
                        while ($resultat = $req->fetch(PDO::FETCH_ASSOC)) :

                            $today = $resultat["date_add"];
                            $limit_date = $resultat["date_expire"];
    
                            if ($today < $limit_date) {
                    ?>
                                <a href="plus_de_details.php?id=<?= $resultat['id_annonceurs'] ?>&annonce=<?= $resultat['id_annonces'] ?>" class=" mycard">
                                    <?php if ($resultat['options'] == "urgence") : ?>
                                        <p class="urgence">Urgence <i class="fa-solid fa-bell"></i></p>
                                    <?php endif; ?>
                                    <img src="<?= $resultat['img_cover'] ?>" class=" mycard__image">
                                    <div class="mycard__content">
                                        <p class="titre" style="text-transform:capitalize;"><?= $resultat['titres'] ?></p>
                                        <p class=" localisation"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                            <span class="vq">
                                                <?= $resultat['quartiers'] ?>,
                                                <?= $resultat['villes'] ?>
                                            </span>
                                        </p>
                                        <p class="descr"><?= $resultat['descriptions'] ?></p>
                                    </div>
                                    <div class="mycard__info">
    
                                        <div><span class="text-success fw-bolder"><?= number_format($resultat['prix'], 0, '.', ' ')  ?> FCFA<?= $resultat['periode'] ?></span></div>
                                        <div>Plus de détails</div>
                                    </div>
                                    <div class="mycard__time">
                                        <div>
                                            <i class="fa-solid fa-clock-rotate-left"></i>
                                            <?php echo time_ago($resultat['date_add']) ?>
                                        </div>
                                    </div>
                                </a>
    
                        <?php }
                        endwhile ;
                    } ?>
                    
                    <?php } elseif (isset($_POST['pj'])) {
                            $oui = "oui";
                            $statuts = "en cours";
                            $periode = "Jour";
                            $req = $loginData->prepare("SELECT * FROM annonces WHERE  prix BETWEEN $min AND $max AND periode = ? AND valider = ? AND statuts = ?");
                            $req->execute(array($periode, $oui, $statuts));
                           $reqcount = $req->rowCount();

                    if ($reqcount <= 0) {
                        $text ="Aucune annonce n'a été trouvée";
                    }else{
                        while ($resultat = $req->fetch(PDO::FETCH_ASSOC)) :

                            $today = $resultat["date_add"];
                            $limit_date = $resultat["date_expire"];
    
                            if ($today < $limit_date) {
                    ?>
                                <a href="plus_de_details.php?id=<?= $resultat['id_annonceurs'] ?>&annonce=<?= $resultat['id_annonces'] ?>" class=" mycard">
                                    <?php if ($resultat['options'] == "urgence") : ?>
                                        <p class="urgence">Urgence <i class="fa-solid fa-bell"></i></p>
                                    <?php endif; ?>
                                    <img src="<?= $resultat['img_cover'] ?>" class=" mycard__image">
                                    <div class="mycard__content">
                                        <p class="titre" style="text-transform:capitalize;"><?= $resultat['titres'] ?></p>
                                        <p class=" localisation"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                            <span class="vq">
                                                <?= $resultat['quartiers'] ?>,
                                                <?= $resultat['villes'] ?>
                                            </span>
                                        </p>
                                        <p class="descr"><?= $resultat['descriptions'] ?></p>
                                    </div>
                                    <div class="mycard__info">
    
                                        <div><span class="text-success fw-bolder"><?= number_format($resultat['prix'], 0, '.', ' ')  ?> FCFA<?= $resultat['periode'] ?></span></div>
                                        <div>Plus de détails</div>
                                    </div>
                                    <div class="mycard__time">
                                        <div>
                                            <i class="fa-solid fa-clock-rotate-left"></i>
                                            <?php echo time_ago($resultat['date_add']) ?>
                                        </div>
                                    </div>
                                </a>
    
                        <?php }
                        endwhile ;
                    } ?>
                    
                    <?php } elseif (isset($_POST['ps'])) {
                            $oui = "oui";
                            $statuts = "en cours";
                            $periode = "Semaine";
                            $req = $loginData->prepare("SELECT * FROM annonces WHERE prix BETWEEN $min AND $max AND periode = ? AND valider = ? AND statuts = ?");
                            $req->execute(array($periode, $oui, $statuts));
                           $reqcount = $req->rowCount();

                    if ($reqcount <= 0) {
                        $text ="Aucune annonce n'a été trouvée";
                    }else{
                        while ($resultat = $req->fetch(PDO::FETCH_ASSOC)) :

                            $today = $resultat["date_add"];
                            $limit_date = $resultat["date_expire"];
    
                            if ($today < $limit_date) {
                    ?>
                                <a href="plus_de_details.php?id=<?= $resultat['id_annonceurs'] ?>&annonce=<?= $resultat['id_annonces'] ?>" class=" mycard">
                                    <?php if ($resultat['options'] == "urgence") : ?>
                                        <p class="urgence">Urgence <i class="fa-solid fa-bell"></i></p>
                                    <?php endif; ?>
                                    <img src="<?= $resultat['img_cover'] ?>" class=" mycard__image">
                                    <div class="mycard__content">
                                        <p class="titre" style="text-transform:capitalize;"><?= $resultat['titres'] ?></p>
                                        <p class=" localisation"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                            <span class="vq">
                                                <?= $resultat['quartiers'] ?>,
                                                <?= $resultat['villes'] ?>
                                            </span>
                                        </p>
                                        <p class="descr"><?= $resultat['descriptions'] ?></p>
                                    </div>
                                    <div class="mycard__info">
    
                                        <div><span class="text-success fw-bolder"><?= number_format($resultat['prix'], 0, '.', ' ')  ?> FCFA<?= $resultat['periode'] ?></span></div>
                                        <div>Plus de détails</div>
                                    </div>
                                    <div class="mycard__time">
                                        <div>
                                            <i class="fa-solid fa-clock-rotate-left"></i>
                                            <?php echo time_ago($resultat['date_add']) ?>
                                        </div>
                                    </div>
                                </a>
    
                        <?php }
                        endwhile ;
                    } ?>
                    
                    <?php }elseif (isset($_POST['pm'])) {
                            $oui = "oui";
                            $statuts = "en cours";
                            $periode = "Mois";
                            $req = $loginData->prepare("SELECT * FROM annonces WHERE prix BETWEEN $min AND $max AND periode = ? AND valider = ? AND statuts = ?");
                            $req->execute(array($periode, $oui, $statuts));
                           $reqcount = $req->rowCount();

                    if ($reqcount <= 0) {
                        $text ="Aucune annonce n'a été trouvée";
                    }else{
                        while ($resultat = $req->fetch(PDO::FETCH_ASSOC)) :

                            $today = $resultat["date_add"];
                            $limit_date = $resultat["date_expire"];
    
                            if ($today < $limit_date) {
                    ?>
                                <a href="plus_de_details.php?id=<?= $resultat['id_annonceurs'] ?>&annonce=<?= $resultat['id_annonces'] ?>" class=" mycard">
                                    <?php if ($resultat['options'] == "urgence") : ?>
                                        <p class="urgence">Urgence <i class="fa-solid fa-bell"></i></p>
                                    <?php endif; ?>
                                    <img src="<?= $resultat['img_cover'] ?>" class=" mycard__image">
                                    <div class="mycard__content">
                                        <p class="titre" style="text-transform:capitalize;"><?= $resultat['titres'] ?></p>
                                        <p class=" localisation"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                            <span class="vq">
                                                <?= $resultat['quartiers'] ?>,
                                                <?= $resultat['villes'] ?>
                                            </span>
                                        </p>
                                        <p class="descr"><?= $resultat['descriptions'] ?></p>
                                    </div>
                                    <div class="mycard__info">
    
                                        <div><span class="text-success fw-bolder"><?= number_format($resultat['prix'], 0, '.', ' ')  ?> FCFA<?= $resultat['periode'] ?></span></div>
                                        <div>Plus de détails</div>
                                    </div>
                                    <div class="mycard__time">
                                        <div>
                                            <i class="fa-solid fa-clock-rotate-left"></i>
                                            <?php echo time_ago($resultat['date_add']) ?>
                                        </div>
                                    </div>
                                </a>
    
                        <?php }
                        endwhile ;
                    } ?>
                    
                    <?php } else {
                            $statuts = "en cours";
                            $req = $loginData->prepare("SELECT * FROM annonces WHERE prix BETWEEN $min AND $max AND valider = ? AND statuts = ? ");
                            $req->execute(array($oui, $statuts));
                           $reqcount = $req->rowCount();

                    if ($reqcount <= 0) {
                        $text ="Aucune annonce n'a été trouvée";
                    }else{
                        while ($resultat = $req->fetch(PDO::FETCH_ASSOC)) :

                            $today = $resultat["date_add"];
                            $limit_date = $resultat["date_expire"];
    
                            if ($today < $limit_date) {
                    ?>
                                <a href="plus_de_details.php?id=<?= $resultat['id_annonceurs'] ?>&annonce=<?= $resultat['id_annonces'] ?>" class=" mycard">
                                    <?php if ($resultat['options'] == "urgence") : ?>
                                        <p class="urgence">Urgence <i class="fa-solid fa-bell"></i></p>
                                    <?php endif; ?>
                                    <img src="<?= $resultat['img_cover'] ?>" class=" mycard__image">
                                    <div class="mycard__content">
                                        <p class="titre" style="text-transform:capitalize;"><?= $resultat['titres'] ?></p>
                                        <p class=" localisation"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                            <span class="vq">
                                                <?= $resultat['quartiers'] ?>,
                                                <?= $resultat['villes'] ?>
                                            </span>
                                        </p>
                                        <p class="descr"><?= $resultat['descriptions'] ?></p>
                                    </div>
                                    <div class="mycard__info">
    
                                        <div><span class="text-success fw-bolder"><?= number_format($resultat['prix'], 0, '.', ' ')  ?> FCFA<?= $resultat['periode'] ?></span></div>
                                        <div>Plus de détails</div>
                                    </div>
                                    <div class="mycard__time">
                                        <div>
                                            <i class="fa-solid fa-clock-rotate-left"></i>
                                            <?php echo time_ago($resultat['date_add']) ?>
                                        </div>
                                    </div>
                                </a>
    
                        <?php }
                        endwhile ;
                    } ?>
                    
                    <?php }
                    }
                    ///////////////////////////all/////////////////!empty($min) and !empty($max) and !empty($types) and !empty($ville) and !empty($quartier)/////////////
                    elseif (!empty($min) && !empty($max) && !empty($types) && !empty($ville) && !empty($quartier)) {
                        if (isset($_POST['+r'])) {
                            $oui = "oui";
                            $statuts = "en cours";
                            $req = $loginData->prepare("SELECT * FROM annonces WHERE types= ? AND villes= ? AND quartiers= ? AND valider = ? AND statuts = ? AND prix BETWEEN $min
                            AND $max ORDER BY id_annonces DESC");
                            $req->execute(array($types, $ville, $quartier, $oui, $statuts));
                           $reqcount = $req->rowCount();

                    if ($reqcount <= 0) {
                        $text ="Aucune annonce n'a été trouvée";
                    }else{
                        while ($resultat = $req->fetch(PDO::FETCH_ASSOC)) :

                            $today = $resultat["date_add"];
                            $limit_date = $resultat["date_expire"];
    
                            if ($today < $limit_date) {
                    ?>
                                <a href="plus_de_details.php?id=<?= $resultat['id_annonceurs'] ?>&annonce=<?= $resultat['id_annonces'] ?>" class=" mycard">
                                    <?php if ($resultat['options'] == "urgence") : ?>
                                        <p class="urgence">Urgence <i class="fa-solid fa-bell"></i></p>
                                    <?php endif; ?>
                                    <img src="<?= $resultat['img_cover'] ?>" class=" mycard__image">
                                    <div class="mycard__content">
                                        <p class="titre" style="text-transform:capitalize;"><?= $resultat['titres'] ?></p>
                                        <p class=" localisation"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                            <span class="vq">
                                                <?= $resultat['quartiers'] ?>,
                                                <?= $resultat['villes'] ?>
                                            </span>
                                        </p>
                                        <p class="descr"><?= $resultat['descriptions'] ?></p>
                                    </div>
                                    <div class="mycard__info">
    
                                        <div><span class="text-success fw-bolder"><?= number_format($resultat['prix'], 0, '.', ' ')  ?> FCFA<?= $resultat['periode'] ?></span></div>
                                        <div>Plus de détails</div>
                                    </div>
                                    <div class="mycard__time">
                                        <div>
                                            <i class="fa-solid fa-clock-rotate-left"></i>
                                            <?php echo time_ago($resultat['date_add']) ?>
                                        </div>
                                    </div>
                                </a>
    
                        <?php }
                        endwhile ;
                    } ?>
                    
                    <?php }elseif (isset($_POST['-r'])) {
                            $oui = "oui";
                            $statuts = "en cours";
                            $req = $loginData->prepare("SELECT * FROM annonces WHERE types= ? AND villes= ? AND quartiers= ? AND valider = ? AND statuts = ? AND prix BETWEEN $min
                                AND $max ORDER BY id_annonces ASC");
                            $req->execute(array($types, $ville, $quartier, $oui, $statuts));
                           $reqcount = $req->rowCount();

                    if ($reqcount <= 0) {
                        $text ="Aucune annonce n'a été trouvée";
                    }else{
                        while ($resultat = $req->fetch(PDO::FETCH_ASSOC)) :

                            $today = $resultat["date_add"];
                            $limit_date = $resultat["date_expire"];
    
                            if ($today < $limit_date) {
                    ?>
                                <a href="plus_de_details.php?id=<?= $resultat['id_annonceurs'] ?>&annonce=<?= $resultat['id_annonces'] ?>" class=" mycard">
                                    <?php if ($resultat['options'] == "urgence") : ?>
                                        <p class="urgence">Urgence <i class="fa-solid fa-bell"></i></p>
                                    <?php endif; ?>
                                    <img src="<?= $resultat['img_cover'] ?>" class=" mycard__image">
                                    <div class="mycard__content">
                                        <p class="titre" style="text-transform:capitalize;"><?= $resultat['titres'] ?></p>
                                        <p class=" localisation"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                            <span class="vq">
                                                <?= $resultat['quartiers'] ?>,
                                                <?= $resultat['villes'] ?>
                                            </span>
                                        </p>
                                        <p class="descr"><?= $resultat['descriptions'] ?></p>
                                    </div>
                                    <div class="mycard__info">
    
                                        <div><span class="text-success fw-bolder"><?= number_format($resultat['prix'], 0, '.', ' ')  ?> FCFA<?= $resultat['periode'] ?></span></div>
                                        <div>Plus de détails</div>
                                    </div>
                                    <div class="mycard__time">
                                        <div>
                                            <i class="fa-solid fa-clock-rotate-left"></i>
                                            <?php echo time_ago($resultat['date_add']) ?>
                                        </div>
                                    </div>
                                </a>
    
                        <?php }
                        endwhile ;
                    } ?>
                    
                    <?php } elseif (isset($_POST['+c'])) {
                            $oui = "oui";
                            $statuts = "en cours";
                            $req = $loginData->prepare("SELECT * FROM annonces WHERE types= ? AND villes= ? AND quartiers= ? AND valider = ? AND statuts = ? AND prix BETWEEN $min
                                AND
                                $max ORDER BY prix DESC");
                            $req->execute(array($types, $ville, $quartier, $oui, $statuts));
                           $reqcount = $req->rowCount();

                    if ($reqcount <= 0) {
                        $text ="Aucune annonce n'a été trouvée";
                    }else{
                        while ($resultat = $req->fetch(PDO::FETCH_ASSOC)) :

                            $today = $resultat["date_add"];
                            $limit_date = $resultat["date_expire"];
    
                            if ($today < $limit_date) {
                    ?>
                                <a href="plus_de_details.php?id=<?= $resultat['id_annonceurs'] ?>&annonce=<?= $resultat['id_annonces'] ?>" class=" mycard">
                                    <?php if ($resultat['options'] == "urgence") : ?>
                                        <p class="urgence">Urgence <i class="fa-solid fa-bell"></i></p>
                                    <?php endif; ?>
                                    <img src="<?= $resultat['img_cover'] ?>" class=" mycard__image">
                                    <div class="mycard__content">
                                        <p class="titre" style="text-transform:capitalize;"><?= $resultat['titres'] ?></p>
                                        <p class=" localisation"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                            <span class="vq">
                                                <?= $resultat['quartiers'] ?>,
                                                <?= $resultat['villes'] ?>
                                            </span>
                                        </p>
                                        <p class="descr"><?= $resultat['descriptions'] ?></p>
                                    </div>
                                    <div class="mycard__info">
    
                                        <div><span class="text-success fw-bolder"><?= number_format($resultat['prix'], 0, '.', ' ')  ?> FCFA<?= $resultat['periode'] ?></span></div>
                                        <div>Plus de détails</div>
                                    </div>
                                    <div class="mycard__time">
                                        <div>
                                            <i class="fa-solid fa-clock-rotate-left"></i>
                                            <?php echo time_ago($resultat['date_add']) ?>
                                        </div>
                                    </div>
                                </a>
    
                        <?php }
                        endwhile ;
                    } ?>
                    
                    <?php } elseif (isset($_POST['-c'])) {
                            $oui = "oui";
                            $statuts = "en cours";
                            $req = $loginData->prepare("SELECT * FROM annonces WHERE types= ? AND villes= ? AND quartiers= ? AND valider = ? AND statuts = ? AND prix BETWEEN $min
                                AND
                                $max ORDER BY prix ASC");
                            $req->execute(array($types, $ville, $quartier, $oui, $statuts));
                           $reqcount = $req->rowCount();

                    if ($reqcount <= 0) {
                        $text ="Aucune annonce n'a été trouvée";
                    }else{
                        while ($resultat = $req->fetch(PDO::FETCH_ASSOC)) :

                            $today = $resultat["date_add"];
                            $limit_date = $resultat["date_expire"];
    
                            if ($today < $limit_date) {
                    ?>
                                <a href="plus_de_details.php?id=<?= $resultat['id_annonceurs'] ?>&annonce=<?= $resultat['id_annonces'] ?>" class=" mycard">
                                    <?php if ($resultat['options'] == "urgence") : ?>
                                        <p class="urgence">Urgence <i class="fa-solid fa-bell"></i></p>
                                    <?php endif; ?>
                                    <img src="<?= $resultat['img_cover'] ?>" class=" mycard__image">
                                    <div class="mycard__content">
                                        <p class="titre" style="text-transform:capitalize;"><?= $resultat['titres'] ?></p>
                                        <p class=" localisation"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                            <span class="vq">
                                                <?= $resultat['quartiers'] ?>,
                                                <?= $resultat['villes'] ?>
                                            </span>
                                        </p>
                                        <p class="descr"><?= $resultat['descriptions'] ?></p>
                                    </div>
                                    <div class="mycard__info">
    
                                        <div><span class="text-success fw-bolder"><?= number_format($resultat['prix'], 0, '.', ' ')  ?> FCFA<?= $resultat['periode'] ?></span></div>
                                        <div>Plus de détails</div>
                                    </div>
                                    <div class="mycard__time">
                                        <div>
                                            <i class="fa-solid fa-clock-rotate-left"></i>
                                            <?php echo time_ago($resultat['date_add']) ?>
                                        </div>
                                    </div>
                                </a>
    
                        <?php }
                        endwhile ;
                    } ?>
                    
                    <?php } elseif (isset($_POST['pj'])) {
                            $oui = "oui";
                            $statuts = "en cours";
                            $periode = "Jour";
                            $req = $loginData->prepare("SELECT * FROM annonces WHERE periode = ? AND types= ? AND villes= ? AND quartiers= ? AND valider = ? AND statuts = ? AND prix BETWEEN $min
                                AND $max");
                            $req->execute(array($periode, $types, $ville, $quartier, $oui, $statuts));
                           $reqcount = $req->rowCount();

                    if ($reqcount <= 0) {
                        $text ="Aucune annonce n'a été trouvée";
                    }else{
                        while ($resultat = $req->fetch(PDO::FETCH_ASSOC)) :

                            $today = $resultat["date_add"];
                            $limit_date = $resultat["date_expire"];
    
                            if ($today < $limit_date) {
                    ?>
                                <a href="plus_de_details.php?id=<?= $resultat['id_annonceurs'] ?>&annonce=<?= $resultat['id_annonces'] ?>" class=" mycard">
                                    <?php if ($resultat['options'] == "urgence") : ?>
                                        <p class="urgence">Urgence <i class="fa-solid fa-bell"></i></p>
                                    <?php endif; ?>
                                    <img src="<?= $resultat['img_cover'] ?>" class=" mycard__image">
                                    <div class="mycard__content">
                                        <p class="titre" style="text-transform:capitalize;"><?= $resultat['titres'] ?></p>
                                        <p class=" localisation"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                            <span class="vq">
                                                <?= $resultat['quartiers'] ?>,
                                                <?= $resultat['villes'] ?>
                                            </span>
                                        </p>
                                        <p class="descr"><?= $resultat['descriptions'] ?></p>
                                    </div>
                                    <div class="mycard__info">
    
                                        <div><span class="text-success fw-bolder"><?= number_format($resultat['prix'], 0, '.', ' ')  ?> FCFA<?= $resultat['periode'] ?></span></div>
                                        <div>Plus de détails</div>
                                    </div>
                                    <div class="mycard__time">
                                        <div>
                                            <i class="fa-solid fa-clock-rotate-left"></i>
                                            <?php echo time_ago($resultat['date_add']) ?>
                                        </div>
                                    </div>
                                </a>
    
                        <?php }
                        endwhile ;
                    } ?>
                    
                    <?php } elseif (isset($_POST['ps'])) {
                            $oui = "oui";
                            $statuts = "en cours";
                            $periode = "Semaine";
                            $req = $loginData->prepare("SELECT * FROM annonces WHERE periode = ? AND types= ? AND villes= ? AND quartiers= ? AND valider = ? AND statuts = ? AND prix BETWEEN $min
                                AND
                                $max");
                            $req->execute(array($periode, $types, $ville, $quartier, $oui, $statuts));
                           $reqcount = $req->rowCount();

                    if ($reqcount <= 0) {
                        $text ="Aucune annonce n'a été trouvée";
                    }else{
                        while ($resultat = $req->fetch(PDO::FETCH_ASSOC)) :

                            $today = $resultat["date_add"];
                            $limit_date = $resultat["date_expire"];
    
                            if ($today < $limit_date) {
                    ?>
                                <a href="plus_de_details.php?id=<?= $resultat['id_annonceurs'] ?>&annonce=<?= $resultat['id_annonces'] ?>" class=" mycard">
                                    <?php if ($resultat['options'] == "urgence") : ?>
                                        <p class="urgence">Urgence <i class="fa-solid fa-bell"></i></p>
                                    <?php endif; ?>
                                    <img src="<?= $resultat['img_cover'] ?>" class=" mycard__image">
                                    <div class="mycard__content">
                                        <p class="titre" style="text-transform:capitalize;"><?= $resultat['titres'] ?></p>
                                        <p class=" localisation"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                            <span class="vq">
                                                <?= $resultat['quartiers'] ?>,
                                                <?= $resultat['villes'] ?>
                                            </span>
                                        </p>
                                        <p class="descr"><?= $resultat['descriptions'] ?></p>
                                    </div>
                                    <div class="mycard__info">
    
                                        <div><span class="text-success fw-bolder"><?= number_format($resultat['prix'], 0, '.', ' ')  ?> FCFA<?= $resultat['periode'] ?></span></div>
                                        <div>Plus de détails</div>
                                    </div>
                                    <div class="mycard__time">
                                        <div>
                                            <i class="fa-solid fa-clock-rotate-left"></i>
                                            <?php echo time_ago($resultat['date_add']) ?>
                                        </div>
                                    </div>
                                </a>
    
                        <?php }
                        endwhile ;
                    } ?>
                    
                    <?php } elseif (isset($_POST['pm'])) {
                            $oui = "oui";
                            $statuts = "en cours";
                            $periode = "Mois";
                            $req = $loginData->prepare("SELECT * FROM annonces WHERE periode = ? AND types= ? AND villes= ? AND quartiers= ? AND valider = ? AND statuts = ? AND prix BETWEEN $min AND $max");
                            $req->execute(array($periode, $types, $ville, $quartier, $oui, $statuts));
                           $reqcount = $req->rowCount();

                    if ($reqcount <= 0) {
                        $text ="Aucune annonce n'a été trouvée";
                    }else{
                        while ($resultat = $req->fetch(PDO::FETCH_ASSOC)) :

                            $today = $resultat["date_add"];
                            $limit_date = $resultat["date_expire"];
    
                            if ($today < $limit_date) {
                    ?>
                                <a href="plus_de_details.php?id=<?= $resultat['id_annonceurs'] ?>&annonce=<?= $resultat['id_annonces'] ?>" class=" mycard">
                                    <?php if ($resultat['options'] == "urgence") : ?>
                                        <p class="urgence">Urgence <i class="fa-solid fa-bell"></i></p>
                                    <?php endif; ?>
                                    <img src="<?= $resultat['img_cover'] ?>" class=" mycard__image">
                                    <div class="mycard__content">
                                        <p class="titre" style="text-transform:capitalize;"><?= $resultat['titres'] ?></p>
                                        <p class=" localisation"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                            <span class="vq">
                                                <?= $resultat['quartiers'] ?>,
                                                <?= $resultat['villes'] ?>
                                            </span>
                                        </p>
                                        <p class="descr"><?= $resultat['descriptions'] ?></p>
                                    </div>
                                    <div class="mycard__info">
    
                                        <div><span class="text-success fw-bolder"><?= number_format($resultat['prix'], 0, '.', ' ')  ?> FCFA<?= $resultat['periode'] ?></span></div>
                                        <div>Plus de détails</div>
                                    </div>
                                    <div class="mycard__time">
                                        <div>
                                            <i class="fa-solid fa-clock-rotate-left"></i>
                                            <?php echo time_ago($resultat['date_add']) ?>
                                        </div>
                                    </div>
                                </a>
    
                        <?php }
                        endwhile ;
                    } ?>
                    
                    <?php } else {
                            $statuts = "en cours";
                            $req = $loginData->prepare("SELECT * FROM annonces WHERE types= ? AND villes= ? AND quartiers= ? AND valider = ? AND statuts = ? AND prix BETWEEN $min
                                AND
                                $max");
                            $req->execute(array($types, $ville, $quartier, $oui, $statuts));
                           $reqcount = $req->rowCount();

                    if ($reqcount <= 0) {
                        $text ="Aucune annonce n'a été trouvée";
                    }else{
                        while ($resultat = $req->fetch(PDO::FETCH_ASSOC)) :

                            $today = $resultat["date_add"];
                            $limit_date = $resultat["date_expire"];
    
                            if ($today < $limit_date) {
                    ?>
                                <a href="plus_de_details.php?id=<?= $resultat['id_annonceurs'] ?>&annonce=<?= $resultat['id_annonces'] ?>" class=" mycard">
                                    <?php if ($resultat['options'] == "urgence") : ?>
                                        <p class="urgence">Urgence <i class="fa-solid fa-bell"></i></p>
                                    <?php endif; ?>
                                    <img src="<?= $resultat['img_cover'] ?>" class=" mycard__image">
                                    <div class="mycard__content">
                                        <p class="titre" style="text-transform:capitalize;"><?= $resultat['titres'] ?></p>
                                        <p class=" localisation"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                            <span class="vq">
                                                <?= $resultat['quartiers'] ?>,
                                                <?= $resultat['villes'] ?>
                                            </span>
                                        </p>
                                        <p class="descr"><?= $resultat['descriptions'] ?></p>
                                    </div>
                                    <div class="mycard__info">
    
                                        <div><span class="text-success fw-bolder"><?= number_format($resultat['prix'], 0, '.', ' ')  ?> FCFA<?= $resultat['periode'] ?></span></div>
                                        <div>Plus de détails</div>
                                    </div>
                                    <div class="mycard__time">
                                        <div>
                                            <i class="fa-solid fa-clock-rotate-left"></i>
                                            <?php echo time_ago($resultat['date_add']) ?>
                                        </div>
                                    </div>
                                </a>
    
                        <?php }
                        endwhile ;
                    } ?>
                    
                    <?php }
                    } else {
                    }
                    ?>
                </div>
                <?php

                
                if(!empty($text)){
                    ?> 
                   <div class="delete_padding mx-auto" style="width: 98%;">
                <p class="alert alert-success text-center fw-bolder"><?= $text ?></p>
        
                </div>
                    
               <?php 
                   }
                ?>
            </div>
            <!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
        </div>
        <?php include "partials/progres/progres.php" ?>
        <div class="row delete_padding">
            <?php include "footer.php" ?>
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
    <!--javaSCript-->
    <script src="main.js"></script>
    <script src="//code.tidio.co/soutospimq4pk32r0mcxjjhtoqnjc0de.js" async></script>
</body>

</html>