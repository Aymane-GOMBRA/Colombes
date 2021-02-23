<?php
include_once('test_session.php');
include_once('pdo_connect.php');

if(isset($_GET['t']) && !empty($_GET['t'])){
    //Accès aux data
    try{
        $t=$_GET['t'];
        $sql="SELECT * FROM $t";
        $qry=$cnn->query($sql);

        $root = new SimpleXMLElement("<$t/>");
        while($row=$qry->fetch()){
            $child = $root->addChild(substr($t, 0, strlen($t)-1));
            foreach($row as $key=>$val){
                $child->addChild(strtolower($key), $val);
            }
        }
        unset($cnn);
        header('Content-type: text/xml');
        echo $root->asXML();
    }catch(PDOException $e){
        echo $e->getMessage();
    }
}else{
    echo 'Aucune table trouvée !';
}