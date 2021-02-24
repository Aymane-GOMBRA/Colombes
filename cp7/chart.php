<?php
include_once('test_session.php');
include_once('pdo_connect.php');

if (isset($_GET['e']) && !empty($_GET['e'])) {
    $e = $_GET['e'];
} else {
    $e = 5;
}

if (isset($_GET['a']) && !empty($_GET['a'])) {
    $a = $_GET['a'];
} else {
    $a = 2019;
}

$sql = "SELECT e.no_employe, e.nom, year(c.date_commande) as annee, month(c.date_commande) as mois, sum((d.PRIX_UNITAIRE*d.quantite)*(1-d.remise)) as ca from employes e join commandes c on e.no_employe=c.no_employe join details_commandes d on c.no_commande = d.no_commande where e.NO_EMPLOYE = ? and year(c.date_commande) = ? group by e.NO_EMPLOYE, e.NOM, year(c.date_commande), month(c.date_commande)";
$qry = $cnn->prepare($sql);
$qry->execute(array($e, $a));
$data = $qry->fetchAll();
//Génère la zone de dessin
$w = 800;
$h = 600;
// $img=imagecreatetruecolor($w, $h);
$img = imagecreatefromjpeg('pics/background.jpg');


$black = imagecolorallocate($img, 0, 0, 0);
$white = imagecolorallocate($img, 255, 255, 255);
$trans = imagecolorallocatealpha($img, 255, 255, 255, 63);

imagefilledrectangle($img, 0, 0, $w, $h, $trans);


if($data){
    $gap = 20;
    $wbar = ($w - ($gap * 2)) / count($data);
    $hmax = $h - ($gap * 2);
    $val_max = 150000;
    for ($i = 0; $i < count($data); $i++) {
        $hbar = round(($data[$i]['ca'] * ($hmax - $gap)) / $val_max);
        $alea = imagecolorallocatealpha($img, rand(0, 255), rand(0, 255), rand(0, 255), 15);
        imagefilledrectangle($img, $gap + ($i * $wbar), $hmax - $hbar, $gap + ($i * $wbar) + $wbar, $h - $gap, $alea);
        imagerectangle($img, $gap + ($i * $wbar), $hmax - $hbar, $gap + ($i * $wbar) + $wbar, $h - $gap, $white);
        //Label
        imagestring($img, 5, $gap + ($i * $wbar) + $wbar / 5, $h - $hbar - (3 * $gap), round($data[$i]['ca']/1000).'K e', $black);
        imagestring($img, 5, $gap+($i*$wbar)+$wbar/2, $h-$gap, $data[$i]['mois'], $black);
    }
    
    //Axe et titres
    imageline($img, $gap, $h-$gap, $w-$gap, $h-$gap, $black);
    //Abscisses
    imageline($img, $gap, $gap,$gap,$h-$gap, $black);//Ordonnées
    imagestring($img, 5, $w*.25, $gap, utf8_decode("CA du vendeur $e  pour l'année $a "), $black);

}else{
    imagestring($img, 50, 100, 100, utf8_decode("Aucune data trouvée"), $black);
}

//Affiche le résultat
header('Content-Type: image/png');
imagepng($img);
imagedestroy($img);
