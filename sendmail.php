<?php

use PHPMailer\PHPMailer\PHPMailer;

function sendmail()
{
    $name = "Court.immo.sn";  // Name of your website or yours
    global $email, $pseudo, $token, $last_id;
    $to = $email;  // mail of reciever
    $subject = "Confirmation de compte";
    $body = "<h1 style ='text-transform: capitalize'>Bienvenue " . $pseudo . " </h1>
    <h3> Cliquez sur le lien ci-dessous pour activer votre compte annonceur. </h3>
    <h4>Veuillez respecter les règles suivantes :</h4> 
    <ul>
        <li>Ne pas inclure le prix dans le titre.</li>
        <li>Ne pas mentionner vos coordonnées (téléphone, e-mail...) dans la description.</li>
        <li>Ne pas publier la même annonce plusieurs fois.</li>
        <li>Ne pas vendre d'objets ou de services illégaux.</li>
    </ul>
    <br>
    <a target = '_blank' href='http://localhost/projet-site-de-courtage/confirm.php?me=$last_id&token=$token'>
    http://localhost/projet-site-de-courtage/confirm.php?me=$last_id&token=$token
    </a>";
    $from = "court.immo.sn@gmail.com";  // you mail
    $password = "irlhkxqrpmrxaehx";  // your mail password

    // Ignore from here

    require_once "PHPMailer/PHPMailer.php";
    require_once "PHPMailer/SMTP.php";
    require_once "PHPMailer/Exception.php";
    $mail = new PHPMailer();

    // To Here

    //SMTP Settings
    $mail->isSMTP();
    // $mail->SMTPDebug = 3;  Keep It commented this is used for debugging                          
    $mail->Host = "smtp.gmail.com"; // smtp address of your email
    $mail->SMTPAuth = true;
    $mail->Username = $from;
    $mail->Password = $password;
    $mail->Port = 587;  // port
    $mail->SMTPSecure = "tls";  // tls or ssl
    $mail->smtpConnect([
        'ssl' => [
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        ]
    ]);

    //Email Settings
    $mail->isHTML(true);
    $mail->setFrom($from, $name);
    $mail->addAddress($to); // enter email address whom you want to send
    $mail->Subject = ("$subject");
    $mail->Body = $body;
    if ($mail->send()) {
        global $success, $echec;
        $success = "Vérifiez votre boîte e-mail et cliquez sur le lien de confirmation de votre compte.";
    } else {
        $echec = 'Echec de l\'inscription' . $mail->ErrorInfo;
    }
}

function passlost()
{
    $name = "Court.immo.sn";  // Name of your website or yours
    global $email, $token, $pseudo;
    $to = $email;  // mail of reciever
    $subject = "Reinitialisation mot de passe";
    $body = " <h2><span style ='text-transform: capitalize'>" . $pseudo . "</span> cherchez-vous à modifer votre mot de passe ? </h2>
    <p>Si oui, cliquez sur le lien ci-dessous. </p>
    <a target = '_blank' href='http://localhost/projet-site-de-courtage/pass_change.php?me=$email'>
    http://localhost/projet-site-de-courtage/pass_change.php?me=$email&sec=$token
    </a>";
    $from = "court.immo.sn@gmail.com";  // you mail
    $password = "irlhkxqrpmrxaehx";  // your mail password

    // Ignore from here

    require_once "PHPMailer/PHPMailer.php";
    require_once "PHPMailer/SMTP.php";
    require_once "PHPMailer/Exception.php";
    $mail = new PHPMailer();

    // To Here

    //SMTP Settings
    $mail->isSMTP();
    // $mail->SMTPDebug = 3;  Keep It commented this is used for debugging                          
    $mail->Host = "smtp.gmail.com"; // smtp address of your email
    $mail->SMTPAuth = true;
    $mail->Username = $from;
    $mail->Password = $password;
    $mail->Port = 587;  // port
    $mail->SMTPSecure = "tls";  // tls or ssl
    $mail->smtpConnect([
        'ssl' => [
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        ]
    ]);

    //Email Settings
    $mail->isHTML(true);
    $mail->setFrom($from, $name);
    $mail->addAddress($to); // enter email address whom you want to send
    $mail->Subject = ("$subject");
    $mail->Body = $body;
    if ($mail->send()) {
        global $success, $echec;
        $success = "Veuillez vérifier votre boîte e-mail et cliquer sur le lien de modification.";
    } else {
        $echec = 'Echec de l\'envoie' . $mail->ErrorInfo;
    }
}


function signal()
{
    $name = "Court.immo.sn";  // Name of your website or yours
    global $email, $pseudo, $data2, $data, $rec, $rec2, $signal;
    $to = "court.immo.sn@gmail.com";  // mail of reciever
    $subject = "Annonce signale";
    $body = " <h2><span style ='text-transform: capitalize'>Message de " . $pseudo . "</span> </h2>
    <p>" . $signal . " </p>
    <h3>Informations sur l'annonce :</h3>
    <p>Annonceur : " . $data2['pseudo'] . " </p>
    <p>Identifiant de l'annonce : " . $data['id_annonces'] . " </p>
    <p>Date d'ajout :  " . $data['date_add'] . "</p>
    <a target = '_blank' href='http://localhost/projet-site-de-courtage/admin/signal_page.php?id=$rec&annonce=$rec2'>Voir l'annonce</a>
    <p>Repondre : $email</p>";

    $from = "court.immo.sn@gmail.com"; // you mail
    $password = "irlhkxqrpmrxaehx"; // your mail password

    // Ignore from here

    require_once "PHPMailer/PHPMailer.php";
    require_once "PHPMailer/SMTP.php";
    require_once "PHPMailer/Exception.php";
    $mail = new PHPMailer();

    // To Here

    //SMTP Settings
    $mail->isSMTP();
    // $mail->SMTPDebug = 3; Keep It commented this is used for debugging
    $mail->Host = "smtp.gmail.com"; // smtp address of your email
    $mail->SMTPAuth = true;
    $mail->Username = $from;
    $mail->Password = $password;
    $mail->Port = 587; // port
    $mail->SMTPSecure = "tls"; // tls or ssl
    $mail->smtpConnect([
        'ssl' => [
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        ]
    ]);

    //Email Settings
    $mail->isHTML(true);
    $mail->setFrom($from, $name);
    $mail->addAddress($to); // enter email address whom you want to send
    $mail->Subject = ("$subject");
    $mail->Body = $body;
    if ($mail->send()) {
        global $success, $echec;
        $success = "Message envoyé : l'annonce sera examinée par nos services. Merci";
    } else {
        $echec = 'Echec de l\'envoie' . $mail->ErrorInfo;
    }
}


function renouvellement()
{
    $name = "Court.immo.sn";  // Name of your website or yours
    global $email, $pseudo, $rec, $rec2;
    $to = $email;  // mail of reciever
    $subject = "Renouvellement d'annonce ";
    $body = "<h1 style ='text-transform: capitalize'>&#128722; Felicitation " . $pseudo . " </h1>
    <p>Votre annonce a été renouvellée avec success.</p> <br>
    <a target = '_blank' href='http://localhost/projet-site-de-courtage/plus_de_details.php?id=$rec&annonce=$rec2'>
    Voire l'annonce
    </a>";
    $from = "court.immo.sn@gmail.com";  // you mail
    $password = "irlhkxqrpmrxaehx";  // your mail password

    // Ignore from here

    require_once "PHPMailer/PHPMailer.php";
    require_once "PHPMailer/SMTP.php";
    require_once "PHPMailer/Exception.php";
    $mail = new PHPMailer();

    // To Here

    //SMTP Settings
    $mail->isSMTP();
    // $mail->SMTPDebug = 3;  Keep It commented this is used for debugging                          
    $mail->Host = "smtp.gmail.com"; // smtp address of your email
    $mail->SMTPAuth = true;
    $mail->Username = $from;
    $mail->Password = $password;
    $mail->Port = 587;  // port
    $mail->SMTPSecure = "tls";  // tls or ssl
    $mail->smtpConnect([
        'ssl' => [
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        ]
    ]);

    //Email Settings
    $mail->isHTML(true);
    $mail->setFrom($from, $name);
    $mail->addAddress($to); // enter email address whom you want to send
    $mail->Subject = ("$subject");
    $mail->Body = $body;
    if ($mail->send()) {
        global $success, $echec;
        $success = "Annonce renouvellé";
    } else {
        $echec = 'Echec du renouvellement' . $mail->ErrorInfo;
    }
}

function validation()
{
    $name = "Court.immo.sn";  // Name of your website or yours
    global $email, $pseudo, $id_annonceurs, $id_annonce;
    $to = $email;  // mail of reciever
    $subject = "Validation d'annonce";
    $body = " <h2>Félicitation " . $pseudo . "&#127881; &#127881;</h2>
    <p class='m-0'><span style ='text-transform: capitalize'></span> Votre annonce a été validée et est désormais disponible sur la plateforme. Pendant sa validité d'un mois, veillez à la mettre à jour en cas de changement</p>
    <a target = '_blank' href='http://localhost/projet-site-de-courtage/plus_de_details.php?id=$id_annonceurs&annonce=$id_annonce'>Voir l'annonce</a>";
    $from = "court.immo.sn@gmail.com";  // you mail
    $password = "irlhkxqrpmrxaehx";  // your mail password

    // Ignore from here

    require_once "PHPMailer/PHPMailer.php";
    require_once "PHPMailer/SMTP.php";
    require_once "PHPMailer/Exception.php";
    $mail = new PHPMailer();

    // To Here

    //SMTP Settings
    $mail->isSMTP();
    // $mail->SMTPDebug = 3;  Keep It commented this is used for debugging                          
    $mail->Host = "smtp.gmail.com"; // smtp address of your email
    $mail->SMTPAuth = true;
    $mail->Username = $from;
    $mail->Password = $password;
    $mail->Port = 587;  // port
    $mail->SMTPSecure = "tls";  // tls or ssl
    $mail->smtpConnect([
        'ssl' => [
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        ]
    ]);

    //Email Settings
    $mail->isHTML(true);
    $mail->setFrom($from, $name);
    $mail->addAddress($to); // enter email address whom you want to send
    $mail->Subject = ("$subject");
    $mail->Body = $body;
    if ($mail->send()) {
        global $success, $echec;
        $success = "Annonce validé";
    } else {
        $echec = 'Echec de la validation' . $mail->ErrorInfo;
    }
}

function delete_annonce()
{
    $name = "Court.immo.sn";  // Name of your website or yours
    global $email, $pseudo, $id_annonceurs, $id_annonce;
    $to = $email;  // mail of reciever
    $subject = "Suppression d'annonce";
    $body = " <h2>&#128532; &#128532;</h2>
    <p class='m-0'><span style ='text-transform: capitalize'> $pseudo </span> Nous vous informons que votre annonce a été supprimée par nos services. Pour obtenir plus d'informations, vous pouvez nous contacter à l'adresse ci-dessous:</p>
    <a href='mailto:court.immo.sn@gmail.com'>court.immo.sn@gmail.com</a>";
    $from = "court.immo.sn@gmail.com";  // you mail
    $password = "irlhkxqrpmrxaehx";  // your mail password

    // Ignore from here

    require_once "PHPMailer/PHPMailer.php";
    require_once "PHPMailer/SMTP.php";
    require_once "PHPMailer/Exception.php";
    $mail = new PHPMailer();

    // To Here

    //SMTP Settings
    $mail->isSMTP();
    // $mail->SMTPDebug = 3;  Keep It commented this is used for debugging                          
    $mail->Host = "smtp.gmail.com"; // smtp address of your email
    $mail->SMTPAuth = true;
    $mail->Username = $from;
    $mail->Password = $password;
    $mail->Port = 587;  // port
    $mail->SMTPSecure = "tls";  // tls or ssl
    $mail->smtpConnect([
        'ssl' => [
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        ]
    ]);

    //Email Settings
    $mail->isHTML(true);
    $mail->setFrom($from, $name);
    $mail->addAddress($to); // enter email address whom you want to send
    $mail->Subject = ("$subject");
    $mail->Body = $body;
    if ($mail->send()) {
        global $success, $echec;
        $success = "Annonce supprimé";
    } else {
        $echec = 'Echec de la suppression' . $mail->ErrorInfo;
    }
}


function idelete()
{
    $name = "Court.immo.sn";  // Name of your website or yours
    global $email, $pseudo;
    $to = $email;  // mail of reciever
    $subject = "Confirmation de suppression de votre annonce";
    $body = " <h2>&#128532; &#128532;</h2>
    <p class='m-0'><span style ='text-transform: capitalize'> $pseudo </span> Nous vous confirmons que votre annonce a bien été supprimée de notre plateforme. Nous vous remercions d'avoir utilisé notre service pour publier votre annonce et nous espérons que vous avez eu une expérience positive.</p>
    </br>
    <p>Si vous avez des questions ou besoin d'assistance supplémentaire, n'hésitez pas à nous contacter. Nous sommes là pour vous aider.</p>
    <a href='mailto:court.immo.sn@gmail.com'>court.immo.sn@gmail.com</a>";
    $from = "court.immo.sn@gmail.com";  // you mail
    $password = "irlhkxqrpmrxaehx";  // your mail password

    // Ignore from here

    require_once "PHPMailer/PHPMailer.php";
    require_once "PHPMailer/SMTP.php";
    require_once "PHPMailer/Exception.php";
    $mail = new PHPMailer();

    // To Here

    //SMTP Settings
    $mail->isSMTP();
    // $mail->SMTPDebug = 3;  Keep It commented this is used for debugging                          
    $mail->Host = "smtp.gmail.com"; // smtp address of your email
    $mail->SMTPAuth = true;
    $mail->Username = $from;
    $mail->Password = $password;
    $mail->Port = 587;  // port
    $mail->SMTPSecure = "tls";  // tls or ssl
    $mail->smtpConnect([
        'ssl' => [
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        ]
    ]);

    //Email Settings
    $mail->isHTML(true);
    $mail->setFrom($from, $name);
    $mail->addAddress($to); // enter email address whom you want to send
    $mail->Subject = ("$subject");
    $mail->Body = $body;
    if ($mail->send()) {
        global $success, $echec;
        $success = "Annonce supprimé";
    } else {
        $echec = 'Echec de la suppression' . $mail->ErrorInfo;
    }
}

function refus_annonce()
{
    $name = "Court.immo.sn";  // Name of your website or yours
    global $email, $pseudo;
    $to = $email;  // mail of reciever
    $subject = "Annonce refuse";
    $body = " <h2>&#10060; &#10060; <span style ='text-transform: capitalize'> $pseudo </span></h2>
    <div class='m-0'>
    
<p style ='text-align:justify;'> Nous vous informons que l'ajout de votre annonce a été refusé par nos services. Les raisons peuvent être liées à la qualité de vos informations et/ou de vos images.</p>

<p style ='text-align:justify;'>Concernant la qualité des images, assurez-vous que celles que vous avez téléchargées répondent aux critères de qualité de notre plateforme. Nous vous recommandons de vous assurer que les images sont claires, nettes et de bonne qualité.</p>

<p style ='text-align:justify;'>Nous vous invitons à refair votre annonce en prenant en compte ces points. Si vous avez des questions ou besoin de plus d'informations, n'hésitez pas à nous contacter à l'adresse ci-dessous. Nous sommes là pour vous aider à publier une annonce de qualité.</p>

<p>Cordialement,</p>
<p>L'équipe de LOGO</p>
    
    
    </div>
    <a href='mailto:court.immo.sn@gmail.com'>court.immo.sn@gmail.com</a>";
    $from = "court.immo.sn@gmail.com";  // you mail
    $password = "irlhkxqrpmrxaehx";  // your mail password

    // Ignore from here

    require_once "PHPMailer/PHPMailer.php";
    require_once "PHPMailer/SMTP.php";
    require_once "PHPMailer/Exception.php";
    $mail = new PHPMailer();

    // To Here

    //SMTP Settings
    $mail->isSMTP();
    // $mail->SMTPDebug = 3;  Keep It commented this is used for debugging                          
    $mail->Host = "smtp.gmail.com"; // smtp address of your email
    $mail->SMTPAuth = true;
    $mail->Username = $from;
    $mail->Password = $password;
    $mail->Port = 587;  // port
    $mail->SMTPSecure = "tls";  // tls or ssl
    $mail->smtpConnect([
        'ssl' => [
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        ]
    ]);

    //Email Settings
    $mail->isHTML(true);
    $mail->setFrom($from, $name);
    $mail->addAddress($to); // enter email address whom you want to send
    $mail->Subject = ("$subject");
    $mail->Body = $body;
    if ($mail->send()) {
        global $success, $echec;
        $success = "Annonce refusé";
    } else {
        $echec = 'Echec du refus' . $mail->ErrorInfo;
    }
}

function delete_annonceur()
{
    $name = "Court.immo.sn";  // Name of your website or yours
    global $email, $pseudo;
    $to = $email;  // mail of reciever
    $subject = "Compte supprime";
    $body = " <h2>&#128465; &#128465; <span style ='text-transform: capitalize'> $pseudo </span></h2>
    <p class='m-0'> Nous vous informons que votre compte annonceur a été supprimé. </br>Pour obtenir davantage d'informations, veuillez nous contacter à l'adresse indiquée ci-dessous :.</p>
    <a href='mailto:court.immo.sn@gmail.com'>court.immo.sn@gmail.com</a>";
    $from = "court.immo.sn@gmail.com";  // you mail
    $password = "irlhkxqrpmrxaehx";  // your mail password

    // Ignore from here

    require_once "PHPMailer/PHPMailer.php";
    require_once "PHPMailer/SMTP.php";
    require_once "PHPMailer/Exception.php";
    $mail = new PHPMailer();

    // To Here

    //SMTP Settings
    $mail->isSMTP();
    // $mail->SMTPDebug = 3;  Keep It commented this is used for debugging                          
    $mail->Host = "smtp.gmail.com"; // smtp address of your email
    $mail->SMTPAuth = true;
    $mail->Username = $from;
    $mail->Password = $password;
    $mail->Port = 587;  // port
    $mail->SMTPSecure = "tls";  // tls or ssl
    $mail->smtpConnect([
        'ssl' => [
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        ]
    ]);

    //Email Settings
    $mail->isHTML(true);
    $mail->setFrom($from, $name);
    $mail->addAddress($to); // enter email address whom you want to send
    $mail->Subject = ("$subject");
    $mail->Body = $body;
    if ($mail->send()) {
        global $success, $echec;
        $success = "Compte supprimé";
    } else {
        $echec = 'Echec de la suppression de compte' . $mail->ErrorInfo;
    }
}

function update()
{
    $name = "Court.immo.sn";  // Name of your website or yours
    global $email, $pseudo;
    $to = $email;  // mail of reciever
     $subject = "Annonce mise à jour";
     $body = " <h2> &#128229;  &#128229;<span style ='text-transform: capitalize'> $pseudo </span></h2>
     <p class='m-0 text-justify'> Félicitations pour avoir mis à jour votre annonce ! Votre engagement à garder votre annonce à jour montre que vous êtes un utilisateur sérieux et soucieux de fournir des informations précises à votre audience. Votre annonce est maintenant prête à attirer encore plus d'attention et d'intérêt de la part des utilisateurs. Continuez à garder votre annonce à jour pour maximiser vos chances de succès. Merci de faire partie de notre communauté et bonne chance avec votre annonce actualisée !</p>
     <a href='mailto:court.immo.sn@gmail.com'>court.immo.sn@gmail.com</a>";
     $from = "court.immo.sn@gmail.com";  // you mail
     $password = "irlhkxqrpmrxaehx";  // your mail password

     // Ignore from here

     require_once "PHPMailer/PHPMailer.php";
     require_once "PHPMailer/SMTP.php";
     require_once "PHPMailer/Exception.php";
     $mail = new PHPMailer();

     // To Here

     //SMTP Settings
     $mail->isSMTP();
     // $mail->SMTPDebug = 3;  Keep It commented this is used for debugging                          
     $mail->Host = "smtp.gmail.com"; // smtp address of your email
     $mail->SMTPAuth = true;
     $mail->Username = $from;
     $mail->Password = $password;
     $mail->Port = 587;  // port
     $mail->SMTPSecure = "tls";  // tls or ssl
     $mail->smtpConnect([
         'ssl' => [
             'verify_peer' => false,
             'verify_peer_name' => false,
             'allow_self_signed' => true
         ]
     ]);

     //Email Settings
     $mail->isHTML(true);
     $mail->setFrom($from, $name);
     $mail->addAddress($to); // enter email address whom you want to send
     $mail->Subject = ("$subject");
     $mail->Body = $body;
     if ($mail->send()) {
        global $success, $echec;
        $alerts = "Alert mail";
    } else {
        $echecalerts = 'Echec alertmail' . $mail->ErrorInfo;
    }
 }



function addann()
{
    $name = "Court.immo.sn";  // Name of your website or yours
    global $id_annonce;
    $to = "court.immo.sn@gmail.com";  // mail of reciever
    $subject = "Nouvelle Annonce";
    $body = " <h2>Cher(e) administrateur/administratrice</h2>
    <p class='m-0 text-justify'> Nous avons le plaisir de vous informer qu'une nouvelle Annonce a été ajoutée.</p>
    <p>Vous pouvez consulter les détails de l'annonce : <a target = '_blank' href='http://localhost/projet-site-de-courtage/adminaxel/view_admin.php?annonce=$id_annonce'>ici</a></p>";

    $from = "court.immo.sn@gmail.com"; // you mail
    $password = "irlhkxqrpmrxaehx"; // your mail password

    // Ignore from here

    require_once "PHPMailer/PHPMailer.php";
    require_once "PHPMailer/SMTP.php";
    require_once "PHPMailer/Exception.php";
    $mail = new PHPMailer();

    // To Here

    //SMTP Settings
    $mail->isSMTP();
    // $mail->SMTPDebug = 3; Keep It commented this is used for debugging
    $mail->Host = "smtp.gmail.com"; // smtp address of your email
    $mail->SMTPAuth = true;
    $mail->Username = $from;
    $mail->Password = $password;
    $mail->Port = 587; // port
    $mail->SMTPSecure = "tls"; // tls or ssl
    $mail->smtpConnect([
        'ssl' => [
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        ]
    ]);

    //Email Settings
    $mail->isHTML(true);
    $mail->setFrom($from, $name);
    $mail->addAddress($to); // enter email address whom you want to send
    $mail->Subject = ("$subject");
    $mail->Body = $body;
    if ($mail->send()) {
        global $success, $echec;
        $alert = "Alert mail";
    } else {
        $echecalert = 'Echec alertmail' . $mail->ErrorInfo;
    }
}

function validecollocation()
{
    $name = "Court.immo.sn";  // Name of your website or yours
    global $email, $pseudo;
    $to = $email;  // mail of reciever
    $subject = "Demande collocation";
    $body = " <h2>Félicitation " . $pseudo . "&#127881; &#127881;</h2>
    <p class='m-0'><span style ='text-transform: capitalize'></span> Votre demande collocation a été validée et est désormais disponible sur la plateforme.</p>";
    $from = "court.immo.sn@gmail.com";  // you mail
    $password = "irlhkxqrpmrxaehx";  // your mail password

    // Ignore from here

    require_once "PHPMailer/PHPMailer.php";
    require_once "PHPMailer/SMTP.php";
    require_once "PHPMailer/Exception.php";
    $mail = new PHPMailer();

    // To Here

    //SMTP Settings
    $mail->isSMTP();
    // $mail->SMTPDebug = 3;  Keep It commented this is used for debugging                          
    $mail->Host = "smtp.gmail.com"; // smtp address of your email
    $mail->SMTPAuth = true;
    $mail->Username = $from;
    $mail->Password = $password;
    $mail->Port = 587;  // port
    $mail->SMTPSecure = "tls";  // tls or ssl
    $mail->smtpConnect([
        'ssl' => [
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        ]
    ]);

    //Email Settings
    $mail->isHTML(true);
    $mail->setFrom($from, $name);
    $mail->addAddress($to); // enter email address whom you want to send
    $mail->Subject = ("$subject");
    $mail->Body = $body;
    if ($mail->send()) {
        global $success, $echec;
        $success = "Demande validée";
    } else {
        $echec = 'Echec de la validation' . $mail->ErrorInfo;
    }
}

function addcollocation()
{
    $name = "Court.immo.sn";  // Name of your website or yours
    global $last_id;
    $to = "court.immo.sn@gmail.com";  // mail of reciever
    $subject = "Nouvelle demande collocation";
    $body = " <h2>Cher(e) administrateur/administratrice</h2>
    <p class='m-0 text-justify'> Nous avons le plaisir de vous informer qu'une nouvelle demande collocation a été ajoutée.</p>
    </br>
    <p>Vous pouvez consulter les détails de la demande  : <a target = '_blank' href='http://localhost/projet-site-de-courtage/adminaxel/view_demande.php?demande=$last_id'>ici</a></p>";

    $from = "court.immo.sn@gmail.com"; // you mail
    $password = "irlhkxqrpmrxaehx"; // your mail password

    // Ignore from here

    require_once "PHPMailer/PHPMailer.php";
    require_once "PHPMailer/SMTP.php";
    require_once "PHPMailer/Exception.php";
    $mail = new PHPMailer();

    // To Here

    //SMTP Settings
    $mail->isSMTP();
    // $mail->SMTPDebug = 3; Keep It commented this is used for debugging
    $mail->Host = "smtp.gmail.com"; // smtp address of your email
    $mail->SMTPAuth = true;
    $mail->Username = $from;
    $mail->Password = $password;
    $mail->Port = 587; // port
    $mail->SMTPSecure = "tls"; // tls or ssl
    $mail->smtpConnect([
        'ssl' => [
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        ]
    ]);

    //Email Settings
    $mail->isHTML(true);
    $mail->setFrom($from, $name);
    $mail->addAddress($to); // enter email address whom you want to send
    $mail->Subject = ("$subject");
    $mail->Body = $body;
    if ($mail->send()) {
        global $success, $echec;
        $alert = "Alert mail";
    } else {
        $echecalert = 'Echec alertmail' . $mail->ErrorInfo;
    }
}

function validationdm()
{
    $name = "Court.immo.sn";  // Name of your website or yours
    global $email, $pseudo;
    $to = $email;  // mail of reciever
    $subject = "Validation demande";
    $body = " <h2>Félicitation " . $pseudo . "&#127881; &#127881;</h2>
    <p class='m-0'><span style ='text-transform: capitalize'></span> Votre demande a été validée et est désormais disponible.</p>";
    $from = "court.immo.sn@gmail.com";  // you mail
    $password = "irlhkxqrpmrxaehx";  // your mail password

    // Ignore from here

    require_once "PHPMailer/PHPMailer.php";
    require_once "PHPMailer/SMTP.php";
    require_once "PHPMailer/Exception.php";
    $mail = new PHPMailer();

    // To Here

    //SMTP Settings
    $mail->isSMTP();
    // $mail->SMTPDebug = 3;  Keep It commented this is used for debugging                          
    $mail->Host = "smtp.gmail.com"; // smtp address of your email
    $mail->SMTPAuth = true;
    $mail->Username = $from;
    $mail->Password = $password;
    $mail->Port = 587;  // port
    $mail->SMTPSecure = "tls";  // tls or ssl
    $mail->smtpConnect([
        'ssl' => [
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        ]
    ]);

    //Email Settings
    $mail->isHTML(true);
    $mail->setFrom($from, $name);
    $mail->addAddress($to); // enter email address whom you want to send
    $mail->Subject = ("$subject");
    $mail->Body = $body;
    if ($mail->send()) {
        global $success, $echec;
        $success = "Demande validé";
    } else {
        $echec = 'Echec de la validation' . $mail->ErrorInfo;
    }
}