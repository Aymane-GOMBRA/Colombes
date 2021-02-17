<?php
session_start();
if(!isset($_SESSION['connected']) || !$_SESSION['connected']){
  header('location:index.php?d=t');
  exit();
}
?>