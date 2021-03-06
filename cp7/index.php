<?php
session_start();
$connected=false;
if(isset($_SESSION['connected']) && $_SESSION['connected']){
  $connected=$_SESSION['connected'];
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

<div class="jumbotron">
  <h1 class="display-4">Northwind Traders</h1>
  <p class="lead">Projet fil rouge en HTML, CSS, JS, PHP et MySQL basé sur le jeu de données Northwind.
  </p>
  <p class="lead"><?php
    // include_once('team.php');
    // $diff=(strtotime(date('Y-m-d'))-strtotime('2020-11-02')) /60/60/24;
    // echo ' Développer par '.PRENOM.' '.NOM.', Daron Coder depuis '.$diff.' jours';
    ?></p>
    <p class="lead"><?php
    include_once('team.php');
    $diff=(strtotime(date('Y-m-d'))-strtotime('2020-11-02')) /60/60/24;
    echo " Développer par Aymane Gombra , Daron Coder depuis {$diff} jours";
    ?></p>
  <hr class="my-4">
  <p>Cliquez sur le bouton ci-dessous pour accéder au back-office(user et mot de passe requis):</p>
  <a class="btn btn-primary btn-lg"  href="index.php" role="button">Acceuil</a>
  <a class="btn btn-success btn-lg"  style="display:<?php echo ($connected ? '' : 'none'); ?>" href="bo.php" role="button">Accéder au Back-Office</a>
  <span style="display:<?php echo (!$connected ? '' : 'none'); ?>">
            <a class="btn btn-success btn-lg" href="#" role="button" data-toggle="modal" data-target="#login">Connexion</a>
            <a class="btn btn-warning btn-lg" href="#" role="button" data-toggle="modal" data-target="#register">Inscription</a>
  </span>
  <a class="btn btn-danger btn-lg float-right"  style="display:<?php echo ($connected ? '' : 'none'); ?>" href="logout.php" role="button" >Déconnexion</a>
</div>

<?php
if(isset($_GET['i']) && !empty($_GET['i'])){

  if($_GET['i']==='d'){
    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">Cette adresse exsite déjà.<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
  }elseif($_GET['i']==='t'){
    echo'<div class="alert alert-success alert-dismissible fade show" role="alert">Inscription réussie.<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
  }elseif($_GET['i']==='f'){
    echo'<div class="alert alert-danger alert-dismissible fade show" role="alert">Tentative d\'inscription échoué.<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
  }
}

if(isset($_GET['c']) && !empty($_GET['c'])){

  if($_GET['c']==='f'){
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">Ce compte n\'existe pas.<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
  }
}

if(isset($_GET['d']) && !empty($_GET['d'])){

  if($_GET['d']==='t'){
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">Vous êtes deconnecté.<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
  }
}

?>


<section id="team" class="d-flex flex-wrap justify-content-around">
<?php
//AVEC OPÉRATEUR TERNAIRE
$html = '';
for($i = 0;$i<count($members);$i++) {
    $html .= '<div class="card mb-3 ' .($members[$i][2]==='F'?'girl':'boy').'" style="width: 18rem;">';
    $html .= '<div class="card-body">';
    $html .= '<h5 class="card-title">'.$members[$i][0].'</h5>';
    $html .= '<p class="card-text">'.$members[$i][1].' ans</p>';
    $html .= '<p class="card-text">'.($members[$i][3]?($members[$i][2]==='F'?'Mariée':'Marié'):'Célibataire').'</p>';
    $html .= '</div></div>';
}
echo $html;
?>
</section>


<h2>Nos références</h2>
<section id="projects">
  <?php include_once('projects.php');?>
</section>
<div id="bo">
<h2>Back-Office</h2>
<section id="tables">
<?php
$cnn = mysqli_connect('localhost', 'root', 'gombra', 'information_schema');
$res = mysqli_query($cnn, "SELECT table_name, table_rows FROM tables WHERE table_schema = 'northwind'");
$html='';
while($row=mysqli_fetch_assoc($res)){
  $html .='<a class="btn btn-info m-3" href="'.$row['TABLE_NAME'].'.php">'.$row['TABLE_NAME'].'<span class="badge badge-light">'.$row['TABLE_ROWS'].'</span></a>';
}
echo $html;
mysqli_close($cnn);
?>
</section>
</div>

<!-- Modal Inscription -->
<div class="modal fade" id="register" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

    <form action="register.php" id="myForm" method="post">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Inscription</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="form-group">
            <label for="fname">Prénom : </label>
            <input type="text" name="fname" id="fname" required pattern="[A-Za-z\u00C0-\uOOFF'\-]" class="form-control">
          </div>

          <div class="form-group">
            <label for="mail">Courriel : </label>
            <input type="email" name="mail" id="mail" required class="form-control">
          </div>

          <div class="form-group">
            <label for="pass">Mot de passe : </label>
            <input type="password" name="pass" class="form-control" id="pass" required pattern="[A-Za-z0-9@$*!? ]{8,}">
          </div>
          <div class="form-group">
            <label for="check">Vérification mot de passe : </label>
            <input type="password" id="check" class="form-control" required pattern="[A-Za-z0-9@$*!? ]{8,}">
          </div>
          <div class="form-group">
            <label for="land">Pays : </label>
            <?php
              $json=file_get_contents('https://restcountries.eu/rest/v2/lang/fr?fields=translations;alpha2Code');
              $obj=json_decode($json);
            ?>
            <select name="land" id="land" class="form-control">
            <?php
            $html="";
            foreach($obj as $val){
              $html.='<option value="'.$val->alpha2Code.'">'.$val->translations->fr.'</option>';
            }
            echo $html;
            ?>
            </select>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
        <input type="submit" class="btn btn-primary" value="Valider">
      </div>
    </form>
    </div>
  </div>
</div>


<!-- Modal Connexion -->
<div class="modal fade" id="login" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

    <form action="login.php" id="myForm" method="post">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Connexion</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="form-group">
            <label for="mail">Courriel : </label>
            <input type="email" name="mail" id="mail" required class="form-control">
          </div>
          <div class="form-group">
            <label for="pass">Mot de passe : </label>
            <input type="password" name="pass" class="form-control" id="pass" required pattern="[A-Za-z0-9@$*!? ]{8,}">
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
        <input type="submit" class="btn btn-primary" value="Valider">
      </div>
    </form>
    </div>
  </div>
</div>



<script src="js/index.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

</body>
</html>