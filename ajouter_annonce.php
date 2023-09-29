<?php
session_start();
require('conf/login_data.php');
$id_annonceurs = $_SESSION['id'];
require "sendmail.php";
$success_add;
$echec_add;

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
    <!--sweetalert2-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!--font google -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500&family=Open+Sans:wght@300;400&display=swap" rel="stylesheet"> <!-- title bar icon -->
    <link rel="shortcut icon" type="imge/x-icon" href="img/title-bar-icon.png">
    <link rel="stylesheet" href="style.css">
    <title>Ajouter une annonce</title>
    <!-- Google tag (gtag.js) -->
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
    <?php


    if (isset($_POST['submit'])) {
        $id = $_SESSION['id'];
        date_default_timezone_set('Africa/Dakar');
        $date_add = strtotime(date('d-m-Y H:i:s'));
        $date_expire = strtotime(date('d-m-Y H:i:s', strtotime('+1 month')));
        $update_date = strtotime(date('d-m-Y H:i:s'));
        $etat = isset($_POST['etat']) ? $_POST['etat'] : NULL;
        $periode = isset($_POST['periode']) ? $_POST['periode'] : NULL;
        $categorie = isset($_POST['categorie']) ? $_POST['categorie'] : NULL;
        $type = isset($_POST['type']) ? $_POST['type'] : NULL;
        $titre =  htmlspecialchars($_POST['titre']);
        $description =  htmlspecialchars($_POST['description']);
        $prix = $_POST['prix'];
        $quartier = $_POST['quartier'];
        $ville = $_POST['ville'];
        ////////////////////////////////////////////////
        $name_cover = $_FILES['cover']['name'];
        $tmp_cover = $_FILES['cover']['tmp_name'];
        $name_cover2 = $_FILES['cover2']['name'];
        $tmp_cover2 = $_FILES['cover2']['tmp_name'];
        $name_cover3 = $_FILES['cover3']['name'];
        $tmp_cover3 = $_FILES['cover3']['tmp_name'];
        $name_cover4 = $_FILES['cover4']['name'];
        $tmp_cover4 = $_FILES['cover4']['tmp_name'];
        $name_cover5 = $_FILES['cover5']['name'];
        $tmp_cover5 = $_FILES['cover5']['tmp_name'];
        $name_cover6 = $_FILES['cover6']['name'];
        $tmp_cover6 = $_FILES['cover6']['tmp_name'];
        $name_cover7 = $_FILES['cover7']['name'];
        $tmp_cover7 = $_FILES['cover7']['tmp_name'];
        $extension = strrchr($name_cover, '.');
        $extension2 = strrchr($name_cover2, '.');
        $extension3 = strrchr($name_cover3, '.');
        $extension4 = strrchr($name_cover4, '.');
        $extension5 = strrchr($name_cover5, '.');
        $extension6 = strrchr($name_cover6, '.');
        $extension7 = strrchr($name_cover7, '.');
        $autoriser = array('.png', '.PNG', '.jpg', '.JPG', '.JPEG', '.jpeg', '.webp', '.WEBP');
        $destination = 'img_cover/' . $name_cover;
        $destination2 = 'photos_supplementaires/' . $name_cover2;
        $destination3 = 'photos_supplementaires/' . $name_cover3;
        $destination4 = 'photos_supplementaires/' . $name_cover4;
        $destination5 = 'photos_supplementaires/' . $name_cover5;
        $destination6 = 'photos_supplementaires/' . $name_cover6;
        $destination7 = 'photos_supplementaires/' . $name_cover7;
        ///////////////////////////////////////////////////////////////////////////////////////////////
        if (!isset($_POST['etat']) || empty($_POST['etat'])) {
            $errors_etat;
            $errors_etat = "Indiquer un état";
        }
        if (!isset($_POST['categorie']) || empty($_POST['categorie'])) {
            $errors_categorie;
            $errors_categorie = "Catégorie vide";
        }
        if (!isset($_POST['type']) || empty($_POST['type'])) {
            $errors_type;
            $errors_type = "Type vide";
        }
        if (!isset($_POST['titre']) || empty($_POST['titre'])) {
            $errors_titre;
            $errors_titre = "Titre vide";
        }
        if (!isset($_POST['description']) || empty($_POST['description'])) {
            $errors_description;
            $errors_description = "Description vide";
        }
        if (!isset($_POST['prix']) || empty($_POST['prix'])) {
            $errors_prix;
            $errors_prix = "Prix vide";
        }
        if (!isset($_POST['periode']) || empty($_POST['periode'])) {
            $errors_periode;
            $errors_periode = "Période vide";
        }
        if (empty($name_cover) || empty($name_cover2) || empty($name_cover3)) {
            $errors_photo;
            $errors_photo = "Ajouter minimum trois photos";
        }
        if (!isset($_POST['quartier']) || empty($_POST['quartier'])) {
            $errors_quartier;
            $errors_quartier = "Quartier vide";
        }
        if (!isset($_POST['ville']) || empty($_POST['ville'])) {
            $errors_ville;
            $errors_ville = "Ville vide";
        }
        ///////////////////////////////////////////////////////////////////////////////////////////////
        if (empty($errors_etat) && empty($errors_categorie) && empty($errors_type) && empty($errors_titre) && empty($errors_description) && empty($errors_prix) && empty($errors_periode) && empty($errors_photo) && empty($errors_quartier) && empty($errors_ville)) {
            $success;
            ///////////////////////////////////////////////////////////////////////////////////////////
            if (in_array($extension, $autoriser)) {
                require 'conf/login_data.php';
                $statuts = "en cours de validation...";
                if (move_uploaded_file($tmp_cover, $destination) && move_uploaded_file($tmp_cover2, $destination2) && move_uploaded_file($tmp_cover3, $destination3) || (move_uploaded_file($tmp_cover, $destination) && move_uploaded_file($tmp_cover2, $destination2) && move_uploaded_file($tmp_cover3, $destination3) && move_uploaded_file($tmp_cover4, $destination4) && move_uploaded_file($tmp_cover5, $destination5) && move_uploaded_file($tmp_cover6, $destination6) && move_uploaded_file($tmp_cover7, $destination7))) {
                    $add = $loginData->prepare('INSERT INTO annonces(id_annonceurs, categories, types, titres, descriptions, prix, periode, img_cover, photo_1, photo_2, photo_3, photo_4, photo_5, photo_6, quartiers, villes, etat, date_add, date_expire, statuts, update_date) VALUE(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
                    $add->execute(array($id, $categorie, $type, $titre, $description, $prix, $periode, $destination, $destination2, $destination3, $destination4, $destination5, $destination6, $destination7,  $quartier, $ville, $etat, $date_add, $date_expire, $statuts, $update_date));

                    if ($add) {
                        $id_annonceurs;
                        $id_annonce = $loginData->lastInsertId();
                        // // //////mettre alerte de réussite ici//////////////
                        addann();
                        $_SESSION['add_a'] = ' Après validation, votre annonce sera ajoutée, vous recevrez une confirmation par e-mail. ';
                        header('Location: mes_annonces.php');
                    } else {
                        $errors = "échec du téléchargement veuillez rééssayer !";
                    }
                }
                // if (move_uploaded_file($tmp_cover, $destination) and move_uploaded_file($tmp_cover2, $destination2) and move_uploaded_file($tmp_cover3, $destination3)) {
                //     $add = $loginData->prepare('INSERT INTO annonces(id_annonceurs, categories, types, titres, descriptions, prix, periode, img_cover, photo_1, photo_2, quartiers, villes, etat, date_add, date_expire, statuts, update_date) VALUE(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
                //     $add->execute(array($id, $categorie, $type, $titre, $description, $prix, $periode, $destination, $destination2, $destination3, $quartier, $ville, $etat, $date_add, $date_expire, $statuts, $update_date));

                //     if ($add) {
                //         $id_annonceurs;
                //         $id_annonce = $loginData->lastInsertId();
                //         // // //////mettre alerte de réussite ici//////////////
                //         addann();
                //         $_SESSION['add_a'] = ' Après validation, votre annonce sera ajoutée, vous recevrez une confirmation par e-mail. ';
                //         header('Location: mes_annonces.php');
                //     } else {
                //         $errors = "échec du téléchargement veuillez rééssayer !";
                //     }
                // }

                // if (move_uploaded_file($tmp_cover, $destination) and move_uploaded_file($tmp_cover2, $destination2) and move_uploaded_file($tmp_cover3, $destination3) and move_uploaded_file($tmp_cover4, $destination4)) {
                //     $add = $loginData->prepare('INSERT INTO annonces(id_annonceurs, categories, types, titres, descriptions, prix, periode, img_cover, photo_1, photo_2, photo_3, quartiers, villes, etat, date_add, date_expire, statuts, update_date) VALUE(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
                //     $add->execute(array($id, $categorie, $type, $titre, $description, $prix, $periode, $destination, $destination2, $destination3, $destination4, $quartier, $ville, $etat, $date_add, $date_expire, $statuts, $update_date));

                //     if ($add) {
                //         $id_annonceurs;
                //         $id_annonce = $loginData->lastInsertId();
                //         // // //////mettre alerte de réussite ici//////////////
                //         addann();
                //         $_SESSION['add_a'] = ' Après validation, votre annonce sera ajoutée, vous recevrez une confirmation par e-mail. ';
                //         header('Location: mes_annonces.php');
                //     } else {
                //         $errors = "échec du téléchargement veuillez rééssayer !";
                //     }
                // }

                // if (move_uploaded_file($tmp_cover, $destination) and move_uploaded_file($tmp_cover2, $destination2) and move_uploaded_file($tmp_cover3, $destination3) and move_uploaded_file($tmp_cover4, $destination4) and move_uploaded_file($tmp_cover5, $destination5)) {
                //     $add = $loginData->prepare('INSERT INTO annonces(id_annonceurs, categories, types, titres, descriptions, prix, periode, img_cover, photo_1, photo_2, photo_3, photo_4, quartiers, villes, etat, date_add, date_expire, statuts, update_date) VALUE(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
                //     $add->execute(array($id, $categorie, $type, $titre, $description, $prix, $periode, $destination, $destination2, $destination3, $destination4, $destination5,  $quartier, $ville, $etat, $date_add, $date_expire, $statuts, $update_date));

                //     if ($add) {
                //         $id_annonceurs;
                //         $id_annonce = $loginData->lastInsertId();
                //         // // //////mettre alerte de réussite ici//////////////
                //         addann();
                //         $_SESSION['add_a'] = ' Après validation, votre annonce sera ajoutée, vous recevrez une confirmation par e-mail. ';
                //         header('Location: mes_annonces.php');
                //     } else {
                //         $errors = "échec du téléchargement veuillez rééssayer !";
                //     }
                // }

                // if (move_uploaded_file($tmp_cover, $destination) and move_uploaded_file($tmp_cover2, $destination2) and move_uploaded_file($tmp_cover3, $destination3) and move_uploaded_file($tmp_cover4, $destination4) and move_uploaded_file($tmp_cover5, $destination5) and move_uploaded_file($tmp_cover6, $destination6)) {
                //     $add = $loginData->prepare('INSERT INTO annonces(id_annonceurs, categories, types, titres, descriptions, prix, periode, img_cover, photo_1, photo_2, photo_3, photo_4, photo_5, quartiers, villes, etat, date_add, date_expire, statuts, update_date) VALUE(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
                //     $add->execute(array($id, $categorie, $type, $titre, $description, $prix, $periode, $destination, $destination2, $destination3, $destination4, $destination5, $destination6,  $quartier, $ville, $etat, $date_add, $date_expire, $statuts, $update_date));

                //     if ($add) {
                //         $id_annonceurs;
                //         $id_annonce = $loginData->lastInsertId();
                //         // // //////mettre alerte de réussite ici//////////////
                //         addann();
                //         $_SESSION['add_a'] = ' Après validation, votre annonce sera ajoutée, vous recevrez une confirmation par e-mail. ';
                //         header('Location: mes_annonces.php');
                //     } else {
                //         $errors = "échec du téléchargement veuillez rééssayer !";
                //     }
                // }

                // // if (move_uploaded_file($tmp_cover, $destination) and move_uploaded_file($tmp_cover2, $destination2) and move_uploaded_file($tmp_cover3, $destination3) and move_uploaded_file($tmp_cover4, $destination4) and move_uploaded_file($tmp_cover5, $destination5) and move_uploaded_file($tmp_cover6, $destination6) and move_uploaded_file($tmp_cover7, $destination7)) {
                //     $add = $loginData->prepare('INSERT INTO annonces(id_annonceurs, categories, types, titres, descriptions, prix, periode, img_cover, photo_1, photo_2, photo_3, photo_4, photo_5, photo_6, quartiers, villes, etat, date_add, date_expire, statuts, update_date) VALUE(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
                //     $add->execute(array($id, $categorie, $type, $titre, $description, $prix, $periode, $destination, $destination2, $destination3, $destination4, $destination5, $destination6, $destination7,  $quartier, $ville, $etat, $date_add, $date_expire, $statuts, $update_date));

                //     if ($add) {
                //         $id_annonceurs;
                //         $id_annonce = $loginData->lastInsertId();
                //         // // //////mettre alerte de réussite ici//////////////
                //         addann();
                //         $_SESSION['add_a'] = ' Après validation, votre annonce sera ajoutée, vous recevrez une confirmation par e-mail. ';
                //         header('Location: mes_annonces.php');
                //     } else {
                //         $errors = "échec du téléchargement veuillez rééssayer !";
                //     }
                // }
            } else {
                $errors_toph = "Extensions de fichier non autorisées. Seules les images JPG, JPEG, PNG, WEBP et GIF sont autorisées.";
            }
        }
    }
    ?>
    <style>
        .navbar-light .navbar-nav .ajouter_annonce_link {
            color: #ec3e0e;
        }
    </style>

    <div class="container-fluid-xs container-xxl" style="padding-right: var(--bs-gutter-x, 0rem); overflow:hidden;">
        <div class="row">
            <?php include "header_contact.php" ?>
            <?php include "logo_menu.php" ?>
            <div class="row ">
                <form action="" method="POST" enctype="multipart/form-data" class="forms2">
                    <h3 class="mb-4 text-center text-dark">Déposer une annonce</h3>
                    <!-- add_annonces -->
                    <div class="container page" id="page1">


                        <?php if (!empty($success)) : ?>
                            <p class="alert alert-success text-center" style="font-weight: 600; font-size: 0.9rem;">
                                <?= $success ?>
                            </p>
                        <?php endif; ?>
                        <!-- etat -->
                        <div class="form-group col-xs px-4 py-3 mb-3 col-md-8 ">
                            <label for="" class=" form-label">Etat :<?php if (!empty($errors_etat)) : ?>
                                <span class=" text-danger text-start" style="font-weight: 600; font-size: 0.9rem;">
                                    <?= $errors_etat ?>
                                </span>
                            <?php endif; ?></label><br />
                            <div class="form-check form-check-inline"><input class="form-check-input" type="radio" name="etat" id="dispob" value="Bientôt disponible"><label class="form-check-label" for="dispob">Bientôt disponible</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="etat" id="dispo" value="Disponible">
                                <label class="form-check-label" for="dispo">Disponible</label>
                            </div>
                            <div class="form-check form-check-inline"><input class="form-check-input" type="radio" name="etat" id="occ" value="Occupé"><label class="form-check-label" for="occ">Occupé</label>
                            </div>
                        </div>
                        <!-- categorie -->
                        <div class="form-group  col-xs px-4 py-3 mb-3 col-md-8">
                            <label for="" class=" form-label">Catégorie : <?php if (!empty($errors_categorie)) : ?>
                                    <span class=" text-danger text-start" style="font-weight: 600; font-size: 0.9rem;">
                                        <?= $errors_categorie ?>
                                    </span>
                                <?php endif; ?></label><br />
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="categorie" id="categorie-achat" value="achat">
                                <label class="form-check-label" for="categorie-achat">Vente</label>
                            </div>
                            <div class="form-check form-check-inline"><input class="form-check-input" type="radio" name="categorie" id="location" value="location"><label class="form-check-label" for="location">Location</label>
                            </div>
                        </div>
                        <!-- type -->
                        <div class="form-group  col-xs px-4 py-3 mb-3 col-md-8">
                            <label for="" class=" form-label">Type :</label>
                            <?php if (!empty($errors_type)) : ?>
                                <span class=" text-danger text-start" style="font-weight: 600; font-size: 0.9rem;">
                                    <?= $errors_type ?>
                                </span>
                            <?php endif; ?>
                            <select class="form-select form-select-lg" name="type">
                                <option selected disabled>Types</option>
                                <option value="Appartement">Appartement</option>
                                <!-- <option value="Airbnb">Airbnb</option> -->
                                <option value="Bureau">Bureau</option>
                                <!-- <option value="Chalet">Chalet</option> -->
                                <option value="Chambre">Chambre</option>
                                <option value="Duplex">Duplex</option>
                                <option value="Entrepôt">Entrepôt</option>
                                <option value="Ferme">Ferme</option>
                                <!-- <option value="Hôtel">Hôtel</option> -->
                                <option value="Immeuble">Immeuble</option>
                                <option value="Local">Local</option>
                                <option value="Maison">Maison</option>
                                <!-- <option value="Loft">Loft</option> -->
                                <option value="Studio">Studio</option>
                                <!-- <option value="Résidence">Résidence</option> -->
                                <option value="Terrain">Terrain</option>
                                <!-- <option value="Triplex">Triplex</option> -->
                                <option value="Villa">Villa</option>
                            </select>
                        </div>
                        <!-- titre -->
                        <div class="form-group  col-xs px-4 py-3 mb-3 col-md-8">
                            <label for="" class=" form-label">Titre :</label>
                            <?php if (!empty($errors_titre)) : ?>
                                <span class=" text-danger text-start" style="font-weight: 600; font-size: 0.9rem;">
                                    <?= $errors_titre ?>
                                </span>
                            <?php endif; ?>
                            <input type="text" style="" name="titre" class="form-control" value="<?php echo isset($_POST['titre']) ? htmlspecialchars($_POST['titre']) : ''; ?>" />
                        </div>

                        <!-- description -->
                        <div class="form-group  col-xs px-4 py-3 mb-3 col-md-8">
                            <label for="" class=" form-label">Description : <?php if (!empty($errors_description)) : ?>
                                    <span class=" text-danger text-start" style="font-weight: 600; font-size: 0.9rem;">
                                        <?= $errors_description ?>
                                    </span>
                                <?php endif; ?></label>
                            <textarea class="form-control" rows="5" id="comment" name="description" style="resize:none;"></textarea>
                        </div>
                        <!-- <button type="button" class="form-group-btn next btn btn-success mb-4" style="color: #fff;font-weight: 700;font-size:14px">Suivant</button> -->
                        <!-- <button class="prev btn btn-warning my-4 px-4  " type="button" style="color: #fff;font-weight: 700;font-size:14px">Retour</button> -->
                        <!-- prix -->
                        <div class="form-group  col-xs px-4 py-3 mb-3 col-md-8">
                            <label for="" class=" form-label">Prix : <?php if (!empty($errors_prix)) : ?>
                                    <span class=" text-danger text-start" style="font-weight: 600; font-size: 0.9rem;">
                                        <?= $errors_prix ?>
                                    </span>
                                <?php endif; ?></label>
                            <input type="text" name="prix" class="form-control" value="<?php echo isset($_POST['prix']) ? htmlspecialchars($_POST['prix']) : ''; ?>" />
                            <div id="emailHelp" class="form-text text-warning">Ne mettez aucun point, aucune virgule ni espace.
                                .</div>
                        </div>
                        <!-- periode -->
                        <div class="form-group  col-xs px-4 py-3 mb-3 col-md-8">
                            <label for="" class=" form-label">Périodes : <?php if (!empty($errors_periode)) : ?>
                                    <span class=" text-danger text-start" style="font-weight: 600; font-size: 0.9rem;">
                                        <?= $errors_periode ?>
                                    </span>
                                <?php endif; ?></label><br />

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="periode" id="jour" value="jour">
                                <label class="form-check-label" for="jour">Jour</label>
                            </div>

                            <div class="form-check form-check-inline"><input class="form-check-input" type="radio" name="periode" id="semaine" value="Semaine"><label class="form-check-label" for="semaine">Semaine</label>
                            </div>

                            <div class="form-check form-check-inline"><input class="form-check-input" type="radio" name="periode" id="mois" value="Mois"><label class="form-check-label" for="mois">Mois</label>
                            </div>
                            <div class="form-check form-check-inline"><input class="form-check-input" type="radio" name="periode" id="vente" value="-"><label class="form-check-label" for="vente">Autre (si vente)</label>
                            </div>
                        </div>
                        <!-- photos -->
                        <div class="form-group col-xs p-3 mb-3 col-12 col-md-12 col-lg-12 ">
                            <div class="row">
                                <div class="col-12">
                                    <label for="" class=" form-label text-dark ">Photos : Une annonce avec des photos est plus de fois consultée qu'une annonce sans photos. Ajouter minimum 3 photos.</label>
                                </div>

                                <?php if (!empty($errors_photo)) : ?>
                                    <p class=" text-danger text-start" style="font-weight: 600; font-size: 0.9rem;">
                                        <?= $errors_photo ?>
                                    </p>
                                <?php endif; ?>
                                <?php if (!empty($errors_toph)) : ?>
                                    <p class=" text-danger text-start" style="font-weight: 600; font-size: 0.9rem;">
                                        <?= $errors_toph ?>
                                    </p>
                                <?php endif; ?>

                                <div class="form">
                                    <div class="grid">

                                    <div class="form-element">
                                        <input type="file" id="file-1" accept="image/*" name="cover">
                                        <label for="file-1" id="file-1-preview">
                                            <img src="https://bit.ly/3ubuq5o" alt="">
                                            <div>
                                                <span>+</span>
                                            </div>
                                        </label>
                                    </div>

                                    <div class="form-element">
                                        <input type="file" id="file-2" accept="image/*" name="cover2">
                                        <label for="file-2" id="file-2-preview">
                                            <img src="https://bit.ly/3ubuq5o" alt="">
                                            <div>
                                                <span>+</span>
                                            </div>
                                        </label>
                                    </div>

                                    <div class="form-element">
                                        <input type="file" id="file-3" accept="image/*" name="cover3">
                                        <label for="file-3" id="file-3-preview">
                                            <img src="https://bit.ly/3ubuq5o" alt="">
                                            <div>
                                                <span>+</span>
                                            </div>
                                        </label>
                                    </div>

                                    <div class="form-element">
                                        <input type="file" id="file-4" accept="image/*" name="cover4">
                                        <label for="file-4" id="file-4-preview">
                                            <img src="https://bit.ly/3ubuq5o" alt="">
                                            <div>
                                                <span>+</span>

                                            </div>
                                        </label>
                                    </div>

                                    <div class="form-element">
                                        <input type="file" id="file-5" accept="image/*" name="cover5">
                                        <label for="file-5" id="file-5-preview">
                                            <img src="https://bit.ly/3ubuq5o" alt="">
                                            <div>
                                                <span>+</span>
                                            </div>
                                        </label>
                                    </div>

                                    <div class="form-element">
                                        <input type="file" id="file-6" accept="image/*" name="cover6">
                                        <label for="file-6" id="file-6-preview">
                                            <img src="https://bit.ly/3ubuq5o" alt="">
                                            <div>
                                                <span>+</span>
                                            </div>
                                        </label>
                                    </div>

                                    <div class="form-element">
                                        <input type="file" id="file-7" accept="image/*" name="cover7">
                                        <label for="file-7" id="file-7-preview">
                                            <img src="https://bit.ly/3ubuq5o" alt="">
                                            <div>
                                                <span>+</span>
                                            </div>
                                        </label>
                                    </div>

                                </div>
                                </div>
                            </div>
                            
                        </div>

                        <!-- ville -->
                        <div class="form-group col-xs px-5 py-3 mb-4 col-md-8"><label for="" class=" form-label">Ville : <?php if (!empty($errors_ville)) : ?>
                                    <span class=" text-danger text-start" style="font-weight: 600; font-size: 0.9rem;">
                                        <?= $errors_ville ?>
                                    </span>
                                <?php endif; ?></label>
                            <select id="inputState" name="ville" class="form-select" value="<?php echo isset($_POST['ville']) ? htmlspecialchars($_POST['ville']) : ''; ?>">
                                <option value="Dakar">Dakar</option>
                                <option value="Diourbel">Diourbel</option>
                                <option value="Fatick">Fatick</option>
                                <option value="Kaffrine">Kaffrine</option>
                                <option value="Kaolack">Kaolack</option>
                                <option value="Kédougou">Kédougou</option>
                                <option value="Kolda">Kolda</option>
                                <option value="Louga">Louga</option>
                                <option value="Matam">Matam</option>
                                <option value="Saint-Louis">Saint-Louis</option>
                                <option value="Sédhiou">Sédhiou</option>
                                <option value="Tambacounda">Tambacounda</option>
                                <option value="Thiès">Thiès</option>
                                <option value="Ziguinchor">Ziguinchor</option>
                            </select>
                        </div>
                        <!-- quatier -->
                        <div class="form-group  col-xs px-4 py-3 mb-3 col-md-8">
                            <label for="" class=" form-label">Quartier :</label>
                            <select id="inputState" name="quartier" class="form-select" value="<?php echo isset($_POST['quartier']) ? htmlspecialchars($_POST['quartier']) : ''; ?>">
                                <optgroup label="Dakar">
                                    <option value="Amitié">Amitié</option>
                                    <option value="Almadies">Almadies</option>
                                    <option value="Almadies 2">Almadies 2</option>
                                    <option value="Bambilor">Bamilor</option>
                                    <option value="Bargny">Bargny</option>
                                    <option value="Bel air">Bel air</option>
                                    <option value="Biscuiterie">Biscuiterie</option>
                                    <option value="Bobab">Baobab</option>
                                    <option value="Cambérène">Cambérène</option>
                                    <option value="Castors">Castors</option>
                                    <option value="Cité asecna">Cité asecna</option>
                                    <option value="Cité assemblée">Cité assemblée</option>
                                    <option value="Cité avion">Cité avion</option>
                                    <option value="Cité batrain">Cité Batrain</option>
                                    <option value="Cité biagui">Cité Biagui</option>
                                    <option value="Cité damel">Cité Damel</option>
                                    <option value="Cité djily mbaye">Cité Djily Mbaye</option>
                                    <option value="Cité keur gorgui">Cité Keur Gorgui</option>
                                    <option value="Cité mixta">Cité mixta</option>
                                    <option value="Colobane">Colobane</option>
                                    <option value="Comico">comico</option>
                                    <option value="Dalifort">Dalifort</option>
                                    <option value="Derkle">Derkle</option>
                                    <option value="Diamaguene">Diamaguene</option>
                                    <option value="Diamniadio">Diamniadio</option>
                                    <option value="Dieuppeul">Dieuppeul</option>
                                    <option value="Djidah thiaroye kaw">Djidah thiaroye kaw</option>
                                    <option value="Djily mbaye">Djily mbaye</option>
                                    <option value="Fann">Fann</option>
                                    <option value="Fann hock">Fann Hock</option>
                                    <option value="Fann résidence">Fann Résidence</option>
                                    <option value="Fass">Fass</option>
                                    <option value="Fenêtre mermoz">Fenêtre mermoz</option>
                                    <option value="Gibraltar">Gibraltar</option>
                                    <option value="Golf">Golf</option>
                                    <option value="Gorom">Gorom</option>
                                    <option value="Gorée">Gorée</option>
                                    <option value="Grand dakar">Grand Dakar</option>
                                    <option value="Grand yoff">Grand yoff</option>
                                    <option value="Guediawaye">Guediawaye</option>
                                    <option value="Gueule-tapée">Gueule-tapée</option>
                                    <option value="Guinaw rail">Guinaw rail</option>
                                    <option value="Hann bel-air">Hann Bel-Air</option>
                                    <option value="Hann marinas">Hann marinas</option>
                                    <option value="Hann maristes">Hann Maristes</option>
                                    <option value="Hlm">Hlm</option>
                                    <option value="Hlm grand-yoff">Hlm grand-yoff</option>
                                    <option value="Karack">Karack</option>
                                    <option value="Keur massar">Keur Massar</option>
                                    <option value="Keur ndiaye lô">Keur ndiaye lô</option>
                                    <option value="Kounoune">Kounoune</option>
                                    <option value="Lac rose">Lac rose</option>
                                    <option value="Liberté 1">Liberté 1</option>
                                    <option value="Liberté 2">Liberté 2</option>
                                    <option value="Liberté 3">Liberté 3</option>
                                    <option value="Liberté 4">Liberté 4</option>
                                    <option value="Liberté 5">Liberté 5</option>
                                    <option value="Liberté 6">Liberté 6</option>
                                    <option value="Liberté 6 extension">Liberté 6 extension</option>
                                    <option value="Malika">Malika</option>
                                    <option value="Mamelles">Mamelles</option>
                                    <option value="Mbao">Mbao</option>
                                    <option value="Mermoz">Mermoz</option>
                                    <option value="Médina">Médina</option>
                                    <option value="Ndiakhirate">Ndiakhirate</option>
                                    <option value="Ngor">Ngor</option>
                                    <option value="Niague">Niague</option>
                                    <option value="Niakoul rap">Niakoul rap</option>
                                    <option value="Niarry tally">Niarry Tally</option>
                                    <option value="Nord foire">Nord Foire</option>
                                    <option value="Ouakam">Ouakam</option>
                                    <option value="Ouest foire">Ouest Foire</option>
                                    <option value="Parcelles assainies">Parcelles Assainies</option>
                                    <option value="Patte d'oie">Patte d'oie</option>
                                    <option value="Pikine">Pikine</option>
                                    <option value="Plateau">Plateau</option>
                                    <option value="Point E">Point E</option>
                                    <option value="Rufisque">Rufisque</option>
                                    <option value="Sacré coeur">Sacré Coeur</option>
                                    <option value="Sangalkam">Sangalkam</option>
                                    <option value="Sebikotane">Sebikotane</option>
                                    <option value="Sendou">Sendou</option>
                                    <option value="Scat urban">Scat urban</option>
                                    <option value="Sicap liberté">Sicap Liberté</option>
                                    <option value="Sicap sacré coeur">Sicap sacré coeur</option>
                                    <option value="Sicap baobab">Sicap baobab</option>
                                    <option value="Sicap foire">Sicap foire</option>
                                    <option value="Sicap mbao">Sicap mbao</option>
                                    <option value="Siprés">Siprés</option>
                                    <option value="Sud foire">Sud foire</option>
                                    <option value="Thiaroye">Thiaroye</option>
                                    <option value="Thongor">Thongor</option>
                                    <option value="Tivaounane peulh">Tivaounane peulh</option>
                                    <option value="Toubab dialao">Toubab Dialao</option>
                                    <option value="Vdn">VDN</option>
                                    <option value="Virage">Virage</option>
                                    <option value="Yene">Yene</option>
                                    <option value="Yeumbeul">Yeumbeul</option>
                                    <option value="Yoff">Yoff</option>
                                    <option value="Zac mbao">Zac mbao</option>
                                    <option value="Zone de captage">Zone de Captage</option>
                                    <option value="Zone industrielle">Zone industrielle</option>
                                </optgroup>
                                <optgroup label="Diourbel">
                                    <option value="Bambey">Bambey</option>
                                    <option value="Diourbel">Diourbel</option>
                                    <option value="Mbacke">Mbacke</option>
                                </optgroup>
                                <optgroup label="Fatick">
                                    <option value="Diofior">Diofior</option>
                                    <option value="Fatick">Fatick</option>
                                    <option value="Foundiougne">Foundiougne</option>
                                    <option value="Gossas">Gossas</option>
                                    <option value="Karang poste">Karang poste</option>
                                    <option value="Passi">Passi</option>
                                    <option value="Sokone">Sokone</option>
                                    <option value="Soum">Soum</option>
                                </optgroup>
                                <optgroup label="Kaffrine">
                                    <option value="Birkilane">Birkilane</option>
                                    <option value="Kaffrine">Kaffrine</option>
                                    <option value="Koungheul">Koungheul</option>
                                    <option value="Mabo">Mabo</option>
                                    <option value="Malem hodar">Malem hodar</option>
                                    <option value="Nganda">Nganda</option>
                                </optgroup>
                                <optgroup label="Kaolack">
                                    <option value="Fass">Fass</option>
                                    <option value="Gandiaye">Gandiaye</option>
                                    <option value="Guinguineo">Guinguineo</option>
                                    <option value="Kahone">Kahone</option>
                                    <option value="Kaolack">Kaolack</option>
                                    <option value="Keur madiabel">Keur madiabel</option>
                                    <option value="Mboss">Mboss</option>
                                    <option value="Ndoffane">Ndoffane</option>
                                    <option value="Nioro du rip">Nioro du rip</option>
                                    <option value="Sibassor">Sibassor</option>
                                </optgroup>
                                <optgroup label="Kédougou">
                                    <option value="Kedougou">Kedougou</option>
                                    <option value="Salemata">Salemata</option>
                                    <option value="Saraya">Saraya</option>
                                </optgroup>
                                <optgroup label="Kolda">
                                    <option value="Dabo">Dabo</option>
                                    <option value="Diaobe kabendou">Diaobe kabendou</option>
                                    <option value="Kolda">Kolda</option>
                                    <option value="Kounkane">Kounkane</option>
                                    <option value="Medina yoro foulah">Medina yoro foulah</option>
                                    <option value="Pata">Pata</option>
                                    <option value="Salikegne">Salikegne</option>
                                    <option value="Sare yoba diega">Sare yoba diega</option>
                                    <option value="Velingara">Velingara</option>
                                </optgroup>
                                <optgroup label="Louga">
                                    <option value="Dahra">Dahra</option>
                                    <option value="Gueoul">Gueoul</option>
                                    <option value="Kebemer">Kebemer</option>
                                    <option value="Leona">Leona</option>
                                    <option value="Linguere">Linguere</option>
                                    <option value="Louga">Louga</option>
                                    <option value="Mbeuleukhe">Mbeuleukhe</option>
                                    <option value="Nguene sarr">Nguene sarr</option>
                                    <option value="Sakal">Sakal</option>
                                    <option value="Thiep">Thiep</option>
                                </optgroup>
                                <optgroup label="Matam">
                                    <option value="Dembancane">Dembacane</option>
                                    <option value="Hamadi hounare">Hamadi hounare</option>
                                    <option value="Kanel">Kanel</option>
                                    <option value="Matam">Matam</option>
                                    <option value="Nguidjilone">Nguidjilone</option>
                                    <option value="Odobere">Odobere</option>
                                    <option value="Ouaounde">Ouaounde</option>
                                    <option value="Ourossogui">Ourossogui</option>
                                    <option value="Ranerou">Ranerou</option>
                                    <option value="Semme">Semme</option>
                                    <option value="Sinthiou bamambe banadji">Sinthiou bamambe banadji</option>
                                    <option value="Thilogne">Thilogne</option>
                                </optgroup>
                                <optgroup label="Saint-Louis">
                                    <option value="Aere Lao">Aere Lao</option>
                                    <option value="Bode lao">Bode lao</option>
                                    <option value="Dagana">Dagana</option>
                                    <option value="Demette">Demette</option>
                                    <option value="Gae">Gae</option>
                                    <option value="Galoya toucouleur">Galoya toucouleur</option>
                                    <option value="Gnith">Gnith</option>
                                    <option value="Gollere">Gollere</option>
                                    <option value="Guede chantier">Guede chantier</option>
                                    <option value="Mboumba">Mboumba</option>
                                    <option value="Mpal">Mpal</option>
                                    <option value="Ndioum">Ndioum</option>
                                    <option value="Ndombo sandjiry">Ndombo sandjiry</option>
                                    <option value="Niandane">Niandane</option>
                                    <option value="Pete">Pete</option>
                                    <option value="Podor">Podor</option>
                                    <option value="Richard toll">Richard toll</option>
                                    <option value="Ross bethio">Ross bethio</option>
                                    <option value="Roso Senegal">Roso Senegal</option>
                                    <option value="Saint-Louis">Saint-Louis</option>
                                    <option value="Walalde">Walalde</option>
                                </optgroup>
                                <optgroup label="Sédhiou">
                                    <option value="Bounkiling">Bounkiling</option>
                                    <option value="Dianah malary">Dianah malary</option>
                                    <option value="Diattacounda">Diattacounda</option>
                                    <option value="Dioudoubou">Dioudoubou</option>
                                    <option value="Djinany">Djinany</option>
                                    <option value="Goudomp">Goudomp</option>
                                    <option value="Kaour">Kaour</option>
                                    <option value="Madina wandifa">Madina wandifa</option>
                                    <option value="Marssassoum">Marssassoum</option>
                                    <option value="Ndiamalathiel">Ndiamalathiel</option>
                                    <option value="Samine">Samine</option>
                                    <option value="Simbandi brassou">Simbandi brassou</option>
                                    <option value="Sédhiou">Sédhiou</option>
                                    <option value="Tanaff">Tanaff</option>
                                </optgroup>
                                <optgroup label="Tambacounda">
                                    <option value="Bakel">Bakel</option>
                                    <option value="Diawara">Diawara</option>
                                    <option value="Goudiry">Goudiry</option>
                                    <option value="Kidira">Kidira</option>
                                    <option value="Kothiary">Kothiary</option>
                                    <option value="Koumpentoum">Koumpentoum</option>
                                    <option value="Maleme niani">Maleme niani</option>
                                    <option value="Mereto">Mereto</option>
                                    <option value="Tambacounda">Tambacounda</option>
                                </optgroup>
                                <optgroup label="Thiès">
                                    <option value="Diass">Diass</option>
                                    <option value="Diender">Diender</option>
                                    <option value="Fandene">Fandene</option>
                                    <option value="Fissel">Fissel</option>
                                    <option value="Guereo">Guereo</option>
                                    <option value="Joal fadiouth">Joal fadiouth</option>
                                    <option value="Kayar">Kayar</option>
                                    <option value="Keur moussa">Keur moussa</option>
                                    <option value="Khombole">Khombole</option>
                                    <option value="Malicounda">Malicounda</option>
                                    <option value="Mbodiene">Mbodiene</option>
                                    <option value="Mboro">Mboro</option>
                                    <option value="Mbour">Mbour</option>
                                    <option value="Meckhe">Meckhe</option>
                                    <option value="Ndiaganiao">Ndiaganiao</option>
                                    <option value="Ngaparou">Ngaparou</option>
                                    <option value="Ngoundiane">Ngoundiane</option>
                                    <option value="Nguekhokh">Nguekhokh</option>
                                    <option value="Ngueniene">Ngueniene</option>
                                    <option value="Nguering">Nguering</option>
                                    <option value="Nianing">Nianing</option>
                                    <option value="Notto">Notto</option>
                                    <option value="Pambal">Pambal</option>
                                    <option value="Pointe sarene">Pointe sarene</option>
                                    <option value="Popenguine">Popenguine</option>
                                    <option value="Pout">Pout</option>
                                    <option value="Saly">Saly</option>
                                    <option value="Saly portudal">Saly portudal</option>
                                    <option value="Sandiara">Sandiara</option>
                                    <option value="Sessene">Sessene</option>
                                    <option value="Sindia">Sindia</option>
                                    <option value="Somone">Somone</option>
                                    <option value="Tassette">Tassette</option>
                                    <option value="Thiadiaye">Thiadiaye</option>
                                    <option value="Thienaba">Thienaba</option>
                                    <option value="Thiès">Thiès</option>
                                    <option value="Tivaouane">Tivaouane</option>
                                    <option value="Touba toul">Touba toul</option>
                                    <option value="Touba dialaw">Touba dialaw</option>
                                    <option value="Warang">Warang</option>
                                </optgroup>
                                <optgroup label="Ziguinchor">
                                    <option value="Bignona">Bignona</option>
                                    <option value="Cap skirring">Cap skirring</option>
                                    <option value="Diouloulou">Diouloulou</option>
                                    <option value="Oussouye">Oussouye</option>
                                    <option value="Thionck essyl">Thionck essyl</option>
                                    <option value="Ziguinchor">Ziguinchor</option>
                                </optgroup>
                            </select>
                        </div>
                        <!-- button -->
                        <button class="btn btn-success mb-4 px-2 text-ligth" type="submit" name="submit" style="color: #fff;font-weight: 700; font-size:.875rem">Ajouter mon
                            annonce</button>
                    </div>
            </div>
            </form>
        </div>

        <?php include "footer.php" ?>
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
    <script>
        let news_villes = document.getElementById("news_villes");
        let news_quartiers = document.getElementById("news_quartiers");

        function previewBeforeUpload(id) {
            document.querySelector("#" + id).addEventListener("change", function(e) {
                if (e.target.files.length == 0) {
                    return;
                }
                let file = e.target.files[0];
                let url = URL.createObjectURL(file);
                document.querySelector("#" + id + "-preview div").innerText = file
                    .name;
                document.querySelector("#" + id + "-preview img").src = url;
            });
        }

        previewBeforeUpload("file-1");
        previewBeforeUpload("file-2");
        previewBeforeUpload("file-3");
        previewBeforeUpload("file-4");
        previewBeforeUpload("file-5");
        previewBeforeUpload("file-6");
        previewBeforeUpload("file-7");
    </script>
    <script>
        document.getElementById('add-image').addEventListener('click', function() {
            var imageGrid = document.getElementById('image-grid');
            var numImages = imageGrid.getElementsByClassName('form-element').length;

            // Maximum 7 images
            if (numImages < 7) {
                var newImageElement = document.createElement('div');
                newImageElement.className = 'form-element';
                newImageElement.innerHTML = `
                <input type="file" accept="image/*" name="cover${numImages + 1}">
                <label for="file-${numImages + 1}-preview" id="file-${numImages + 1}-preview">
                    <img src="https://bit.ly/3ubuq5o" alt="">
                    <div>
                        <span>+</span>
                    </div>
                </label>
            `;
                imageGrid.appendChild(newImageElement);
            } else {
                document.getElementById('max-image-msg').style.display = 'block';
            }
        });
    </script>
    

    <script src="main.js"></script>
    <script src="//code.tidio.co/soutospimq4pk32r0mcxjjhtoqnjc0de.js" async></script>
</body>

</html>