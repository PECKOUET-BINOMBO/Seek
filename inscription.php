<?php
session_start();
require "sendmail.php";

$errors;
$pseudoInvalide = null;
$pseudoUtilise = null;
$emailInvalide = null;
$emailUtilise = null;
$telInvalide = null;
$passwordInvalide = null;

if (isset($_POST['submit'])) {
    $pseudo = htmlspecialchars($_POST["pseudo"]);
    $email = htmlspecialchars($_POST["email"]);
    $tel = htmlspecialchars($_POST["tel"]);
    $telw = htmlspecialchars($_POST["telw"]);
    $password = htmlspecialchars($_POST["password"]);
    $conf_password = htmlspecialchars($_POST["conf_password"]);

    if (empty($pseudo) || empty($email) || empty($tel) || empty($password) || empty($conf_password)) {
        $errors = "Veuillez remplir tous les champs";
    } else {
        // Vérification du pseudo
        if (!preg_match('/^[a-zA-Z0-9_" "]+$/', $pseudo)) {
            $pseudoInvalide = "Pseudo invalide";
            $errors = $pseudoInvalide;
        }
        require "conf/login_data.php";
        $req = $loginData->prepare('SELECT * FROM annonceurs WHERE pseudo = :pseudo AND verifie = "oui"');
        $req->execute(array('pseudo' => $pseudo));
        $result = $req->fetch();
        if ($result) {
            $pseudoUtilise = "Ce pseudo est déjà utilisé";
            $errors = $pseudoUtilise;
        }

        // Vérification de l'email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailInvalide = "Adresse e-mail invalide";
            $errors = $emailInvalide;
        }
        $req = $loginData->prepare('SELECT * FROM annonceurs WHERE email = :email AND verifie = "oui"');
        $req->execute(array('email' => $email));
        $result = $req->fetch();
        if ($result) {
            $emailUtilise = "Cet email est déjà utilisé";
            $errors = $emailUtilise;
        }

        // Vérification du numéro de téléphone
        if (!preg_match('/^(221|00221|\+221)?(77|78|75|70|76)[0-9]{7}$/', $tel)) {
            $telInvalide = "Format invalide";
            $errors = $telInvalide;
        }

        // Vérification du mot de passe
        if ($password !== $conf_password) {
            $passwordInvalide = "Les mots de passe ne correspondent pas";
            $errors = $passwordInvalide;
        }

        // Insertion des données
        if (empty($errors)) {
            date_default_timezone_set('Africa/Dakar');
            $date = date('d-m-Y H:i:s');

            $token = base_convert(hash('sha256', time() . mt_rand()), 16, 36);
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $req = $loginData->prepare("INSERT INTO annonceurs SET pseudo = ?, email = ?, tel = ?, telw = ?, password = ?, date_inscription = ?, token = ?");
            $req->execute([$pseudo, $email, $tel,$telw, $password,  $date, $token]);

            $last_id = $loginData->lastInsertId();
            if ($req) {
                sendmail();
                $success = "Veuillez consulter vos e-mails pour activer votre compte.";
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
    <title>Inscrivez-vous</title>
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
            <?php if (isset($_SESSION['compteInvalide'])) : ?>
                <p class="alert alert-danger text-center m-0"><?= $_SESSION['compteInvalide'] ?></p>
            <?php unset($_SESSION['compteInvalide']);
            endif; ?>
            <?php if (isset($_SESSION['delete_compte'])) : ?>
                    <script>
                        swal({
                            text: ' <?= $_SESSION['delete_compte'] ?>',
                            icon: 'success',
                            buttons: 'ok',
                        }).then((result) => {
                                        if (result) {
                                        }
                                    });
                                    var swalText = document.querySelector('.swal-text');
                            if (swalText) {
                                swalText.style.textAlign = 'center';
  }
        </script>
            <?php unset($_SESSION['delete_compte']); endif; ?>
            <?php if (!empty($success)) : ?>
                <script>
                        swal({
            //title: 'Annonce  envoyée ',
            text: ' <?= $success ?>',
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
               <!-- <p class="alert alert-success text-center mt-3">
                     <?= $success ?>
                </p> -->
            <?php endif; ?>
            <?php if (!empty($echec)) : ?>
                <p class="alert alert-danger text-center mt-3">
                    <?= $echec ?>
                </p>
            <?php endif; ?>
            <?php if (!empty($errors)) : ?>
                <p class="alert alert-danger text-center mt-3">
                    <?= $errors ?>
                </p>
            <?php endif; ?>
            <form method="POST" class="forms col-sm-12 col-md-7 col-lg-6 col-xl-5 mt-4">
                <h3 class="mb-4 text-center">S' inscrire</h3>
                <div class="form-group row mb-1">
                    <label for="pseud" class="col-sm-5 col-form-label">Pseudo :</label>
                    <div>
                        <input type="text" class="form-control" id="pseudo  " aria-describedby="emailHelp" placeholder="Le pseudo visible sur vos annonces" name="pseudo" value="<?php echo isset($_POST['pseudo']) ? htmlspecialchars($_POST['pseudo']) : ''; ?>">
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
                <div class="form-group row mt-1">
                    <label for="emailHelp" class="col-sm-5 col-form-label">Adresse-Email :</label>
                    <div>
                        <input type="email" class="form-control" id="emailHelp  " aria-describedby="emailHelp" placeholder="Votre adresse email" name="email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
                        <div id="emailHelp" class="form-text text-warning">Entrez une adresse e-mail valide pour activer votre compte.
                            .</div>
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
                <div class="form-group row mt-1">
                    <label for="tel" class="col-sm-5 col-form-label">N° Téléphone :</label>
                    <div>
                        <input type="tel" class="form-control" id="tel  " aria-describedby="emailHelp" placeholder="Votre numéro de téléphone" name="tel" value="<?php echo isset($_POST['tel']) ? htmlspecialchars($_POST['tel']) : ''; ?>">
                        <div class="para-alert">
                            <?php if (!empty($telInvalide)) : ?>
                                <p class=" text-danger text-start">
                                    <?= $telInvalide ?>
                                </p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row mt-1">
                    <label for="tel" class="col-sm-5 col-form-label">N° Whatsapp :</label>
                    <div>
                        <input type="tel" class="form-control" id="tel  " aria-describedby="emailHelp" placeholder="Votre numéro whatsapp" name="telw" value="<?php echo isset($_POST['tel']) ? htmlspecialchars($_POST['tel']) : ''; ?>">
                    </div>
                </div>
                <div class="form-group row mt-1">
                    <label for="pass" class="col-sm-5 col-form-label">Mot de passe </label>
                    <div class="voirpass">
                        <input type="password" class="form-control" id="password" placeholder="Votre mot de passe" name="password">
                        <i class="fa-solid fa-eye" id="eye"></i>
                    </div>
                </div>
                <div class="form-group row mt-1">
                    <label for="conf_pass" class="col-sm-8 col-form-label">Confirmer votre mot de passe</label>
                    <div class="voirpass">
                        <input type="password" class="form-control" id="conf_pass" placeholder="Confirmer votre mot de passe" name="conf_password">
                        <i class="fa-solid fa-eye" id="eye2"></i>
                        <div class="para-alert">
                            <?php if (!empty($passwordInvalide)) : ?>
                                <p class=" text-danger text-start">
                                    <?= $passwordInvalide ?>
                                </p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row my-3">
                    <div>
                        <button type="submit" name="submit" class="btn btn-primary">Créer mon compte</button>
                    </div>
                </div>
                <div class="form-group row">
                    <div>
                        <p class="" style="font-size: 0.8rem;">Déjà un compte ? <a href="connexion.php">Se connecter</a></p>
                    </div>
                </div>
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