<?php
session_start();
require "sendmail.php";
$rec =  $_GET['id'];
$rec2 =  $_GET['annonce'];
require 'conf/login_data.php';
$req = $loginData->prepare("SELECT * FROM annonces WHERE  id_annonces = $rec2 ");
$req->execute();
$data = $req->fetch();

$req2 = $loginData->prepare("SELECT * FROM annonceurs WHERE  id_annonceurs = $rec");
$req2->execute();
$data2 = $req2->fetch();
$email = $data2['email'];
$pseudo = $data2['pseudo'];
?>
<?php
if (isset($_POST['submit'])) {
    $etat = isset($_POST['etat']) ? $_POST['etat'] : NULL;
    $categorie = isset($_POST['categorie']) ? $_POST['categorie'] : NULL;
    $type = isset($_POST['type']) ? $_POST['type'] : NULL;
    $titre = htmlspecialchars($_POST['titre']);
    $description =  htmlspecialchars($_POST['description']);
    $prix = $_POST['prix'];
    $periode = isset($_POST['periode']) ? $_POST['periode'] : NULL;
    $quartier = $_POST['quartier'];
    $ville = $_POST['ville'];
    $option = $_POST['option'];
    ////////////////////////////////////////////////////////
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
    $autoriser = array('.png', '.PNG', '.jpg', '.JPG', '.JPEG', '.jpeg');
    $destination = 'img_cover/' . $name_cover;
    $destination2 = 'photos_supplementaires/' . $name_cover2;
    $destination3 = 'photos_supplementaires/' . $name_cover3;
    $destination4 = 'photos_supplementaires/' . $name_cover4;
    $destination5 = 'photos_supplementaires/' . $name_cover5;
    $destination6 = 'photos_supplementaires/' . $name_cover6;
    $destination7 = 'photos_supplementaires/' . $name_cover7;
    $date_add = date('d/m/Y');
    ////////////////////////////////////////////////

    if (isset($etat) && !empty($etat)) {
        require 'conf/login_data.php';
        $echec;
        $success;
        $date_add = date('d/m/Y');
        $req = $loginData->prepare("UPDATE annonces SET etat = ?, maj = ? WHERE id_annonces = $rec2");
        $req->execute([$etat, $date_add]);
        if ($req) {
            $_SESSION['update'] = "Votre annonce a été mise à jour";
            update();
            header("Location: mes_annonces.php");
        } else {
            $echec = 'Echec de la modification';
        }
    }
    if (isset($categorie) && !empty($categorie)) {
        require 'conf/login_data.php';
        $echec;
        $success;
        $date_add = date('d/m/Y');
        $req = $loginData->prepare("UPDATE annonces SET categories = ?, maj = ? WHERE id_annonces = $rec2");
        $req->execute([$categorie, $date_add]);
        if ($req) {
            $_SESSION['update'] = "Votre annonce a été mise à jour";
            update();
            header("Location: mes_annonces.php");
        } else {
            $echec = 'Echec de la modification';
        }
    }
    if (isset($periode) && !empty($periode)) {
        require 'conf/login_data.php';
        $echec;
        $success;
        $date_add = date('d/m/Y');
        $req = $loginData->prepare("UPDATE annonces SET periode = ?, maj = ? WHERE id_annonces = $rec2");
        $req->execute([$periode, $date_add]);
        if ($req) {
            $_SESSION['update'] = "Votre annonce a été mise à jour";
            update();
            header("Location: mes_annonces.php");
        } else {
            $echec = 'Echec de la modification';
        }
    }
    if (isset($titre) && !empty($titre)) {
        require 'conf/login_data.php';
        $echec;
        $success;
        $date_add = date('d/m/Y');
        $req = $loginData->prepare("UPDATE annonces SET titres = ?, maj = ? WHERE id_annonces = $rec2");
        $req->execute([$titre, $date_add]);
        if ($req) {
            $_SESSION['update'] = "Votre annonce a été mise à jour";
            update();
            header("Location: mes_annonces.php");
        } else {
            $echec = 'Echec de la modification';
        }
    }
    if (isset($description) && !empty($description)) {
        require 'conf/login_data.php';
        $echec;
        $success;
        $date_add = date('d/m/Y');
        $req = $loginData->prepare("UPDATE annonces SET descriptions= ?, maj = ? WHERE id_annonces = $rec2");
        $req->execute([$description, $date_add]);
        if ($req) {
            $_SESSION['update'] = "Votre annonce a été mise à jour";
            update();
            header("Location: mes_annonces.php");
        } else {
            $echec = 'Echec de la modification';
        }
    }
    if (isset($prix) && !empty($prix)) {
        require 'conf/login_data.php';
        $echec;
        $success;
        $date_add = date('d/m/Y');
        $req = $loginData->prepare("UPDATE annonces SET prix= ?, maj = ? WHERE id_annonces = $rec2");
        $req->execute([$prix, $date_add]);
        if ($req) {
            $_SESSION['update'] = "Votre annonce a été mise à jour";
            update();
            header("Location: mes_annonces.php");
        } else {
            $echec = 'Echec de la modification';
        }
    }
    if (isset($quartier) && !empty($quartier)) {
        require 'conf/login_data.php';
        $echec;
        $success;
        $date_add = date('d/m/Y');
        $req = $loginData->prepare("UPDATE annonces SET quartiers= ?, maj = ? WHERE id_annonces = $rec2");
        $req->execute([$quartier, $date_add]);
        if ($req) {
            $_SESSION['update'] = "Votre annonce a été mise à jour";
            update();
            header("Location: mes_annonces.php");
        } else {
            $echec = 'Echec de la modification';
        }
    }
    if (isset($ville) && !empty($ville)) {
        require 'conf/login_data.php';
        $echec;
        $success;
        $date_add = date('d/m/Y');
        $req = $loginData->prepare("UPDATE annonces SET villes= ?, maj = ? WHERE id_annonces = $rec2");
        $req->execute([$ville, $date_add]);
        if ($req) {
            $_SESSION['update'] = "Votre annonce a été mise à jour";
            update();
            header("Location: mes_annonces.php");
        } else {
            $echec = 'Echec de la modification';
        }
    }
    if (isset($option) && !empty($option)) {
        require 'conf/login_data.php';
        $echec;
        $success;
        $date_add = date('d/m/Y');
        $req = $loginData->prepare("UPDATE annonces SET options= ?, maj = ? WHERE id_annonces = $rec2");
        $req->execute([$option, $date_add]);
        if ($req) {
            $_SESSION['update'] = "Votre annonce a été mise à jour";
            update();
            header("Location: mes_annonces.php");
        } else {
            $echec = 'Echec de la modification';
        }
    }
    if (isset($destination) && !empty($destination)) {
        if (in_array($extension, $autoriser)) {
            if (move_uploaded_file($tmp_cover, $destination)) {
                require 'conf/login_data.php';
                $date_add = date('d/m/Y');
                $add = $loginData->prepare("UPDATE annonces SET img_cover= ?, maj = ? WHERE id_annonces = $rec2");
                $add->execute(array($destination, $date_add));
                if ($add) {
                    $_SESSION['update'] = "Votre annonce a été mise à jour";
                    update();
                    header("Location: mes_annonces.php");
                } else {
                    $echec = 'Echec de la modification';
                }
            } else {
                $errors = "échec du téléchargement veuillez rééssayer !";
            }
        }
    }
    if (isset($destination2) && !empty($destination2)) {
        if (in_array($extension2, $autoriser)) {
            if (move_uploaded_file($tmp_cover2, $destination2)) {
                require 'conf/login_data.php';
                $date_add = date('d/m/Y');
                $add = $loginData->prepare("UPDATE annonces SET photo_1= ?, maj = ? WHERE id_annonces = $rec2");
                $add->execute(array($destination2, $date_add));
                if ($add) {
                    $_SESSION['update'] = "Votre annonce a été mise à jour";
                    update();
                    header("Location: mes_annonces.php");
                } else {
                    $echec = 'Echec de la modification';
                }
            } else {
                $errors = "échec du téléchargement veuillez rééssayer !";
            }
        }
    }
    if (isset($destination3) && !empty($destination3)) {
        if (in_array($extension3, $autoriser)) {
            if (move_uploaded_file($tmp_cover3, $destination3)) {
                require 'conf/login_data.php';
                $date_add = date('d/m/Y');
                $add = $loginData->prepare("UPDATE annonces SET photo_2= ?, maj = ? WHERE id_annonces = $rec2");
                $add->execute(array($destination3, $date_add));
                if ($add) {
                    $_SESSION['update'] = "Votre annonce a été mise à jour";
                    header("Location: mes_annonces.php");
                } else {
                    $echec = 'Echec de la modification';
                }
            } else {
                $errors = "échec du téléchargement veuillez rééssayer !";
            }
        }
    }
    if (isset($destination4) && !empty($destination4)) {
        if (in_array($extension4, $autoriser)) {
            if (move_uploaded_file($tmp_cover4, $destination4)) {
                require 'conf/login_data.php';
                $date_add = date('d/m/Y');
                $add = $loginData->prepare("UPDATE annonces SET photo_3= ?, maj = ? WHERE id_annonces = $rec2");
                $add->execute(array($destination4, $date_add));
                if ($add) {
                    $_SESSION['update'] = "Votre annonce a été mise à jour";
                    update();
                    header("Location: mes_annonces.php");
                } else {
                    $echec = 'Echec de la modification';
                }
            } else {
                $errors = "échec du téléchargement veuillez rééssayer !";
            }
        }
    }
    if (isset($destination5) && !empty($destination5)) {
        if (in_array($extension5, $autoriser)) {
            if (move_uploaded_file($tmp_cover5, $destination5)) {
                require 'conf/login_data.php';
                $date_add = date('d/m/Y');
                $add = $loginData->prepare("UPDATE annonces SET photo_4= ?, maj = ? WHERE id_annonces = $rec2");
                $add->execute(array($destination5, $date_add));
                if ($add) {
                    $_SESSION['update'] = "Votre annonce a été mise à jour";
                    update();
                    header("Location: mes_annonces.php");
                } else {
                    $echec = 'Echec de la modification';
                }
            } else {
                $errors = "échec du téléchargement veuillez rééssayer !";
            }
        }
    }
    if (isset($destination6) && !empty($destination6)) {
        if (in_array($extension6, $autoriser)) {
            if (move_uploaded_file($tmp_cover6, $destination6)) {
                require 'conf/login_data.php';
                $date_add = date('d/m/Y');
                $add = $loginData->prepare("UPDATE annonces SET photo_5= ?, maj = ? WHERE id_annonces = $rec2");
                $add->execute(array($destination6, $date_add));
                if ($add) {
                    $_SESSION['update'] = "Votre annonce a été mise à jour";
                    update();
                    header("Location: mes_annonces.php");
                } else {
                    $echec = 'Echec de la modification';
                }
            } else {
                $errors = "échec du téléchargement veuillez rééssayer !";
            }
        }
    }
    if (isset($destination7) && !empty($destination7)) {
        if (in_array($extension7, $autoriser)) {
            if (move_uploaded_file($tmp_cover7, $destination7)) {
                require 'conf/login_data.php';
                $date_add = date('d/m/Y');
                $add = $loginData->prepare("UPDATE annonces SET photo_6= ?, maj = ? WHERE id_annonces = $rec2");
                $add->execute(array($destination7, $date_add));
                if ($add) {
                    $_SESSION['update'] = "Votre annonce a été mise à jour";
                    update();
                    header("Location: mes_annonces.php");
                } else {
                    $echec = 'Echec de la modification';
                }
            } else {
                $errors = "échec du téléchargement veuillez rééssayer !";
            }
        }
    }
}
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
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500&family=Open+Sans:wght@300;400&display=swap" rel="stylesheet"> <!-- title bar icon -->
    <link rel="shortcut icon" type="imge/x-icon" href="img/title-bar-icon.png">
    <link rel="stylesheet" href="style.css">
    <title>Modifier votre annonce</title>
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

    <div class="container-fluid-xs container-xxl pd">
        <div class="row">
            <?php include "header_contact.php" ?>
            <?php include "logo_menu.php" ?>

            <form action="" method="POST" enctype="multipart/form-data" class="forms2 col-sm-12 col-md-8 col-lg-7 col-xl-6">

                <!-- add_annonces -->
                <div class="container   page" id="page1">
                    <h3 class="mb-4">Modifier votre annonce</h3>
                    <?php if (!empty($success)) : ?>
                        <p class="alert alert-success text-center">
                            <?= $success ?>
                        </p>
                    <?php endif; ?>
                    <div class="form-group col-xs px-4 py-3 mb-3 col-md-8"><label for="" class=" form-label">Etat :</label><br />
                    <div class="form-check form-check-inline"><input class="form-check-input" type="radio" name="etat" id="dispob" value="Bientôt disponible" <?php if ($data['etat'] == "Bientôt disponible") {
                                                                                                                                                                echo "checked";
                                                                                                                                                            } ?>>
                            <label class="form-check-label" for="dispob">Bientôt disponible</label>
                        </div>
                        <div class="form-check form-check-inline"><input class="form-check-input" type="radio" name="etat" id="dispo" value="Disponible" <?php if ($data['etat'] == "Disponible") {
                                                                                                                                                                echo "checked";
                                                                                                                                                            } ?>>
                            <label class="form-check-label" for="dispo">Disponible</label>
                        </div>
                        <div class="form-check form-check-inline"><input class="form-check-input" type="radio" name="etat" id="occ" value="Occupé" <?php if ($data['etat'] == "Occupé") {
                                                                                                                                                        echo "checked";
                                                                                                                                                    } ?>><label class="form-check-label" for="occ">Occupé</label>
                        </div>
                        <div class="para-alert2">
                            <?php if (!empty($errors_etat)) : ?>
                                <p class=" text-danger text-start">
                                    <?= $errors_etat ?>
                                </p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group col-xs px-4 py-3 mb-3 col-md-8"><label for="" class=" form-label">Catégorie :</label><br />
                        <div class="form-check form-check-inline"><input class="form-check-input" type="radio" name="categorie" id="categorie-achat" value="achat" <?php if ($data['categories'] == "achat") {
                                                                                                                                                                        echo "checked";
                                                                                                                                                                    } ?>>
                            <label class="form-check-label" for="categorie-achat">Vente</label>
                        </div>
                        <div class="form-check form-check-inline"><input class="form-check-input" type="radio" name="categorie" id="location" value="location" <?php if ($data['categories'] == "location") {
                                                                                                                                                                    echo "checked";
                                                                                                                                                                } ?>><label class="form-check-label" for="location">Location</label>
                        </div>
                        <div class="para-alert2">
                            <?php if (!empty($errors_categorie)) : ?>
                                <p class=" text-danger text-start">
                                    <?= $errors_categorie ?>
                                </p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group col-xs px-4 py-3 mb-3 col-md-8"><label for="" class=" form-label">Type :</label><select class="form-select form-select-lg" name="type">
                            <option selected disabled>Types</option>
                            <option value="Appartement" <?php if ($data['types'] == "Appartement") {
                                                            echo "selected";
                                                        } ?>>
                                Appartement</option>
                            <option value="Bureau" <?php if ($data['types'] == "Bureau") {
                                                        echo "selected";
                                                    } ?>>
                                Bureau</option>
                                <option value="Chalet" <?php if ($data['types'] == "Chalet") {
                                                        echo "selected";
                                                    } ?>>
                                Chalet</option>
                            <option value="Chambre" <?php if ($data['types'] == "Chambre") {
                                                        echo "selected";
                                                    } ?>>
                                Chambre</option>
                            <option value="Duplex" <?php if ($data['types'] == "Duplex") {
                                                        echo "selected";
                                                    } ?>>
                                Duplex</option>
                                <option value="Ferme" <?php if ($data['types'] == "Ferme") {
                                                        echo "selected";
                                                    } ?>>
                                Ferme</option>
                            <option value="Entrepôt" <?php if ($data['types'] == "Entrepôt") {
                                                        echo "selected";
                                                    } ?>>
                                Entrepôt</option>
                            <option value="Hôtel" <?php if ($data['types'] == "Hôtel") {
                                                        echo "selected";
                                                    } ?>>
                                Hôtel</option>
                            <option value="Immeuble" <?php if ($data['types'] == "Immeuble") {
                                                            echo "selected";
                                                        } ?>>
                                Immeuble</option>
                            <option value="Local" <?php if ($data['types'] == "Local") {
                                                        echo "selected";
                                                    } ?>>
                                Local</option>
                                <option value="Loft" <?php if ($data['types'] == "Loft") {
                                                        echo "selected";
                                                    } ?>>
                                Loft</option>
                            <option value="Studio" <?php if ($data['types'] == "Studio") {
                                                        echo "selected";
                                                    } ?>>Studio</option>
                            
                            <option value="Terrain" <?php if ($data['types'] == "Terrain") {
                                                        echo "selected";
                                                    } ?>>
                                Terrain</option>
                                <option value="Triplex" <?php if ($data['types'] == "Triplex") {
                                                        echo "selected";
                                                    } ?>>
                                Triplex</option>
                            <option value="Villa" <?php if ($data['types'] == "Villa") {
                                                        echo "selected";
                                                    } ?>>
                                Villa</option>
                        </select>
                        <div class="para-alert2">
                            <?php if (!empty($errors_types)) : ?>
                                <p class=" text-danger text-start">
                                    <?= $errors_type ?>
                                </p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group col-xs px-4 py-3 mb-3 col-md-8"><label for="" class=" form-label">Titre :</label><input type="text" style="text-transform:capitalize;" value="<?= $data['titres'] ?>" name="titre" class="form-control" />
                        <div class="para-alert2">
                            <?php if (!empty($errors_titre)) : ?>
                                <p class=" text-danger text-start">
                                    <?= $errors_titre ?>
                                </p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group col-xs px-4 py-3 mb-3 col-md-8"><label for="" class=" form-label">Description :</label><textarea style="text-transform:capitalize;" class=" form-control" rows="5" id="comment" name="description">
                            <?= $data['descriptions'] ?></textarea>
                        <div class="para-alert2">
                            <?php if (!empty($errors_description)) : ?>
                                <p class=" text-danger text-start">
                                    <?= $errors_description ?>
                                </p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group col-xs px-4 py-3 mb-3 col-md-8"><label for="" class=" form-label">Prix :</label><input type="text" value="<?= $data['prix'] ?>" name="prix" class="form-control" />
                        <div class="para-alert2">
                            <?php if (!empty($errors_prix)) : ?>
                                <p class=" text-danger text-start">
                                    <?= $errors_prix ?>
                                </p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <!-- periode -->
                    <div class="form-group col-xs px-4 py-3 mb-3 col-md-8">
                        <label for="" class=" form-label">Périodes :</label><br />

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="periode" id="jour" value="jour" <?php if ($data['periode'] == "Jour") {
                                                                                                                    echo "checked";
                                                                                                                } ?>>
                            <label class="form-check-label" for="dispo">Jour</label>
                        </div>

                        <div class="form-check form-check-inline"><input class="form-check-input" type="radio" name="periode" id="semaine" value="Semaine" <?php if ($data['periode'] == "Semaine") {
                                                                                                                                                                echo "checked";
                                                                                                                                                            } ?>><label class="form-check-label" for="semaine">Semaine</label>
                        </div>

                        <div class="form-check form-check-inline"><input class="form-check-input" type="radio" name="periode" id="mois" value="Mois" <?php if ($data['periode'] == "Mois") {
                                                                                                                                                            echo "checked";
                                                                                                                                                        } ?>><label class="form-check-label" for="mois">Mois</label>
                        </div>

                        <div class="para-alert2 mb-5">
                            <?php if (!empty($errors_periode)) : ?>
                                <p class=" text-danger text-start">
                                    <?= $errors_periode ?>
                                </p>
                            <?php endif; ?>
                        </div>
                        <div class="form-check form-check-inline"><input class="form-check-input" type="radio" name="periode" id="autre" value="-" <?php if ($data['periode'] == "-") {
                                                                                                                                                            echo "checked";
                                                                                                                                                        } ?>><label class="form-check-label" for="autre">Autre</label>
                        </div>

                        <div class="para-alert2 mb-5">
                            <?php if (!empty($errors_periode)) : ?>
                                <p class=" text-danger text-start">
                                    <?= $errors_periode ?>
                                </p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group col-xs px-4 py-3 mb-3 col-md-8">
                        <div class="row">
                            <div class="col-12">
                                <label for="" class=" form-label text-dark ">Photos : Une annonce avec des photos
                                    est
                                    plus de
                                    fois consultée qu'une
                                    annonce sans photos</label>
                            </div>
                            <?php if (!empty($errors_photo)) : ?>
                                <p class=" text-danger text-start">
                                    <?= $errors_photo ?>
                                </p>
                            <?php endif; ?>
                            <div class="form">
                                <div class="grid">

                                    <div class="form-element">
                                        <input type="file" id="file-1" accept="image/*" name="cover">
                                        <label for="file-1" id="file-1-preview">
                                            <img src="<?= $data['img_cover'] ?>" alt="">
                                            <div>
                                                <span>+</span>
                                            </div>
                                        </label>
                                    </div>
                                    <div class="form-element">
                                        <input type="file" id="file-2" accept="image/*" name="cover2">
                                        <label for="file-2" id="file-2-preview">
                                            <img src="<?= $data['photo_1'] ?>" alt="">
                                            <div>
                                                <span>+</span>
                                            </div>
                                        </label>
                                    </div>
                                    <div class="form-element">
                                        <input type="file" id="file-3" accept="image/*" name="cover3">
                                        <label for="file-3" id="file-3-preview">
                                            <img src="<?= $data['photo_2'] ?>" alt="">
                                            <div>
                                                <span>+</span>
                                            </div>
                                        </label>
                                    </div>
                                    <div class="form-element">
                                        <input type="file" id="file-4" accept="image/*" name="cover4">
                                        <label for="file-4" id="file-4-preview">
                                            <?php if(empty($data['photo_3'])) :?>
                                            <img src="https://bit.ly/3ubuq5o" alt="">
                                            <?php else :?>
                                            <img src="<?= $data['photo_3'] ?>" alt="">
                                            <?php endif; ?>
                                            <div>
                                                <span>+</span>
                                            </div>
                                        </label>
                                    </div>
                                    <div class="form-element">
                                        <input type="file" id="file-5" accept="image/*" name="cover5">
                                        <label for="file-5" id="file-5-preview">
                                        <?php if(empty($data['photo_4'])) :?>
                                            <img src="https://bit.ly/3ubuq5o" alt="">
                                            <?php else :?>
                                            <img src="<?= $data['photo_4'] ?>" alt="">
                                            <?php endif; ?>
                                            <div>
                                                <span>+</span>
                                            </div>
                                        </label>
                                    </div>
                                    <div class="form-element">
                                        <input type="file" id="file-6" accept="image/*" name="cover6">
                                        <label for="file-6" id="file-6-preview">
                                        <?php if(empty($data['photo_5'])) :?>
                                            <img src="https://bit.ly/3ubuq5o" alt="">
                                            <?php else :?>
                                            <img src="<?= $data['photo_5'] ?>" alt="">
                                            <?php endif; ?>
                                            <div>
                                                <span>+</span>
                                            </div>
                                        </label>
                                    </div>
                                    <div class="form-element">
                                        <input type="file" id="file-7" accept="image/*" name="cover7">
                                        <label for="file-7" id="file-7-preview">
                                        <?php if(empty($data['photo_6'])) :?>
                                            <img src="https://bit.ly/3ubuq5o" alt="">
                                            <?php else :?>
                                            <img src="<?= $data['photo_6'] ?>" alt="">
                                            <?php endif; ?>
                                            <div>
                                                <span>+</span>
                                            </div>
                                        </label>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="row row-add ">

                        </div>
                    </div>
                    <div class="form-group col-xs px-4 py-3 mb-4 col-md-8"><label for="" class=" form-label">Ville :</label>
                        <select id="inputState" name="ville" class="form-select">
                            <option value="Dakar" <?php if ($data['villes'] == "Dakar") {
                                                        echo "selected";
                                                    } ?>>Dakar</option>
                            <option value="Diourbel" <?php if ($data['villes'] == "Diourbel") {
                                                            echo "selected";
                                                        } ?>>Diourbel</option>
                            <option value="Fatick" <?php if ($data['villes'] == "Fatick") {
                                                        echo "selected";
                                                    } ?>>Fatick</option>
                            <option value="Kaffrine" <?php if ($data['villes'] == "Kaffrine") {
                                                            echo "selected";
                                                        } ?>>Kaffrine</option>
                            <option value="Kaolack" <?php if ($data['villes'] == "Kaolack") {
                                                        echo "selected";
                                                    } ?>>Kaolack</option>
                            <option value="Kédougou" <?php if ($data['villes'] == "Kédougou") {
                                                            echo "selected";
                                                        } ?>>Kédougou</option>
                            <option value="Kolda" <?php if ($data['villes'] == "Kolda") {
                                                        echo "selected";
                                                    } ?>>Kolda</option>
                            <option value="Louga" <?php if ($data['villes'] == "Louga") {
                                                        echo "selected";
                                                    } ?>>Louga</option>
                            <option value="Matam" <?php if ($data['villes'] == "Matam") {
                                                        echo "selected";
                                                    } ?>>Matam</option>
                            <option value="Saint-Louis" <?php if ($data['villes'] == "Saint-Louis") {
                                                            echo "selected";
                                                        } ?>>Saint-Louis</option>
                            <option value="Sédhiou" <?php if ($data['villes'] == "Sédhiou") {
                                                        echo "selected";
                                                    } ?>>Sédhiou</option>
                            <option value="Tambacounda" <?php if ($data['villes'] == "Tambacounda") {
                                                            echo "selected";
                                                        } ?>>Tambacounda</option>
                            <option value="Thiès" <?php if ($data['villes'] == "Thiès") {
                                                        echo "selected";
                                                    } ?>>Thiès</option>
                            <option value="Ziguinchor" <?php if ($data['villes'] == "Ziguinchor") {
                                                            echo "selected";
                                                        } ?>>Ziguinchor</option>
                        </select>
                    </div>
                    <div class="form-group col-xs px-4 py-3 mb-3 col-md-8"><label for="" class=" form-label">Quartier :</label><select id="inputState" name="quartier" class="form-select">
                            <optgroup label="Dakar">
                                <option value="Amitié" <?php if ($data['quartiers'] == "Amitié") {
                                                            echo "selected";
                                                        } ?>>Amitié</option>
                                <option value="Almadies" <?php if ($data['quartiers'] == "Almadies") {
                                                                echo "selected";
                                                            } ?>>Almadies</option>
                                <option value="Almadies 2" <?php if ($data['quartiers'] == "Almadies 2") {
                                                                echo "selected";
                                                            } ?>>Almadies 2</option>
                                <option value="Bambilor" <?php if ($data['quartiers'] == "Bambilor") {
                                                                echo "selected";
                                                            } ?>>Bamilor</option>
                                <option value="Bargny" <?php if ($data['quartiers'] == "Bargny") {
                                                            echo "selected";
                                                        } ?>>Bargny</option>
                                <option value="Bel air" <?php if ($data['quartiers'] == "Bel air") {
                                                            echo "selected";
                                                        } ?>>Bel air</option>
                                <option value="Biscuiterie" <?php if ($data['quartiers'] == "Biscuiterie") {
                                                                echo "selected";
                                                            } ?>>Biscuiterie</option>
                                <option value="Baobab" <?php if ($data['quartiers'] == "Baobab") {
                                                            echo "selected";
                                                        } ?>>Baobab</option>
                                <option value="Cambérène" <?php if ($data['quartiers'] == "Cambérène") {
                                                                echo "selected";
                                                            } ?>>Cambérène</option>
                                <option value="Castors" <?php if ($data['quartiers'] == "Castors") {
                                                            echo "selected";
                                                        } ?>>Castors</option>
                                <option value="Cité asecna" <?php if ($data['quartiers'] == "Cité asecna") {
                                                                echo "selected";
                                                            } ?>>Cité asecna</option>
                                <option value="Cité assemblée" <?php if ($data['quartiers'] == "Cité assemblée") {
                                                                    echo "selected";
                                                                } ?>>Cité assemblée</option>
                                <option value="Cité avion" <?php if ($data['quartiers'] == "Cité avion") {
                                                                echo "selected";
                                                            } ?>>Cité avion</option>
                                <option value="Cité batrain" <?php if ($data['quartiers'] == "Cité batrain") {
                                                                    echo "selected";
                                                                } ?>>Cité Batrain</option>
                                <option value="Cité biagui" <?php if ($data['quartiers'] == "Cité biagui") {
                                                                echo "selected";
                                                            } ?>>Cité Biagui</option>
                                <option value="Cité damel" <?php if ($data['quartiers'] == "Cité damel") {
                                                                echo "selected";
                                                            } ?>>Cité Damel</option>
                                <option value="Cité djily mbaye" <?php if ($data['quartiers'] == "Cité djily mbaye") {
                                                                        echo "selected";
                                                                    } ?>>Cité Djily Mbaye</option>
                                <option value="Cité keur gorgui" <?php if ($data['quartiers'] == "Cité keur gorgui") {
                                                                        echo "selected";
                                                                    } ?>>Cité Keur Gorgui</option>
                                <option value="Cité mixta" <?php if ($data['quartiers'] == "Cité mixta") {
                                                                echo "selected";
                                                            } ?>>Cité mixta</option>
                                <option value="Colobane" <?php if ($data['quartiers'] == "Colobane") {
                                                                echo "selected";
                                                            } ?>>Colobane</option>
                                <option value="Comico" <?php if ($data['quartiers'] == "Comico") {
                                                            echo "selected";
                                                        } ?>>comico</option>
                                <option value="Dalifort" <?php if ($data['quartiers'] == "Dalifort") {
                                                                echo "selected";
                                                            } ?>>Dalifort</option>
                                <option value="Derkle" <?php if ($data['quartiers'] == "Derkle") {
                                                            echo "selected";
                                                        } ?>>Derkle</option>
                                <option value="Diamaguene" <?php if ($data['quartiers'] == "Diamaguene") {
                                                                echo "selected";
                                                            } ?>>Diamaguene</option>
                                <option value="Diamniadio" <?php if ($data['quartiers'] == "Diamniadio") {
                                                                echo "selected";
                                                            } ?>>Diamniadio</option>
                                <option value="Dieuppeul" <?php if ($data['quartiers'] == "Dieuppeul") {
                                                                echo "selected";
                                                            } ?>>Dieuppeul</option>
                                <option value="Djidah thiaroye kaw" <?php if ($data['quartiers'] == "Djidah thiaroye kaw") {
                                                                        echo "selected";
                                                                    } ?>>Djidah thiaroye kaw</option>
                                <option value="Djily mbaye" <?php if ($data['quartiers'] == "Djily mbaye") {
                                                                echo "selected";
                                                            } ?>>Djily mbaye</option>
                                <option value="Fann" <?php if ($data['quartiers'] == "Fann") {
                                                            echo "selected";
                                                        } ?>>Fann</option>
                                <option value="Fann hock" <?php if ($data['quartiers'] == "Fann hock") {
                                                                echo "selected";
                                                            } ?>>Fann Hock</option>
                                <option value="Fann résidence" <?php if ($data['quartiers'] == "Fann résidence") {
                                                                    echo "selected";
                                                                } ?>>Fann Résidence</option>
                                <option value="Fass" <?php if ($data['quartiers'] == "Fass") {
                                                            echo "selected";
                                                        } ?>>Fass</option>
                                <option value="Fenêtre mermoz" <?php if ($data['quartiers'] == "Fenêtre mermoz") {
                                                                    echo "selected";
                                                                } ?>>Fenêtre mermoz</option>
                                <option value="Gibraltar" <?php if ($data['quartiers'] == "Gibraltar") {
                                                                echo "selected";
                                                            } ?>>Gibraltar</option>
                                <option value="Golf" <?php if ($data['quartiers'] == "Golf") {
                                                            echo "selected";
                                                        } ?>>Golf</option>
                                <option value="Gorom" <?php if ($data['quartiers'] == "Gorom") {
                                                            echo "selected";
                                                        } ?>>Gorom</option>
                                <option value="Gorée" <?php if ($data['quartiers'] == "Gorée") {
                                                            echo "selected";
                                                        } ?>>Gorée</option>
                                <option value="Grand dakar" <?php if ($data['quartiers'] == "Grand dakar") {
                                                                echo "selected";
                                                            } ?>>Grand Dakar</option>
                                <option value="Grand yoff" <?php if ($data['quartiers'] == "Grand yoff") {
                                                                echo "selected";
                                                            } ?>>Grand yoff</option>
                                <option value="Guediawaye" <?php if ($data['quartiers'] == "Guediawaye") {
                                                                echo "selected";
                                                            } ?>>Guediawaye</option>
                                <option value="Gueule-tapée" <?php if ($data['quartiers'] == "Gueule-tapée") {
                                                                    echo "selected";
                                                                } ?>>Gueule-tapée</option>
                                <option value="Guinaw rail" <?php if ($data['quartiers'] == "Guinaw rail") {
                                                                echo "selected";
                                                            } ?>>Guinaw rail</option>
                                <option value="Hann bel-air" <?php if ($data['quartiers'] == "Hann bel-air") {
                                                                    echo "selected";
                                                                } ?>>Hann Bel-Air</option>
                                <option value="Hann marinas" <?php if ($data['quartiers'] == "Hann marinas") {
                                                                    echo "selected";
                                                                } ?>>Hann marinas</option>
                                <option value="Hann maristes" <?php if ($data['quartiers'] == "Hann maristes") {
                                                                    echo "selected";
                                                                } ?>>Hann Maristes</option>
                                <option value="Hlm" <?php if ($data['quartiers'] == "Hlm") {
                                                        echo "selected";
                                                    } ?>>Hlm</option>
                                <option value="Hlm grand-yoff" <?php if ($data['quartiers'] == "Hlm grand-yoff") {
                                                                    echo "selected";
                                                                } ?>>Hlm grand-yoff</option>
                                <option value="Karack" <?php if ($data['quartiers'] == "Karack") {
                                                            echo "selected";
                                                        } ?>>Karack</option>
                                <option value="Keur massar" <?php if ($data['quartiers'] == "Keur massar") {
                                                                echo "selected";
                                                            } ?>>Keur Massar</option>
                                <option value="Keur ndiaye lô" <?php if ($data['quartiers'] == "Keur ndiaye lô") {
                                                                    echo "selected";
                                                                } ?>>Keur ndiaye lô</option>
                                <option value="Kounoune" <?php if ($data['quartiers'] == "Kounoune") {
                                                                echo "selected";
                                                            } ?>>Kounoune</option>
                                <option value="Lac rose" <?php if ($data['quartiers'] == "Lac rose") {
                                                                echo "selected";
                                                            } ?>>Lac rose</option>
                                <option value="Liberté 1" <?php if ($data['quartiers'] == "Liberté 1") {
                                                                echo "selected";
                                                            } ?>>Liberté 1</option>
                                <option value="Liberté 2" <?php if ($data['quartiers'] == "Liberté 2") {
                                                                echo "selected";
                                                            } ?>>Liberté 2</option>
                                <option value="Liberté 3" <?php if ($data['quartiers'] == "Liberté 3") {
                                                                echo "selected";
                                                            } ?>>Liberté 3</option>
                                <option value="Liberté 4" <?php if ($data['quartiers'] == "Liberté 4") {
                                                                echo "selected";
                                                            } ?>>Liberté 4</option>
                                <option value="Liberté 5" <?php if ($data['quartiers'] == "Liberté 5") {
                                                                echo "selected";
                                                            } ?>>Liberté 5</option>
                                <option value="Liberté 6" <?php if ($data['quartiers'] == "Liberté 6") {
                                                                echo "selected";
                                                            } ?>>Liberté 6</option>
                                <option value="Liberté 6 extension" <?php if ($data['quartiers'] == "Liberté 6 extension") {
                                                                        echo "selected";
                                                                    } ?>>Liberté 6 extension</option>
                                <option value="Malika" <?php if ($data['quartiers'] == "Malika") {
                                                            echo "selected";
                                                        } ?>>Malika</option>
                                <option value="Mamelles" <?php if ($data['quartiers'] == "Mamelles") {
                                                                echo "selected";
                                                            } ?>>Mamelles</option>
                                <option value="Mbao" <?php if ($data['quartiers'] == "Mbao") {
                                                            echo "selected";
                                                        } ?>>Mbao</option>
                                <option value="Mermoz" <?php if ($data['quartiers'] == "Mermoz") {
                                                            echo "selected";
                                                        } ?>>Mermoz</option>
                                <option value="Médina" <?php if ($data['quartiers'] == "Médina") {
                                                            echo "selected";
                                                        } ?>>Médina</option>
                                <option value="Ndiakhirate" <?php if ($data['quartiers'] == "Ndiakhirate") {
                                                                echo "selected";
                                                            } ?>>Ndiakhirate</option>
                                <option value="Ngor" <?php if ($data['quartiers'] == "Ngor") {
                                                            echo "selected";
                                                        } ?>>Ngor</option>
                                <option value="Niague" <?php if ($data['quartiers'] == "Niague") {
                                                            echo "selected";
                                                        } ?>>Niague</option>
                                <option value="Niakoul rap" <?php if ($data['quartiers'] == "Niakoul rap") {
                                                                echo "selected";
                                                            } ?>>Niakoul rap</option>
                                <option value="Niarry tally" <?php if ($data['quartiers'] == "Niarry tally") {
                                                                    echo "selected";
                                                                } ?>>Niarry Tally</option>
                                <option value="Nord foire" <?php if ($data['quartiers'] == "Nord foire") {
                                                                echo "selected";
                                                            } ?>>Nord Foire</option>
                                <option value="Ouakam" <?php if ($data['quartiers'] == "Ouakam") {
                                                            echo "selected";
                                                        } ?>>Ouakam</option>
                                <option value="Ouest foire" <?php if ($data['quartiers'] == "Ouest foire") {
                                                                echo "selected";
                                                            } ?>>Ouest Foire</option>
                                <option value="Parcelles assainies" <?php if ($data['quartiers'] == "Parcelles assainies") {
                                                                        echo "selected";
                                                                    } ?>>Parcelles Assainies</option>
                                <option value="Patte d'oie" <?php if ($data['quartiers'] == "Patte d'oie") {
                                                                echo "selected";
                                                            } ?>>Patte d'oie</option>
                                <option value="Pikine" <?php if ($data['quartiers'] == "Pikine") {
                                                            echo "selected";
                                                        } ?>>Pikine</option>
                                <option value="Plateau" <?php if ($data['quartiers'] == "Plateau") {
                                                            echo "selected";
                                                        } ?>>Plateau</option>
                                <option value="Point E" <?php if ($data['quartiers'] == "Point E") {
                                                            echo "selected";
                                                        } ?>>Point E</option>
                                <option value="Rufisque" <?php if ($data['quartiers'] == "Rufisque") {
                                                                echo "selected";
                                                            } ?>>Rufisque</option>
                                <option value="Sacré coeur" <?php if ($data['quartiers'] == "Sacré coeur") {
                                                                echo "selected";
                                                            } ?>>Sacré Coeur</option>
                                <option value="Sangalkam" <?php if ($data['quartiers'] == "Sangalkam") {
                                                                echo "selected";
                                                            } ?>>Sangalkam</option>
                                <option value="Sebikotane" <?php if ($data['quartiers'] == "Sebikotane") {
                                                                echo "selected";
                                                            } ?>>Sebikotane</option>
                                <option value="Sendou" <?php if ($data['quartiers'] == "Sendou") {
                                                            echo "selected";
                                                        } ?>>Sendou</option>
                                <option value="Scat urban" <?php if ($data['quartiers'] == "Scat urban") {
                                                                echo "selected";
                                                            } ?>>Scat urban</option>
                                <option value="Sicap liberté" <?php if ($data['quartiers'] == "Sicap liberté") {
                                                                    echo "selected";
                                                                } ?>>Sicap Liberté</option>
                                <option value="Sicap sacré coeur" <?php if ($data['quartiers'] == "Sicap sacré coeur") {
                                                                        echo "selected";
                                                                    } ?>>Sicap sacré coeur</option>
                                <option value="Sicap baobab" <?php if ($data['quartiers'] == "Sicap baobab") {
                                                                    echo "selected";
                                                                } ?>>Sicap baobab</option>
                                <option value="Sicap foire" <?php if ($data['quartiers'] == "Sicap foire") {
                                                                echo "selected";
                                                            } ?>>Sicap foire</option>
                                <option value="Sicap mbao" <?php if ($data['quartiers'] == "Sicap mbao") {
                                                                echo "selected";
                                                            } ?>>Sicap mbao</option>
                                <option value="Siprés" <?php if ($data['quartiers'] == "Siprés") {
                                                            echo "selected";
                                                        } ?>>Siprés</option>
                                <option value="Sud foire" <?php if ($data['quartiers'] == "Sud foire") {
                                                                echo "selected";
                                                            } ?>>Sud foire</option>
                                <option value="Thiaroye" <?php if ($data['quartiers'] == "Thiaroye") {
                                                                echo "selected";
                                                            } ?>>Thiaroye</option>
                                <option value="Thongor" <?php if ($data['quartiers'] == "Thongor") {
                                                            echo "selected";
                                                        } ?>>Thongor</option>
                                <option value="Tivaounane peulh" <?php if ($data['quartiers'] == "Tivaounane peulh") {
                                                                        echo "selected";
                                                                    } ?>>Tivaounane peulh</option>
                                <option value="Toubab dialao" <?php if ($data['quartiers'] == "Toubab dialao") {
                                                                    echo "selected";
                                                                } ?>>Toubab Dialao</option>
                                <option value="Vdn" <?php if ($data['quartiers'] == "Vdn") {
                                                        echo "selected";
                                                    } ?>>VDN</option>
                                <option value="Virage" <?php if ($data['quartiers'] == "Virage") {
                                                            echo "selected";
                                                        } ?>>Virage</option>
                                <option value="Yene" <?php if ($data['quartiers'] == "Yene") {
                                                            echo "selected";
                                                        } ?>>Yene</option>
                                <option value="Yeumbeul" <?php if ($data['quartiers'] == "Yeumbeul") {
                                                                echo "selected";
                                                            } ?>>Yeumbeul</option>
                                <option value="Yoff" <?php if ($data['quartiers'] == "Yoff") {
                                                            echo "selected";
                                                        } ?>>Yoff</option>
                                <option value="Zac mbao" <?php if ($data['quartiers'] == "Zac mbao") {
                                                                echo "selected";
                                                            } ?>>Zac mbao</option>
                                <option value="Zone de captage" <?php if ($data['quartiers'] == "Zone de captage") {
                                                                    echo "selected";
                                                                } ?>>Zone de Captage</option>
                                <option value="Zone industrielle" <?php if ($data['quartiers'] == "Zone industrielle") {
                                                                        echo "selected";
                                                                    } ?>>Zone industrielle</option>
                            </optgroup>
                            <optgroup label="Diourbel">
                                <option value="Bambey" <?php if ($data['quartiers'] == "Bambey") {
                                                            echo "selected";
                                                        } ?>>Bambey</option>
                                <option value="Diourbel" <?php if ($data['quartiers'] == "Diourbel") {
                                                                echo "selected";
                                                            } ?>>Diourbel</option>
                                <option value="Mbacke" <?php if ($data['quartiers'] == "Mbacke") {
                                                            echo "selected";
                                                        } ?>>Mbacke</option>
                            </optgroup>
                            <optgroup label="Fatick">
                                <option value="Diofior" <?php if ($data['quartiers'] == "Diofior") {
                                                            echo "selected";
                                                        } ?>>Diofior</option>
                                <option value="Fatick" <?php if ($data['quartiers'] == "Fatick") {
                                                            echo "selected";
                                                        } ?>>Fatick</option>
                                <option value="Foundiougne" <?php if ($data['quartiers'] == "Foundiougne") {
                                                                echo "selected";
                                                            } ?>>Foundiougne</option>
                                <option value="Gossas" <?php if ($data['quartiers'] == "Gossas") {
                                                            echo "selected";
                                                        } ?>>Gossas</option>
                                <option value="Karang poste" <?php if ($data['quartiers'] == "Karang poste") {
                                                                    echo "selected";
                                                                } ?>>Karang poste</option>
                                <option value="Passi" <?php if ($data['quartiers'] == "Passi") {
                                                            echo "selected";
                                                        } ?>>Passi</option>
                                <option value="Sokone" <?php if ($data['quartiers'] == "Sokone") {
                                                            echo "selected";
                                                        } ?>>Sokone</option>
                                <option value="Soum" <?php if ($data['quartiers'] == "Soum") {
                                                            echo "selected";
                                                        } ?>>Soum</option>
                            </optgroup>
                            <optgroup label="Kaffrine">
                                <option value="Birkilane" <?php if ($data['quartiers'] == "Birkilane") {
                                                                echo "selected";
                                                            } ?>>Birkilane</option>
                                <option value="Kaffrine" <?php if ($data['quartiers'] == "Kaffrine") {
                                                                echo "selected";
                                                            } ?>>Kaffrine</option>
                                <option value="Koungheul" <?php if ($data['quartiers'] == "Koungheul") {
                                                                echo "selected";
                                                            } ?>>Koungheul</option>
                                <option value="Mabo" <?php if ($data['quartiers'] == "Mabo") {
                                                            echo "selected";
                                                        } ?>>Mabo</option>
                                <option value="Malem hodar" <?php if ($data['quartiers'] == "Malem hodar") {
                                                                echo "selected";
                                                            } ?>>Malem hodar</option>
                                <option value="Nganda" <?php if ($data['quartiers'] == "Nganda") {
                                                            echo "selected";
                                                        } ?>>Nganda</option>
                            </optgroup>
                            <optgroup label="Kaolack">
                                <option value="Fass" <?php if ($data['quartiers'] == "Fass") {
                                                            echo "selected";
                                                        } ?>>Fass</option>
                                <option value="Gandiaye" <?php if ($data['quartiers'] == "Gandiaye") {
                                                                echo "selected";
                                                            } ?>>Gandiaye</option>
                                <option value="Guinguineo" <?php if ($data['quartiers'] == "Guinguineo") {
                                                                echo "selected";
                                                            } ?>>Guinguineo</option>
                                <option value="Kahone" <?php if ($data['quartiers'] == "Kahone") {
                                                            echo "selected";
                                                        } ?>>Kahone</option>
                                <option value="Kaolack" <?php if ($data['quartiers'] == "Kaolack") {
                                                            echo "selected";
                                                        } ?>>Kaolack</option>
                                <option value="Keur madiabel" <?php if ($data['quartiers'] == "Keur madiabel") {
                                                                    echo "selected";
                                                                } ?>>Keur madiabel</option>
                                <option value="Mboss" <?php if ($data['quartiers'] == "Mboss") {
                                                            echo "selected";
                                                        } ?>>Mboss</option>
                                <option value="Ndoffane" <?php if ($data['quartiers'] == "Ndoffane") {
                                                                echo "selected";
                                                            } ?>>Ndoffane</option>
                                <option value="Nioro du rip" <?php if ($data['quartiers'] == "Nioro du rip") {
                                                                    echo "selected";
                                                                } ?>>Nioro du rip</option>
                                <option value="Sibassor" <?php if ($data['quartiers'] == "Sibassor") {
                                                                echo "selected";
                                                            } ?>>Sibassor</option>
                            </optgroup>
                            <optgroup label="Kédougou">
                                <option value="Kedougou" <?php if ($data['quartiers'] == "Kedougou") {
                                                                echo "selected";
                                                            } ?>>Kedougou</option>
                                <option value="Salemata" <?php if ($data['quartiers'] == "Salemata") {
                                                                echo "selected";
                                                            } ?>>Salemata</option>
                                <option value="Saraya" <?php if ($data['quartiers'] == "Saraya") {
                                                            echo "selected";
                                                        } ?>>Saraya</option>
                            </optgroup>
                            <optgroup label="Kolda">
                                <option value="Dabo" <?php if ($data['quartiers'] == "Dabo") {
                                                            echo "selected";
                                                        } ?>>Dabo</option>
                                <option value="Diaobe kabendou" <?php if ($data['quartiers'] == "Diaobe kabendou") {
                                                                    echo "selected";
                                                                } ?>>Diaobe kabendou</option>
                                <option value="Kolda" <?php if ($data['quartiers'] == "Kolda") {
                                                            echo "selected";
                                                        } ?>>Kolda</option>
                                <option value="Kounkane" <?php if ($data['quartiers'] == "Kounkane") {
                                                                echo "selected";
                                                            } ?>>Kounkane</option>
                                <option value="Medina yoro foulah" <?php if ($data['quartiers'] == "Medina yoro foulah") {
                                                                        echo "selected";
                                                                    } ?>>Medina yoro foulah</option>
                                <option value="Pata" <?php if ($data['quartiers'] == "Pata") {
                                                            echo "selected";
                                                        } ?>>Pata</option>
                                <option value="Salikegne" <?php if ($data['quartiers'] == "Salikegne") {
                                                                echo "selected";
                                                            } ?>>Salikegne</option>
                                <option value="Sare yoba diega" <?php if ($data['quartiers'] == "Sare yoba diega") {
                                                                    echo "selected";
                                                                } ?>>Sare yoba diega</option>
                                <option value="Velingara" <?php if ($data['quartiers'] == "Velingara") {
                                                                echo "selected";
                                                            } ?>>Velingara</option>
                            </optgroup>
                            <optgroup label="Louga">
                                <option value="Dahra" <?php if ($data['quartiers'] == "Dahra") {
                                                            echo "selected";
                                                        } ?>>Dahra</option>
                                <option value="Gueoul" <?php if ($data['quartiers'] == "Gueoul") {
                                                            echo "selected";
                                                        } ?>>Gueoul</option>
                                <option value="Kebemer" <?php if ($data['quartiers'] == "Kebemer") {
                                                            echo "selected";
                                                        } ?>>Kebemer</option>
                                <option value="Leona" <?php if ($data['quartiers'] == "Leona") {
                                                            echo "selected";
                                                        } ?>>Leona</option>
                                <option value="Linguere" <?php if ($data['quartiers'] == "Linguere") {
                                                                echo "selected";
                                                            } ?>>Linguere</option>
                                <option value="Louga" <?php if ($data['quartiers'] == "Louga") {
                                                            echo "selected";
                                                        } ?>>Louga</option>
                                <option value="Mbeuleukhe" <?php if ($data['quartiers'] == "Mbeuleukhe") {
                                                                echo "selected";
                                                            } ?>>Mbeuleukhe</option>
                                <option value="Nguene sarr" <?php if ($data['quartiers'] == "Nguene sarr") {
                                                                echo "selected";
                                                            } ?>>Nguene sarr</option>
                                <option value="Sakal" <?php if ($data['quartiers'] == "Sakal") {
                                                            echo "selected";
                                                        } ?>>Sakal</option>
                                <option value="Thiep" <?php if ($data['quartiers'] == "Thiep") {
                                                            echo "selected";
                                                        } ?>>Thiep</option>
                            </optgroup>
                            <optgroup label="Matam">
                                <option value="Dembancane" <?php if ($data['quartiers'] == "Dembancane") {
                                                                echo "selected";
                                                            } ?>>Dembacane</option>
                                <option value="Hamadi hounare" <?php if ($data['quartiers'] == "Hamadi hounare") {
                                                                    echo "selected";
                                                                } ?>>Hamadi hounare</option>
                                <option value="Kanel" <?php if ($data['quartiers'] == "Kanel") {
                                                            echo "selected";
                                                        } ?>>Kanel</option>
                                <option value="Matam" <?php if ($data['quartiers'] == "Matam") {
                                                            echo "selected";
                                                        } ?>>Matam</option>
                                <option value="Nguidjilone" <?php if ($data['quartiers'] == "Nguidjilone") {
                                                                echo "selected";
                                                            } ?>>Nguidjilone</option>
                                <option value="Odobere" <?php if ($data['quartiers'] == "Odobere") {
                                                            echo "selected";
                                                        } ?>>Odobere</option>
                                <option value="Ouaounde" <?php if ($data['quartiers'] == "Ouaounde") {
                                                                echo "selected";
                                                            } ?>>Ouaounde</option>
                                <option value="Ourossogui" <?php if ($data['quartiers'] == "Ourossogui") {
                                                                echo "selected";
                                                            } ?>>Ourossogui</option>
                                <option value="Ranerou" <?php if ($data['quartiers'] == "Ranerou") {
                                                            echo "selected";
                                                        } ?>>Ranerou</option>
                                <option value="Semme" <?php if ($data['quartiers'] == "Semme") {
                                                            echo "selected";
                                                        } ?>>Semme</option>
                                <option value="Sinthiou bamambe banadji" <?php if ($data['quartiers'] == "Sinthiou bamambe banadji") {
                                                                                echo "selected";
                                                                            } ?>>Sinthiou bamambe banadji</option>
                                <option value="Thilogne" <?php if ($data['quartiers'] == "Thilogne") {
                                                                echo "selected";
                                                            } ?>>Thilogne</option>
                            </optgroup>
                            <optgroup label="Saint-Louis">
                                <option value="Aere Lao" <?php if ($data['quartiers'] == "Aere Lao") {
                                                                echo "selected";
                                                            } ?>>Aere Lao</option>
                                <option value="Bode lao" <?php if ($data['quartiers'] == "Bode lao") {
                                                                echo "selected";
                                                            } ?>>Bode lao</option>
                                <option value="Dagana" <?php if ($data['quartiers'] == "Dagana") {
                                                            echo "selected";
                                                        } ?>>Dagana</option>
                                <option value="Demette" <?php if ($data['quartiers'] == "Demette") {
                                                            echo "selected";
                                                        } ?>>Demette</option>
                                <option value="Gae" <?php if ($data['quartiers'] == "Gae") {
                                                        echo "selected";
                                                    } ?>>Gae</option>
                                <option value="Galoya toucouleur" <?php if ($data['quartiers'] == "Galoya toucouleur") {
                                                                        echo "selected";
                                                                    } ?>>Galoya toucouleur</option>
                                <option value="Gnith" <?php if ($data['quartiers'] == "Gnith") {
                                                            echo "selected";
                                                        } ?>>Gnith</option>
                                <option value="Gollere" <?php if ($data['quartiers'] == "Gollere") {
                                                            echo "selected";
                                                        } ?>>Gollere</option>
                                <option value="Guede chantier" <?php if ($data['quartiers'] == "Guede chantier") {
                                                                    echo "selected";
                                                                } ?>>Guede chantier</option>
                                <option value="Mboumba" <?php if ($data['quartiers'] == "Mboumba") {
                                                            echo "selected";
                                                        } ?>>Mboumba</option>
                                <option value="Mpal" <?php if ($data['quartiers'] == "Mpal") {
                                                            echo "selected";
                                                        } ?>>Mpal</option>
                                <option value="Ndioum" <?php if ($data['quartiers'] == "Ndioum") {
                                                            echo "selected";
                                                        } ?>>Ndioum</option>
                                <option value="Ndombo sandjiry" <?php if ($data['quartiers'] == "Ndombo sandjiry") {
                                                                    echo "selected";
                                                                } ?>>Ndombo sandjiry</option>
                                <option value="Niandane" <?php if ($data['quartiers'] == "Niandane") {
                                                                echo "selected";
                                                            } ?>>Niandane</option>
                                <option value="Pete" <?php if ($data['quartiers'] == "Pete") {
                                                            echo "selected";
                                                        } ?>>Pete</option>
                                <option value="Podor" <?php if ($data['quartiers'] == "Podor") {
                                                            echo "selected";
                                                        } ?>>Podor</option>
                                <option value="Richard toll" <?php if ($data['quartiers'] == "Richard toll") {
                                                                    echo "selected";
                                                                } ?>>Richard toll</option>
                                <option value="Ross bethio" <?php if ($data['quartiers'] == "Ross bethio") {
                                                                echo "selected";
                                                            } ?>>Ross bethio</option>
                                <option value="Roso Senegal" <?php if ($data['quartiers'] == "Roso Senegal") {
                                                                    echo "selected";
                                                                } ?>>Roso Senegal</option>
                                <option value="Saint-Louis" <?php if ($data['quartiers'] == "Saint-Louis") {
                                                                echo "selected";
                                                            } ?>>Saint-Louis</option>
                                <option value="Walalde" <?php if ($data['quartiers'] == "Bounkiling") {
                                                            echo "selected";
                                                        } ?>>Walalde</option>
                            </optgroup>
                            <optgroup label="Sédhiou">
                                <option value="Bounkiling" <?php if ($data['quartiers'] == "Bounkiling") {
                                                                echo "selected";
                                                            } ?>>Bounkiling</option>
                                <option value="Dianah malary" <?php if ($data['quartiers'] == "Dianah malary") {
                                                                    echo "selected";
                                                                } ?>>Dianah malary</option>
                                <option value="Diattacounda" <?php if ($data['quartiers'] == "Diattacounda") {
                                                                    echo "selected";
                                                                } ?>>Diattacounda</option>
                                <option value="Dioudoubou" <?php if ($data['quartiers'] == "Dioudoubou") {
                                                                echo "selected";
                                                            } ?>>Dioudoubou</option>
                                <option value="Djinany" <?php if ($data['quartiers'] == "Djinany") {
                                                            echo "selected";
                                                        } ?>>Djinany</option>
                                <option value="Goudomp" <?php if ($data['quartiers'] == "Goudomp") {
                                                            echo "selected";
                                                        } ?>>Goudomp</option>
                                <option value="Kaour" <?php if ($data['quartiers'] == "Kaour") {
                                                            echo "selected";
                                                        } ?>>Kaour</option>
                                <option value="Madina wandifa <?php if ($data['quartiers'] == "Madina") {
                                                                    echo "selected";
                                                                } ?>">Madina wandifa</option>
                                <option value="Marssassoum" <?php if ($data['quartiers'] == "Marssassoum") {
                                                                echo "selected";
                                                            } ?>>Marssassoum</option>
                                <option value="Ndiamalathiel" <?php if ($data['quartiers'] == "Ndiamalathiel") {
                                                                    echo "selected";
                                                                } ?>>Ndiamalathiel</option>
                                <option value="Samine" <?php if ($data['quartiers'] == "Samine") {
                                                            echo "selected";
                                                        } ?>>Samine</option>
                                <option value="Simbandi brassou" <?php if ($data['quartiers'] == "Simbandi brassou") {
                                                                        echo "selected";
                                                                    } ?>>Simbandi brassou</option>
                                <option value="Sédhiou" <?php if ($data['quartiers'] == "Sédhiou") {
                                                            echo "selected";
                                                        } ?>>Sédhiou</option>
                                <option value="Tanaff" <?php if ($data['quartiers'] == "Tanaff") {
                                                            echo "selected";
                                                        } ?>>Tanaff</option>
                            </optgroup>
                            <optgroup label="Tambacounda">
                                <option value="Bakel" <?php if ($data['quartiers'] == "Bakel") {
                                                            echo "selected";
                                                        } ?>>Bakel</option>
                                <option value="Diawara" <?php if ($data['quartiers'] == "Diawara") {
                                                            echo "selected";
                                                        } ?>>Diawara</option>
                                <option value="Goudiry" <?php if ($data['quartiers'] == "Goudiry") {
                                                            echo "selected";
                                                        } ?>>Goudiry</option>
                                <option value="Kidira" <?php if ($data['quartiers'] == "Kidira") {
                                                            echo "selected";
                                                        } ?>>Kidira</option>
                                <option value="Kothiary" <?php if ($data['quartiers'] == "Kothiary") {
                                                                echo "selected";
                                                            } ?>>Kothiary</option>
                                <option value="Koumpentoum" <?php if ($data['quartiers'] == "Koumpentoum") {
                                                                echo "selected";
                                                            } ?>>Koumpentoum</option>
                                <option value="Maleme niani" <?php if ($data['quartiers'] == "Maleme niani") {
                                                                    echo "selected";
                                                                } ?>>Maleme niani</option>
                                <option value="Mereto" <?php if ($data['quartiers'] == "Mereto") {
                                                            echo "selected";
                                                        } ?>>Mereto</option>
                                <option value="Tambacounda" <?php if ($data['quartiers'] == "Tambacounda") {
                                                                echo "selected";
                                                            } ?>>Tambacounda</option>
                            </optgroup>
                            <optgroup label="Thiès">
                                <option value="Diass" <?php if ($data['quartiers'] == "Diass") {
                                                            echo "selected";
                                                        } ?>>Diass</option>
                                <option value="Diender" <?php if ($data['quartiers'] == "Diender") {
                                                            echo "selected";
                                                        } ?>>Diender</option>
                                <option value="Fandene" <?php if ($data['quartiers'] == "Fandene") {
                                                            echo "selected";
                                                        } ?>>Fandene</option>
                                <option value="Fissel" <?php if ($data['quartiers'] == "Fissel") {
                                                            echo "selected";
                                                        } ?>>Fissel</option>
                                <option value="Guereo" <?php if ($data['quartiers'] == "Guereo") {
                                                            echo "selected";
                                                        } ?>>Guereo</option>
                                <option value="Joal fadiouth" <?php if ($data['quartiers'] == "Joal fadiouth") {
                                                                    echo "selected";
                                                                } ?>>Joal fadiouth</option>
                                <option value="Kayar" <?php if ($data['quartiers'] == "Kayar") {
                                                            echo "selected";
                                                        } ?>>Kayar</option>
                                <option value="Keur moussa" <?php if ($data['quartiers'] == "Keur moussa") {
                                                                echo "selected";
                                                            } ?>>Keur moussa</option>
                                <option value="Khombole" <?php if ($data['quartiers'] == "Khombole") {
                                                                echo "selected";
                                                            } ?>>Khombole</option>
                                <option value="Malicounda" <?php if ($data['quartiers'] == "Malicounda") {
                                                                echo "selected";
                                                            } ?>>Malicounda</option>
                                <option value="Mbodiene" <?php if ($data['quartiers'] == "Mbodiene") {
                                                                echo "selected";
                                                            } ?>>Mbodiene</option>
                                <option value="Mboro" <?php if ($data['quartiers'] == "Mboro") {
                                                            echo "selected";
                                                        } ?>>Mboro</option>
                                <option value="Mbour" <?php if ($data['quartiers'] == "Mbour") {
                                                            echo "selected";
                                                        } ?>>Mbour</option>
                                <option value="Meckhe" <?php if ($data['quartiers'] == "Meckhe") {
                                                            echo "selected";
                                                        } ?>>Meckhe</option>
                                <option value="Ndiaganiao" <?php if ($data['quartiers'] == "Ndiaganiao") {
                                                                echo "selected";
                                                            } ?>>Ndiaganiao</option>
                                <option value="Ngaparou" <?php if ($data['quartiers'] == "Ngaparou") {
                                                                echo "selected";
                                                            } ?>>Ngaparou</option>
                                <option value="Ngoundiane" <?php if ($data['quartiers'] == "Ngoundiane") {
                                                                echo "selected";
                                                            } ?>>Ngoundiane</option>
                                <option value="Nguekhokh" <?php if ($data['quartiers'] == "Nguekhokh") {
                                                                echo "selected";
                                                            } ?>>Nguekhokh</option>
                                <option value="Ngueniene" <?php if ($data['quartiers'] == "Ngueniene") {
                                                                echo "selected";
                                                            } ?>>Ngueniene</option>
                                <option value="Nguering" <?php if ($data['quartiers'] == "Nguering") {
                                                                echo "selected";
                                                            } ?>>Nguering</option>
                                <option value="Nianing" <?php if ($data['quartiers'] == "Nianing") {
                                                            echo "selected";
                                                        } ?>>Nianing</option>
                                <option value="Notto" <?php if ($data['quartiers'] == "Notto") {
                                                            echo "selected";
                                                        } ?>>Notto</option>
                                <option value="Pambal" <?php if ($data['quartiers'] == "Pambal") {
                                                            echo "selected";
                                                        } ?>>Pambal</option>
                                <option value="Pointe sarene" <?php if ($data['quartiers'] == "Pointe sarene") {
                                                                    echo "selected";
                                                                } ?>>Pointe sarene</option>
                                <option value="Popenguine" <?php if ($data['quartiers'] == "Popenguine") {
                                                                echo "selected";
                                                            } ?>>Popenguine</option>
                                <option value="Pout" <?php if ($data['quartiers'] == "Pout") {
                                                            echo "selected";
                                                        } ?>>Pout</option>
                                <option value="Saly" <?php if ($data['quartiers'] == "Saly") {
                                                            echo "selected";
                                                        } ?>>Saly</option>
                                <option value="Saly portudal" <?php if ($data['quartiers'] == "Saly portudal") {
                                                                    echo "selected";
                                                                } ?>>Saly portudal</option>
                                <option value="Sandiara" <?php if ($data['quartiers'] == "Sandiara") {
                                                                echo "selected";
                                                            } ?>>Sandiara</option>
                                <option value="Sessene" <?php if ($data['quartiers'] == "Sessene") {
                                                            echo "selected";
                                                        } ?>>Sessene</option>
                                <option value="Sindia" <?php if ($data['quartiers'] == "Sindia") {
                                                            echo "selected";
                                                        } ?>>Sindia</option>
                                <option value="Somone" <?php if ($data['quartiers'] == "Somone") {
                                                            echo "selected";
                                                        } ?>>Somone</option>
                                <option value="Tassette" <?php if ($data['quartiers'] == "Tassette") {
                                                                echo "selected";
                                                            } ?>>Tassette</option>
                                <option value="Thiadiaye" <?php if ($data['quartiers'] == "Thiadiaye") {
                                                                echo "selected";
                                                            } ?>>Thiadiaye</option>
                                <option value="Thienaba" <?php if ($data['quartiers'] == "Thienaba") {
                                                                echo "selected";
                                                            } ?>>Thienaba</option>
                                <option value="Thiès" <?php if ($data['quartiers'] == "Thiès") {
                                                            echo "selected";
                                                        } ?>>Thiès</option>
                                <option value="Tivaouane" <?php if ($data['quartiers'] == "Tivaouane") {
                                                                echo "selected";
                                                            } ?>>Tivaouane</option>
                                <option value="Touba toul" <?php if ($data['quartiers'] == "Touba toul") {
                                                                echo "selected";
                                                            } ?>>Touba toul</option>
                                <option value="Touba dialaw" <?php if ($data['quartiers'] == "Touba dialaw") {
                                                                    echo "selected";
                                                                } ?>>Touba dialaw</option>
                                <option value="Warang" <?php if ($data['quartiers'] == "Warang") {
                                                            echo "selected";
                                                        } ?>>Warang</option>
                            </optgroup>
                            <optgroup label="Ziguinchor">
                                <option value="Bignona" <?php if ($data['quartiers'] == "Bignona") {
                                                            echo "selected";
                                                        } ?>>Bignona</option>
                                <option value="Cap skirring" <?php if ($data['quartiers'] == "Cap skirring") {
                                                                    echo "selected";
                                                                } ?>>Cap skirring</option>
                                <option value="Diouloulou" <?php if ($data['quartiers'] == "Diouloulou") {
                                                                echo "selected";
                                                            } ?>>Diouloulou</option>
                                <option value="Oussouye" <?php if ($data['quartiers'] == "Oussouye") {
                                                                echo "selected";
                                                            } ?>>Oussouye</option>
                                <option value="Thionck essyl" <?php if ($data['quartiers'] == "Thionck essyl") {
                                                                    echo "selected";
                                                                } ?>>Thionck essyl</option>
                                <option value="Ziguinchor" <?php if ($data['quartiers'] == "Ziguinchor") {
                                                                echo "selected";
                                                            } ?>>Ziguinchor</option>
                            </optgroup>
                        </select>

                    </div>

                </div>

                <button class="btn btn-success mb-4 px-4 text-ligth" type="submit" name="submit" style="color: #fff;font-weight: 700; font-size:14px">Modifier mon
                    annonce</button>


        </div>

        </form>
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
    <!--javaSCript-->
    <script>
        function previewBeforeUpload(id) {
            document.querySelector("#" + id).addEventListener("change", function(e) {
                if (e.target.files.length == 0) {
                    return;
                }
                let file = e.target.files[0];
                let url = URL.createObjectURL(file);
                document.querySelector("#" + id + "-preview div").innerText = file.name;
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
    <script src="main.js"></script>
    <script src="//code.tidio.co/soutospimq4pk32r0mcxjjhtoqnjc0de.js" async></script>
</body>

</html>