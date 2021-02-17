<?php
//1 Vérif et sécur des variables $post
// isset !empty htmlspecialchars
if(isset($_POST['mail']) && !empty($_POST['mail'])){
    $email = md5(htmlspecialchars($_POST['mail']));
}

if(isset($_POST['pass']) && !empty($_POST['pass'])){
    // $pass = hash('sha512', SHA1($_POST['pass'] . $email, false), false);
    $pass = hash('sha512', SHA1($_POST['pass'] . $email, false), false);
}

try{
    include_once('constants.php');
    $cnn=new PDO('mysql:host='.HOST.';dbname='.DB.';charset=utf8', USER, PASS, array(
        PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ));
    $sql='SELECT * FROM users WHERE mail=? and pass=?';
    $qry = $cnn->prepare($sql);
    $vals=array($email, $pass);
    $qry->execute($vals);
    $count = $qry->rowCount();
    if($count === 1){
        //Démarrage session et stockage variables de session
        session_start();
        $row = $qry->fetch();
        $_SESSION['connected']=true;
        $_SESSION['session_id']=session_id();
        $_SESSION['fname']=$row['fname'];
        $_SESSION['mail']=$_POST['mail'];
        header('location:bo.php?user=login');
    }else{
        header('location:index.php?c=f');
    }
}catch(PDOException $e){
    echo '<p class="alert alert-danger">'.$e->getMessage().'</p>';
}


// if(isset($_POST['mail']) && !empty($_POST['mail'])){
//     $email = md5(htmlspecialchars($_POST['mail']));
//     $pass = hash('sha512', SHA1($_POST['pass'] . $email, false), false);
//     try {
//       $cnn=new PDO('mysql:host='.HOST.';dbname='.DB.';charset=utf8', USER, PASS);
//       $cnn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION) ;
//       $cnn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
//       $sql='SELECT * as nb FROM users WHERE mail=? and pass=?;';
//       $qry = $cnn->prepare($sql);
//       $vals=array($email, $pass);
//       $qry->execute($vals);
//       $count = $qry->rowCount();
//       echo $count;

//     }catch(Exception $e){
//     echo '<p class="alert alert-danger">'.$e->getMessage().'</p>';
//     }
// }
// echo 'oui';
  
?>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
