<?php
session_start();
if(!isset($_SESSION['connected']) || !$_SESSION['connected']){
  header('location:index.php?d=t');
  exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <title>Document</title>
</head>
<body class="container">
    <H1>JE SUIS ADMIN</H1>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php">Acceuil</a></li>
    <li class="breadcrumb-item active" aria-current="page">Back-Office</li>
  </ol>
<a class="btn btn-danger btn-lg float-right"  href="logout.php" role="button">Déconnexion</a>
</nav>
<div class="btn-group" role="group" aria-label="Basic example">
<a href="stats.php" class="btn btn-secondary">Stats Ventes</a>
<a href="calendar.php" class="btn btn-secondary">Calendrier des commandes</a>
</div>

<h2>Test avec les parametres passé en tableau (plus sécurisé)</h2>
<?php
include_once('constants.php');
  try {
    $cnn=new PDO('mysql:host='.HOST.';dbname='.DB.';charset=utf8', USER, PASS);
    $cnn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION) ;
    $cnn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $sql='SELECT t.TABLE_NAME, t.TABLE_ROWS, c.COLUMN_NAME from information_schema.tables t join information_schema.columns c on t.TABLE_SCHEMA = c.TABLE_SCHEMA AND t.TABLE_NAME=c.TABLE_NAME WHERE t.TABLE_SCHEMA = ? and c.COLUMN_KEY = ? and t.TABLE_ROWS < ?;';
    $qry = $cnn->prepare($sql);
    $vals=array(DB, 'PRI', 1000);
    $qry->execute($vals);
    $html='<div class="row row-cols-1 row-cols-md-4">';
      foreach ($qry as $ligne) {
      $html .='<div class="col mb-4">
      <div class="card h-100">
        <img src="pics/tesla.jpeg" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title">'. strtoupper($ligne['TABLE_NAME']).'</h5>
          <p class="card-text"><strong>Clé primaire : </strong> '.$ligne['COLUMN_NAME'].'</p>
          <p class="card-text"><strong>Nb de lignes : </strong> '.$ligne['TABLE_ROWS'].'</p>
          <a href="list.php?t='.$ligne['TABLE_NAME'].'&k='.$ligne['COLUMN_NAME'].'" class="btn btn-primary">Details</a>
          </div>
      </div>
    </div>';
      }
      $html.='</div>';
      echo $html;
      unset($cnn);
}catch(Exception $e){
  echo '<p class="alert alert-danger">'.$e->getMessage().'</p>';

  
}
  
  ?>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

</body>
</html>