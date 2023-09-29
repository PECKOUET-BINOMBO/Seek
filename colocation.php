<?php
session_start();
require "time_ago.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content=" Des milliers d'annonces uniques annonces en exclusivitées et sans doublons. Pour une recherche immobilière rapide et efficace, Économisez du temps avec notre service de correspondance. Trouvez, achetez ou louez en toute simplicité. Essayez dès maintenant et trouvez le collocataire de vos rêves">
    <!--fontawesome 4-->
    <script src="https://kit.fontawesome.com/727be77922.js" crossorigin="anonymous"></script>
    <script src="cdn/font-awesome4/fonts/FontAwesome.otf"></script>
    <link rel="stylesheet" href="cdn/font-awesome4/css/font-awesome.css">
    <!--fontawesome 6-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--bootstrap-->
    <link href="cdn/bootstrap5/css/bootstrap.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!--sweetalert-->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!--font google -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500&family=Open+Sans:wght@300;400&display=swap" rel="stylesheet">
    <!-- title bar icon -->
    <link rel="shortcut icon" type="imge/x-icon" href="img/title-bar-icon.png">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <style>
        .navbar-light .navbar-nav .colocation_link {
            color: #ec3e0e !important;
        }
        .desc2{
            max-height: 200px!important; 
            overflow:auto!important;
            overflow-wrap: break-word!important;
            width: 95%;
            margin: 15px auto;
        }
        .tt .dm:visited{
            color: #fff;
        }
        .mycard__content{
    display: flex;
    align-items: center;
    padding: 10px 15px 0px 15px!important;
        }
        .mycard__content img{
            object-fit: cover;
            object-position: center;
            width: 13%;

        }
    </style>
    <link rel="stylesheet" href="style.css">
    <title>Collocations</title>
</head>

<body>

    <?php if (isset($_SESSION['add_dem'])) : ?>
        <script>
            swal({
                //title: 'Annonce  envoyée ',
                text: '<?= $_SESSION['add_dem'] ?>',
                icon: 'success',
                buttons: 'Ok',
            }).then((result) => {
                if (result) {}
            });
            var swalText = document.querySelector('.swal-text');
            if (swalText) {
                swalText.style.textAlign = 'center';
            }
        </script>
    <?php unset($_SESSION['add_dem']);
    endif; ?>
    <div class="container-fluid-xs container-xxl pd" style="padding-right: var(--bs-gutter-x,.0rem);">
        <div class="row">
            <?php include "header_contact.php" ?>
            <?php include "logo_menu.php" ?>
            <div class="container mt-5 mb-5 p-0 tt">
                <button class="btn btn-success" style="margin-left: 10px;">
                <a href="addcolocation.php" class="dm mx-2"> <i class="fa-solid fa-circle-plus" style="font-size: 0.9rem;"></i> Collocation</a>
                </button>

                <?php
                    $valider ="oui";
                    $req = $loginData->prepare("SELECT * FROM colocation WHERE valider = ? ORDER BY id_demande DESC");
                    $req->execute([$valider]);

                    if($req->rowCount() == 0){

                        ?>
                         <div class="delete_padding mx-auto my-5" style="width: 98%;">
                            <p class="alert alert-success text-center fw-bolder "> Soyez le premier à poster une demande ou revenez plus tard.</p>
                        </div>
                        <?php
                    }else{ ?>
                        <div class="mycards my-2">
                    
                   <?php while ($resultat = $req->fetch(PDO::FETCH_ASSOC)) : ?>
                        <a href="#" class="mycard" style="cursor:default;">
                            <div class="mycard__content">
                                <i class="fa-solid fa-user"></i><p class="titre"><?= $resultat['pseudo'] ?></p>
                            </div>
                            <div class=" desc2">
                                <p><?= $resultat['demande'] ?></p>
                            </div>
                            <div class="mycard__time">
                                <div>
                                    <i class="fa-solid fa-clock-rotate-left"></i>
                                    <?php echo time_ago($resultat['date_add']); ?>
                                </div>
                            </div>
                            <div style="padding: 3px 15px;">
                                <table>
                                    <tr>
                                        <td class="tel">
                                            <!-- lier tables -->
                                            <div style="display: flex;align-items: center;justify-content: center;">
                                                <a href="tel:<?= $resultat['tel'] ?>" ><i class="fa fa-phone bg-primary text-light p-2 rounded-circle mx-2" style="font-size:1em;"></i></a>
                                                <a href="https://wa.me/<?= $resultat['telw'] ?>"  target="_blank"> <i class="fa fa-whatsapp bg-success text-light p-2 rounded-circle" style="font-size:1em;"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </a>
                    <?php endwhile ?>
                </div>
                        <?php }
?>
                
                <?php include "partials/progres/progres.php" ?>
            </div>
            <?php include "footer.php" ?>
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
    <script src="//code.tidio.co/soutospimq4pk32r0mcxjjhtoqnjc0de.js" async></script>

</body>

</html>