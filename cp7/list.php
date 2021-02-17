<?php
include_once('test_session.php');
include_once('pdo_connect.php');
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
    <?php
    $t = $_GET['t'];
    echo '<h1>Base de données : ' . DB . '</h1>';
    echo '<h2>Table : ' . $t . '</h2>';
    try{
        $sql = 'SELECT * FROM '.$t;
        $qry=$cnn->prepare($sql);
        $qry->execute();
    }catch(PDOException $e){
        echo '<p class="alert alert-danger">'.$e->getMessage().'</p>';
    }
    ?>

    <table class="table table-striped">
        <thead>
            <tr>
            <?php
            //Affiche le nom des colonnes
            $html = '';
            for ($i=0;$i<$qry->columnCount();$i++){
                $meta=$qry->getColumnMeta($i);
                $html.= '<th> '.$meta['name'].'</th>';
            }
            echo $html;
            ?>
            </tr>
        </thead>
        <tbody>
        <?php
        $html='';
        while($row = $qry->fetch()){
            $html.='<tr>';
            foreach($row as $key => $val){
                $html.='<td>'.$val.'</td>';
            }
            $html.='</tr>';
        }
        echo $html;
        ?>
        </tbody>
    </table>
</body>

</html>