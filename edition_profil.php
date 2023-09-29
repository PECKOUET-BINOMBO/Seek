<?php
$rec =  $_GET['id'];
require 'conf/login_data.php';
$req = $loginData->prepare("SELECT * FROM annonceurs WHERE id_annonceurs = $rec");
$req->execute();
$data = $req->fetch();
?>
<?php
if (isset($_POST['submit'])) {
    $errors;
    $pseudoInvalide;
    $pseudoUtilise;
    $emailInvalide;
    $emailUtilise;
    $telInvalide;
    $passwordInvalide;
    $pseudo = htmlspecialchars($_POST["pseudo"]);
    $email = htmlspecialchars($_POST["email"]);
    $tel = htmlspecialchars($_POST["tel"]);
    $telw = htmlspecialchars($_POST["telw"]);
    $password = htmlspecialchars($_POST["password"]);
    $conf_password = htmlspecialchars($_POST["conf_password"]);

    ///////////////////////pseudo////////////////////////////////////////////////////////////////////////////////
    if (isset($_POST['pseudo']) && !empty($_POST['pseudo'])) {
        ///////////////////////////////////////////////////////////////////////////////////////////////////
        require "conf/login_data.php";
        $req = $loginData->prepare('SELECT * FROM annonceurs WHERE pseudo = :pseudo');
        $req->execute(array('pseudo' => $pseudo));
        $result = $req->fetch();
        if (!preg_match('/^[a-zA-Z0-9_" "]+$/', $pseudo)) {
            $pseudoInvalide = "Pseudo invalide";
        }
        if ($result) {
            $pseudoUtilise = "Ce pseudo est déjà utilisé";
        }
        if (empty($pseudoInvalide) && empty($pseudoUtilise)) {
            $echec;
            $success;
            $req = $loginData->prepare("UPDATE annonceurs SET pseudo = ? WHERE id_annonceurs = $rec");
            $req->execute([$pseudo]);
            if ($req) {
                session_start();
                $_SESSION['updateprofil'] = "Modification réussite. Veuillez vous reconnecter";
                header("Location: deconnexion.php");
            } else {
                $echec = 'Echec de la modification';
            }
        }
    }
    ///////////////////////email////////////////////////////////////////////////////////////////////////////////
    if (isset($_POST['email']) && !empty($_POST['email'])) {
        $req = $loginData->prepare('SELECT * FROM annonceurs WHERE email = :email');
        $req->execute(array('email' => $email));
        $result = $req->fetch();
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailInvalide = "Adresse-mail invalide";
        }
        if ($result) {
            $emailUtilise = "Cet email est déjà utilisé";
        }
        if (empty($emailInvalide) && empty($emailUtilise)) {
            $echec;
            $success;
            $req = $loginData->prepare("UPDATE annonceurs SET email = ? WHERE id_annonceurs = $rec");
            $req->execute([$email]);
            if ($req) {
                session_start();
                $_SESSION['updateprofil'] = "Modification réussite. Veuillez vous reconnecter";
                header("Location: deconnexion.php");
            } else {
                $echec = 'Echec de la modification';
            }
        }
    }
    /////////////////////////////////////////////////////////vérification_numero///////////////////////
    if (isset($_POST['tel']) && !empty($_POST['tel'])) {
        if (!preg_match('/^(221|00221|\+221)?(77|78|75|70|76)[0-9]{7}$/', $tel)) {
            $telInvalide = "Format invalide";
        }
    
        if (empty($telInvalide)) {
            $echec;
            $success;
            $req = $loginData->prepare("UPDATE annonceurs SET tel = ? WHERE id_annonceurs = $rec");
            $req->execute([$tel]);
            if ($req) {
                session_start();
                $_SESSION['updateprofil'] = "Modification réussite. Veuillez vous reconnecter";
                header("Location: deconnexion.php");
            } else {
                $echec = 'Echec de la modification';
            }
        }
    }
     /////////////////////////////////////////////////////////vérification_numero///////////////////////
     if (isset($_POST['telw']) && !empty($_POST['telw'])) {
        if (!preg_match('/^(221|00221|\+221)?(77|78|75|70|76)[0-9]{7}$/', $tel)) {
            $telInvalide = "Format invalide";
        }
    
        if (empty($telInvalide)) {
            $echec;
            $success;
            $req = $loginData->prepare("UPDATE annonceurs SET tel = ? WHERE id_annonceurs = $rec");
            $req->execute([$tel]);
            if ($req) {
                session_start();
                $_SESSION['updateprofil'] = "Modification réussite. Veuillez vous reconnecter";
                header("Location: deconnexion.php");
            } else {
                $echec = 'Echec de la modification';
            }
        }
    }
    /////////////////////////////////////////////////////////vérification_password/////////////////////
    if (isset($_POST['password'], $_POST['conf_password']) && empty($_POST['password']) || empty($_POST['conf_password'])) {
        $errors = "Veuillez remplir les deux champs";
    } else {
        if ($password !== $conf_password) {
            $passwordInvalide = "Les mots de passe ne correspondent pas";
        }
        if (empty($errors) && empty($passwordInvalide)) {
            $echec;
            $success;
            $req = $loginData->prepare("UPDATE annonceurs SET password = ? WHERE id_annonceurs = $rec");
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $req->execute([$password]);
            //$user  = $req->fetch();
            if ($req) {
                session_start();
                $_SESSION['updateprofil'] = "Modification réussite. Veuillez vous reconnecter";
                header("Location: deconnexion.php");
            } else {
                $echec = 'Echec de la modification';
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
    <!--bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!--sweetalert-->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!--font google -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500&family=Open+Sans:wght@300;400&display=swap" rel="stylesheet"> <!-- title bar icon -->
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
        <div class="row">
            <?php include "header_contact.php" ?>
            <?php include "logo_menu.php" ?>

            <div class="container box-compte mt-5">
               
                <?php if (!empty($success)) : ?>
                    <p class=" alert alert-success text-center">
                        <?= $success ?>
                    </p>
                <?php endif; ?>

                <?php if (!empty($echec)) : ?>
                    <p class="alert alert-success text-center">
                        <?= $echec ?>
                    </p>
                <?php endif; ?>

                <form method="POST" class="forms col-sm-12 col-md-7 col-lg-6 col-xl-5">
                    <h3 class="mb-3 text-center">Editer mon profil</h3>
                    <p class="text-center text-danger ">Toute modification apportée entraînera une déconnexion.</p>
<!-- pseudo -->
                    <div class="form-group row mb-1">
                        <label for="pseud" class="col-sm-5 col-form-label">Pseudo :</label>
                        <div>
                            <input placeholder="<?= $data['pseudo'] ?>" type="text" class="form-control" id="pseudo  " aria-describedby="emailHelp" name="pseudo">
                            <div class="para-alert">
                                <?php if (!empty($pseudoInvalide)) : ?>
                                    <p class=" text-danger text-start">
                                        <?= $pseudoInvalide ?>
                                    </p>
                                <?php endif; ?>
                                <?php if (!empty($pseudoUtilise)) : ?>
                                    <p class=" text-danger text-start">
                                        <?= $pseudoUtilise ?>
                                    </p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
<!-- adresse -->
                    <div class="form-group row mb-1">
                        <label for="emailHelp" class="col-sm-5 col-form-label" class="col-sm-5 col-form-label">Adresse-Email :</label>
                        <div>
                            <input placeholder="<?= $data['email'] ?>" type="email" class="form-control" id="emailHelp  " aria-describedby="emailHelp" name="email">
                            <small id="emailHelp" class="form-text text-muted">Ne partager jamais votre e-mail avec
                                quelqu'un d'autre.</small>
                            <div class="para-alert">
                                <?php if (!empty($emailInvalide)) : ?>
                                    <p class=" text-danger text-start">
                                        <?= $emailInvalide ?>
                                    </p>
                                <?php endif; ?>
                                <?php if (!empty($emailUtilise)) : ?>
                                    <p class=" text-danger text-start">
                                        <?= $emailUtilise ?>
                                    </p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
<!-- telephone -->
                    <div class="form-group row mb-1">
                        <label for="tel" class="col-sm-5 col-form-label">N° Téléphone :</label>
                        <div>
                            <input placeholder="<?= $data['tel'] ?>" type="tel" class="form-control" id="tel  " aria-describedby="emailHelp" name="tel">
                            <div class="para-alert">
                                <?php if (!empty($telInvalide)) : ?>
                                    <p class=" text-danger text-start">
                                        <?= $telInvalide ?>
                                    </p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <!-- telephone W -->
                    <div class="form-group row mb-1">
                        <label for="tel" class="col-sm-5 col-form-label">N° Whatsapp :</label>
                        <div>
                            <input placeholder="<?= $data['telw'] ?>" type="tel" class="form-control" id="tel  " aria-describedby="emailHelp" name="telw">
                        </div>
                    </div>
<!-- nouveau mot de passe -->
                    <div class="form-group row mb-1">
                        <label for="pass" class="col-sm-5 col-form-label">Nouveau mot de passe</label>
                        <?php if (!empty($errors)) : ?>
                            <p class=" text-danger text-start">
                                <?= $errors ?>
                            </p>
                        <?php endif; ?>
                        <div class="voirpass">
                            <input type="password" class="form-control" id="password" placeholder="Mot de passe" name="password">
                            <i class="fa-solid fa-eye" id="eye"></i>
                        </div>
                    </div>
<!-- confirmation mot de passe -->
                    <div class="form-group row">
                        <label for="conf_pass" class="col-sm-5 col-form-label">Confirmer mot de passe</label>
                        <div class="voirpass">
                            <input type="password" class="form-control" id="conf_pass" placeholder="Confirmation du mot de passe" name="conf_password">
                            <i class="fa-solid fa-eye" id="eye2"></i>
                            <?php if (!empty($passwordInvalide)) : ?>
                                <p class=" text-danger text-start">
                                    <?= $passwordInvalide ?>
                                </p>
                            <?php endif; ?>
                        </div>
                    </div>
<!-- buton -->
                    <div class="form-group row my-3">
                        <div>
                            <button type="submit" name="submit" class="btn btn-primary">Enregister</button>
                        </div>
                    </div>

                </form>
            </div>
            <?php include "footer.php" ?>
        </div>
    </div>
    <!--javascript bootstrap
<script src=" cdn/bootstrap5/js/bootstrap.js"></script>-->

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <!--javaSCript-->
    <script src="main.js"></script>
    <script src="//code.tidio.co/soutospimq4pk32r0mcxjjhtoqnjc0de.js" async></script>
    <script>
      const passwordInput = document.getElementById('password');
      const eyeIcon = document.getElementById('eye');
      const passwordInput2 = document.getElementById('conf_pass');
      const eyeIcon2 = document.getElementById('eye2');
      
      // Écouteur d'événement pour le clic sur l'icône de l'œil
      eyeIcon.addEventListener('click', function() {
        if (passwordInput.type === 'password') {
          // Si le type d'input est password, le changer en text pour afficher le mot de passe
          passwordInput.type = 'text';
          // Changer la classe de l'icône pour afficher une icône d'œil barré
          eyeIcon.classList.remove('fa-eye');
          eyeIcon.classList.add('fa-eye-slash');
        } else {
          // Sinon, changer le type d'input en password pour masquer le mot de passe
          passwordInput.type = 'password';
          // Changer la classe de l'icône pour afficher une icône d'œil
          eyeIcon.classList.remove('fa-eye-slash');
          eyeIcon.classList.add('fa-eye');
        }
      });

       // Écouteur d'événement pour le clic sur l'icône de l'œil
       eyeIcon2.addEventListener('click', function() {
        if (passwordInput2.type === 'password') {
          // Si le type d'input est password, le changer en text pour afficher le mot de passe
          passwordInput2.type = 'text';
          // Changer la classe de l'icône pour afficher une icône d'œil barré
          eyeIcon2.classList.remove('fa-eye');
          eyeIcon2.classList.add('fa-eye-slash');
        } else {
          // Sinon, changer le type d'input en password pour masquer le mot de passe
          passwordInput2.type = 'password';
          // Changer la classe de l'icône pour afficher une icône d'œil
          eyeIcon2.classList.remove('fa-eye-slash');
          eyeIcon2.classList.add('fa-eye');
        }
      });
   </script>
</body>

</html>