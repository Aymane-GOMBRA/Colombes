<?php
include_once('test_session.php');
include_once('constants.php');
include_once('singleton.class.php');
include_once('model.class.php');
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <title>Statistiques</title>
</head>

<body class="container">
    <h1>Statistiques des ventes</h1>
    <div class="form-group">
        <label for="year">Année :</label>
        <?php
        Singleton::setConfiguration(HOST, 3306, DB, USER, PASS);
        echo Singleton::getHtmlSelect('year', 'SELECT DISTINCT year(DATE_COMMANDE) as annee FROM commandes');
        ?>
    </div>
    <div class="form-group">
        <label for="emp">Vendeur :</label>
        <?php
        Singleton::setConfiguration(HOST, 3306, DB, USER, PASS);
        echo Singleton::getHtmlSelect('emp', 'SELECT NO_EMPLOYE, concat(PRENOM, " ", NOM) FROM employes');
        ?>
    </div>

    
    <img id ="chart" class="rounded mx-auto d-block" src="chart.php" alt="Stats des ventes">


    <script src="js/stats.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

</body>

</html>