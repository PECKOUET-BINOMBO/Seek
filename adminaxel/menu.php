<?php @session_start();
require '../conf/login_data.php';

$annonceurs = $loginData->prepare("SELECT * FROM annonceurs");
$annonceurs->execute();
$count_annonceurs = $annonceurs->rowCount();

$annonces = $loginData->prepare("SELECT * FROM annonces WHERE statuts != 'expiré' AND valider != '...'");
$annonces->execute();
$count_annonces = $annonces->rowCount(); ?>
<!-- logo-nav -->
<nav class="row navbar navbar-expand-lg navbar-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php" style="width: 135px; position: absolute;">
            <img src="img/SEEK4.png" alt="Logo" style="object-fit: cover; object-position: center; width: 100%;">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse box-kink" id="navbarNavAltMarkup">
            <div class="navbar-nav ">

                <?php if (
                    isset($_SESSION['id_admin'])
                ) : ?>
                    <a class="nav-link dash_link" aria-current="page" href="index.php">Tableau de bord</a>
                    <a class="nav-link annonceurs1_link" aria-current="page" href="annonceurs.php">Annonceurs <span>
                            (<?= $count_annonceurs ?>)</span></a>
                    <a class="nav-link annonces1_link" href="annonces.php">Annonces <span>
                            (<?= $count_annonces ?>)</span> </a>
                    <span class="nav-link mon_compte_link building-user " href="#" style="text-transform: capitalize;">
                        <?= $_SESSION['user']  ?> <i class="fa-solid fa-building-user"></i> </span>

                    <a class="nav-link" href="deconnexion.php"><i class="fa-solid fa-power-off"></i></a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>