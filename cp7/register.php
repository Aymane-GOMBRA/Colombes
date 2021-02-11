<?php
// Tester avec MYSQLI si le user est reconnu ou pas : 
//1. connexion à BDD
$cnn = mysqli_connect('localhost', 'root', 'gombra', 'northwind');
if(mysqli_connect_errno()){
    printf('Erreur de connexion %s', mysqli_connect_error());
    exit();
}
//2. requêtre préparée pour vérifier si mail + pass trouvés renvoient une ligne
$qry=mysqli_stmt_init($cnn);
$sql='SELECT count(*) as nb FROM users WHERE mail=?';
if(mysqli_stmt_prepare($qry, $sql)){
    $mail=md5(htmlspecialchars($_POST['mail']));
    mysqli_stmt_bind_param($qry, 's', $mail);
    mysqli_stmt_execute($qry);
    mysqli_stmt_bind_result($qry, $nb);
    mysqli_stmt_fetch($qry);
    mysqli_stmt_close($qry);
}

if($nb === 1){
    //3. si oui alors afficher message erreur
    echo $_POST['mail'].' est déja enregistrée.';

}else{
    //4. si non alors créer un nouvel user avec rôle app_read
    //echo $_POST['mail'].' n\'existe pas';
    //5.create user
    //grand role
    //set default role
}

mysqli_close($cnn);
?>