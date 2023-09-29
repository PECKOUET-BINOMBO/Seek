<?php
session_start();
if(empty($_GET['me'])){
   
    $_SESSION['msg'] = "Veuillez réessayer";
    header('Location: pass_lost.php');
}
if(isset($_POST['submit'])){
        $recup_email = $_GET['me'];
        $password = $_POST['password'];
        $errors;
        $passwordInvalide;
        if(isset($_POST['password'], $_POST['conf_password']) AND !empty($_POST['password']) AND !empty($_POST['conf_password'])){ 
            if($_POST['password'] !==  $_POST['conf_password']){
                $passwordInvalide = "Les mots de passe ne correspondent pas !";
            }else{
                require 'conf/login_data.php';
                $req = $loginData->prepare("UPDATE annonceurs SET password = ? WHERE email = ?");
                $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $req->execute(array($password, $recup_email));
               if($req){
                 $_SESSION['updatemsg'] = "Mot de passe réinitialisé avec success. Veuillez vous reconnecter";
                header('Location: connexion.php');
               }
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
    <title> Mot de passe oublié</title>
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

            <div class="container box-lost mt-5">
                <?php if (!empty($errors)) : ?>
                <p class=" alert alert-danger text-center">
                    <?= $errors ?>
                </p>
                <?php endif; ?>
                <h3>Entrez votre nouveau mot de passe</h3>
                <p>Modifier votre mot de passe depuis cette page, <span>pour tout
                        changement il est possible que vous soyez déconnecté .</span> </p>
                <form method="POST" class="forms col-sm-12 col-md-6 col-lg-5 col-xl-4">
                    <div class="form-group div-form mb-1 ">

                        <label for="pass">Nouveau mot de passe</label>
                        <div class="voirpass">
                            <input type="password" class="form-control" id="password" placeholder="Mot de passe"
                            name="password">
                            <i class="fa-solid fa-eye" id="eye"></i>
                            <?php if (!empty($passwordInvalide)) : ?>
                            <p class=" text-danger text-start m-0">
                                <?= $passwordInvalide ?>
                            </p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group div-form mb-1 pb-2">
                        <label for="conf_pass">Confirmer mot de passe</label>
                        <div class="voirpass">
                                <input type="password" class="form-control" id="conf_pass"
                                placeholder="Confirmation du mot de passe" name="conf_password">
                                <i class="fa-solid fa-eye" id="eye2"></i>
                            <?php if (!empty($passwordInvalide)) : ?>
                            <p class=" text-danger text-start m-0">
                                <?= $passwordInvalide ?>
                            </p>
                            <?php endif; ?>
                        </div>
                        
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary mb-5">Enregister</button>
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