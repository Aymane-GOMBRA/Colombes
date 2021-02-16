<?php
include_once('constants.php');
$inbox = imap_open(MB_HOST, MB_USER, MB_PASS) or die('Connexion au serveur de messagerie impossible : ' . imap_last_error());
$msg=imap_fetchbody($inbox,$_GET['id'], 1);
echo quoted_printable_decode($msg);
imap_close($inbox);
?>