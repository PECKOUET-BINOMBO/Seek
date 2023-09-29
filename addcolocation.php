<?php
session_start();
require "conf/login_data.php";
require "sendmail.php";

$errors;
$pseudo_vide = null;
$tel_vide = null;
$tel_error = null;
$telw_error = null;
$desc_vide = null;
$passwordInvalide = null;

if (isset($_POST['submit'])) {
    $pseudo = htmlspecialchars($_POST["pseudo"]);
    $tel = htmlspecialchars($_POST["tel"]);
    $telw = htmlspecialchars($_POST["telw"]);
    $desc =  htmlspecialchars($_POST['desc']);


    if (empty($pseudo) && empty($tel) && empty($desc)) {
        $errors = "Veuillez remplir tous les champs";
    } else {
        if(empty($pseudo)){
            $pseudo_vide ="Pseudo vide";
        }
        // Vérification du numéro de téléphone
        if(empty($tel)){
            $tel_vide ="Numéro de téléphone vide";
        }
        if (!preg_match('/^(221|00221|\+221)?(77|78|75|70|76)[0-9]{7}$/', $tel)) {
            $tel_error = "Format invalide";
        }
        if(empty($desc)){
            $desc_vide = "Votre demande est vide";
        }
        // Insertion des données
        if (empty($errors) && empty($pseudo_vide) && empty($tel_vide) && empty($tel_error) && empty($desc_vide)) {
            date_default_timezone_set('Africa/Dakar');
            $date_add = strtotime(date('d-m-Y H:i:s'));

            
            $req = $loginData->prepare("INSERT INTO colocation SET pseudo = ?, tel = ?, telw = ?, demande = ?, date_add = ?");
            $req->execute([$pseudo, $tel, $telw,  $desc, $date_add]);

            $last_id = $loginData->lastInsertId();
            if ($req) {
                addcollocation();
                $_SESSION['add_dem'] = "Après validation, votre demande sera ajoutée par nos service. ";
                header('Location: colocation.php');


            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demande de colocation</title>
    <link rel="shortcut icon" type="imge/x-icon" href="img/title-bar-icon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500&family=Open+Sans:wght@300;400&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/727be77922.js" crossorigin="anonymous"></script>
    <script src="cdn/font-awesome4/fonts/FontAwesome.otf"></script>
    <link rel="stylesheet" href="style.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <style>
        .navbar-light .navbar-nav .inscription_link {
            color: #ec3e0e;
        }
    </style>
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
    <div class="container-fluid-xs container-xxl pb-5">
        <?php include "header_contact.php" ?>
        <?php include "logo_menu.php" ?>
        <div class="container box-compte">
            <form method="POST" class="forms2 col-sm-12 col-md-7 col-lg-6 col-xl-5 mt-4">
                <h3 class="mb-4 text-center">Demande de colocation</h3>
                <?php if(!empty($errors)): ?>
                    <p class="text-danger text-center"><?= $errors ?></p>
                <?php endif; ?>
                <div class="form-group row mb-1">
                    <label for="pseud" class="col-sm-5 col-form-label">Pseudo : <?php if (!empty($pseudo_vide)) : ?>
                                    <span class=" text-danger text-start">
                                        <?= $pseudo_vide ?>
                                    </span>
                                <?php endif; ?></label>
                    <div>
                        <input type="text" class="form-control" id="pseudo  " aria-describedby="emailHelp" placeholder="Le pseudo visible sur vos annonces" name="pseudo" value="<?php echo isset($_POST['pseudo']) ? htmlspecialchars($_POST['pseudo']) : ''; ?>">
                    </div>
                </div>
                
                <div class="form-group row mt-1">
                    <label for="tel" class="col-sm-5 col-form-label">N° Téléphone : <?php if (!empty($tel_vide)) : ?>
                                    <span class=" text-danger text-start">
                                        <?= $tel_vide ?>
                                    </span>
                                <?php endif; ?><?php if (!empty($tel_error)) : ?>
                                    <span class=" text-danger text-start">
                                        <?= $tel_error ?>
                                    </span>
                                <?php endif; ?></label>
                    <div>
                        <input type="tel" class="form-control" id="tel  " aria-describedby="emailHelp" placeholder="Votre numéro de téléphone" name="tel" value="<?php echo isset($_POST['tel']) ? htmlspecialchars($_POST['tel']) : ''; ?>">
                    </div>
                </div>
                <div class="form-group row mt-1">
                    <label for="telw" class="col-sm-5 col-form-label">N° Whatsapp : <?php if (!empty($telw_error)) : ?>
                                    <span class=" text-danger text-start">
                                        <?= $telw_error ?>
                                    </span>
                                <?php endif; ?></label>
                    <div>
                        <input type="tel" class="form-control" id="telw  " aria-describedby="emailHelp" placeholder="Votre numéro whatsapp" name="telw" value="<?php echo isset($_POST['telw']) ? htmlspecialchars($_POST['telw']) : ''; ?>">
                    </div>
                </div>
                <div class="form-group row mt-1 mb-3">
                            <label for="desc" class="col-sm-5 col-form-label">Votre demande : <?php if (!empty($desc_vide)) : ?>
                                    <span class=" text-danger text-start">
                                        <?= $desc_vide ?>
                                    </span>
                                <?php endif; ?></label>
                            <textarea class="form-control" rows="5" id="desc" name="desc" style="resize:none;"></textarea>
                 </div>
                <button type="submit" name="submit" class="btn btn-primary">Publier</button>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <!--javaSCript-->
    <script src="main.js"></script>
    <script src="//code.tidio.co/soutospimq4pk32r0mcxjjhtoqnjc0de.js" async></script>
    
</body>

</html>