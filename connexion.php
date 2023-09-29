<?php
session_start();

if (!empty($_POST)) {
    $errors;
    $invalide;
    $email = htmlspecialchars($_POST["email"]);
    $password = htmlspecialchars($_POST["password"]);
    ///////////////////////////////////////////////////////////////////////////////////////////////////
    if (isset($_POST["email"], $_POST["password"]) && !empty($_POST['email']) && !empty($_POST['password'])) {
        require 'conf/login_data.php';
        ///////////////////////////////////////////////////////////////////////////////////////////////
        $req = $loginData->prepare("SELECT * FROM annonceurs WHERE (email = :email) AND verifie = 'oui'");
        $req->bindValue(":email", $email, PDO::PARAM_STR);
        $req->execute();
        //conditions de connexion ici//////////
        $userinfo = $req->fetch();
        if (!$userinfo) {
            $errors = "Entrer les bons identifiants ou assurer d'avoir eut à confirmer votre compte";
        } elseif (!password_verify($_POST['password'], $userinfo['password'])) {
            $errors = "Identifiants incorrectes";
        } else {

            $_SESSION['id'] = $userinfo['id_annonceurs'];
            $_SESSION['pseudo'] = $userinfo['pseudo'];
            $_SESSION['wallet'] = $userinfo['wallet'];
            $_SESSION['email'] = $userinfo['email'];
            $_SESSION['tel'] = $userinfo['tel'];
            header("Location: index.php");
        }
    } else {
        $errors = "Veuillez remplir tous les champs";
    }
}
?>
<!DOCTYPE html>
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
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <!--font google -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500&family=Open+Sans:wght@300;400&display=swap" rel="stylesheet"> <!-- title bar icon -->
    <link rel="shortcut icon" type="imge/x-icon" href="img/title-bar-icon.png">
    <link rel="stylesheet" href="style.css">
    <title>Connexion</title>
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
        .navbar-light .navbar-nav .connexion_link {
            color: #ec3e0e;
        }
    </style>

    <div class="container-fluid-xs container-xxl" style="padding-right: var(--bs-gutter-x, 0rem); overflow:hidden;">
        <div class="row">
            <?php include "header_contact.php" ?>
            <?php include "logo_menu.php" ?>

            <div class="container box-connexion pt-5" style="padding-right: calc(var(--bs-gutter-x) * 0.8) !important; padding-left: calc(var(--bs-gutter-x) * 0.3);">
                <?php if (!empty($_SESSION['compteActive'])) : ?>
                    <script>
                        swal({
            //title: 'Annonce  envoyée ',
            text: ' <?= $_SESSION['compteActive'] ?>',
            icon: 'success',
            buttons: 'Ok',
          }).then((result) => {
            if (result) {
            }
          });
          var swalText = document.querySelector('.swal-text');
  if (swalText) {
    swalText.style.textAlign = 'center';
  }
        </script>
                    
                <?php unset($_SESSION['compteActive']); endif; ?>

                <?php if (!empty($_SESSION['updatemsg'])) : ?>
                    <div>
                        <p class="alert alert-success text-center">
                            <?= $_SESSION['updatemsg'] ?>
                        </p>
                    </div>
                <?php unset($_SESSION['updatemsg']);
                endif; ?>

                <?php if (!empty($_SESSION['updateprofil'])) : ?>
                    <div>
                        <p class="alert alert-success text-center">
                            <?= $_SESSION['updateprofil'] ?>
                        </p>
                    </div>
                <?php unset($_SESSION['updateprofil']);
                endif; ?>

                <?php if (!empty($errors)) : ?>
                    <p class="alert alert-danger text-center">
                        <?= $errors ?>
                    </p>
                <?php endif; ?>

                <form method="POST" class="forms col-sm-12 col-md-6 col-lg-5 col-xl-4">
                    <h3 class="mb-4 text-center">Se connecter</h3>
<!-- adresse -->
                    <div class="form-group row mb-1">
                        <label for="email" class="col-sm-5 col-form-label">Adresse-Email :</label>
                        <div class="">
                            <input type="email" class="form-control" id="email " aria-describedby="emailHelp" placeholder="Votre adresse email" name="email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
                            
                        </div>
                    </div>
<!-- mot de passe -->
                    <div class="form-group row mt-1">
                        <label for="pass" class="col-sm-5 col-form-label">Mot de passe </label>
                        <div class="voirpass">
                            <input type="password" class="form-control" id="password" placeholder="Votre mot de passe" name="password">
                            <i class="fa-solid fa-eye" id="eye"></i>
                            <div class="para-alert">
                                <?php if (!empty($invalide)) : ?>
                                    <p class=" text-danger text-start">
                                        <?= $invalide ?>
                                    </p>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div>
                            <a href="pass_lost.php" style="font-size: 0.8rem;">
                                Mot de passe oublié?
                            </a>
                        </div>
                    </div>
<!-- buton -->
                    <div class="form-group row my-3">
                        <div>
                            <button type="submit" class="btn btn-primary">Se connecter</button>
                        </div>
                    </div>
<!-- pas encore de compte -->
                    <div class="form-group row">
                        <div>
                            <p class="" style="font-size: 0.8rem;">Pas encore de compte ? créez en <a href="inscription.php">un</a> </p>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <!--javascript bootstrap
 <script src="cdn/bootstrap5/js/bootstrap.js"></script>-->

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
   </script>
</body>

</html>