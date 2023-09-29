<?php
if (!empty($_POST)) {
    $errors;
    $errors_user;
    $invalide_pass;
    $user = htmlspecialchars($_POST["user"]);
    $password = htmlspecialchars($_POST["password"]);
    ///////////////////////////////////////////////////////////////////////////////////////////////////
    if (isset($_POST["user"], $_POST["password"]) && !empty($_POST["user"]) && !empty($_POST["password"])) {
        require '../conf/login_data.php';
        ///////////////////////////////////////////////////////////////////////////////////////////////
        $req = $loginData->prepare("SELECT * FROM admins WHERE (user = :user)");
        $req->bindValue(":user", $user, PDO::PARAM_STR);
        $req->execute();
        //conditions de connexion ici//////////
        $userinfo = $req->fetch();
        if (!$userinfo) {
            $errors_user = "Entrer les bons identifiants";
        } elseif (!password_verify($_POST['password'], $userinfo['password'])) {
            $invalide_pass = "Entrer les bons identifiants";
        } else {
            session_start();
            $_SESSION['id_admin'] = $userinfo['id_admin'];
            $_SESSION['user'] = $userinfo['user'];
            // header("Location: http://courtimmo.rf.gd/adminaxel/");
            header("Location: index.php");
            
        }
    } else {
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
    <script src="../cdn/font-awesome4/fonts/FontAwesome.otf"></script>
    <link rel="stylesheet" href="../cdn/font-awesome4/css/font-awesome.css">
    <!--fontawesome 6-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--bootstrap-->
    <link href="../cdn/bootstrap5/css/bootstrap.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!--sweetalert-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <!--font google -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500&family=Open+Sans:wght@300;400&display=swap" rel="stylesheet">
    <!-- title bar icon -->
    <link rel="shortcut icon" type="imge/x-icon" href="../img/title-bar-icon.png">
    <link rel="stylesheet" href="style.css">
    <title>Administration</title>
</head>

<body>


    <div class="" style="width:100%; height:100vh; background:url('img/icon.png')no-repeat; background-position:center; position:relative;">
        <div class="filter"></div>
        <div class="container box-connexion pt-5 mb-5">
            <h3 class="mb-5">Connectez vous à votre Administration</h3>
            <?php if (!empty($errors)) : ?>
                <p class="alert alert-danger text-center">
                    <?= $errors ?>
                </p>
            <?php endif; ?>
            <form method="POST" class="mb-5">
                <div class="form-group mb-4">
                    <label for="user">Utilisateur :</label>
                    <input type="text" class="form-control" id="user" aria-describedby="emailHelp" placeholder="Votre nom d'utilisateur" name="user">
                    <?php if (!empty($errors_user)) : ?>
                        <p class="text-danger text-start">
                            <?= $errors_user ?>
                        </p>
                    <?php endif; ?>
                </div>
                <div class="form-group mb-2">
                    <label for="pass">Mot de passe :</label>
                    <input type="password" class="form-control" id="pass" placeholder="Votre mot de passe" name="password">
                    <div class="para-alert">
                        <?php if (!empty($invalide_pass)) : ?>
                            <p class="text-danger text-start">
                                <?= $invalide_pass ?>
                            </p>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="mb-4">
                    <a href="new_admin.php">Ajouter nouvel admin</a>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Connexion</button>
                </div>
            </form>

        </div>
    </div>
    <!--javascript bootstrap-->
    <script src="cdn/bootstrap5/js/bootstrap.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <!--javaSCript-->
    <script src="main.js"></script>
</body>

</html>