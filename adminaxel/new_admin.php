<!DOCTYPE html>
<?php
if (isset($_POST['submit'])) {
    $userUtilise;
    $user = htmlspecialchars($_POST["user"]);
    $password = htmlspecialchars($_POST["password"]);
    $conf_password = htmlspecialchars($_POST["conf_password"]);

    ///////////////////////////////////////////////////////////////////////////////////////////////////////
    if (isset($_POST["user"], $_POST["password"], $_POST["conf_password"]) && !empty($_POST["user"]) && !empty($_POST['password']) && !empty($_POST['conf_password'])) {
        ///////////////////////////////////////////////////////////////////////////////////////////////////
        require "../conf/login_data.php";
        $verif = $loginData->prepare('SELECT * FROM admins WHERE user = :user');
        $verif->execute(array('user' => $user));
        $result_verif = $verif->fetch();
        if ($result_verif) {
            $userUtilise = "Ce pseudo  est déjà utilisé";
        }
        /////////////////////////////////////////////////////////vérification_password/////////////////////
        if ($password !== $conf_password) {
            $passwordInvalide = "Les mots de passe ne correspondent pas";
        }
        ////////////////////////////////////////////////////////insertion_données//////////////////////////
        if (empty($passwordInvalide) && empty($userUtilise)) {
            $date = date('d/m/y');
            $echec;
            $success;
            $req = $loginData->prepare("INSERT INTO admins SET user = ?, password = ?, date_inscription = ?");
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $req->execute([$user, $password,  $date]);
            $user  = $req->fetch();
            ///////////////////////////////////////////////////////////////////////////////////////////////
            if ($req) {
                $id = $loginData->lastInsertId();
                $id_user = $id;
                header("Location: connexion.php?id=$id_user");
            } else {
                $echec = 'Echec de l\'inscription .Veuilez recommencer';
            }
        }
    } else {
        $errors = "Veuillez remplir tous les champs";
    }
}

?>

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
            <h3 class="mb-5">Nouvel administrateur</h3>
            <?php if (!empty($errors)) : ?>
                <p class="alert alert-danger text-center">
                    <?= $errors ?>
                </p>
            <?php endif; ?>
            <form method="POST" class="mb-5">
                <div class="box_i form-group div-form mb-4">
                    <label for="user">Utilisateur :</label>
                    <input type="text" class="form-control" id="user " aria-describedby="emailHelp" placeholder="Nom d'utilisateur" name="user">
                    <?php if (!empty($userUtilise)) : ?>
                        <p class=" text-danger text-start">
                            <?= $userUtilise ?>
                        </p>
                    <?php endif; ?>
                </div>
                <div class="box_i form-group div-form mb-2">
                    <label for="pass">Mot de passe </label>
                    <input type="password" class="form-control" id="pass" placeholder="Mot de passe" name="password">
                    <div class="para-alert">
                        <?php if (!empty($invalide)) : ?>
                            <p class=" text-danger text-start">
                                <?= $invalide ?>
                            </p>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="box_i form-group div-form mb-4 pb-2">
                    <label for="conf_pass">Confirmer votre mot de passe</label>
                    <input type="password" class="form-control" id="conf_pass" placeholder="Confirmer votre mot de passe" name="conf_password">
                    <div class="para-alert">
                        <?php if (!empty($passwordInvalide)) : ?>
                            <p class=" text-danger text-start">
                                <?= $passwordInvalide ?>
                            </p>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="box_i mb-4">
                    <a href="connexion.php">Se connecter</a>
                </div>
                <div class="box_i form-group">
                    <button type="submit" class="btn" name="submit" style=" background:#ec3e0e; color:#fff; font-weight:500;">Créer</button>
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