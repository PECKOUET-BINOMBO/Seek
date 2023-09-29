<?php
session_start();
$rec =  $_GET['annonceur'];
$rec2 =  $_GET['annonce'];
require 'sendmail.php';
$rec =  isset($_GET['annonceur']) ? $_GET['annonceur'] : NULL;
$rec2 = isset($_GET['annonce']) ? $_GET['annonce'] : NULL;
    if (isset($_POST['submit'])) {
        $errors;
        $pseudoInvalide;
        $emailInvalide;
        $pseudo = htmlspecialchars($_POST["pseudo"]);
        $email = htmlspecialchars($_POST["email"]);
        $signal = htmlspecialchars($_POST["signal"]);
       
        ///////////////////////////////////////////////////////////////////////////////////////////////////////
        if(isset($_POST["email"], $_POST["pseudo"], $_POST["signal"]) && !empty($_POST['pseudo']) && !empty($_POST['email']) && !empty($_POST['signal'])){
            
            if(!preg_match('/^[a-zA-Z0-9_" "]+$/', $pseudo)){
                $pseudoInvalide = "Pseudo invalide";
            }
            /////////////////////////////////////////////////////////vérification_email////////////////////////
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailInvalide = "Adresse-mail invalide";
            }
            if(empty($errors) AND empty($emailInvalide)){
              
}
if (empty($pseudoInvalide) && empty($emailInvalide)){
    require 'conf/login_data.php';
    $req = $loginData->prepare("SELECT * FROM annonces WHERE id_annonces = $rec2 ");
    $req->execute();
    $data = $req->fetch();

    $req2 = $loginData->prepare("SELECT * FROM annonceurs WHERE id_annonceurs = $rec");
    $req2->execute();
    $data2 = $req2->fetch();
    signal();
}
}else{
$errors = "Veuillez remplir tous les champs";
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
    <!--bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!--sweetalert-->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!--font google -->
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500&family=Open+Sans:wght@300;400&display=swap"
        rel="stylesheet">
    <!-- title bar icon -->
    <link rel="shortcut icon" type="imge/x-icon" href="img/title-bar-icon.png">
    <link rel="stylesheet" href="style.css">
    <title>Signaler nous une annonce</title>
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
            <div class="container box-compte mt-5">

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
                <div class="text-center">
                   <h3 class="mb-3">Signaler l'annonce</h3>
                <p>
                    Votre signalement sera examiné dans les plus bref délais par nos équipes.
                </p> 
                </div>
                
                <?php if (!empty($errors)) : ?>
                <p class="alert alert-danger text-center">
                    <?= $errors ?>
                </p>
                <?php endif; ?>
                <form method="POST" class="forms col-sm-12 col-md-6 col-lg-5 col-xl-4">
                    <div class="form-group row mb-1">
                        <label for="pseud" class="col-sm-5 col-form-label">Nom(s) :</label>
                        <div>
                            <input type="text" class="form-control" id="pseudo  " aria-describedby="emailHelp"
                            placeholder="Votre nom(s)" name="pseudo" value="<?php echo isset($_POST['pseudo']) ? htmlspecialchars($_POST['pseudo']) : ''; ?>">
                        </div>
                        <div class="para-alert">
                            <?php if (!empty($pseudoInvalide)) : ?>
                            <p class=" text-danger text-start">
                                <?= $pseudoInvalide ?>
                            </p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group row mb-1">
                        <label for="emailHelp" class="col-sm-5 col-form-label">Adresse-Email :</label>
                        <div>
                            <input type="email" class="form-control" id="emailHelp  " aria-describedby="emailHelp"
                            placeholder="Votre adresse e-mail" name="email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
                        </div>
                        <div class="para-alert">
                            <?php if (!empty($emailInvalide)) : ?>
                            <p class=" text-danger text-start">
                                <?= $emailInvalide ?>
                            </p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group row mb-1">
                        <label for="pass" class="col-sm-9 col-form-label">Pourquoi signaler cette anonnce ?</label>
                        <div>
                            <textarea class="form-control" style="resize: none;" id="emailHelp  "
                            aria-describedby="emailHelp" placeholder="Message..." name="signal" id="" cols="30"
                            rows="5" value="<?php echo isset($_POST['signal']) ? htmlspecialchars($_POST['signal']) : ''; ?>"></textarea>
                        </div>
                    </div>
                    <div class="form-group row my-3">
                        <div>
                        <button type="submit" name="submit" class="btn btn-primary">Envoyer</button>
                        </div>
                    </div>
                </form>
            </div>
            <?php include "footer.php" ?>
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

