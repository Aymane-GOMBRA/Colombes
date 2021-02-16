<?php
// Tester avec MYSQLI si le user est reconnu ou pas : 
include_once('constants.php');
//1. connexion à BDD
$cnn = mysqli_connect(HOST, USER, PASS, DB);
if (mysqli_connect_errno()) {
    printf('Erreur de connexion %s', mysqli_connect_error());
    exit();
}
//2. requêtre préparée pour vérifier si mail + pass trouvés renvoient une ligne
$qry = mysqli_stmt_init($cnn);
$sql = 'SELECT count(*) as nb FROM users WHERE mail=?';
if (mysqli_stmt_prepare($qry, $sql)) {
    $mail = md5(htmlspecialchars($_POST['mail']));
    mysqli_stmt_bind_param($qry, 's', $mail);
    mysqli_stmt_execute($qry);
    mysqli_stmt_bind_result($qry, $nb);
    mysqli_stmt_fetch($qry);
    mysqli_stmt_close($qry);
}

if ($nb === 1) {
    //3. si oui alors afficher message erreur
    echo $_POST['mail'] . ' est déja enregistrée.';
    header('location:index.php?i=d');
} else {
    //4. si non alors créer un nouvel user avec rôle app_read
    $qry = mysqli_stmt_init($cnn);
    $sql = "INSERT INTO users(mail, fname, pass, land, active) VALUES(?, ?, ?, ?, ?)";
    if (mysqli_stmt_prepare($qry, $sql)) {
        //lie les paramètres à la requête préparée
        $name = strtolower(htmlspecialchars($_POST['fname']));
        $email = md5(htmlspecialchars($_POST['mail']));
        $pass = hash('sha512', SHA1($_POST['pass'] . $email, false), false);
        $land = htmlspecialchars($_POST['land']);
        $active = 0;
        mysqli_stmt_bind_param($qry, "ssssi", $email, $name, $pass, $land, $active);
        $res = mysqli_stmt_execute($qry);
        mysqli_stmt_close($qry);

        //Envoie d'un mail pour confirmation si succes
        if ($res) {
            $url='http://' . $_SERVER['HTTP_HOST'] . '/colombes/cp7/register2.php?m=' . $email;
            //Corps du mail
            $html = '';
            $html .= '<h1>Inscription Northwind Traders</h1>';
            $html .= '<p>Bonjour ' . $_POST['fname'] . ' et bienvenu(e) sur notre site.';
            $html .= '<p>Clique sur le lien suivant pour valider ton inscription : <a href="'.$url.'">'.$url.'</a>';
            $html .= '<p>À très bientôt';
            $html .= '</body></html>';
            //En-tête du mail
            $header = "MIME-Version: 1.0 \n"; //Version MIME
            $header .= "Content-type: text/html; charset=utf-8 \n"; //Format du mail
            $header .= "From: marie@noelle.fr \n"; //Expéditeur
            $header .= "Reply-to: manu@elysees.gouv.fr \n"; //Destinateur
            $header .= "Disposition-Notification-to: agombra95@gmail.com \n";//Accusé de réception
            $header.= "X-Priority: 1\n";//Activation d'importance 
            $header.= "X-MSMail-Priority: High \n";//Activation d'importance pour Microsoft
            //Envoi du mail
            //Pour Linux, installer un serveur de messagerie : http//www.postfix.org/
            //Pour Windows Sendmail
            // ini_set('SMTP', 'ssl0.ovh.net');
            // ini_set('sendmail_from', 'agombra95@gmail.com');
            ini_set('sendmail_path', '/chemin sendmail.exe');

            $res2=mail($_POST['mail'], 'Northwind Traders', $html, $header);
            echo ($res2 ? 'Succès' : 'Echec');
            header('location:index.php?i=t');
        } else {
            echo 'Echec dans l\'ajout du user';
            header('location:index.php?i=f');
        }
    }

    //exécute la requête
}
//5.create user
//grand role
//set default role
//tester sur workbench


mysqli_close($cnn);

