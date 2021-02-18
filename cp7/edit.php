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
    //Message si pas d'info dans l'URL
    if (!isset($_GET['t']) || empty($_GET['t']) || !isset($_GET['k']) || empty($_GET['k']) || !isset($_GET['id'])){
        echo '<p class="alert alert-warning"><strong>Attention !</strong> Aucune données à afficher : <a href="bo.php">retour au back-office</a></p>';
        exit();
    }
    $t = $_GET['t'];
    $k = $_GET['k'];
    $id = $_GET['id'];
    echo '<h1>Base de données : ' . DB . '</h1>';
    echo '<h2>Table : ' . $t . '</h2>';
    ?>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Acceuil</a></li>
            <li class="breadcrumb-item"><a href="bo.php">Back-Office</a></li>
            <li class="breadcrumb-item"><a href="<?php echo 'list.php?t=' . $t . '&k=' . $k; ?>">Liste</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edition</li>
        </ol>
    </nav>

    <form style="text-align: center" action="" method="post">
        <?php
        try {
            if(!empty($id)){
                $sql = "SELECT * FROM $t where $k=?";
                $qry = $cnn->prepare($sql);
                $vals=array($id);
                $qry->execute($vals);
                $row = $qry->fetch();
            }else{
                $sql = "SELECT * FROM $t where 1=2";
                $qry = $cnn->prepare($sql);
                $qry->execute();
                for($i=0;$i<$qry->columnCount();$i++){
                    $row[$qry->getColumnMeta($i)['name']]='';
                }
            }
            //Ajoute Label/Input
            $html='';
            foreach($row as $key=>$val){
                $html.='<div class="form-group">';
                $html.='<label for="'.$key.'">'.$key.'</label>';
                $html.='<input type="text" id="'.$key.'" name="'.$key.'" value="'.$val.'"/>';
                $html.='</div>';
            }
            $html.='<input type="submit" class="btn btn-info" value="Enregistrer">';
            echo $html;
        } catch (PDOException $e) {
            echo '<p class="alert alert-danger">' . $e->getMessage() . '</p>';
        }
        while ($row = $qry->fetch()) {
        }
        ?>
    </form>
</body>

</html>