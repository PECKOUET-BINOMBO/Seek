<?php
require 'conf/login_data.php';
require 'time_ago.php';

//Set default timezone to Africa/Dakar;
date_default_timezone_set('Africa/Dakar');

// // Get current date and time
$current_date_time = strtotime(date('d-m-Y H:i:s'));
$verify_query = $loginData->prepare("SELECT * FROM annonces WHERE date_expire <= '$current_date_time' ");
$verify_query->execute();
while ($annonce = $verify_query->fetch()) {
    $timestamp1 = strtotime($annonce["date_expire"]);
    $status = "expiré";
    $validation = "non";
    $update_annonce_query = $loginData->prepare("UPDATE annonces SET statuts = ?, valider = ? WHERE date_expire <= '$current_date_time'");
    $update_annonce_query->execute([$status, $validation]);
}
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--bootstrap
    <link rel="stylesheet" href="cdn/bootstrap5/css/bootstrap.css">
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
    <title>Achats</title>
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
    .navbar-light .navbar-nav .achat_link {
        color: #ec3e0e;
    }
    </style>

    <div class="container-fluid-xs container-xxl" style="padding-right: var(--bs-gutter-x, 0rem); overflow:hidden;">
        <div class="row">
            <?php include "header_contact.php" ?>
            <?php include "logo_menu.php" ?>
            <div class="row ajust">
                <!-- bg & filtre-->
                <section class="bg-filtre">
                    <h1>Nos offres d'achats</h1>
                </section>
            </div>
            <div class="row delete_padding">
                <h5 class=" mb-3 py-1 px-3" style="background-color: #0b2239; color:#fff;">Afficher par <div
                        class="dropdown">
                        <i onclick="myFunction()" class="fa-solid fa-sort dropbtn"></i>
                        <div id="myDropdown" class="dropdown-content">
                            <a href="">
                                <form method="POST"> <button style="border:none; background:transparent;" type="submit"
                                        name="+r">Plus récentes</button>
                                </form>
                            </a>
                            <a href="">
                                <form method="POST"> <button style="border:none; background:transparent;" type="submit"
                                        name="-r">Moins récentes</button>
                                </form>
                            </a>
                            <a href="">
                                <form method="POST"> <button style="border:none; background:transparent;" type="submit"
                                        name="+c">Plus chères</button>
                                </form>
                            </a>
                            <a href="">
                                <form method="POST"> <button style="border:none; background:transparent;" type="submit"
                                        name="-c">Moins chères</button>
                                </form>
                            </a>
                            <a href="">
                                <form method="POST"> <button style="border:none; background:transparent;" type="submit"
                                        name="pj">Par jour</button>
                                </form>
                            </a>
                            <a href="">
                                <form method="POST"> <button style="border:none; background:transparent;" type="submit"
                                        name="ps">Par semaine</button>
                                </form>
                            </a>
                            <a href="">
                                <form method="POST"> <button style="border:none; background:transparent;" type="submit"
                                        name="pm">Par mois</button>
                                </form>
                            </a>
                        </div>
                </h5>
            </div>

        </div>
        <div class="row">
            <div class="row">
                <!-- <div class="titre">
                            <h3 id="h3scroll">Annonces : Locations</h3>
                        </div> -->
                        <div class=" offre-ideale">
            <div class="mycards">

                <?php
                if (isset($_POST['+r'])) {
                    $oui = "oui";
                    $statuts = "en cours";
                    $req = $loginData->prepare("SELECT * FROM annonces WHERE categories = 'achat' AND  valider = ? AND statuts = ? ORDER BY id_annonces DESC");
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
                    elseif (isset($_POST['-r'])) {
                        $oui = "oui";
                        $statuts = "en cours";
                        $req = $loginData->prepare("SELECT * FROM annonces WHERE categories = 'achat' AND  valider = ? AND statuts = ? ORDER BY id_annonces ASC");
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
                    elseif (isset($_POST['+c'])) {
                        $oui = "oui";
                        $statuts = "en cours";
                        $req = $loginData->prepare("SELECT * FROM annonces WHERE categories = 'achat' AND  valider = ? AND statuts = ? ORDER BY prix DESC");
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
                    endwhile ?>
                    <?php }
                    elseif (isset($_POST['-c'])) {
                        $oui = "oui";
                        $statuts = "en cours";
                        $req = $loginData->prepare("SELECT * FROM annonces WHERE categories = 'achat' AND  valider = ? AND statuts = ? ORDER BY prix ASC");
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
                elseif(isset($_POST['pj'])){
                    $oui = "oui";
                    $statuts = "en cours";
                    $req = $loginData->prepare("SELECT * FROM annonces WHERE categories = 'achat' AND  periode = 'Jour' AND valider = 'oui' AND statuts = 'en cours'");
                    $req->execute();
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
                        endwhile ;
                    } ?>
                        <?php }
                elseif(isset($_POST['ps'])){
                    $oui = "oui";
                    $statuts = "en cours";
                    $req = $loginData->prepare("SELECT * FROM annonces WHERE categories = 'achat' AND periode = 'Semaine' AND valider = 'oui' AND statuts = 'en cours'");
                    $req->execute();
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
                elseif(isset($_POST['pm'])){
                                $oui = "oui";
                                $statuts = "en cours";
                                $req = $loginData->prepare("SELECT * FROM annonces WHERE categories = 'achat' AND periode = 'Mois' AND valider = 'oui' AND statuts = 'en cours'");
                                $req->execute();
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
                else {

                    $oui = "oui";
                    $statuts = "en cours";
                    $req = $loginData->prepare("SELECT * FROM annonces WHERE categories = 'achat' AND valider = ? AND statuts = ? ORDER BY id_annonces DESC");
                    $req->execute(array($oui, $statuts));
                    $reqcount = $req->rowCount();

                    if($reqcount == 0){
                        $vide = 'Aucune annonce n\'a encore été ajoutée revenez plus tard';
                    }  else{ 

                while ($resultat = $req->fetch(PDO::FETCH_ASSOC)) :

                ?>
                    <a href="plus_de_details.php?id=<?= $resultat['id_annonceurs'] ?>&annonce=<?= $resultat['id_annonces'] ?>" class=" mycard">
                        <?php if ($resultat['options'] == "urgence") : ?>
                            <p class=" urgence">Urgence <i class="fa-solid fa-bell"></i></p>
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

                            <div><span class="text-success fw-bolder"><?= number_format($resultat['prix'], 0, '.', ' ')  ?> FCFA</span> </span></div>
                            <div>Plus de détails</div>
                        </div>
                        <div class="mycard__time">
                            <div>
                                <i class="fa-solid fa-clock-rotate-left"></i>
                                <?php echo time_ago($resultat['date_add']) ?>
                            </div>
                        </div>
                    </a>
                <?php endwhile ?>
                <?php }} ?>

            </div>
        </div>
        
        <?php
         if(!empty($text)){
            ?> 
           <div class="delete_padding mx-auto" style="width: 98%;">
        <p class="alert alert-success text-center fw-bolder"><?= $text ?></p>

        </div>
            
       <?php 
           }
                                if(!empty($vide)){
                                 ?> 
                                 <div class="delete_padding mx-auto" style="width: 98%;">
                                    <p class="alert alert-success text-center fw-bolder ">Nous n'avons trouvé aucune annonce revenez plus tard</p>
                                 </div>
                                 
                            <?php 
                                }
                            ?>  
            </div>
        </div>
        <?php include "partials/progres/progres.php" ?>
        <div class="row delete_padding">
            <?php include "footer.php" ?>
        </div>
    </div>

    </div>


    </div>
    </div>
    <!--javascript bootstrap
    <script src="cdn/bootstrap5/js/bootstrap.js"></script>-->

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
</body>

</html>