<?php
session_start();
require 'sendmail.php';
if (isset($_POST['initpass'])) {
    $email = $_POST['email'];
    $messagemail;
    $badadresse;
    $echec;
    $success;
    $vide;
    $token = base_convert(hash('sha256', time() . mt_rand()), 16, 36);
    if (isset($email) && !empty($email)) {
        require "conf/login_data.php";
        /////////////////////////////////////////////////////////pseudo////////////////////////////////////
        $req = $loginData->prepare('SELECT * FROM annonceurs WHERE email = :email');
        $req->execute(array('email' => $email));
        $result = $req->fetch();
        $pseudo = $result['pseudo'];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $messagemail = "Adresse e-mail invalide";
        }
        if (!$result) {
            $badadresse = "Adresse inexistante";;
        }
        if (empty($messagemail) && empty($badadresse)) {
           passlost();
        }
    } else {
        $vide = "Veuillez entrer votre adresse e-mail";
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--bootstrap
    <link href="cdn/bootstrap5/css/bootstrap.css" rel="stylesheet">
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
    <title>Mot de passe oubliée</title>
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
            <div>
                <a href="connexion.php"><button
                        style="color: #fff;font-weight: 700;font-size:14px; text-decoration:none"
                        class="prev btn btn-warning my-4 px-4  " type="button">Retour</button></a>
            </div>
            <div class="container box-lost mt-5">
                <?php if (!empty($messagemail)) : ?>
                <p class="alert alert-danger text-center">
                    <?= $messagemail ?>
                </p>
                <?php endif; ?>
                <?php if (!empty($success)) : ?>
                <p class="alert alert-success text-center">
                    <?= $success ?>
                </p>
                <?php endif; ?>
                <?php if (!empty($echec)) : ?>
                <p class="alert alert-danger text-center">
                    <?= $echec ?>
                </p>
                <?php endif; ?>

                <?php if (!empty($_SESSION['msg'])) : ?>
                <p class="alert alert-danger text-center">
                    <?= $_SESSION['msg'] ?>
                </p>
                <?php unset($_SESSION['msg']); endif; ?>

                <h3 class="text-center">Vous avez oubliée votre mot de passe ?</h3>
                <p class="text-center">
                    Entrer l'adresse email de votre compte pour réinitialiser votre mot de passe.
                </p>
                <form method="POST" class="forms col-sm-12 col-md-6 col-lg-5 col-xl-4">
                    <div class="form-group row">
                        <?php if (!empty($badadresse)) : ?>
                        <p class="text-danger text-start m-0">
                            <?= $badadresse ?>
                        </p>
                        <?php endif; ?>
                        <?php if (!empty($vide)) : ?>
                        <p class="text-danger text-start m-0 ">
                            <?= $vide ?>
                        </p>
                        <?php endif; ?>
                        <div class="text-center">
                            <input type="email" class="form-control" id="email" aria-describedby="emailHelp"
                            placeholder="Entrer votre adresse email" name="email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="text-center">
                            <button type="submit" class="btn btn-danger my-3" name="initpass">Réinitialiser mon mot de
                        passe</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--javascript bootstrap
    <script src="cdn/bootstrap5/js/bootstrap.js"></script>
-->
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
    <script src="//code.tidio.co/soutospimq4pk32r0mcxjjhtoqnjc0de.js" async></script>
</body>

</html>