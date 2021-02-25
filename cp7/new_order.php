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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Northwind Traders</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="css/main.css">

</head>

<body class="container">
    <h1>Prise de commande</h1>
    <form action="new_order_save.php" method="post">
        <div class="form-group">
            <label for="NO_COMMANDE">N° Commande</label>
            <input type="number" name="NO_COMMANDE" id="NO_COMMANDE" class="form-control" value="12000">
        </div>
        <div class="form-group">
            <label for="CODE_CLIENT">Client</label>
            <?php
            Singleton::setConfiguration(HOST, 3306, DB, USER, PASS);
            echo Singleton::getHtmlSelect('CODE_CLIENT', 'SELECT CODE_CLIENT, SOCIETE FROM clients');
            ?>
        </div>
        <div class="form-group">
            <label for="NO_EMPLOYE">Vendeur</label>
            <?php
            Singleton::setConfiguration(HOST, 3306, DB, USER, PASS);
            echo Singleton::getHtmlSelect('NO_EMPLOYE', 'SELECT NO_EMPLOYE, concat(PRENOM, " ", NOM) AS employe FROM employes');
            ?>
        </div>
        <div class="form-group">
            <label for="DATE_COMMANDE">Date de commande</label>
            <input type="date" name="DATE_COMMANDE" id="DATE_COMMANDE" class="form-control">
        </div>
        <div class="form-group">
            <label for="DATE_ENVOI">Date d'envoie</label>
            <input type="date" name="DATE_ENVOI" id="DATE_ENVOI" class="form-control">
        </div>
        <div class="form-group">
            <label for="PORT">Frais de port</label>
            <input type="text" name="PORT" class="form-control" id="PORT">
        </div>
        <input type="submit" value="Valider la commande" class="btn btn-primary">
        
    </form>





    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
</body>

</html>