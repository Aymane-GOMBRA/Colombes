<?php
include_once('test_session.php');
include_once('pdo_connect.php');

if(isset($_GET['t']) && !empty($_GET['t'])){
    //Accès aux data
    try{
        //Ouvre un flux
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment;Filename= export.csv');
        $stream=fopen('php://output', 'w');
        //Lit et écrit les data
        $t=$_GET['t'];
        $sql="SELECT * FROM $t";
        $qry=$cnn->query($sql);
        $row=[];
        for($i=0;$i<$qry->columnCount();$i++){
            $meta=$qry->getColumnMeta($i);
            $row[]=$meta['name'];
        }
        fputcsv($stream, $row);
        while($row=$qry->fetch()){
            fputcsv($stream, $row, ';');
        }
        fclose($stream);
        unset($cnn);
    }catch(PDOException $e){
        echo $e->getMessage();
    }
}else{
    echo 'Aucune table trouvée !';
}