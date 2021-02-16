<?php
//1 Vérif et sécur des variables $post
// isset !empty htmlspecialchars
if(isset($_POST['mail']) && !empty($_POST['mail'])){
    $email = md5(htmlspecialchars($_POST['mail']));
}

if(isset($_POST['pass']) && !empty($_POST['pass'])){
    // $pass = hash('sha512', SHA1($_POST['pass'] . $email, false), false);
    $pass = hash(sha1($pass).$email, 512);
}

try{
    include_once('constants.php');
    $cnn=new PDO('mysql:host='.HOST.';dbname='.DB.';charset=utf8', USER, PASS, array(
        PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ));
}catch(PDOException $e){

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