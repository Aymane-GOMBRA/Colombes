<?php
//Ouvre la BDD en MySQLI
$cnn = mysqli_connect('localhost', 'root', 'gombra', 'northwind');
$res = mysqli_query($cnn, 'SELECT * FROM categories');
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Northwind Traders</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

</head>

<body class="container">
    <h1>Liste des catégories</h1>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Acceuil</a></li>
        <li class="breadcrumb-item active" aria-current="page">Liste catégories</li>
        <li class="breadcrumb-item"><a href="edit_cat_form.php">Édition catégories</a></li>
        </ol>
    </nav>
    <table class="table table-dark table-striped">
        <thead>
            <tr>
                <?php
                //Liste les colonnes
                $html = '';
                while ($col = mysqli_fetch_field($res)) {
                    $html .= "<th>{$col->name}</th>";
                }
                echo $html;
                ?>
            </tr>
        </thead>
        <tbody>
            <?php
            //Liste les datas
            $html ='';
            while($row = mysqli_fetch_assoc($res)){
                $html .= "<tr>";
                foreach($row as $key => $val){
                    //Si ce n'est du BLOB
                    if(strpos($val, ';base64,')){
                        $html .='<td><img src="'.$val.'" style="width:4rem" /></td>';  
                    }else{
                        $html .="<td>{$val}</td>";  
                    }
                    
                }
                $html .= "</tr>";
            }
            echo $html;
            ?>
        </tbody>
    </table>

</body>

</html>