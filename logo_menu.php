<?php @session_start();
require 'conf/login_data.php';
$id = isset($_SESSION['id']) ? $_SESSION['id'] : NULL;
$req = $loginData->prepare("SELECT * FROM annonces WHERE id_annonceurs = ? AND statuts = 'en cours' ");
$req3 = $loginData->prepare("SELECT * FROM annonces WHERE id_annonceurs = ? ");
$req->execute(array($id));
$req3->execute(array($id));
$count_annonce = $req3->rowCount();

$add = $loginData->prepare("SELECT * FROM annonceurs WHERE id_annonceurs = ?");
$add->execute(array($id));
$add_execute = $add->fetch();
////////////////////////////////////////////comptage////
$count1 = $loginData->prepare("SELECT * FROM annonces WHERE statuts = 'en cours' AND valider = 'oui' AND types = 'Appartement' AND categories = 'achat' ");
$count1->execute();
$count1 = $count1->rowCount();
////////////////////////////////////////////////
$count2 = $loginData->prepare("SELECT * FROM annonces WHERE statuts = 'en cours' AND valider = 'oui' AND types = 'Bureau' AND categories = 'achat' ");
$count2->execute();
$count2 = $count2->rowCount();
////////////////////////////////////////////////
$count3 = $loginData->prepare("SELECT * FROM annonces WHERE statuts = 'en cours' AND valider = 'oui' AND types = 'Chalet' AND categories = 'achat' ");
$count3->execute();
$count3 = $count3->rowCount();
////////////////////////////////////////////////
$count4 = $loginData->prepare("SELECT * FROM annonces WHERE statuts = 'en cours' AND valider = 'oui' AND types = 'Chambre' AND categories = 'achat' ");
$count4->execute();
$count4 = $count4->rowCount();
////////////////////////////////////////////////
$count5 = $loginData->prepare("SELECT * FROM annonces WHERE statuts = 'en cours' AND valider = 'oui' AND types = 'Duplex' AND categories = 'achat' ");
$count5->execute();
$count5 = $count5->rowCount();
////////////////////////////////////////////////
$count6 = $loginData->prepare("SELECT * FROM annonces WHERE statuts = 'en cours' AND valider = 'oui' AND types = 'Entrepôt' AND categories = 'achat' ");
$count6->execute();
$count6 = $count6->rowCount();
////////////////////////////////////////////////
$count7 = $loginData->prepare("SELECT * FROM annonces WHERE statuts = 'en cours' AND valider = 'oui' AND types = 'Ferme' AND categories = 'achat' ");
$count7->execute();
$count7 = $count7->rowCount();
////////////////////////////////////////////////
$count8 = $loginData->prepare("SELECT * FROM annonces WHERE statuts = 'en cours' AND valider = 'oui' AND types = 'Hôtel' AND categories = 'achat' ");
$count8->execute();
$count8 = $count8->rowCount();
////////////////////////////////////////////////
$count9 = $loginData->prepare("SELECT * FROM annonces WHERE statuts = 'en cours' AND valider = 'oui' AND types = 'Immeuble' AND categories = 'achat' ");
$count9->execute();
$count9 = $count9->rowCount();
////////////////////////////////////////////////
$count10 = $loginData->prepare("SELECT * FROM annonces WHERE statuts = 'en cours' AND valider = 'oui' AND types = 'Local' AND categories = 'achat' ");
$count10->execute();
$count10 = $count10->rowCount();
////////////////////////////////////////////////
$count11 = $loginData->prepare("SELECT * FROM annonces WHERE statuts = 'en cours' AND valider = 'oui' AND types = 'Loft' AND categories = 'achat' ");
$count11->execute();
$count11 = $count11->rowCount();
////////////////////////////////////////////////
$count12 = $loginData->prepare("SELECT * FROM annonces WHERE statuts = 'en cours' AND valider = 'oui' AND types = 'Studio' AND categories = 'achat' ");
$count12->execute();
$count12 = $count12->rowCount();
////////////////////////////////////////////////
$count13 = $loginData->prepare("SELECT * FROM annonces WHERE statuts = 'en cours' AND valider = 'oui' AND types = 'Terrain' AND categories = 'achat' ");
$count13->execute();
$count13 = $count13->rowCount();
////////////////////////////////////////////////
$count14 = $loginData->prepare("SELECT * FROM annonces WHERE statuts = 'en cours' AND valider = 'oui' AND types = 'Triplex' AND categories = 'achat' ");
$count14->execute();
$count14 = $count14->rowCount();
////////////////////////////////////////////////
$count15 = $loginData->prepare("SELECT * FROM annonces WHERE statuts = 'en cours' AND valider = 'oui' AND types = 'Villa' AND categories = 'achat' ");
$count15->execute();
$count15 = $count15->rowCount();
////////////////////////////////////////////////
$count16 = $loginData->prepare("SELECT * FROM annonces WHERE statuts = 'en cours' AND valider = 'oui' AND types = 'Maison' AND categories = 'achat' ");
$count16->execute();
$count16 = $count16->rowCount();
////////////////////////////location comptage
// $add = $loginData->prepare("SELECT * FROM annonceurs WHERE id_annonceurs = ?");
// $add->execute(array($id));
// $add_execute = $add->fetch();
////////////////////////////////
///////////////////////////////////
///////////////////////////////////////
////////////////////////////////////////////comptage////
$counts1 = $loginData->prepare("SELECT * FROM annonces WHERE statuts = 'en cours' AND valider = 'oui' AND types = 'Appartement' AND categories = 'location' ");
$counts1->execute();
$counts1 = $counts1->rowCount();
////////////////////////////////////////////////
$counts2 = $loginData->prepare("SELECT * FROM annonces WHERE statuts = 'en cours' AND valider = 'oui' AND types = 'Bureau' AND categories = 'location' ");
$counts2->execute();
$counts2 = $counts2->rowCount();
////////////////////////////////////////////////
$counts3 = $loginData->prepare("SELECT * FROM annonces WHERE statuts = 'en cours' AND valider = 'oui' AND types = 'Chalet' AND categories = 'location' ");
$counts3->execute();
$counts3 = $counts3->rowCount();
////////////////////////////////////////////////
$counts4 = $loginData->prepare("SELECT * FROM annonces WHERE statuts = 'en cours' AND valider = 'oui' AND types = 'Chambre' AND categories = 'location' ");
$counts4->execute();
$counts4 = $counts4->rowCount();
////////////////////////////////////////////////
$counts5 = $loginData->prepare("SELECT * FROM annonces WHERE statuts = 'en cours' AND valider = 'oui' AND types = 'Duplex' AND categories = 'location' ");
$counts5->execute();
$counts5 = $counts5->rowCount();
////////////////////////////////////////////////
$counts6 = $loginData->prepare("SELECT * FROM annonces WHERE statuts = 'en cours' AND valider = 'oui' AND types = 'Entrepôt' AND categories = 'location' ");
$counts6->execute();
$counts6 = $counts6->rowCount();
////////////////////////////////////////////////
$counts7 = $loginData->prepare("SELECT * FROM annonces WHERE statuts = 'en cours' AND valider = 'oui' AND types = 'Ferme' AND categories = 'location' ");
$counts7->execute();
$counts7 = $counts7->rowCount();
////////////////////////////////////////////////
$counts8 = $loginData->prepare("SELECT * FROM annonces WHERE statuts = 'en cours' AND valider = 'oui' AND types = 'Hôtel' AND categories = 'location' ");
$counts8->execute();
$counts8 = $counts8->rowCount();
////////////////////////////////////////////////
$counts9 = $loginData->prepare("SELECT * FROM annonces WHERE statuts = 'en cours' AND valider = 'oui' AND types = 'Immeuble' AND categories = 'location' ");
$counts9->execute();
$counts9 = $counts9->rowCount();
////////////////////////////////////////////////
$counts10 = $loginData->prepare("SELECT * FROM annonces WHERE statuts = 'en cours' AND valider = 'oui' AND types = 'Local' AND categories = 'location' ");
$counts10->execute();
$counts10 = $counts10->rowCount();
////////////////////////////////////////////////
$counts11 = $loginData->prepare("SELECT * FROM annonces WHERE statuts = 'en cours' AND valider = 'oui' AND types = 'Loft' AND categories = 'location' ");
$counts11->execute();
$counts11 = $counts11->rowCount();
////////////////////////////////////////////////
$counts12 = $loginData->prepare("SELECT * FROM annonces WHERE statuts = 'en cours' AND valider = 'oui' AND types = 'Studio' AND categories = 'location' ");
$counts12->execute();
$counts12 = $counts12->rowCount();
////////////////////////////////////////////////
$counts13 = $loginData->prepare("SELECT * FROM annonces WHERE statuts = 'en cours' AND valider = 'oui' AND types = 'Terrain' AND categories = 'location' ");
$counts13->execute();
$counts13 = $counts13->rowCount();
////////////////////////////////////////////////
$counts14 = $loginData->prepare("SELECT * FROM annonces WHERE statuts = 'en cours' AND valider = 'oui' AND types = 'Triplex' AND categories = 'location' ");
$counts14->execute();
$counts14 = $counts14->rowCount();
////////////////////////////////////////////////
$counts15 = $loginData->prepare("SELECT * FROM annonces WHERE statuts = 'en cours' AND valider = 'oui' AND types = 'Villa' AND categories = 'location' ");
$counts15->execute();
$counts15 = $counts15->rowCount();
////////////////////////////////////////////////
$counts16 = $loginData->prepare("SELECT * FROM annonces WHERE statuts = 'en cours' AND valider = 'oui' AND types = 'Maison' AND categories = 'location' ");
$counts16->execute();
$counts16 = $counts16->rowCount();

?>
<!-- logo-nav -->
<nav class="row navbar navbar-expand-lg navbar-light">
    <div class="container-fluid" style="padding-top: 20px;">
    <h3 style="visibility: hidden;">Logo</h3>
    <a class="navbar-brand" href="index.php" style="width: 135px; position: absolute;">
            <img src="img/SEEK4.png" alt="Logo" style="object-fit: cover; object-position: center; width: 100%;">
        </a>
        <button class="navbar-toggler" style="background: rgb(215 215 215 / 20%);" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
       
        <div class="collapse navbar-collapse box-kink" id="navbarNavAltMarkup">
            <div class="navbar-nav " style="font-size:14px;">

                <a class="nav-link accueil_link" aria-current="page" href="index.php">Accueil</a>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownAcheter" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Acheter
                    </a>
                    <ul class="dropdown-menu menu-li" aria-labelledby="navbarDropdownAcheter">
                        <li><a class="dropdown-item" href="ventelocation.php?titre=Appartements&types=Appartement&categorie=achat">Appartements (<?= $count1 ?>)</a></li>
                        <li><a class="dropdown-item" href="ventelocation.php?titre=Bureaux&types=Bureau&categorie=achat">Bureaux (<?= $count2 ?>)</a></li>
                        <!-- <li><a class="dropdown-item" href="ventelocation.php?titre=Chalets&types=Chalet&categorie=achat">Chalets (<?= $count3 ?>)</a></li> -->
                        <li><a class="dropdown-item" href="ventelocation.php?titre=Chambres&types=Chambre&categorie=achat">Chambres (<?= $count4 ?>)</a></li>
                        <li><a class="dropdown-item" href="ventelocation.php?titre=Duplex&types=Duplex&categorie=achat">Duplex (<?= $count5 ?>)</a></li>
                        <li><a class="dropdown-item" href="ventelocation.php?titre=Entrepôts&types=Entrepôt&categorie=achat">Entrepôts (<?= $count6 ?>)</a></li>
                        <li><a class="dropdown-item" href="ventelocation.php?titre=Fermes&types=Ferme&categorie=achat">Fermes (<?= $count7 ?>)</a></li>
                        <!-- <li><a class="dropdown-item" href="ventelocation.php?titre=Hôtels&types=Hôtel&categorie=achat">Hôtels (<?= $count8 ?>)</a></li> -->
                        <li><a class="dropdown-item" href="ventelocation.php?titre=Immeubles&types=Immeuble&categorie=achat">Immeubles (<?= $count9 ?>)</a></li>
                        <li><a class="dropdown-item" href="ventelocation.php?titre=Locaux&types=Local&categorie=achat">Locaux (<?= $count10 ?>)</a></li>
                        <li><a class="dropdown-item" href="ventelocation.php?titre=Maisons&types=Maison&categorie=achat">Maisons (<?= $count16 ?>)</a></li>
                        <!-- <li><a class="dropdown-item" href="ventelocation.php?titre=Lofts&types=Loft&categorie=achat">Lofts (<?= $count11 ?>)</a></li> -->
                        <li><a class="dropdown-item" href="ventelocation.php?titre=Studios&types=Studio&categorie=achat">Studios (<?= $count12 ?>)</a></li>
                        <li><a class="dropdown-item" href="ventelocation.php?titre=Terrains&types=Terrain&categorie=achat">Terrains (<?= $count13 ?>)</a></li>
                        <!-- <li><a class="dropdown-item" href="ventelocation.php?titre=Triplex&types=Triplex&categorie=achat">Triplex (<?= $count14 ?>)</a></li> -->
                        <li><a class="dropdown-item" href="ventelocation.php?titre=Villas&types=Villa&categorie=achat">Villas (<?= $count15 ?>)</a></li>
                        <!-- Ajouter d'autres sous-menus ici -->
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownLouer" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Louer
                    </a>
                    <ul class="dropdown-menu menu-li" aria-labelledby="navbarDropdownLouer">
                        <li><a class="dropdown-item" href="ventelocation.php?titre=Appartements&types=Appartement&categorie=location">Appartements (<?= $counts1 ?>)</a></li>
                        <li><a class="dropdown-item" href="ventelocation.php?titre=Bureaux&types=Bureau&categorie=location">Bureaux (<?= $counts2 ?>)</a></li>
                        <!-- <li><a class="dropdown-item" href="ventelocation.php?titre=Chalets&types=Chalet&categorie=location">Chalets (<?= $counts3 ?>)</a></li> -->
                        <li><a class="dropdown-item" href="ventelocation.php?titre=Chambres&types=Chambre&categorie=location">Chambres (<?= $counts4 ?>)</a></li>
                        <li><a class="dropdown-item" href="ventelocation.php?titre=Duplex&types=Duplex&categorie=location">Duplex (<?= $counts5 ?>)</a></li>
                        <li><a class="dropdown-item" href="ventelocation.php?titre=Entrepôts&types=Entrepôt&categorie=location">Entrepôts (<?= $counts6 ?>)</a></li>
                        <li><a class="dropdown-item" href="ventelocation.php?titre=Fermes&types=Ferme&categorie=location">Fermes (<?= $counts7 ?>)</a></li>
                        <!-- <li><a class="dropdown-item" href="ventelocation.php?titre=Hôtels&types=Hôtel&categorie=location">Hôtels (<?= $counts8 ?>)</a></li> -->
                        <li><a class="dropdown-item" href="ventelocation.php?titre=Immeubles&types=Immeuble&categorie=location">Immeubles (<?= $counts9 ?>)</a></li>
                        <li><a class="dropdown-item" href="ventelocation.php?titre=Locaux&types=Local&categorie=location">Locaux (<?= $counts10 ?>)</a></li>
                        <li><a class="dropdown-item" href="ventelocation.php?titre=Maisons&types=Maison&categorie=location">Maisons (<?= $counts16 ?>)</a></li>
                        <!-- <li><a class="dropdown-item" href="ventelocation.php?titre=Lofts&types=Loft&categorie=location">Lofts (<?= $counts11 ?>)</a></li> -->
                        <li><a class="dropdown-item" href="ventelocation.php?titre=Studios&types=Studio&categorie=location">Studios (<?= $counts12 ?>)</a></li>
                        <li><a class="dropdown-item" href="ventelocation.php?titre=Terrains&types=Terrain&categorie=location">Terrains (<?= $counts13 ?>)</a></li>
                        <!-- <li><a class="dropdown-item" href="ventelocation.php?titre=Triplex&types=Triplex&categorie=location">Triplex (<?= $counts14 ?>)</a></li> -->
                        <li><a class="dropdown-item" href="ventelocation.php?titre=Villas&types=Villa&categorie=location">Villas (<?= $counts15 ?>)</a></li>
                        <!-- Ajouter d'autres sous-menus ici -->
                    </ul>
                </li>

                <a class="nav-link colocation_link" href="colocation.php">Collocation</a>

                <?php if (isset($_SESSION['id'])) : ?>
                    <a class="nav-link mes_annonces_link" href="mes_annonces.php">Mes annonces <span>(<?= $count_annonce; ?>)</span></a>
                    <a class="nav-link ajouter_annonce_link" href="ajouter_annonce.php"> Ajouter une annonce</a>
                    <a class="nav-link mon_compte_link building-user" href="profil.php" style="text-transform: capitalize;">
                        <?= $_SESSION['pseudo']  ?> <i class="fa-solid fa-building-user"></i> </a>
                    <a class="nav-link" href="deconnexion.php"><i class="fa-solid fa-power-off"></i></a>
                <?php endif; ?>
                <?php if (!isset($_SESSION['id'])) : ?>
                    <a class=" nav-link connexion_link" href="connexion.php"><i class="fa-solid fa-user-plus"></i> Se connecter</a>
                    <a class="nav-link inscription_link" href="inscription.php"><i class="fa-solid fa-user"></i> S'inscrire</a>
                <?php endif; ?>
            </div>
        </div>
    </div>

</nav>