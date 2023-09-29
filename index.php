<?php
session_start();
$pseudo =  isset($_SESSION['pseudo']) ?  $_SESSION['pseudo'] : NULL;
$_SESSION['free'] = 'Félicitation ' . $pseudo . ' vous profitez de la période d\'ajout gratuite';
require 'conf/login_data.php';
if (isset($_POST['rechercher'])) {
    $types = isset($_POST['type']) ? $_POST['type'] : NULL;
    $ville = isset($_POST['ville']) ? $_POST['ville'] : NULL;
    $quartier = isset($_POST['quartier']) ? $_POST['quartier'] : NULL;
    $minim = isset($_POST['min']) ? $_POST['min'] : NULL;
    $maxim = isset($_POST['max']) ? $_POST['max'] : NULL;
    if ( //all
        (!empty($_POST['type']) && !empty($_POST['ville']) && !empty($_POST['quartier']) && !empty($_POST['min']) && !empty($_POST['max'])) || 
        
        //type ou ville ou quatier ou min ou max
        (!empty($_POST['type']) || !empty($_POST['ville']) || !empty($_POST['quartier']) || !empty($_POST['min']) || !empty($_POST['max'])) || 
        
        //type et ville
        (!empty($_POST['type']) && !empty($_POST['ville'])) || 
        
        //type et quartier
        (!empty($_POST['type']) && !empty($_POST['quartier'])) ||

        //type et min
        (!empty($_POST['type']) && !empty($_POST['min'])) ||
        
        //type et max
        (!empty($_POST['type']) && !empty($_POST['max'])) ||

        //ville et quartier
        (!empty($_POST['quartier']) && !empty($_POST['ville'])) ||

        //ville et min
        (!empty($_POST['ville']) && !empty($_POST['min'])) ||
        
        //ville et max
        (!empty($_POST['ville']) && !empty($_POST['max'])) ||

        //quartier et min
        (!empty($_POST['quartier']) && !empty($_POST['min'])) ||
        
        //quartier et max
        (!empty($_POST['quartier']) && !empty($_POST['max'])) ||

        //min et max
        (!empty($_POST['min']) && !empty($_POST['max']))
    ){

        if (!empty($minim) and !empty($maxim)) {
            if($minim < $maxim){
                header("Location: filtre_page.php?type=$types&ville=$ville&quartier=$quartier&min=$minim&max=$maxim");
                exit;
            } else {
            $error_prix = "Prix invalide";
            }
        }else{
            header("Location: filtre_page.php?type=$types&ville=$ville&quartier=$quartier&min=$minim&max=$maxim");
            exit;
        }
    } else {
        // $errors_critere="Veuillez remplir tous les champs" ;
        $errors_critere = "Recherche invalide";
}
}



?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--  -->
    <meta name="description" content=" Des milliers d'annonces uniques annonces en exclusivitées et sans doublons. Pour une recherche immobilière rapide et efficace, Économisez du temps avec notre service de correspondance. Trouvez, achetez ou louez en toute simplicité. Essayez dès maintenant.">
    <!--fontawesome 4-->
    <script src="https://kit.fontawesome.com/727be77922.js" crossorigin="anonymous"></script>
    <script src="cdn/font-awesome4/fonts/FontAwesome.otf"></script>
    <link rel="stylesheet" href="cdn/font-awesome4/css/font-awesome.css">
    <!--fontawesome 6-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!--bootstrap
<link href="cdn/bootstrap5/css/bootstrap.css" rel="stylesheet">-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


    <link rel="stylesheet" href="cdn/bootstrap5/css/bootstrap.css">
   <!--sweetalert-->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <!-- title bar icon -->
    <link rel="shortcut icon" type="imge/x-icon" href="img/title-bar-icon.png">
    <!-- css -->
    <link rel="stylesheet" href="style.css">
    <title>Accueil</title>
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
    

    <div class="container-fluid-xs container-xxl">
        <div class="row">
            <div class="col scroll">
                
                <?php include "logo_menu.php" ?>
                <?php include "filter-map.php" ?>
                <?php include "categories.php" ?>
                <?php include "annonce-index.php" ?>
                <?php include "partials/progres/progres.php" ?>
                <?php include "footer.php" ?>
            </div>
        </div>
    </div>
   
    <!--javascript bootstrap-->
<script src="cdn/bootstrap5/js/bootstrap.js"></script>

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

