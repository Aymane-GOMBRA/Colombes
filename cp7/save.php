<?php
//imports
include_once('test_session.php');
include_once('pdo_connect.php');
// $tab = http_build_query($_POST, '', ', ');
// echo $tab;


//récup dans une variables tableau associatif la clé et la valeur de chaque colonne
if (isset($_GET['t']) && !empty($_GET['t']) && isset($_GET['k']) && !empty($_GET['k']) && isset($_GET['id'])){
    $t = $_GET['t'];
    $k = $_GET['k'];
    $id = $_GET['id'];
    $cols=[];
    $vals=[];
    if(empty($_GET['id'])){
        //Pour INSERT
        $sql = "INSERT INTO $t(%s) VALUES(%s)";
        foreach($_POST as $key => $val){
            $cols[]=$key;
            $vals[":$key"]=htmlspecialchars($val);
        }
        $sql = sprintf(
            $sql, 
            implode(', ', $cols), 
            implode(', ', array_keys($vals))
        );
    } else {
        //Pour UPDATE
        $sql = "UPDATE $t SET %s where $k=:newid";
        foreach($_POST as $key => $val){
            $cols[]=$key.'=:'.$key;
            $vals[":$key"]=$val;
        }
        $vals[':newid']=$id;
        $sql=sprintf(
            $sql,
           implode(', ', $cols)
        );

    }

    //Prépare et éxecution requête
    try{
        $qry=$cnn->prepare($sql);
        $qry->execute($vals);
        unset($cnn);
        header("location:list.php?t=$t&k=$k&s=t");
    }catch(PDOException $e){
        echo $e->getMessage();
    }
}


// try {
//     if(!empty($id)){
//         $sql = 'UPDATE :t SET '.
//         $qry = $cnn->prepare($sql);
//         $params = array(
//             ':t'=>$_POST['t'],
//             ':k'=>$_POST['k'],
//             ':id'=>$_POST['id']
//         );
//         $qry->execute($params);
//         $row = $qry->fetch();
//     }else{
//         $sql = "SELECT * FROM $t where 1=2";
//         $qry = $cnn->prepare($sql);
//         $qry->execute();
//         for($i=0;$i<$qry->columnCount();$i++){
//             $row[$qry->getColumnMeta($i)['name']]='';
//         }
//     }
//     //Ajoute Label/Input
//     $html='';
//     foreach($row as $key=>$val){
//         $html.='<div class="form-group">';
//         $html.='<label for="'.$key.'">'.$key.'</label>';
//         $html.='<input type="text" id="'.$key.'" name="'.$key.'" value="'.$val.'"/>';
//         $html.='</div>';
//     }
//     $html.='<input type="submit" class="btn btn-info" value="Enregistrer">';
//     echo $html;
// } catch (PDOException $e) {
//     echo '<p class="alert alert-danger">' . $e->getMessage() . '</p>';
// }
//exemple : array(
//'mail' =>'azeaze',
//'fname' => 'zazeaze')

//Vérif si les variables t, k et id sont présentes : isset
//et pas vides : !empty

//Vérif si la variables id est vide alors insert
//Sinon update