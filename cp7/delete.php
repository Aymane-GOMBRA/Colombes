<?php
include_once('test_session.php');
include_once('pdo_connect.php');

if (isset($_GET['t']) && !empty($_GET['t']) && isset($_GET['k']) && !empty($_GET['k']) && isset($_GET['id']) && !empty($_GET['id'])){
    try{
        $t = htmlspecialchars($_GET['t']);
        $k = htmlspecialchars($_GET['k']);
        $id = htmlspecialchars($_GET['id']);
        $sql="DELETE FROM $t where $k = ?";
        $qry=$cnn->prepare($sql);
        $qry->execute(array($id));
        unset($cnn);
        header("location:list.php?t=$t&k=$k&s=f");
    }catch(PDOException $e){
        echo $e->getMessage();
    }
}
