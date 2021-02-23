<?php
include_once('test_session.php');
include_once('pdo_connect.php');

if(isset($_GET['pg']) && !empty($_GET['pg'])){
    $pg=(int)$_GET['pg'];
}else{
    $pg=1;
}
// Récupère le nombre de lignes actif si existe
if(isset($_GET['nb']) && !empty($_GET['nb'])){
    $nb=(int)$_GET['nb'];
}else{
    $nb=5;
}

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
if(!isset($_GET['t']) || empty($_GET['t']) || !isset($_GET['k']) || empty($_GET['k'])){
    echo '<p class="alert alert-warning"><strong>Attention !</strong> Aucune données à afficher : <a href="bo.php">retour au back-office</a></p>';
    exit();
}
//Teste si table et colonne existent via inforamtion_schema a faire plus tard

    $t = $_GET['t'];
    $k = $_GET['k'];
    echo '<h1>Base de données : ' . DB . '</h1>';
    
    if(isset($_GET['s']) && !empty($_GET['s'])){

        if($_GET['s']==='t'){
          echo '<div class="alert alert-success alert-dismissible fade show" role="alert">Table '.DB.' mise à jour.<button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';
        }elseif($_GET['s']==='f'){
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">'.$t.' supprimer.<button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>';
          }
      }
      
    ?>
    
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Acceuil</a></li>
            <li class="breadcrumb-item"><a href="bo.php">Back-Office</a></li>
            <li class="breadcrumb-item active" aria-current="page">Liste</li>
        </ol>
    </nav>
    <?php
    echo '<h2>Table : ' . $t . '</h2>';
    echo '<a class = "btn btn-success m-1" href="edit.php?t='.$t.'&k='.$k.'&id=">Ajouter</a>';
    echo '<a class = "btn btn-danger m-1" href="export_pdf.php?t='.$t.'">Exporter en PDF</a>';
    echo '<a class = "btn btn-warning m-1" href="export_csv.php?t='.$t.'">Exporter en CSV</a>';
    echo '<a class = "btn btn-info m-1" href="export_xml.php?t='.$t.'">Exporter en XML</a>';
    try {
        $start = ($pg-1)*$nb;
        $sql = 'SELECT * FROM ' .$t. ' LIMIT '.$start.', '.$nb;
        $qry = $cnn->prepare($sql);
        $qry->execute();
    } catch (PDOException $e) {
        echo '<p class="alert alert-danger">' . $e->getMessage() . '</p>';
    }
    ?>

    <table class="table table-striped">
        <thead>
            <tr>
                <?php
                //Affiche le nom des colonnes
                $html = '';
                $types = [];
                for ($i = 0; $i < $qry->columnCount(); $i++) {
                    //récupère les infos de la colonne
                    $meta = $qry->getColumnMeta($i);
                    //affiche le nom de la colonne
                    $html .= '<th> ' . $meta['name'] . '</th>';
                    //stock le type de données de la colonnes
                    $types[$meta['name']] = $meta['native_type'];
                }
                $html.='<th></th><th></th>';
                echo $html;
                ?>
            </tr>
        </thead>
        <tbody>
            <?php
            $html = '';
            while ($row = $qry->fetch()) {
                $html .= '<tr>';
                foreach ($row as $key => $val) {
                    switch ($types[$key]) {
                        case 'LONG':
                        case 'NEWDECIMAL':
                            $align = 'right';
                            break;
                        case 'DATE':
                            $align = 'center';
                            break;
                        default:
                            $align = 'left';
                    }
                    //Si BLOB ou TEXT
                    if($types[$key]=='BLOB'){
                        $html.='<td><img style="width:5em" src="'.$val.'" /></td>';
                    }else{
                        $html .= '<td align="' . $align . '">' . $val . '</td>';
                    }
                }
                $html.='<td><a class="btn btn-warning btn-sm" href="edit.php?t='.$t.'&k='.$k.'&id='.$row[$k].'">MAJ</a></td>';
                $html.='<td><a class="btn btn-danger btn-sm delete" href="delete.php?t='.$t.'&k='.$k.'&id='.$row[$k].'">SUPPR</a></td>';
                $html .= '</tr>';
            }
            echo $html;
            ?>
        </tbody>
    </table>
    <nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center">
    <?php
    //Calcule la pagination
    $res=$cnn->query("SELECT COUNT(*) AS total FROM $t");
    $row=$res->fetch();
    $pgs=ceil($row['total'] / $nb);
    //Affiche la pagination
    $html='';
    $html.='<li class="page-item '.($pg==1?'disabled':'').'" ><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?t='.$t.'&k='.$k.'&pg='.($pg-1).'&nb='.$nb.'">Précédent</a></li>';
    

    for($i = 1;$i<=$pgs;$i++){
        $href=$_SERVER['PHP_SELF'].'?t='.$t.'&k='.$k.'&pg='.$i.'&nb='.$nb;
        $html.='<li class="page-item '.($pg==$i?'active':'').'"><a class="page-link" href="'.$href.'">'.$i.'</a></li>';
    }

    $html.='<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?t='.$t.'&k='.$k.'&pg='.($pg+1).'&nb='.$nb.'">Suivant</a></li>';
    echo $html;
    unset($cnn);


    ?>
    </nav>
<script src="js/list.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

</body>
</html>