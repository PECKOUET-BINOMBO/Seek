<?php
@session_start();
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
} ?>

<div class="row">
    <section class=" offre">
        <div class="titre mb-3">
            <h3 id="h3scroll">Trouvez l'offre idéale <div class="dropdown">
                    <i onclick="myFunction()" class="fa-solid fa-sort dropbtn"></i>
                    <div id="myDropdown" class="dropdown-content">
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
            </h3>
        </div>

        <div class=" offre-ideale">
            <?php include "pub.php" ?>

            <div class="mycards">

                <?php
                if (isset($_POST['+r'])) {
                    $oui = "oui";
                    $statuts = "en cours";
                    $req = $loginData->prepare("SELECT * FROM annonces WHERE valider = ? AND statuts = ? ORDER BY id_annonces DESC");
                    $req->execute(array($oui, $statuts));

                    $reqcount = $req->rowCount();

                    if ($reqcount <= 0) {
                        $text = "Aucune annonce n'a été trouvée";
                    } else {
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
                        endwhile;
                    } ?>

                    <?php } elseif (isset($_POST['-r'])) {
                    $oui = "oui";
                    $statuts = "en cours";
                    $req = $loginData->prepare("SELECT * FROM annonces WHERE valider = ? AND statuts = ? ORDER BY id_annonces ASC");
                    $req->execute(array($oui, $statuts));

                    $reqcount = $req->rowCount();

                    if ($reqcount <= 0) {
                        $text = "Aucune annonce n'a été trouvée";
                    } else {
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
                        endwhile;
                    } ?>
                    <?php } elseif (isset($_POST['+c'])) {
                    $oui = "oui";
                    $statuts = "en cours";
                    $req = $loginData->prepare("SELECT * FROM annonces WHERE valider = ? AND statuts = ? ORDER BY prix DESC");
                    $req->execute(array($oui, $statuts));
                    $reqcount = $req->rowCount();

                    if ($reqcount <= 0) {
                        $text = "Aucune annonce n'a été trouvée";
                    } else {
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
                        endwhile;
                    } ?>
                    <?php } elseif (isset($_POST['-c'])) {
                    $oui = "oui";
                    $statuts = "en cours";
                    $req = $loginData->prepare("SELECT * FROM annonces WHERE valider = ? AND statuts = ? ORDER BY prix ASC");
                    $req->execute(array($oui, $statuts));

                    $reqcount = $req->rowCount();

                    if ($reqcount <= 0) {
                        $text = "Aucune annonce n'a été trouvée";
                    } else {
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
                        endwhile;
                    } ?>
                    <?php } elseif (isset($_POST['pj'])) {
                    $oui = "oui";
                    $statuts = "en cours";
                    $req = $loginData->prepare("SELECT * FROM annonces WHERE periode = 'Jour' AND valider = 'oui' AND statuts = 'en cours'");
                    $req->execute();
                    $reqcount = $req->rowCount();

                    if ($reqcount <= 0) {
                        $text = "Aucune annonce n'a été trouvée";
                    } else {
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
                        endwhile;
                    } ?>
                    <?php } elseif (isset($_POST['ps'])) {
                    $oui = "oui";
                    $statuts = "en cours";
                    $req = $loginData->prepare("SELECT * FROM annonces WHERE periode = 'Semaine' AND valider = 'oui' AND statuts = 'en cours'");
                    $req->execute();
                    $reqcount = $req->rowCount();

                    if ($reqcount <= 0) {
                        $text = "Aucune annonce n'a été trouvée";
                    } else {
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
                        endwhile;
                    } ?>
                    <?php } elseif (isset($_POST['pm'])) {
                    $oui = "oui";
                    $statuts = "en cours";
                    $req = $loginData->prepare("SELECT * FROM annonces WHERE periode = 'Mois' AND valider = 'oui' AND statuts = 'en cours'");
                    $req->execute();
                    $reqcount = $req->rowCount();

                    if ($reqcount <= 0) {
                        $text = "Aucune annonce n'a été trouvée";
                    } else {
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
                        endwhile;
                    } ?>
                    <?php } else {

                    $oui = "oui";
                    $statuts = "en cours";
                    $req = $loginData->prepare("SELECT * FROM annonces WHERE valider = ? AND statuts = ? ORDER BY id_annonces DESC");
                    $req->execute(array($oui, $statuts));
                    $reqcount = $req->rowCount();

                    if ($reqcount == 0) {
                        $vide = 'Aucune annonce n\'a encore été ajoutée revenez plus tard';
                    } else {

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
                <?php }
                } ?>

            </div>

        </div>

        <?php
        if (!empty($text)) {
        ?>
            <div class="delete_padding mx-auto" style="width: 98%;">
                <p class="alert alert-success text-center fw-bolder"><?= $text ?></p>

            </div>

        <?php
        }
        if (!empty($vide)) {
        ?>
            <div class="delete_padding mx-auto" style="width: 98%;">
                <p class="alert alert-success text-center fw-bolder "> Soyez le premier à poster une annonce ou revenez plus tard.</p>
            </div>

        <?php
        }
        ?>
    </section>
</div>