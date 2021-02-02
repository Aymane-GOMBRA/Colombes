<?php

//Sécurité: step 2
//protège les saisies d'une éventuelle injection
$params = [];
foreach ($_POST as $key => $val) {
    if (isset($_POST[$key]) && !empty($_POST[$key])) {
        $params[] = htmlspecialchars($_POST[$key]);
    } else {
        $params[] = null;
    }
}

//Connexion à la BDD via MYSQLI et vérif
$cnn = mysqli_connect('localhost', 'root', 'gombra', 'northwind');
if (mysqli_connect_errno()) {
    printf("Échec de la connexion à la base de données : %s", mysqli_connect_error());
    exit();
}

//récupération de l'image à téléverser
var_dump($_FILES);
if (isset($_FILES['PHOTO']) && $_FILES['PHOTO']['error'] !== UPLOAD_ERR_NO_FILE) {
    //Variables du fichier
    $file_exts = array('png','jpeg','gif','jpg','webp');
    $file_ext = strtolower(substr($_FILES['PHOTO']['type'], strpos($_FILES['PHOTO']['type'], '/') + 1));
    $file_size = $_FILES['PHOTO']['size'];
    $file_temp = $_FILES['PHOTO']['tmp_name'];
}
exit();


//Sécurité : step 3
//préparation de la requête
$qry = mysqli_stmt_init($cnn);
$sql = "INSERT INTO categories(CODE_CATEGORIE, NOM_CATEGORIE, DESCRIPTION, PHOTO) VALUES(?, ?, ?, ?)";
if (mysqli_stmt_prepare($qry, $sql)) {
    //lie les paramètres à la requête préparée
    mysqli_stmt_bind_param($qry, "issb", $params[0], $params[1], $params[2], $params[3]);
    //exécute la requête
    mysqli_stmt_execute($qry);
    //ferme le statement
    mysqli_stmt_close($qry);
}
//déconnexion de la BDD
mysqli_close($cnn);
