<?php

/**
 * INSTALLATION DE SENDMAIL
 * Télécharger Sendmail à partir du site officiel : 
 * https://www.glob.com.au/sendmail/sendmail.zip
 * Extraire son contenu dans un dossier (Exemple : d:\apps\sendmail)
 * Ouvrir sendmail.ini et définir les variables suivantes :
 * - smtp_server=smtp.gmail.com
 * - smtp_port=587
 * - auth_username=lesly.lodin@gmail.com
 * - auth_password=Secret1234
 * Fermer en sauvegardant
 * 
 * CONFIGURATION PHP
 * Ouvrir php.ini et commenter les variables suivantes :
 * - ;SMTP = localhost
 * - ;smtp_port = 25
 * - ;auth_username =
 * - ;auth_password =
 * - ;sendmail_from = me@example.com -> Windows seulement
 * Puis définir la variable suivante :
 * - sendmail_path="d:\apps\sendmail\sendmail.exe -t"
 * 
 * CONFIGURATION GMAIL
 * Cliquer sur le lien suivant pour autoriser les apps moins sécurisées : 
 * https://www.google.com/settings/security/lesssecureapps
 */

$to = "agombradev@gmail.com";
$subject = "Test mail PHP";
$message = "
<html>
<head>
<title>Ceci est un test de mail PHP</title>
</head>
<body>
<p>Test mail PHP. Ne pas tenir compte.</p>
</body>
</html>
";

// Obligatoire pour définir le type de contenu du mail
$headers = "MIME-Version: 1.0 \r\n";
$headers .= "Content-type:text/html;charset=UTF-8 \r\n";

// Plus d'en-tête : From est requis, le reste est optionnel
$headers .= "From: OuaiCestm@laponie.fi \r\n";
$headers .= "Cc: pere.fouettard@hell.org \r\n";

// Envoi du mail
$res = mail($to, $subject, $message, $headers);
echo ($res ? 'Succès' : 'Echec');