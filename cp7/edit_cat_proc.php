<?php
//Connexion à la BDD via MYSQLI
$sql = "INSERT INTO categories(CODE_CATEGORIE, NOM_CATEGORIE, DESCRIPTION) VALUES({$_POST['CODE_CATEGORIE']}, '{$_POST['NOM_CATEGORIE']}', '{$_POST['DESCRIPTION']}')";
$cnn = mysqli_connect('localhost', 'root', 'gombra', 'northwind');
$res = mysqli_query($cnn, $sql);
echo $sql;
var_dump($res);
?>